<?php

// Include our libraries
include 'libraries/config.php';
include 'libraries/functions.php';
include 'libraries/read.php';
include 'libraries/write.php';


// If session exists, send the user to the homepage
// They probably bookmarked our top level domain (example.com)
if (is_logged_in()) {
	header('Location: '.$site['url_home']);
	die();
}


// Customize the browser tab and display header
$title = '';
$body_css = '';

include 'template/header.php';
?>

	<main id="index">
		<div class="page_pane">
			<?php 
				// The login and registration forms output at lot of $_GET variables 
				// on index.php. This pagelet will show various messages based on the 
				// URL $_GET data passed in from the /process/do-x.php scripts
			
				include 'template/pagelets/messages-index-get.php'; 
			?>
			
			<h1>Welcome to <?php echo $site['name']; ?></h1>
			<h2>Witty slogan</h2>
			
			<p><?php echo $site['name']; ?> is a photo-sharing social network. Follow interesting snapshots from around the world.</p>
			
			<a href="<?php echo $site['url']; ?>/register.php" class="link_as_button">Sign up now &gt;</a>
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