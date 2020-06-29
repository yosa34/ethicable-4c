
// ロード後に走らせたい処理をここの内部で記述
$(function () {
    //ワクワクコースの時リサイクル、カラー選択項目を非表示にする
    if(corse_number == 1){
        $(".dokidoki_select").remove();
    }
});

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
        });
    })
    .catch(err => {
        console.log('Error getting documents', err);
    });
    } else{
        location.href = "./index.html"
    }
});   