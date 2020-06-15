<?php
    /*
    ページ詳細：商品ホーム画面
    作成者：小川紗世
    編集者：2020/06/12小川紗世
    */
?>

<script>

    firebase.auth().onAuthStateChanged(function(user) {
        if (user) {
          console.log(user.uid);
        } else{
        }
    });

</script>
<!-- SHOP HOME画面 -->
<title>ethicable｜SHOP｜HOME画面</title>

</head>
  <body id="shop_home">
    <!-- header -->
    <?php include "./tpl/header.html"; ?>

    <!-- main -->
    <main>
        <section>
        </section>
    </main>
