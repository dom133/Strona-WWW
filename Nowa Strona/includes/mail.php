<?php
date_default_timezone_set('Etc/UTC');
require 'phpmailer/PHPMailerAutoload.php';  
                       
function sendMail($email, $subject, $body)
{
	$mail = new PHPMailer;
	$mail->CharSet = "UTF-8";
	//$mail->SMTPDebug = 2;
	$mail->isSMTP();                                    
	$mail->Host = 'smtp.gmail.com';  
	$mail->SMTPAuth = true;                               
	$mail->Username = 'norepleyskymin@gmail.com';                 
	$mail->Password = 'Dominik1';                           
	$mail->SMTPSecure = 'tls';                            
	$mail->Port = 587;                                    
	$mail->setFrom('norepleyskymin@gmail.com', 'Administracja SkyMin');	             
	$mail->isHTML(true); 
	$mail->addAddress($email);  
	$mail->Subject = $subject;
	$mail->Body = $body;
	
	if(!$mail->send()) {
		return $mail->ErrorInfo;
	} else {
		return true;
	}
}
?>