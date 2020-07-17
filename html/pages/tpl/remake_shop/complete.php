
<?php

/*
ページ詳細：リメイクショップメール送信画面
作成者：岸本蓮
編集者：2020/07/17岸本蓮
*/

//前ページから送られてくる値の受け取り
$remake_product_id = 8;
$product_name = "エアリズム";
$email = "mihiri70451@gmail.com";

$remake_product_id = $_GET["remake_product_id"];
$product_name = $_GET["product_name"];
$email = $_GET["email"];



$remake_img_pas = "https://firebasestorage.googleapis.com/v0/b/ethicable-4c.appspot.com/o/".$remake_product_id.".jpg?alt=media";

require_once ( '../PHPMailer/class.phpmailer.php' );
$subject = "リメイク完了メール";
$body = "<html><body><p>↓リメイク前の選択アイテム名↓</p><p>".$product_name."</p><br><p>↓リメイク完了後イメージ画像↓</p><img src='".$remake_img_pas."'></body></html>";
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
header( "Location: remake_shop_home.php" ) ;