<?php
    /*
    ページ詳細：プロフィール変更画面
    作成者：小川紗世
    編集者：2020/06/12小川紗世
    */
?>

<script>

  //プロフィール更新処理
    function register(){
      firebase.auth().onAuthStateChanged(function(user) {

        //inputの値を取得
        var mail = document.getElementById('mail').value;
        var pass = document.getElementById('pass').value;
        var gender = document.getElementById('gender').value;
        var address = document.getElementById( "address" ).value;
        var credit_card = document.getElementById( "credit_card" ).value;

        //プロフィールの更新処理
        db.collection("user").doc(user.uid).update({
          mail: mail,
          password: pass,
          gender:gender,
          address:address,
          credit_card:credit_card,
        })
        .catch(function(error) {
            console.error("Error adding document: ", error);
        });
      });
  }


</script>


<!-- SHOP HOME画面 -->
<title>ethicable｜マイページ｜プロフィール変更</title>

</head>
  <body id="setting_change">
    <!-- header -->
    <?php include "./tpl/header.html"; ?>

    <!-- main -->
    <main>
        <section>
            <div id="app">
                <p>Gmail：<input type="text" id="mail" v-bind:value=mail></p>
                <p>Password：<input type="text" id="pass" v-bind:value=pass></p>
                <p>性別：<input type="text" id="gender" v-bind:value=gender></p>
                <p>年齢：<input type="text" id="age" v-bind:value=age></p>
                <p>住所：<input type="text" id="address"v-bind:value=address></p>
                <p>クレジット：<input type="text" id="credit_card" v-bind:value=credit_card></p>
            </div>

            <a href="javascript:void(0)" onClick="register()">更新する</a>
        </section>
    </main>
    <script>
        firebase.auth().onAuthStateChanged(function(user) {
            if (user) {
            console.log(user.uid);
            // firebase データ読み込み
            db.collection('user').doc(user.uid).get().then((doc) => {
                if (doc.exists) {

                var data = doc.data();
                console.log(data);

                var app = new Vue({
                el: '#app',
                data: {
                    mail: data.mail,
                    pass: data.password,
                    gender: data.gender,
                    age: data.age,
                    address:data.address,
                    postal_code:data.postal_code,
                    credit_card:data.credit_card
                }
                })
            }
            }).then(() => { //※追加
                // console.log(receiversData); //※追加
            }).catch(function (error) {
                console.log("Error getting document:", error);
            });

            } else{

            }
        });
    </script>
