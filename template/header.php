<?php

// The browser tab will be our default page title
$the_title = $site['title'];
if ($title) {
    // If title was set on this page, we use that and attach the default page title
	$the_title = $title.' | '.$site['title'];
}

?>

<!DOCTYPE html>
<html>
	
<head>
	<meta charset="UTF-8">
	
	<title><?php echo $the_title; ?></title>
	
	<link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css2?family=Lexend+Deca&display=swap"> 
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />  
	<link rel="stylesheet" type="text/css" href="<?php echo $site['url_template']; ?>/css/reset.css">
	<link rel="stylesheet" type="text/css" href="<?php echo $site['url_template']; ?>/css/core.css">
	<link rel="stylesheet" type="text/css" href="<?php echo $site['url_template']; ?>/css/mobile.css" media="only screen and (max-device-width: 480px)">
	<link rel="stylesheet" type="text/css" href="<?php echo $site['url_template']; ?>/css/dark.css" media="prefers-color-scheme: dark">
	<link rel="stylesheet" type="text/css" href="<?php echo $site['url_template']; ?>/css/print.css" media="print">
	<link rel="stylesheet" type="text/css" href="<?php echo $site['url_template']; ?>/css/style.css">

	<script defer src="<?php echo $site['url_template']; ?>/js/script.js"></script>
</head>

<body<?php if (isset($body_css) && $body_css != '') : ?> class="<?php echo $body_class; ?>"<?php endif; ?>>
	<header>
		<div class="left">
			<a href="<?php echo $site['url_home']; ?>" class="logo"></a>		
		</div>
		<div class="right">
			<?php if (is_logged_in()) : ?>
				<nav>
					<ul>
						<li><a href="<?php echo $site['url_home']; ?>">Home</a>
						<!-- TO BE ADDED PHP LATER --></li>
						<li><a href="#">Films</a></li>
						<li><a href="#">Community</a></li>
						<li><a href="<?php echo $site['url']; ?>/profile.php">Profile</a></a>
						<li>
						<!-- 
							I was thinking, maybe logout can be accessed 
							in the dropdown menu when you click the profile icon?  
						-->
							<a href="<?php echo $site['url_process']; ?>/do-logout.php">Logout</a>
						</li>
					</ul>
				</nav>
			<?php endif; ?>
		</div>
		
<!-- 		
		<search id="search_box">
			<form action="</?php echo $site['url']; ?>/search.php" method="get">
				<input name="s" type="search" placeholder="Search...">
				<button><i class="fa-solid fa-magnifying-glass"></i></button>
			</form>
		</search> -->
	</header>
	
	<div id="container">
	