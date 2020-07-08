<?php
    /*
    ページ詳細：カート画面
    作成者：小川紗世
    編集者：2020/07/03三輪謙登
    */
?>

<script>

    firebase.auth().onAuthStateChanged(function(user) {
        if (user) {
          console.log(user.uid);
          if(sessionStorage.cart){
            $('section').append('<ul class="cart"><li id="items" class="cart_items"></li></ul>');
            // JSON形式でsessionに保存されているため、JSON.parseをしてJavaScriptで扱えるようにする
            var cart = JSON.parse(sessionStorage.cart);

            console.log(cart);

            var category_id = cart.category_id;
            var category_collection = db.collection('category');
            category_collection.orderBy('category_id').onSnapshot(function(snapshot) {
                snapshot.docChanges().forEach(function (change) {
                    //category_idが入った配列にあるcategory_idとcategoryコレクションの中のcategory_idが同じならば...
                    if (change.doc.data().category_id == category_id) {
                      // カテゴリー名を取得
                        category_name= change.doc.data().category_name;

                        // cart_itemにデータを入れ込んでいく
                        $('#items').append(
                          '<div class="cart_items_item">'+
                          '<img src="' + cart.remake_image + '" alt="リメイクイメージ">'+
                          '<p>' + '部門(カテゴリー)：' + '<img src="' + cart.remake_icon + '" alt="リメイクアイコン">' + '<p>' + category_name + '</p>' + '</p>'+
                          '<p>' + 'カラー：' + '<div style="background-color: ' + cart.product_color + ';width: 100px;height:100px;border: 1px solid black;"></div>' + cart.product_color_name + '</p>'+
                          '<p>' + '価格' + cart.price + '円' + '</p>'+
                          '</div> '
                          );
                    }
                });
            });
          } else {
            $('section').append(
            '<div>'+
              '<p>カートに商品が入っていません</p>'+
              '<p>是非お買い物をお楽しみください。ご利用をお待ちしております。</p>'+
            '</div>' +
            '<button type="button" id="goShop">ショッピングページへ</button>');

            $('#goShop').click(function() {
              window.location.href='./shop_home.php' ;
            });
          }
        } else{
        }
    });

</script>
<!-- SHOP HOME画面 -->
<title>ethicable｜カート</title>

</head>
  <body id="cart">
    <!-- header -->
    <?php include "./tpl/header.html"; ?>

    <!-- main -->
    <main>
      <h1>カート</h1>
        <section>
          <ul>
              <li>
                  <p><img src="./image/product/414443.jpg" alt=""></p>
                  <div>
                      <dl>
                          <dt>部門(カテゴリー)：</dt>
                          <dd><img src="./image/category/1.png" alt=""><p>アウター</p></dd>
                      </dl>
                      <dl>
                          <dt>カラー：</dt>
                          <dd><span></span><p>GREY</p></dd>
                      </dl>
                      <p>価格：4,500円</p>
                      <p>削除</p>
                  </div>
              </li>
          </ul>
          <div>
            <dl>
              <dt>小計<span>(2商品)</span></dt>
              <dd>9,000円</dd>
            </dl>
            <dl>
              <dt>送料</dt>
              <dd>1,500円</dd>
            </dl>
          </div>
          <dl>
            <dt>獲得予定</dt>
            <dd>253ポイント(円相当)</dd>
          </dl>
        </section>
        <!-- テスト用session削除ボタン -->
        <button onClick="window.sessionStorage.clear();">sessionクリア</button>
        <p>合計<b>10,500</b>円</p>
        <input type="button" value="購入手続き">
    </main>
