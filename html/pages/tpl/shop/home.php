<?php
    /*
    ページ詳細：商品ホーム画面
    作成者：小川紗世
    編集者：2020/06/27粟津由香
    */
?>

<script>
  // const db = firebase.firestore();

    firebase.auth().onAuthStateChanged(function(user) {
        if (user) {
          let arrRemakeProductId = [];
          let arrRemakeImg = [];

          // 販売可能なリメイク商品の商品データを取得する()
          // コレクションの指定
          db.collection("stocks").where("quantity", "==", "1").get().then((querySnapshot) => {
            let result = "";
            querySnapshot.forEach((docs) => {
              arrRemakeProductId.push(docs.data().remake_product_id);
              // console.log(arrRemakeProductId);
              arrRemakeImg.push(docs.data().remake_image);
              // console.log("全データ" +　docs.data());
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
<<<<<<< HEAD
          <li style="width: 50%;" id="result"></li>
=======
          <li><a id="product_details"><img id="remake_image" alt="リメイク商品画像"></a></li>
          <li><a id="product_details"><img id="remake_image" alt="リメイク商品画像"></a></li>
          <li><a id="product_details"><img id="remake_image" alt="リメイク商品画像"></a></li>
>>>>>>> 7e81d9711906f5d08cb0a39d75bcd0c7bef7d6b9
        </ul>
      </section>
    </main>
