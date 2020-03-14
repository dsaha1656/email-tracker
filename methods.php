<?php
	
	include 'fanty.php';
  use PHPMailer\PHPMailer\PHPMailer;
  use PHPMailer\PHPMailer\SMTP;
  require 'vendor/autoload.php';


	@session_start();
	date_default_timezone_set('Asia/kolkata');

	function login(){
		$db = new db();
		if (isset($_SESSION['username'])) {
			$uid =$_SESSION['username'];	
		}
		else{
			return false;
		}
		$query= "SELECT * FROM users WHERE email='".$db->stringpass($uid)."'";
		$query = $db->ask($query);
		if ($query->num_rows==1) {
			return true;
		}
		else{
			 return false;
		}
	}


  function send_mail($send_to, $subject, $message, $host='smtp.gmail.com', $email='thesleepingfire007@gmail.com', $password='DiByEnDu#@1'){

    //Create a new PHPMailer instance
    $mail = new PHPMailer;

    $mail->isSMTP();
    //Enable SMTP debugging
    // SMTP::DEBUG_OFF = off (for production use)
    // SMTP::DEBUG_CLIENT = client messages
    // SMTP::DEBUG_SERVER = client and server messages
    $mail->SMTPDebug = SMTP::DEBUG_SERVER;
    //Set the hostname of the mail server
    $mail->Host = $host;
    //Set the SMTP port number - likely to be 25, 465 or 587
    $mail->Port = 25;
    //Whether to use SMTP authentication
    $mail->SMTPAuth = true;
    //Username to use for SMTP authentication
    $mail->Username = $email;
    //Password to use for SMTP authentication
    $mail->Password = $password;
    //Set who the message is to be sent from
    $mail->setFrom('admin@gmail.com', 'Some Admin');
    //Set an alternative reply-to address
    $mail->addReplyTo('admin@gmail.com', 'some Last2');
    //Set who the message is to be sent to
    $mail->addAddress($send_to);
    //Set the subject line
    $mail->Subject = $subject;
    
    $mail->body = ($message);
    
    $mail->isHTML(true);

    //send the message, check for errors
    if (!$mail->send()) {
        // return false;
        echo 'Mailer Error: ' . $mail->ErrorInfo;
        die();
    } else {
      return true;
    }

  }

?>