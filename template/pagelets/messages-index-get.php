<?php

// These are all the messages we show on the homepage 
// when there's trouble with logging in, registering,
// or just to say good bye when someone signs out.

?>

<?php 
	if (isset($_GET['logout']) && $_GET['logout'] == 'success') : 
?>

    <div class="get_messages logout_message">&check; You've been signed out. See you again soon!</div>

<?php 
	elseif (isset($_GET['login_error']) && $_GET['login_error'] == 'password') : 
?>

    <div class="get_messages login_error">&times; We found your account but the password was wrong. Please try again!</div>

<?php 
	elseif (isset($_GET['login_error']) && $_GET['login_error'] == 'user') : 
?>
    
	<div class="get_messages login_error">&times; No account was found with the provided email address. Please sign up now!</div>

<?php 
	elseif (isset($_GET['login_error']) && $_GET['login_error'] == 'blank') : 
?>

    <!-- No email address was provided to the /process/do-login.php form. This bot/person ain't worth a message. -->

<?php 
	elseif (isset($_GET['register_error']) && $_GET['register_error'] == 'user') : 
?>

    <div class="get_messages login_error">&times; There's already an existing account with the email address you provided. Try signing in!</div>

<?php 
	elseif (isset($_GET['register_error']) && $_GET['register_error'] == 'blank') : 
?>
    <!-- No email address was provided to the /process/do-register.php form. This bot/person ain't worth a message. -->

<?php 
	endif; 
?>