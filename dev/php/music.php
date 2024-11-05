<?php

function music_scale_match($played_notes = array()) {
	$total_pn = count($played_notes);

	$notes = array('C', 'Cs', 'D', 'Ds', 'E', 'F', 'Fs', 'G', 'Gs', 'A', 'As', 'B', 'C', 'Cs', 'D', 'Ds', 'E', 'F', 'Fs', 'G', 'Gs', 'A', 'As', 'B');
	$notes_2 = $notes;
	
	$major_scale = array(2, 2, 1, 2, 2, 2, 1);
	$minor_scale = array(2, 1, 2, 2, 1, 2, 2);
	
	$major_chord = array(4, 7);
	$minor_chord = array(3, 7);
	
	$matching_scales = array();
	
	foreach($notes as $key => $value) {
		//Generate major scale
		$major_s = array();
		$major_s[] = $value;
		
		$loopr = $key;
		
		foreach ($major_scale as $key_2 => $value_2) {
			$loopr += $value_2;
			
			if ($loopr > 11) {
				$loopr = $value_2 - 1;			
			}
						
			$major_s[] = $notes_2[$loopr];
		}
	
		
		//Generate minor scale
		$minor_s = array();
		$minor_s[] = $value;
		
		$loopr = $key;
		
		foreach($minor_scale as $key_2 => $value_2) {
			$loopr += $value_2;
			
			if ($loopr > 11) {
				$loopr = $value_2 - 1;			
			}
						
			$minor_s[] = $notes_2[$loopr];
		}
		
		
		//
		$major_c = 0;
		$minor_c = 0;
		
		foreach($played_notes as $key_2 => $value_2) {
			if (in_array($value_2, $major_s)) {
				$major_c++;
			}
			
			if (in_array($value_2, $minor_s)) {
				$minor_c++;
			}
		}
		
		if ($major_c == $total_pn && $total_pn > 0) {
			$matching_scales[] = $value.'M';
		}
		
		if ($minor_c == $total_pn && $total_pn > 0) {
			$matching_scales[] = $value.'m';
		}
	}
	
	return $matching_scales;
}

function music_scale_similar($played_notes = array()) {
	$total_pn = count($played_notes);

	$notes = array('C', 'Cs', 'D', 'Ds', 'E', 'F', 'Fs', 'G', 'Gs', 'A', 'As', 'B', 'C', 'Cs', 'D', 'Ds', 'E', 'F', 'Fs', 'G', 'Gs', 'A', 'As', 'B');
	$notes_2 = $notes;
	
	$major_scale = array(2, 2, 1, 2, 2, 2, 1);
	$minor_scale = array(2, 1, 2, 2, 1, 2, 2);
	
	$major_chord = array(4, 7);
	$minor_chord = array(3, 7);
	
	$matching_scales = array();
	
	foreach($notes as $key => $value) {
		//Generate major scale
		$major_s = array();
		$major_s[] = $value;
		
		$loopr = $key;
		
		foreach ($major_scale as $key_2 => $value_2) {
			$loopr += $value_2;
			
			if ($loopr > 11) {
				$loopr = $value_2 - 1;			
			}
						
			$major_s[] = $notes_2[$loopr];
		}
	
		
		//Generate minor scale
		$minor_s = array();
		$minor_s[] = $value;
		
		$loopr = $key;
		
		foreach($minor_scale as $key_2 => $value_2) {
			$loopr += $value_2;
			
			if ($loopr > 11) {
				$loopr = $value_2 - 1;			
			}
						
			$minor_s[] = $notes_2[$loopr];
		}
		
		
		//
		$major_sim = array_intersect($major_s, $played_notes);
		$matching_scales[$value.'M'] = $major_sim;
			
		$minor_sim = array_intersect($minor_s, $played_notes);
		$matching_scales[$value.'m'] = $minor_sim;
	}

	uasort($matching_scales, 'scale_similar_sort');
	return $matching_scales;
}

function music_scale_notes($note_build, $scale_type = 'major') {
	$notes = array('C', 'Cs', 'D', 'Ds', 'E', 'F', 'Fs', 'G', 'Gs', 'A', 'As', 'B', 'C', 'Cs', 'D', 'Ds', 'E', 'F', 'Fs', 'G', 'Gs', 'A', 'As', 'B');
	$note_key = array_search($note_build, $notes);
	
	$major = array(2, 2, 1, 2, 2, 2, 1);
	$minor = array(2, 1, 2, 2, 1, 2, 2);
	
	$scale = array();
	$scale[] = $notes[$note_key];
	
	$loopr = $note_key;
	
	foreach ($$scale_type as $key => $value) {
		$loopr += $value;
		
		if ($loopr > 11) {
			$loopr = $value - 1;			
		}
					
		$scale[] = $notes[$loopr];
	}
		
	return $scale;
}

function music_chord_notes($note_build, $chord_type = 'major') {
	$notes = array('C', 'Cs', 'D', 'Ds', 'E', 'F', 'Fs', 'G', 'Gs', 'A', 'As', 'B', 'C', 'Cs', 'D', 'Ds', 'E', 'F', 'Fs', 'G', 'Gs', 'A', 'As', 'B');
	$note_key = array_search($note_build, $notes);
	
	$major = array(4, 7);
	$minor = array(3, 7);
	$power = array(7);
	
	$chord = array();
	$chord[] = $notes[$note_key];
	
	$loopr = $note_key;
	
	if (!empty($$chord_type)) {
		foreach ($$chord_type as $key => $value) {
			$new_key = $loopr + $value;
			
			if ($loopr > 11) {
				$loopr = $value - 1;			
			}
						
			$chord[] = $notes[$new_key];
		}
	}
		
	return $chord;
}

function midi_music_chords($note_build = 'C', $transpose = 4, $chord_type = 'major') {
	$notes = array('C', 'Cs', 'D', 'Ds', 'E', 'F', 'Fs', 'G', 'Gs', 'A', 'As', 'B');
	
	$midi = array();
	$midi_notes = array();
	
	$midi_note_numbers = 24;
	
	for ($i = 1; $i <= 7; $i++) {
		foreach ($notes as $key => $value) {
			$midi[$midi_note_numbers]['note'] = $value;
			$midi[$midi_note_numbers]['trans'] = $i;
			$midi[$midi_note_numbers]['combo'] = $value.$i;
			$midi[$midi_note_numbers]['midi_num'] = $midi_note_numbers;
			
			$midi_notes[$midi_note_numbers] = $value.$i;
			
			$midi_note_numbers++;
		}
	}
	
	$note_built = $note_build.$transpose;
	$note_key = array_search($note_built, $midi_notes);

	$major = array(4, 7);
	$minor = array(3, 7);
	$power = array(7);
	
	$chord = array();
	$chord[] = $midi[$note_key];
	
	$loopr = $note_key;
	
	foreach ($$chord_type as $key => $value) {
		$new_key = $loopr + $value;		
		$chord[] = $midi[$new_key];
	}
		
	return $chord;
}

?>