<?php

#############
# FUNCTIONS
/*
	Find other cool features and functions 
	to drop in this file from here: 
	https://www.programminglogic.ca/server-side/code-collection/
*/
#############


##################################################################

/* singular_clean: 
Older method for making a string safe 
before inserting into a database
*/
function singular_clean($value = '', $strip_tags = '', $int_me = false) {
	global $cxn;
	
	$value = trim($value);
	$value = strip_tags($value, $strip_tags);
	//$value = mysqli_escape_string($cxn, $value);
	
	if ($int_me == true) {
		$value = intval($value);
	}
	
	return $value;
}


##################################################################

/* rqst: 
This makes an entire multi-dimensional array safe 
before inserting values into a database
*/
function rqst($rqst_array = array(), $strip_tags = '', $keys_to_int = array()) {
	// rqsti() function renamed to takeover rqst(); 
	global $cxn;
	
	if (!empty($rqst_array)) {
		//mysql_cxn();

		array_walk_recursive($rqst_array, function (&$value, $key) use ($cxn, $strip_tags, $keys_to_int) {
			/*$value = trim($value);
			$value = strip_tags($value, $strip_tags);
			$value = mysqli_escape_string($cxn, $value);*/
			
			$keys_int = false;
			if (in_array($key, $keys_to_int)) {
				$keys_int = true;
			}
			
			$value = singular_clean($value, $strip_tags, $keys_int);
			
			return $value;
		});
	}
	
	return $rqst_array;
}


##################################################################

/* pretty_print: 
Visually inspect all of an array's keys and values
*/
function pretty_print($the_array = array()) {
    echo '<pre>';
    print_r($the_array);
    echo '</pre>';
}


##################################################################

/* generate_uuid: 
Create a universally unique ID (UUID) that looks like 
this: f0c6a2d1-ad06-44d3-a9d9-1911d27f876a (36 chars)
*/
function generate_uuid() {
    return sprintf( '%04x%04x-%04x-%04x-%04x-%04x%04x%04x',
        mt_rand( 0, 0xffff ), mt_rand( 0, 0xffff ),
        mt_rand( 0, 0xffff ),
        mt_rand( 0, 0x0C2f ) | 0x4000,
        mt_rand( 0, 0x3fff ) | 0x8000,
        mt_rand( 0, 0x2Aff ), mt_rand( 0, 0xffD3 ), mt_rand( 0, 0xff4B )
    );

}


##################################################################

/* str_multi_s: 
Add an "s" to the end of the word if the count is zero, 
or two and above (no 's' for the number one)
*/
function str_multi_s($number = 0, $type = 'item', $full = false) {
	$finished_word = $type;
	if ($number != 1) {
		$finished_word = $type.'s';
	}
	
	if ($full === true) {
		$finished_word = $number.' '.$multi_s;
	}
	
	return $finished_word;
}


##################################################################

/* str_pluralize: 
Adds possessive grammar on name strings
Name's or Names' depending on last letter being s.
*/
function str_pluralize($plural_word = 'item') {
	$finished_word = $plural_word."'s";
	
	if (substr($plural_word, -1) == 's') {
		$finished_word = $plural_word."'";
	}
	
	return $finished_word;
}


##################################################################

/* str_first_at: 
This adds an '@' to the beginning of a string
*/
function str_first_at($user_name = 'me') {
	$finished_word = ltrim($user_name, '@');
	$finished_word = '@'.$user_name;
	
	return $finished_word;
}


##################################################################

/* str_post_copy_formatter: 
This cleans up someone's post copy before displaying on the site
*/
function str_post_copy_formatter($post_copy = '') {
    global $site;
    
    $post_copy = nl2br($post_copy);
    $post_copy = preg_replace('/(?<!\S)#([0-9\p{L}]+)/', '<a href="'.$site['url_search'].'$1">#$1</a>', $post_copy);
    
    return $post_copy;
}


##################################################################

/* str_html_safe_echo: 
If you want to echo some text with quotation marks in it into an 
HTML attribute, like value="here's text with a "quote" in it", this
function changes it to value="here's text with a &quot;quote&quot; in it"
so you don't break your HTML
*/
function str_html_safe_echo($finished_word = 'Some text with quotes in it') {
    $finished_word = htmlspecialchars($finished_word);
    
    return $finished_word;
}


##################################################################

/* dynamic_comma_and: 
Takes some items in an array and creates a string with an Oxford comma delimited list
ex. Andrew and Louis
ex. Andrew, Louis, and Person X
ex. Andrew, Louis, Person X, and Person Y
ex. Andrew
*/
function dynamic_comma_and($array) {
	global $dynamic_comma;
	
	if (count($array) > 2) {
		$last_v = end($array);
		$last_k = key($array);
		
		$array[$last_k] = 'and '.$last_v;
		$dynamic_comma = implode(', ', $array);
	}
	else {
		$dynamic_comma = implode(' and ', $array);
	}
	
	return $dynamic_comma;
}

?>