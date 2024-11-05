<?php

echo '<pre>';
print_r($_GET);
echo '</pre><br>';
//
//echo '<pre>';
//print_r($_REQUEST);
//echo '</pre>';
//
//die();

?>

<!doctype html>
<html>

<head>
	<meta charset="UTF-8">
	<title>Form GET results</title>
</head>

<body>
	<h1>Form GET results</h1>
    
    <h2>First name: <?php echo $_GET['first_name']; ?></h2>
    <h2>Last name: <?php echo $_GET['last_name']; ?></h2>
    <h2>Email Address: <?php echo $_GET['email']; ?></h2>
</body>
</html>