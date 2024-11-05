<?php

### NOTE
// Profiles are visible to the open internet


// Include our libraries
include 'libraries/config.php';
include 'libraries/functions.php';
include 'libraries/read.php';
include 'libraries/write.php';


// Sanitize data passed in
$rqst = rqst($_GET, '', array('id'));


// Data we need
$profile_id = $user->user_id;
if ($rqst && $rqst['id']) {
	$profile_id = $rqst['id'];
}

if (!is_logged_in() && !$rqst['id']) {
    header('Location: '.$site['url']);
    exit();
}

// Grab the user's profile information
// and mini feed list (recent posts)
$profile = mysql_read_user_xid($profile_id);
$mini_feed = mysql_read_mini_feed_list($profile->user_id);

// Grab the list of people following this profile 
// and count the number of people in the array
$followers = mysql_read_followers_list($profile->user_id);
$followers_c = count($followers);

// Grab the list of people this profile is following
// and count the number of people in the array
$following = mysql_read_following_list($profile->user_id);
$following_c = count($following);


// Customize the browser tab and display header
$title = str_pluralize($profile->first_name).' Profile';
$body_css = '';

include 'template/header.php';
?>

	<main id="profile">
		<div class="cover_photo"<?php if (isset($profile->cover_photo_url)) : ?> style="background-image:url(<?php echo $profile->cover_photo_url; ?>);"<?php endif; ?>>
			<div class="avatar">
                <img src="<?php echo $profile->avatar_url; ?>" alt="<?php echo str_html_safe_echo($profile->first_name.' '.$profile->last_name); ?>">
			</div>
		</div>
		
		<section>
			<aside>
				<h2><?php echo $profile->first_name.' '.$profile->last_name; ?></h2>
				<h3><?php echo str_first_at($profile->username); ?></h3>

				<?php 
					// If this is not this user's profile
					// Show the follow or unfollow button
					if ($profile->user_id != $user->user_id) :
						// If the user is not following this profile, make it a follow button
						$button_label = 'Follow';
						$button_class = 'follow_user';
						$button_isfollowing = 0;

						// If the user if following this profile, show the unfollow button
						if (in_array($user->user_id, $followers)) {
							$button_label = 'Following';
							$button_class = 'following_user';
							$button_isfollowing = 1;
						}
				?>
				<button class="follow_button <?php echo $button_class; ?>" data-isfollowing="<?php echo $button_isfollowing; ?>"<?php if (is_logged_in()) : ?> onclick="toggleFollowing(this, <?php echo $profile->user_id; ?>);"<?php else: ?> disabled<?php endif; ?>><?php echo $button_label; ?></button>
				<?php 
					else :
						// The user is viewing their own profile
						// So show them the edit profile link
				?>
				<div class="edit_profile">
					<a href="edit-profile.php">Edit profile</a>
				</div>    
				<?php
					endif; 
				?>

				<div class="followers">
					<span class="top"><?php echo $following_c; ?> following</span>
					<span class="top"><span id="followers_c"><?php echo $followers_c; ?></span> <?php echo str_multi_s($followers_c, 'follower'); ?></span>
				</div>
			</aside>

			<div class="profile_right">
				<?php
					// If this is this user's profile, show the post creator 
					// Users can't post on each other's profiles as-is
					if ($profile->user_id == $user->user_id) {
						// Display the post creator and photo uploader pagelet
						include 'template/pagelets/post-creator.php';
					}
				?>

				<div id="news_feed" class="mini_feed">
					<?php 
						// Show either the mini feed or a placeholder message/orientation
						if ($mini_feed) {
							foreach ($mini_feed as $key => $value) : 
								// Get the post data and info about the user who made it
								$post = mysql_read_post_xid($value);
								$feed_user = mysql_read_user_xid($post->user_id);

								// Get the list of photos attached to this post
								$photos = mysql_read_photos_xpost($post->post_id);
								$photo = NULL;

								if ($photos) {
									// The site only allows upload of one photo on posts right now, <br>
									// so we'll grab data about the first and only photo in the array
									$photo = mysql_read_photo_xid($photos[0]);
								}

								// Display the post pagelet
								include 'template/pagelets/post-block.php';
							endforeach;
						}
						else {
							// Display the "no posts" placeholder or orientation
							include 'template/pagelets/empty-feed.php';
						}
					?>
				</div>
			</div>
		</section>	
	</main>

<?php

// Display footer
include 'template/footer.php';
?>