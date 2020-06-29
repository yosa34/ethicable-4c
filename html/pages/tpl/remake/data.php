<?php
    /*
    ページ詳細：読み取りデータの確認
    作成者：小川紗世
    編集者：2020/06/12小川紗世
    */
?>

<script type="text/javascript" src="./js/remake_data.js"></script>

<!-- REMAKE HOME画面 -->
<title>ethicable｜REMAKE｜読み取りデータの確認</title>

</head>
  <body id="remake_data">
    <!-- header -->
    <?php include "./tpl/header.html"; ?>

    <!-- main -->
    <main>
        <section>
            <h1>読み取りデータの確認</h1>
            <div>
                <p>
                    <img src="./image/product/<?php  echo($_GET['product_id']); ?>.jpg" alt="商品画像">
                </p>
                <p id='product_id'></p>
                <h2 id='product_name'></h2>
                <table>
                    <tr>
                        <th>カラー:</th>
                        <td id='color_name'></td>
                    </tr>
                    <tr>
                        <th>サイズ:</th>
                        <td id='size_name'></td>
                    </tr>
                    <tr>
                        <th>部門:</th>
                        <td id='department_name'></td>
                        <!-- <td id='category_name'></td> -->
                    </tr>
                </table>
            </div>
            <div>
                <input type="button" value="戻る">
                <input type="button" onclick="remake_select()" value="リメイク開始">
            </div>
        </section>
    </main>
