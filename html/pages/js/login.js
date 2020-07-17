const db = firebase.firestore();

//googleログイン処理
function google_login(){
    const provider = new firebase.auth.GoogleAuthProvider();
    firebase.auth().signInWithPopup(provider)
}

//メールアドレスログイン処理
function email_login() {
    var email = document.getElementById('email').value;
    var password = document.getElementById('password').value;

    firebase.auth().signInWithEmailAndPassword(email, password)
    .catch(function(error) {
    alert('ログインできません（' + error.message + '）');
    });
}

//ログアウト処理
function logout(){
    firebase.auth().signOut();
}

firebase.auth().onAuthStateChanged(function (user) {
    
    if (user) {

        var provider = '';
        //ログインしたプロバイダーを取得
        user.providerData.forEach(function (profile) {
            provider = profile.providerId;
        });

        //新規ユーザーか判別
        var docRef = db.collection("user").doc(user.uid);
        docRef.get().then(function (doc) {
            //ユーザー情報がない時
            if (!doc.exists) {
                //プロバイダーごとの新規登録
                if (provider == 'password') {
                    //現在は新規登録ページがないのでリダイレクト
                    //location.href = "./remake_home.php"
                }

                if (provider == 'google.com') {
                    db.collection("user").doc(user.uid).set({
                        address: null,
                        age: null,
                        credit_card:null,
                        gender:null,
                        mail: user.email,
                        name:user.displayName,
                        postal_code:null,
                        user_id:user.uid,
                    })
                        .then(function () {
                        //登録したらリダイレクト
                        location.href = "./remake_home.php"
                    })
                    .catch(function(error) {
                        console.error("Error writing document: ", error);
                    });
                }
            } else {
                location.href = "./remake_home.php"

            }
        }).catch(function(error) {
            console.log("Error getting document:", error);
        });


    } else {
        console.log('logout');
    }
});   


