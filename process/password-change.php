<?php

// Include our libraries
include '../libraries/config.php';
include '../libraries/functions.php';
include '../libraries/read.php';
include '../libraries/write.php';


// If user isn't logged in, they can't access this script
if (!is_logged_in()) {
	header('Location: '.$site['url']);
	die();
}


// Clean data passed from form POST
$rqst = rqst($_POST);


// Check if user's current password matches what's on record
if (password_verify($_POST['current_password'], $user->password)) {
    // Check if new password was typed correctly twice
	if ($_POST['new_password'] == $_POST['new_password_confirm']) {
        // Encrypt the password
        $password = password_hash($_POST['new_password_confirm'], PASSWORD_DEFAULT);

        // Update the user's record in the database with the new encrypted value
        mysql_write_update_password($user->user_id, $password);
        
        // Send logged in user to home page
        header('Location: '.$site['url'].'/password.php?pc=success');
        exit();
    }
    
    // New passwords didn't match
    header('Location: '.$site['url'].'/password.php?pci=match_new');
    exit();

}

// Current password was wrong
header('Location: '.$site['url'].'/password.php?pci=current');
exit();

?>