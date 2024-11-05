<?php

function ago($datefrom, $dateto=-1) {
	// Defaults and assume if 0 is passed in that
	// its an error rather than the epoch
	
	if($datefrom==0) { return "A long time ago"; }
	if($dateto==-1) { $dateto = time(); }
	
	// Make the entered date into Unix timestamp from MySQL datetime field
	
	$datefrom = strtotime($datefrom);
	
	// Calculate the difference in seconds betweeen
	// the two timestamps
	
	$difference = $dateto - $datefrom;
	
	// Based on the interval, determine the
	// number of units between the two dates
	// From this point on, you would be hard
	// pushed telling the difference between
	// this function and DateDiff. If the $datediff
	// returned is 1, be sure to return the singular
	// of the unit, e.g. 'day' rather 'days'
	
	switch(true)
	{
		// If difference is less than 60 seconds,
		// seconds is a good interval of choice
		case(strtotime('-1 min', $dateto) < $datefrom):
			$datediff = $difference;
			$res = ($datediff==1) ? $datediff.' s' : $datediff.' s';
			break;
		// If difference is between 60 seconds and
		// 60 minutes, minutes is a good interval
		case(strtotime('-1 hour', $dateto) < $datefrom):
			$datediff = floor($difference / 60);
			$res = ($datediff==1) ? $datediff.' m' : $datediff.' m';
			break;
		// If difference is between 1 hour and 24 hours
		// hours is a good interval
		case(strtotime('-1 day', $dateto) < $datefrom):
			$datediff = floor($difference / 60 / 60);
			$res = ($datediff==1) ? $datediff.' h' : $datediff.' h';
			break;
		// If difference is between 1 day and 7 days
		// days is a good interval               
		case(strtotime('-1 week', $dateto) < $datefrom):
			$day_difference = 1;
			while (strtotime('-'.$day_difference.' d', $dateto) >= $datefrom)
			{
				$day_difference++;
			}
		   
			$datediff = $day_difference;
			$res = ($datediff==1) ? 'yesterday' : $datediff.' d';
			break;
		// If difference is between 1 week and 30 days
		// weeks is a good interval           
		case(strtotime('-1 month', $dateto) < $datefrom):
			$week_difference = 1;
			while (strtotime('-'.$week_difference.' week', $dateto) >= $datefrom)
			{
				$week_difference++;
			}
		   
			$datediff = $week_difference;
			$res = ($datediff==1) ? $datediff.' w' : $datediff.' w';
			break;           
		// If difference is between 30 days and 365 days
		// months is a good interval, again, the same thing
		// applies, if the 29th February happens to exist
		// between your 2 dates, the function will return
		// the 'incorrect' value for a day
		case(strtotime('-1 year', $dateto) < $datefrom):
			$months_difference = 1;
			while (strtotime('-'.$months_difference.' month', $dateto) >= $datefrom)
			{
				$months_difference++;
			}
		   
			$datediff = $months_difference;
			$res = ($datediff==1) ? $datediff.' m' : $datediff.' m';
	
			break;
		// If difference is greater than or equal to 365
		// days, return year. This will be incorrect if
		// for example, you call the function on the 28th April
		// 2008 passing in 29th April 2007. It will return
		// 1 year ago when in actual fact (yawn!) not quite
		// a year has gone by
		case(strtotime('-1 year', $dateto) >= $datefrom):
			$year_difference = 1;
			while (strtotime('-'.$year_difference.' y', $dateto) >= $datefrom)
			{
				$year_difference++;
			}
		   
			$datediff = $year_difference;
			$res = ($datediff==1) ? $datediff.' y' : $datediff.' y';
			break;	   
	}
	
	return $res;
}

function perfect_time_line($the_timestamp) {
	//
	$time_now = strtotime('now');
	
	$time_then = strtotime($the_timestamp);
	$time_diff = $time_now - $time_then;
	
	//$news_date = str_replace(' ', '', ago($the_timestamp));
	$news_date = date('M j (g:ia)', $time_then);
	
	if (date('y-m-d', $time_now) == date('y-m-d', $time_then)) {
		$news_date = str_replace(' ', '', ago($the_timestamp));
	}
	elseif (date('y', $time_now) != date('y', $time_then)) {
		$news_date = date('M j, Y (g:ia)', $time_then);
	}
	
	return $news_date;
}

function tod_title() {
	$hour = date('G');
	$edition = 'Good night'; //8PM - MIDNIGHT
	
	if ($hour >= 0 && $hour < 3) { //MIDNIGHT - 3AM 
		//$edition = 'Midnight Express';
		$edition = 'Good morning';
	}
	if ($hour >= 3 && $hour < 6) { //3AM - 6AM
		$edition = 'Good morning';
	}
	elseif ($hour >= 6 && $hour < 12) { //6AM - NOON
		//$edition = 'Morning Grind';
		$edition = 'Good day';
	}
	elseif ($hour >= 12 && $hour < 16) { //NOON - 4PM 
		//$edition = 'Afternoon Review';
		$edition = 'Good afternoon';
	}
	elseif ($hour >= 16 && $hour < 20) { //4PM - 8PM 
		//$edition = 'Evening Report';
		$edition = 'Good evening';
	}
	
	return $edition;
}

function age_from_birthday($p_strDate) {
    list($Y,$m,$d) = explode('-', $p_strDate);
    
	return( date("md") < $m.$d ? date("Y")-$Y-1 : date("Y")-$Y );
}

?>