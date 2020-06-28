<?php
    /*
    ページ詳細：商品ホーム画面
    作成者：小川紗世
    編集者：2020/06/12小川紗世
    */
?>

<script>
  // const db = firebase.firestore();

    firebase.auth().onAuthStateChanged(function(user) {
        if (user) {
        console.log(user.uid);
        let remake_product_id;
        // 販売可能なリメイク商品の商品データを取得する(quantity:0【完売】 quantity:1 【販売中】)
        db.collection('stocks').where('quantity', '==', '1').get().then(querySnapshot => {
        querySnapshot.forEach(docs => {
          console.log(docs.data()); // ログ出力
          // imgタグ要素を取得
          var elem1 = document.getElementById("remake_image");
          elem1.src = docs.data().remake_image;

          // リメイクIDを取得
          remake_product_id = docs.data().remake_product_id;
          var url = document.getElementById("product_details");
          // remake_product_idを含めたURLを生成
          url.href = "shop_details.php?remake_product_id=" + remake_product_id;
        });
      });
        } else{
        }
    });

</script>
<!-- SHOP HOME画面 -->
<title>ethicable｜SHOP｜HOME画面</title>

</head>
  <body id="shop_home">
    <!-- header -->
    <?php include "./tpl/header.html"; ?>

    <!-- main -->
    <main>
      <nav>
        <ul>
          <li style="border-bottom: 1px;">新着</li>
          <li>カテゴリ</li>
        </ul>
      </nav>
      <section>
        <ul style="display: flex; flex-wrap: wrap;">
          <li style="width: 50%;"><a id="product_details"><img id="remake_image" alt="リメイク商品画像"></a></li>
        </ul>
      </section>
    </main>
