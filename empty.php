<?php

// Include our libraries
include 'libraries/config.php';
include 'libraries/functions.php';
include 'libraries/read.php';
include 'libraries/write.php';


// If no session exists, send the user to the login page
if (!is_logged_in()) {
	header('Location: '.$site['url']);
	die();
}


// Data fetching and processing goes here


// Customize the browser tab and display header
$title = '';
$body_css = '';

include 'template/header.php';
?>

	<main id="">
		<div class="page_pane">
			<!-- No page content yet! -->
		</div>
		
		<aside>
			<!-- Nothing in the sidebar yet -->
		</aside>
	</main>

<?php

// Display footer
include 'template/footer.php';
?>