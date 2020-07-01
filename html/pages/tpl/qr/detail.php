<?php
/*
    ページ詳細：リサイクル詳細確認
    作成者：小川紗世
    編集者：2020/07/02冨上由喬
    */
?>

<!-- REMAKE HOME画面 -->
<title>ethicable｜REMAKE｜リサイクル詳細確認</title>
<script type="text/javascript">
    $(function() {
        $('#deleteBtn').on('click', function() {
            fadeToggle()
            console.log("dd");
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

            setTimeout(function() {
                $(".dark").fadeToggle("fast");
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
        <p><a href="remake_home.html">
                HOMEへ
            </a></p>
        <section>
            <div>
                QRコード表示場所
            </div>
            <p>
                QRコードをリサイクルボックスにある端末にかざして読み込ませてください。<br>
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
                <p class="qr_item_img"><img src=""></p>
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
                <p class="qr_item_img"><img src=""></p>
                <div>
                    <p>上記の商品のリメイク情報を<br>完全に削除しました。</p>
                    <p>１０秒後にホームに戻ります。</p>
                </div>
            </div>
        </div>
        <div class="dark">
        </div>
    </main>