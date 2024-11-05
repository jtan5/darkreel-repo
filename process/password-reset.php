<?php

// Include our libraries
include '../libraries/config.php';
include '../libraries/functions.php';
include '../libraries/read.php';
include '../libraries/write.php';


// Clean data passed from form POST
$rqst = rqst($_POST);


// Check if user found 
if (isset($rqst['prc1']) && isset($rqst['prc2'])) {
	$prc = mysql_read_password_reset($rqst['prc1'], $rqst['prc2']);
    
    if ($prc) {
        $the_user = mysql_read_user_xid($prc->user_id);
        
        if ($the_user) {
            if ($_POST['new_password'] == $_POST['new_password_confirm']) {
                // Delete the PRC so it can't be used again
                mysql_write_delete_prc($prc->reset_id);
                    
                // Encrypt the password
                $password = password_hash($_POST['new_password_confirm'], PASSWORD_DEFAULT);

                // Update the user's record in the database with the new encrypted value
                mysql_write_update_password($the_user->user_id, $password);

                // Let's log the user in, for their convenience
                $_SESSION['user_id'] = $the_user->user_id;

                
                // Send logged in user to home page
                header('Location: '.$site['url'].'/home.php');
                exit();
            }

            
            // New passwords didn't match
            header('Location: '.$site['url'].'/password.php?pri=match_new');
            exit();            
        }
        
        
        // No user found with the ID on the PRC
        header('Location: '.$site['url'].'/password.php?pri=user_id');
        exit();
    }
    
    
    // No valid PRC
    header('Location: '.$site['url'].'/password.php?pri=prc');
    exit();
}


// No PRC codes provided to this script
header('Location: '.$site['url'].'/password.php?pri=prc-set');
exit();
			
?>
