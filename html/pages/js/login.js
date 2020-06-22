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
        
        setTimeout(function () {
            location.href = "./remake_home.php"
        }, 1000);

    } else {
        console.log('logout');
    }
});   


