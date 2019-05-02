<?php
# Script: captcha.php - open source
#############################################################
## 	for more info - info@simpleforumphp.com                ##
############################################################# 
##  Custom Web Design and Development - Simple Web Scripts ##
## 		www.simpleforumphp.com                             ##
#############################################################
##  This code is open source.      						   ##
#############################################################

session_start();
$string = strtoupper(substr(str_shuffle('acdefghijklmnpwyz2345679'), 0, 5));
$_SESSION['key'] = $string;
$image = imagecreatefromjpeg("images/box6.jpg");
for($i=1; $i<=rand(30, 70); $i++) {  // lines
	$lines = imagecolorallocate($image, rand(180, 200),rand(180, 210),rand(160, 200));
	imageline($image,rand(1, 90),rand(1, 50),rand(10, 150),rand(1, 50),$lines);
}
for ($i = 0; $i <= rand(300, 600); $i++) {  // points
	$point_color = imagecolorallocate ($image, rand(0,255), rand(0,255), rand(0,255));
	imagesetpixel($image, rand(1,135), rand(1,50), $point_color);
}
$angle = rand(-3, 3);
$x = rand(2, 50);
$y = rand(16, 33);
$color = imagecolorallocate($image, 80, 80, 80);
$font = __DIR__ .  '/images/REFSAN.TTF';
imagettftext($image, 16, $angle, $x, $y, $color, $font, $string);
header("Content-type: image/jpeg");
header('Cache-control: no-cache');
imagejpeg($image);
?> 