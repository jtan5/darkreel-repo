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


// Data we need
$profile_id = $user->user_id;
$profile = mysql_read_user_xid($profile_id);


// Customize the browser tab and display header
$title = 'Editing '.str_pluralize($profile->first_name).' Profile';
$body_css = '';

include 'template/header.php';
?>

	<main id="edit_profile">
		<div id="form">
            <h1>Edit profile</h1>
            
            <form action="<?php echo $site['url_process']; ?>/profile-update.php" method="post"  enctype="multipart/form-data">
                <input name="MAX_UPLOAD_SIZE" type="hidden" value="157286400">
        
				<label for="avatar">Avatar</label>
                <input id="avatar" name="avatar" type="file" value="">
				
				<?php if ($profile->avatar_url) : ?>
                <img src="<?php echo $profile->avatar_url; ?>" class="avatar" alt="<?php echo str_html_safe_echo($profile->first_name); ?>">
				<?php endif; ?>
				
				<label for="cover_photo">Cover Photo</label>
                <input id="cover_photo" name="cover_photo" type="file" value="">
				
				<?php if (isset($profile->cover_photo_url)) : ?>
                <div class="cover_photo_holder" style="background-image:url(<?php echo $profile->cover_photo_url; ?>);"></div>
				<?php endif; ?>
                
                <label for="first_name">First name</label>
                <input id="first_name" name="first_name" type="text" value="<?php echo str_html_safe_echo($profile->first_name); ?>">
				
                <label for="last_name">Last name</label>
				<input id="last_name" name="last_name" type="text" value="<?php echo str_html_safe_echo($profile->last_name); ?>">

                <label for="username">@username</label>
				<input id="username" name="username" type="text" value="<?php echo str_html_safe_echo($profile->username); ?>">
				
                <label for="email_address">Email address</label>
				<input id="email_address" name="email_address" type="text" value="<?php echo str_html_safe_echo($profile->email_addr); ?>">
				
				<input type="submit" class="save_button" value="Save">
			</form>	
			
			<a href="<?php echo $site['url']; ?>/password.php">Change password</a>
        </div>
        
        <aside>
			<!-- Nothing in the sidebar yet -->
		</aside>
	</main>

<?php

// Display footer
include 'template/footer.php';
?>