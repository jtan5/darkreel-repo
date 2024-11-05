<?php

function draw_calendar($month, $year, $events = array()){
	global $site, $site_url, $page;

	/* draw table */
	$calendar = '<table id="main_wide_cal" cellpadding="0" cellspacing="0" class="calendar">';
	
	/* table headings */
	$headings = array('Sunday','Monday','Tuesday','Wednesday','Thursday','Friday','Saturday');
	$calendar.= '<tr class="calendar-row"><th class="calendar-day-head">'.implode('</th><th class="calendar-day-head">',$headings).'</th></tr>';

	/* days and weeks vars now ... */
	$running_day = date('w',mktime(0,0,0,$month,1,$year));
	$days_in_month = date('t',mktime(0,0,0,$month,1,$year));
	$days_in_this_week = 1;
	$day_counter = 0;
	$dates_array = array();

	/* row for week one */
	$calendar.= '<tr class="calendar-row">';

	/* print "blank" days until the first of the current week */
	for($x = 0; $x < $running_day; $x++):
		$calendar.= '<td class="calendar-day-np"></td>';
		$days_in_this_week++;
	endfor;

	/* keep going with days.... */
	for($list_day = 1; $list_day <= $days_in_month; $list_day++):
		$calendar.= '<td class="calendar-day">';
			/* add in the day number */
			$calendar.= '<a href="'.$site_url.'/'.$page->page_url.'/'.$year.'-'.str_pad($month, 2, 0, STR_PAD_LEFT).'-'.str_pad($list_day, 2, 0, STR_PAD_LEFT).'" class="holder"><div class="day-number">'.$list_day.'</div>';

			/** QUERY THE DATABASE FOR AN ENTRY FOR THIS DAY !!  IF MATCHES FOUND, PRINT THEM !! **/
			$cal_add = ''; //str_repeat('<p>&nbsp;</p>',2);
			
			$list_day_pad = str_pad($list_day, 2, 0, STR_PAD_LEFT);
			
			if (isset($events[$list_day_pad])) {
				$cal_add = '<div class="day_data">'; 
				
				foreach ($events[$list_day_pad] as $key => $value) {
					$cal_add .= '<span class="time">'.date('g:ia', strtotime($value->event_date)).'</span> <span class="title">'.$value->event_title.'</span><br>';
					
					//break; 
				}
				
				$cal_add .= '</div>'; 
			}
			
		$calendar.= $cal_add.'</a></td>';
		if($running_day == 6):
			$calendar.= '</tr>';
			if(($day_counter+1) != $days_in_month):
				$calendar.= '<tr class="calendar-row">';
			endif;
			$running_day = -1;
			$days_in_this_week = 0;
		endif;
		$days_in_this_week++; $running_day++; $day_counter++;
	endfor;

	/* finish the rest of the days in the week */
	if($days_in_this_week < 8):
		for($x = 1; $x <= (8 - $days_in_this_week); $x++):
			$calendar.= '<td class="calendar-day-np"></td>';
		endfor;
	endif;

	/* final row */
	$calendar.= '</tr>';

	/* end the table */
	$calendar.= '</table>';
	
	/* all done, return result */
	return $calendar;
}

?>