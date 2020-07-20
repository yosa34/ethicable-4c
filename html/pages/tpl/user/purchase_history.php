<?php
    /*
    ページ詳細：購入履歴
    作成者：小川紗世
    編集者：2020/06/12小川紗世
    */
?>
<script src="./js/shop.js"></script>
<script>

  //ログアウト処理
  function logout(){
      firebase.auth().signOut();
  }

    firebase.auth().onAuthStateChanged(function(user) {
        if (user) {
            //historyコレクションから日ごとにデータを抽出
            //historyのユーザID == ログイン中のユーザID
            var db = firebase.firestore();
            var stockDate = "";
            var cntDate = "";
            var total = 0;
            var check_cnt =[]; 
            var cont = document.getElementById('cont');
            db.collection('history').where('user_id', '==', user.uid).orderBy('history_date','desc').get().then(querySnapshot => {
                querySnapshot.forEach(history => {
                
                    var checkDate = getDate(history.data().history_date.toDate());

                    if(cntDate != checkDate){
                        check_cnt[checkDate] = 1;
                        cntDate = checkDate;
                    }else{
                        check_cnt[checkDate]++;
                    }

                    //var checkDate = getDate(history.data().history_date.toDate());

                    //stocksコレクションからstock_idが同一のものを取得
                    //stocksのstock_id == 抽出したhistoryのstock_id
                    db.collection('stocks').where('stock_id', '==', history.data().stock_id).get().then(querySnapshot => {
                        querySnapshot.forEach(stocks => {

                            //remakeコレクションからremake_product_idが同一のものを取得
                            //remakeのremake_product_id == 抽出したstocksのremake_product_id
                            db.collection('remake').where('remake_product_id', '==', stocks.data().remake_product_id).get().then(querySnapshot => {
                                querySnapshot.forEach(remake => {

                                    //productコレクションからproduct_idが同一のものを取得
                                    //productのproduct_id == 抽出したremakeのproduct_id
                                    db.collection('product').where('product_id', '==', remake.data().product_id).get().then(querySnapshot => {
                                        querySnapshot.forEach(product => {

                                            if(stockDate != checkDate){
                                                var cont_li = document.createElement("li");
                                                cont_li.className = "cont-li";
                                                cont.appendChild(cont_li);

                                                var cont_date = document.createElement("p");
                                                cont_date.className = "cont-date";
                                                cont_date.innerHTML = '購入日時：' + getDate(history.data().history_date.toDate());
                                                cont_li.appendChild(cont_date);
                                                stockDate = checkDate;
                                                total = 0;
                                                cnt = 1;
                                                total = product.data().product_price;
                                            } else{
                                                cnt++;
                                                var cont_li = document.createElement("li");
                                                cont_li.className = "cont-li";
                                                cont.appendChild(cont_li);
                                                total = total + product.data().product_price;
                                            }


                                            var cont_box = document.createElement("div");
                                            cont_box.className = "cont_box";
                                            cont_li.appendChild(cont_box);

                                            var cont_img_box = document.createElement("p");
                                            cont_box.appendChild(cont_img_box);

                                            var remake_img = document.createElement("img");
                                            remake_img.setAttribute('src', stocks.data().remake_image);
                                            cont_img_box.appendChild(remake_img);

                                            var product_box = document.createElement("div");
                                            cont_box.appendChild(product_box);

                                            var category_box = document.createElement("dl");
                                            product_box.appendChild(category_box);

                                            var category_dt = document.createElement("dt");
                                            category_dt.innerHTML = '部門(カテゴリー)：';
                                            category_box.appendChild(category_dt);

                                            var category_date = document.createElement("dd");
                                            category_box.appendChild(category_date);

                                            var category_img = document.createElement("img");
                                            category_img.setAttribute('src', './image/category/' + remake.data().category_id + '.png');
                                            category_date.appendChild(category_img);

                                            var category_n = document.createElement("p");
                                            db.collection('category').where('category_id', '==', remake.data().category_id).get().then(querySnapshot => {
                                                querySnapshot.forEach(category => {
                                                    category_n.innerHTML = category.data().category_name;
                                                });
                                            });
                                            category_date.appendChild(category_n);

                                            var color_box = document.createElement("dl");
                                            product_box.appendChild(color_box);

                                            var color_dt = document.createElement("dt");
                                            color_dt.innerHTML = 'カラー：';
                                            color_box.appendChild(color_dt);

                                            var color_date = document.createElement("dd");
                                            color_box.appendChild(color_date);

                                            var color_style = document.createElement("span");
                                            db.collection('color').where('color_id', '==', remake.data().color_id).get().then(querySnapshot => {
                                                querySnapshot.forEach(color => {
                                                    color_style.className = "span-color" + color.data().color_id;
                                                    $(".span-color"+color.data().color_id).css("background",color.data().color_code);
                                                    var color_n = document.createElement("p");
                                                    color_n.innerHTML = color.data().color_name;
                                                    color_date.appendChild(color_n);
                                                });
                                            });
                                            color_date.appendChild(color_style);

                                            var product_price = document.createElement("p");
                                            product_price.innerHTML = "小計：￥" + product.data().product_price.toLocaleString();
                                            product_box.appendChild(product_price);

                                            if(cnt == check_cnt[checkDate]){
                                                var total_box = document.createElement("div");
                                                total_box.className = "total";
                                                cont_li.appendChild(total_box);

                                                var total_price = document.createElement("p");
                                                total_price.innerHTML = '合計：￥' + getBillingAmount(total, 0, 0).toLocaleString();
                                                total_box.appendChild(total_price);

                                                var total_point = document.createElement("p");
                                                total_point.innerHTML = '獲得ポイント：' + getPointAmount(total) + 'pt';
                                                total_box.appendChild(total_point);
                                            }
                                        });
                                    });
                                });
                            });
                        });
                    });
                    $('.cont').append(
                        '</li>'
                    );
                });
            });
        } 
        else{
        }
    });
</script>


<!-- SHOP HOME画面 -->
<title>ethicable｜マイページ｜購入履歴</title>

</head>
  <body id="purchase_history">
    <!-- header -->
    <?php include "./tpl/header.html"; ?>

    <!-- main -->
    <main>
        <div>
            <p>購入履歴</p>
        </div>
        <section>
            <ul id='cont' class='cont'>
                
            </ul>
        </section>
    </main>

