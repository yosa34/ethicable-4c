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
          
          // リメイク完了登録を行うリメイク依頼一覧
          db.collection("remake").where("course_id", "==", 0).get().then((querySnapshot) => {
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
<title>ethicable｜リメイクショップ｜リメイク依頼詳細</title>

</head>
  <body id="remake_shop_details">
    <!-- header -->
    <!-- main -->
    <main>
        <p><a href="./remake_shop_home.php">リメイク依頼一覧に戻る</a></p>
        <p>依頼日：0000年00月00日</p>
        <section>
            <p>依頼内容</p>
            <div>
                <dl>
                    <dt>リメイクID：</dt>
                    <dd>000000</dd>
                </dl>
                <dl>
                    <dt>コースID：</dt>
                    <dd>ドキドキコース</dd>
                </dl>
                <dl>
                    <dt>商品：</dt>
                    <dd>
                        <img src="./image/product/414443.jpg" alt="">
                        <div>
                            <div>
                                <p>商品ID:00000</p>
                                <p>サイズ:Mサイズ</p>
                            </div>
                            <p>商品名</p>
                            <div>
                                <span></span>
                                <p>カラー</p>
                            </div>
                        </div>
                    </dd>
                </dl>
                <dl>
                    <dt>カラー：</dt>
                    <dd>
                        <span></span>
                        <select>
                            <option value="">#000000</option>
                            <option value="">#000000</option>
                            <option value="">#000000</option>
                        </select>
                    </dd>
                </dl>
                <dl>
                    <dt>カテゴリー：</dt>
                    <dd>
                        <span></span>
                        <select>
                            <option value="1">カテゴリー１</option>
                            <option value="2">カテゴリー２</option>
                            <option value="3">カテゴリー３</option>
                        </select>
                    </dd>
                </dl>
                <dl>
                    <dt>リメイク後の画像：</dt>
                    <dd>
                        <input type="file" name="datafile" id="filesend">
                    </dd>
                </dl>
            </div>
        </section>
        <section>
            <p>ユーザー情報</p>
            <div>
                <dl>
                    <dt>ユーザー名：</dt>
                    <dd>ユーザー名</dd>
                </dl>
                <dl>
                    <dt>メールアドレス：</dt>
                    <dd>mail@gmail.com</dd>
                </dl>
            </div>
        </section>
        <input type="submit" value="リメイク完了">
    </main>

