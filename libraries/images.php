<?php

#############
# IMAGES
/*
	Find other cool image features and functions to 
	drop in this file from here under "PHP — Images": 
	https://www.programminglogic.ca/server-side/code-collection/
*/
#############

##################################################################

/* convert_image_format: 
Uses Imagick to convert modern image formats into JPG (usually) or other formats
*/
function convert_image_format($source_file = '', $destination_file = '', $destination_format = 'jpg', $image_compression = 80) {
	$im = new Imagick($source_file);
	
	$im->setFormat($destination_format);
	$im->setImageCompressionQuality($image_compression);
	
	$im->writeImage($destination_file);

	$im->destroy();
} 

##################################################################

/* hex_to_rgb: 
Turns a hex color code into RGB numbers (0-255)
*/
function hex_to_rgb($hex_code = 'ffffff') {
	$hex_code = ltrim($hex_code, '#');
	$hex_code = '#'.$hex_code;
	
	list($r, $g, $b) = sscanf($hex_code, "#%02x%02x%02x");
	
	$return_data = array();
	
	$return_data['r'] = $r;
	$return_data['g'] = $g;
	$return_data['b'] = $b;
	
	return $return_data;
}


##################################################################

/* image_fix_orientation: 
Reads an image on disk for orientation info from the 
mobile device and fixes the rotation automatically
*/
function image_fix_orientation(&$image, $filename) {
    $exif = exif_read_data($filename);
	
    if (!empty($exif['Orientation'])) {
        switch ($exif['Orientation']) {
			case 3:
                $image = imagerotate($image, 180, 0);
                break;

            case 6:
                $image = imagerotate($image, -90, 0);
                break;

            case 8:
                $image = imagerotate($image, 90, 0);
                break;	
        }
    }
}


##################################################################

/* imagecreate_dynamic: 
Opens an image from a file path and puts it into an object
for us to manipulate (crop, colourize, desaturate, etc)
*/
function imagecreate_dynamic($pic) {
	global $mime;
	
	if (!$mime) {
		$mime = getimagesize($pic);
	}
	
	
	//
    if ($mime['mime'] == 'image/png') { 
		$im1 = imagecreatefrompng($pic);
	}
    elseif ($mime['mime'] == 'image/gif') { 
		$im1 = imagecreatefromgif($pic); 
	}
	elseif ($mime['mime'] == 'image/jpg' || $mime['mime'] == 'image/jpeg' || $mime['mime'] == 'image/pjpeg') {
		$im1 = imagecreatefromjpeg($pic);
		$exif = exif_read_data($pic);

		if (!empty($exif['Orientation'])) {
			switch($exif['Orientation']) {
			case 8:
				$im1 = imagerotate($im1, 90 ,0);
				break;
			case 3:
				$im1 = imagerotate($im1, 180, 0);
				break;
			case 6:
				$im1 = imagerotate($im1, -90, 0);
				break;
			} 
		}
	}
	else {
		$im1 = imagecreatefromjpeg($pic);
	}
	
	return $im1;
}


##################################################################

/* imagesave: 
Writes an image object to the hard drive at the specified file path
*/
function imagesave($im, $dst, $quality = 100, $destroys = array(), $output_format = 'jpg') {
	global $img_quality_override, $php_v;
	
	$path = addslashes($dst);
	
	if ($img_quality_override && $quality > $img_quality_override) {
		$quality = $img_quality_override;
	}
	
	if (version_compare($php_v, '7.2.0') >= 0) {
		imageresolution($im, 72);
	}
	
	imageinterlace($im, true);
	
	if ($output_format == 'jpg') {
		imagejpeg($im, $path, $quality);
	}
	elseif ($output_format == 'png') {
		imagepng($im, $path);//, $quality);
	}
	elseif ($output_format == 'gif') {
		imagegif($im, $path);	
	}
	
	$destroys[] = $im;
	
	foreach ($destroys as $key => $value) {
		imagedestroy($value);
	}
	
	return true; //$im1;
}


##################################################################

/* create_thumbnail: 
Crops an image to a certain size and performs any manipulations, 
then writes it to the specified file path
*/
function create_thumbnail($pic, $thumb, $thumbwidth, $thumbheight = 'auto',  $quality = 100, $manipulation = NULL, $output_format = 'jpg') {
	$mime = getimagesize($pic);
		
	$im1 = imagecreate_dynamic($pic);
	
	$width = $mime[0];
	$w1 = ($thumbwidth <= $mime[0]) ? $thumbwidth : $mime[0];

	$w2 = imagesx($im1);
	$h2 = imagesy($im1);
	
	$h1 = floor($h2 * ($w1 / $w2));
	$im2 = imagecreatetruecolor($w1, $h1);
	
    if (is_numeric($thumbheight)) { //Crop photo instead of simple resize 
        
    }
    
	if ($mime['mime'] == 'image/png' || $mime['mime'] == 'image/gif') { 
		// turn off alpha blending
		imagealphablending($im2, false);
		imagesavealpha($im2, true);
		
		$background = imagecolorallocatealpha($im2, 255, 255, 255, 127);
		
		// remove the black 
		imagecolortransparent($im2, $background);	
	}

	imagecopyresampled($im2, $im1, 0, 0, 0, 0, $w1, $h1, $w2, $h2); 
	
	if ($manipulation) {
		$im2 = $manipulation($im2);
	}
	
	$destroys = array();
	$destroys[] = $im1;
	
	imagesave($im2, $thumb, $quality, $destroys, $output_format);
	
	unset($mime);
}


