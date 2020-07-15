<?php
    /*
    ページ詳細：リメイクショップホーム画面
    作成者：小川紗世
    編集者：2020/07/06小川紗世
    */
?>
<script src="./js/shop.js"></script>
<script src="./js/function.js"></script>
<script>

    // GET URLのパラメータ取得
    let arg  = new Object;
    url = location.search.substring(1).split('&');

    for(i=0; url[i]; i++) {
        var k = url[i].split('=');
        arg[k[0]] = k[1];
    }
    let remake_product_id = Number(arg.remake_product_id);


    //受け取ったリメイクIDにてリメイク情報を取得する
    let citiesRef = db.collection('remake').where("remake_product_id", "==", remake_product_id);
    let allCities = citiesRef.get().then(snapshot => {
        snapshot.forEach(doc => {
            const data = doc.data()

            //リメイクID
            var elem = document.getElementById("remake_product_id");
            elem.innerHTML = remake_product_id;

            //コース名
            var couse_name = getCouseName(data.course_id);
            var elem = document.getElementById("couse_name");
            elem.innerHTML = couse_name;

            //画像出力
            var product_img = data.product_id;
            var img = "<img src='./image/product/" + product_img + ".jpg'>";
            var elem = document.getElementById("product_img");
            elem.insertAdjacentHTML('afterbegin', img);

            //商品ID
            var elem = document.getElementById("product_id");
            elem.insertAdjacentHTML('beforeend', data.product_id);

            //商品情報の取得
            db.collection("product").where("product_id", "==", data.product_id)
            .get().then(function(querySnapshot) {
                querySnapshot.forEach(function(doc) {
                const productData = doc.data()
                //サイズの取得
                var elem = document.getElementById("product_size");
                elem.insertAdjacentHTML('beforeend', getProductSize(productData.product_size));
                //名前の取得
                var elem = document.getElementById("product_name");
                elem.insertAdjacentHTML('beforeend', productData.product_name);
                });
            })
            .catch(function(error) {
                console.log("Error getting documents: ", error);
            });



            //ドキドキコース
            if(data.course_id == 1){
                //カラー出力
                var elem = document.getElementById("color_select");
                // console.log(data.color_id);
                elem.innerHTML = "<label style='width: 80px; margin-bottom: 1%; display:inline-block' for='"+data.color_id+"'><span style='width: 50px; height: 50px; margin: 0 auto; display: block; background-color:"+ getColorCode(data.color_id) + ";'></span><p style='text-align: center; padding: 10px;'>" + getColorCode(data.color_id) + "</p><input style='margin-left: 44%;' type='radio' name='color' id='"+data.color_id+"' value='"+data.color_id+"' checked></label>";

                // elem.innerHTML = getColorCode(data.color_id);
                //カテゴリー名出力
                let citiesRef = db.collection('category').where("category_id", "==", data.category_id);
                let allCities = citiesRef.get().then(snapshot => {
                snapshot.forEach(doc => {
                    const data = doc.data()
                    var elem = document.getElementById("category_select");
                    elem.innerHTML= data.category_name;
                    })
                });

            }


            //ワクワクコース
            if(data.course_id == 2){

                //カラー一覧情報の取得
                let result = "<div style='display: flex; flex-wrap: wrap;'>";
                //Promiseで最初に処理を走らせてresolve(result)で値を渡す。
                //成功時にthenに飛ばす感じ。
                var selectColor = new Promise((resolve,reject) => {
                    db.collection('color').get().then(snapshot => {
                        snapshot.forEach(doc => {
                            const data = doc.data();
                            var code = data.color_code;
                            var name = data.color_name;
                            var id   = data.color_id;
                            result +="<label style='width: 80px; margin-bottom: 1%; display:inline-block' for='"+id+"'><span style='width: 50px; height: 50px; margin: 0 auto; display: block; background-color:"+ code + ";'></span><p style='text-align: center; padding: 10px;'>" + name + "</p><input style='margin-left: 44%;' type='radio' name='color' id='"+id+"' value='"+id+"'></label>";
                        })
                        resolve(result);
                    });
                });
                selectColor.then((result) => {
                    result += "</div>";
                    var elem = document.getElementById("color_select");
                    elem.innerHTML = result;
                })

                //一覧情報の取得
                let result2 = "<select name='category' id='select_category'>";
                //Promiseで最初に処理を走らせてresolve(result)で値を渡す。
                //成功時にthenに飛ばす感じ。
                var selectColor = new Promise((resolve,reject) => {
                    db.collection('category').get().then(snapshot => {
                        snapshot.forEach(doc => {
                            const data = doc.data();
                            var name = data.category_name;
                            var id = data.category_id
                            result2 +="<option value='"+id+"'>"+name+"</option>";
                        })
                        resolve(result2);
                    });
                });
                selectColor.then((result) => {
                    result2 += "</div>";
                    var elem = document.getElementById("category_select");
                    elem.innerHTML = result2;
                })
            }
            
        })
    });

    function Complete(){

        db.collection('remake').where("remake_product_id", "==", remake_product_id)
        .get().then(snapshot => {
            snapshot.forEach(doc => {
                const dataId = doc.id
                const data = doc.data()
                //ドキドキコース
                if(data.course_id == 1){
                    //現時間を登録する
                    db.collection("remake").doc(dataId).update({
                        remake_complete:firebase.firestore.FieldValue.serverTimestamp(),
                    })
                    .catch(function(error) {
                        console.error("Error adding document: ", error);
                    });
                }
                
                //ワクワクコース
                if(data.course_id == 2){
                    //選択カテゴリーの取得
                    var category_id = document.getElementById("select_category").value;

                    //選択カラーの取得
                    var color = document.getElementsByName( "color" ) ;
                    // 選択状態の値を取得
                    for ( var a="", i=color.length; i--; ) {
                        if ( color[i].checked ) {
                            var color_select = color[i].value ;
                            break ;
                        }
                    }

                    //remake登録
                    db.collection("remake").doc(dataId).update({
                        category_id:Number(category_id),
                        color_id:Number(color_select),
                        remake_complete:firebase.firestore.FieldValue.serverTimestamp(),
                    })
                    .catch(function(error) {
                        console.error("Error adding document: ", error);
                    });

                    //stocksの件数を取得
                    db.collection('stocks').get().then(snapshot => {
                        var size = snapshot.size;
                        size = size + 1;

                        //stocksに新しいデータを保存
                        db.collection("stocks").add({
                            quantity: "1",
                            remake_image: getImageUrl(remake_product_id),
                            remake_product_id:remake_product_id,
                            stock_id:size,
                            stocks_time:firebase.firestore.FieldValue.serverTimestamp(),
                        })
                    })
                }

            });
        });

        //選択されたファイル画像をstorageに保存する
        var files = document.getElementById('filesend').files;
        var image = files[0];
        var storageRef = firebase.storage().ref().child(remake_product_id+".jpg");
            storageRef.put(image).then(function(snapshot) {
            alert('アップロードしました');
        });
        }
