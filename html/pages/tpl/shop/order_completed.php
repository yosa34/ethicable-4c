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
        // カートにあるremakeテーブルの商品のクォンティティを文字列の0に変更
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

        // sessionを削除
        window.sessionStorage.clear();
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
