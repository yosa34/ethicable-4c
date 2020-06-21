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
        <section>
            <div>
                <p>エコポイント</p>
                <p>0<b>pt</b></p>
            </div>
        </section>

        <section>
            <div>
                <p>履歴</p>
                <ul>
                    <li><a href="user_remake_history.php?corse=1">ドキドキコース履歴</a></li>
                    <li><a href="user_remake_history.php?corse=0">ワクワクコース履歴</a></li>
                    <li><a href="user_purchase_history.php">購入履歴</a></li>
                </ul>
            </div>
            <div>
                <p>設定</p>
                <ul>
                    <li><a href="user_setting_change.php">個人情報設定変更</a></li>
                </ul>
            </div>
            <div>
                <p>サイト情報</p>
                <ul>
                    <li><a href="#">プライバシーポリシー</a></li>
                </ul>
            </div>
            <p onClick="logout()">ログアウト</p>
        </section>
    </main>

