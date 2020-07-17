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
            //console.log('ログイン中のユーザ：' + user.uid);

            //historyコレクションから日ごとにデータを抽出
            //historyのユーザID == ログイン中のユーザID
            var db = firebase.firestore();
            db.collection('history').where('user_id', '==', user.uid).get().then(querySnapshot => {
                //console.log("抽出した【history】");
                querySnapshot.forEach(history => {
                    //history取得確認
                    //console.log(history.data())


                    //stocksコレクションからstock_idが同一のものを取得
                    //stocksのstock_id == 抽出したhistoryのstock_id
                    db.collection('stocks').where('stock_id', '==', history.data().stock_id).get().then(querySnapshot => {
                        //console.log("抽出した【stocks】");
                        querySnapshot.forEach(stocks => {
                            //stocks取得確認
                            //console.log(stocks.data());


                            //remakeコレクションからremake_product_idが同一のものを取得
                            //remakeのremake_product_id == 抽出したstocksのremake_product_id
                            db.collection('remake').where('remake_product_id', '==', stocks.data().remake_product_id).get().then(querySnapshot => {
                                //console.log("抽出した【remake】");
                                querySnapshot.forEach(remake => {
                                    //stocks取得確認
                                    //console.log(remake.data());


                                    //productコレクションからproduct_idが同一のものを取得
                                    //productのproduct_id == 抽出したremakeのproduct_id
                                    db.collection('product').where('product_id', '==', remake.data().product_id).get().then(querySnapshot => {
                                        //console.log("抽出した【product】");
                                        querySnapshot.forEach(product => {
                                            //product取得確認
                                            //console.log(product.data());
                                            var total = product.data().product_price;

                                            //colorコレクションから該当するデータを取得
                                            //colorのcolor_id == 抽出したproductのcolor_id
                                            db.collection('color').where('color_id', '==', product.data().color_id).get().then(querySnapshot => {
                                                //console.log("抽出した【color】");
                                                querySnapshot.forEach(color => {
                                                    //product取得確認
                                                    //console.log(color.data());

                                                    //categoryコレクションから該当するデータを取得
                                                    //categoryのcategory_id == 抽出したremakeのcategory_id
                                                    db.collection('category').where('category_id', '==', remake.data().category_id).get().then(querySnapshot => {
                                                        //console.log("抽出した【category】");
                                                        querySnapshot.forEach(category => {
                                                            //product取得確認
                                                            //console.log(category.data());

                                                            //コンテンツを表示
                                                            $('.cont').append(
                                                                '<li>' +
                                                                    '<p>購入日時：' + getDate(history.data().history_date.toDate()) + '</p>'+
                                                                    '<div>'+
                                                                        '<p><img src="' + stocks.data().remake_image + '" alt=""></p>'+
                                                                        '<div>' +
                                                                            '<dl>'+
                                                                                '<dt>部門(カテゴリー)：</dt>'+
                                                                                '<dd>' +
                                                                                    '<img src="./image/category/' + remake.data().category_id + '.png" alt="">' +
                                                                                    '<p>' + category.data().category_name + '</p>' +
                                                                                '</dd>'+
                                                                            '</dl>'+

                                                                            '<dl>'+
                                                                                '<dt>カラー：</dt>'+
                                                                                '<dd><span style="background: '+ color.data().color_code +'"></span><p>' + color.data().color_name + '</p></dd>'+
                                                                            '</dl>' +
                                                                            '<p>小計：￥' + product.data().product_price.toLocaleString() + '</p>' +
                                                                        '</div>'+
                                                                    '</div>'+
                                                                '</li>' +

                                                                '<div class="total">'+
                                                                    '<p>　　　　合計：￥' + getBillingAmount(total, 0, 0).toLocaleString() + '</p>' +
                                                                    '<p>獲得ポイント：' + getPointAmount(total) + 'pt</p>' +
                                                                '</div>'
                                                            );
                                                        });
                                                    });
                                                });
                                            });
                                        });
                                    });
                                });
                            });
                        });
                    });
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
            <ul class='cont'>

            </ul>
        </section>
    </main>

