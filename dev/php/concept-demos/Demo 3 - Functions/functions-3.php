<?php

date_default_timezone_set( 'America/Winnipeg' );


// PHP can do cool things with time. 
// Two commonly used built-in functions are strtotime() and date().

// strtotime() can convert strings or timestamps (2019-10-17) to a format the computer understands.
// It takes one argument and also understands basic English
$timestamp_1 = strtotime('2019-10-17');
$timestamp_2 = strtotime('+3 hours');
$timestamp_3 = strtotime('Next Tuesday');
$timestamp_4 = strtotime('-1 year');

// date() takes two arguments. The first is a string representing how it should output the date.
// Refer to the date() function cheat sheet here: https://www.php.net/manual/en/function.date.php

// So, following the cheat sheet, if we want to output Weekday, Month Day, Year
$todays_date = date('l, F j, Y');

// The second date() argument is a strtotime() formatted timestamp.
$date_timestamp_1 = date('D, F j, Y', $timestamp_1);
$date_timestamp_2 = date('l, F j, Y \a\t g:ia', $timestamp_2);
$date_timestamp_3 = date('l, F j, Y', $timestamp_3);
$date_timestamp_4 = date('l, F j, Y', $timestamp_4);

// If you don't give date() a second argument, the default is strtotime('now').
?>

<!doctype html>
<html>

<head>
	<meta charset="UTF-8">
	<title>PHP Dates</title>
</head>

<body>
	<h1><?php echo $date_timestamp_1; ?></h1>
	<h2><?php echo $date_timestamp_2; ?></h2>
	<h3><?php echo $date_timestamp_3; ?></h3>
	<h4><?php echo $date_timestamp_4; ?></h4>
</body>
</html>