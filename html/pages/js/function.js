/**
取得したremake_product_idを使ってリメイク後の画像のURLを作成する

@param id     remake_product_id
@return string    画像URL
*/
function getImageUrl(id) {

    file = id+".jpg";
    console.log(file);
    return "https://firebasestorage.googleapis.com/v0/b/ethicable-4c.appspot.com/o/"+file+"?alt=media";
}

/**
取得したproduct_priceをもとに獲得ポイント（切り捨て）を返す

@param number 取得したproduct_price
@return number 獲得ポイント（100円で1ポイント）
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