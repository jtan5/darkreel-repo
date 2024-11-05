<?php

// Include our libraries
include '../libraries/config.php';
include '../libraries/functions.php';
include '../libraries/read.php';
include '../libraries/write.php';


// If user isn't logged in, they can't access this script
if (!is_logged_in()) {
	header('Location: '.$site['url']);
	die();
}


// Sanitize data passed in
$rqst = rqst($_POST, '', ['id']);


// Get the list of followers
$followers = mysql_read_followers_list($rqst['id']);


// If the user is a follower
if (in_array($user->user_id, $followers)) {
    // Unfollow the followed
    mysql_write_unfollow_xid($user->user_id, $rqst['id']);
}
else {
    // Else, follow them
    mysql_write_follow_xid($user->user_id, $rqst['id']);
}

?>