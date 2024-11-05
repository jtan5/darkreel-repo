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


//
$query = "SELECT * FROM users ORDER BY first_name";
$result = mysqli_query($cxn, $query) or die(htmlspecialchars($query.' — '.mysqli_error($cxn)));

$users = array();

while ($data = mysqli_fetch_array($result)) {
	$users[] = $data;
}

//echo '<pre>';
//print_r($users);
//echo '</pre>';

echo $users[1]['first_name'].' '.$users[1]['last_name'];

die();

//
$query = "SELECT * FROM users ORDER BY first_name LIMIT 2";
$result = mysqli_query($cxn, $query) or die(htmlspecialchars($query.' — '.mysqli_error($cxn)));

$users_2 = array();

while ($data = mysqli_fetch_array($result)) {
	$users_2[] = $data;
}

echo '<pre>';
print_r($users_2);
echo '</pre>';

?>


<?php 
if (count($users_2) >= 2) : 
	// You can also split loops and conditional statements between different PHP blocks
	// using a colon : instead of a { and closing it with endif, endfor, endforeach, endwhile instead of }
	// This lets you see colour-coding for the HTML code instead of doing echo '<h1>HTML in side an echoed string</h1>';
	// It's sort of like doing concatenation between PHP and HTML code.
?>
	<ul>
	<?php foreach ($users_2 as $key => $value) : ?>
		<li><?php echo $value['first_name'].' '.$value['last_name']; ?></li>
	<?php endforeach; ?>	
	</ul>
<?php 
endif; 


//
$query = "SELECT * FROM users ORDER BY user_id DESC"; //ASC is default, this gives us highest USER IDs first
//$query = "SELECT * FROM table_name WHERE column_name_1='' ORDER BY column_name_2 LIMIT 2";
$result = mysqli_query($cxn, $query) or die(htmlspecialchars($query.' — '.mysqli_error($cxn)));

$users_3 = array();

while ($data = mysqli_fetch_array($result)) :
	$users_3[] = $data;
endwhile;

echo '<pre>';
print_r($users_3);
echo '</pre>';

if (count($users_3) >= 2) : 
?>
	<ul>
	<?php foreach ($users_3 as $key => $value) : ?>
		<li><?php echo $value['first_name'].' '.$value['last_name']; ?></li>
	<?php endforeach; ?>	
	</ul>
<?php 
endif; 
?>