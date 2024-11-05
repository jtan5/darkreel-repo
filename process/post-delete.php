<?php

// Include our libraries
include '../libraries/config.php';
include '../libraries/functions.php';
include '../libraries/read.php';
include '../libraries/write.php';


// If user isn't logged in, they can't access this script
if (!is_logged_in()) {
	header('Location: '.$site['url_home']);
	die();
}


// Sanitize data passed in
$rqst = rqst($_POST, '', ['id']);


// Get the post
$post = mysql_read_post_xid($rqst['id']);


// If this user created this post, then we can safely delete it
if ($post->user_id == $user->user_id) {
    mysql_write_delete_xpost($post->post_id);
    
    // Find out if this post had any photo(s) attached to it
    $photos = mysql_read_photos_xpost($post->post_id);
    if ($photos) {
        $photo = mysql_read_photo_xid($photos[0]);
    }

    // Setup the file path to the file
    $file_path = '../content/'.$photo->photo_url;
    
    // If the photo exists on disk...
    if (file_exists($file_path)) {
        // Delete the photo and update the database
        unlink($file_path);
        
        mysql_write_delete_xphoto($photo->photo_id);
    }
}

?>