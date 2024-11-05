<?php

#############
# READ
/*
	Create PDO read and write functions for MySQL
	to drop here using a simple wizard at:
	https://www.programminglogic.ca/server-side/pdo-functions/
*/
#############


##################################################################

/* mysql_read_user_xid: 
Get user info, avatar photo object, and cover photo object by user's numeric ID
*/
function mysql_read_user_xid($user_id = 0) {
	global $pdo, $pdo_user, $site;
	
	mysql_cxn_user();
	
	try {
		$stmt = $pdo_user->prepare("SELECT * FROM users WHERE user_id=:user_id && trashed='n'");
		
		$stmt->execute([
			'user_id' => intval($user_id)
		]);

		$data = $stmt->fetch(PDO::FETCH_OBJ);
        $avatar_url = $site['avatar_default'];
        
        //
		if ($data->avatar_id) {
			$stmt = $pdo_user->prepare("SELECT * FROM photos WHERE photo_id=:avatar_id && trashed='n'");
			
			$stmt->execute([
				'avatar_id' => intval($data->avatar_id)
			]);

			$photo = $stmt->fetch(PDO::FETCH_OBJ);

			if ($photo) {
				$data->avatar = $photo;

				if ($photo->photo_url) {
					$avatar_url = $site['url_content'].'/'.$photo->photo_url;
				}
			}
		}
		
		$data->avatar_url = $avatar_url;
		
		
		//
		if ($data->cover_id) {
			$stmt = $pdo_user->prepare("SELECT * FROM photos WHERE photo_id=:cover_id && trashed='n'");
			
			$stmt->execute([
				'cover_id' => intval($data->cover_id)
			]);

			$cover_photo = $stmt->fetch(PDO::FETCH_OBJ);

			if ($cover_photo) {
				$data->cover_photo = $cover_photo;
				$data->cover_photo_url = $site['url_content'].'/'.$cover_photo->photo_url;
			}
		}
	}
	catch(PDOException $exception){ 
       return $exception->getMessage(); 
    }
	
	return $data;
}


##################################################################

/* mysql_read_user_xemail: 
Get user info and avatar photo object by their email address
*/
function mysql_read_user_xemail($user_email = 'hello@example.com') {
	global $pdo, $pdo_user, $site;
	
	mysql_cxn_user();
	
	try {
		$stmt = $pdo_user->prepare("SELECT * FROM users WHERE email_addr=:email_addr && trashed='n'");
		
		$stmt->execute([
			'email_addr' => filter_var($user_email, FILTER_VALIDATE_EMAIL)
		]);

		$data = $stmt->fetch(PDO::FETCH_OBJ);
        $avatar_url = $site['avatar_default'];
        
        if ($data) {
            //
            $stmt = $pdo_user->prepare("SELECT * FROM photos WHERE photo_id=:avatar_id && trashed='n'");
            
			$stmt->execute([
				'avatar_id' => intval($data->avatar_id)
			]);

            $photo = $stmt->fetch(PDO::FETCH_OBJ);

            if ($photo) {
                $data->avatar = $photo;

                if ($photo->photo_url) {
                    $avatar_url = $site['url_content'].'/'.$photo->photo_url;
                }
            }

            $data->avatar_url = $avatar_url;
			
			//
			if ($data->cover_id) {
				$stmt = $pdo_user->prepare("SELECT * FROM photos WHERE photo_id=:cover_id && trashed='n'");
				
				$stmt->execute([
					'cover_id' => intval($data->cover_id)
				]);

				$cover_photo = $stmt->fetch(PDO::FETCH_OBJ);

				if ($cover_photo) {
					$data->cover_photo = $cover_photo;
					$data->cover_photo_url = $site['url_content'].'/'.$cover_photo->photo_url;
				}
			}
        }
        
	}
	catch(PDOException $exception){ 
       return $exception->getMessage(); 
    }
	
	return $data;
}


##################################################################

/* mysql_read_news_feed_list: 
Gets list of recent news feed stories from the specified user IDs
*/
function mysql_read_news_feed_list($user_ids = []) {
	global $pdo;
	
	mysql_cxn();
	
	try {
        $data = [];
        
        if ($user_ids) {
            $user_id_line = implode(',', array_map('intval', $user_ids));
            $in  = str_repeat('?,', count($user_ids) - 1) . '?';

            $stmt = $pdo->prepare("SELECT post_id FROM posts WHERE (user_id IN ($in)) && trashed='n' ORDER BY post_id DESC LIMIT 30");
            $stmt->execute($user_ids);

            while ($row = $stmt->fetch(PDO::FETCH_OBJ)) {
                $data[] = $row->post_id;
            }
        }
	}
	catch(PDOException $exception){ 
       return $exception->getMessage(); 
    }
	
	return $data;
}


##################################################################

/* mysql_read_mini_feed_list: 
Gets list of recent news feed stories from one 
specified user by their numeric ID
*/
function mysql_read_mini_feed_list($user_id = 0) {
	global $pdo;
	
	mysql_cxn();
	
	try {
		$stmt = $pdo->prepare("SELECT post_id FROM posts WHERE user_id=:user_id && trashed='n' ORDER BY post_id DESC LIMIT 30");
		
		$stmt->execute([
			'user_id' => intval($user_id)
		]);

		$data = [];

		while ($row = $stmt->fetch(PDO::FETCH_OBJ)) {
			$data[] = $row->post_id;
		}
	}
	catch(PDOException $exception){ 
       return $exception->getMessage(); 
    }
	
	return $data;
}


##################################################################

