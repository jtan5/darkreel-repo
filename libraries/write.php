<?php

#############
# WRITE
/*
	Create PDO read and write functions for MySQL
	to drop here using a simple wizard at:
	https://www.programminglogic.ca/server-side/pdo-functions/
*/
#############


##################################################################

/* mysql_write_register: 
Create a new user in the database
*/
function mysql_write_register($email_address = '', $password = '', $first_name = '', $last_name = '', $username = '') {
	global $pdo_user;
	
	mysql_cxn_user();
	
	try {
		$sql = "INSERT INTO users (email_addr, password, first_name, last_name, username, timestamp) VALUES (:email_address, :password, :first_name, :last_name, :username, :timestamp)";

		$pdo_user->prepare($sql)->execute([
			'email_address' => $email_address, 
			'password' => $password, 
			'first_name' => $first_name, 
			'last_name' => $last_name, 
			'username' => $username, 
			'timestamp' => date('Y-m-d H:i:s')
		]);

		$id = $pdo_user->lastInsertId();
	}
	catch(PDOException $exception){ 
       return $exception->getMessage(); 
    }	
	
	return $id;
}


##################################################################

/* mysql_write_post: 
Create a new post in the database
*/
function mysql_write_post($user_id = 0, $post_copy = '') {
	global $pdo;
	
	mysql_cxn();
	
	try {
		$sql = "INSERT INTO posts (user_id, post_copy) VALUES (:user_id, :post_copy)";

		$pdo->prepare($sql)->execute([
			'user_id' => $user_id, 
			'post_copy' => $post_copy
		]);

		$id = $pdo->lastInsertId();
	}
	catch(PDOException $exception){ 
       return $exception->getMessage(); 
    }
	
	return $id;
}


##################################################################

/* mysql_write_photo: 
Create a new photo in the database
*/
function mysql_write_photo($user_id = 0, $post_id = 0, $photo_url = '') {
	global $pdo;
	
	mysql_cxn();
	
	try {
		$sql = "INSERT INTO photos (user_id, post_id, photo_url) VALUES (:user_id, :post_id, :photo_url)";    

		$pdo->prepare($sql)->execute([
			'user_id' => $user_id, 
			'post_id' => $post_id, 
			'photo_url' => $photo_url
		]);

		$id = $pdo->lastInsertId();
	}
	catch(PDOException $exception){ 
       return $exception->getMessage(); 
    }
	
	return $id;
}


##################################################################

/* mysql_write_follow_xid: 
Create a follower in the database (one user follows another)
*/
function mysql_write_follow_xid($user_id = 0, $followed_id = 0) {
	global $pdo;
	
	mysql_cxn();
	
	try {
		$sql = "INSERT INTO followers (user_id, followed_id) VALUES (:user_id, :followed_id)";

		$pdo->prepare($sql)->execute([
			'user_id' => $user_id, 
			'followed_id' => $followed_id
		]);

		$id = $pdo->lastInsertId();
	}
	catch(PDOException $exception){ 
       return $exception->getMessage(); 
    }	
	
	return $id;
}


##################################################################

/* mysql_write_unfollow_xid: 
Destroy a follower in the database but keep a record of it (user stops follower another)
*/
function mysql_write_unfollow_xid($user_id = 0, $followed_id = 0) {
	global $pdo;
	
	mysql_cxn();
	
	try {
		$sql = "UPDATE followers SET trashed='y' WHERE user_id=:user_id && followed_id=:followed_id";

		$pdo->prepare($sql)->execute([
			'user_id' => $user_id, 
			'followed_id' => $followed_id
		]);
	}
	catch(PDOException $exception){ 
       return $exception->getMessage(); 
    }
	
	return true;
}


##################################################################

/* mysql_write_like_xid: 
Create a like in the database (one user likes a post)
*/
function mysql_write_like_xid($user_id = 0, $post_id = 0) {
	global $pdo;
	
	mysql_cxn();
	
	try {
		$sql = "INSERT INTO likes (user_id, post_id) VALUES (:user_id, :post_id)";

		$pdo->prepare($sql)->execute([
			'user_id' => $user_id, 
			'post_id' => $post_id
		]);

		$id = $pdo->lastInsertId();
	}
	catch(PDOException $exception){ 
       return $exception->getMessage(); 
    }	
	
	return $id;
}


##################################################################

