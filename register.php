<?php

// Include our libraries
include 'libraries/config.php';
include 'libraries/functions.php';
include 'libraries/read.php';
include 'libraries/write.php';


// If session exists, send the user to the homepage
// (they don't need to see the registration page... they have an account)
if (is_logged_in()) {
	header('Location: '.$site['url_home']);
	die();
}


// Customize the browser tab and display header
$title = 'Register';
$body_css = '';

include 'template/header.php';
?>

	<main id="register">
		<div id="form">
			<h1>Register to use <?php echo $site['name']; ?></h1>
	
			<h2>The world's number one photo-sharing social network</h2>
			
			<p><?php echo $site['name']; ?> is FREE to use for anybody with an email address. Use it to share beautiful photos with friends from around the world.</p>
            
			<form action="<?php echo $site['url_process'].'/do-register.php'; ?>" method="post">
				<label for="email_address">Email address</label>
				<input id="email_address" name="email_address" type="text" placeholder="Email address">
				
                <label for="password">Password</label>
				<input id="password" name="password" type="password" placeholder="Password">
				
                <label for="first_name">First name</label>
				<input id="first_name" name="first_name" type="text" placeholder="First name">
				
                <label for="last_name">Last name</label>
				<input id="last_name" name="last_name" type="text" placeholder="Last name">

                <label for="username">Username</label>
				<input id="username" name="username" type="text" placeholder="@username">
				
				<input type="submit" value="Register">
			</form>	
		</div>
		
		<aside>
			<?php
                // Display the sidebar login pagelet
				include 'template/pagelets/login-form.php';
			?>
		</aside>
	</main>

<?php

// Display footer
include 'template/footer.php';
?>