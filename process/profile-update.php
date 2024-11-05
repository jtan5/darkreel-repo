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


// The current photo ID attached to the profile
$avatar_id = $user->avatar_id;

// If a file was uploaded with the post
if ($_FILES['avatar']['size'] > 0) {
	// A unique file name
	$new_file = 'a_'.$user->user_id.'_'.rand(1000000, 37000000).'_'.strtotime('now').'_'.rand(1000000, 37000000).'.jpg';
	
	// Stick the file binary data in a variable
    $img = $_FILES['avatar']['tmp_name'];
	
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
	
    // If this photo type is allowed, process the avatar photo
	if (in_array($detectedType, $allowedTypes)) {
		// Where to store the photo along with a unique file name
        $dst = '../content/avatars/'.$new_file;
		
		// Crop and resize the photo using the create_thumbnail function in /libraries/images.php
		// It takes an anonymous function as its sixth parameter for performing image manipulation
		// Anonymous function takes an image reference and passes it through one or more custom
		// "filter_" manipulation functions also defined in /libraries/images.php
		create_thumbnail($target, $dst, 800, 'auto', $compression_quality, function ($img_to_manipulate) {
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
		$image_path = 'avatars/'.$new_file;
         
        // Write the new photo to hard disk and set the photo ID variable
        $avatar_id = mysql_write_photo($user->user_id, NULL, $image_path);
		
		// Delete the temporary target file now that the converted one is stored
		// This might be the PHP $_FILES version or the converted $target
		unlink($target);
	} 
}


// The current photo ID attached to the profile
$cover_id = $user->cover_id;

// If a file was uploaded with the post
if ($_FILES['cover_photo']['size'] > 0) {
	// A unique file name
	$new_file = 'c_'.$user->user_id.'_'.rand(1000000, 37000000).'_'.strtotime('now').'_'.rand(1000000, 37000000).'.jpg';
	
	// Stick the file binary data in a variable
    $img = $_FILES['cover_photo']['tmp_name'];
	
	$target = $img;
	$compression_quality = 80;
	
	// If Imagick is available on this server, enable modern image formats like 
	// HEIC and WEBP to be uploaded to this website, otherwise, only allow PNG, JPG, and GIF
	if (extension_loaded('imagick')) {
		// Define where this JPG version of the file is going
		$target = '../content/tmp/'.$new_file;
		$compression_quality = 100;
		
		// Use Imagick to convert modern formats like WEBP and HEIC to JPG
		convert_image_format($img, $target);	
		
		// Note: the Imagick thing is a newer addition to deal with new image formats
        // while still allowing us to use all of the GD2 photo manipulation code
        // so this check is a bit redundant but at least we know an image will 
        // turn into a valid JPG where a malicious EXE or JS upload would
        // not convert into a valid image format
	}
	
    // The only photos allowed to be uploaded along with
    // the file type of the uploaded photo
	$allowedTypes = array(IMAGETYPE_PNG, IMAGETYPE_JPEG, IMAGETYPE_GIF);
	$detectedType = exif_imagetype($target);
	
    // If this photo type is allowed, process the cover photo
	if (in_array($detectedType, $allowedTypes)) {
		// Where to store the photo along with a unique file name
        $dst = '../content/covers/'.$new_file;
		
		// Crop and resize the photo using the create_thumbnail function in /libraries/images.php
		// It takes an anonymous function as its sixth parameter for performing image manipulation
		// Anonymous function takes an image reference and passes it through one or more custom
		// "filter_" manipulation functions also defined in /libraries/images.php
		create_thumbnail($target, $dst, 1920, 'auto', $compression_quality, function ($img_to_manipulate) {
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
		$image_path = 'covers/'.$new_file;
        
        // Write the new photo to hard disk and set the cover ID variable
        $cover_id = mysql_write_photo($user->user_id, NULL, $image_path);
	} 
	
	// Delete the temporary target file now that the converted one is stored
	// This might be the PHP $_FILES version or the converted $target
	unlink($target);
}


// Update the user's profile with new info and update their avatar ID if necessary
mysql_write_update_profile($user->user_id, $rqst['email_address'], $rqst['first_name'], $rqst['last_name'], $rqst['username'], $avatar_id, $cover_id);


// Return them to the edit profile page with the updated data
header('Location: '.$site['url'].'/edit-profile.php');
die();

?>