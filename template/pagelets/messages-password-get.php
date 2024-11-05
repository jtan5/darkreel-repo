<?php

// These are all the messages we show on the homepage 
// when there's trouble with logging in, registering,
// or just to say good bye when someone signs out.

?>

<?php 
	if (isset($_GET['rc']) && $_GET['rc'] == 'success') : 
?>

    <div class="get_messages logout_message">&check; We found your account and sent a reset password link to your email.</div>

<?php 
	elseif (isset($_GET['pci']) && $_GET['pic'] == 'match_new') : 
?>

    <div class="get_messages login_error">&times; Sorry, your new password was entered twice but they didn't match.</div>

<?php 
	elseif (isset($_GET['pci']) && $_GET['pci'] == 'current') : 
?>
    
	<div class="get_messages login_error">&times; Sorry, the current password you entered was wrong.</div>

<?php 
	elseif (isset($_GET['pc']) && $_GET['pc'] == 'success') : 
?>

    <div class="get_messages logout_message">&check; Your password was successfully updated!</div>

<?php 
	elseif (isset($_GET['ric']) && $_GET['ric'] == 'email_addr') : 
?>

    <div class="get_messages login_error">&times; We didn't find an account with that email address. Please try again!</div>

<?php 
	elseif (isset($_GET['ric']) && $_GET['ric'] == 'blank') : 
?>
    
	<!-- No email address was provided to the /process/password-forgot.php form. This bot/person ain't worth a message. -->

<?php 
	elseif (isset($_GET['pri']) && $_GET['pri'] == 'match_new') : 
?>

    <div class="get_messages login_error">&times; Sorry, your new password was entered twice but they didn't match.</div>

<?php 
	elseif (isset($_GET['pri']) && $_GET['pri'] == 'user_id') : 
?>

    <div class="get_messages login_error">&times; Sorry, the user who requested this password reset no longer exists.</div>

<?php 
	elseif (isset($_GET['pri']) && $_GET['pri'] == 'prc') : 
?>

    <div class="get_messages login_error">&times; Sorry, the password reset codes you provided are invalid.</div>

<?php 
	elseif (isset($_GET['pri']) && $_GET['pri'] == 'prc-set') : 
?>

    <!-- No prc codes were provided to the /process/password-reset.php form. This bot/person ain't worth a message. -->

<?php 
	endif; 
?>