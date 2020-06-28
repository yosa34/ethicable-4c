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

<script>

firebase.auth().onAuthStateChanged(function(user) {

  //住所が入力されていなかった時、ボタンを押せないように設定
  let citiesRef = db.collection('user').where("address", "==", null);
    let allCities = citiesRef.get().then(snapshot => {
        snapshot.forEach(doc => {
          const data = doc.data()
          //liを取得しid（none_click）を付与する
          var list = document.getElementById("corse_list");
          list.children[1].id = 'none_click';

          // お腹減った
          // 選択できない時のコース情報の文字の代入
          // list.children[1].insertAdjacentHTML('beforeend', 
          //   '<a href="./mypage.php">マイページへ移動</a>'
          // );
          
        });
      })
      .catch(err => {
        console.log('Error getting documents', err);
      });

});

</script>

<!-- REMAKE HOME画面 -->
<title>ethicable｜REMAKE｜コース選択</title>

</head>
  <body id="remake_corse">

    <!-- header -->
    <?php include "./tpl/header.html"; ?>
    <main>
        <section>
<<<<<<< HEAD
=======
          <h1>コース選択</h1>
          <article>
            <ul id='corse_list'>
              <li>
                <h2>ワクワクコース</h2>
                <p>
                  リサイクルする衣類を回収ボックスに入れて、<br>エコポイントを獲得することができるコースです。<br>
                  <b>＊出来上がったリサイクル品はショップサイトで販売されます。</b>
                </p>
              </li>
              <li>
                <h2>ドキドキコース</h2>
                <p>
                  リサイクルするイメージやカラーを選択し<br>出来上がったリサイクル品をご自宅にお届けするコースです。
                </p>
              </li>
            </ul>
          </article>
          <p>QRコードをスキャンして商品情報を読み取ることができます。</p>
          <input type="button" value="カメラを起動する">

          <form name="myform" method="post">
            <input name="date" type=text size=50 class=qrcode-text>
              <label class=qrcode-text-btn for="file_upload">
                <input id="file_upload" type=file accept="image/*" capture=environment onclick="return showQRIntro();" onchange="openQRCamera(this);" tabindex=-1>
              </label>
              <input class="hidden" type=text name="cn">
              <!-- hiddenする予定 -->
            <input type="submit" value="次ページ">
          </form>

>>>>>>> fcc0ddc2b3f698411e15672717697b71365ce991
        </section>
    </main>

