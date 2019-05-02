<?php
header("Content-type: text/xml"); 
$installed = '';
include("configs.php");

$sql = "SELECT * FROM ".$TABLE["Options"];
$sql_result = sql_resultNL($sql);
$Options = mysqli_fetch_assoc($sql_result);

echo '<?xml version="1.0" encoding="utf-8"?>';
?>
<rss version="2.0" xmlns:atom="http://www.w3.org/2005/Atom">
<channel>
	<title>News RSS</title>
	<description>Latest 10 news</description>
	<link><?php if(trim($Options["news_link"])!=''){ echo ReadDB($Options["news_link"]); } else { echo $CONFIG["full_url"]."preview.php"; } ?></link>
    <atom:link href="<?php echo $CONFIG["full_url"]; ?>rss.php" rel="self" type="application/rss+xml" />
<?php
	$sql = "SELECT * FROM ".$TABLE["News"]." WHERE status='Published' ORDER BY publish_date DESC LIMIT 0,10";
	$sql_result = sql_resultNL($sql);
	while ($News = mysqli_fetch_assoc($sql_result)) {
		$isPermaLink = substr(str_shuffle('abcdefghijklmnopqrstuvwxyzABCDEFG1234567890'), 0, 20);
?>
	<item>
		<guid isPermaLink='false'><?php echo $isPermaLink.$News["id"]; ?></guid>
		<title><![CDATA[<?php echo ReadDB($News["title"]); ?>]]></title>
        <link><?php if(trim($Options["news_link"])!=''){ echo ReadDB($Options["news_link"])."?id=".$News['id']; } else { echo $CONFIG["full_url"]."preview.php?id=".$News["id"]; } ?></link>
		<description><![CDATA[<?php echo ReadDB($News["summary"]); ?>]]></description>
        <pubDate><?php echo date("D, d M Y H:i:s O",strtotime($News["publish_date"])); ?></pubDate>
        <?php if($News["image"]!='') { ?>
        <enclosure url="<?php echo $CONFIG["full_url"].$CONFIG["upload_thumbsNL"].$News["image"]; ?>" length="<?php echo filesize($CONFIG["server_path"].$CONFIG["upload_thumbsNL"].$News["image"]); ?>" type="image/jpeg" />
        <?php } ?>
	</item>
<?php } ?>
</channel>
</rss>