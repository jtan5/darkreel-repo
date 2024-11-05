<?php

function pagination($target_link, $result_count, $current_page = 1, $results_per_page = 10, $css_class = 'pagination', $min = 10) {
	global $pagination;
	
	$pages = ceil($result_count / $results_per_page);
	
	$links = array();
	if ($pages > 1) {
		for ($i = 1; $i <= $pages; $i++) {
			$pagination_html = '<a href="'.$target_link.'page/'.$i.'" class="page_active">'.$i.'</a>';
			if ($i != $current_page) {
				$pagination_html = '<a href="'.$target_link.'page/'.$i.'">'.$i.'</a>';	
			}
			
			$links[$i] = $pagination_html;	
		}
	}
	else {
		$links[] = '<a href="'.$target_link.'page/1" class="page_active">1</a>';
	}
	
	$pagination = '<ul class="'.$css_class.'">';
	if ($current_page < $min) {		
		$roundie = 0;
		for($j = 0; $j <= $min; $j++) {			
			
			if (!empty($links[$j])) {
				$pagination .= '<li>'.$links[$j].'</li>';
			}
			
			if ($roundie >= $min) {
				break;
			}
			else {
				$roundie++;
			}
		}
	}
	else {		
		$start_place = $current_page - (round($min / 2)); //5;
		$sp_5 = $start_place + ($min + 1); //11;
		
		$loops = count($links) - $current_page;
				
		for($j = $start_place; $j <= $sp_5; $j++) {			
			if (!empty($links[$j])) {
				$pagination .= '<li>'.$links[$j].'</li>';
			}
		}
	}
	$pagination .= '</ul>';
	
	return $pagination;
}

?>