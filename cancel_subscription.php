<?php 
error_reporting(0);
include("configs.php");

$sql = "SELECT * FROM ".$TABLE["Options"];
$sql_result = sql_resultNL($sql);
$Options = mysqli_fetch_assoc($sql_result);
$OptionsLang = unserialize(base64_decode($Options['language']));

if(trim($Options['time_zone'])!='') {
	date_default_timezone_set(trim($Options['time_zone']));
}
$cur_date = date('Y-m-d H:i:s');

$errorMessage = "Error unsubscribing newsletters! ";

$successMessage = ReadHTML($OptionsLang["unsubscribed_successfully"]);

?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Cancel Newsletter Subscription</title>
<?php 
include($CONFIG["server_path"]."styles/css_front_end_form.php"); 
?>
</head>

<body>
<div class="cancel_message">
<?php 
if($_REQUEST["a"]=="cancel_subscription"){

	$sql = "SELECT * FROM ".$TABLE["Subscribers"]." 
			WHERE id = '" . SafetyDBNL($_REQUEST["i"]) . "' 
			AND email = '" . SafetyDBNL($_REQUEST["e"]) . "'";
	$sql_result = sql_resultNL($sql);
	if(mysqli_num_rows($sql_result)>0){
		$Subscriber = mysqli_fetch_assoc($sql_result);	
		if(md5(ReadDB($_REQUEST["i"])." - ".ReadDB($_REQUEST["e"])) == $_REQUEST["s"]){
			$sql = "UPDATE ".$TABLE["Subscribers"]." 
					SET `status` = 'inactive',
						`receive_to` = '".SafetyDBNL($cur_date)."' 
					WHERE id = '".$_REQUEST["i"]."'";
			$sql_result = sql_resultNL($sql);
			echo $successMessage;	
		} else {
			echo $errorMessage."-1";
		}
	} else {
		echo $errorMessage."-2";
	}
} else {
	echo $errorMessage."-3";
}	
?>
</div>
</body>
</html>