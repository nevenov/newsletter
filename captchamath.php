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

// captcha width
$cap_width = 150;
// captcha height
$cap_height = 40;
// minimum font size;
$font_size_from = 14;
// maximum font size
$font_size_to = 18;
// rotation angle degree
$rot_angle = 20;
// grid size in bacground
$grid_size = 10;
// path to font
$font_path =  __DIR__ .  '/images/REFSAN.TTF';
// array of possible operators
$operators=array('+','-','*');
// first number random value; keep it lower than $second_num
$first_num = rand(1,5);
// second number random value
$second_num = rand(6,11);


shuffle($operators);
$expression = $second_num.$operators[0].$first_num;
/*
	operation result is stored in $session_var
*/
eval("\$session_var=".$second_num.$operators[0].$first_num.";");
/* 
	save the operation result in session to make verifications
*/
$_SESSION['key'] = $session_var;
/*
	start the captcha image
*/
$img = imagecreate( $cap_width, $cap_height );
/*
	Some colors. Text is $black, background is $white, grid is $grey
*/
$black = imagecolorallocate($img,0,0,0);
$white = imagecolorallocate($img,255,255,255);
$grey = imagecolorallocate($img,215,215,215);
$blackgrey = imagecolorallocate($img,90,90,90);
/*
	make the background white
*/
imagefill( $img, 0, 0, $white );	
/* the background grid lines - vertical lines */
for ($t = $grid_size; $t<$cap_width; $t+=$grid_size){
	imageline($img, $t, 0, $t, $cap_height, $grey);
}
/* background grid - horizontal lines */
for ($t = $grid_size; $t<$cap_height; $t+=$grid_size){
	imageline($img, 0, $t, $cap_width, $t, $grey);
}

for($i=1; $i<=rand(30, 70); $i++) {  // additional random lines
	$lines = imagecolorallocate($img, rand(180, 210),rand(180, 210),rand(160, 240));
	imageline($img,rand(1, 90),rand(1, 35),rand(10, 150),rand(1, 40),$lines);
}

/* 
	this determinates the available space for each operation element 
	it's used to position each element on the image so that they don't overlap
*/
$item_space = $cap_width/3;

/* first number */
imagettftext(
	$img,
	rand(
		$font_size_from,
		$font_size_to
	),
	rand( -$rot_angle , $rot_angle ),
	rand( 10, $item_space-20 ),
	rand( 20, $cap_height-5 ),
	$blackgrey,
	$font_path,
	$second_num);

/* operator */
imagettftext($img, rand(16,18), rand(-10,10), rand( $item_space+10, 2*$item_space-25 ), rand( 25, $cap_height-10 ), $blackgrey, $font_path, $operators[0]);

/* second number */
imagettftext(
	$img,
	rand(
		$font_size_from,
		$font_size_to
	),
	rand( -$rot_angle, $rot_angle ),
	rand( 2*$item_space, 3*$item_space-20),
	rand( 20, $cap_height-5 ),
	$blackgrey,
	$font_path,
	$first_num);
	
header("Content-type:image/jpeg");
header("Content-Disposition:inline ; filename=captchamath.jpg");
header('Cache-control: no-cache');
imagejpeg($img);
?>