<?php


// Stick data in an array
$return_array = array();

$return_array['post'] = mysql_read_post_xid($post_id);

if ($photo_id) {
    $return_array['photo'] = mysql_read_photo_xid($photo_id);
}


// Tell the browser/client that this is a JSON file
header('Content-Type: application/json');

// Encode the array as a JSON object and output it
$return_array = json_encode($return_array);
echo $return_array;

?>