/* mysql_write_unlike_xid: 
Destroy a like in the database but keep a record of it (user unlikes a post)
*/
function mysql_write_unlike_xid($user_id = 0, $post_id = 0) {
	global $pdo;
	
	mysql_cxn();
	
	try {
		$sql = "UPDATE likes SET trashed='y' WHERE user_id=:user_id && post_id=:post_id";

		$pdo->prepare($sql)->execute([
			'user_id' => $user_id, 
			'post_id' => $post_id
		]);
	}
	catch(PDOException $exception){ 
       return $exception->getMessage(); 
    }
	
	return true;
}


##################################################################

/* mysql_write_delete_xpost: 
Destroy a post in the database by its numeric ID
*/
function mysql_write_delete_xpost($post_id = 0) {
    global $pdo;
	
	mysql_cxn();
	
	try {
		$sql = "UPDATE posts SET trashed='y' WHERE post_id=:post_id";

		$pdo->prepare($sql)->execute([
			'post_id' => $post_id
		]);
	}
	catch(PDOException $exception){ 
       return $exception->getMessage(); 
    }	
	
	return true;
}


##################################################################

/* mysql_write_delete_xphoto: 
Destroy a photo in the database by its numeric ID
*/
function mysql_write_delete_xphoto($photo_id = 0) {
    global $pdo;
	
	mysql_cxn();
	
	try {
		$sql = "UPDATE photos SET trashed='y' WHERE photo_id=:photo_id";

		$pdo->prepare($sql)->execute([
			'photo_id' => $photo_id
		]);
	}
	catch(PDOException $exception){ 
       return $exception->getMessage(); 
    }
	
	return true;
}


##################################################################

/* mysql_write_password_reset: 
Creates a database entry to verify an email address and reset a password
*/
function mysql_write_password_reset($user_id = 0, $prc1 = '', $prc2 = '') {
	global $pdo;
	
	mysql_cxn();
    
	try {
		$sql = "INSERT INTO password_reset_code (user_id, prc1, prc2) VALUES (:user_id, :prc1, :prc2)";

		$pdo->prepare($sql)->execute([
			'user_id' => $user_id, 
			'prc1' => $prc1, 
			'prc2' => $prc2
		]);

		$id = $pdo->lastInsertId();
	}
	catch(PDOException $exception){ 
       return $exception->getMessage(); 
    }
	
	return $id;
}


##################################################################

/* mysql_write_delete_prc: 
Creates a database entry to verify an email address and reset a password
*/
function mysql_write_delete_prc($reset_id = 0) {
	global $pdo;
	
	mysql_cxn();
    
	try {
		$sql = "UPDATE password_reset_code SET trashed='y' WHERE reset_id=:reset_id";

		$pdo->prepare($sql)->execute([
			'reset_id' => $reset_id, 
			'prc1' => $prc1, 
			'prc2' => $prc2
		]);
	}
	catch(PDOException $exception){ 
       return $exception->getMessage(); 
    }	
	
	return $id;
}


##################################################################

/* mysql_write_update_profile: 
Update a user row in the database with new information (like from a profile edit)
*/
function mysql_write_update_profile($user_id = 0, $email_address = '', $first_name = '', $last_name = '', $username = '', $avatar_id = 0, $cover_id = 0) {
	global $pdo_user;
	
	mysql_cxn_user();
	
	try {
		$sql = "UPDATE users SET email_addr=:email_address, first_name=:first_name, last_name=:last_name, username=:username, avatar_id=:avatar_id, cover_id=:cover_id WHERE user_id=:user_id";

		$pdo_user->prepare($sql)->execute([
			'email_address' => $email_address, 
			'first_name' => $first_name, 
			'last_name' => $last_name, 
			'username' => $username, 
			'avatar_id' => $avatar_id, 
			'cover_id' => $cover_id, 
			'user_id' => $user_id
		]);
	}
	catch(PDOException $exception){ 
       return $exception->getMessage(); 
    }
	
	return $id;
}


##################################################################

/* mysql_write_update_password: 
Update a user row in the database with a new password
*/
function mysql_write_update_password($user_id = 0, $password = '') {
	global $pdo;
	
	mysql_cxn();
	
	try {
		$sql = "UPDATE users SET password=:password WHERE user_id=:user_id";

		$pdo->prepare($sql)->execute([
			'password' => $password, 
			'user_id' => $user_id
		]);
	}
	catch(PDOException $exception){ 
       return $exception->getMessage(); 
    }
	
	return $id;
}

?>