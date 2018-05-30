<?php
// Import PHPMailer classes into the global namespace
// These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

//Load composer's autoloader
//require 'vendor/autoload.php';
require 'PHPMailer.php';
require  'exception.php';
require  'POP3.php';
require  'SMTP.php';

$mail = new PHPMailer(true);                              // Passing `true` enables exceptions
try {
    //Server settings
    $mail->SMTPDebug = 0;                                 // Enable verbose debug output
    $mail->isSMTP();                                      // Set mailer to use SMTP
    $mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
    $mail->SMTPAuth = true;                               // Enable SMTP authentication
    $mail->Username = 'mwangikenneth18@gmail.com';                 // SMTP username
    $mail->Password = '32905202';                           // SMTP password
    //$mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
    $mail->SMTPSecure = 'ssl`';                            // Enable TLS encryption, `ssl` also accepted
    $mail->CharSet = 'utf-8';
    $mail->Port = 25;                                    // TCP port to connect to

    //Recipients
    $mail->setFrom('mwangikenneth18@gmail.com', 'BodaBoda Sacco Management System');
    //$mail->addAddress('mwangikenneth18@gmail.com', 'Kenneth );     // Add a recipient
    $mail->addAddress('kennethmwangi18@gmail.com', 'Kenny Mwas');     // Add a recipient
    $mail->From="bodabodasaccomanagementsystem@gmail.com";
    $mail->FromName="BodaBoda Sacco Management System";
    $mail->Sender="bodabodasaccomanagementsystem@gmail.com";
    $mail->AddReplyTo("bodabodasaccomanagementsystem@gmail.com", "BodaBoda Sacco");
    //$mail->addAddress('ellen@example.com');               // Name is optional
   // $mail->addReplyTo('info@example.com', 'Information');
    //$mail->addCC('cc@example.com');
   // $mail->addBCC('bcc@example.com');

    //Attachments
   // $mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
   // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
     //$mail->addAttachment('logo.png');    // Optional name

    //Content
    $mail->isHTML(true);                                  // Set email format to HTML
    $mail->AddEmbeddedImage('logo.png', 'logoimg', 'logo.png');
    $mail->Subject = 'Thank you for registering!';
    /**$mail->Body    = 'This is the HTML message body <b>in bold!</b>
                    <p><a href="http://localhost/chama"><img src=\"cid:logoimg\" /><a/></p>';**/
    $mail->Body  =//'Hi, ' . $name .
     '<html>
        <head>
        <title>BodaBoda Sacco </title>
        </head>
        <body>
        <p>Welcome to bodaboda sacco ,we have received your application.Please wait for approval after 48 hrs</p>
        <p>Please follow this link to visit the page after 48 hrs <a href="http://localhost/sacco_system/index.php/member/login"><u>link</u></a></p>
        
        </body> 
        </html>';
		
        //' Your will use your email address to login.Your email is :  ' . $email . '<p><img src=\"cid:logoimg\" /></p>';

       
    //$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

     $mail->send();
     // $this->registry->template->info_msg = 'Email sent ';
	 echo 'email sent';
} 

catch (Exception $e) {
    //$this->registry->template->error_msg = 'Message could not be sent';
    echo 'Message could not be sent.';
    //$this->registry->template->error_msg = 'That phone contact is already in use'.$mail->ErrorInfo ;
    echo 'Mailer Error: ' . $mail->ErrorInfo;
}