firebase.auth().onAuthStateChanged(function(user) {

    // ログイン状態のユーザー情報を取得する
    let citiesRef = db.collection('user').where("user_id", "==", user.uid);
    let allCities = citiesRef.get().then(snapshot => {
          snapshot.forEach(doc => {
            const data = doc.data()
            //住所が入力されていなかった時、ボタンを押せないように設定
              if (data.address == null) {
                //liを取得しid（none_click）を付与する
                var list = document.getElementById("corse_list");
                dokidoki_corse = list.children[1];
                dokidoki_corse.id = 'none_click';    
                // 選択できない時のコース情報の文字の代入
                dokidoki_corse.innerHTML = 
                "<h2>ドキドキコース</h2>"+
                "<p>「クレジット情報」または「住所情報」が入力されていないのでこのコースを選択することはできません。</br>"+
                "<b><a href='#'>マイページへ移動</a></b></p>";
                }
            });
        })
        .catch(err => {
          console.log('Error getting documents', err);
        });
  });
  
  function qrclick(){
    document.getElementById("file_upload").click();
  }
  
  $(function(){
    // クリックされたコースにstyleを振りアクティブにさせる。
      $('#corse_list li').click(function(){
          //削除
        //   $('#corse_list li').removeAttr('id');
          var elm = document.getElementById("active");
          elm.removeAttribute("id");
        //   $('p').removeId('id');
          //styleを振る
          $(this).attr('id', 'active');
       });
  });
  
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
  
          var corse_number = document.getElementById("active").value;

          location.href = next_page+"?product_id=" + product_id +"&corse_number=" + corse_number;
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
  