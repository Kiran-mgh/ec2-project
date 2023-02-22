<?php
include_once ("C:xampp/htdocs/db_backup/Mysqldump/Mysqldump.php");
$dump = new Ifsnop\Mysqldump\Mysqldump ('mysql:host=localhost;dbname=dbname', 'root', '');
$f=date('d-m-Y');
$dump->start ("sql_dump/filename-$f.sql");

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'phpmailer/src/SMTP.php';
require 'phpmailer/src/PHPMailer.php';
require 'phpmailer/src/Exception.php';

//Load Composer's autoloader

require_once ("C:xampp/htdocs/db_backup/vendor/autoload.php");

//Create an instance; passing `true` enables exceptions
$mail = new PHPMailer();

try {
    //Server settings
   // $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
    $mail->isSMTP();                                            //Send using SMTP
    $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
    $mail->Username   = 'test@gmail.com';                     //SMTP username
    $mail->Password   = 'pwd';                               //SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
    $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

    //Recipients
    $mail->setFrom('test@gmail.com', 'php-mailer');
    $mail->addAddress('test@gmail.com', 'php-mailer');     //Add a recipient
    //$mail->addAddress('ellen@example.com');               //Name is optional
    //$mail->addReplyTo('no-reply@gmail.com', 'NO-reply');
   // $mail->addCC('test@gmail.com');
    //$mail->addBCC('test@gmail.com');

    //Attachments
    $mail->addAttachment("sql_dump/filename-$f.sql");         //Add attachments
   // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name

    //Content
    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = 'DB backup';
    $mail->Body    = 'database backup';
   // $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

    $mail->send();
    echo 'Message has been sent';
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}

?>