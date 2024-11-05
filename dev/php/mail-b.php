<?php

function send_mail($to = 'hello@andrewmccrea.co', $subject = 'Some mail message', $html_body = '', $plain_text = '', $cover_letter = null, $resume = null) {
	$name_no_reply = 'My Website';
	$email_no_reply = 'noreply_'.strtotime('now').'@example.com';
	
	$boundary = uniqid('np');

	
	$headers = "MIME-Version: 1.0\n";
	$headers .= "From: ".$name_no_reply." <".$email_no_reply.">\n";
	//$headers .= "Reply-To: ".$name_no_reply." <".$email_no_reply.">\n";	
	//$headers .= "Return-Path: ".$name_no_reply." <".$email_no_reply.">\n";
	//$headers .= "BCC: amccrea@rrc.ca\n";
	$headers .= "X-Mailer: MyPHPMailer\n";


	$headers .= "Content-Type: multipart/mixed;boundary=" . $boundary . "\n";

	//here is the content body
	$message = "This is a MIME encoded message.";


	if ($cover_letter['size'] > 0) {
		//read from the uploaded file & base64_encode content 
		$handle = fopen($cover_letter['tmp_name'], "r");  // set the file handle only for reading the file 
		$content = fread($handle, $cover_letter['size']); // reading the file 
		fclose($handle);                  // close upon completion 

		$encoded_content = chunk_split(base64_encode($content)); 

		//attachment 
		$message .= "\n\n--".$boundary."\n"; 
		$message .= "Content-Type: ".$cover_letter['type']." name=".$cover_letter['name']."\n"; 
		$message .="Content-Disposition: attachment; filename=".$cover_letter['name']."\n"; 
		$message .="Content-Transfer-Encoding: base64\n"; 
		$message .="X-Attachment-Id: ".rand(1000, 99999).rand(1000, 99999)."\n\n";  
		$message .= $encoded_content; // Attaching the encoded file with email 
		$message .= "\n\n";
	}



	if ($resume['size'] > 0) {
		//read from the uploaded file & base64_encode content 
		$handle = fopen($resume['tmp_name'], "r");  // set the file handle only for reading the file 
		$content = fread($handle, $resume['size']); // reading the file 
		fclose($handle);                  // close upon completion 

		$encoded_content = chunk_split(base64_encode($content)); 

		//attachment 
		$message .= "\n\n--".$boundary."\n"; 
		$message .= "Content-Type: ".$resume['type']." name=".$resume['name']."\n"; 
		$message .="Content-Disposition: attachment; filename=".$resume['name']."\n"; 
		$message .="Content-Transfer-Encoding: base64\n"; 
		$message .="X-Attachment-Id: ".rand(1000, 99999).rand(1000, 99999)."\n\n";  
		$message .= $encoded_content; // Attaching the encoded file with email 
		$message .= "\n\n";
	}

	
	$message .= "\n\n--" . $boundary . "\n";
	$message .= "Content-type: text/plain;charset=utf-8\n\n";

	//Plain text body
	$message .= $plain_text;
	$message .= "\n\n--" . $boundary . "\n";
	$message .= "Content-type: text/html;charset=utf-8\n\n";

	//Html body
	//$message .= $html_text;
	$message .= $html_body;
	$message .= "\n\n--" . $boundary . "--";
	
	
	//
	$optionalparams = '-r'.$email_no_reply;
	mail($to, $subject, $message, $headers, $optionalparams);
}




$to = 'hello@andrewmccrea.co';
$subject = 'Some subject';
$html = '<html><body></body></html>';
$text = 'Here is plain text message';

send_mail($to, $subject, $html, $text);

?>