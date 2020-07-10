<!DOCTYPE html>
<html>
<head>
  <!-- コンテンツ言語 -->
  <meta http-equiv="content-language" content="ja">
  <meta charset="UTF-8"/>
  <!-- キーワード -->
  <meta name="keywords" content="">
  <!-- 検索結果に表示される文字 -->
  <meta name="description" content="">
  <!-- 検索エンジンクローラにURLをインデックスしないように(noindex)文書内のURLを辿らないように(nofollow)知らせるため -->
  <meta name="robots" content="noindex,nofollow">
  <!-- 文書の作者 -->
  <meta name="author" content="ethical">

  <!-- ファビコン -->
<link rel="icon" href="../../favicon.ico">
 
 <!-- スマホ用アイコン -->
 <link rel="apple-touch-icon" sizes="180x180" href="./image/icon.png">
  

  <!-- ファイルタイプ、文字エンコーディングの指定 -->
  <meta http-equiv="content-type" content="text/html" charset="UTF-8">

  <!-- 優先CSSファイル -->
  <meta http-equiv="default-style" content="./style/css/style.css">
  <!-- resetCSS -->
  <link rel="stylesheet" href="./style/css/reset.css">
  <!-- SASSコンパイル先CSS -->
  <link rel="stylesheet" href="./style/css/style.css">

  <!-- jqueryバージョン３ -->
  <script type="text/javascript" src="./js/jquery-3.3.1.min.js"></script>

  <!-- Vue.jsインストール -->
  <script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>

  <!-- The core Firebase JS SDK is always required and must be listed first -->
  <script src="https://www.gstatic.com/firebasejs/7.15.0/firebase-app.js"></script>

  <!-- TODO: Add SDKs for Firebase products that you want to use
      https://firebase.google.com/docs/web/setup#available-libraries -->
  <script src="https://www.gstatic.com/firebasejs/7.15.0/firebase-analytics.js"></script>
  <script src="https://www.gstatic.com/firebasejs/7.15.0/firebase-auth.js"></script>

  <!-- firestoreDB接続 どっかで共通化てもいい-->
  <script src="https://www.gstatic.com/firebasejs/7.15.0/firebase-database.js"></script>
  <script src="https://www.gstatic.com/firebasejs/7.15.0/firebase-firestore.js"></script>	

  <!-- firebase設定js -->
  <script type="text/javascript" src="./js/firebase.js"></script>

  <!-- ログイン認証 -->
  <script>
  const db = firebase.firestore();

  //ログアウト処理
  function logout(){
    firebase.auth().signOut();
  }

  firebase.auth().onAuthStateChanged(function(user) {
        //ログイン状態判別
        if (user) {
          // firebase ユーザーデータ読み込み
          let citiesRef = db.collection('user').where("user_id", "==", user.uid);
          let allCities = citiesRef.get().then(snapshot => {
              snapshot.forEach(doc => {
                const data = doc.data()
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


