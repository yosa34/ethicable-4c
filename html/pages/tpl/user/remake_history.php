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
<title>ethicable｜マイページ｜コース使用履歴</title>

</head>
  <body id="remake_history">
    <!-- header -->
    <?php include "./tpl/header.html"; ?>

    <!-- main -->
    <main>
        <div>
            <p>コース使用履歴</p>
        </div>
        <p>コース変更：
            <select name="course">
                <option value="1">ドキドキ</option>
                <option value="2">ワクワク</option>
            </select>
        </p>
        <section>
            <ul>
                <li></li>
            </ul>
        </section>
    </main>

