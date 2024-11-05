<?php

### NOTE
// Searching is available to the open internet


// Include our libraries
include 'libraries/config.php';
include 'libraries/functions.php';
include 'libraries/read.php';
include 'libraries/write.php';
include 'libraries/search.php';


// Sanitize data passed in
$rqst = rqst($_GET);
$search_term = strip_tags(trim($_GET['s']));


// Data we need
// Run the search term against all the posts for matches
$search_results_posts = mysql_read_search_post_list($rqst['s']);
$search_results_posts_c = count($search_results_posts);

// Run the search term against all the users for matches
$search_results_people = mysql_read_search_user_list($rqst['s']);;
$search_results_people_c = count($search_results_people);

// Tally up the results
$search_results_c = $search_results_posts_c + $search_results_people_c;
$search_results_c_str = str_multi_s($search_results_c, 'result');


// Customize the browser tab and display header
$title = 'Search: '.$search_term.' | '.$search_results_c.' '.$search_results_c_str;
$body_css = '';

include 'template/header.php';
?>

	<main id="search">
		<div id="search_results">
			<h1>Search: <?php echo $search_term; ?></h1>
			<h2><?php echo $search_results_c.' '.$search_results_c_str; ?></h2>
			
            <nav class="tabs">
                <a onclick="toggleTab(this, 'search_feed_posts');" class="search_result_link active">Posts (<?php echo $search_results_posts_c; ?>)</a>
                <a onclick="toggleTab(this, 'search_feed_people');" class="search_result_link">People (<?php echo $search_results_people_c; ?>)</a>
            </nav>
            
            <div id="search_feed" class="search_feed search_feed_posts">
			<?php 
                foreach ($search_results_posts as $key => $value) : 
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
            ?>
            </div> 
            
            <div id="search_feed_b" class="search_feed search_feed_people">
			<?php 
                foreach ($search_results_people as $key => $value) : 
                    // Get the user data and the list of their 10 most recent photos
                    $feed_user = mysql_read_user_xid($value);
                    $photos = mysql_read_photos_xuser($feed_user->user_id);
                
                    // Get the lists of who this user is following and being followed by
                    $followers = mysql_read_followers_list($feed_user->user_id);
                    $following = mysql_read_following_list($feed_user->user_id);

                    // Display the profile summary pagelet
                    include 'template/pagelets/profile-block.php';
                endforeach;
            ?>
            </div> 
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