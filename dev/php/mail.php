<?php

$to = 'hello@andrewmccrea.co';
$subject = 'Some mail message';


$from_no_reply = "noreply_" . strtotime('now') . "@example.com";
$boundary = uniqid('np');

//headers - specify your from email address and name here
//and specify the boundary for the email
$headers = "MIME-Version: 1.0\n";
$headers .= "From: My Website <".$from_no_reply.">\n";
//$headers .= "Reply-To: My Website <".$thrusong_from.">\n";	
//$headers .= "Return-Path: ".$site_title_short." <".$thrusong_from.">\n";
$headers .= "BCC: amccrea@rrc.ca\n";
$headers .= "X-Mailer: MyPHPMailer\n";

$optionalparams = '-r'.$from_no_reply;

//$headers .= "To: ".$value."\n";
//$headers .= "Content-Type: multipart/alternative;boundary=" . $boundary . "\n";
$headers .= "Content-Type: multipart/mixed;boundary=" . $boundary . "\n";

//here is the content body
$message = "This is a MIME encoded message.";


if ($_FILES['cover_letter']['size'] > 0) {
	//Get uploaded file data using $_FILES array 
	$tmp_name    = $_FILES['cover_letter']['tmp_name']; // get the temporary file name of the file on the server 
	$name        = $_FILES['cover_letter']['name'];  // get the name of the file 
	$size        = $_FILES['cover_letter']['size'];  // get size of the file for size validation 
	$type        = $_FILES['cover_letter']['type'];  // get type of the file 
	$error       = $_FILES['cover_letter']['error']; // get the error (if any) 


	//read from the uploaded file & base64_encode content 
	$handle = fopen($tmp_name, "r");  // set the file handle only for reading the file 
	$content = fread($handle, $size); // reading the file 
	fclose($handle);                  // close upon completion 

	$encoded_content = chunk_split(base64_encode($content)); 

	//attachment 
	$message .= "\n\n--".$boundary."\n"; 
	$message .="Content-Type: $file_type; name=".$name."\n"; 
	$message .="Content-Disposition: attachment; filename=".$name."\n"; 
	$message .="Content-Transfer-Encoding: base64\n"; 
	$message .="X-Attachment-Id: ".rand(1000, 99999).rand(1000, 99999)."\n\n";  
	$message .= $encoded_content; // Attaching the encoded file with email 
	$message .= "\n\n";
}



if ($_FILES['resume']['size'] > 0) {
	//Get uploaded file data using $_FILES array 
	$tmp_name    = $_FILES['resume']['tmp_name']; // get the temporary file name of the file on the server 
	$name        = $_FILES['resume']['name'];  // get the name of the file 
	$size        = $_FILES['resume']['size'];  // get size of the file for size validation 
	$type        = $_FILES['resume']['type'];  // get type of the file 
	$error       = $_FILES['resume']['error']; // get the error (if any) 


	//read from the uploaded file & base64_encode content 
	$handle = fopen($tmp_name, "r");  // set the file handle only for reading the file 
	$content = fread($handle, $size); // reading the file 
	fclose($handle);                  // close upon completion 

	$encoded_content = chunk_split(base64_encode($content)); 

	//attachment 
	$message .= "\n\n--".$boundary."\n"; 
	$message .="Content-Type: $file_type; name=".$name."\n"; 
	$message .="Content-Disposition: attachment; filename=".$name."\n"; 
	$message .="Content-Transfer-Encoding: base64\n"; 
	$message .="X-Attachment-Id: ".rand(1000, 99999).rand(1000, 99999)."\n\n";  
	$message .= $encoded_content; // Attaching the encoded file with email 
	$message .= "\n\n";
}


$message .= "\n\n--" . $boundary . "\n";
$message .= "Content-type: text/html;charset=utf-8\n\n";

//Html body
$message .= '<html><style type="text/css"></style><body>';
$message .= '<div>';

$message .= '<br><br>Full name:<br>'.$full_name.'<br><br>';
$message .= 'Street address:<br>'.$street_address.'<br><br>';
$message .= 'City, province, and postal code:<br>'.$city_prov_post.'<br><br>'; //<br />';

$message .= 'Phone:<br>'.$phone.'<br><br>'; //<br />';
$message .= 'Email:<br>'.$email.'<br><br>'; //<br />';

$message .= 'Notes:<br>'.$notes.'<br><br>';

$message .= '</div>';
$message .= '</body></html>';

$message .= "\n\n--" . $boundary . "--";


mail($to, $subject, $message, $headers, $optionalparams);
?>