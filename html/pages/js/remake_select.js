firebase.auth().onAuthStateChanged(function(user) {
    //ログイン状態判別
    if (user) {
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
  


