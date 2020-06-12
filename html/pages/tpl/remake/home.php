<?php
    /*
    ページ詳細：リメイクホーム画面
    作成者：小川紗世
    編集者：2020/06/12小川紗世
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
          // firebase データ読み込み
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
    <main>
        <section>
        <button id="logout" onClick="logout()">logout</button>
        <a href="./shop_home.php">shop</a>

        </section>
    </main>


