<?php
/*
    ページ詳細：リメイクデータ選択画面
    作成者：小川紗世
    編集者：2020/06/12小川紗世
    */
?>

<script type="text/javascript" src="./js/remake_select.js"></script>
<script type="text/javascript" src="./js/shop.js"></script>

<!-- REMAKE HOME画面 -->
<title>ethicable｜REMAKE｜リメイクイメージ＆カラー選択</title>

</head>

<body id="remake_select">
  <!-- header -->
  <?php include "./tpl/header.html"; ?>

  <!-- main -->
  <main>
    <section>
      <h1>リメイクイメージ＆カラー<br>選択</h1>
      <div>
        <ul>
          <li id="combi_select">組み合わせで選択</li>
          <li id="cate_select">項目ごとに選択</li>
        </ul>
        <div class="cate_con">
          <p class="con_title">部門</p>
          <ul>
            <li>
              <p>
                <input type="radio" name="category" id="category1" value="1">
                <label for="category1"><img src="./image/category/1.png" alt=""></label>
                部門：ウィメンズ<br>カテゴリー：アウター
              </p>
            </li>
            <li>
              <p>
                <input type="radio" name="category" id="category2" value="2">
                <label for="category2"><img src="./image/category/2.png" alt=""></label>
                部門：ウィメンズ<br>カテゴリー：ボトムス
              </p>
            </li>
            <li>
              <p>
                <input type="radio" name="category" id="category3" value="3">
                <label for="category3"><img src="./image/category/3.png" alt=""></label>
                部門：ウィメンズ<br>カテゴリー：シャツ
              </p>
            </li>
          </ul>
        </div>
        <div class="cate_con">
          <p class="con_title">カラー</p>
          <ul>
            <li>
              <p>
                <input type="radio" name="color" id="color1" value="64">
                <label for="color1" id='select_color_box1'></label>
                カラー：64 BLUE
              </p>
            </li>
            <li>
              <p>
                <input type="radio" name="color" id="color2" value="32">
                <label for="color2" id='select_color_box2'></label>
                カラー：32 BEIGE
              </p>
            </li>
            <li>
              <p>
                <input type="radio" name="color" id="color3" value="1">
                <label for="color3" id='select_color_box3'></label>
                カラー：1 OFF WHITE
              </p>
            </li>
          </ul>
      </div>
      <div id="combi_con">
        <ul>
          <li>
            <input type="radio" name="combi" id="combi1" value="1,1">
            <label for="combi1">
                <ul>
                  <li>
                    <input type="hidden" id="category_hidden" value="1">
                    <img src="./image/category/1.png" alt="">
                    <p>部門1桁目:2 ウィメンズ<br>部門2桁目:アウター</p>
                  </li>
                  <li>
                    <p>×</p>
                  </li>
                  <li>
                    <input type="hidden" id="color_hidden" value="1">
                    <div class="color_box_outer">
                      <div class="color_box1"></div>
                    </div>
                    <p>カラー：1 OFF WHITE</p>
                  </li>
                </ul>
            </label>
          </li>
          <li>
            <input type="radio" name="combi" id="combi2" value="2,69">
            <label for="combi2">
                <ul>
                  <li>
                  <input type="hidden" id="category_hidden2" value="2">
                    <img src="./image/category/1.png" alt="">
                    <p>部門1桁目:2 ウィメンズ<br>部門2桁目:ボトムス</p>
                  </li>
                  <li>
                    <p>×</p>
                  </li>
                  <li>
                    <input type="hidden" id="color_hidden2" value="32">
                    <div class="color_box_outer">
                      <div class="color_box2"></div>
                    </div>
                    <p>カラー：32 BEIGE</p>
                  </li>
                </ul>
            </label>
          </li>
        </ul>
      </div>
      </div>

      <div>
        <input type="button" value="戻る">
        <input type="button" onclick="Confirmation()" value="確認">
      </div>
    </section>
  </main>