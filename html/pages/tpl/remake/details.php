<?php
    /*
    ページ詳細：リサイクル詳細確認
    作成者：小川紗世
    編集者：2020/06/12小川紗世
    */
?>
<script>

    // GET URLのパラメータ取得
    let arg  = new Object;
    url = location.search.substring(1).split('&');
    
    for(i=0; url[i]; i++) {
        var k = url[i].split('=');
        arg[k[0]] = k[1];
    }
    let product_id = arg.product_id;
    let product = arg.product;
    let color = arg.color;
    let corse_number = arg.corse_number;



    //リサイクルイメージ情報（イメージとカラー）
    db.collection("color").where("color_id", "==", Number(color))
    .get().then(function(querySnapshot) {
        querySnapshot.forEach(function(doc) {
          const color = doc.data()
          //colorの出力
          var elem = document.getElementById("select_color");
          elem.innerHTML = color.color_id+" "+color.color_name;
        });
    })
    .catch(function(error) {
        console.log("Error getting documents: ", error);
    });


    firebase.auth().onAuthStateChanged(function(user) {
      //ログイン状態判別
      if (user) {
        // DB 商品情報読み込み
        //QRで読み取った時の商品ID受け取り

        let citiesRef = db.collection('product').where("product_id", "==", Number(product_id));
        let allCities = citiesRef.get().then(snapshot => {
            snapshot.forEach(doc => {
              const data = doc.data()

              //それぞれの名前を出力する
              //コースの名前
              if(corse_number == 1){
                var elem = document.getElementById("couse_name");
                elem.innerHTML = "ワクワクコース";
              }else if(corse_number == 2){
                var elem = document.getElementById("couse_name");
                elem.innerHTML = "ドキドキコース";
              }

              //商品の名前
              var elem1 = document.getElementById("product_name");
              elem1.innerHTML = data.product_name;

              //ID
              var elem2 = document.getElementById("product_id");
              elem2.innerHTML = data.product_id;

              //素材
              var elem3 = document.getElementById("product_material");
              elem3.innerHTML = data.product_material;

              //説明
              var elem4 = document.getElementById("product_explanation");
              elem4.innerHTML = data.product_explanation;


              //colorの取得
              db.collection("color").where("color_id", "==", data.color_id)
              .get().then(function(querySnapshot) {
                  querySnapshot.forEach(function(doc) {
                    const color = doc.data()
                    //colorの出力
                    var elem = document.getElementById("color_name");
                    elem.innerHTML = color.color_code;
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

              // //部門IDとカテゴリーIDの分割
              // let str = String( data.product_department );
              // let category_id = str.substr( 0, 1 );
              // let department_id = str.substr( 1, 2 );

              // //部門の取得
              // db.collection("department").where("department_id", "==", Number(department_id))
              // .get().then(function(querySnapshot) {
              //     querySnapshot.forEach(function(doc) {
              //       department = doc.data()
              //       //部門名の出力
              //       var elem = document.getElementById("department_name");
              //       elem.innerHTML = department.department_name;
              //     });
              // })
              // .catch(function(error) {
              //     console.log("Error getting documents: ", error);
              // });

              // //カテゴリーの取得
              // db.collection("category").where("category_id", "==", Number(category_id))
              // .get().then(function(querySnapshot) {
              //     querySnapshot.forEach(function(doc) {
              //       const category = doc.data()
              //       //カテゴリーの出力
              //       var elem = document.getElementById("department_name");
              //       elem.innerHTML += " "+category.category_name;
              //     });
              // })
              // .catch(function(error) {
              //     console.log("Error getting documents: ", error);
              // });
            });
          })
          .catch(err => {
            console.log('Error getting documents', err);
          });
      } else{
        location.href = "./index.html"
    }
  });   

</script>
<!-- REMAKE HOME画面 -->
<title>ethicable｜REMAKE｜リサイクル詳細確認</title>

</head>
  <body id="remake_datails">
    <!-- header -->
    <?php include "./tpl/header.html"; ?>

    <!-- main -->
    <main>
        <section>
          <h1>リサイクル詳細確認</h1>
          <div>
              <p>イメージ名
                  <img src="./image/category/<?php  echo($_GET['category']); ?>.png" alt="イメージ画像">
              </p>
              <p>選択カラー</p>
              <p id='select_color'></p>


              <!-- <p>商品ID:000000</p>
              <h2>商品名</h2> -->
              <table>
                  <tr>
                      <th>コース:</th>
                      <td id='couse_name'></td>
                  </tr>
                  <tr>
                      <th>素材情報:</th>
                      <td id='product_name'></td>
                      <!-- <td id='category_name'></td> -->
                  </tr>
                  <tr>
                      <th></th>
                      <td><img src="./image/product/<?php  echo($_GET['product_id']); ?>.jpg" alt="商品画像"></td>
                      <!-- <td id='category_name'></td> -->
                  </tr>
                  <tr>
                      <th></th>
                      <td id='product_id'></td>
                      <!-- <td id='category_name'></td> -->
                  </tr>
                  <tr>
                      <th></th>
                      <td id='size_name'></td>
                      <!-- <td id='category_name'></td> -->
                  </tr>
                  <tr>
                      <th></th>
                      <td id='color_name'></td>
                      <!-- <td id='category_name'></td> -->
                  </tr>
                  <tr>
                      <th></th>
                      <td id='size_name'></td>
                      <!-- <td id='category_name'></td> -->
                  </tr>
                  <tr>
                      <th></th>
                      <td id='product_material'></td>
                      <!-- <td id='category_name'></td> -->
                  </tr>
                  <tr>
                      <th></th>
                      <td id='product_explanation'></td>
                      <!-- <td id='category_name'></td> -->
                  </tr>

              </table>
          </div>


          
          <div>
              <input type="button" value="戻る">
              <input type="button" value="QRコード発行">
          </div>
        </section>
    </main>
