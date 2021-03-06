<?php
    /*
    ページ詳細：リメイクボックス処理画面
    作成者：岸本蓮
    編集者：2020/07/03岸本蓮
    */
?>

<!-- REMAKE BOX 画面 -->
<title>ethicable｜REMAKE BOX｜リメイクボックス画面</title>

</head>
<script src="https://rawgit.com/sitepoint-editors/jsqrcode/master/src/qr_packed.js"></script>
<body id="qr_reader">
  <!-- main -->
  <main>
      <section>
        <h1>リメイク BOX</h1>
        <p>カメラを起動してリメイク依頼QRコードをかざして商品をリメイクBOXへ入れてください。</p>
        <form name="myform" method="post">
            <input name="date" type=text size=50 placeholder="Tracking Code" class="qrcode-text">
            <label class="qrcode-text-btn" for="file_upload">
            <p>カメラ起動</p>
            <input type="button" id="a" onclick="b();">
            <input id="file_upload" type=file accept="image/*" capture=environment onclick="return showQRIntro();" onchange="openQRCamera(this);" tabindex=-1>
            </label>
            <input class="hidden" type=text name="cn">
        </form>
      </section>
  </main>
</body>

<script>

function button(){
  document.getElementById("file_upload").click();
}

function openQRCamera(node) {
  var reader = new FileReader();

  reader.onload = function(res) {
    node.value = "";
    qrcode.callback = function(res) {
      if(res instanceof Error) {
        alert("No QR code found. Please make sure the QR code is within the camera's frame and try again.");
      } else {
        node.parentNode.previousElementSibling.value = res;
        remake_product_id = parseInt(res);
        
        //リメイクボックスで読み取ったremake_product_idを元にdate_qr_readに現在時刻を入れる
        db.collection('remake').where('remake_product_id', '==', remake_product_id).get().then(querySnapshot => {
          querySnapshot.forEach(docs => {
              var dalete_product_id = docs.id;
              db.collection("remake").doc(dalete_product_id).update({
                  date_qr_read: firebase.firestore.Timestamp.fromDate(new Date())
              })
              .then(() => {
              })
              .catch((error) => {
              });
          });
        });
        alert("読み取り成功しました");
      }
    };
    qrcode.decode(reader.result);
  };
  reader.readAsDataURL(node.files[0]);
  //PHPに送るデータをJSON形式で記述
  qr = node.parentNode.previousElementSibling.value;
}
function showQRIntro() {
  return confirm("QRコードを撮影してください");
}
</script>
