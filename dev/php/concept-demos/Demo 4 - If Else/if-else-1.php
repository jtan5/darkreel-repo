<?php

$my_name = 'Andrew';
$my_age = 32;

?>

<!doctype html>
<html>

<head>
	<meta charset="UTF-8">
	<title>PHP - if, elseif, else</title>
</head>

<body>
	<?php
		if ($my_age < 13) {
			// If the person's age is less than 12 years
			$age_comment = "you're just a baby";
		} 
		elseif ($my_age >= 13 && $my_age < 18) {
			// If their age is at least 13 and not yet 18
			$age_comment = "you're probably a rotten teenager";
		} 
		elseif ($my_age >= 18 && $my_age < 30) {
			// If their age is at least 18 and not yet 30
			$age_comment = "you're at the prime of your life";
		} 
		elseif ($my_age >= 30) {
			// Finally, if they're 30 or up
			$age_comment = "you old";
		}
		else {
			$age_comment = "I have no idea what to say about your age";
		}
	?>
	
	<h1>Hello, <?php echo $my_name; ?>.</h1>
	<p>At the age of <?php echo $my_age; ?>, <?php echo $age_comment; ?>.</p>
</body>
</html>