/* mysql_read_post_xid: 
Gets a single post by its numeric ID
*/
function mysql_read_post_xid($post_id = 0) {
	global $pdo, $site;
	
	mysql_cxn();
	
	try {
		$stmt = $pdo->prepare("SELECT * FROM posts WHERE post_id=:post_id && trashed='n'");
		
		$stmt->execute([
			'post_id' => intval($post_id)
		]);

		$data = $stmt->fetch(PDO::FETCH_OBJ);
	}
	catch(PDOException $exception){ 
       return $exception->getMessage(); 
    }
	
	return $data;
}


##################################################################

/* mysql_read_photo_xid: 
Gets a single photo by its numeric ID
*/
function mysql_read_photo_xid($photo_id = 0) {
	global $pdo, $site;
	
	mysql_cxn();
	
	try {
		$stmt = $pdo->prepare("SELECT * FROM photos WHERE photo_id=:photo_id && trashed='n'");
		
		$stmt->execute([
			'photo_id' => intval($photo_id)
		]);

		$data = $stmt->fetch(PDO::FETCH_OBJ);
	}
	catch(PDOException $exception){ 
       return $exception->getMessage(); 
    }
	
	return $data;
}


##################################################################

/* mysql_read_photos_xpost: 
Gets a list of photos attached to a single post by its numeric ID
*/
function mysql_read_photos_xpost($post_id = 0) {
	global $pdo;
	
	mysql_cxn();
	
	try {
		$stmt = $pdo->prepare("SELECT photo_id FROM photos WHERE post_id=:post_id && trashed='n'");
		
		$stmt->execute([
			'post_id' => intval($post_id)
		]);

		$data = [];

		while ($row = $stmt->fetch(PDO::FETCH_OBJ)) {
			$data[] = $row->photo_id;
		}
	}
	catch(PDOException $exception){ 
       return $exception->getMessage(); 
    }
	
	return $data;
}


##################################################################

/* mysql_read_photos_xuser: 
Gets a list of 10 recent photos from one user by their numeric ID
*/
function mysql_read_photos_xuser($user_id = 0) {
	global $pdo;
	
	mysql_cxn();
	
	try {
		$stmt = $pdo->prepare("SELECT photo_id FROM photos WHERE user_id=:user_id && trashed='n' ORDER BY photo_id DESC LIMIT 10");
		
		$stmt->execute([
			'user_id' => intval($user_id)
		]);

		$data = [];

		while ($row = $stmt->fetch(PDO::FETCH_OBJ)) {
			$data[] = $row->photo_id;
		}
	}
	catch(PDOException $exception){ 
       return $exception->getMessage(); 
    }
	
	return $data;
}


##################################################################

/* mysql_read_followers_list: 
Gets a list of a specific user's followers by that user's numeric ID
*/
function mysql_read_followers_list($user_id = 0) {
	global $pdo;
	
	mysql_cxn();
	
	try {
		$stmt = $pdo->prepare("SELECT user_id FROM followers WHERE followed_id=:followed_id && trashed='n'");
		
		$stmt->execute([
			'followed_id' => intval($user_id)
		]);
		
		$data = [];

		while ($row = $stmt->fetch(PDO::FETCH_OBJ)) {
			$data[] = $row->user_id;
		}
	}
	catch(PDOException $exception){ 
       return $exception->getMessage(); 
    }
	
	return $data;
}


##################################################################

/* mysql_read_following_list: 
Gets a list of users followed by one specific user by that user's numeric ID
*/
function mysql_read_following_list($user_id = 0) {
	global $pdo;
	
	mysql_cxn();
	
	try {
		$stmt = $pdo->prepare("SELECT followed_id FROM followers WHERE user_id=:user_id && trashed='n'");
		
		$stmt->execute([
			'user_id' => intval($user_id)
		]);
		
		$data = [];

		while ($row = $stmt->fetch(PDO::FETCH_OBJ)) {
			$data[] = $row->followed_id;
		}
	}
	catch(PDOException $exception){ 
       return $exception->getMessage(); 
    }
	
	return $data;
}


##################################################################

/* mysql_read_likes_list: 
Gets a list of user ids who liked a specific post by that post's numeric ID
*/
function mysql_read_likes_list($post_id = 0) {
	global $pdo;
	
	mysql_cxn();
	
	try {
		$stmt = $pdo->prepare("SELECT user_id FROM likes WHERE post_id=:post_id && trashed='n'");
		
		$stmt->execute([
			'post_id' => intval($post_id)
		]);
		
		$data = [];

		while ($row = $stmt->fetch(PDO::FETCH_OBJ)) {
			$data[] = $row->user_id;
		}
	}
	catch(PDOException $exception){ 
       return $exception->getMessage(); 
    }
	
	return $data;
}


##################################################################

/* mysql_read_password_reset: 
Check for an active password reset row in the database
*/
function mysql_read_password_reset($prc1 = '', $prc2 = '') {
	global $pdo;
	
	mysql_cxn();
	
	try {
		$stmt = $pdo->prepare("SELECT * FROM password_reset_code WHERE prc1=:prc1 && prc2=:prc2 && timestamp>:datetime && trashed='n'");
		
		$stmt->execute([
			'prc1' => $prc1, 
			'prc2' => $prc2, 
			'datetime' => date('Y-m-d H:i:s', strtotime('24 hours ago'))
		]);

		$data = $stmt->fetch(PDO::FETCH_OBJ);
	}
	catch(PDOException $exception){ 
       return $exception->getMessage(); 
    }
	
	return $data;
}

?>