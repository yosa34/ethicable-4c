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

            //依頼日
            var elem = document.getElementById("qr_read");
            elem.insertAdjacentHTML('beforeend',getDate(data.date_qr_read.toDate()));

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
                console.log(productData);
                //サイズの取得
                var elem = document.getElementById("product_size");
                elem.insertAdjacentHTML('beforeend', getProductSize(productData.product_size));
                //名前の取得
                var elem = document.getElementById("product_name");
                elem.insertAdjacentHTML('beforeend', productData.product_name);
                //カラーの取得
                var elem = $("#product_color");
                elem.text( getColorName(productData.color_id));

                var elem = $("#product_color_box");
                elem.css({"background":getColorCode(productData.color_id)});
                });

                // リメイク依頼したユーザーデータの取得
                //ユーザー情報の取得
                if(data.user_id){
                    db.collection("user").where("user_id", "==", data.user_id)
                    .get().then(function(querySnapshot) {
                        querySnapshot.forEach(function(doc) {
                            let userData = doc.data();
                            // ユーザー名
                            var elem = $("#user_name");
                            elem.text(userData.name);
                            // ユーザーメールアドレス
                            var elem = $("#user_mail");
                            elem.text(userData.mail);
                        });
                    }).catch(function(error) {
                        console.log("Error getting documents: ", error);
                    });
                }

            })
            .catch(function(error) {
                console.log("Error getting documents: ", error);
            });



            //ドキドキコース
            if(data.course_id == 1){
                //カラー出力
                var elem = document.getElementById("color_select");
                elem.innerHTML = "<label style='width: 80px; margin-bottom: 1%; display:inline-block' for='"+data.color_id+"'><span style='width: 50px; height: 50px; margin: 0 auto; display: block; background-color:"+ getColorCode(data.color_id) + ";'></span><p style='text-align: center; padding: 10px;'>" + getColorCode(data.color_id) + "</p><input style='margin-left: 44%;' type='radio' name='color' id='"+data.color_id+"' value='"+data.color_id+"' checked></label>";
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

    //完了時
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

                }//ドキドキコース処理//
                
                //ワクワクコース
                if(data.course_id == 2){
                    //以下商品金額の取得
                    db.collection('product').where("product_id", "==",Number(data.product_id))
                    .get().then(snapshot => {
                        snapshot.forEach(doc => {
                            const data = doc.data()

                            //商品の金額から付与するポイントを取得
                            let product_price = getPointAmount(data.product_price)

                            
                            //user情報取得
                            //var user = firebase.auth().currentUser;
                            firebase.auth().onAuthStateChanged(function(user) {
                                

                                if (user) {
                                    //userのポイント情報を取得する
                                    db.collection('point').where("user_id", "==",user.uid)
                                    .get().then(snapshot => {
                                        //新規ユーザーの時
                                        if(snapshot.empty){
                                            //新規ポイントを付与する
                                            db.collection("point").add({
                                                point_amount:product_price,
                                                user_id:user.uid,
                                            })
                                        }else{
                                            //一回でもポイントを付与したことがある人
                                            snapshot.forEach(doc => {
                                                const dataId = doc.id
                                                const data = doc.data()
                                                let point = data.point_amount;
                                                point += product_price
                                                //ポイントを付与する
                                                db.collection("point").doc(dataId).update({
                                                    point_amount:point,
                                                })
                                            })
                                        }
                                    })
                                }
                            })
                        })
                    })

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
                        // stock_id配列初期値
                        var size = [];
                        snapshot.forEach(doc => {
                            const data = doc.data()
                            // stock_idを配列にpushしていく
                            size.push(data.stock_id);
                        })
                        // stock_id配列からMAXの値を算出
                        var max_id = Math.max.apply(null, size);
                        // console.log(size);
                        // console.log(Math.max.apply(null, size));
                        
                        // MAX＋１をstock_idへ代入
                        stock_id = max_id + 1;

                        //stocksに新しいデータを保存
                        db.collection("stocks").add({
                            quantity: "1",
                            remake_image: getImageUrl(remake_product_id),
                            remake_product_id:remake_product_id,
                            stock_id:stock_id,
                            stocks_time:firebase.firestore.FieldValue.serverTimestamp(),
                        })

                    })
                }//ワクワクコース処理//

                //選択されたファイル画像をstorageに保存する
                var files = document.getElementById('filesend').files;
                var image = files[0];
                var storageRef = firebase.storage().ref().child(remake_product_id+".jpg");
                storageRef.put(image).then(function(snapshot) {
                        //user情報取得
                        // firebase.auth().onAuthStateChanged(function(user) {
                    //ページ遷移

                    //商品情報の取得
                    db.collection("product").where("product_id", "==", data.product_id)
                    .get().then(function(querySnapshot) {
                        querySnapshot.forEach(function(doc) {
                            let productData = doc.data()
                            //名前の取得
                            let product_name = productData.product_name

                            //ユーザー情報の取得
                            if(data.user_id){
                                db.collection("user").where("user_id", "==", data.user_id)
                                .get().then(function(querySnapshot) {
                                    querySnapshot.forEach(function(doc) {
                                        let userData = doc.data();
                                        //完了ページへ
                                        var next_page = "./remake_shop_complete.php";
                                        location.href = next_page + "?remake_product_id=" + remake_product_id + "&product_name=" + product_name + "&email=" + userData.mail;
                                    });
                                }).catch(function(error) {
                                    console.log("Error getting documents: ", error);
                                });
                            }
                        });
                    })
                    .catch(function(error) {
                        console.log("Error getting documents: ", error);
                    });

                        // })
                });
            });
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
        <p id='qr_read'>依頼日：</p>
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
                                カラー:
                                <span id="product_color_box"></span>
                                <p id="product_color"></p>
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
                    <dd id="user_name"></dd>
                </dl>
                <dl>
                    <dt>メールアドレス：</dt>
                    <dd id="user_mail"></dd>
                </dl>
            </div>
        </section>
        <input type="submit" value="リメイク完了" onclick="Complete()">
    </main>

