<?php
    /*
    ページ詳細：マイページ
    作成者：小川紗世
    編集者：2020/07/01三輪謙登
    */
?>

<script>

  //ログアウト処理
  function logout(){
    firebase.auth().signOut();
  }

  firebase.auth().onAuthStateChanged(function(user) {
    if (user) {
        function history_process() {
             //collection名指定
            var course_collection = db.collection('course');
            //コース名を取得
            course_collection.orderBy('course_id').onSnapshot(function(snapshot) {
                snapshot.docChanges().forEach(function (change) {
                    //コースのプルダウンメニューを作成
                    if (change.doc.data().course_id == course) {
                        $('#course').append('<option value="' + change.doc.data().course_id + '" selected>' + change.doc.data().course_name + '</option>');
                    } else {
                        $('#course').append('<option value="' + change.doc.data().course_id + '">' + change.doc.data().course_name + '</option>');
                    }
                });
            });

            // リメイクイメージを取得するために使用する配列を作成
            // stock_idを取る -> stockコレクションのremake_imageを持ってくる
            var stock_id = '';
            var color_id = 0;
            var color_code = '';
            var remake_image= '';

            //collection名指定
            var remake_collection = db.collection('remake');
            var stock_collection = db.collection('stocks');
            var color_collection = db.collection('color');

            // カウンターリセット
            cnt = 1;


            //stock_idとcolor_idを取得する
            function get_stock_id_and_color_id() {
                //コース使用履歴を取得
                remake_collection.orderBy('date_qr_generate').onSnapshot(function(snapshot) {
                    snapshot.docChanges().forEach(function (change) {
                        if(change.doc.data().user_id == user.uid && change.doc.data().course_id == course && change.doc.data().date_qr_read != null) {
                        /**
                            * 元商品画像 ローカルのimage/productの中にある！
                            * 商品番号 product_id
                            * リメイク後イメージ stock_id -> remake_image
                            * リメイクカラー color_id
                            * リメイク完了日 remake_complete
                            */
                            console.log(change.doc.data());

                        stock_id =  change.doc.data().remake_product_id;
                        color_id = change.doc.data().color_id;
                        get_remake_image(stock_id,color_id);
                    }
                });
            });
        }

        //remake_imageを取得する
        function get_remake_image(stock_id,color_id) {
            //リメイク画像を取得
                //stock_idで一致したものの画像を別配列に入れ込む
                    stock_collection.orderBy('stock_id').onSnapshot(function(snapshot) {
                        snapshot.docChanges().forEach(function (change) {
                            //stock_idが入った配列にあるstock_idとstockコレクションの中のstock_idが同じならば...
                            if (change.doc.data().stock_id == stock_id) {
                                remake_image= change.doc.data().remake_image;
                                get_color_code(color_id,remake_image);
                            }
                        });
                    });
            }

            //color_codeを取得する
            function get_color_code(color_id,remake_image) {
            //リメイク画像を取得
                //stock_idで一致したものの画像を別配列に入れ込む
                    color_collection.orderBy('color_id').onSnapshot(function(snapshot) {
                        snapshot.docChanges().forEach(function (change) {
                            //stock_idが入った配列にあるstock_idとstockコレクションの中のstock_idが同じならば...
                            if (change.doc.data().color_id == color_id) {
                                color_code= change.doc.data().color_code;
                                display_history(remake_image,color_code);
                            }
                        });
                    });
            }

            //HTMLに表示する
            function display_history(remake_image,color_code) {
                //コース使用履歴を取得
                remake_collection.orderBy('date_qr_generate').onSnapshot(function(snapshot) {
                    $('#history_list').append('<li><div id="history' + cnt + '"></div></li>');
                    snapshot.docChanges().forEach(function (change) {
                    if(change.doc.data().user_id == user.uid && change.doc.data().course_id == course && change.doc.data().date_qr_read != null) {
                        // display_histories[cnt]['product_image'] = './image/product/' + change.doc.data().product_id + '.jpg';
                        // display_histories[cnt]['product_id'] = change.doc.data().product_id;
                        // display_histories[cnt]['remake_image'] =  remake_image_array[cnt];
                        // display_histories[cnt]['color_id'] = change.doc.data().color_id;
                        // display_histories[cnt]['remake_complete'] = change.doc.data().remake_complete;
                        var ts = change.doc.data().date_qr_generate.toMillis();
                        var d = new Date( ts );
                        var year  = d.getFullYear();
                        var month = ((d.getMonth() + 1) < 10)?'0' +(d.getMonth() + 1) : (d.getMonth() + 1) ;
                        var day  = (d.getDate() < 10) ? '0' + d.getDate() :  d.getDate();
                        var hour = ( d.getHours()   < 10 ) ? '0' + d.getHours()   : d.getHours();
                        var min  = ( d.getMinutes() < 10 ) ? '0' + d.getMinutes() : d.getMinutes();
                        var sec   = ( d.getSeconds() < 10 ) ? '0' + d.getSeconds() : d.getSeconds();

                        $('#history' + cnt).append(
                        '<img src="./image/product/' + change.doc.data().product_id + '.jpg">' +
                        '<p>' + change.doc.data().product_id + '</p>' +
                        '<img src="' + remake_image + '">' +
                        '<div class="color-tile" style="background-color: ' + color_code + ';">' + color_code + '</div>' +
                        '<p>取引日時：' + year + '/' + month + '/' + day + ' ' + hour + ':' + min + ':' + sec + '</p>'
                        );
                    }
                    });
                    cnt++;
                });
            }

            //関数実行 stock_idとcolor_idを取得→stocksコレクションから画像パスを取得→colorコレクションからカラーコードを取得→表示
            get_stock_id_and_color_id();
            // // 順番に呼び出し
            // Promise.resolve().then(get_stock_id()).then(get_remake_image()).then(display_history());

            /**
             * 現在→firebase上の画像URLが取れていない
             * カラーIDからカラーを取る処理を入れていない
             */
        }

        //urlパラメータを取得
        var param = $(location).attr('search');
        var course = parseInt(param.substr(7));
        history_process();
        $('select').change(function() {
            course = $('[name=course] option:selected').val();
            window.location.href = "http://localhost:8888/ethicable/html/pages/user_remake_history.php?corse=" + course;
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

