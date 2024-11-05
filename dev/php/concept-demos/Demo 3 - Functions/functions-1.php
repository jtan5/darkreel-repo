<?php

// PHP has built-in functions ready to go to make things easy.
// String functions are probably the most common or easiest to use...
// Functions have a name followed by rounded brackets.

$my_string = 'Hello, Andrew\'s class!';
$my_string_length = strlen($my_string); // strlen() is a function that will tell you how many characters are in a string

// But you can also create your own functions
function hello_world() {
	echo 'Hello, world!';
}

function hello_world_b() {
	return 'Hello, world!';
}

$function_result = hello_world_b(); //capture the result in a variable

// Custom functions make it easy to re-use code over and over.
?>

<!doctype html>
<html>

<head>
	<meta charset="UTF-8">
	<title><?php hello_world(); ?></title>
</head>

<body>
	<h1><?php echo $function_result; // or echo hello_world_b(); ?></h1>
	<h2><?php echo strtoupper($my_string); // You'd probably want to make a string uppercase in CSS. ?></h2>
	<h3><?php echo 'My string has '.$my_string_length.' characters.'; ?></h3>	
</body>
</html>