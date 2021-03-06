<?php
    /*
    ページ詳細：商品詳細画面
    作成者：小川紗世
    編集者：2020/07/07三輪謙登
    */
?>
<script src="./js/shop.js"></script>
<script>

  firebase.auth().onAuthStateChanged(function(user) {
          if (user) {
            // console.log(user.uid);

            // オブジェクトをループさせるために使う関数(小計計算)
            Object.defineProperty(Object.prototype, "forIn", {
                value: function(fn, self) {
                    self = self || this;

                    Object.keys(this).forEach(function(key, index) {
                        var value = this[key];

                        fn.call(self, key, value, index);
                    }, this);
                }
            });

            // remakeコレクションの情報取得
            url = location.search.substring(1).split('=');
            var remake_product_id;
            remake_product_id = url[1];

            // cartに該当商品があれば
            var in_product_flg = false;
            if (sessionStorage.cartList) {
              var cartList = JSON.parse(sessionStorage.cartList);
              cartList.forIn((key,value,index) => {
                if (remake_product_id == value.remake_product_id) {
                  $('#add_to_cart_btn').css({"background-color": "gray"});
                  in_product_flg = true;
                }
              });
            }
            var product_id;
            // remakeコレクションの情報取得
            let remakeRef = db.collection('remake').where("remake_product_id", "==", Number(remake_product_id));
                  let allRemake = remakeRef.get().then(snapshot => {
                      snapshot.forEach(doc => {
                        const data = doc.data();

                        // product_idを取得
                        product_id = doc.data().product_id;

                        // リメイク商品情報を取得し格納
                        const remakeCategory = doc.data().category_id;
                        // console.log(remakeCategory);
                        // const remakeColor = doc.data().color_id;

                        // リメイク商品情報
                        var elem1 = document.getElementById("remake_image");
                        var elem2 = document.getElementById("remake_icon");
                        var elem3 = document.getElementById("remake_color");
                        elem3.style.backgroundColor = getColorCode(doc.data().color_id);
                        // カラーIDをdata属性に追加
                        elem3.dataset.color = doc.data().color_id;

                        // リメイク前の商品情報
                        var elem4 = document.getElementById("before_img");
                        var elem5 = document.getElementById("product_id");

                        var elem6 = document.getElementById("product_color");
                        var elem7 = document.getElementById("product_color_name");
                        var elem8 = document.getElementById("product_material");
                        var elem9 = document.getElementById("price");
                        var elem10 = document.getElementById("product_name");
                        var elem11 = document.getElementById("product_size");

                      // カテゴリーアイコンを表示
                      elem2.src = getRemakeImg(remakeCategory);

                        db.collection("stocks").where("remake_product_id", "==", Number(remake_product_id))
                        // db.collection("stocks").where("remake_product_id", "==", "DSsswyu1p9SklvMstgiu")
                        .get().then(function(querySnapshot){
                            querySnapshot.forEach(function(doc) {
                              const stocks = doc.data();

                              // リメイク商品画像の表示
                              elem1.src = stocks.remake_image;
                            });
                        })
                        .catch(function(error) {
                            console.log("Error getting documents:stocks  ", error);
                        });

                        //　productコレクションの取得
                        // db.collection("product").where("product_id", "==", data.product_id)
                        db.collection("product").where("product_id", "==", product_id)
                        .get().then(function(querySnapshot){
                            querySnapshot.forEach(function(doc) {
                              const product = doc.data()
                              const productId = product.product_id;
                              // console.log("サイズ"+ product.product_size);
                              // console.log("リメイク前カラーID" + product.color_id);

                              // リメイク前の商品のカラーIDを取得
                              const productColorId = product.color_id;
                              // リメイク前の画像を表示
                              elem4.src = "./image/product/" + productId + ".jpg" ;
                              elem5.innerHTML = "商品番号：" + productId;
                              // カラーIDを元にカラーコードを取得し要素にセット
                              elem6.style.backgroundColor = getColorCode(productColorId);
                              // カラーIDを元にカラー名を取得し要素にセット
                              elem7.innerHTML = getColorName(productColorId);
                              elem8.innerHTML = product.product_material;
                              elem9.innerHTML = "¥" + product.product_price.toLocaleString();
                              elem10.innerHTML = product.product_name;
                              elem11.innerHTML = "サイズ：" + getProductSize(product.product_size);
                            });
                        })
                        .catch(function(error) {
                            console.log("Error getting documents:product  ", error);
                        });

                        // categoryコレクションの取得
                        db.collection("category").where("category_id", "==", remakeCategory)
                        .get().then(function(querySnapshot) {
                            querySnapshot.forEach(function(doc) {
                              const category = doc.data()
                              // console.log(category);
                            });
                        })
                        .catch(function(error) {
                            console.log("Error getting documents:category  ", error);
                        });


                      });
                    })
                    .catch(err => {
                    console.log('Error getting documents', err);
                    });

                    // カートに入れる関数
                    $('#add_to_cart').click(function() {
                      // color_idからcolor_nameを取得し、cart_infoにいれる
                      var color_id = $('#remake_color').data('color');
                      // categoryコレクションの取得
                      db.collection("color").where("color_id", "==", color_id)
                        .get().then(function(querySnapshot) {
                            querySnapshot.forEach(function(doc) {
                              // 該当商品が入っていれば...
                              if (!in_product_flg) {
                              // 各要素をcart_infoに入れていく
                              var cart_info = {};
                              cart_info.remake_product_id = remake_product_id;
                              cart_info.remake_image = $('#remake_image').attr('src');
                              cart_info.product_color = $('#remake_color').css('background-color');
                              cart_info.product_color_name = doc.data().color_name;
                              cart_info.price = $('#price').text().substr(1).replace(/,/g, '');
                              cart_info.remake_icon = $('#remake_icon').attr('src');
                              cart_info.category_id = $('#remake_icon').attr('src').charAt(17);
                               //sessionはstring型でないと扱えないため、JSONを使用している
                              var cart_submit = JSON.stringify(cart_info);

                              //sessionへ格納する
                              sessionStorage['cart'] = cart_submit;

                                //カート画面へ
                                window.location = "./mycart.php";
                              }
                            });
                        })
                        .catch(function(error) {
                            console.log("Error getting documents:category  ", error);
                        });
                    })

          } else{
          }
      });
