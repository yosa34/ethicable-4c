<?php
    /*
    ページ詳細：リメイクホーム画面
    作成者：小川紗世
    編集者：2020/06/26 岸本蓮
    */
?>

<script src="./js/shop.js"></script>
<script>
  //ログアウト処理
  function logout(){
    firebase.auth().signOut();
  }

  firebase.auth().onAuthStateChanged(function(user) {
      //ログイン状態判別
      if (user) {
        //なぜかnew Date()のみではフォーマットがうまくいかない。
        //notNULL判定をするだけなので適当に今年より前の日付を挿入
        var startDate = firebase.firestore.Timestamp.fromDate(new Date("December 10, 1999"));

        db.collection("remake").where("user_id", "==", user.uid).where("date_qr_read","==",null).orderBy("date_qr_generate", "asc").startAt(startDate)
        // db.collection("remake").where("user_id", "==", user.uid)
        .get()
        .then((querySnapshot) => {
          cnt = 0;
          querySnapshot.forEach( (doc) => {

            

            console.log("remake_product_id"+doc.data().remake_product_id);
            //ulタグを取得し、その中に<li><a><img></a></li>を作成
            //qr_detail.php => reamake_product_id
            var qr_ul = document.getElementById("qr_ul");
            qr_ul.insertAdjacentHTML("beforeend","<li><a id='qr_a_"+cnt+"' href='qr_detail.php?remake_product_id="+doc.data().remake_product_id+"'><img src='https://chart.apis.google.com/chart?chs=150x150&cht=qr&chl="+doc.data().remake_product_id+"' alt='QRコード'></a></li>");

              //colorとcategoryを取得し、htmlにセットする
            
            category_id_select(doc.data().category_id,cnt);
            color_code_select(doc.data().color_id,cnt);
            cnt++;
          });
        })
        .catch( (error) => {
          console.log(`データの取得に失敗しました (${error})`);
        });
      }else{
        location.href = "./index.html"
      }
    });

    //colorを取得
    function color_code_select(color,cnt){
      db.collection("color").where("color_id", "==", color)
      .get()
      .then((querySnapshot) => {
          querySnapshot.forEach( (doc) => {

            console.log(getColorCode(doc.data().color_id));
            get_color = getColorCode(doc.data().color_id);
            console.log(get_color);

            //タグ取得=>タグ書き換え
            var qr_a = document.getElementById("qr_a_"+cnt);
            qr_a.insertAdjacentHTML("beforeend","<span id='remake_color' style='width: 50px; height: 50px; display: block;'></span>");
            //これで背景色を書き換えないとSCSSに潰されてる気がする
            var remake_color = document.getElementById("remake_color");
            remake_color.style.backgroundColor = getColorCode(doc.data().color_id);
          });
        })
        .catch( (error) => {
          console.log(`データの取得に失敗しました (${error})`);
        });
    }

    function category_id_select(category,cnt){
      db.collection("category").where("category_id", "==", category)
      .get()
      .then((querySnapshot) => {
        querySnapshot.forEach((doc) => {
          const category_id = doc.data().category_id;
          
          console.log("category"+category_id);
          //タグ取得=>タグ書き換え
          var qr_a = document.getElementById("qr_a_"+cnt);
          qr_a.insertAdjacentHTML("beforeend","<img id='remake_icon' alt='リメイク希望のアイテムアイコン' style='width: 40px;'><span>×</span>");


          var elem2 = document.getElementById("remake_icon");
          // カテゴリーアイコンを表示
          elem2.src = getRemakeImg(category_id);
        });
      })
    }
</script>


<!-- REMAKE HOME画面 -->
<title>ethicable｜REMAKE｜HOME画面</title>
  <body id="remake_home">
    <!-- header -->
    <?php include "./tpl/header.html"; ?>

    <!-- main -->
    <main>
        <section>
          <div>
            <h2>現在発行中のQRコード</h2>
            <div>
<<<<<<< Updated upstream
              <ul id="qr_ul">
                
=======
              <ul>
                <li>
                  <a href="./qr_detail.php">
                    QRコード表示場所
                  </a>
                </li>
>>>>>>> Stashed changes
              </ul>
            </div>
            <a href="./remake_corse.php">リメイクする</a>
          </div>
          </div>
        </section>
        <section>
        </section>
        <div class="news">  
          <div class="item">
            <div class="inner">
              <img src="./image/remake_home_news1.png">
                <div class="inner2">
                  <p>
                    トレンド派もベーシック派も「着映えスカート」に注目！！
                  </p>
                  <h3>
                   May 23,2020 WOMEN
                 </h3>
              </div>
            </div>
          </div>
          <div class="item2">
            <div class="inner">
              <img src="./image/remake_home_news2.png">
                <div class="inner2">
                  <p>
                  手間いらずで旬顔！一枚でキマる優秀ワンピース
                  </p>
                  <h3>
                   May 13,2020 WOMEN
                 </h3>
              </div>
            </div>
          </div>
        </div>
    </main>
