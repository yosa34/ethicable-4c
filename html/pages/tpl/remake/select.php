<?php
    /*
    ページ詳細：リメイクデータ選択画面
    作成者：小川紗世
    編集者：2020/06/12小川紗世
    */
?>

<script>

  function Confirmation(){

    // product要素を取得
    var category = document.getElementsByName( "category" ) ;
    // 選択状態の値を取得
    for ( var a="", i=category.length; i--; ) {
      if ( category[i].checked ) {
        var category_select = category[i].value ;
        break ;
      }
    }
    
    // color要素を取得
    var color = document.getElementsByName( "color" ) ;
    // 選択状態の値を取得
    for ( var a="", i=color.length; i--; ) {
      if ( color[i].checked ) {
        var color_select = color[i].value ;
        break ;
      }
    }

    // GET URLのパラメータ取得
    var arg  = new Object;
    url = location.search.substring(1).split('&');
    
    for(i=0; url[i]; i++) {
        var k = url[i].split('=');
        arg[k[0]] = k[1];
    }
    var product_id = arg.product_id;
    let corse_number = arg.corse_number;

    //ページ遷移
    var next_page = "./remake_details.php";
    location.href = next_page + "?product_id=" + product_id + "&category=" + category_select + "&color=" + color_select + "&corse_number=" + corse_number;


  }

</script>

<!-- REMAKE HOME画面 -->
<title>ethicable｜REMAKE｜リサイクルイメージ＆カラー選択</title>

</head>
  <body id="remake_select">
    <!-- header -->
    <?php include "./tpl/header.html"; ?>

    <!-- main -->
    <main>
        <section>
          <h1>リサイクルイメージ＆カラー<br>選択</h1>

          <ul>
            <li>組み合わせで選択</li>
            <li>項目ごとに選択</li>
          </ul>
          <div>
            <p>部門</p>
            <ul>
              <li>
                <p>
                  <label for="category1"><img src="./image/category/1.png" alt=""></label>
                  <input type="radio" name="category" id="category1" value="1">ウィメンズ<br>ニット
                </p>
              </li>
              <li>
                <p>
                  <label for="category2"><img src="./image/category/2.png" alt=""></label>
                  <input type="radio" name="category" id="category2" value="2">ウィメンズ<br>ズボン
                </p>
              </li>
              <li>
                <p>
                  <label for="category3"><img src="./image/category/3.png" alt=""></label>
                  <input type="radio" name="category" id="category3" value="3">ウィメンズ<br>シャツ
                </p>
              </li>
            </ul>
          </div>
          <div>
            <p>カラー</p>
            <ul>
              <li>
                <p>
                  <label for="color1"></label>
                  <input type="radio" name="color" id="color1" value="1">サンプル1
                </p>
              </li>
              <li>
                <p>
                  <label for="color2"></label>
                  <input type="radio" name="color" id="color2" value="2">サンプル2
                </p>
              </li>
              <li>
                <p>
                  <label for="color3"></label>
                  <input type="radio" name="color" id="color3" value="3">サンプル3
                </p>
              </li>
            </ul>
          </div>
          
          <div>
              <input type="button" value="戻る">
              <input type="button" onclick="Confirmation()" value="確認">
          </div>
        </section>
    </main>
