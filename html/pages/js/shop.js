/**
  取得したcategory_idをもとにアイテムアイコンのファイルパスを返す

  @param number   取得したcategory_id
  @return String  category_idに対応するカテゴリ名
**/
function getRemakeImg(num) {
  // category_idの値によって表示するアイテムアイコンのファイルパスを切り替える
  let imgPass;
  switch(num) {
    case 1:
      imgPass = "./image/category/1.png";
      break;
    case 2:
      imgPass = "./image/category/2.png";
      break;
    case 3:
      imgPass = "./image/category/3.png";
      break;
    case 4:
      imgPass = "./image/category/4.png";
      break ;
    case 5:
      imgPass = "./image/category/5.png";
      break;
    case 6:
      imgPass = "./image/category/6.png";
      break;
    case 7:
      imgPass = "./image/category/7.png";
      break;
    case 8:
      imgPass = "./image/category/8.png";
      break;
    default :
      console.log("カテゴリーが存在しません");
      break;
  }
  // 画像ファイルパスを返す
  return imgPass;
}

/**
取得したcategory_idをもとにカテゴリー名を返す

@param number   取得したcategory_id
@return string  category_idに対応するカテゴリ名
**/
function getCategoryName(num) {
  // category_idの値によってカテゴリー名を
  let categoryName;
  switch(num) {
    case 1:
      categoryName = "アウター";
      break;
    case 2:
      categoryName = "ボトムス";
      break;
    case 3:
      categoryName = "シャツ";
      break;
    case 4:
      categoryName = "カットソー";
      break ;
    case 5:
      categoryName = "ニット";
      break;
    case 6:
      categoryName = "グッズ（ネクタイ・帽子）";
      break;
    case 7:
      categoryName = "インナー";
      break;
    case 8:
      categoryName = "スエット";
      break;
    default :
      console.log("カテゴリーが存在しません");
      break;
  }
  // カテゴリー名を返す
  return categoryName;
  }

/**
  取得したproduct_sizeをもとにサイズ名を返す

  @param number   取得したproduct_size
  @return String  product_sizeに対応するサイズ名
**/
function getProductSize(size) {
  // product_sizeの値によって対応するサイズ名を返す
  let sizeName = "";
  switch(size) {
    case 2:
      sizeName = "XS";
      break;
    case 3:
      sizeName = "S";
      break;
    case 4:
      sizeName = "M";
      break;
    case 5:
      sizeName = "L";
      break;
    case 6:
      sizeName = "XL";
      break;
    default :
      console.log("サイズが存在しません");
      break;
  }
  // product_sizeに対応するサイズ名を返す
  return sizeName;
}

/**
    取得したcolor_idをもとに対応するカラーコードを返す

    @param number 取得したcolor_id
    @return string color_idに対応するカラーコード
  **/
function getColorCode(color_id) {
let colorCode;
switch(color_id) {
  case 0:
    colorCode = "#FFFFFF";
    break;
  case 1:
    colorCode = "#D5D3B5";
    break;
  case 3:
    colorCode = "#CEC9C4";
    break;
  case 8:
    colorCode = "#373537";
    break;
  case 9:
    colorCode = "#2C282D";
    break;
  case 27:
    colorCode = "#E97B6E";
    break;
  case 30:
    colorCode = "#DFCEC0";
    break;
  case 32:
    colorCode = "#CEB8A5";
    break;
  case 56:
    colorCode = "#77705A";
    break;
  case 59:
    colorCode = "#4B4E45";
    break;
  case 63:
    colorCode = "#3F4558";
    break;
  case 64:
    colorCode = "#A5ACD6";
    break;
  case 66:
    colorCode = "#507E96";
    break;
  case 69:
    colorCode = "#302E37";
    break;
  default:
    console.log("存在しないカラーIDです");
    break;
}
// カラーコードを返す
return colorCode;
}

