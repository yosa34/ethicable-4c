<?php
    /*
    ページ詳細：マイページ
    作成者：小川紗世
    編集者：2020/06/12小川紗世
    */
?>

<script>

  //ログアウト処理
  function logout(){
      firebase.auth().signOut();
  }
</script>


<!-- SHOP HOME画面 -->
<title>ethicable｜マイページ</title>

</head>
  <body id="mypage">
    <!-- header -->
    <?php include "./tpl/header.html"; ?>

    <!-- main -->
    <main>
        <div>
            <p>コース使用履歴</p>
        </div>
        <section>
            <ul>
                <li></li>
            </ul>
        </section>
    </main>

