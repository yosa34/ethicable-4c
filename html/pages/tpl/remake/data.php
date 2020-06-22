<?php
    /*
    ページ詳細：読み取りデータの確認
    作成者：小川紗世
    編集者：2020/06/12小川紗世
    */
?>
<!-- QRコード用 -->
<script src="https://rawgit.com/sitepoint-editors/jsqrcode/master/src/qr_packed.js"></script>
<script type="text/javascript" src="./js/reader.js"></script>

<script>

  // GET URLのパラメータ取得
  // QRで読み取った時の商品ID受け取り
  let arg  = new Object;
  url = location.search.substring(1).split('&');
  
  for(i=0; url[i]; i++) {
      var k = url[i].split('=');
      arg[k[0]] = k[1];
  }
  let product_id = arg.product_id;


  firebase.auth().onAuthStateChanged(function(user) {
      //ログイン状態判別
      if (user) {
        // DB 商品情報読み込み
        let citiesRef = db.collection('product').where("product_id", "==", Number(product_id));
        let allCities = citiesRef.get().then(snapshot => {
            snapshot.forEach(doc => {
              const data = doc.data()

              //colorの取得
              db.collection("color").where("color_id", "==", data.color_id)
              .get().then(function(querySnapshot) {
                  querySnapshot.forEach(function(doc) {
                    const color = doc.data()
                    //colorの出力
                    var elem = document.getElementById("color_name");

                    elem.innerHTML = color.color_id+" "+color.color_name;
                  });
              })
              .catch(function(error) {
                  console.log("Error getting documents: ", error);
              });

              //サイズの取得
              db.collection("size").where("product_size", "==", data.product_size)
              .get().then(function(querySnapshot) {
                  querySnapshot.forEach(function(doc) {
                    const size = doc.data()
                    //サイズの取得
                    var elem = document.getElementById("size_name");
                    elem.innerHTML = size.size_name;
                  });
              })
              .catch(function(error) {
                  console.log("Error getting documents: ", error);
              });

              //部門IDとカテゴリーIDの分割
              let str = String( data.product_department );
              let category_id = str.substr( 0, 1 );
              let department_id = str.substr( 1, 2 );

              //部門の取得
              db.collection("department").where("department_id", "==", Number(department_id))
              .get().then(function(querySnapshot) {
                  querySnapshot.forEach(function(doc) {
                    department = doc.data()
                    //部門名の出力
                    var elem = document.getElementById("department_name");
                    elem.innerHTML = department.department_name;
                  });
              })
              .catch(function(error) {
                  console.log("Error getting documents: ", error);
              });

              //カテゴリーの取得
              db.collection("category").where("category_id", "==", Number(category_id))
              .get().then(function(querySnapshot) {
                  querySnapshot.forEach(function(doc) {
                    const category = doc.data()
                    //カテゴリーの出力
                    var elem = document.getElementById("department_name");
                    elem.innerHTML += " "+category.category_name;
                  });
              })
              .catch(function(error) {
                  console.log("Error getting documents: ", error);
              });

            });
          })
          .catch(err => {
            console.log('Error getting documents', err);
          });
      } else{
        location.href = "./index.html"
    }
  });   

  function remake_select(){
    var next_page = "./remake_select.php";
    location.href = next_page+"?product_id=" + product_id;

  }


</script>


<!-- REMAKE HOME画面 -->
<title>ethicable｜REMAKE｜読み取りデータの確認</title>

</head>
  <body id="remake_data">
    <!-- header -->
    <?php include "./tpl/header.html"; ?>

    <!-- main -->
    <main>
        <section>
            <h1>読み取りデータの確認</h1>
            <div>
                <p>
                    <img src="./image/product/<?php  echo($_GET['product_id']); ?>.jpg" alt="商品画像">
                </p>
                <p>商品ID:000000</p>
                <h2>商品名</h2>
                <table>
                    <tr>
                        <th>カラー:</th>
                        <td id='color_name'></td>
                    </tr>
                    <tr>
                        <th>サイズ:</th>
                        <td id='size_name'></td>
                    </tr>
                    <tr>
                        <th>部門:</th>
                        <td id='department_name'></td>
                        <!-- <td id='category_name'></td> -->
                    </tr>
                </table>
            </div>
            <div>
                <input type="button" value="戻る">
                <input type="button" onclick="remake_select()" value="リメイク開始">
            </div>
        </section>
    </main>