##################################################################

/* filter_bw: 
Makes a photo in an image object black and white
*/
function filter_bw($im_ref = '') {
	imagefilter($im_ref, IMG_FILTER_GRAYSCALE);
	
	return $im_ref;
}


##################################################################

/* filter_negative: 
Takes a colour photo and flips it to a film negative image
*/
function filter_negative($im_ref = '') {
	imagefilter($im_ref, IMG_FILTER_NEGATE);
	
	return $im_ref;
}


##################################################################

/* filter_contrast: 
Adjusts the contrast on a photo in an image object
*/
function filter_contrast($im_ref = '', $contrast_value = 0) {
	if ($contrast_value > 100) {
		$contrast_value = 100;
	}
	if ($contrast_value < -100) {
		$contrast_value = -100;
	}
	
	imagefilter($im_ref, IMG_FILTER_CONTRAST, $contrast_value);
	
	return $im_ref;
}


##################################################################

/* filter_multiply: 
Multiplies a hex colour against existing pixel colours to create a
multiply effect (like a colour filter) on the photo in the image object
*/
function filter_multiply($im_ref, $hex_code = 'ffffff') {
	$rgb = hex_to_rgb($hex_code);
	//print_r($rgb);
	
	$filter_r = $rgb['r'];
	$filter_g = $rgb['g'];
	$filter_b = $rgb['b'];

	$imagex = imagesx($im_ref);
	$imagey = imagesy($im_ref);

	for ($x = 0; $x <$imagex; ++$x) {
		for ($y = 0; $y < $imagey; ++$y) {
			$rgb = imagecolorat($im_ref, $x, $y);
			$tab_colours = imagecolorsforindex($im_ref, $rgb);

			$color_r = floor($tab_colours['red'] * $filter_r / 255);
			$color_g = floor($tab_colours['green'] * $filter_g / 255);
			$color_b = floor($tab_colours['blue'] * $filter_b / 255);

			$newcol = imagecolorallocate($im_ref, $color_r, $color_g, $color_b);

			imagesetpixel($im_ref, $x, $y, $newcol);
		}
	}
	
	return $im_ref;
}


##################################################################

/* filter_sepia: 
Takes a colour photo, makes it b + w, then colourizes it as sepia
*/
function filter_sepia($im_ref = '') {
	imagefilter($im_ref, IMG_FILTER_GRAYSCALE);
	imagefilter($im_ref, IMG_FILTER_COLORIZE, 100, 50, 0);
	
	return $im_ref;
}


##################################################################

/* filter_colourize: 
Takes a colour photo, makes it b + w, then colourizes it with the hex
*/
function filter_colourize($im_ref = '', $colour_hex = 'ffffff', $bw_first = false) {
	if ($bw_first == true) {
		imagefilter($im_ref, IMG_FILTER_GRAYSCALE);
	}
	
	$rgb = hex_to_rgb($colour_hex);
	imagefilter($im_ref, IMG_FILTER_COLORIZE, $rgb['r'], $rgb['g'], $rgb['b']);
	
	return $im_ref;
}


##################################################################

/* filter_colour_replace: 
Find one hex colour and replace it with another.
Neither of these colour replace functions work very well.
*/
function filter_colour_replace($im_ref, $colour_orig = 'ffffff', $colour_new = '000000') {
	imagetruecolortopalette($im_ref, false, 255);
	
	$rgb_1 = hex_to_rgb($colour_orig);
	$index = imagecolorclosest($im_ref, $rgb_1['r'], $rgb_1['g'], $rgb_1['b']); // get White COlor
	
	$rgb_2 = hex_to_rgb($colour_new);
	imagecolorset($im_ref, $index, $rgb_2['r'], $rgb_2['g'], $rgb_2['b']); // SET NEW COLOR
	
	//$im_ref = replace_colour_pixel_iterator($im_ref, $rgb_1['r'], $rgb_1['g'], $rgb_1['b'], $rgb_2['r'], $rgb_2['g'], $rgb_2['b']);
		
	return $im_ref;
}


##################################################################

/*function replace_colour_pixel_iterator($img, $r1, $g1, $b1, $r2, $g2, $b2) {
    if (!imageistruecolor($img)) {
        imagepalettetotruecolor($img);
	}
	
    $col1 = (($r1 & 0xFF) << 16) + (($g1 & 0xFF) << 8) + ($b1 & 0xFF);
    $col2 = (($r2 & 0xFF) << 16) + (($g2 & 0xFF) << 8) + ($b2 & 0xFF);

    $width = imagesx($img); 
    $height = imagesy($img);
    
	for($x = 0; $x < $width; $x++) {
        for($y = 0; $y < $height; $y++) {
            $colrgb = imagecolorat($img, $x, $y);
            
			if($col1 !== $colrgb) {
                continue; 
			}
			
            imagesetpixel($img, $x, $y, $col2);
        }
	}
	
	return $img;
}*/


##################################################################

/* file_ext: 
Gets the file extension from a file name
*/
function file_ext($file_name_string = '') {
	$url_parts = parse_url($file_name_string);
	$the_ext = pathinfo($url_parts['path'], PATHINFO_EXTENSION);
	
	return $the_ext;
}

?>