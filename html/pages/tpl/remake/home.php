<?php
    /*
    ページ詳細：リメイクホーム画面
    作成者：小川紗世
    編集者：2020/06/26 長谷川雄大
    */
?>

<script>
  const db = firebase.firestore();

  //ログアウト処理
  function logout(){
    firebase.auth().signOut();
  }

  firebase.auth().onAuthStateChanged(function(user) {
        //ログイン状態判別
        if (user) {
          console.log(user.uid);
          // DB ユーザー情報読み込み
          let citiesRef = db.collection('user').where("user_id", "==", user.uid);
          let allCities = citiesRef.get().then(snapshot => {
              snapshot.forEach(doc => {
                const data = doc.data()
                console.log(data);
                // var userData = [];
                // this.userData.push({
                //   key:doc.id,
                //   });
                // console.log(this.userData);
              });
            })
            .catch(err => {
              console.log('Error getting documents', err);
            });
        } else{
          location.href = "./index.html"
        }
    });   


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
              <ul>
                <li>
                  <a href="#">
                    QRコード表示場所
                  </a>
                </li>
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


