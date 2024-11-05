<?php

//ini_set('display_errors', 'On');

// Custom functions in PHP can also be passed data through arguments

function hello_you($your_name = 'world') {
	echo 'Hello, '.$your_name.'!';
}

function increment_by_five($some_number = 0) {
	return $some_number + 5;
}

// Custom functions make it easy to re-use code over and over.

$my_name = 'Andrew';
$my_string_length = strlen($my_name);

$plus_five_result = increment_by_five($my_string_length);
?>

<!doctype html>
<html>

<head>
	<meta charset="UTF-8">
	<title><?php hello_you($my_name); ?></title>
</head>

<body>
	<h1><?php hello_you(); ?></h1>
    
	<h2><?php echo 'My string, '.$my_name.', has '.$my_string_length.' characters.'; ?></h2>
    
	<h3>Five more is <?php echo $plus_five_result; ?>.</h3>
</body>
</html>