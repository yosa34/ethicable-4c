<?php
    /*
    ページ詳細：購入手続き画面
    作成者：小川紗世
    編集者：2020/07/15三輪謙登
    */
?>
<script src="./js/shop.js"></script>
<script>
  firebase.auth().onAuthStateChanged(function(user) {
    if (user) {
      // オブジェクトをループさせるために使う関数
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
      var cartList = JSON.parse(sessionStorage.cartList);
      var cart_info = JSON.parse(sessionStorage.cart_info);

      // cart_info部分
      $('#cart_subtotal').append(`
          <dt>小計(${cart_info.item_amount}商品)</dt>
          <dd>${cart_info.subtotal.toLocaleString()}円</dd>
      `);
      $('#cart_total').append(`${cart_info.total.toLocaleString()}`);
      $('#cart_getPoint').append(`
        <dt>獲得予定</dt>
        <dd><b>${cart_info.points}ポイント(円相当)</b></dd>
      `);

      // point_info部分
      // ポイント使用分の計算を行う！！！
      var possession_point = 0;

      // 所持ポイント
      db.collection('point').get().then(querySnapshot => {
        querySnapshot.forEach(docs => {
          if (docs.data().user_id == user.uid) {
            possession_point = docs.data().point_amount;

            $('#point_info').append(`
              <div>
                <p>エコポイント利用</p>
                <input type="button" id="change_point" value="更新">
              </div>
              <div>
                <dl>
                  <dt>ご利用ポイント合計</dt>
                  <dd><input type="number" name="" id="use_point" value="0" min="0" max="${possession_point}"></dd>
                </dl>
                <dl>
                  <dt>総保有ポイント残高</dt>
                  <dd id="possession">${possession_point}</dd>
                </dl>
              </div>
            `);

             // ポイント処理
            $('#change_point').click(() => {
              var use_point = $('#use_point').val();
              var poss_point_display = parseInt($('#possession').text());
              var use_point_promise = new Promise((resolve,reject) => {
                if (use_point > poss_point_display) { // 使用ポイントが保有ポイントを超過していた場合
                  use_point = poss_point_display; // 使用ポイントを保有ポイント最大と等しくする
                } else if(use_point < 0) { // 使用ポイントが0未満の数字だった場合
                  use_point = 0; // 使用ポイントを0にする
                }
                resolve(use_point);
              });
              use_point_promise.then((point) => {
                var total_amount = getBillingAmount(cart_info.total, 0, point);
                // 使用ポイントのテキストボックスに入れる
                $('#use_point').val(point);
                // 小計の下の利用ポイントの項目に入れる
                $('#use_point_display').text(point);
                // 合計金額を変更する
                $('#cart_total').text(total_amount.toLocaleString());
              });
            });
          }
        })
      });

      // payment_info部分
      var card_number = 0;
      // 所持ポイント
      db.collection('user').get().then(querySnapshot => {
        querySnapshot.forEach(docs => {
          if (docs.data().user_id == user.uid) {
            card_number = docs.data().credit_card;

            $('#payment_info').append(`
              <div>
                <p>お支払方法</p>
                <input type="button" id="payment_update" value="更新">
              </div>
              <div>
                <dl>
                  <dt>カード番号:</dt>
                  <dd><input type="number" name="" id="card_number" value="${card_number}"></dd>
                </dl>
              </div>
            `);
          }
        })
      });

      // user_info部分
      // 名前
      var name = '';
      // 住所
      var postal_code = 0;
      var address = '';
      db.collection('user').get().then(querySnapshot => {
        querySnapshot.forEach(docs => {
          if (docs.data().user_id == user.uid) {
            name = docs.data().name;
            postal_code = docs.data().postal_code;
            address = docs.data().address;

            $('#user_info').append(`
              <div>
                <p>発送先</p>
                <input type="button" value="更新">
              </div>
              <div>
                <dl>
                  <dt>氏名：</dt>
                  <dd>${name}</dd>
                </dl>
                <dl>
                  <dt>住所：</dt>
                  <dd>
                    <p><input type="number" name="" id="" value="${postal_code}"></p>
                    <p><input type="text" name="" id="" value="${address}"></p>
                  </dd>
                </dl>
              </div>
            `);
          }
        })
      });

      // cartList部分
      var category_collection = db.collection('category');
      cartList.forIn((key,value,index) => {
        category_collection.orderBy('category_id').onSnapshot(function(snapshot) {
          snapshot.docChanges().forEach(function (change) {
            if (change.doc.data().category_id == value.category_id) {
                // カテゴリー名を取得
              category_name= change.doc.data().category_name;

              // リスト作成
              $('#cartList').append(`
                <li>
                  <p><img src="${value.remake_image}" alt=""></p>
                  <div>
                    <dl>
                      <dt>部門(カテゴリー)：</dt>
                      <dd><img src="${value.remake_icon}" alt=""><p>${category_name}</p></dd>
                    </dl>
                    <dl>
                      <dt>カラー：</dt>
                      <dd><span style="${'background: '+value.product_color}"></span><p>${value.product_color_name}</p></dd>
                    </dl>
                    <p>価格：${value.price.toLocaleString()}円</p>
                  </div>
                </li>
              `);
            }
          });
        });
      });
      $('.submit').click(() => {
        cart_info.use_point = $('#use_point').val();
        cart_info.total = $('#cart_total').text().replace(/,/g, '');
        var cart_info_JSON = JSON.stringify(cart_info);
        sessionStorage.cart_info = cart_info_JSON;

        // 注文確認画面へ
        location.href="./my_cart_order_confirmation.php"
      });
    } else {

    }
  });

</script>
<!-- SHOP ｜購入手続き画面 -->
<title>ethicable｜SHOP｜カート｜購入手続き</title>

</head>
  <body id="settlement">
    <!-- header -->
    <?php include "./tpl/header.html"; ?>

    <!-- main -->
    <main>
        <h1>購入手続き</h1>
        <input type="button" value="注文を確認" class="submit">
        <section>
            <h2>決済金額</h2>
            <div>
              <div>
                <dl id="cart_subtotal">
                </dl>
                <dl>
                <dt>送料</dt>
                <dd>無料</dd>
                </dl>
                <dl>
                <dt>利用ポイント</dt>
                <dd><b id="use_point_display">0pt</b></dd>
                </dl>
              </div>
              <dl>
                <dt>総合計</dt>
                <dd><b id="cart_total"></b>円</dd>
              </dl>
              <dl id="cart_getPoint">
              </dl>
            </div>
        </section>
        <section>
            <h3>お支払情報</h3>
            <div id="point_info"><!-- point_info -->

            </div>
            <div id="payment_info"><!-- payment_info -->

            </div>
            <div id="user_info"><!-- user_info -->

            </div>
        </section>
        <input type="button" value="注文を確認" class="submit">
        <section>
            <h2>購入商品情報</h2>
            <ul id="cartList">
            </ul>
        </section>
        <input type="button" value="注文を確認" class="submit">
    </main>
