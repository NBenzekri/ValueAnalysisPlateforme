<?php 

// Import PHPMailer classes into the global namespace
// These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

//Load composer's autoloader
require 'vendor/autoload.php';

$mail = new PHPMailer(true);
try {
    //Server settings
	$mail->IsSMTP(); // enable SMTP
	$mail->SMTPDebug = 1; // debugging: 1 = errors and messages, 2 = messages only
	$mail->SMTPAuth = true; // authentication enabled
	$mail->SMTPSecure = 'tls'; // secure transfer enabled REQUIRED for Gmail
	$mail->Host = "smtp.gmail.com";
	$mail->Port = 587; // or 587
	$mail->Username = "benz.morocco@gmail.com";
	$mail->Password = "0661608452@benz";

	    //Recipients
	$mail->setFrom('from@cloud-vap.com', 'cloud');
	$mail->addAddress('nouriddinbnz@gmail.com', 'Joe User');     // Add a recipient
	$email = "Joe User";
	$Template = file_get_contents("test.html");
    //Content
    $mail->isHTML(true);                                  // Set email format to HTML
    $mail->Subject = 'Here is the subject';
    $mail->Body    = $Template;

    $mail->send();
    echo 'Message has been sent';
} catch (Exception $e) {
	echo 'Message could not be sent.';
	echo 'Mailer Error: ' . $mail->ErrorInfo;
}

?>