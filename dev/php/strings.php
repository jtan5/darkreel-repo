<?php

function to_ascii($str, $replace=array(), $delimiter='-') {
	if( !empty($replace) ) {
		$str = str_replace((array)$replace, ' ', $str);
	}

	$clean = iconv('UTF-8', 'ASCII//TRANSLIT', $str);
	$clean = preg_replace("/[^a-zA-Z0-9\/_|+ -]/", '', $clean);
	$clean = strtolower(trim($clean, '_'));
	$clean = preg_replace("/[\/_|+ -]+/", $delimiter, $clean);

	return $clean;
}

function _generateRandom($length=6) {
    $_rand_src = array(
        array(48,57) //digits
        , array(97,122) //lowercase chars
//        , array(65,90) //uppercase chars
    );
    srand ((double) microtime() * 1000000);
    $random_string = "";
    for($i=0;$i<$length;$i++){
        $i1=rand(0,sizeof($_rand_src)-1);
        $random_string .= chr(rand($_rand_src[$i1][0],$_rand_src[$i1][1]));
    }
    return $random_string;
}

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

function highlight_matching_text($needle, $haystack, $default_class = 'match_highlight') {
	// return $haystack if there is no highlight color or strings given, nothing to do.
	
	$first_encode='XXXXXXXXXXXXXXX';     //ENCODE string
	
	$second_encode='YYYYYYYYYYYYYYY';
	
	preg_match_all("/$needle+/i", $haystack, $matches);
	
	if (is_array($matches[0]) && count($matches[0]) >= 1) {
		foreach ($matches[0] as $match) {
			$haystack = str_replace($match, $first_encode.$match.$second_encode, $haystack);
		}
	}
	
	$haystack=str_replace(array($first_encode,$second_encode), array('<span class="'.$default_class.'">','</span>'), $haystack);
       
    return $haystack;
}

function punctuated_finish($line) {
	$last_punctuation = substr($line, -1);
	
	if ($last_punctuation == "." || $last_punctuation == "!" || $last_punctuation == "?" || $last_punctuation == "," || $last_punctuation == '"' || $last_punctuation == "'") {
		return true;
	}

	return false;
}

?>