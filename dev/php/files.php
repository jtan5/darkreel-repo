<?php

function file_size_bytes($file_size) {
	$size = array();
	
	$megabyte_size = $file_size / 1048576;
	$size[0] = round($megabyte_size, 1);

	if ($megabyte_size < 1) {
		$megabyte_size = $file_size / 1024;
		$size[0] = round($megabyte_size, 1);
		$size[1] = "KB";
	}
	elseif ($megabyte_size >= 1024) {
		$megabyte_size = $file_size / 1073741824;
		$size[0] = round($megabyte_size, 1);
		$size[1] = "GB";
	}
	else {
		$size[1] = "MB";
	}
	
	$format_out = $size[0].$size[1];
	return $format_out;
}

function pretty_bytes($bytes, $bb = 'y', $precision = 2) { 
    /*$units = array('B', 'KB', 'MB', 'GB', 'TB'); 

    $bytes = max($bytes, 0); 
    $pow = floor(($bytes ? log($bytes) : 0) / log(1024)); 
    $pow = min($pow, count($units) - 1); 

    // Uncomment one of the following alternatives
    // $bytes /= pow(1024, $pow);
    // $bytes /= (1 << (10 * $pow)); 

    return round($bytes, $precision) . ' ' . $units[$pow]; */
	
	$base = log($bytes) / log(1024);
	
	$suffix = array('B', 'kB', 'MB', 'GB', 'TB', 'PB', 'EB', 'ZB', 'YB')[floor($base)];
	if ($bb == 'y') {
		$suffix = array('kB', 'MB', 'GB', 'TB', 'PB', 'EB', 'ZB', 'YB')[floor($base)];
	}
	
	return round(pow(1024, $base - floor($base)), $precision) .' '. $suffix;
	
} 

?>