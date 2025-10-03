<?php
require __DIR__ . '/../vendor/autoload.php'; // load PHPMailer
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;



function sendReceiptMail($toEmail, $toName, $subject, $body) {
    $mail = new PHPMailer(true);

    try {
        // Server settings
        $mail->isSMTP();

        $mail->Host       = 'smtp.gmail.com'; // e.g. smtp.gmail.com
        $mail->SMTPDebug = 2; // show detailed logs
        $mail->Debugoutput = 'error_log';
        $mail->SMTPAuth   = true;
        $mail->Username   = 'synergycollegenet@gmail.com';      // your SMTP username
        $mail->Password   = 'zmcviivybgaqazui';       // your SMTP password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; // or PHPMailer::ENCRYPTION_SMTPS
        $mail->Port       = 587; // 465 if SMTPS
        $mail->Timeout = 15; // 15 seconds max
        $mail->SMTPOptions = [
            'ssl' => [
                'verify_peer' => false,
                'verify_peer_name' => false,
                'allow_self_signed' => true,
            ],
        ];

        // Sender & Recipient
        $mail->setFrom('synergycollege@gmail.com', 'Synergy Academy');
        $mail->addAddress($toEmail, $toName);

        // Attach PDF (from string, no need to save file)
        // $mail->addStringAttachment($pdfContent, $pdfFilename);
        $mail->AddReplyTo('no-reply@gmail.com',"No Reply");
        // Content
        $mail->isHTML(true);
        $mail->Subject = $subject;
        $mail->Body    = $body;
        $mail->AltBody = strip_tags($body);

        $mail->send();
        return true;
    } catch (Exception $e) {
        return "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
}
