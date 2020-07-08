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