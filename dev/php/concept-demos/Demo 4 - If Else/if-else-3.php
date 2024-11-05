<!doctype html>
<html>

<head>
	<meta charset="UTF-8">
	<title>PHP - if, elseif, else</title>
</head>

<body>
	<?php
		// This sets the $time variable to the current hour in the 24 hour clock format
		$time = date("H");
		
		// "else" is optional.
		// We can define some default before we even overwrite it in our if/else conditional statements
		// This makes your website faster - if you have a lot of conditional statements going on
		$the_greeting = "I have no idea what time it is!";
	
		if ($time < "12") {
			/* If the time is less than 1200 hours, show good morning */
			$the_greeting = "Good morning!";
		} 
		elseif ($time >= "12" && $time < "17") {
			/* If the time is grater than or equal to 1200 hours, but less than 1700 hours, so good afternoon */
			$the_greeting = "Good afternoon!";
		} 
		elseif ($time >= "17" && $time < "19") {
			/* Should the time be between or equal to 1700 and 1900 hours, show good evening */
			$the_greeting = "Good evening!";
		} 
		elseif ($time >= "19") {
			/* Finally, show good night if the time is greater than or equal to 1900 hours */
			$the_greeting = "Good night!";
		}
	?>
	
	<h1><?php echo $the_greeting; ?></h1>
</body>
</html>