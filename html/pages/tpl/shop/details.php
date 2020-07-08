<?php
    /*
    ページ詳細：商品詳細画面
    作成者：小川紗世
    編集者：2020/06/27粟津由香→2020/07/07三輪謙登
    */
?>
<script src="./js/shop.js"></script>
<script>
  firebase.auth().onAuthStateChanged(function(user) {
          if (user) {
            console.log(user.uid);

            /* ToDo
               本来はURLに含まれたremake_product_idを取り出してそれを元に検索・データの取得処理を行いますが。
               remakeコレクションとstocksコレクションの値が合致しないのでエラーになります。
               なので一旦任意のremake_product_idを指定しています。
               コレクションの修正が完了次第下記のコードに変更する！！！

            // GET URLのパラメータ取得(remake_product_idが含まれている)
            // url = location.search.substring(1).split('=');
            // var get_remake_product_id;
            // get_remake_product_id = url[1];
            // console.log(url[0]+"=>"+url[1]);
          */
            var remake_product_id = 1
            var product_id = 414443;
            // remakeコレクションの情報取得
            let remakeRef = db.collection('remake').where("remake_product_id", "==", Number(remake_product_id));
                  let allRemake = remakeRef.get().then(snapshot => {
                      snapshot.forEach(doc => {
                        const data = doc.data()
                        console.log(data);
                        console.log(doc.id);


                        // リメイク商品情報を取得し格納
                        const remakeCategory = doc.data().category_id;
                        console.log(remakeCategory);
                        // const remakeColor = doc.data().color_id;

                        // リメイク商品情報
                        var elem1 = document.getElementById("remake_image");
                        var elem2 = document.getElementById("remake_icon");
                        var elem3 = document.getElementById("remake_color");
                        elem3.style.backgroundColor = getColorCode(doc.data().color_id);

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

                        // db.collection("stocks").where("remake_product_id", "==", remake_product_id)
                        db.collection("stocks").where("remake_product_id", "==", "DSsswyu1p9SklvMstgiu")
                        .get().then(function(querySnapshot){
                            querySnapshot.forEach(function(doc) {
                              const stocks = doc.data()
                              console.log(stocks);

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
                              console.log("リメイク前カラーID" + product.color_id);
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
                              console.log(category);
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
                      // 各要素をcart_infoに入れていく
                      var cart_info = {};
                      cart_info.remake_image = $('#remake_image').attr('src');
                      cart_info.product_color = $('#product_color').css('background-color');
                      cart_info.product_color_name =$('#product_color_name').text();
                      cart_info.price = $('#price').text().substr(1);
                      cart_info.remake_icon = $('#remake_icon').attr('src');
                      cart_info.category_id = $('#remake_icon').attr('src').charAt(17);

                      // sessionはstring型でないと扱えないため、JSONを使用している
                      var cart_submit = JSON.stringify(cart_info);

                      // sessionへ格納する
                      sessionStorage['cart'] = cart_submit;

                      // カート画面へ
                      window.location = "./mycart.php";
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
          <!-- 取り敢えずstyleを記述しているだけなのであとで変更 -->
          <img id="remake_image" alt="リメイク商品画像" style="width: 200px;">
          <div>
            <p>リメイク情報</p>
            <img id="remake_icon" alt="リメイク希望のアイテムアイコン" style="width: 40px;"><span>×</span><span id="remake_color" style="width: 50px; height: 50px; display: block;"></span>
            <!-- お気に入りアイコン -->
            <!-- <img src="" alt="お気に入り"> -->
          </div>

          <!-- リメイク前の商品情報表示 -->
          <!-- 取り敢えずstyleを記述しているだけなのであとで変更 -->
          <div>
            <p>リメイク前の商品情報</p>
            <img id="before_img" alt="リメイク前の商品画像" style="width: 50px;">
            <p id="product_id"></p>
            <p id="product_name"></p>
            <p id="product_size"></p>
            <span id="product_color" style="width: 50px; height: 50px; display: block;"></span>
            <p id="product_color_name"></p>
          </div>

          <!-- 素材生地情報表示 -->
          <div>
             <p>素材生地</p>
             <div id="product_material"></div>
          </div>

          <!-- カテゴリ絞り込みメニュー -->
          <div>
            <p id="category_menu"></p>
          </div>

          <!-- 価格情報表示 -->
          <div>
            <p>税込価格</p>
            <p id="price"></p>
            <!-- カートに遷移するボタン -->
            <button id="add_to_cart">カート</button>
        </section>
    </main>