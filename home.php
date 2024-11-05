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


// Let's generate the news feed
// We need a list of who this user is following
$following_list = mysql_read_following_list($user->user_id);


// We need an empty news feed list in case they're following nobody
$news_feed = [];
if ($following_list) {
    // If they are following people, get the actual posts
	$news_feed = mysql_read_news_feed_list($following_list);
}


// Customize the browser tab and display header
$title = 'Home | News Feed';
$body_css = '';

include 'template/header.php';
?>

	<main id="home">
		<div class="page_pane">
			<?php
                // Display the post creator and photo uploader pagelet
				include 'template/pagelets/post-creator.php';
			?>
			
			<div id="news_feed" class="news_feed">
				<?php 
                    // Show either the news feed or a placeholder message/orientation
					if ($news_feed) {
                        // Loops through the news feed stories
						foreach ($news_feed as $key => $value) :
                            // Get the post data and info about the user who made it
                            $post = mysql_read_post_xid($value);
                            $feed_user = mysql_read_user_xid($post->user_id);
                        
                            // Get the list of photos attached to this post
                            $photos = mysql_read_photos_xpost($post->post_id);
							$photo = NULL;
							
                            if ($photos) {
                                // The site only allows upload of one photo on posts right now,
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
		
		<aside>
			<div class="people-you-know">
				<?php
					$followers = mysql_read_following_list
					($user->user_id);
					$follow_lists = [];

					foreach ($followers as $key => $value) {
						$follow_lists = array_merge
						($follow_lists, 
						mysql_read_following_list($value));
					}
					$people_ids = array_count_values($follow_lists);

					arsort($people_ids);

					unset($people_ids[$user->user_id]);

					$people_ids= array_keys($people_ids);

					$people_ids = array_diff($people_ids, $followers);

					$people_ids = array_slice($people_ids, 0, 20);

					shuffle($people_ids);
					
					$people_ids = array_slice($people_ids, 0, 3);

					foreach ($people_ids as $key => $value) {
						$feed_user = mysql_read_user_xid($value);
						include 'template/pagelets/people-you-know.php';
					}
				?>
			</div>
		</aside>
	</main>

<?php

// Display footer
include 'template/footer.php';
?>