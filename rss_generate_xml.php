<?php
//include("configs.php");

$sql = "SELECT * FROM ".$TABLE["Options"];
$sql_result = sql_resultNL($sql);
$Options = mysqli_fetch_assoc($sql_result);

$rss = '<?xml version="1.0" encoding="utf-8"?>
';
$rss .= '<rss version="2.0" xmlns:atom="http://www.w3.org/2005/Atom">
';
$rss .= ' <channel>
';
$rss .= '  <title>News RSS</title>
';
$rss .= '  <description>Latest 10 news</description>
';

if(trim($Options["news_link"])!=''){ $LinkChannel = ReadDB($Options["news_link"]); } else { $LinkChannel = $CONFIG["full_url"]."preview.php"; }

$rss .= '  <link>'.$LinkChannel.'</link>
';
$rss .= '  <atom:link href="'.$CONFIG["full_url"].'rss.xml" rel="self" type="application/rss+xml" />
';

$sql = "SELECT * FROM ".$TABLE["News"]." WHERE status='Published' ORDER BY publish_date DESC LIMIT 0,10";
$sql_result = sql_resultNL($sql);
while ($News = mysqli_fetch_assoc($sql_result)) {
	$isPermaLink = substr(str_shuffle('abcdefghijklmnopqrstuvwxyzABCDEFG1234567890'), 0, 20);

	$rss .= '  
	<item>
	';
	$rss .= '	<guid isPermaLink="false">'.$isPermaLink.$News["id"].'</guid>
	';
	$rss .= '	<title><![CDATA['.ReadDB($News["title"]).']]></title>
	';
	$rss .= '	<link>';
	if(trim($Options["news_link"])!=''){ 
		$rss .= ReadDB($Options["news_link"]).'?id='.$News['id']; 
	} else { 
		$rss .= $CONFIG["full_url"].'preview.php?id='.$News["id"]; 
	}
	$rss .= '</link>
	';
	$rss .= '	<description><![CDATA['.ReadDB($News["summary"]).']]></description>
	';
	$rss .= '	<pubDate>'.date("D, d M Y H:i:s O",strtotime($News["publish_date"])).'</pubDate>
	';
	if($News["image"]!='') { 
	$rss .= '	<enclosure url="'.$CONFIG["full_url"].$CONFIG["upload_thumbsNL"].$News["image"].'" length="'.filesize($CONFIG["server_path"].$CONFIG["upload_thumbsNL"].$News["image"]).'" type="image/jpeg" />';
	} 
	$rss .= '  
	</item>
	';
} 
$rss .= ' 
 </channel>
';
$rss .= '</rss>';

$handle = fopen("rss.xml", "w");

fwrite($handle, $rss);

fclose($handle);