<?php
    /*
    ページ詳細：注文履歴画面
    作成者：小川紗世
    編集者：2020/07/02小川紗世
    */
?>

<script>
</script>
<!-- SHOP ｜ カート ｜ 注文履歴画面 -->
<title>ethicable｜SHOP｜カート｜注文履歴</title>

</head>
  <body id="order_confirmation">
    <!-- header -->
    <?php include "./tpl/header.html"; ?>

    <!-- main -->
    <main>
      <h1>注文確認</h1>
      <input type="button" value="完了">
      <section>
        <div>
          <div>
            <dl>
              <dt>小計(2商品)</dt>
              <dd>9,000円</dd>
            </dl>
            <dl>
              <dt>送料</dt>
              <dd>送料無料</dd>
            </dl>
            <dl>
              <dt>利用ポイント</dt>
              <dd><b>-253pt</b></dd>
            </dl>
          </div>
          <dl>
            <dt>総合計</dt>
            <dd><b>10,500</b>円</dd>
          </dl>
          <dl>
            <dt>獲得予定</dt>
            <dd><b>90ポイント(円相当)</b></dd>
          </dl>
        </div>
      </section>
      <section>
        <!-- 支払い方法 -->
        <div>
            <div>
                <p>お支払方法</p>
            </div>
            <div>
                <table>
                  <tr>
                      <th>支払い方法：</th>
                      <td>クレジット</td>
                  </tr>
                  <tr>
                      <th>カード会社：</th>
                      <td>VISA</td>
                  </tr>
                  <tr>
                      <th>カード番号：</th>
                      <td>0000-0000-0000-0000</td>
                  </tr>
                  <tr>
                      <th>有効期限：</th>
                      <td>00月0000年</td>
                  </tr>
                  <tr>
                      <th>名義人：</th>
                      <td>氏名</td>
                  </tr>
                </table>
            </div>
        </div>
        <!-- 発送先 -->
        <div>
            <div>
              <p>発送先</p>
            </div>
            <div>
              <table>
                  <tr>
                      <th>氏名：</th>
                      <td><p>クレジット</p></td>
                  </tr>
                  <tr>
                      <th>住所：</th>
                      <td><p>999-9999</p><p>大阪府大阪市北区梅田9-9</p></td>
                  </tr>
                </table>

            </div>
        </div>
      </section>

     <input type="button" value="完了">
    </main>
