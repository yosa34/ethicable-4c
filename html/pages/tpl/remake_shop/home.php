<?php
    /*
    ページ詳細：リメイクショップホーム画面
    作成者：小川紗世
    編集者：2020/07/06 粟津由香
    */
?>
<script>
firebase.auth().onAuthStateChanged(function(user) {
        if (user) {
          // リメイク完了登録を行うリメイク依頼一覧(ドキドキコース)
          db.collection("remake").where("course_id", "==", 1).get().then((querySnapshot) => {
            let result = "";
            querySnapshot.forEach((docs) => {
             ;
            });
            for(var i = 0; i < arrRemakeProductId.length; i++) {
              // console.log(arrRemakeImg[i]);
              console.log(arrRemakeProductId[i]);
                result += "<li><a href='shop_details.php?remake_product_id="+ arrRemakeProductId[i] +"'><img src= '"+ arrRemakeImg[i] +"'></a></li>";
                document.querySelector('#result').innerHTML = result;
              }
          });
        } else{
        }
});
</script>

<!-- SHOP HOME画面 -->
<title>ethicable｜リメイクショップ</title>

</head>
  <body id="remake_shop_home">
    <!-- header -->
    <!-- main -->
    <main>
        <section>
            <table>
                <tr>
                    <th></th>
                    <th><p>リメイクID</p></th>
                    <th><p>依頼日</p></th>
                    <th><p>商品</p></th>
                    <th><p>コース</p></th>
                    <th><p>カラー</p></th>
                    <th><p>カテゴリー</p></th>
                    <th></th>
                </tr>
                <tr>
                    <td>1</td>
                    <td>000000</td>
                    <td>0000年00月00日</td>
                    <td>商品名<img src="./image/product/414443.jpg"></td>
                    <td>ドキドキコース</dd>
                    <td>#000000<span></span></td>
                    <td>カテゴリー名<img src="./image/category/1.png"></td>
                    <td><p><a href="./remake_shop_details.php">完了通知を送る</a></p></td>
                </tr>
                <tr>
                    <td>2</td>
                    <td>000000</td>
                    <td>0000年00月00日</td>
                    <td>商品名<img src="./image/product/414443.jpg"></td>
                    <td>ドキドキコース</dd>
                    <td>#000000<span></span></td>
                    <td>カテゴリー名<img src="./image/category/1.png"></td>
                    <td><p><a href="./remake_shop_details.php">完了通知を送る</a></p></td>
                </tr>
                <tr>
                    <td>3</td>
                    <td>000000</td>
                    <td>0000年00月00日</td>
                    <td>商品名<img src="./image/product/414443.jpg"></td>
                    <td>ドキドキコース</dd>
                    <td>#000000<span></span></td>
                    <td>カテゴリー名<img src="./image/category/1.png"></td>
                    <td><p><a href="./remake_shop_details.php">完了通知を送る</a></p></td>
                </tr>
            </table>
        </section>
    </main>

