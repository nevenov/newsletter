<?php

# Script: captchasimple.php - open source
#############################################################
## 	for more info - info@simpleforumphp.com                ##
############################################################# 
##  Custom Web Design and Development - Simple Web Scripts ##
## 		www.simpleforumphp.com                             ##
#############################################################
##  This code is open source.      						   ##
#############################################################


session_start();
$string = strtoupper(substr(str_shuffle('acdhkw234569'), 0, 5));
$_SESSION['key'] = $string;

// create image
$image = imagecreate(90, 44);

// add white background
$background = imagecolorallocate($image, 255, 255, 255);

// choose color of the string
$color = imagecolorallocate($image, 110, 110, 100);

// add random X and Y to string
$x = rand(2, 40);
$y = rand(1, 30);

for($i=1; $i<=rand(10, 30); $i++) {  // add lines to the image
	$lines = imagecolorallocate($image, rand(220, 240),rand(220, 250),rand(230, 245));
	imageline($image,rand(1, 90),rand(1, 35),rand(10, 150),rand(1, 40),$lines);
}

for ($i = 0; $i <= rand(300, 600); $i++) {  // add points to the image
	$point_color = imagecolorallocate ($image, rand(0,255), rand(0,255), rand(0,255));	
	imagesetpixel($image, rand(1,128), rand(1,38), $point_color);
}

// add the randonm string to the image
imagestring($image, 5, $x, $y, $string, $color);
header("Content-type: image/jpeg");
header('Cache-control: no-cache');

// create captcha image
imagejpeg($image);

?> 