</script>

<!-- SHOP HOME画面 -->
<title>ethicable｜リメイクショップ｜リメイク依頼詳細</title>

</head>
  <body id="remake_shop_details">
    <!-- header -->
    <!-- main -->
    <main>
        <p><a href="./remake_shop_home.php">リメイク依頼一覧に戻る</a></p>
        <p>依頼日：0000年00月00日</p>
        <p>1行ごとに色を変える</p>
        <section>
            <p>依頼内容</p>
            <div>
                <dl>
                    <dt>リメイクID：</dt>
                    <dd id='remake_product_id'></dd>
                </dl>
                <dl>
                    <dt>コースID：</dt>
                    <dd id="couse_name"></dd>
                </dl>
                <dl>
                    <dt>商品：</dt>
                    <dd id="product_img">
                        <div>
                            <div>
                                <p id="product_id">商品ID:</p>
                                <p id="product_size">サイズ:</p>
                            </div>
                            <p id="product_name">商品名:</p>
                            <div>
                                <span></span>
                                <p id="product_color">カラー</p>
                            </div>
                        </div>
                    </dd>
                </dl>
                <dl>
                    <dt>カラー：</dt>
                    <dd id="color_select">
                    </dd>
                </dl>
                <dl>
                    <dt>カテゴリー：</dt>
                    <dd id="category_select">
                    </dd>
                </dl>
                <dl>
                    <dt>リメイク後の画像：</dt>
                    <dd>
                        <input type="file" name="datafile" id="filesend">
                    </dd>
                </dl>
            </div>
        </section>
        <section>
            <p>ユーザー情報</p>
            <div>
                <dl>
                    <dt>ユーザー名：</dt>
                    <dd>User1</dd>
                </dl>
                <dl>
                    <dt>メールアドレス：</dt>
                    <dd>user1234@gmail.com</dd>
                </dl>
            </div>
        </section>
        <input type="submit" value="リメイク完了" onclick="Complete()">
    </main>

