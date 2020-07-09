<?php
    /*
    ページ詳細：購入履歴
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
<title>ethicable｜マイページ｜購入履歴</title>

</head>
  <body id="purchase_history">
    <!-- header -->
    <?php include "./tpl/header.html"; ?>

    <!-- main -->
    <main>
        <div>
            <p>購入履歴</p>
        </div>
        <section>
            <ul>
                <li>
                    <div>
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
                        </div>
                    </div>
                </li>
            </ul>
        </section>
    </main>

