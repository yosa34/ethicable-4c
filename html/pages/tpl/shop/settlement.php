<?php
    /*
    ページ詳細：購入手続き画面
    作成者：小川紗世
    編集者：2020/07/02小川紗世
    */
?>

<script>
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
        <input type="button" value="注文を確認">
        <section>
            <h2>決済金額</h2>
            <div>
                <div>
                    <dl>
                    <dt>小計(2商品)</dt>
                    <dd>9,000円</dd>
                    </dl>
                    <dl>
                    <dt>送料</dt>
                    <dd>送料無料</dd>
                    </dl>
                    <dl>
                    <dt>利用ポイント</dt>
                    <dd><b>-253pt</b></dd>
                    </dl>
                </div>
                <dl>
                    <dt>総合計</dt>
                    <dd><b>10,500</b>円</dd>
                </dl>
                <dl>
                    <dt>獲得予定</dt>
                    <dd><b>90ポイント(円相当)</b></dd>
                </dl>
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
        <input type="button" value="注文を確認">
        <section>
            <h2>購入商品情報</h2>
            <ul>
                <li>
                    <p><img src="./image/product/414443.jpg" alt=""></p>
                    <div>
                        <dl>
                            <dt>部門(カテゴリー)：</dt>
                            <dd><img src="./image/category/1.png" alt=""><p>アウター</p></dd>
                        </dl>
                        <dl>
                            <dt>カラー：</dt>
                            <dd><span></span><p>GREY</p></dd>
                        </dl>
                        <p>価格：4,500円</p>
                    </div>
                </li>
            </ul>
        </section>
        <input type="button" value="注文を確認">
    </main>
