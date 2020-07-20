<?php
    /*
    ページ詳細：注文完了画面
    作成者：小川紗世
    編集者：2020/07/17三輪謙登
    */
?>

<script>
  firebase.auth().onAuthStateChanged(function(user) {
    if (user) {
      // sessionがあれば...
      if (sessionStorage.cart_info) {
        // sessionStorageのifここから
        // オブジェクトを回す用の関数
        Object.defineProperty(Object.prototype, "forIn", {
            value: function(fn, self) {
                self = self || this;

                Object.keys(this).forEach(function(key, index) {
                    var value = this[key];

                    fn.call(self, key, value, index);
                }, this);
            }
        });

        // sessionから受け取る
        var cart_info = JSON.parse(sessionStorage.cart_info);
        var cartList = JSON.parse(sessionStorage.cartList);
        var remake_product_id;

        var purchase_promise = new Promise((resolve,reject) => {
          // purchase_promise開始
          cartList.forIn((key,value,index) => {
            var value_setting = new Promise((resolve,reject) => {
              remake_product_id = value.remake_product_id;
              resolve(remake_product_id);
            });
            value_setting.then((val) => {

            // カートにあるremakeテーブルの商品のクォンティティを文字列の0に変更
              db.collection('stocks').get().then(querySnapshot => {
                querySnapshot.forEach(docs => {
                  if (docs.data().remake_product_id == val) {
                    db.collection('stocks').doc(docs.id).update({
                        quantity: "0"
                    })
                    .then(() => {
                    })
                    .catch((error) => {
                    });
                  }
                })
              });
            });

            // historyコレクションへデータを追加
            var get_remake_product_id = new Promise((resolve,reject) => {
              remake_product_id = value.remake_product_id;
              resolve(remake_product_id);
            });
            get_remake_product_id.then((value) => {
              // ここから
              db.collection('stocks').get().then(querySnapshot => {
                querySnapshot.forEach(docs => {
                  if (docs.data().remake_product_id == value) {
                    // ifここから
                    // stock_idを取得
                    var stock_id = docs.data().stock_id;
                    //historyに新しいデータを保存
                    db.collection('history').add({
                        history_date: firebase.firestore.FieldValue.serverTimestamp(),
                        stock_id: parseInt(stock_id),
                        user_id: user.uid
                    });
                    // ifここまで
                  }
                });
              });
              // ここまで
            });

          });

          var use_point = parseInt(cart_info.use_point);
          var get_point = parseInt(cart_info.points);
          // pointコレクション
          db.collection('point').get().then(querySnapshot => {
            querySnapshot.forEach(docs => {
              if (docs.data().user_id == user.uid) {
                var now_point = parseInt(docs.data().point_amount);
                db.collection('point').doc(docs.id).update({
                  point_amount: now_point - use_point + get_point
                })
                .then(() => {
                })
                .catch((error) => {
                });
              }
            })
          });
          resolve('ok');
          // purchase_promise終了
        });

        // 購入処理が完了したら...
        purchase_promise.then((flg) => {
          var item_amount = cart_info.item_amount;
          var subtotal = cart_info.subtotal;
          var total = cart_info.total;
          var use_point = cart_info.use_point;
          var points = cart_info.points;

          var statement = JSON.parse(sessionStorage.statement);
          var payment_method = statement.payment_method;
          var card_company = statement.card_company;
          var card_number = statement.card_number;
          var expiration_date = statement.expiration_date;
          var nominee = statement.nominee;
          var name = statement.name;
          var address = statement.address;
          // sessionを削除
          window.sessionStorage.clear();
<<<<<<< HEAD
          console.log(flg);
          window.location = "./shop_complete.php?item_amount="+item_amount+"&subtotal="+subtotal+"&total="+total+"&use_point="+use_point+"&points="+points+"&payment_method="+payment_method+"&card_company="+card_company+"&card_number="+card_number+"&expiration_date="+expiration_date+"&nominee="+nominee+"&name="+name+"&address="+address+"&email="+user.email;
=======
>>>>>>> 07f49c44d1a105aef2abb8bcd8bdc80fc231330f
        });

        // sessionStorageのifここまで
      }
    }
  });
</script>
<!-- SHOP ｜ カート ｜ 注文完了画面 -->
<title>ethicable｜SHOP｜カート｜注文完了</title>

</head>
  <body id="order_completed">

    <!-- header -->
    <?php include "./tpl/header.html"; ?>

    <!-- main -->
    <main>
    <h1>注文完了</h1>

      <section>
      <p>注文が完了しました</p>
      <p>アカウントのメールアドレス宛に注文完了通知が送られます</p>
      <p>ご確認ください</p>

      <p><a href="shop_home.php">ショップへ</a></p>

      </section>

    </main>
