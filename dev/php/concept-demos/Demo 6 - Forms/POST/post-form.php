<?php

//echo '<pre>';
//print_r($_POST);
//echo '</pre><br>';
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
	<title>Form POST results</title>
</head>

<body>
	<h1>Form POST results</h1>
    
    <h2>First name: <?php echo $_POST['first_name']; ?></h2>
    <h2>Last name: <?php echo $_POST['last_name']; ?></h2>
    <h2>Email Address: <?php echo $_POST['email_address']; ?></h2>
</body>
</html>