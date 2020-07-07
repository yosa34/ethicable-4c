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
        <section>
        </section>
    </main>
