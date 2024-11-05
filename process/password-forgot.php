<?php

// Include our libraries
include '../libraries/config.php';
include '../libraries/functions.php';
include '../libraries/read.php';
include '../libraries/write.php';


// Clean data passed from form POST
$rqst = rqst($_POST);


// If they submitted the form with an empty email adress field... 
if (!empty($rqst['email_address'])) {
	// They entered something in the email address field
	
	// Check if there's an account already registered with the supplied email address
	$user_reg = mysql_read_user_xemail($rqst['email_address']);


	// Check if user found 
	if ($user_reg) {
		// Generate two unique codes for auto-login on password reset link
		$prc1 = generate_uuid();
		$prc2 = generate_uuid();


		// 
		mysql_write_password_reset($user->user_id, $prc1, $prc2);

		$reset_url = $site['url'].'/password.php?prc1='.$prc1.'&prc2='.$prc2;


		//
		$copy_body = "Hello ".$user->first_name.",<br><br>

		A password reset was requested for your ".$site['name']." account.<br><br>

		Please <a href=\"".$reset_url."\">use this password reset link</a> and follow the prompts to successfully update your account.<br><br>

		The above link will expire in 24 hours.<br><br>

		Thanks for using ".$site['name'].".<br><br>

		Regards,<br>
		The ".$site['name']." Team<br><br>";

		$email_copy = file_get_contents('../template/email/password-reset.html');
		
		$email_copy = str_replace('#SITE_NAME#', $site['name'], $email_copy);
		$email_copy = str_replace('#HTML_BODY#', $copy_body, $email_copy);
		$html_body = str_replace('#APP_URL#', $site_url, $email_copy);


		//
		$plain_text = "Hello ".$user->first_name.",\n\n

		A password reset was requested for your ".$site['name']." account.\n\n

		Please use this password reset link (".$reset_url.") and follow the prompts to successfully update your account.\n\n

		The above link will expire in 24 hours.\n\n

		Thanks for using ".$site['name'].".\n\n

		Regards,\n
		The ".$site['name']." Team\n\n";


		//headers - specify your from email address and name here
		//and specify the boundary for the email
		$headers = "MIME-Version: 1.0\n";
		$headers .= "From: ".$site['name']." <".$site['general_email'].">\n";
		$headers .= "Reply-To: ".$site['name']." <".$site['general_email'].">\n";	
		$headers .= "Return-Path: ".$site['name']." <".$site['general_email'].">\n";
		$headers .= "X-Mailer: ServerSideMailer\n";

		$boundary = uniqid('np');
		$headers .= "Content-Type: multipart/alternative;boundary=" . $boundary . "\n";

		//here is the content body
		$message = "This is a MIME encoded message.";
		$message .= "\n\n--" . $boundary . "\n";
		$message .= "Content-type: text/plain;charset=utf-8\n\n";

		//Plain text body
		$message .= $plain_text;
		$message .= "\n\n--" . $boundary . "\n";
		$message .= "Content-type: text/html;charset=utf-8\n\n";

		//Html body
		$message .= $html_body;
		$message .= "\n\n--" . $boundary . "--";


		//
		$to = filter_var($user->email_addr, FILTER_SANITIZE_EMAIL);
		$subject = 'Password Reset Request';
		$optionalparams = '-r'.$site['general_email'];

		mail($to, $subject, $message, $headers, $optionalparams);


		// User's email address was found in the database and email sent
		header('Location: '.$site['url'].'/password.php?rc=success');
		exit();
	}


	// User's email address was not found in the database
	header('Location: '.$site['url'].'/password.php?ric=email_addr');
	exit();
}


// Kick them out...
header('Location: '.$site['url'].'/password.php?ric=blank');
exit();

?>