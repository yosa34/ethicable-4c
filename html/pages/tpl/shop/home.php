<?php
    /*
    ページ詳細：Login画面
    作成者：小川紗世
    編集者：2020/06/11小川紗世
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
    <main>
        <section>
        </section>
    </main>
