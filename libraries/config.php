<?php


// LOCAL ENVIRONMENT SETTINGS
include 'config.local.php';


//
date_default_timezone_set('America/Winnipeg');
setlocale(LC_ALL, 'en_US.UTF8'); 
header_remove("X-Powered-By");


// Main site details
$site['name'] = 'DarkReel';
$site['title'] = 'Connect with the horror community'.$site['name'];

$site['url_home'] = $site['url'];
$site['url_search'] = $site['url'].'/search.php?s=';
$site['url_template'] = $site['url'].'/template';
$site['url_content'] = $site['url'].'/content';
$site['url_process'] = $site['url'].'/process';

// This is a PHP script pretending to be a jpg file
// It reads your main hex in style.css to use a matching
// background colour behind the person outline
$site['avatar_default'] = $site['url_template'].'/img/php/avatar';

$site['general_email'] = 'hello@thesocialnetwork.com';

// Other config variables
/*

	API keys and other config variables can go here

*/


// Database connection 
function mysql_cxn() {
	global $mysql, $pdo;
	
	if (!$pdo) {
		$host = $mysql['host'];
		$port = $mysql['port'];
		$db   = $mysql['db'];
		$user = $mysql['user'];
		$pass = $mysql['pass'];
		$charset = 'utf8mb4';

		$dsn = "mysql:host=$host;port=$port;dbname=$db;charset=$charset";
		
		$options = [
			PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
			PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
			PDO::ATTR_EMULATE_PREPARES   => false,
		];
		
		try {
			 $pdo = new PDO($dsn, $user, $pass, $options);
		} 
		catch (\PDOException $e) {
			 throw new \PDOException($e->getMessage(), (int)$e->getCode());
		}
	}
	
	return $pdo;
}

// Secondary database connection
// Good if you have a central users table behind
// multiple sites (ex. single sign-on passport)
// If you just set the credentials to the same as above
// this will seamlessly use the local user table but 
// why open one two connections for one pageview? 
// Instead, we just make sure $pdo has been established
// and then we duplicate it into $pdo_user
function mysql_cxn_user() {
	global $pdo_user, $pdo;
	
	/*if (!$pdo_user) {
		$host = 'localhost';
		$port = '3306';
		$db   = 'thesocialnetwork-solved';
		$user = 'thesocialnetwork-solved';
		$pass = 'aQfd04Cp//CQRZ1Z';
		$charset = 'utf8mb4';

		$dsn = "mysql:host=$host;port=$port;dbname=$db;charset=$charset";
		
		$options = [
			PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
			PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
			PDO::ATTR_EMULATE_PREPARES   => false,
		];
		
		try {
			 $pdo_user = new PDO($dsn, $user, $pass, $options);
		} 
		catch (\PDOException $e) {
			 throw new \PDOException($e->getMessage(), (int)$e->getCode());
		}
	}*/

	mysql_cxn();
	$pdo_user = $pdo;
	
	return $pdo_user;
}


// Session stuff
$session_save_path = '/tmp';
if ($site['env'] == 'windows') {
	$session_save_path = 'C:\MAMP\tmp';
}

session_save_path($session_save_path);

ini_set('session.gc_probability', 1);
ini_set('session.gc_maxlifetime', 2592000);
ini_set('session.gc_divisor', 1000);
ini_set('session.cookie_lifetime', 8640000);

// session.cookie_domain should generally be .domain.com 
// (dot domain dot come) so it matches all subdomains like www
// the user is then signed in across your top-level domain
//ini_set('session.cookie_domain', '.serverside.ca');

// The domain here should generally just be the 
// top-level domain without a leading period/dot
//session_set_cookie_params(8640000, '/', 'serverside.ca');

// Start the session
session_start();

// If there's a session and a logged in ID has been set
// get the user's current info from the database including
// their profile and cover photo, and store it all in 
// the global $user object which is available everywhere 
if ($_SESSION && $_SESSION['user_id']) {
    // If user is logged in, grab their profile information and avatar
	mysql_cxn_user();
	
	try {
		$stmt = $pdo_user->prepare("SELECT * FROM users WHERE user_id=:user_id && trashed='n'");
		$stmt->execute(['user_id' => intval($_SESSION['user_id'])]);

		$user = $stmt->fetch(PDO::FETCH_OBJ);
        $avatar_url = $site['avatar_default'];
        
        if ($user && $user->avatar_id) { 
            $stmt = $pdo_user->prepare("SELECT * FROM photos WHERE photo_id=:avatar_id && trashed='n'");
            $stmt->execute(['avatar_id' => intval($user->avatar_id)]);

            $avatar = $stmt->fetch(PDO::FETCH_OBJ);

            if ($avatar) {
                $user->avatar = $avatar;

                if ($avatar->photo_url) {
                    $avatar_url = $site['url_content'].'/'.$avatar->photo_url;
                }
            }
        }
        
        $user->avatar_url = $avatar_url;
		
		if ($user && $user->cover_id) { 
            $stmt = $pdo_user->prepare("SELECT * FROM photos WHERE photo_id=:cover_id && trashed='n'");
            $stmt->execute(['cover_id' => intval($user->cover_id)]);

            $cover_photo = $stmt->fetch(PDO::FETCH_OBJ);

            if ($cover_photo) {
                $user->cover_photo = $cover_photo;
				$user->cover_photo_url = $site['url_content'].'/'.$cover_photo->photo_url;
            }
        }
	}
	catch(PDOException $exception){ 
       echo $exception->getMessage(); 
    }
	
    // Set the logo and home links to home.php instead of index.php
	$site['url_home'] = $site['url'].'/home.php';
    
    // Can access this user's info anywhere in the global $user object
}


// Critical functions we've written ourselves
function is_logged_in() {
    if ($_SESSION && $_SESSION['user_id']) {
        return true;
    }
    
    return false;
}

?>