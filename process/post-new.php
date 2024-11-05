<?php

// Include our libraries
include '../libraries/config.php';
include '../libraries/functions.php';
include '../libraries/read.php';
include '../libraries/write.php';
include '../libraries/images.php';


// If user isn't logged in, they can't access this script
if (!is_logged_in()) {
	header('Location: '.$site['url']);
	die();
}


// PHP Settings
ini_set('memory_limit', '-1');


// Sanitize data passed in
$rqst = rqst($_POST, '', []);


// Write the post info to the database
$post_id = mysql_write_post($user->user_id, $rqst['post']); 


// Process a photo if one was attached
if ($_FILES['media']['size'] > 0) {
	// A unique file name
	$new_file = 'p_'.$user->user_id.'_'.rand(1000000, 37000000).'_'.strtotime('now').'_'.rand(1000000, 37000000).'.jpg';
	
	// Stick the file binary data in a variable
    $img = $_FILES['media']['tmp_name'];
	
	$target = $img;
	$compression_quality = 80;
	
	// If Imagick is available on this server, enable modern image formats like 
	// HEIC and WEBP to be uploaded to this website, otherwise, only allow PNG, JPG, and GIF
	if (extension_loaded('imagick') && $site['env'] != 'windows') {
		// Define where this JPG version of the file is going
		$target = '../content/tmp/'.$new_file;
		$compression_quality = 100;
		
		// Use Imagick to convert modern formats like WEBP and HEIC to JPG
		convert_image_format($img, $target);	
		
		// Note: the Imagick thing is a new addition to deal with new image formats
        // while still allowing us to use all of the GD2 photo manipulation code
        // so this check is a bit redundant but at least we know an image will 
        // turn into a valid JPG where a malicious EXE or JS upload would
        // not convert into a valid image format
	}
	
    // The only photos allowed to be uploaded along with
    // the file type of the uploaded photo
	$allowedTypes = array(IMAGETYPE_PNG, IMAGETYPE_JPEG, IMAGETYPE_GIF);
	$detectedType = exif_imagetype($target);
	
    // If this photo type is allowed, process the post photo
	if (in_array($detectedType, $allowedTypes)) {
		// Where to store the photo along with a unique file name
        $dst = '../content/posts/'.$new_file;
		
		// Crop and resize the photo using the create_thumbnail function in /libraries/images.php
		// It takes an anonymous function as its sixth parameter for performing image manipulation
		// Anonymous function takes an image reference and passes it through one or more custom
		// "filter_" manipulation functions also defined in /libraries/images.php
		create_thumbnail($target, $dst, 1200, 'auto', $compression_quality, function ($img_to_manipulate) {
			// PHP's GD2 photo library manipulation functions 
			// You can find more imagefilter parameters to create
			// more of these "filter_" functions here:
			// https://www.php.net/manual/en/function.imagefilter.php
			
			// Uncomment any single or combination of these functions
			// to run the desired effect on the image (permanent as-is)
			
			//filter_bw($img_to_manipulate);
			//filter_contrast($img_to_manipulate, -10); // -100 to 100 
			
			//filter_multiply($img_to_manipulate, '#336699'); // Any hex code
			
			//filter_negative($img_to_manipulate);
			//filter_sepia($img_to_manipulate);
			
			//filter_colour_replace($img_to_manipulate, '#700912', '#17ce4b'); // This one doesn't work very well
			//filter_colourize($img_to_manipulate, '#ce1729', true);
			
			return $img_to_manipulate;
		});
		
        // The path to the new photo file
		$image_path = 'posts/'.$new_file;
        
        // Write the new photo to hard disk and set the photo ID variable
        $photo_id = mysql_write_photo($user->user_id, $post_id, $image_path);
		
		// Delete the temporary target file now that the converted one is stored
		// This might be the PHP $_FILES version or the converted $target
		unlink($target);
	} 
}


// Get the post data and info about the user who made it
$post = mysql_read_post_xid($post_id);
$feed_user = $user;

// Get the list of photos attached to this post
$photos = mysql_read_photos_xpost($post->post_id);
if ($photos) {
    // The site only allows upload of one photo on posts right now, <br>
    // so we'll grab data about the first and only photo in the array
    $photo = mysql_read_photo_xid($photos[0]);
}

$likes = [];
$new_post_no_animate = 'y';

// Display the post pagelet
include '../template/pagelets/post-block.php';

?>