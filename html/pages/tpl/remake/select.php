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
    var product = document.getElementsByName( "product" ) ;
    // 選択状態の値を取得
    for ( var a="", i=product.length; i--; ) {
      if ( product[i].checked ) {
        var product_select = product[i].value ;
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

    //ページ遷移
    var next_page = "./remake_details.php";
    location.href = next_page + "?product_id=" + product_id + "&product=" + product_select + "&color=" + color_select;


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

          <p>項目ごとに選択する</p>
          <p>部門</p>
          <input type="radio" name="product" value="1">サンプル1
          <input type="radio" name="product" value="2">サンプル2
          <input type="radio" name="product" value="3">サンプル3

          <p>カラー</p>
          <input type="radio" name="color" value="1">サンプル1
          <input type="radio" name="color" value="2">サンプル2
          <input type="radio" name="color" value="3">サンプル3
          
          <div>
              <input type="button" value="戻る">
              <input type="button" onclick="Confirmation()" value="確認">
          </div>
        </section>
    </main>
