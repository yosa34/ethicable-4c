
<?php

/*
ページ詳細：リメイクショップメール送信画面
作成者：岸本蓮
編集者：2020/07/17岸本蓮
*/


//前ページから送られてくる値の受け取り
$subtotal = "小計： （".$_GET["item_amount"]."商品）".$_GET["subtotal"]."円";
$postage = "送料：   無料";
$use_point = "利用ポイント：     ".$_GET["use_point"]."pt";
$payment = "支払金額：   ".$_GET["total"]."";
$get_point = "獲得予定：     ".$_GET["points"]."ポイント（円相当）";
$pay_way = "支払い方法 クレジット";
$pay_way = $_GET["payment_method"];
$card_company = "カード会社 VISA";
$card_company = $_GET["card_company"];
$card_number = "カード番号 0000-0000-0000-0000";
$card_number = $_GET["card_number"];
$card_expiration_date = "有効期限 00月0000年";
$card_expiration_date = $_GET["expiration_date"];
$card_name = "名義人 氏名";
$card_name = $_GET["nominee"];
$shipping_name = "氏名 クレジット";
$shipping_name = $_GET["name"];
$shipping_address = "住所： 999-9999 大阪府大阪市北区梅田9-9";
$shipping_address = $_GET["address"];
$shipping_date = "7日後に発送されます";
$email = "mihiri70451@gmail.com";
$email = $_GET["email"];





require_once ( '../PHPMailer/class.phpmailer.php' );
$subject = "購入確認メール";
$body = "<html><body><p>ethicable購入確認メールです</p><p>確認してください</p><br><p>$subtotal</p><p>$postage</p><p>$use_point</p><p>$payment</p><p>$get_point</p><br><p>$pay_way</p><p>$card_company</p><p>$card_number</p><p>$card_expiration_date</p><p>$card_name</p><br><p>$shipping_name</p><p>$shipping_address</p><br><p>$shipping_date</p></body></html>";
$fromname = "ethicable";
$from = "ethicable";
$smtp_user = "ethicable.service@gmail.com";
$smtp_password = "googlepas8080";
$fromaddress = "mygoogle";
$to = $email;

$mail = new PHPMailer();
$mail->IsSMTP();
$mail->SMTPDebug = 1; // debugging: 1 = errors and messages, 2 = messages only
$mail->SMTPAuth = true;
$mail->CharSet = 'utf-8';
$mail->SMTPSecure = 'tls';
$mail->Host = "smtp.gmail.com";
$mail->Port = 587;
$mail->IsHTML(true);
$mail->Username = $smtp_user;
$mail->Password = $smtp_password; 
$mail->SetFrom($smtp_user);
$mail->From = $fromaddress;
$mail->Subject = $subject;
$mail->Body = $body;
$mail->AddAddress($to);

if( !$mail -> Send() ){
$message  = "Message was not sent<br/ >";
$message .= "Mailer Error: " . $mail->ErrorInfo;
} else {
$message  = "ユーザにメールを送信しました。";
}
header( "Location: ./remake_home.php" ) ;