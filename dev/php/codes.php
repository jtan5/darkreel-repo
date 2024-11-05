<?php

function generate_code($length = 8) {
      global $generate_code;
	  
	  $possible = "023456789abcdefghjkmnopqrstuvwxyzABCDEFGHJKLMNOPQRSTUVWXYZ";
      $generate_code = "";
      $i = 0;
      
	  while ($i < $length) { 
         $generate_code .= substr($possible, mt_rand(0, strlen($possible)-1), 1);
         $i++;
      }
	  
      return $generate_code;
}

function file_code_letter(){
    $int = rand(0,25);
    $a_z = "abcdefghijklmnopqrstuvwxyz";
    
	$rand_letter = $a_z[$int];
	
    return $rand_letter;
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

function generate_uuid() {
    return sprintf( '%04x%04x-%04x-%04x-%04x-%04x%04x%04x',
        mt_rand( 0, 0xffff ), mt_rand( 0, 0xffff ),
        mt_rand( 0, 0xffff ),
        mt_rand( 0, 0x0C2f ) | 0x4000,
        mt_rand( 0, 0x3fff ) | 0x8000,
        mt_rand( 0, 0x2Aff ), mt_rand( 0, 0xffD3 ), mt_rand( 0, 0xff4B )
    );

}

?>
