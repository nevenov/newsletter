<?php 
function SaveDB($str) {
	if (!get_magic_quotes_gpc()) {	
		return addslashes($str); 
	} else {
		return $str;
	}
}
function ReadDB($str) {
	return stripslashes($str);
}
function ReadHTML($str) {
	return htmlspecialchars(stripslashes($str), ENT_QUOTES);
}

function admin_date($db_date) {
	return date("D - M j, Y",strtotime($db_date));
}

function invert_colour($start_colour) {
	if($start_colour!='') {
		$colour_red = hexdec(substr($start_colour, 1, 2));
		$colour_green = hexdec(substr($start_colour, 3, 2));
		$colour_blue = hexdec(substr($start_colour, 5, 2));
		
		$new_red = dechex(255 - $colour_red);
		$new_green = dechex(255 - $colour_green);
		$new_blue = dechex(255 - $colour_blue);
		
		if (strlen($new_red) == 1) {$new_red .= '0';}
		if (strlen($new_green) == 1) {$new_green .= '0';}
		if (strlen($new_blue) == 1) {$new_blue .= '0';}
		
		$new_colour = '#'.$new_red.$new_green.$new_blue;
	} else {
		$new_colour = '#000000';
	}
	return $new_colour;
} 

// function for resize image. If $thumbnail is not set then creates the full description image
function Resize_File($full_file, $max_width, $max_height, $thumbnail) {
	
	if (eregi("\.png$", $full_file)) {
		$img = imagecreatefrompng($full_file);
	}
	
	if (eregi("\.(jpg|jpeg)$", $full_file)) {
		$img = imagecreatefromjpeg($full_file);
	}
	
	if (eregi("\.gif$", $full_file)) {
		$img = imagecreatefromgif($full_file);
	}
	
	$FullImage_width = imagesx($img);
	$FullImage_height = imagesy($img);
	
	if (isset($max_width) && isset($max_height) && $max_width != 0 && $max_height != 0 && $FullImage_width >= $max_width && $FullImage_height >= $max_height) {
		$new_width = $max_width;
		$new_height = $max_height;
	} elseif (isset($max_width) && $max_width != 0 && $FullImage_width >= $max_width) {
		$new_width = $max_width;
		$new_height = ((int)($new_width * $FullImage_height) / $FullImage_width);
	} elseif (isset($max_height) && $max_height != 0 && $FullImage_height >= $max_height) {
		$new_height = $max_height;
		$new_width = ((int)($new_height * $FullImage_width) / $FullImage_height);
	} else {
		$new_height = $FullImage_height;
		$new_width = $FullImage_width;
	}
	
	$full_id = imagecreatetruecolor($new_width, $new_height);
	if (eregi("\.png$", $full_file) or eregi("\.gif$", $full_file)) {
		imagecolortransparent($full_id, imagecolorallocatealpha($full_id, 0, 0, 0, 0));
	}
	imagecopyresampled($full_id, $img, 0, 0, 0, 0, $new_width, $new_height, $FullImage_width, $FullImage_height);
	
	
	if (eregi("\.(jpg|jpeg)$", $full_file)) {
		if($thumbnail!="") {
			imagejpeg($full_id, $thumbnail, 99);
		} else {
			imagejpeg($full_id, $full_file, 99);
		}
	}
	
	if (eregi("\.png$", $full_file)) {		
		if($thumbnail!="") {
			imagepng($full_id, $thumbnail);
		} else {
			imagepng($full_id, $full_file);
		}
	}
	
	if (eregi("\.gif$", $full_file)) {		
		if($thumbnail!="") {
			imagegif($full_id, $thumbnail);
		} else {
			imagegif($full_id, $full_file);
		}
	}
	
	imagedestroy($full_id);
	unset($max_width);
	unset($max_height);
}

?>