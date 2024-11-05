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
	if (!$user_reg) {
		// No user was found so encrypt the password
		$password = password_hash($_POST['password'], PASSWORD_DEFAULT);

		// No user was found so we create a new account
		$user_id = mysql_write_register($rqst['email_address'], $password, $rqst['first_name'], $rqst['last_name'], $rqst['username']);
		$user = mysql_read_user_xid($user_id);

		// Let's log the new user in
		$_SESSION['user_id'] = $user->user_id;

		// Send logged in user to home page
		header('Location: '.$site['url'].'/home.php');
		exit();
	}

	//pretty_print($user_reg);

	// User's email address was found in the database
	header('Location: '.$site['url'].'/?register_error=user');
	exit();
}


// Kick them out...
header('Location: '.$site['url'].'/?register_error=blank');
die();

?>