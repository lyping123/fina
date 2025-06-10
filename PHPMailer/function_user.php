<?php
function sendEmail($to, $to_name, $from_name, $subject, $message, $header)
{
require_once('class.phpmailer.php');

$mail             = new PHPMailer();

$body             = $message;

$mail->IsSMTP(); // telling the class to use SMTP
$mail->Host       = "mail.gmail.com"; // SMTP server
$mail->SMTPDebug  = 2;                     // enables SMTP debug information (for testing)
										   // 1 = errors and messages
										   // 2 = messages only
$mail->SMTPAuth   = true;                  // enable SMTP authentication
$mail->SMTPSecure = "tls";                 // sets the prefix to the servier
$mail->Host       = "smtp.gmail.com";      // sets GMAIL as the SMTP server
$mail->Port       = 587;                   // set the SMTP port for the GMAIL server
$mail->Username   = "synergycollegenet@gmail.com";  // GMAIL username
$mail->Password   = "fpuqdekcnrpbfnqm";            // GMAIL password

$mail->SetFrom('synergycollege@gmail.com', $from_name);// 设置发件人地址和名称

$mail->AddReplyTo('no-reply@gmail.com',"No Reply");								// 设置邮件回复人地址和名称

$mail->Subject    = $subject;													// 设置邮件标题

//$mail->AltBody    = "To view the message, please use an HTML compatible email viewer!"; // optional, comment out and test

$mail->MsgHTML($body);															// 设置邮件内容

//$address = $to;
$mail->AddAddress($to, $to_name);															// 设置邮件收件人地址和名称

//var_dump($mail->Send());
// $mail->AddAttachment("images/phpmailer.gif");      // attachment
// $mail->AddAttachment("images/phpmailer_mini.gif"); // attachment

if(!$mail->Send()) {
  return $mail->ErrorInfo;
} else {
  return "success";
}
}





?>

