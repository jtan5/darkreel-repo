<?php

// Include our libraries
include 'libraries/config.php';
include 'libraries/functions.php';
include 'libraries/read.php';
include 'libraries/write.php';


//
$page_title = 'Forgot Password';
if (isset($_REQUEST['prc1']) && isset($_REQUEST['prc2'])) {
    // Clean data passed from form POST
    $rqst = rqst($_POST);

    $reset_password = mysql_read_password_reset($rqst['prc1'], $rqst['prc2']);

    if ($reset_password) {
        $page_title = 'Reset Password';
    }
}

if (is_logged_in()) {
    $page_title = 'Change Password';
}

// Customize the browser tab and display header
$title = $page_title;
$body_css = '';

include 'template/header.php';
?>

	<main id="password">
		<div id="form">
            <h1><?php echo $site['name']; ?></h1>

            <h2><?php echo $page_title; ?></h2>

			<?php 
				// These forms output at lot of $_GET variables on password.php
				// This pagelet will show various messages based on the URL
				// $_GET data passed in from the /process/password-x.php scripts
			
				include 'template/pagelets/messages-password-get.php'; 
			?>
            
            <?php if (is_logged_in()) : ?>
            
            <p>Want to change your password? Good idea! Enter a new password now.</p>
            
            <form action="<?php echo $site['url_process']; ?>/password-change.php" method="post">
                <label for="current_password">Current password</label>
                <input id="current_password" name="current_password" type="text">
                
                <label for="new_password">New password</label>
                <input id="new_password" name="new_password" type="text">

                <label for="new_password_confirm">Confirm new password</label>
                <input id="new_password_confirm" name="new_password_confirm" type="text">
                
                <input type="submit" class="wide_butt" value="Change Password">
            </form>  
            
            <?php 
                else : 
                    if (!empty($reset_password)) {
                        // Display the password reset form
                        include 'template/pagelets/password-reset.php';
                    }
                    else {
                        // Display the forgot password form
                        include 'template/pagelets/password-forgot.php';
                    }
                endif; 
            ?>
		</div>
		
		<aside>
			<?php
                if (is_logged_in()) {
				    // Something for the viewer of this page if they're logged in
                }
                else {
                    // Display the sidebar login pagelet
                    include 'template/pagelets/login-form.php';
                }
			?>
		</aside>
	</main>

<?php

// Display footer
include 'template/footer.php';
?>