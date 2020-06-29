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



function Confirmation() {

    // product要素を取得
    var category = document.getElementsByName( "category" ) ;
    // 選択状態の値を取得
    for ( var a="", i=category.length; i--; ) {
      if ( category[i].checked ) {
        var category_select = category[i].value ;
        break ;
      }
    }
    
    // color要素を取得
    var color = document.getElementsByName( "color" ) ;
    // 選択状態の値を取得
    for ( var a="", i=color.length; i--; ) {
      if ( color[i].checked ) {
        var color_select = color[i].value ;
        break ;
      }
    }

    // GET URLのパラメータ取得
    var arg  = new Object;
    url = location.search.substring(1).split('&');
    
    for(i=0; url[i]; i++) {
        var k = url[i].split('=');
        arg[k[0]] = k[1];
    }
    var product_id = arg.product_id;
    let corse_number = arg.corse_number;

    //ページ遷移
    var next_page = "./remake_details.php";
    location.href = next_page + "?product_id=" + product_id + "&category=" + category_select + "&color=" + color_select + "&corse_number=" + corse_number;


}
  


