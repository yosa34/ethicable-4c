<?php
    /*
    ページ詳細：リメイクショップホーム画面
    作成者：小川紗世
    編集者：2020/07/06小川紗世
    */
?>
<script src="./js/shop.js"></script>
<script>
firebase.auth().onAuthStateChanged(function(user) {
        if (user) {
            let startDate = firebase.firestore.Timestamp.fromDate(new Date("December 10, 1999"));
            let arrRemakeProductId = [];
            let arrRemakeDate = [];
            let arrProduct = [];
            let arrProductID = [];
            let arrCourseId = [];
            let arrColorId = [];
            let arrCategoryId = [];
            let arrData = [];

          // リメイク完了登録を行うリメイク依頼一覧(course_id ドキドキコース)
          db.collection("remake").where("course_id", "==", 1).where("remake_complete", "==", null)
          .orderBy("date_qr_read", "asc").startAt(startDate)
          .get()
          .then((querySnapshot) => {
            let result = '';
            querySnapshot.forEach((doc) => {
                // console.log(doc.data());
                // 配列にデータを格納
                arrData.push(doc.data());
                arrRemakeProductId.push(doc.data().remake_product_id);
                let ftDate =　doc.data().date_qr_read.toDate();
                arrRemakeDate.push(ftDate);
                arrProductID.push(doc.data().product_id);
                arrCourseId.push(doc.data().course_id);
                arrColorId.push(doc.data().color_id);
                arrCategoryId.push(doc.data().category_id);
            });
            
            let cnt = 0;　// ヒット件数
            for(var i = 0; i < arrData.length; i++) {
                var course_name = 'ワクワクコース';
                cnt += 1;
                if(arrCourseId[i] == 1){
                    course_name = 'ドキドキコース';
                }
                var img = getRemakeImg(arrCategoryId[i]);
                let color = getColorCode(arrColorId[i]);
                // console.log(color);
                let productName = getProductName(arrProductID[i]);
                // console.log(productName);
                // 取得したリメイク依頼情報を表示する
                result +=
                `<tr>
                 <td>`+ cnt + `</td>
                 <td>` + arrRemakeProductId[i] + `</td>
                 <td>` + getDate(arrRemakeDate[i]) + `</td>
                 <td>` + productName + `<img src=' ./image/product/` + arrProductID[i] + `.jpg' alt='商品画像'></td>
                 <td>` + course_name +`</td>
                 <td>`+ color +`<span style='background-color:`+ color +`;'></span></td>
                 <td>`+ getCategoryName(arrCategoryId[i]) +`<img src='`+ img +`'></td>
                 <td><p><a href='./remake_shop_details.php?remake_product_id=` + arrRemakeProductId[i] + `'>完了通知を送る</a></p></td>
                </tr>`;
            }
            document.querySelector('#result').innerHTML += result;
            }).catch( (error) => {
            // console.log(`データの取得に失敗しました (${error})`);
        });
        } else{
        }
});
</script>

<!-- リメイクショップHOME画面 -->
<title>ethicable｜リメイクショップ｜リメイク依頼一覧｜ドキドキコース</title>

</head>
  <body id="remake_shop_home">
    <!-- header -->
    <!-- main -->
    <main>
        <section>
            <ul>
                <li><a href="#">ドキドキコース</a></li>
                <li><a href="./remake_shop_home2.php?corse=2">ワクワクコース</a></li>
            </ul>
            <table >
                <thead>
                    <tr>
                        <th><p>No</p></th>
                        <th><p>リメイクID</p></th>
                        <th><p>依頼日</p></th>
                        <th><p>商品</p></th>
                        <th><p>コース</p></th>
                        <th><p>カラー</p></th>
                        <th><p>カテゴリー</p></th>
                        <th></th>
                    </tr>
                </thead>
                <tbody id="result"></tbody>
            </table>
        </section>
    </main>
