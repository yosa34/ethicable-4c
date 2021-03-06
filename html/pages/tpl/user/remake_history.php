<?php
/*
    ページ詳細：マイページ
    作成者：小川紗世
    編集者：2020/07/01三輪謙登
    */
?>

<script src="./js/shop.js"></script>

<script>
    //ログアウト処理
    function logout() {
        firebase.auth().signOut();
    }

    firebase.auth().onAuthStateChanged(function(user) {
        if (user) {
            function history_process() {
                //collection名指定
                var course_collection = db.collection('course');
                //コース名を取得
                course_collection.onSnapshot(function(snapshot) {
                    snapshot.docChanges().forEach(function(change) {
                        //コースのプルダウンメニューを作成
                        if (change.doc.data().course_id == course) {
                            $('#course').append('<option value="' + change.doc.data().course_id + '" selected>' + change.doc.data().course_name + '</option>');
                        } else {
                            $('#course').append('<option value="' + change.doc.data().course_id + '">' + change.doc.data().course_name + '</option>');
                        }
                    });
                });

                // リメイクイメージを取得するために使用する配列を作成
                var remake_product_id = '';
                var color_id = 0;
                var color_code = '';
                var category_icon = '';

                //collection名指定
                var remake_collection = db.collection('remake');
                var stock_collection = db.collection('stocks');
                var color_collection = db.collection('color');

                // カウンターリセット
                cnt = 1;

                //remake_product_idとcolor_idを取得する
                function get_remake_product_id_and_color_id() {
                    //コース使用履歴を取得
                    remake_collection.onSnapshot(function(snapshot) {
                        snapshot.docChanges().forEach(function(change) {
                            if (change.doc.data().user_id == user.uid && change.doc.data().course_id == course && change.doc.data().date_qr_read != null && change.doc.data().category_id != null) {
                                /**
                                 * 元商品画像 ローカルのimage/productの中にある！
                                 * 商品番号 product_id
                                 * カテゴリーID category_id
                                 * リメイクカラー color_id
                                 * リメイク完了日 remake_complete
                                 */
                                // console.log(change.doc.data());

                                // 日付処理
                                var ts = change.doc.data().date_qr_generate.toMillis();
                                var d = new Date(ts);
                                var year = d.getFullYear();
                                var month = ((d.getMonth() + 1) < 10) ? '0' + (d.getMonth() + 1) : (d.getMonth() + 1);
                                var day = (d.getDate() < 10) ? '0' + d.getDate() : d.getDate();
                                var hour = (d.getHours() < 10) ? '0' + d.getHours() : d.getHours();
                                var min = (d.getMinutes() < 10) ? '0' + d.getMinutes() : d.getMinutes();
                                var sec = (d.getSeconds() < 10) ? '0' + d.getSeconds() : d.getSeconds();
                                // 日付表示用結合
                                var date = year + '/' + month + '/' + day + ' ' + hour + ':' + min + ':' + sec;
                                // カテゴリーID
                                category_id = change.doc.data().category_id;
                                // カラーID
                                color_id = change.doc.data().color_id;
                                // プロダクトID
                                var product_id = change.doc.data().product_id;
                                get_category_icon(category_id, color_id, date, product_id);
                            }
                        });
                    });
                }

                //remake_imageを取得する   修正！！！！！！
                function get_category_icon(category_id, color_id, date, product_id) {
                    //カテゴリーアイコンを取得
                    category_icon = getRemakeImg(category_id);
                    get_color_code(color_id, category_icon, date, product_id);
                }

                //color_codeを取得する
                function get_color_code(color_id, category_icon, date, product_id) {
                    //リメイク画像を取得
                    //color_idで一致したものの画像を別配列に入れ込む
                    color_collection.onSnapshot(function(snapshot) {
                        snapshot.docChanges().forEach(function(change) {
                            //color_idが入った配列にあるcolor_idとcolorコレクションの中のcolor_idが同じならば...
                            if (change.doc.data().color_id == color_id) {
                                color_code = change.doc.data().color_code;
                                display_history(category_icon, color_code, date, product_id);
                            }
                        });
                    });
                }

                //HTMLに表示する
                function display_history(category_icon, color_code, date, product_id) {
                    $('#history_list').append('<li><div id="history' + cnt + '"></div></li>');
                    $('#history' + cnt).append(
                        '<div><div><div><div><img src="./image/product/' + product_id + '.jpg" class="history_image">' +
                        '<p>商品番号：' + product_id + '</p></div>' +
                        '<div class="three_sign"><span></span><span></span><span></span></div></div>' +
                        '<div><img src="' + category_icon + '">' +
                        '<div class="x-mark"><span class="inner"></span></div>' +
                        '<div class="color-tile" style="background-color: ' + color_code + ';width: 150px;height:150px"</div></div></div>' +
                        '</div><p class="text">取引日時：' + date + '</p>'
                    );
                    cnt++;
                }

                // $('#history' + cnt).append(
                //     '<div><div><div><div><img src="./image/product/' + change.doc.data().product_id + '.jpg" class="history_image">' +
                //     '<p>商品番号：' + change.doc.data().product_id + '</p></div>' +
                //     '<img src="./image/icon/icon_dash.png" class="dash"></div>' +
                //     '<div><img src="' + remake_image + '">' +
                //     '<p>×</p>' +
                //     '<div class="color-tile" style="background-color: ' + color_code + ';width: 150px;height:150px"</div></div></div>' +
                //     '</div><p>取引日時：' + year + '/' + month + '/' + day + ' ' + hour + ':' + min + ':' + sec + '</p>'
                // );
                //関数実行 remake_product_idとcolor_idを取得→stocksコレクションから画像パスを取得→colorコレクションからカラーコードを取得→表示
                get_remake_product_id_and_color_id();
            }

            //urlパラメータを取得
            var param = $(location).attr('search');
            var course = parseInt(param.substr(7));
            history_process();
            $('select').change(function() {
                course = $('[name=course] option:selected').val();
                window.location.href = "./user_remake_history.php?corse=" + course;
            });


        } else {
            //ログインしていない場合はindexページに飛ばす
        }
    });
</script>


<!-- SHOP HOME画面 -->
<title>ethicable｜マイページ｜コース使用履歴</title>

</head>

<body id="remake_history">
    <!-- header -->
    <?php include "./tpl/header.html"; ?>

    <!-- main -->
    <main>
        <div>
            <p>コース使用履歴</p>
        </div>
        <p>コース変更：
            <select name="course" id="course">
            </select>
        </p>
        <section>
            <ul id="history_list"></ul>
        </section>
    </main>