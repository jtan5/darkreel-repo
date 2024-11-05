<?php

// Create a variable as an empty array.
$class_list = array();


/* 
Add list items to the array

Each element added by $class_list[] will increment the key by one. 
PHP counts starting at zero, not one.
*/
$class_list[0] = 'Jesse'; // $class_list[0] is now initialized with 'Jesse'
$class_list[] = 'Kody'; // $class_list[1] is now initialized with 'Kody'
$class_list[] = 'Leah';
$class_list[] = 'Jennie';
$class_list[] = 'Angelica';
$class_list[] = 'Ayla';
$class_list[] = 'Aurora';
$class_list[] = 'Shayna';
$class_list[] = 'Nicole';
$class_list[] = 'Alysha';
$class_list[] = 'Matthew';
$class_list[] = 'Madeline';
$class_list[] = 'Jordan';
$class_list[] = 'Anna';
$class_list[] = 'Arielle';


/* 
Create a for loop and have it repeat five times

We declare a variable to count our loops and initializie it with zero, 
we want the loop to run five times (0, 1, 2, 3, 4), 
and each iteration, we increment $i by one 
*/

for ($i = 0; $i < 5; $i++) {
	// Use a built-in PHP function to scramble the list items in $class_list
	shuffle($class_list);
}

?>

<!doctype html>
<html>

<head>
	<meta charset="UTF-8">
	<title>Randomized Class List</title>
</head>

<body>
	<ul>
		<?php
			//Create a foreach loop and output the student's names in li tags
			foreach ($class_list as $key => $value) {
				echo '<li>'.$key.' - '.$value.'</li>';
			}
		?>
	</ul>

</body>
</html>