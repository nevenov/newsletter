<?php 
$installed = '';
if(!isset($configs_are_set_nl)) {
	include( dirname(__FILE__). "/configs.php");
}

$sql = "SELECT * FROM ".$TABLE["Options"];
$sql_result = sql_resultNL($sql);
$Options = mysqli_fetch_assoc($sql_result);
mysqli_free_result($sql_result);
$OptionsLang = unserialize(base64_decode($Options['language']));

if (isset($_REQUEST["id"]) and $_REQUEST["id"]>0) {
	$_REQUEST["id"]= (int) SafetyDBNL($_REQUEST["id"]);
	?>
	<?php 
	$sql = "SELECT * FROM ".$TABLE["News"]." WHERE id='".SafetyDBNL($_REQUEST["id"])."' and status='Published'";
	$sql_result = sql_resultNL($sql);
	if(mysqli_num_rows($sql_result)>0) {	
	  $Meta = mysqli_fetch_assoc($sql_result);
	?>
	<title><?php echo ReadHTML($Meta["title"]); ?></title>
	<meta name="description" content="<?php echo cutText(ReadHTML(strip_tags($Meta["summary"])), 160); ?>" />
    <meta property="og:title" content="<?php echo ReadHTML($Meta["title"]); ?>" />
    <meta property="og:type" content="article" />
    <meta property="og:image" content="<?php echo $CONFIG["full_url"].$CONFIG["upload_folderNL"].ReadHTML($Meta["image"]); ?>" />
    <meta property="og:description" content="<?php echo ReadHTML(strip_tags($Meta["summary"])); ?>" />
	<?php 
	} 
} else {
?>
	<title><?php echo ReadHTML($OptionsLang["metatitle"]); ?></title>
	<meta name="description" content="<?php echo ReadHTML($OptionsLang["metadescription"]); ?>" />
<?php 
}
?>