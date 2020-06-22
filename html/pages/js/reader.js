function openQRCamera(node) {
    var reader = new FileReader();
    var next_page = "./remake_data.php";
  
    reader.onload = function() {
      node.value = "";
      qrcode.callback = function(res) {
        if(res instanceof Error) {
          alert("No QR code found. Please make sure the QR code is within the camera's frame and try again.");
        } else {
          node.parentNode.previousElementSibling.value = res;
          product_id = selectfirebase(res);
          console.log(product_id);
  
          location.href = next_page+"?product_id=" + product_id;
        }
      };
      qrcode.decode(reader.result);
    };
    reader.readAsDataURL(node.files[0]);
    //PHPに送るデータをJSON形式で記述
    qr = node.parentNode.previousElementSibling.value;
    //ajaxで読み出し
    $.ajax({
          type: 'GET',
          url: './remake_data.php',
          data: {"item": qr},
            // success: function(html){
            //   成功したらページ遷移
            //   window.location.href = './send.php';
            // }
    });
  }
  function checkText(){
    var x = document.myform.elements['cn'];
    x.value = qr;
    document.myform.action = "./remake_data.php";
  }
  function showQRIntro() {
    return confirm("QRコードを撮影してください");
  }
  
  function selectfirebase(product_id){
    //テストデータ
    // product_id = "371-133176-07-005-000[52-13]";
    var str = product_id.split('-');
    // console.log(str[1]);
    return str[1];
  }
  