<?php
    /*
    ページ詳細：QRコードの生成
    作成者：小川紗世
    編集者：2020/07/03 岸本蓮
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
      //http://localhost/ethicable-4c/html/pages/remake_details.php?remake_product_id=3
      // GET URLのパラメータ取得
      let arg  = new Object;
      url = location.search.substring(1).split('&');
      for(i=0; url[i]; i++) {
        var k = url[i].split('=');
        arg[k[0]] = k[1];
      }
      let remake_product_id = arg.remake_product_id;
      console.log(remake_product_id);

      var qr_display = document.getElementById("qr_display");
      qr_display.insertAdjacentHTML("beforeend","<img src='https://chart.apis.google.com/chart?chs=150x150&cht=qr&chl="+remake_product_id+"' alt='QRコード'>");
    }else{
      location.href = "./index.html"
    }
  });
</script>

<!-- REMAKE HOME画面 -->
<title>ethicable｜REMAKE｜QRコードの生成</title>

</head>
  <body id="remake_qr_add">
    <!-- header -->
    <?php include "./tpl/header.html"; ?>

    <!-- main -->
    <main>
        <section>
          <h1>QRコードの生成</h1>
          <div id="qr_display">
            
          </div>
          <p>ホームへ戻っても、QRコードを確認することができます。</p>
          <p><a href="">ホームへ戻る</a></p>
        </section>
    </main>
