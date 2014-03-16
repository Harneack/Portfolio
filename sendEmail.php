<?php
	
	$name = trim($_POST['name']);
	$email = $_POST['email'];
	$comments = $_POST['comments'];
	
	$site_owners_email = 'john@'; // Replace this with your own email address
	$site_owners_name = 'john doe'; // replace with your name
	
	if (strlen($name) < 2) {
		$error['name'] = "Please enter your name";	
	}
	
	if (!preg_match('/^[a-z0-9&\'\.\-_\+]+@[a-z0-9\-]+\.([a-z0-9\-]+\.)*+[a-z]{2}/is', $email)) {
		$error['email'] = "Please enter a valid email address";	
	}
	
	if (strlen($comments) < 3) {
		$error['comments'] = "Please leave a comment.";
	}
	
	if (!$error) {
		
		require_once('phpMailer/class.phpmailer.php');
		$mail = new PHPMailer();
		
		$mail->From = $email;
		$mail->FromName = $name;
		$mail->Subject = "Website Contact Form";
		$mail->AddAddress($site_owners_email, $site_owners_name);
		$mail->Body = $comments;
		
		// GMAIL STUFF
		
		$mail->Mailer = "";
		$mail->Host = "";
		$mail->Port ="" ;
		$mail->SMTPSecure = ""; 
		
		$mail->SMTPAuth = false; // turn on SMTP authentication
		$mail->Username = ""; // SMTP username
		$mail->Password = ""; // SMTP password
	
		
		$mail->Send();
		
		echo "<li class='success'> Thank You, " . $name . ". I've received your email. I'll be in touch as soon as possible! </li>";
		
	} # end if no error
	else {

		$response = (isset($error['name'])) ? "<li>" . $error['name'] . "</li> \n" : null;
		$response .= (isset($error['email'])) ? "<li>" . $error['email'] . "</li> \n" : null;
		$response .= (isset($error['comments'])) ? "<li>" . $error['comments'] . "</li>" : null;
		
		echo $response;
	} # end if there was an error sending

?>
