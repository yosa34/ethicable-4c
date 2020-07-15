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
  firebase.auth().onAuthStateChanged(function(user) {
    //ログイン状態判別
    if (user) {
        // ユーザの所持ポイントを取得し表示する
        db.collection("point").where("user_id", "==", user.uid).get().then((querySnapshot) => {
            querySnapshot.forEach((doc) => {
              var elem1 = document.getElementById("points");
              elem1.innerHTML= doc.data().point_amount+"<b>pt</b>";
        });
        })
        .catch( (error) => {
          console.log(`データの取得に失敗しました (${error})`);
        });
    }else{
        location.href = "./index.html"
    }
    });
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
                <p id="points"></p>
            </div>
        </section>

        <section>
            <div>
                <p>履歴</p>
                <ul>
                    <li><a href="user_remake_history.php?corse=1">ドキドキコース履歴</a></li>
                    <li><a href="user_remake_history.php?corse=2">ワクワクコース履歴</a></li>
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

