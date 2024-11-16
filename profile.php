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

    <main>
        <div class="container">

            <div class="main-wrapper">
                <!-- the main-wrapper div is for the border of the inside of the container, it is just for aesthetics -->

                <!-- put content here, split up by <section> -->
                <section>
                    <h1>Profile</h1>
                    <h2>Heading 2</h2>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Excepturi, tempora.</p>
                </section>
            </div>

        </div>
    </main>

<?php

// Display footer
include 'template/footer.php';
?>