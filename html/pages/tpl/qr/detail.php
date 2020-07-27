<?php
/*
    ページ詳細：リメイク詳細確認
    作成者：小川紗世
    編集者：2020/07/02冨上由喬
    */
?>

<!-- REMAKE HOME画面 -->
<title>ethicable｜REMAKE｜リメイク詳細確認</title>
<script type="text/javascript">
    $(function() {
        //ゲット取得処理
        var arg = new Object;
        var product_id = 0;
        url = location.search.substring(1).split('&');
        for (i = 0; url[i]; i++) {
            var k = url[i].split('=');
            arg[k[0]] = k[1];
        }
        var remake_product_id = arg.remake_product_id;
        remake_product_id = Number(remake_product_id);
        //firebase処理
        firebase.auth().onAuthStateChanged(function(user) {
            if (user) {
                // GET URLのパラメータ取得
                let arg2 = new Object;
                url = location.search.substring(1).split('&');
                for (i = 0; url[i]; i++) {
                    var k = url[i].split('=');
                    arg2[k[0]] = k[1];
                }
                let remake_product_id2 = arg2.remake_product_id;
                console.log(remake_product_id2);
                var qr_display = document.getElementById("qr_display");
                qr_display.insertAdjacentHTML("beforeend", "<img src='https://chart.apis.google.com/chart?chs=150x150&cht=qr&chl=" + remake_product_id2 + "' alt='QRコード'>");
                //リメイク処理
                db.collection('remake').where('remake_product_id', '==', remake_product_id).get().then(querySnapshot => {
                    querySnapshot.forEach(docs => {
                        //プロダクト処理
                        product_id = docs.data().product_id;
                        db.collection('product').where('product_id', '==', product_id).get().then(querySnapshot => {
                            querySnapshot.forEach(docs => {
                                //画像取得
                                var src = "https:firebasestorage.googleapis.com/v0/b/ethicable-4c.appspot.com/o/" + docs.data().product_id + ".jpg?alt=media"
                                $(".translate-img").attr("src", src);
                                //アイテム名・番号・サイズ
                                var itemName = docs.data().product_name;
                                var itemNumber = '商品番号：' + docs.data().product_id;
                                var itemSize = 'サイズ：' + docs.data().product_size;
                                $('.qr_item_name').text(itemName);
                                $('.qr_item_number').text(itemNumber);
                                $('.qr_item_size').text(itemSize);
                                //カラー処理
                                db.collection('color').where('color_id', '==', docs.data().color_id).get().then(querySnapshot => {
                                    querySnapshot.forEach(docs => {
                                        var itemColorName = docs.data().color_id + "　" + docs.data().color_name;
                                        $('.qr_item_color_name').text(itemColorName);
                                        $('.qr_item_color').css("background-color", docs.data().color_code);
                                    });
                                });
                            });
                        });
                    });
                });
            } else {
                //エラー
                location.href = "./index.html"
            }
        });
        //ポップアップ 
        $('#deleteBtn').on('click', function() {
            fadeToggle()
        });
        $('#backBtn').on('click', function() {
            fadeToggle()
        });
        $(".dark").on('click', function() {
            fadeToggle()
        });
        $('#decisionBtn').on('click', function() {
            $(".pop_before").fadeToggle();
            setTimeout(function() {
                $(".pop_after").fadeToggle();
            }, 500);
            $(".dark").fadeToggle("fast");
            db.collection('remake').where('remake_product_id', '==', remake_product_id).get().then(querySnapshot => {
                querySnapshot.forEach(docs => {
                    var dalete_product_id = docs.id;
                    db.collection("remake").doc(dalete_product_id).update({
                            date_qr_generate: null,
                        })
                        .then(() => {
                        })
                        .catch((error) => {
                        });
                });
            });
            setTimeout(function() {
                window.location.href = './remake_home.php';
            }, 10000);
        });
        function fadeToggle() {
            $(".pop_before").fadeToggle("fast");
            $(".dark").fadeToggle("fast");
        }
    });
</script>
</head>

<body id="qr_detail">
    <!-- header -->
    <?php include "./tpl/header.html"; ?>

    <!-- main -->
    <main>
        <p>
        </p>
        <section>
            <div id="qr_display">

            </div>
            <p>
                QRコードをリメイクボックスにある端末にかざして読み込ませてください。<br>
                <b>「読み込み完了」と表示されるまでかざしてください。</b>
            </p>
            <div id="deleteBtn">
                <p>
                    QRコードを削除する<br>
                    <b>リメイク情報が完全に削除されます。</b>
                </p>
            </div>
        </section>
        <div class="pop pop_before">
            <p>QRコード削除確認</p>
            <div>
                <div class="qr_item_img">
                    <div>
                        <img class="image translate-img">
                    </div>
                    <div>
                        <p class="qr_item_name">シフォンプリーツロングスカート</p>
                        <div>
                            <p class="qr_item_number">商品番号：425371</p>
                            <p class="qr_item_size">サイズ:M</p>
                        </div>
                        <div>
                            <div class="qr_item_color"></div>
                            <p class="qr_item_color_name">71 PURPLE</p>
                        </div>
                    </div>
                </div>
                <div>
                    <p>この商品のリメイク情報を削除します。</p>
                    <p>削除されたデータは<br>戻ってくることはありません。</p>
                </div>
                <div>
                    <a id="decisionBtn">削除する</a>
                    <a id="backBtn">戻る</a>
                </div>
            </div>
        </div>
        <div class="pop pop_delete pop_after">
            <p>削除完了</p>
            <div>
                <div class="qr_item_img">
                    <div>
                        <img class="image translate-img">
                    </div>
                    <div>
                        <p class="qr_item_name">シフォンプリーツロングスカート</p>
                        <div>
                            <p class="qr_item_number">商品番号：425371</p>
                            <p class="qr_item_size">サイズ:M</p>
                        </div>
                        <div>
                            <div class="qr_item_color"></div>
                            <p class="qr_item_color_name">71 PURPLE</p>
                        </div>
                    </div>
                </div>
                <div>
                    <p>上記の商品のリメイク情報を<br>完全に削除しました。</p>
                    <p>１０秒後にホームに戻ります。</p>
                </div>
            </div>
        </div>
        <div class="dark">
        </div>
    </main>