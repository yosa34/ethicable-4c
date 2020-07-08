<?php
/*
    ページ詳細：リサイクル詳細確認
    作成者：小川紗世
    編集者：2020/06/12小川紗世
    */
?>
<script type="text/javascript" src="./js/remake_details.js"></script>

<!-- REMAKE HOME画面 -->
<title>ethicable｜REMAKE｜リサイクル詳細確認</title>

</head>

<body id="remake_datails">
    <!-- header -->
    <?php include "./tpl/header.html"; ?>

    <!-- main -->
    <main>
        <section>
            <h1>リサイクル詳細確認</h1>
            <div>
                <section class="dokidoki_select">
                    <div>
                        <p id="select_category">イメージ名</p>
                        <div>
                            <img src="./image/category/<?php echo ($_GET['category']); ?>.png" alt="イメージ画像">
                        </div>
                    </div>
                    <div>
                        <p id='select_color'>選択カラー</p>
                        <div id='select_color_box'></div>
                    </div>
                </section>
                <!-- <p>商品ID:000000</p>
              <h2>商品名</h2> -->
                <table>
                    <tr>
                        <th>コース:</th>
                        <td id='couse_name'>
                        </td>
                    </tr>
                    <tr>
                        <th>素材情報:</th>
                        <td id='product_name'></td>
                        <!-- <td id='category_name'></td> -->
                    </tr>
                    <tr>
                        <th></th>
                        <td><img src="./image/product/<?php echo ($_GET['product_id']); ?>.jpg" alt="商品画像"></td>
                        <!-- <td id='category_name'></td> -->
                    </tr>
                    <tr>
                        <th></th>
                        <td id='product_id'></td>
                        <!-- <td id='category_name'></td> -->
                    </tr>
                    <tr>
                        <th></th>
                        <td id='size_name'></td>
                        <!-- <td id='category_name'></td> -->
                    </tr>
                    <tr>
                        <th></th>
                        <td id='color_name'></td>
                        <!-- <td id='category_name'></td> -->
                    </tr>
                    <tr>
                        <th></th>
                        <td id='product_material'></td>
                        <!-- <td id='category_name'></td> -->
                    </tr>
                    <tr>
                        <th></th>
                        <td id='product_explanation'></td>
                        <!-- <td id='category_name'></td> -->
                    </tr>

                </table>
            </div>
          <div>
              <input type="button" value="戻る">
              <input type="button" value="QRコード発行" onclick='Qr_send()'>
          </div>
        </section>
    </main>