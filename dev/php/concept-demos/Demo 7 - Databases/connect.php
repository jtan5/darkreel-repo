<?php

function mysql_cxn() {
	global $cxn; 
	
	if (!$cxn) {
		$mysql = array();

		$mysql['host'] = 'localhost';
		$mysql['user'] = 'ecommerce';
		$mysql['pass'] = '5H0Em0xs1nRAJ8HP';
		$mysql['db'] = 'ecommerce';
			
		$cxn = mysqli_connect($mysql['host'], $mysql['user'], $mysql['pass'], $mysql['db']) or die(htmlspecialchars(mysqli_error($cxn)));
		//mysqli_set_charset($cxn, "utf8");
	}
}

mysql_cxn();

//$query = "INSERT INTO users (first_name, last_name, email_address) VALUES ('Jane', 'Smith', 'janesmith@example.com')";
//$result = mysqli_query($cxn, $query) or die(htmlspecialchars($query.' — '.mysqli_error($cxn)));

//$query = "UPDATE users SET first_name='Jane Lee' WHERE user_id=2";
//$result = mysqli_query($cxn, $query) or die(htmlspecialchars($query.' — '.mysqli_error($cxn)));

// intval turns anything into a number to santize data
$query = "SELECT * FROM users WHERE user_id=".intval($_GET['id']);
$result = mysqli_query($cxn, $query) or die(htmlspecialchars($query.' — '.mysqli_error($cxn)));
$data = mysqli_fetch_array($result);

echo $data['first_name'].' '.$data['last_name'];

?>