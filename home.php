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

    <main>
        <div class="container">

            <div class="main-wrapper">
                <!-- the main-wrapper div is for the border of the inside of the container, it is just for aesthetics -->

                <!-- put content here, split up by <section> -->
                <section>
                    <h1>DarkReel</h1>
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