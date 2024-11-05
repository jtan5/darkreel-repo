<?php
	$andrews_variable = '';

    $my_variable = 'Hello, \'class!';
    // backslash escapes a character. I wouldn't have to do this if the string was wrapped in apostrophes.

    $this_is_numeric = 5 + 10; 
    // MATH: + = plus, - = minus, * = times, / = divide 

    $my_second_variable = $my_variable.' String 1 '.' String 2 '.$this_is_numeric;
    // periods are used to stitch variables, strings, and numbers together and the result is placed in the variable.
?>

<!doctype html>
<html>

<head>
	<meta charset="UTF-8">
	<title><?php echo $my_variable; ?></title>
</head>

<body>
	<h1><?php echo $my_variable; ?></h1>
    <h2>The number is <?php echo $this_is_numeric; ?></h2>
    <p><?php echo $my_second_variable; ?></p>
</body>
</html>