<?php 
error_reporting(0);
include("configs.php");

$sql = "SELECT * FROM ".$TABLE["Options"];
$sql_result = sql_resultNL($sql);
$Options = mysqli_fetch_assoc($sql_result);
$OptionsVis = unserialize($Options['visual_form']);
$OptionsLang = unserialize(base64_decode($Options['language']));

$errorMessage = ReadHTML($OptionsLang["Error_request_validation"]);

$successMessage = ReadHTML($OptionsLang["validation_successful"]);


if($_REQUEST["a"]=="verify"){

	$sql = "SELECT * FROM ".$TABLE["Subscribers"]." 
			WHERE id = '" . SafetyDBNL($_REQUEST["i"]) . "' 
			AND email = '" . SafetyDBNL($_REQUEST["e"]) . "'";
	$sql_result = sql_resultNL($sql);
	if(mysqli_num_rows($sql_result)>0){
		$Comments = mysqli_fetch_assoc($sql_result);	
		if(md5(ReadDB($_REQUEST["i"])." - ".ReadDB($_REQUEST["e"])) == $_REQUEST["s"]){
			$sql = "UPDATE ".$TABLE["Subscribers"]." SET status = 'active' WHERE id = '".$_REQUEST["i"]."'";
			$sql_result = sql_resultNL($sql);
			$theMessage = $successMessage;	
		} else {
			$theMessage = $errorMessage;
		}
	} else {
		$theMessage = $errorMessage;
	}
} else {
	$theMessage = $errorMessage;
}	
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo $theMessage; ?></title>
<?php 
include($CONFIG["server_path"]."styles/css_front_end_form.php"); 
?>
</head>

<body>

<div class="confirm_message">
<?php echo $theMessage; ?>
</div>
</body>
</html>