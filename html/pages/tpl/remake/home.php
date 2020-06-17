<?php
    /*
    ページ詳細：リメイクホーム画面
    作成者：小川紗世
    編集者：2020/06/12小川紗世
    */
?>

<!-- REMAKE HOME画面 -->
<title>ethicable｜REMAKE｜HOME画面</title>
  <body id="remake_home">
    <!-- header -->
    <?php include "./tpl/header.html"; ?>

    <!-- main -->
    <main>
        <section>
        <button id="logout" onClick="logout()">logout</button>
        <a href="./shop_home.php">shop</a>
          <div>
            <h2>現在発行中のQRコード</h2>
            <div>
              <ul>
                <li>
                  <a href="#">
                    QRコード表示場所
                  </a>
                </li>
              </ul>
            </div>
            <a href="./remake_corse.php">リメイクする</a>
          </div>

        </section>
        <section>

        </section>
    </main>