</script>
<!-- SHOP HOME画面 -->
<title>ethicable｜SHOP｜リメイク商品名</title>

</head>
  <body id="shop_details">
    <!-- header -->
    <?php include "./tpl/header.html"; ?>

    <!-- main -->
    <main>
        <section>
          <div>
            <!-- リメイク情報表示 -->
            <div>
              <img id="remake_image" alt="リメイク商品画像">
              <div>
                <p>リメイク情報</p>
                <img id="remake_icon" alt="リメイク希望のアイテムアイコン"><span>×</span><span id="remake_color"></span>
              </div>
              <!-- お気に入りアイコン -->
            </div>
            <!-- リメイク前の商品情報表示 -->
            <div class="details_box">
              <p>リメイク前の商品情報</p>
              <div>
                <img id="before_img" alt="リメイク前の商品画像">
                <div>
                  <div>
                    <p id="product_id"></p>
                    <p id="product_size"></p>
                  </div>
                  <p id="product_name"></p>
                  <div>
                    <span id="product_color"></span>
                    <p id="product_color_name"></p>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!-- 素材生地情報表示 -->
          <div class="details_box">
            <p>素材生地</p>
            <div>
              <p id="product_material"></p>
            </div>
          </div>

          <!-- 価格情報表示 -->
          <div>
            <div>
              <div>
                <p>税込価格</p>
                <p id="price"></p>
              </div>
              <!-- カートに遷移するボタン -->
              <p id="add_to_cart"><a id="add_to_cart_btn">カート</a></p>
            </div>
          </div>
        </section>
    </main>