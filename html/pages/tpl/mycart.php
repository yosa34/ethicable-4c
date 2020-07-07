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
            var cart = JSON.parse(sessionStorage.cart);
            console.log(cart);
            $('section').append('<ul class="cart"><li id="cart_item"></li></ul>');
            // cart_itemにデータを入れ込んでいく！！！
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
        <p>合計<b>10,500</b>円</p>
        <input type="button" value="購入手続き">
    </main>
