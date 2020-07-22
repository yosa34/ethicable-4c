<?php
    /*
    ページ詳細：コース選択画面
    作成者：小川紗世
    編集者：2020/06/12小川紗世
    */
?>

<!-- QRコード用 -->
<script src="https://rawgit.com/sitepoint-editors/jsqrcode/master/src/qr_packed.js"></script>
<script type="text/javascript" src="./js/reader.js"></script>

<!-- REMAKE HOME画面 -->
<title>ethicable｜REMAKE｜コース選択</title>

</head>
  <body id="remake_corse">

    <!-- header -->
    <?php include "./tpl/header.html"; ?>
    <main>
        <section>
          <h1>コース選択</h1>
          <article>
            <ul id='corse_list'>
              <li value="2" id="active">
                <h2>ワクワクコース</h2>
                <p>
                  リメイクする衣類を回収ボックスに入れて、<br>エコポイントを獲得することができるコースです。<br>
                  <b>＊出来上がったリメイク品はショップサイトで販売されます。</b>
                </p>
              </li>
              <li value="1">
                <h2>ドキドキコース</h2>
                <p>
                  リメイクするイメージやカラーを選択し<br>出来上がったリメイク品をご自宅にお届けするコースです。
                </p>
              </li>
            </ul>
          </article>
          <p>QRコードをスキャンして商品情報を読み取ることができます。</p>

          <form name="myform" method="post">
            <input name="date" type=text size=50 class=qrcode-text>
              <label class=qrcode-text-btn for="file_upload">

                <input type="button" onclick="qrclick()" value="カメラを起動する">
                <input id="file_upload" type=file accept="image/*" capture=environment onclick="return showQRIntro();" onchange="openQRCamera(this);" tabindex=-1>
              
              </label>
              <input class="hidden" type=text name="cn">
          </form>
        </section>
    </main>


