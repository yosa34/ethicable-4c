<?php
    /*
    ページ詳細：カート画面
    作成者：小川紗世
    編集者：2020/07/11小川紗世
    */
?>

<script>

    firebase.auth().onAuthStateChanged(function(user) {
        if (user) {
          if(sessionStorage.cart || sessionStorage.cartList){
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
            /**
              取得したproduct_priceをもとに獲得ポイント（切り捨て）を返す
              @param number 取得したproduct_price
              @return number 獲得ポイント
            */
            function getPointAmount(price) {
              let getPoint;
              // 切り捨てる
              getPoint = Math.floor(price/100);
              // console.log(getPoint);
              return getPoint;
            }
            /**
              合計金額を返す
              @param number 小計, 送料, 使用ポイント
              @return number 獲得ポイント
              (商品の小計 + 送料) - 使用ポイント = 総合計(お支払い金額)
            */
            function getBillingAmount(subtotal, postage, use_point) {
              let billingAmount;
              billingAmount = (subtotal + postage) - use_point;
              // console.log(billingAmount);
              return billingAmount;
            }

            $('section').append('<ul id="items" class="cart"></ul>');
            $('section').append('<div id="subtotal"></div>');
            $('section').append('<dl id="acquisition"></dl>');
            $('main').append(
              `<p onClick="window.sessionStorage.clear();location.reload();">カートを空にする</p>
                <p id="total_amount">合計<b></b>円</p>
                <input type="button" value="購入手続き" id="submit">`
            );
            // JSON形式でsessionに保存されているため、JSON.parseをしてJavaScriptで扱えるようにする
            var cart = {};
            // 商品オブジェクトを一つのオブジェクトにまとめる
            var cartList = {};
            // sessionのcartがあるかどうかのフラグ
            var cart_flg = true;
            if (Object.keys(sessionStorage.cart).length) {
              // cartがある場合
              var saveCart = new Promise((resolve, reject) => {
                cart = JSON.parse(sessionStorage.cart);
                resolve(cart);
              });
              // sessionに入っているcartを消す(二重登録を防ぐため)
              saveCart
                .then((value) => {
                  sessionStorage.cart = '';
                })
                .catch((err) => {
                  cart_flg = false;
                });
              // カートリストのカウンター
              if (cart_flg) {
                if (sessionStorage.cartList) {
                  cartList = JSON.parse(sessionStorage.cartList);
                  cartList[Object.keys(cartList).length + 1] = cart;
                } else {
                  cartList[1] = cart;
                }
                // sessionにcartListを保存
                cartListJSON = JSON.stringify(cartList);

                sessionStorage.cartList = cartListJSON;
              }
            } else {
              // cartがなかった場合
              cartList = JSON.parse(sessionStorage.cartList);
            }



            // // sessionにcartListを保存
            // cartListJSON = JSON.stringify(cartList);
            // console.log(cartListJSON);

            // sessionStorage.cartList = cartListJSON;
            // console.log(sessionStorage.cartList);


            // 小計
            var subtotal = 0;
            // 獲得ポイント
            var points = 0;
            // 合計
            var total_amount = 0;

            // 小計計算
            var money_process = new Promise((resolve,reject) => {
              cartList.forIn(function(key, value, index) {
                value.forIn(function(itemKey, itemValue, itemIndex) {
                  if (itemKey == 'price') {
                    itemValue = parseInt(itemValue);
                    subtotal = subtotal + itemValue;
                    total_amount = getBillingAmount(subtotal, 0, 0);
                  }
                });
              });
              resolve(subtotal);
            });
            // ポイント計算
            money_process
              .then((subtotal_value) => {
                points = getPointAmount(subtotal_value);
                $('#acquisition').append(
                  '<dt>獲得予定</dt>'+
                  '<dd>' + points + 'ポイント(円相当)</dd>'
                );
              });

            // アイテム数を数える
            var item_amount = Object.keys(cartList).length;
            // カートからcategory_idを抽出する時に使う変数
            var category_id = 0;
            // itemのカウンター
            var itemCount = 1;
            // categoryコレクションを見にいく→カテゴリー名を取得する
            var category_collection = db.collection('category');
            var cart_item_display = function(callback) {
              // オブジェクトのループ処理をいれる
              cartList.forIn(function(key, value, index) {

                value.forIn(function(itemKey, itemValue, itemIndex) {
                  if (itemKey == 'category_id') {
                    // カートからcategory_idを抽出
                    category_id = itemValue;
                    category_collection.orderBy('category_id').onSnapshot(function(snapshot) {
                      snapshot.docChanges().forEach(function (change) {
                        //category_idが入った配列にあるcategory_idとcategoryコレクションの中のcategory_idが同じならば...
                        if (change.doc.data().category_id == category_id) {
                          // cartの中身を作るための箱を用意する。
                          $('#items').append('<li id="item' + itemCount + '" class="cart_items"></li>');
                          // カテゴリー名を取得
                          category_name= change.doc.data().category_name;

                          // cart_itemの表示
                          $('#item' + itemCount).append(
                            '<a href="./shop_details.php?remake_product_id=' + value.remake_product_id + '">'+
                            '<p><img src="' + value.remake_image + '" alt="リメイクイメージ"></p>'+
                            '<div class="cart_items_item">'+
                            '<dl>'+
                            '<dt>' + '部門(カテゴリー)：' + '</dt>' + '<dd><img src="' + value.remake_icon + '" alt="リメイクアイコン">' + '<p>' + category_name + '</p>' + '</dd>'+
                            '</dl>'+
                            '<dl>'+
                            '<dt>' + 'カラー：' + '</dt>' + '<dd><span style="background-color: ' + value.product_color + ';"></span>' + '<p>' + value.product_color_name + '</p>' +  '</dd>'+
                            '</dl>'+
                            '<p>' + '価格：' + parseInt(value.price).toLocaleString() + '円' + '</p>'+
                            '<p>削除</p>'+
                            '</div> '+
                            '</a>'
                            );
                            // カウントアップ
                            itemCount++;
                          }
                        });
                      });
                    }
                  });
                });
                callback();
            }
            // 小計などの表示
            var incidental_display = function() {
              // .toLocaleString()とは...金額表示時に「,」を付ける関数
                $('#subtotal').append(
                '<dl>'+
                  '<dt>小計<span>(' + item_amount + '商品)</span></dt>'+
                  '<dd>' + subtotal.toLocaleString() + '円</dd>'+
                '</dl>'+
                '<dl>'+
                  '<dt>送料</dt>'+
                  '<dd>無料</dd>'+
                '</dl>'
              );
              $('#total_amount>b').append(total_amount.toLocaleString());
            }
            cart_item_display(incidental_display);

            // 購入手続きボタンを押す
            $('#submit').click(() => {
              // 小計などの情報をまとめる
              var cart_info = {};
              cart_info.item_amount = item_amount;
              cart_info.subtotal = subtotal;
              cart_info.total = total_amount;
              cart_info.points = points;
              cart_info.postage = 0;

              var cart_info_JSON = JSON.stringify(cart_info);
              // sessionに保存
              sessionStorage.cart_info = cart_info_JSON;
              // 購入手続き画面へ
              location.href='./my_cart_settlement.php';
            });
          } else {
            $('section').append(
            '<div class="cart_error"><div>'+
              '<p>カートに商品が入っていません</p>'+
              '<p>是非お買い物をお楽しみください。</p>'+
              '<p>ご利用をお待ちしております。</p>'+
            '</div>' +
            '<p>'+
            '<a href="./shop_home.php">ショッピングページへ</a>'+
            '</p></div>');

            $('#goShop').click(function() {
              window.location.href='./shop_home.php' ;
            });
          }
        } else{
        }
    });

</script>
<!-- SHOP HOME画面 -->
<title>ethicable｜カート</title>

</head>
  <body id="cart">
    <!-- header -->
    <?php include "./tpl/header.html"; ?>

    <!-- main -->
    <main>
      <h1>カート</h1>
        <section>
        </section>
    </main>
