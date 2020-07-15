<?php
    /*
    ページ詳細：購入手続き画面
    作成者：小川紗世
    編集者：2020/07/02小川紗世
    */
?>

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
                    <dd><b>0pt</b></dd>
                    </dl>
                </div>
                <dl>
                    <dt>総合計</dt>
                    <dd><b>${cart_info.total.toLocaleString()}</b>円</dd>
                </dl>
                <dl>
                    <dt>獲得予定</dt>
                    <dd><b>${cart_info.points}ポイント(円相当)</b></dd>
                </dl>
            `);
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
            <div id="cart_info">

            </div>
        </section>
        <section>
            <h3>お支払情報</h3>
            <div>
                <div>
                    <p>エコポイント利用</p>
                    <input type="button" value="更新">
                </div>
                <div>
                    <dl>
                        <dt>ご利用ポイント合計</dt>
                        <dd><input type="number" name="" id="" value="0"></dd>
                    </dl>
                    <dl>
                        <dt>総保有ポイント残高</dt>
                        <dd>0</dd>
                    </dl>
                </div>
            </div>
            <div>
                <div>
                    <p>お支払方法</p>
                    <input type="button" value="更新">
                </div>
                <div>
                    <dl>
                        <dt>カード番号:</dt>
                        <dd><input type="number" name="" id="" value="00000000"></dd>
                    </dl>
                </div>
            </div>
            <div>
                <div>
                    <p>発送先</p>
                    <input type="button" value="更新">
                </div>
                <div>
                    <dl>
                        <dt>氏名：</dt>
                        <dd>名前</dd>
                    </dl>
                    <dl>
                        <dt>住所：</dt>
                        <dd>
                            <p><input type="number" name="" id="" value="0000000"></p>
                            <p><input type="text" name="" id="" value="大阪府帰宅"></p>
                        </dd>
                    </dl>
                </div>
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
