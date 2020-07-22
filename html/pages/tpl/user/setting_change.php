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
        var age = document.getElementById('age').value;
        var address = document.getElementById( "address" ).value;
        var credit_card = document.getElementById( "credit_card" ).value;

        //プロフィールの更新処理
        db.collection("user").doc(user.uid).update({
          mail: mail,
          password: pass,
          gender:gender,
          age:age,
          address:address,
          credit_card:credit_card,
        })
        .then(function () {
            //登録したらリダイレクト
            location.href = "./mypage.php"
        })
        .catch(function(error) {
            console.error("Error adding document: ", error);
        });
      });
  }


</script>


<!-- SHOP HOME画面 -->
<title>ethicable｜マイページ｜個人情報設定変更</title>

</head>
  <body id="setting_change">
    <!-- header -->
    <?php include "./tpl/header.html"; ?>

    <!-- main -->
    <main>
        <div>
            <p>個人情報設定変更</p>
        </div>
        <section>
            <table id="app">
                <tr>
                    <th>Gmail：</th>
                    <td><input type="text" id="mail" v-bind:value=mail></td>
                </tr>
                <tr>
                    <th>Password：</th>
                    <td><input type="text" id="pass" v-bind:value=pass></td>
                </tr>
                <tr>
                    <th>性別：</th>
                    <td><input type="text" id="gender" v-bind:value=gender></td>
                </tr>
                <tr>
                    <th>年齢：</th>
                    <td><input type="text" id="age" v-bind:value=age></td>
                </tr>
                <tr>
                    <th>住所：</th>
                    <td><input type="text" id="address"v-bind:value=address></td>
                </tr>
                <tr>
                    <th>クレジット：</th>
                    <td>
                        <input type="text" id="credit_card" v-bind:value=credit_card>
                        <p><b>セキュリティコード</b>はクレジットカード裏面の末尾3桁(一部4桁)の数字です。(一部のクレジットカードの場合、カード表面右上にある4桁の数字となります。)</p>
                    </td>
                </tr>
            </table>
            <p>
                <a href="javascript:void(0)" onClick="register()">更新する</a>
            </p>
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
