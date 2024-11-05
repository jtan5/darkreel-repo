<?php

/* fetch_url: 
Opens a specified file or URL and returns the raw contents
(so you can store it in a variable or create a file object for editing)
*/
function fetch_url($url) {
    $allowUrlFopen = preg_match('/1|yes|on|true/i', ini_get('allow_url_fopen'));
    
	if ($allowUrlFopen) {
        return file_get_contents($url);
    } 
	elseif (function_exists('curl_init')) {
        $c = curl_init($url);
        
		curl_setopt($c, CURLOPT_RETURNTRANSFER, 1);
        $contents = curl_exec($c);
        
		curl_close($c);
        
		if (is_string($contents)) {
            return $contents;
        }
    }
	
    return false;
}

function tidy_url($domain_name = '') {
	$domain_name = str_replace('http://', '', $domain_name);
	$domain_name = str_replace('https://', '', $domain_name);
	$domain_name = str_replace('www.', '', $domain_name);
	$domain_name = rtrim($domain_name, '/');
	
	return $domain_name;
}

function make_bitly_url($url,$format = 'xml',$version = '2.0.1') {
	//Set up account info
	$bitly_login = '';
	$bitly_api = '';
	
	//create the URL
	//$bitly = 'http://api.bit.ly/shorten?version='.$version.'&longUrl='.urlencode($url).'&login='.$bitly_login.'&apiKey='.$bitly_api.'&format='.$format;
	$bitly = 'https://api-ssl.bitly.com/shorten?version='.$version.'&longUrl='.urlencode($url).'&access_token='.$bitly_api.'&format='.$format;
	
	//get the url
	$response = file_get_contents($bitly);
	
	//parse depending on desired format
	if(strtolower($format) == 'json') {
		$json = @json_decode($response,true);
		return $json['results'][$url]['shortUrl'];
	}
	else { //For XML
		$xml = simplexml_load_string($response);
		return 'http://bit.ly/'.$xml->results->nodeKeyVal->hash;
	}
}

function scrape_insta($username) {
	$insta_source = file_get_contents('http://instagram.com/'.$username);
	$shards = explode('window._sharedData = ', $insta_source);
	$insta_json = explode(';</script>', $shards[1]); 
	$insta_array = json_decode($insta_json[0], TRUE);
	return $insta_array;
}

function current_url() {
	$pageURL = 'http';
	
	if ($_SERVER["HTTPS"] == "on") {
		$pageURL .= "s";
	}
	
	$pageURL .= "://";
	
	if ($_SERVER["SERVER_PORT"] != "80" && $_SERVER["SERVER_PORT"] != "443") {
		$pageURL .= $_SERVER["HTTP_HOST"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];
	} 
	else {
		$pageURL .= $_SERVER["HTTP_HOST"].$_SERVER["REQUEST_URI"];
	}
	
	return $pageURL;
}

function extract_youtube_url($url) {
	global $extract_youtube_url, $yt_link;
	
	$yt_link = 'desktop';
	//$youtube = preg_match("#https?://(?:www\.)?youtube.com#", $url, $result);
	$youtube = preg_match('~
        # Match non-linked youtube URL in the wild. (Rev:20130823)
        https?://         # Required scheme. Either http or https.
        (?:[0-9A-Z-]+\.)? # Optional subdomain.
        (?:               # Group host alternatives.
          youtu\.be/      # Either youtu.be,
        | youtube         # or youtube.com or
          (?:-nocookie)?  # youtube-nocookie.com
          \.com           # followed by
          \S*             # Allow anything up to VIDEO_ID,
          [^\w\s-]       # but char before ID is non-ID char.
        )                 # End host alternatives.
        ([\w-]{11})      # $1: VIDEO_ID is exactly 11 chars.
        (?=[^\w-]|$)     # Assert next char is non-ID or EOS.
        (?!               # Assert URL is not pre-linked.
          [?=&+%\w.-]*    # Allow URL (query) remainder.
          (?:             # Group pre-linked alternatives.
            [\'"][^<>]*>  # Either inside a start tag,
          | </a>          # or inside <a> element text contents.
          )               # End recognized pre-linked alts.
        )                 # End negative lookahead assertion.
        [?=&+%\w.-]*        # Consume any URL (query) remainder.
        ~ix', $url, $result);
	$cleaned_url = $result[1];
	
	if (!$youtube) {
		$yt_link = 'mobile';
    	$youtube = preg_match("#https?://(?:www\.)?youtu.be#", $url); //, $result);
		//$youtube = preg_match("#(http://www\.youtu.be/[%&=#\w-]*)#", $url, $result);
		
		if ($youtube) {
			$result = end(explode('/', $url));
			
			$result = str_replace('.', '', $result);
			$result = str_replace('!', '', $result);
			$result = str_replace('?', '', $result);
			$result = str_replace('"', '', $result);
			$result = str_replace('\'', '', $result);
			$cleaned_url = $result;
		}
	}
	
	$extract_youtube_url = $cleaned_url;
	
	return $youtube;
}

?>