/**
  取得したcolor_idをもとに対応するカラー名を返す

  @param number 取得したcolor_id
  @return string color_idに対応するカラー名
**/
function getColorName(color_id) {

  let colorName;
    switch(color_id) {
    case 0:
      colorName = "WHITE";
      break;
    case 1:
      colorName = "OFF WHITE";
      break;
    case 3:
      colorName = "GRAY";
      break;
    case 8:
      colorName = "DARK GRAY";
      break;
    case 9:
      colorName = "BLACK";
      break;
    case 27:
      colorName = "ORANGE";
      break;
    case 30:
      colorName = "NATURAL";
      break;
    case 32:
      colorName = "BEIGE";
      break;
    case 56:
      colorName = "OLIVE";
      break;
    case 59:
      colorName = "DARK GREEN";
      break;
    case 63:
      colorName = "BLUE";
      break;
    case 64:
      colorName = "BLUE";
      break;
    case 66:
      colorName = "BLUE";
      break;
    case 69:
      colorName = "NAVY";
      break;
    default:
      console.log("存在しないカラーIDです");
      break;
  }
  return colorName;
}

/**
  取得したproduct_priceをもとに獲得ポイント（切り捨て）を返す

  @param number 取得したproduct_price
  @return number 獲得ポイント
*/
function getPointAmount(price) {
let getPoint;
// 切り捨てる
getPoint = Math.floor(price/100);

// console.log(getPoint);
return getPoint;
}

/**
  合計金額を返す

  @param number 小計, 送料, 使用ポイント
  @return number 獲得ポイント
  (商品の小計 + 送料) - 使用ポイント = 総合計(お支払い金額)
*/
function getBillingAmount(subtotal, postage, use_point) {
  let billingAmount;
  billingAmount = (subtotal + postage) - use_point;
  // console.log(billingAmount);
  return billingAmount;
}

/**
  Date型をフォーマットする

  @param date
  @return date
*/
function getDate(date) {
  //「年」を取得する
  let YYYY = date.getFullYear();
  //「月」を取得する
  let MM = date.getMonth()+1;
  //「日」を取得する
  let DD = date.getDate();
  ftDate = YYYY + "年" + MM + "月" + DD + "日";
  // console.log(ftDate);
  return ftDate;
}

/**
  product_idをもとに商品名を取得する

  @param number product_id
  @return string 商品名
*/
function getProductName(product_id){
  let productName = '';
  switch(product_id) {
    case 414443:
      productName = "クルーネックT";
      break;
    case 416319:
      productName = "感動ジャケット(ウルトラライト・ウールライク)";
      break;
    case 422360:
      productName = "ウルトラストレッチスキニーフィットジーンズ";
      break;
    case 422821:
      productName = "エアリズムUVカットソフトレギンス";
      break;
    case 423015:
      productName = "シームレスVネックブラキャミソール";
      break;
    case 423071:
      productName = "リブボートネックフレンチスリーブブラ T";
      break;
    case 423073:
      productName = "ワイドリブスクエアネック ブラタンクトップ";
      break;
    case 423523:
      productName = "エアリズムVネックT";
      break;
    case 423527:
      productName = "エアリズムコットンクルーネックT";
      break;
    case 424586:
      productName = "UVカットジャージージャケット";
      break;
    case 424633:
      productName = "リネンコットンコート";
      break;
    case 425345:
      productName = "ウルトラストレッチレギンスパンツ";
      break;
    case 425374:
      productName = "コットンマーメイドロングスカート";
      break;
    case 425412:
      productName = "コンフォートブレザー";
      break;
    case 425669:
      productName = "クレープジャージーT";
      break;
    case 425813:
      productName = "ウルトラストレッチデニムレギンスパンツ";
      break;
    case 425901:
      productName = "感動ジャケット(グレンチェック)";
      break;
    case 426175:
      productName = "リネンコットンオープンカラーシャツ";
      break;
    case 426847:
      productName = "シャンブレーワークシャツ";
      break;
    case 427318:
      productName = "レーヨンプリントオープンカラーシャツ";
      break;
    case 427731:
      productName = "ジャージーテーラージャケット";
      break;
    case 427740:
      productName = "フレアロングスカート";
      break;
    case 428397:
      productName = "ミラクルエアー3Dジーンズ";
      break;
    case 430178:
      productName = "ボウタイブラウス（ノースリーブ）";
      break;
    case 430506:
      productName = "カラーステイスリムフィットジーンズ";
      break;
    case 431705:
      productName = "ベルテッドプリントフレアスカート";
      break;
  }
  // 商品名を返す
  return productName;
}