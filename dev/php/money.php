<?php

function format_money($money_price) {
	$points_s = number_format($money_price, 2); 
	
	$pretty_price = number_format($money_price, 2, ".", ",");
	$pretty_price = '$'.$pretty_price;
		
	if ($points_s < 1.00) {
		$pretty_price = $points_s * 100;
		$pretty_price = $pretty_price.'&cent;';
	}
	
	return $pretty_price;
}

function cents_fancy_price($points) {
	global $royalty_money;
	
	//$data = $points / 100;
	//$number = floor(($data*100))/100;
	$number = $points / 100;
	
	$points_s = number_format($number, 2); 
	
	$pretty_price = 'FREE';
	
	if ($points_s > 0) {
		$pretty_price = number_format($number, 2, ".", ",");
		$pretty_price = '$'.$pretty_price;
		
		if ($points_s < 1.00) {
			$pretty_price = $points_s * 100;
			$pretty_price = $pretty_price.'&cent;';
		}
	}
	
	$royalty_money = $pretty_price;
	return $royalty_money;
}

?>