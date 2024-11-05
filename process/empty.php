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


// PHP Settings, if necessary
// ini_set('memory_limit', '-1'); // Give unlimited memory to complex tasks


// Sanitize data passed in using rqst()
// Argument 1:Type of request (ie. $_POST, $_GET, or $_REQUEST for both)
// Argument 2: HTML tags you allow and don't want to strip (ie. <b><i><u>)
// Argument 3: Which of the keys you want to ensure are integers (ie. 'id', 'object')
$rqst = rqst($_POST, '', []);


// Process, format, and validate data, if necessary


// MySQL read and write functions for PDO from phpmysqljs.com


// Next steps, such as outputting an ID, including a pagelet, 
// or kicking the user somewhere else, if necessary
header('Location: '.$site['url']); //Redirect to some URL
die();

?>