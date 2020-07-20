<?php
    /*
    ページ詳細：注文履歴画面
    作成者：小川紗世
    編集者：2020/07/15三輪謙登
    */
?>

<script>
  firebase.auth().onAuthStateChanged(function(user) {
    if (user) {
      // sessionから受け取る
      var cart_info = JSON.parse(sessionStorage.cart_info);

      // 小計など
      $('#cart_info').append(`
          <div>
              <dl>
              <dt>小計(${cart_info.item_amount}商品)</dt>
              <dd>${cart_info.subtotal.toLocaleString()}円</dd>
              </dl>
              <dl>
              <dt>送料</dt>
              <dd>無料</dd>
              </dl>
              <dl>
              <dt>利用ポイント</dt>
              <dd><b>${cart_info.use_point}pt</b></dd>
              </dl>
          </div>
          <dl>
              <dt>総合計</dt>
              <dd><b>${parseInt(cart_info.total).toLocaleString()}</b>円</dd>
          </dl>
          <dl>
              <dt>獲得予定</dt>
              <dd><b>${cart_info.points}ポイント(円相当)</b></dd>
          </dl>
      `);
      var card_number = 0;
      var name = '';
      var postal_code = 0;
      var address = '';
      // ユーザー情報
      db.collection('user').get().then(querySnapshot => {
        querySnapshot.forEach(docs => {
          if (docs.data().user_id == user.uid) {
            card_number = docs.data().credit_card;
            name = docs.data().name;
            postal_code = docs.data().postal_code;
            postal_code = postal_code.substr(0,3) + "-" + postal_code.substr(3);
            address = docs.data().address;

            // お支払い情報
            $('#payment_info').append(`
              <div>
                  <p>お支払方法</p>
              </div>
              <div>
                  <table>
                    <tr>
                        <th>支払い方法：</th>
                        <td>クレジット</td>
                    </tr>
                    <tr>
                        <th>カード会社：</th>
                        <td>VISA</td>
                    </tr>
                    <tr>
                        <th>カード番号：</th>
                        <td>${card_number}</td>
                    </tr>
                    <tr>
                        <th>有効期限：</th>
                        <td>10月2026年</td>
                    </tr>
                    <tr>
                        <th>名義人：</th>
                        <td>${name}</td>
                    </tr>
                  </table>
              </div>
            `);

            // ユーザ情報
            $('#user_info').append(`
              <div>
                <p>発送先</p>
              </div>
              <div>
                <table>
                    <tr>
                        <th>氏名：</th>
                        <td><p>${name}</p></td>
                    </tr>
                    <tr>
                        <th>住所：</th>
                        <td><p>${postal_code}</p><p>${address}</p></td>
                    </tr>
                  </table>

              </div>
            `);
          }
        });
      });
      $('.submit').click(() => {
        var statement = {};
        statement.payment_method = '支払い方法：　クレジット';
        statement.card_company = 'カード会社：　VISA';
        statement.card_number = 'カード番号：　'+card_number;
        statement.expiration_date = '有効期限：　10月2026年';
        statement.nominee = '名義人：　'+name;
        statement.name = '氏名：　'+name;
        statement.address = '住所：　'+postal_code+'_'+address;
        var statement_JSON = JSON.stringify(statement);
        sessionStorage.statement = statement_JSON;
        // 注文確認画面へ
        location.href="./my_cart_order_completed.php"
      });
    }
  });
</script>
<!-- SHOP ｜ カート ｜ 注文履歴画面 -->
<title>ethicable｜SHOP｜カート｜注文履歴</title>

</head>
  <body id="order_confirmation">
    <!-- header -->
    <?php include "./tpl/header.html"; ?>

    <!-- main -->
    <main>
      <h1>注文確認</h1>
      <input type="button" value="完了" class="submit">
      <section>
        <div id="cart_info">

        </div>
      </section>
      <section>
        <!-- 支払い方法 -->
        <div id="payment_info">

        </div>
        <!-- 発送先 -->
        <div id="user_info">

        </div>
      </section>

     <input type="button" value="完了" class="submit">
    </main>
