<?php

#############
# SEARCH
/*
	Create PDO search functions for MySQL
	to drop here using a simple wizard at:
	https://www.programminglogic.ca/server-side/pdo-functions/
*/
#############

##################################################################

/* mysql_read_search_post_list: 
Run the search term against the posts table and create a list of any matches
*/
function mysql_read_search_post_list($search_term = '') {
	global $pdo, $archive_year;
	
	mysql_cxn();
	
	try {
		$stmt = $pdo->prepare("SELECT post_id FROM posts WHERE (post_copy LIKE :search_term) && trashed='n'");
		
		$stmt->execute([
			'search_term' => '%'.$search_term.'%'
		]);

		$data = array();

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

/* mysql_read_search_user_list: 
Run the search term against the users table and create a list of any matches
*/
function mysql_read_search_user_list($search_term = '') {
	global $pdo, $archive_year, $user;
	
	mysql_cxn();
	
	try {
        if ($user) {
            $query = "SELECT user_id FROM users WHERE (username LIKE :search_term) && user_id<>:user_id && trashed='n'";
            
            $stmt = $pdo->prepare($query);
            
			$stmt->execute([
				'search_term' => '%'.$search_term.'%', 'user_id' => $user->user_id
			]);
        }
        else {
            $query = "SELECT user_id FROM users WHERE (username LIKE :search_term) && trashed='n'";
            
            $stmt = $pdo->prepare($query);
            
			$stmt->execute([
				'search_term' => '%'.$search_term.'%'
			]);
        }

		$data = array();

		while ($row = $stmt->fetch(PDO::FETCH_OBJ)) {
			$data[] = $row->user_id;
		}
	}
	catch(PDOException $exception){ 
       return $exception->getMessage(); 
    }
	
	return $data;
}

?>