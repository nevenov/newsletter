<?php 
$installed = '';
session_start();
include("configs.php");
include("language_admin.php");

$message = "";
$logMessage = "";
if(!isset($_REQUEST["p"])) $_REQUEST["p"] = ''; 

if(isset($_REQUEST["act"])) {
  if ($_REQUEST["act"]=='logout') {
	
	$_SESSION["SPSNLeTeRsLoGin"] = "";
	unset($_SESSION["SPSNLeTeRsLoGin"]);
	
	//setcookie("SPSNLeTeRsLoGin", "", 0);
	//$_COOKIE["SPSNLeTeRsLoGin"] = "";	

	unset($_SESSION["KCFINDER"]);		
			
 } elseif ($_REQUEST["act"]=='login') {
	
	if ($_REQUEST["user"] == $CONFIG["admin_user"] and $_REQUEST["pass"] == $CONFIG["admin_pass"]) {
		$_SESSION["SPSNLeTeRsLoGin"] = "ALoggedIn";
		
		//setcookie("SPSNLeTeRsLoGin", "ALoggedIn", time()+8*3600);
		//$_COOKIE["SPSNLeTeRsLoGin"] = "ALoggedIn";		
		
 		$_REQUEST["act"]='news';		
  	} else {
		$logMessage = $lang['Message_Incorrect_login_details'];
  	}
  }
}
?><!DOCTYPE HTML>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width">
<title><?php echo $lang['Script_Administration_Header']; ?></title>

<script language="javascript" src="include/jquery-1.11.2.min.js"></script>
<script type="text/javascript" src="accordion/javascript/prototype.js"></script>
<script type="text/javascript" src="accordion/javascript/effects.js"></script>
<script type="text/javascript" src="accordion/javascript/accordion.js"></script>
<script language="javascript" src="include/functions.js"></script>
<script language="javascript" src="include/color_pick.js"></script>
<script language="javascript" src="include/jscolor.js"></script>
<script type="text/javascript" src="include/datetimepicker_css.js"></script>
<script type="text/javascript" src="ckeditor/ckeditor.js"></script>
<link href="styles/admin.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="<?php echo $CONFIG["full_url"]; ?>include/textsizer.js">
/***********************************************
* Document Text Sizer- Copyright 2003 - Taewook Kang.  All rights reserved.
* Coded by: Taewook Kang (http://www.txkang.com)
***********************************************/
</script>
<script>
    CKEDITOR.env.isCompatible = true;
</script>
</head>

<body>

<div class="logo">
	<div class="script_name"><?php echo $lang['Script_Administration_Header']; ?></div>
	<div class="logout_button"><a href="admin.php?act=logout"><img src="images/logout1.png" width="32" alt="Logout" border="0" /></a></div>
    <div class="clear"></div>
</div>

<div style="clear:both"></div>

<?php  
$Logged = false;
//if(isset($_COOKIE["SPSNLeTeRsLoGin"]) and ($_COOKIE["SPSNLeTeRsLoGin"]=="ALoggedIn")) {
if(isset($_SESSION["SPSNLeTeRsLoGin"]) and ($_SESSION["SPSNLeTeRsLoGin"]=="ALoggedIn")) {
	$Logged = true;
	$ThisIsAdmin = true;
}

if ( $Logged ){
	
function lang_date($subject) {	
	$search  = array('January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday');
	
	$replace = array(
					ReadDB($GLOBALS['OptionsLang']['January']), 
					ReadDB($GLOBALS['OptionsLang']['February']), 
					ReadDB($GLOBALS['OptionsLang']['March']), 
					ReadDB($GLOBALS['OptionsLang']['April']), 
					ReadDB($GLOBALS['OptionsLang']['May']), 
					ReadDB($GLOBALS['OptionsLang']['June']), 
					ReadDB($GLOBALS['OptionsLang']['July']), 
					ReadDB($GLOBALS['OptionsLang']['August']), 
					ReadDB($GLOBALS['OptionsLang']['September']), 
					ReadDB($GLOBALS['OptionsLang']['October']), 
					ReadDB($GLOBALS['OptionsLang']['November']), 
					ReadDB($GLOBALS['OptionsLang']['December']), 
					ReadDB($GLOBALS['OptionsLang']['Monday']), 
					ReadDB($GLOBALS['OptionsLang']['Tuesday']), 
					ReadDB($GLOBALS['OptionsLang']['Wednesday']), 
					ReadDB($GLOBALS['OptionsLang']['Thursday']), 
					ReadDB($GLOBALS['OptionsLang']['Friday']), 
					ReadDB($GLOBALS['OptionsLang']['Saturday']), 
					ReadDB($GLOBALS['OptionsLang']['Sunday'])
					);

	$lang_date = str_replace($search, $replace, $subject);
	return $lang_date;
}

if (isset($_REQUEST["act"]) and $_REQUEST["act"]=='updateOptionsNewsletters') {

	if (!isset($_REQUEST["unsubscr_link"]) or $_REQUEST["unsubscr_link"]=='') $_REQUEST["unsubscr_link"] = 'yes';
	if (!isset($_REQUEST["collect_name"]) or $_REQUEST["collect_name"]=='') $_REQUEST["collect_name"] = 'yes';
	if (!isset($_REQUEST["verify_email"]) or $_REQUEST["verify_email"]=='') $_REQUEST["verify_email"] = 'yes';
	
	if(!empty($_REQUEST["nl_form"])) {
		$nl_form = serialize($_REQUEST["nl_form"]);
	} else {
		$nl_form = "";
	}
	
	$sql = "UPDATE ".$TABLE["Options"]." 
			SET `admin_email`	='".SaveDB($_REQUEST["admin_email"])."',
				`captcha`		='".SaveDB($_REQUEST["captcha"])."',
				`unsubscr_link`	='".SaveDB($_REQUEST["unsubscr_link"])."',
				`email_notice`	='".SaveDB($_REQUEST["email_notice"])."',
				`collect_name`	='".SaveDB($_REQUEST["collect_name"])."',
				`nl_form`		='".SafetyDBNL($nl_form)."',
				`verify_email`	='".SaveDB($_REQUEST["verify_email"])."',
				`form_arrange`	='".SaveDB($_REQUEST["form_arrange"])."',
				`smtp_auth`		='".SaveDB($_REQUEST["smtp_auth"])."',
				`smtp_server`	='".SaveDB($_REQUEST["smtp_server"])."',
				`smtp_port`		='".SaveDB($_REQUEST["smtp_port"])."',
				`smtp_email`	='".SaveDB($_REQUEST["smtp_email"])."',
				`smtp_pass`		='".SaveDB($_REQUEST["smtp_pass"])."',
				`smtp_secure`	='".SaveDB($_REQUEST["smtp_secure"])."'";
	$sql_result = sql_resultNL($sql);
	$_REQUEST["act"]='newsletters_options'; 
  	$message = $lang['Message_Newsletters_options_saved'];

} elseif (isset($_REQUEST["act"]) and $_REQUEST["act"]=='updateOptionsNews') {
	
	$sql = "UPDATE ".$TABLE["Options"]." 
			SET `per_page`		='".SaveDB($_REQUEST["per_page"])."',
				`news_link`		='".SaveDB($_REQUEST["news_link"])."',
				`showcategdd`	='".SaveDB($_REQUEST["showcategdd"])."',
				`publishon`		='".SaveDB($_REQUEST["publishon"])."',
				`time_zone`		='".SaveDB($_REQUEST["time_zone"])."'";
	$sql_result = sql_resultNL($sql);
	$_REQUEST["act"]='news_options'; 
  	$message = $lang['Message_News_options_saved'];


} elseif (isset($_REQUEST["act"]) and $_REQUEST["act"]=='updateOptionsVisualNewsletters') {
	
	// subscribe newsletter heading
	$visual['head_form_font_family']= $_REQUEST['head_form_font_family']; 
	$visual['head_form_font_color'] = $_REQUEST['head_form_font_color']; 
	$visual['head_form_font_size'] 	= $_REQUEST['head_form_font_size']; 
	$visual['head_form_font_weight']= $_REQUEST['head_form_font_weight']; 
	$visual['head_form_font_style'] = $_REQUEST['head_form_font_style']; 	
	$visual['head_form_dist'] 		= $_REQUEST['head_form_dist']; 	
	
	// subscribe newsletter form
	$visual['form_font_family'] = $_REQUEST['form_font_family']; 
	$visual['form_font_size'] 	= $_REQUEST['form_font_size']; 
	$visual['form_font_color'] 	= $_REQUEST['form_font_color']; 
	$visual['butt_bgr_color'] 	= $_REQUEST['butt_bgr_color']; 
	$visual['form_width'] 		= $_REQUEST['form_width'];
	$visual['form_width_dim'] 	= $_REQUEST['form_width_dim'];	
	
	// title in the newsletter
	$visual['nl_tit_color'] 	 	= $_REQUEST['nl_tit_color']; 
	$visual['nl_tit_font'] 		 	= $_REQUEST['nl_tit_font']; 
	$visual['nl_tit_size']		 	= $_REQUEST['nl_tit_size']; 
	$visual['nl_tit_font_weight']	= $_REQUEST['nl_tit_font_weight']; 
	$visual['nl_tit_font_style'] 	= $_REQUEST['nl_tit_font_style']; 
	$visual['nl_tit_line_height'] 	= $_REQUEST['nl_tit_line_height']; 
	
	// content in the newsletter
	$visual['nl_cont_color'] 		= $_REQUEST['nl_cont_color']; 
	$visual['nl_cont_font'] 		= $_REQUEST['nl_cont_font']; 
	$visual['nl_cont_size'] 		= $_REQUEST['nl_cont_size']; 
	$visual['nl_cont_font_style'] 	= $_REQUEST['nl_cont_font_style']; 
	$visual['nl_cont_line_height'] 	= $_REQUEST['nl_cont_line_height'];  
	$visual['nl_cont_text_align'] 	= $_REQUEST['nl_cont_text_align'];  
	$visual['newsletter_width'] 	= $_REQUEST['newsletter_width'];
	$visual['image_max_width'] 		= $_REQUEST['image_max_width'];
	
	
	// Popup subscription form
	$visual['popup_bgr_trans'] 	= $_REQUEST['popup_bgr_trans'];
	$visual['popup_width'] 		= $_REQUEST['popup_width'];
	$visual['popup_width_dim'] 	= $_REQUEST['popup_width_dim'];	
	$visual['popup_height'] 	= $_REQUEST['popup_height'];
	$visual['popup_height_dim'] = $_REQUEST['popup_height_dim'];	
	$visual['popup_seconds'] 	= $_REQUEST['popup_seconds'];	
	$visual['popup_showing'] 	= $_REQUEST['popup_showing'];	
	$visual['popup_close_sec'] 	= $_REQUEST['popup_close_sec'];
	
	$visual = serialize($visual);
	
	$sql = "UPDATE ".$TABLE["Options"]." 
			SET `visual_form`='".SafetyDBNL($visual)."'";
	$sql_result = sql_resultNL($sql);
	
	$_REQUEST["act"]='visual_options_newsletters'; 	
	$message = $lang['Message_Visual_options_subscription_form_saved'];
	
	
} elseif (isset($_REQUEST["act"]) and $_REQUEST["act"]=='updateOptionsVisual') {
	
	$visual['gen_font_family'] 	= $_REQUEST['gen_font_family']; 
	$visual['gen_font_size'] 	= $_REQUEST['gen_font_size']; 
	$visual['gen_font_color']	= $_REQUEST['gen_font_color'];
	$visual['gen_bgr_color'] 	= $_REQUEST['gen_bgr_color'];
	$visual['gen_line_height'] 	= $_REQUEST['gen_line_height'];
	$visual['gen_width'] 		= $_REQUEST['gen_width'];
	$visual['gen_width_dim'] 	= $_REQUEST['gen_width_dim'];
		
	// Category drop-down style 
	$visual['cat_menu_color'] 		= $_REQUEST['cat_menu_color']; 
	$visual['cat_menu_bgr'] 		= $_REQUEST['cat_menu_bgr']; 	 
	$visual['cat_menu_color_sel'] 	= $_REQUEST['cat_menu_color_sel']; 
	$visual['cat_menu_bgr_sel'] 	= $_REQUEST['cat_menu_bgr_sel']; 
	$visual['cat_menu_family'] 		= $_REQUEST['cat_menu_family']; 	
	$visual['cat_menu_size']		= $_REQUEST['cat_menu_size']; 
	$visual['cat_menu_weight'] 		= $_REQUEST['cat_menu_weight'];
	
	// "back" button style
	$visual['link_color'] 					= $_REQUEST['link_color']; 
	$visual['link_color_hover'] 			= $_REQUEST['link_color_hover']; 
	$visual['link_font'] 					= $_REQUEST['link_font']; 
	$visual['link_font_size'] 				= $_REQUEST['link_font_size']; 
	$visual['link_font_weight'] 			= $_REQUEST['link_font_weight']; 
	$visual['link_align'] 					= $_REQUEST['link_align'];
	$visual['link_text_decoration'] 		= $_REQUEST['link_text_decoration'];
	$visual['link_text_decoration_hover'] 	= $_REQUEST['link_text_decoration_hover'];
	
	
	$visual['summ_show_image'] 	= $_REQUEST['summ_show_image'];
	$visual['summ_image_ratio'] = $_REQUEST['summ_image_ratio']; 
	
	// title in the news grid
	$visual['summ_title_color'] 	 	= $_REQUEST['summ_title_color']; 
	$visual['summ_title_color_hover'] 	= $_REQUEST['summ_title_color_hover']; 
	$visual['summ_title_font'] 		 	= $_REQUEST['summ_title_font']; 
	$visual['summ_title_size']		 	= $_REQUEST['summ_title_size']; 
	$visual['summ_title_font_weight']	= $_REQUEST['summ_title_font_weight']; 
	$visual['summ_title_font_style'] 	= $_REQUEST['summ_title_font_style']; 
	$visual['summ_title_text_align'] 	= $_REQUEST['summ_title_text_align']; 
	$visual['summ_title_line_height'] 	= $_REQUEST['summ_title_line_height']; 
	$visual['summ_title_decor'] 		= $_REQUEST['summ_title_decor']; 
	$visual['summ_title_decor_hover'] 	= $_REQUEST['summ_title_decor_hover']; 
	
	// title in the news content
	$visual['title_color'] 			= $_REQUEST['title_color']; 
	$visual['title_font'] 			= $_REQUEST['title_font']; 
	$visual['title_size'] 			= $_REQUEST['title_size']; 
	$visual['title_font_weight']	= $_REQUEST['title_font_weight']; 
	$visual['title_font_style'] 	= $_REQUEST['title_font_style']; 
	$visual['title_text_align'] 	= $_REQUEST['title_text_align']; 
	$visual['title_line_height'] 	= $_REQUEST['title_line_height']; 
		
	// visual options for the news short description in the grid 
	$visual['summ_color'] 		= $_REQUEST['summ_color']; 
	$visual['summ_font'] 		= $_REQUEST['summ_font']; 
	$visual['summ_size'] 		= $_REQUEST['summ_size']; 
	$visual['summ_font_style'] 	= $_REQUEST['summ_font_style']; 
	$visual['summ_text_align'] 	= $_REQUEST['summ_text_align']; 
	$visual['summ_line_height'] = $_REQUEST['summ_line_height']; 
	
	// news content date style
	$visual['show_cat'] 		= $_REQUEST['show_cat'];
	$visual['cat_font'] 		= $_REQUEST['cat_font']; 
	$visual['cat_color'] 		= $_REQUEST['cat_color']; 
	$visual['cat_size'] 		= $_REQUEST['cat_size']; 
	$visual['cat_font_weight'] 	= $_REQUEST['cat_font_weight']; 
	$visual['cat_font_style'] 	= $_REQUEST['cat_font_style'];	
	$visual['show_date'] 		= $_REQUEST['show_date'];
	$visual['date_color'] 		= $_REQUEST['date_color']; 
	$visual['date_font'] 		= $_REQUEST['date_font']; 
	$visual['date_size'] 		= $_REQUEST['date_size']; 
	$visual['date_font_style'] 	= $_REQUEST['date_font_style']; 
	$visual['date_format'] 		= $_REQUEST['date_format']; 
	$visual['showing_time'] 	= $_REQUEST['showing_time'];
	$visual['show_aa'] 			= $_REQUEST['show_aa'];  
	$visual['showhits'] 		= $_REQUEST['showhits']; 
		
	// visual options for the news content 
	$visual['cont_color'] 		= $_REQUEST['cont_color']; 
	$visual['cont_font'] 		= $_REQUEST['cont_font']; 
	$visual['cont_size'] 		= $_REQUEST['cont_size']; 
	$visual['cont_font_style'] 	= $_REQUEST['cont_font_style']; 
	$visual['cont_text_align'] 	= $_REQUEST['cont_text_align']; 
	$visual['cont_line_height'] = $_REQUEST['cont_line_height'];
	$visual['viewer_width']		= $_REQUEST['viewer_width']; 
	
	// caption underneath the image style
	$visual['capt_color'] 		= $_REQUEST['capt_color']; 
	$visual['capt_bgr_color'] 	= $_REQUEST['capt_bgr_color']; 
	$visual['capt_font'] 		= $_REQUEST['capt_font']; 
	$visual['capt_size'] 		= $_REQUEST['capt_size']; 
	$visual['capt_font_weight'] = $_REQUEST['capt_font_weight']; 
	$visual['capt_font_style'] 	= $_REQUEST['capt_font_style']; 
	$visual['capt_text_align'] 	= $_REQUEST['capt_text_align']; 
	
	// links in the news text area
	$visual['links_font_color'] 			= $_REQUEST['links_font_color']; 
	$visual['links_font_color_hover']		= $_REQUEST['links_font_color_hover'];
	$visual['links_text_decoration'] 		= $_REQUEST['links_text_decoration'];
	$visual['links_text_decoration_hover'] 	= $_REQUEST['links_text_decoration_hover'];
	$visual['links_font_size'] 				= $_REQUEST['links_font_size'];
	$visual['links_font_style'] 			= $_REQUEST['links_font_style'];
	$visual['links_font_weight'] 			= $_REQUEST['links_font_weight'];
	
	/////////// pagination style ///////////
	$visual['pag_font_color'] 		= $_REQUEST['pag_font_color'];
	$visual['pag_bgr_color'] 		= $_REQUEST['pag_bgr_color'];
	$visual['pag_font_color_hover'] = $_REQUEST['pag_font_color_hover'];
	$visual['pag_bgr_color_hover'] 	= $_REQUEST['pag_bgr_color_hover'];
	$visual['pag_font_color_sel'] 	= $_REQUEST['pag_font_color_sel'];
	$visual['pag_bgr_color_sel'] 	= $_REQUEST['pag_bgr_color_sel'];
	$visual['pag_font_family'] 		= $_REQUEST['pag_font_family']; 
	$visual['pag_font_size'] 		= $_REQUEST['pag_font_size']; 
	$visual['pag_font_weight'] 		= $_REQUEST['pag_font_weight']; 	 
	$visual['pag_font_style'] 		= $_REQUEST['pag_font_style'];
	$visual['pag_align_to'] 		= $_REQUEST['pag_align_to'];
	
	
	// Back to top style
	$visual['show_scrolltop'] 			= $_REQUEST['show_scrolltop']; 
	$visual['scrolltop_width'] 			= $_REQUEST['scrolltop_width']; 
	$visual['scrolltop_height'] 		= $_REQUEST['scrolltop_height']; 	 
	$visual['scrolltop_bgr_color'] 		= $_REQUEST['scrolltop_bgr_color'];
	$visual['scrolltop_bgr_color_hover']= $_REQUEST['scrolltop_bgr_color_hover']; 
	$visual['scrolltop_opacity'] 		= $_REQUEST['scrolltop_opacity']; 
	$visual['scrolltop_opacity_hover'] 	= $_REQUEST['scrolltop_opacity_hover']; 
	$visual['scrolltop_radius'] 		= $_REQUEST['scrolltop_radius']; 
	
	
	$visual['show_share_this']  	= $_REQUEST['show_share_this'];
	$visual['show_share_this_top'] 	= $_REQUEST['show_share_this_top']; 
	
	$visual['dist_menu_title']		= $_REQUEST['dist_menu_title'];
	$visual['dist_btw_news'] 		= $_REQUEST['dist_btw_news'];	
	$visual['back_link_dist'] 		= $_REQUEST['back_link_dist'];
	$visual['dist_title_date'] 		= $_REQUEST['dist_title_date'];
	$visual['dist_date_text'] 		= $_REQUEST['dist_date_text'];
		
	$visual = serialize($visual);
	
	$sql = "UPDATE ".$TABLE["Options"]." 
			SET `visual`='".SafetyDBNL($visual)."'";
	$sql_result = sql_resultNL($sql);
	$_REQUEST["act"]='visual_options'; 
  	$message = $lang['Message_Visual_options_saved']; 

} elseif (isset($_REQUEST["act"]) and $_REQUEST["act"]=='updateOptionsLanguage') {
	
	
	// Subscribe Newsletter Form
	$language['Subscr_our_newsl'] 	= $_REQUEST['Subscr_our_newsl'];
	$language['Form_Email'] 		= $_REQUEST['Form_Email'];
	$language['Form_Name'] 			= $_REQUEST['Form_Name'];
	$language['Form_Address'] 		= $_REQUEST['Form_Address'];
	$language['Form_Zip_code'] 		= $_REQUEST['Form_Zip_code'];
	$language['Form_Captcha']		= $_REQUEST['Form_Captcha'];
	$language['Button_Subscribe'] 	= $_REQUEST['Button_Subscribe'];
	$language['Data_Protection'] 	= $_REQUEST['Data_Protection'];
	$language['Terms_Condit'] 		= $_REQUEST['Terms_Condit'];
	
	
	// Popup Subscribe Form
	$language['popup_heading'] 	= $_REQUEST['popup_heading'];
	$language['popup_descr'] 	= $_REQUEST['popup_descr'];
	
	// Newsletters Email
	$language['Email_Subject'] 					= $_REQUEST['Email_Subject'];
	$language['Unsubscribe_from_newsletters'] 	= $_REQUEST['Unsubscribe_from_newsletters'];
	$language['here'] 							= $_REQUEST['here'];
	$language['Greetings'] 						= $_REQUEST['Greetings'];
	$language['Newsletter_footer'] 				= $_REQUEST['Newsletter_footer'];	
	
	// System messages in the form
	$language['Incorrect_verification_code']= $_REQUEST['Incorrect_verification_code'];
	$language['email_already_registered']	= $_REQUEST['email_already_registered'];
	$language['resubscribed_successfully']	= $_REQUEST['resubscribed_successfully'];
	$language['fill_form']					= $_REQUEST['fill_form'];
	$language['enter_name']					= $_REQUEST['enter_name'];
	$language['enter_email_address']		= $_REQUEST['enter_email_address'];
	$language['correct_email_address']		= $_REQUEST['correct_email_address'];
	$language['enter_address']				= $_REQUEST['enter_address'];
	$language['enter_zip']					= $_REQUEST['enter_zip'];
	$language['field_code']					= $_REQUEST['field_code'];
	$language['subscribed_successfully']	= $_REQUEST['subscribed_successfully'];
	$language['check_email_verification']	= $_REQUEST['check_email_verification'];
	
	// Successful subscription email
	$language['click_to_confirm_link']	= $_REQUEST['click_to_confirm_link'];
	$language['Successful_Subject']		= $_REQUEST['Successful_Subject'];
	$language['Successful_body']		= $_REQUEST['Successful_body'];
	
	// Email notice to admin when new subscription submitted
	$language['Notice_Subject']	= $_REQUEST['Notice_Subject'];
	$language['Notice_body']	= $_REQUEST['Notice_body'];
	
	// Unsubscribed message
	$language['unsubscribed_successfully']= $_REQUEST['unsubscribed_successfully'];
	
	// Validation of subscription messages
	$language['Error_request_validation']	= $_REQUEST['Error_request_validation'];
	$language['validation_successful']		= $_REQUEST['validation_successful'];
	
	
	$language['Back_to_home'] 		= $_REQUEST['Back_to_home']; 
	$language['Category_all'] 		= $_REQUEST['Category_all']; 
	$language['Previous'] 			= $_REQUEST['Previous']; 
	$language['Next'] 				= $_REQUEST['Next'];  
	$language['No_news_published'] 	= $_REQUEST['No_news_published']; 
	$language['Article_Hits'] 		= $_REQUEST['Article_Hits'];
	
	// days of the week in the dates
	$language['Monday'] 	= $_REQUEST['Monday']; 
	$language['Tuesday'] 	= $_REQUEST['Tuesday'];
	$language['Wednesday'] 	= $_REQUEST['Wednesday'];
	$language['Thursday'] 	= $_REQUEST['Thursday']; 
	$language['Friday'] 	= $_REQUEST['Friday']; 
	$language['Saturday'] 	= $_REQUEST['Saturday'];
	$language['Sunday'] 	= $_REQUEST['Sunday'];
	
	// month names in the dates
	$language['January'] 	= $_REQUEST['January']; 
	$language['February'] 	= $_REQUEST['February'];
	$language['March'] 		= $_REQUEST['March'];
	$language['April'] 		= $_REQUEST['April']; 
	$language['May'] 		= $_REQUEST['May']; 
	$language['June'] 		= $_REQUEST['June'];
	$language['July'] 		= $_REQUEST['July'];
	$language['August'] 	= $_REQUEST['August'];
	$language['September'] 	= $_REQUEST['September']; 
	$language['October'] 	= $_REQUEST['October']; 
	$language['November'] 	= $_REQUEST['November'];
	$language['December'] 	= $_REQUEST['December'];
	
	$language['metatitle'] 			= $_REQUEST['metatitle']; 
	$language['metadescription'] 	= $_REQUEST['metadescription'];
	
	
	$language = base64_encode(serialize($language));
	
	$sql = "UPDATE ".$TABLE["Options"]." 
			SET `language`='".SafetyDBNL($language)."'";
	$sql_result = sql_resultNL($sql);
	$_REQUEST["act"]='language_options'; 
  	$message = $lang['Message_Language_options_saved']; 
 

} elseif (isset($_REQUEST["act"]) and $_REQUEST["act"] == "addNews"){
	
	$sql = "SELECT * FROM ".$TABLE["Options"];
	$sql_result = sql_resultNL($sql);
	$Options = mysqli_fetch_assoc($sql_result);
	$OptionsVis = unserialize($Options['visual']);
	
	$sql = "INSERT INTO ".$TABLE["News"]." 
			SET `publish_date` 	= '".SafetyDBNL($_REQUEST["publish_date"])."',
				`status` 		= '".SafetyDBNL($_REQUEST["status"])."',	
				`cat_id` 		= '".SafetyDBNL($_REQUEST["cat_id"])."',
				`title` 		= '".SaveDB($_REQUEST["title"])."',
				`summary` 		= '".SaveDB($_REQUEST["summary"])."',
				`content` 		= '".SaveDB($_REQUEST["content"])."',
				`caption` 		= '".SaveDB($_REQUEST["caption"])."',
				`imgpos` 		= '".SafetyDBNL($_REQUEST["imgpos"])."', 
				`reviews` 		= '0'";
	$sql_result = sql_resultNL($sql);	
	
	$index_id = mysqli_insert_id($connNL);
	
	// upload photo to the news article
	if (is_uploaded_file($_FILES["image"]['tmp_name'])) {
		
		$filexpl = explode(".", $_FILES["image"]['name']);
		$format = end($filexpl);					
		$formats = array("jpg","jpeg","JPG","png","PNG","gif","GIF");			
		if(in_array($format, $formats) and getimagesize($_FILES['image']['tmp_name'])) {

			$name = str_file_filter($_FILES['image']['name']);
			$name = $index_id . "_" . $name;

			$filePath = $CONFIG["upload_folderNL"] . $name;
			$thumbPath = $CONFIG["upload_thumbsNL"] . $name;
			
			if (move_uploaded_file($_FILES["image"]['tmp_name'], $filePath)) {
				chmod($filePath, 0777);
				Resize_File($filePath, $OptionsVis["viewer_width"], 0); 
				Resize_File($filePath, 400, 0, $thumbPath);
	
				$sql = "UPDATE ".$TABLE["News"]."  
						SET image = '".$name."'  
						WHERE id='".$index_id."'";
				$sql_result = sql_resultNL($sql);
				$message .= '';
			} else {
				$message = 'Cannot copy uploaded file to "'.$filePath.'". Try to set the right permissions (CHMOD 777) to "'.$CONFIG["upload_folderNL"].'" directory! ';  
			}
		} else {
			$message = $lang['Message_File_must_be_in_image_format'];   
		}
	} else { $message = $lang['Message_Image_file_is_not_uploaded']; }
		
	include('rss_generate_xml.php');	
	
	$_REQUEST["act"] = "news";		
	$message .= $lang['Message_News_created'];
	

} elseif (isset($_REQUEST["act"]) and $_REQUEST["act"]=='updateNews') {
	
	$sql = "SELECT * FROM ".$TABLE["Options"];
	$sql_result = sql_resultNL($sql);
	$Options = mysqli_fetch_assoc($sql_result);
	$OptionsVis = unserialize($Options['visual']);

	$sql = "UPDATE ".$TABLE["News"]." 
			SET `publish_date` 	= '".SafetyDBNL($_REQUEST["publish_date"])."',
				`status` 		= '".SafetyDBNL($_REQUEST["status"])."',	
				`cat_id` 		= '".SafetyDBNL($_REQUEST["cat_id"])."',
                `title` 		= '".SaveDB($_REQUEST["title"])."',
				`summary` 		= '".SaveDB($_REQUEST["summary"])."',
				`content` 		= '".SaveDB($_REQUEST["content"])."',
				`caption` 		= '".SaveDB($_REQUEST["caption"])."',
				`imgpos` 		= '".SafetyDBNL($_REQUEST["imgpos"])."' 
			WHERE id='".SafetyDBNL($_REQUEST["id"])."'";
	$sql_result = sql_resultNL($sql);
	
	$sql = "SELECT * FROM ".$TABLE["News"]." WHERE id = '".SafetyDBNL($_REQUEST["id"])."'";
	$sql_result = sql_resultNL($sql);
	$imageArr = mysqli_fetch_assoc($sql_result);
	$image = ReadDB($imageArr["image"]);
	
	$index_id = SafetyDBNL($_REQUEST["id"]);
	
	// upload photo to the news article	
	if (is_uploaded_file($_FILES["image"]['tmp_name'])) { 
	
		$filexpl = explode(".", $_FILES["image"]['name']);
	  	$format = end($filexpl);			
	  	$formats = array("jpg","jpeg","JPG","png","PNG","gif","GIF");
	  	if(in_array($format, $formats) and getimagesize($_FILES['image']['tmp_name'])) {
		
			if($image != "") unlink($CONFIG["upload_folderNL"].$image);
			if($image != "") unlink($CONFIG["upload_thumbsNL"].$image);
			
			$name = str_file_filter($_FILES['image']['name']);
			$name = $index_id . "_" . $name;
			
			$filePath = $CONFIG["upload_folderNL"] . $name;
			$thumbPath = $CONFIG["upload_thumbsNL"] . $name;
			
			if (move_uploaded_file($_FILES["image"]['tmp_name'], $filePath)) {
				chmod($filePath,0777); 				
				Resize_File($filePath, $OptionsVis["viewer_width"], 0); 
				Resize_File($filePath, 400, 0, $thumbPath);
				
				$sql = "UPDATE `".$TABLE["News"]."` 
						SET `image` = '".SafetyDBNL($name)."' 
						WHERE id = '".$index_id."'";
				$sql_result = sql_resultNL($sql);
			} else {
				$message = 'Cannot copy uploaded file to "'.$filePath.'". Try to set the right permissions (CHMOD 777) to "'.$CONFIG["upload_folderNL"].'" directory.';  
			}
		} else {
			$message = $lang['Message_File_must_be_in_image_format'];   
		}
	}
	
	include('rss_generate_xml.php');
	
	if(isset($_REQUEST["updatepreview"]) and $_REQUEST["updatepreview"]!='') {
		$_REQUEST["act"]='viewNews'; 		
	} else {
		$_REQUEST["act"]='news'; 
	}
	$message .= $lang['Message_News_updated'];
	

} elseif (isset($_REQUEST["act"]) and $_REQUEST["act"]=='copyNews') {
	
	$sql = "SELECT * FROM ".$TABLE["Options"];
	$sql_result = sql_resultNL($sql);
	$Options = mysqli_fetch_assoc($sql_result);
	if(trim($Options['time_zone'])!='') {
		date_default_timezone_set(trim($Options['time_zone']));
	}
	$cur_date = date('Y-m-d H:i:s');
	
	$sql = "SELECT * FROM ".$TABLE["News"]." WHERE id = '".SafetyDBNL($_REQUEST["id"])."'";
	$sql_result = sql_resultNL($sql);
	$News = mysqli_fetch_assoc($sql_result);
	
	
	$sql = "INSERT INTO ".$TABLE["News"]." 
			SET `publish_date` 	= '".SafetyDBNL($cur_date)."',
				`status` 		= '".SafetyDBNL($News["status"])."',	
				`cat_id` 		= '".SafetyDBNL($News["cat_id"])."',
				`title` 		= '".SaveDB($News["title"])." (Copy)',
				`summary` 		= '".SaveDB($News["summary"])."',
				`content` 		= '".SaveDB($News["content"])."',
				`caption` 		= '".SaveDB($News["caption"])."',
				`imgpos` 		= '".SafetyDBNL($News["imgpos"])."', 
				`reviews` 		= '0'";
	$sql_result = sql_resultNL($sql);
		
	
	$index_id = mysqli_insert_id($connNL);	
	
	$image = ReadDB($News["image"]);
	$newfile = "";
	if($image != "") {
		$file = $CONFIG["upload_folderNL"].$image;
		$imageName = $index_id."_".$image;
		$newfile = $CONFIG["upload_folderNL"].$imageName;
		if (copy($file, $newfile)) {
			//$message = "Image copied. ";
		} 
		$sql = "UPDATE ".$TABLE["News"]."  
				SET image = '".$imageName."'  
				WHERE id='".$index_id."'";
		$sql_result = sql_resultNL($sql);
	}
	
 	$_REQUEST["act"]='news'; 
	$message = $lang['Message_News_copied'];


} elseif (isset($_REQUEST["act"]) and $_REQUEST["act"]=='delNews') {
	
	$sql = "SELECT * FROM ".$TABLE["News"]." WHERE id = '".SafetyDBNL($_REQUEST["id"])."'";
	$sql_result = sql_resultNL($sql);
	$imageArr = mysqli_fetch_assoc($sql_result);
	$image = ReadDB($imageArr["image"]);
	if($image != "") unlink($CONFIG["upload_folderNL"].$image);
	if($image != "") unlink($CONFIG["upload_thumbsNL"].$image);

	$sql = "DELETE FROM ".$TABLE["News"]." WHERE id='".SafetyDBNL($_REQUEST["id"])."'";
   	$sql_result = sql_resultNL($sql);
 	$_REQUEST["act"]='news'; 
	$message = $lang['Message_News_deleted'];
	
} elseif (isset($_REQUEST["act"]) and $_REQUEST["act"]=="delImage") { 
	
	$sql = "SELECT * FROM ".$TABLE["News"]." WHERE id = '".SafetyDBNL($_REQUEST["id"])."'";
	$sql_result = sql_resultNL($sql);
	$imageArr = mysqli_fetch_assoc($sql_result);
	$image = ReadDB($imageArr["image"]);
	if($image != "") unlink($CONFIG["upload_folderNL"].$image);
	if($image != "") unlink($CONFIG["upload_thumbsNL"].$image);
	
	$sql = "UPDATE `".$TABLE["News"]."` SET `image` = '' WHERE id = '".SafetyDBNL($_REQUEST["id"])."'";
	$sql_result = sql_resultNL($sql);
	
	$message = $lang['Message_Image_deleted'];
	$_REQUEST["act"] = "editNews";
	
} elseif (isset($_REQUEST["act"]) and $_REQUEST["act"] == "addCat"){

    $sql = "SELECT * FROM ".$TABLE["Categories"]." WHERE `cat_name` = '".SafetyDBNL(trim($_REQUEST["cat_name"]))."'";
    $sql_result = sql_resultNL($sql);
    if(mysqli_num_rows($sql_result) == 0) {

        $sql = "INSERT INTO ".$TABLE["Categories"]."
				SET `cat_name` = '".SafetyDBNL($_REQUEST["cat_name"])."',
					`cat_show` = '".SafetyDBNL($_REQUEST["cat_show"])."'";
        $sql_result = sql_resultNL($sql);

        $_REQUEST["act"] = "cats";
        $message .= $lang['Message_Categ_added'];

    } else {
        $_REQUEST["act"] = "cats";
        $message .= $lang['Message_Categ_exist'];
    }


} elseif (isset($_REQUEST["act"]) and $_REQUEST["act"] == "updateCat"){

    $sql = "SELECT * FROM ".$TABLE["Categories"]." WHERE cat_name='".SafetyDBNL($_REQUEST["cat_name"])."'";
    $sql_result = sql_resultNL($sql);
    if(mysqli_num_rows($sql_result)>1) {

        $_REQUEST["act"] = "cats";
        $message .= $lang['Message_Categ_exist'];

    } else {

        $sql = "UPDATE ".$TABLE["Categories"]."
				SET `cat_name` = '".SafetyDBNL($_REQUEST["cat_name"])."',
					`cat_show` = '".SafetyDBNL($_REQUEST["cat_show"])."' 
				WHERE id='".$_REQUEST["id"]."'";
        $sql_result = sql_resultNL($sql);

        $_REQUEST["act"] = "cats";
        $message .= $lang['Message_Categ_updated'];

    }

} elseif (isset($_REQUEST["act"]) and $_REQUEST["act"]=='delCat') {

    $sql = "DELETE FROM ".$TABLE["Categories"]." WHERE id='".SafetyDBNL($_REQUEST["id"])."'";
    $sql_result = sql_resultNL($sql);
    $_REQUEST["act"]='cats';
    $message = $lang['Message_Categ_deleted'];

} elseif (isset($_REQUEST["act"]) and $_REQUEST["act"] == "addSubscriber"){
	
	$sql = "INSERT INTO ".$TABLE["Subscribers"]." 
			SET `cat_id` 		= '".SafetyDBNL($_REQUEST["cat_id"])."',
				`subscribe_date`= '".SaveDB($_REQUEST["subscribe_date"])."',
				`status` 		= '".SaveDB($_REQUEST["status"])."',
                `email` 		= '".SaveDB($_REQUEST["email"])."',
                `name` 			= '".SaveDB($_REQUEST["name"])."',
                `address` 		= '".SaveDB($_REQUEST["address"])."',
                `zip_code` 		= '".SaveDB($_REQUEST["zip_code"])."'";
	$sql_result = sql_resultNL($sql);	
		
	$_REQUEST["act"] = "subscribers";		
	$message .= $lang['Message_Subscriber_added'];
	
	
} elseif (isset($_REQUEST["act"]) and $_REQUEST["act"] == "updateSubscriber"){
	
	$_REQUEST["id"]= (int) SafetyDBNL($_REQUEST["id"]);
	
	$sql = "UPDATE ".$TABLE["Subscribers"]." 
			SET `cat_id` 		= '".SafetyDBNL($_REQUEST["cat_id"])."',
				`subscribe_date`= '".SaveDB($_REQUEST["subscribe_date"])."',
				`status` 		= '".SaveDB($_REQUEST["status"])."',
                `name` 			= '".SaveDB($_REQUEST["name"])."',
                `email` 		= '".SaveDB($_REQUEST["email"])."',
                `address` 		= '".SaveDB($_REQUEST["address"])."',
                `zip_code` 		= '".SaveDB($_REQUEST["zip_code"])."'  
			WHERE id='".$_REQUEST["id"]."'";
	$sql_result = sql_resultNL($sql);	
		
	$_REQUEST["act"] = "subscribers";		
	$message .= $lang['Message_Subscriber_updated'];
	
} elseif (isset($_REQUEST["act"]) and $_REQUEST["act"]=='delSubscriber') {
	
	$_REQUEST["id"]= (int) SafetyDBNL($_REQUEST["id"]);
	
	$sql = "DELETE FROM ".$TABLE["Subscribers"]." WHERE id='".$_REQUEST["id"]."'";
   	$sql_result = sql_resultNL($sql);
 	$_REQUEST["act"]='subscribers'; 
	$message = $lang['Message_Subscriber_deleted'];
	
	
} elseif (isset($_REQUEST["act"]) and $_REQUEST["act"] == "addSubscrCSV"){
	
	$filename=$_FILES["csvfile"]["tmp_name"];	
	
	if($_FILES["csvfile"]["size"] > 0) {
		$file = fopen($filename, "r");
		while (($getData = fgetcsv($file, 10000, ",")) !== FALSE) {
			
			if(!isset($getData[1])) $getData[1] = "";

			   
			$sql = "INSERT INTO ".$TABLE["Subscribers"]." 
			SET `subscribe_date`= '".SaveDB(date("Y-m-d H:i:s"))."',
				`status` 		= 'active',
                `name` 			= '".SaveDB($getData[1])."',
                `email` 		= '".SaveDB($getData[0])."'";
			$sql_result = sql_resultNL($sql);	
		 }
		
		 fclose($file);	
	 }	
		
	$_REQUEST["act"] = "subscribers";		
	$message .= $lang['Message_Subscriber_uploadedCSV'];
	


} elseif (isset($_REQUEST["act"]) and $_REQUEST["act"]=='sendToSubscribers') {
	
	$sql = "SELECT * FROM ".$TABLE["Options"];
	$sql_result = sql_resultNL($sql);	
	$Options = mysqli_fetch_assoc($sql_result);
	$OptionsVis = unserialize($Options['visual_form']);
	$OptionsLang = unserialize(base64_decode($Options['language']));
	
	$_REQUEST["id"]= (int) SafetyDBNL($_REQUEST["id"]);

	$sql = "SELECT * FROM ".$TABLE["News"]." WHERE id = '".$_REQUEST["id"]."'";
	$sql_result = sql_resultNL($sql);	
	$News = mysqli_fetch_assoc($sql_result);
	
	$mailheader = "From: ".ReadDB($Options['admin_email'])."\n";
	$mailheader .= "Reply-To: ".ReadDB($Options['admin_email'])."\n";
	$mailheader .= "MIME-Version: 1.0\n";
	$mailheader .= "Content-type: text/html; charset=UTF-8\r\n"; 
	
	$Email_Subject = ReadDB($OptionsLang["Email_Subject"]);
	
	
	$Message_body = "<div style='margin:0 auto; width: ".$OptionsVis["newsletter_width"]."px;'>";
	
	if(ReadDB($News["image"])!='') {
		$Message_body .= "<div style='float:none; margin-bottom: 30px;'>";
		$Message_body .= "<img src='".$CONFIG["full_url"].$CONFIG["upload_folderNL"].ReadDB($News["image"])."' alt='".ReadDB($News["title"])."' style='padding-right:14px; padding-bottom:3px; padding-top:3px;max-width:100%;' />";
		$Message_body .= "</div>";
	}
	
	$Message_body .= "<div style='font-family:".$OptionsVis["nl_tit_font"].";color:".$OptionsVis["nl_tit_color"].";font-size:".$OptionsVis["nl_tit_size"].";font-weight:".$OptionsVis["nl_tit_font_weight"].";font-style:".$OptionsVis["nl_tit_font_style"].";line-height:".$OptionsVis["nl_tit_line_height"].";text-align:left;'>";
	
	/* $Message_body .= "<a href='".$Options['news_link']."?id=".$News["id"]."' target='_blank' style='font-family:".$OptionsVis["nl_tit_font"].";color:".$OptionsVis["nl_tit_color"].";font-size:".$OptionsVis["nl_tit_size"].";font-weight:".$OptionsVis["nl_tit_font_weight"].";font-style:".$OptionsVis["nl_tit_font_style"].";text-decoration:none;'>";	 */
	
	$Message_body .= "<a href='";
	if(trim($Options['news_link'])!="") {
		$Message_body .= $Options['news_link'];
	} else {
		$Message_body .= $CONFIG["full_url"]."preview.php";
	}
	$Message_body .= "?id=".$News["id"]."' target='_blank' style='font-family:".$OptionsVis["nl_tit_font"].";color:".$OptionsVis["nl_tit_color"].";font-size:".$OptionsVis["nl_tit_size"].";font-weight:".$OptionsVis["nl_tit_font_weight"].";font-style:".$OptionsVis["nl_tit_font_style"].";text-decoration:none;'>";	
	
	$Message_body .= ReadDB($News["title"]);	
	
	$Message_body .= "</a>";
	
	$Message_body .= "</div>";
	$Message_body .= "<br />";
	
	
	$Message_body .= "<div style='font-family:".$OptionsVis["nl_cont_font"]."; color:".$OptionsVis["nl_cont_color"]."; font-size:".$OptionsVis["nl_cont_size"]."; font-style:".$OptionsVis["nl_cont_font_style"]."; line-height:".$OptionsVis["nl_cont_line_height"]."; line-height:".$OptionsVis["nl_cont_line_height"]."; margin:0; padding:0; float:none;'>";
	
	
	
	$Message_body .= ReadDB($News["content"]);
	
	$Message_body .= "<div style='text-align:left; margin: 30px 0 0 0'>".nl2br(ReadDB($OptionsLang["Greetings"]))."</div>";
	
	$Message_body .= "<div style='text-align:left;margin: 30px 0 0 0; padding: 10px; background-color:#eee;color:#666;'>".detectEmail(detectWebsite(nl2br(ReadDB($OptionsLang["Newsletter_footer"]))))."</div>";
	
	$Message_body .= "</div>";
	$Message_body .= "</div>";
	

	//adding PHPMailer library
	include( dirname(__FILE__). '/phpmailer/PHPMailerAutoload.php');
	
	//Create a new PHPMailer instance
	$mail = new PHPMailer;
	
	
	if(isset($_REQUEST["subscribers"]) and $_REQUEST["subscribers"][0] == '0'){ //send newsletter to all active subscribers
		
		if(isset($_REQUEST["cat_id"]) and $_REQUEST["cat_id"]>0) {
			$searchCatId = " AND `cat_id`='".$_REQUEST["cat_id"]."' ";
		} else {
			$searchCatId = "";
		}
		
		$sql = "SELECT * FROM ".$TABLE["Subscribers"]." 
				WHERE status='active' ".$searchCatId." 
				ORDER BY subscribe_date DESC";
		$sql_result = sql_resultNL($sql);	
		while ($Subscriber = mysqli_fetch_assoc($sql_result)) {
			
			$subscrEmail = stripslashes($Subscriber["email"]);
							
			$link = "<br /><br /><div align='center'>".$OptionsLang["Unsubscribe_from_newsletters"]." <a href='".$CONFIG["full_url"]."cancel_subscription.php?a=cancel_subscription&amp;e=".$subscrEmail."&amp;i=".$Subscriber["id"]."&amp;s=".md5($Subscriber["id"]." - ".$subscrEmail)."'>".$OptionsLang["here"]."</a></div>";
			
			
			if($Options['unsubscr_link']=='no') {
				$Message_email = $Message_body . "<br /><br />";
			} else {
				$Message_email = $Message_body . $link . "<br /><br />";
			}
			
			if($Options["smtp_auth"]=="yes") { // send newsletter using SMTP server with authentication
				
				//$mail->SMTPDebug = 3; // enables SMTP debug information: 1 = errors and messages; 2 = messages only; 3 = Enable verbose debug output
				
				$mail->isSMTP();								// Set mailer to use SMTP
				$mail->Host = $Options["smtp_server"];			// Specify main and backup SMTP servers
				$mail->SMTPAuth = true;							// Enable SMTP authentication
				$mail->Username = $Options["smtp_email"];		// SMTP username
				$mail->Password = $Options["smtp_pass"];		// SMTP password
				$mail->SMTPSecure = $Options["smtp_secure"];	// Enable `tls` encryption, `ssl` also accepted
				$mail->Port = (int)$Options["smtp_port"];		// TCP port to connect to
				
				$mail->CharSet = "UTF-8";						// force setting charset UTF-8
				
								
				$mail->SetFrom(ReadDB($Options["admin_email"]), ReadDB($Options["admin_email"]));	// email from
				
				$mail->addAddress($subscrEmail, $subscrEmail);		// Add a recipient
				
				$mail->AddReplyTo(ReadDB($Options["admin_email"]), ReadDB($Options["admin_email"]));// Add reply To email
				
				$mail->Subject = ReadDB($Email_Subject); // Set email subject	
		
				$mail->MsgHTML($Message_email);
				//$mail->Body    = $Message_body;
				$mail->AltBody = strip_tags($Message_email);
				
				if(!$mail->send()) {
					//$message .= ' Message could not be sent.';
					$message .= ' Mailer Error: ' . $mail->ErrorInfo;
				} else {
					//$message .= ' Message has been sent to admin!';
				}
				
				// Clear all and ready for next email sending
				$mail->ClearAddresses();
				//$mail->ClearAttachments();
				$mail->ClearReplyTos();
				$mail->ClearAllRecipients();
				//$mail->ClearCustomHeaders();
				
			} else { // SEND newsletter TO ALL subscribers using PHPmailer and the default php MAIL() function
			
				//mail($subscrEmail, $Email_Subject, $Message_email, $mailheader);
								
				//Set who the message is to be sent from
				$mail->setFrom(ReadDB($Options["admin_email"]), ReadDB($Options["admin_email"]));
				//Set an alternative reply-to address
				$mail->addReplyTo(ReadDB($Options["admin_email"]), ReadDB($Options["admin_email"]));
				//Set who the message is to be sent to
				$mail->addAddress($subscrEmail, $subscrEmail);
				$mail->CharSet = "UTF-8"; // force setting charset UTF-8
				//Set the subject line
				$mail->Subject = $Email_Subject; // Set email subject
				//Read an HTML message body from an external file, convert referenced images to embedded,
				//convert HTML into a basic plain-text alternative body
				$mail->msgHTML($Message_email);
				//Replace the plain text body with one created manually
				$mail->AltBody = strip_tags($Message_email);
				//Attach an image file
				//$mail->addAttachment('images/phpmailer_mini.png');
				
				//send the message, check for errors
				if (!$mail->send()) {
					$message .= " Mailer Error: " . $mail->ErrorInfo;
				} else {
					//$message .= " Message sent to admin!";
				}
				
				// Clear all and ready for next email sending
				$mail->ClearAddresses();
				//$mail->ClearAttachments();
				$mail->ClearReplyTos();
				$mail->ClearAllRecipients();
				//$mail->ClearCustomHeaders();
				
			}
		}
	} else { // send newsletter only to selected number of subscribers
	  if(isset($_REQUEST["subscribers"]) and count($_REQUEST["subscribers"])>0) {
		foreach($_REQUEST["subscribers"] as $subscr_id){
			$sql = "SELECT * FROM ".$TABLE["Subscribers"]." WHERE id = '".$subscr_id."'";
			$sql_result = sql_resultNL($sql);	
			$Subscriber = mysqli_fetch_assoc($sql_result);
			
			$subscrEmail = stripslashes($Subscriber["email"]);

			$link = "<br /><br /><div align='center'>".$OptionsLang["Unsubscribe_from_newsletters"]." <a href='".$CONFIG["full_url"]."cancel_subscription.php?a=cancel_subscription&amp;e=".$subscrEmail."&amp;i=".$Subscriber["id"]."&amp;s=".md5($Subscriber["id"]." - ".$subscrEmail)."'>".$OptionsLang["here"]."</a></div>";
			
			if($Options['unsubscr_link']=='no') {
				$Message_email = $Message_body . "<br /><br />";
			} else {
				$Message_email = $Message_body . $link . "<br /><br />";
			}
			
			if($Options["smtp_auth"]=="yes") { // send newsletter using SMTP server with authentication
				
				//$mail->SMTPDebug = 3; // enables SMTP debug information: 1 = errors and messages; 2 = messages only; 3 = Enable verbose debug output
				
				$mail->isSMTP();								// Set mailer to use SMTP
				$mail->Host = $Options["smtp_server"];			// Specify main and backup SMTP servers
				$mail->SMTPAuth = true;							// Enable SMTP authentication
				$mail->Username = $Options["smtp_email"];		// SMTP username
				$mail->Password = $Options["smtp_pass"];		// SMTP password
				$mail->SMTPSecure = $Options["smtp_secure"];	// Enable `tls` encryption, `ssl` also accepted
				$mail->Port = (int)$Options["smtp_port"];		// TCP port to connect to
				
				$mail->CharSet = "UTF-8";						// force setting charset UTF-8
				
								
				$mail->SetFrom(ReadDB($Options["admin_email"]), ReadDB($Options["admin_email"]));	// email from
				
				$mail->addAddress($subscrEmail, $subscrEmail);		// Add a recipient
				
				$mail->AddReplyTo(ReadDB($Options["admin_email"]), ReadDB($Options["admin_email"]));// Add reply To email
				
				$mail->Subject = ReadDB($Email_Subject); // Set email subject	
		
				$mail->MsgHTML($Message_email);
				//$mail->Body    = $Message_body;
				$mail->AltBody = strip_tags($Message_email);
				
				if(!$mail->send()) {
					//$message .= ' Message could not be sent.';
					$message .= ' Mailer Error: ' . $mail->ErrorInfo;
				} else {
					//$message .= ' Message has been sent to admin!';
				}
				
				// Clear all and ready for next email sending
				$mail->ClearAddresses();
				//$mail->ClearAttachments();
				$mail->ClearReplyTos();
				$mail->ClearAllRecipients();
				//$mail->ClearCustomHeaders();
				
			} else { // SEND newsletter to SELECTED subscribers using PHPmailer and the default php MAIL() function
											
				//mail($subscrEmail, $Email_Subject, $Message_email, $mailheader);
								
				//Set who the message is to be sent from
				$mail->setFrom(ReadDB($Options["admin_email"]), ReadDB($Options["admin_email"]));
				//Set an alternative reply-to address
				$mail->addReplyTo(ReadDB($Options["admin_email"]), ReadDB($Options["admin_email"]));
				//Set who the message is to be sent to
				$mail->addAddress($subscrEmail, $subscrEmail);
				$mail->CharSet = "UTF-8"; // force setting charset UTF-8
				//Set the subject line
				$mail->Subject = $Email_Subject; // Set email subject
				//Read an HTML message body from an external file, convert referenced images to embedded,
				//convert HTML into a basic plain-text alternative body
				$mail->msgHTML($Message_email);
				//Replace the plain text body with one created manually
				$mail->AltBody = strip_tags($Message_email);
				//Attach an image file
				//$mail->addAttachment('images/phpmailer_mini.png');
				
				//send the message, check for errors
				if (!$mail->send()) {
					$message .= " Mailer Error: " . $mail->ErrorInfo;
				} else {
					//$message .= " Message sent to admin!";
				}
				
				// Clear all and ready for next email sending
				$mail->ClearAddresses();
				//$mail->ClearAttachments();
				$mail->ClearReplyTos();
				$mail->ClearAllRecipients();
				//$mail->ClearCustomHeaders();
			}
		}	
	  } else {
		  $message .= $lang['Message_Newsletter_select'];	
	  }
	}
	
	
	if(trim($Options['time_zone'])!='') {
		date_default_timezone_set(trim($Options['time_zone']));
	}
	$cur_date = date('Y-m-d H:i:s');
	
	$sql = "UPDATE ".$TABLE["News"]." 
			SET `send_date` = '".SafetyDBNL($cur_date)."'
			WHERE id='".SafetyDBNL($_REQUEST["id"])."'";
	$sql_result = sql_resultNL($sql);
	
			
	$_REQUEST["act"]='news'; 
	$message .= $lang['Message_Newsletter_sent'];	
}

if (!isset($_REQUEST["act"]) or $_REQUEST["act"]=='') $_REQUEST["act"]='news';

$sql = "SELECT * FROM ".$TABLE["Options"];
$sql_result = sql_resultNL($sql);
$Options = mysqli_fetch_assoc($sql_result);
mysqli_free_result($sql_result);

if(trim($Options['time_zone'])!='') {
	date_default_timezone_set(trim($Options['time_zone']));
}

$_SESSION['KCFINDER'] = array(
    'disabled' => false
);
?>    

<div class="menuButtons">
    <div class="menuButton"><a<?php if($_REQUEST['act']=='news' or $_REQUEST['act']=='newNews' or $_REQUEST['act']=='viewNews' or $_REQUEST['act']=='editNews' or $_REQUEST['act']=='rss' or $_REQUEST['act']=='sendNewsletter') echo ' class="selected"'; ?> href="admin.php?act=news"><span><?php echo $lang['menu_News']; ?></span></a></div>    
    <div class="menuButton"><a<?php if($_REQUEST['act']=='cats' or $_REQUEST['act']=='newCat' or $_REQUEST['act']=='editCat' or $_REQUEST['act']=='HTML_Cat') echo ' class="selected"'; ?> href="admin.php?act=cats"><span><?php echo $lang['menu_Categories']; ?></span></a></div>        
    <div class="menuButton"><a<?php if($_REQUEST['act']=='subscribers' or $_REQUEST['act']=='newSubscriber' or $_REQUEST['act']=='editSubscriber' or $_REQUEST['act']=='newSubscrCSV') echo ' class="selected"'; ?> href="admin.php?act=subscribers"><span><?php echo $lang['menu_Subscribers']; ?></span></a></div>
    <div class="menuButton"><a<?php if($_REQUEST['act']=='newsletters_options' or $_REQUEST['act']=='news_options' or $_REQUEST['act']=='visual_options' or $_REQUEST['act']=='visual_options_newsletters' or $_REQUEST['act']=='language_options') echo ' class="selected"'; ?> href="admin.php?act=newsletters_options"><span><?php echo $lang['menu_Options']; ?></span></a></div> 
    <div class="menuButton"><a<?php if($_REQUEST['act']=='html') echo ' class="selected"'; ?> href="admin.php?act=html"><span><?php echo $lang['menu_Put_on_WebPage'] ?></span></a></div>    
    
    <div class="welcome">Hello <?php echo $CONFIG["admin_user"]; ?>!</div>
    <div class="clear"></div>        
</div>	

<div class="admin_wrapper">

<?php
if ($_REQUEST["act"]=='news' or $_REQUEST["act"]=='newNews' or $_REQUEST["act"]=='editNews' or $_REQUEST["act"]=='viewNews' or $_REQUEST["act"]=='rss') {
?>
    <div class="menuSubButton"><a<?php if($_REQUEST['act']=='news' or $_REQUEST['act']=='editNews' or $_REQUEST["act"]=='viewNews') echo ' class="selected"'; ?> href="admin.php?act=news"><?php echo $lang['menu_News_List']; ?></a></div>
    <div class="menuSubButton"><a<?php if($_REQUEST['act']=='newNews') echo ' class="selected"'; ?> href="admin.php?act=newNews"><?php echo $lang['menu_Create_News']; ?></a></div>
    <div class="menuSubButton"><a href="preview.php" target="_blank"><?php echo $lang['menu_News_Preview']; ?></a></div>
    <div class="menuSubButton"><a<?php if($_REQUEST['act']=='rss') echo ' class="selected"'; ?> href="admin.php?act=rss"><?php echo $lang['menu_RSS_feed']; ?></a></div>
    <div class="clear"></div>    
       
<?php
} elseif ($_REQUEST["act"]=='cats' or $_REQUEST["act"]=='newCat' or $_REQUEST["act"]=='editCat' or $_REQUEST['act']=='HTML_Cat') {
?>
    <div class="menuSubButton"><a<?php if($_REQUEST['act']=='cats' or $_REQUEST['act']=='editCat') echo ' class="selected"'; ?> href="admin.php?act=cats"><?php echo $lang['menu_Categories_List']; ?></a></div>
    <div class="menuSubButton"><a<?php if($_REQUEST['act']=='newCat') echo ' class="selected"'; ?> href="admin.php?act=newCat"><?php echo $lang['menu_Create_Category']; ?></a></div>
    <div class="clear"></div>                  


<?php
} elseif ($_REQUEST["act"]=='subscribers' or $_REQUEST["act"]=='newSubscriber' or $_REQUEST["act"]=='editSubscriber') {
?>
    <div class="menuSubButton"><a<?php if($_REQUEST['act']=='subscribers' or $_REQUEST['act']=='editSubscriber') echo ' class="selected"'; ?> href="admin.php?act=subscribers"><?php echo $lang['menu_Subscribers_List']; ?></a></div>
    <div class="menuSubButton"><a<?php if($_REQUEST['act']=='newSubscriber') echo ' class="selected"'; ?> href="admin.php?act=newSubscriber"><?php echo $lang['menu_Add_Subscriber']; ?></a></div>
    <div class="menuSubButton"><a<?php if($_REQUEST['act']=='newSubscrCSV') echo ' class="selected"'; ?> href="admin.php?act=newSubscrCSV"><?php echo $lang['menu_Add_CSV']; ?></a></div>
    <div class="menuSubButton"><a href="preview_newsletter_form.php" target="_blank"><?php echo $lang['menu_NewsL_Form_Preview']; ?></a></div>
    <div class="menuSubButton"><a href="preview_popup_form.php" target="_blank"><?php echo $lang['menu_NewsL_Popup_Preview']; ?></a></div>
    <div class="menuSubButton"><a href="preview_newsletter_form.php?test=yes" target="_blank"><?php echo $lang['menu_NewsL_Form_Test_Prev']; ?></a></div>
    <div class="clear"></div>  


<?php 
} elseif ($_REQUEST["act"]=='newsletters_options' or $_REQUEST["act"]=='news_options' or $_REQUEST["act"]=='visual_options' or $_REQUEST['act']=='visual_options_newsletters' or $_REQUEST["act"]=='language_options') { 
?>
    <div class="menuSubButton"><a<?php if($_REQUEST['act']=='newsletters_options') echo ' class="selected"'; ?> href="admin.php?act=newsletters_options"><?php echo $lang['menu_NewsLetters_options']; ?></a></div>
    <div class="menuSubButton"><a<?php if($_REQUEST['act']=='news_options') echo ' class="selected"'; ?> href="admin.php?act=news_options"><?php echo $lang['menu_News_options']; ?></a></div>
    <div class="menuSubButton"><a<?php if($_REQUEST['act']=='visual_options') echo ' class="selected"'; ?> href="admin.php?act=visual_options"><?php echo $lang['menu_Visual_options']; ?></a></div>
      <div class="menuSubButton"><a<?php if($_REQUEST['act']=='visual_options_newsletters') echo ' class="selected"'; ?> href="admin.php?act=visual_options_newsletters"><?php echo $lang['menu_Visual_options_NewsLetters']; ?></a></div>
    <div class="menuSubButton"><a<?php if($_REQUEST['act']=='language_options') echo ' class="selected"'; ?> href="admin.php?act=language_options" style="background:none;"><?php echo $lang['menu_Language']; ?></a></div>
    <div class="clear"></div>        

<?php } ?>



	<?php if(isset($message) and $message!='') {?>
    <div class="message"><?php echo $message; ?></div>
    <?php } ?>
    <script type="text/javascript">	
	jQuery(document).ready(function(){
		setTimeout(function(){
			jQuery("div.message").fadeOut("slow", function () {
				jQuery("div.message").remove();
			});
	 
		}, 3500);
	 });
	</script>
    

<?php 
if ($_REQUEST["act"]=='news') {
	
	if(isset($_REQUEST["search"]) and $_REQUEST["search"]!='') {
		$_REQUEST["search"] = htmlspecialchars(urldecode($_REQUEST["search"]), ENT_QUOTES);
	} else { 
		$_REQUEST["search"] = ''; 
	}
	if(!isset($_REQUEST["orderBy"]))  $_REQUEST["orderBy"] = ''; 
	if(!isset($_REQUEST["orderType"])) $_REQUEST["orderType"] = ''; 
	
	if(isset($_REQUEST["p"]) and $_REQUEST["p"]!='') { 
		$pageNum = (int) SafetyDBNL(urldecode($_REQUEST["p"]));
		if($pageNum<=0) $pageNum = 1;
	} else { 
		$pageNum = 1;
	}
	
	$orderByArr = array("title", "publish_date", "status", "cat_id", "reviews", "send_date");
	if(isset($_REQUEST["orderBy"]) and $_REQUEST["orderBy"]!='' and in_array($_REQUEST["orderBy"], $orderByArr)) { 
		$orderBy = $_REQUEST["orderBy"];
	} else { 
		$orderBy = "publish_date";
	}
	
    $orderTypeArr = array("DESC", "ASC");	
    if(isset($_REQUEST["orderType"]) and $_REQUEST["orderType"]!='' and in_array($_REQUEST["orderType"], $orderTypeArr)) { 
		$orderType = $_REQUEST["orderType"];
	} else {
		$orderType = "DESC";
	}
	if ($orderType == 'DESC') { $norderType = 'ASC'; } else { $norderType = 'DESC'; }
	
	$sqlPublished   = "SELECT id FROM ".$TABLE["News"]." WHERE status='Published'";
	$sql_resultPublished = sql_resultNL($sqlPublished);
	$NewsPublished = mysqli_num_rows($sql_resultPublished);
	
	$sqlCount   = "SELECT id FROM ".$TABLE["News"];
	$sql_resultCount = sql_resultNL($sqlCount);
	$NewsCount = mysqli_num_rows($sql_resultCount);
?>
	<div class="pageDescr"><?php echo $lang['List_Below_is_a_list']; ?> <strong style="font-size:16px"><?php echo $NewsPublished; ?></strong> <?php echo $lang['List_news_published']; ?> <strong style="font-size:16px"><?php echo $NewsCount; ?></strong>.</div>
    
    <div class="searchForm">
    <form action="admin.php?act=news" method="post" name="form" class="formStyle">
      <input type="text" name="search" value="<?php echo urldecode($_REQUEST["search"]); ?>" class="searchfield" placeholder="<?php echo $lang['List_Search_placeholder']; ?>" />
      <input type="submit" value="<?php echo $lang['List_Search_Button']; ?>" class="submitButton" />
    </form>
    </div>
    
    <form action="admin.php" method="post" name="form1" class="formStyle">
    <input type="hidden" name="act" value="toArchive" />
	<table border="0" cellspacing="0" cellpadding="8" class="allTables">
  	  <tr>
        <td class="headlist"><a href="admin.php?act=news&orderType=<?php echo $norderType; ?>&search=<?php echo urlencode($_REQUEST["search"]); ?>&orderBy=title"><?php echo $lang['List_Title']; ?></a></td>
        <td width="12%" class="headlist"><a href="admin.php?act=news&orderType=<?php echo $norderType; ?>&search=<?php echo urlencode($_REQUEST["search"]); ?>&orderBy=publish_date"><?php echo $lang['List_Date_published']; ?></a></td>
        <td width="12%" class="headlist"><a href="admin.php?act=news&orderType=<?php echo $norderType; ?>&search=<?php echo urlencode($_REQUEST["search"]); ?>&orderBy=send_date"><?php echo $lang['List_Date_sent']; ?></a></td>
        <td width="8%" class="headlist"><a href="admin.php?act=news&orderType=<?php echo $norderType; ?>&search=<?php echo urlencode($_REQUEST["search"]); ?>&orderBy=status"><?php echo $lang['List_Status']; ?></a></td>
        <td width="14%" class="headlist"><a href="admin.php?act=news&orderType=<?php echo $norderType; ?>&search=<?php echo urlencode($_REQUEST["search"]); ?>&orderBy=cat_id"><?php echo $lang['List_Category']; ?></a></td>
        <td width="5%" class="headlist"><a href="admin.php?act=news&orderType=<?php echo $norderType; ?>&search=<?php echo urlencode($_REQUEST["search"]); ?>&orderBy=reviews"><?php echo $lang['List_Reviews']; ?></a></td>
        <td class="headlist" colspan="5" width="20%"><div style="max-width:106px;"><?php echo $lang['List_Send_button']; ?></div></td>
  	  </tr>
      
  	<?php 
	if(isset($_REQUEST["search"]) and ($_REQUEST["search"]!="")) {
	  $findMe = SafetyDBNL($_REQUEST["search"]);
	  $search = "WHERE title LIKE '%".$findMe."%'";
	} else {
	  $search = '';
	}

	$sql   = "SELECT count(*) as total FROM ".$TABLE["News"]." ".$search;
	$sql_result = sql_resultNL($sql);
	$row   = mysqli_fetch_array($sql_result);
	$count = $row["total"];
	$pages = ceil($count/50);

	$sql = "SELECT * FROM ".$TABLE["News"]." ".$search." 
			ORDER BY " . $orderBy . " " . $orderType."  
			LIMIT " . ($pageNum-1)*50 . ",50";
	$sql_result = sql_resultNL($sql);
	
	if (mysqli_num_rows($sql_result)>0) {
		while ($News = mysqli_fetch_assoc($sql_result)) {		
	?>
  	  <tr>
        <td class="bodylist"><?php echo ReadDB($News["title"]); ?></td>
        <td class="bodylist"><?php echo admin_date($News["publish_date"]); ?></td>
        <td class="bodylist"><?php if(trim($News["send_date"])!='') { echo admin_date($News["send_date"]); } ?></td>
        <td class="bodylist"><?php echo ReadDB($News["status"]); ?></td>        
        <td class="bodylist">
        	<?php 
			$sqlCat = "SELECT * FROM ".$TABLE["Categories"]." WHERE id='".$News["cat_id"]."'";
			$sql_resultCat = sql_resultNL($sqlCat);
			$Cat = mysqli_fetch_assoc($sql_resultCat);	
			if($Cat["id"]>0) echo ReadDB($Cat["cat_name"]); else echo "------"; ?>
        </td>
        <td class="bodylist"><?php if($News["reviews"]=='') echo "0"; else echo $News["reviews"]; ?></td>
        
        <td class="bodylistAct"><a class="send" href='admin.php?act=sendNewsletter&id=<?php echo $News["id"]; ?>' title="Send Newsletter">Send&nbsp;Newsletter</a></td>
        <td class="bodylistAct"><a class="view" href='admin.php?act=viewNews&id=<?php echo $News["id"]; ?>' title="Preview"><img class="act" src="images/preview.png" alt="Preview" /></a></td>
        <td class="bodylistAct"><a href='admin.php?act=editNews&id=<?php echo $News["id"]; ?>' title="Edit"><img class="act" src="images/edit.png" alt="Edit" /></a></td>
        <td class="bodylistAct"><a href="admin.php?act=copyNews&id=<?php echo $News["id"]; ?>" onclick="return confirm('Are you sure you want to create a copy?');" title="Copy"><img class="act" src="images/copy_icon.png" alt="Copy" /></a></td>
        <td class="bodylistAct"><a class="delete" href="admin.php?act=delNews&id=<?php echo $News["id"]; ?>" onclick="return confirm('Are you sure you want to delete it?');" title="DELETE"><img class="act" src="images/delete.png" alt="DELETE" /></a></td>
  	  </tr>
  	<?php 
		}
	} else {
	?>
      <tr>
      	<td colspan="11" class="borderBottomList"><?php echo $lang['List_No_News']; ?></td>
      </tr>
    <?php	
	}
	?>
    
	<?php
    if ($pages>0) {
    ?>
  	  <tr>
      	<td colspan="11" class="bottomlist"><div class='paging'><?php echo $lang['List_Page']; ?> </div>
		<?php
        for($i=1;$i<=$pages;$i++){ 
            if($i == $pageNum ) echo "<div class='paging'>" .$i. "</div>";
            else echo "<a href='admin.php?act=news&p=".$i."&search=".$_REQUEST["search"]."&amp;orderBy=".$_REQUEST["orderBy"]."&amp;orderType=".$_REQUEST["orderType"]."' class='paging'>".$i."</a>"; 
            echo "&nbsp; ";
        }
        ?>
      	</td>
      </tr>
	<?php
    }
    ?>
	</table>
    </form>

<?php 
} elseif ($_REQUEST["act"]=='newNews') { 
	$sql = "SELECT * FROM ".$TABLE["Options"];
	$sql_result = sql_resultNL($sql);
	$Options = mysqli_fetch_assoc($sql_result);
	mysqli_free_result($sql_result);
	$OptionsVis = unserialize($Options['visual']);
?>
	<form action="admin.php" method="post" name="form" enctype="multipart/form-data">
  	<input type="hidden" name="act" value="addNews" />
  	<div class="pageDescr"><?php echo $lang['Create_News_To_create_news']; ?></div>
	<table border="0" cellspacing="0" cellpadding="8" class="fieldTables">
      <tr>
      	<td colspan="2" valign="top" class="headlist"><?php echo $lang['Create_News']; ?></td>
      </tr>
      <tr>
      	<td class="formLeft"><?php echo $lang['Create_News_Status']; ?></td>
      	<td class="formRight">
            <select name="status">
              <option value="Published"><?php echo $lang['Create_News_Published']; ?></option>
              <option value="Hidden"><?php echo $lang['Create_News_Hidden']; ?></option>
            </select>
      	</td>
      </tr>
      <tr>
      	<td class="formLeft"><?php echo $lang['Create_News_Category']; ?> </td>
      	<td class="formRight">
        	<select name="cat_id">
            	<option value="0">---------</option>
			<?php
            $sql = "SELECT * FROM ".$TABLE["Categories"]." ORDER BY cat_name ASC";
            $sql_result = sql_resultNL($sql);
            if (mysqli_num_rows($sql_result)>0) {
              while ($Cat = mysqli_fetch_assoc($sql_result)) {
            ?>
         		<option value="<?php echo $Cat["id"]; ?>"><?php echo ReadDB($Cat["cat_name"]); ?></option>
            <?php
			  }
			} 
			?>
      		</select>
		</td>
      </tr>     
      <tr>
        <td class="formLeft"><?php echo $lang['Create_News_Title']; ?></td>
        <td class="formRight"><input class="input_post" type="text" name="title" /></td>
      </tr>      
      <tr>
        <td class="formLeft" valign="top"><?php echo $lang['Create_News_Summary']; ?></td>
        <td class="formRight"><textarea name="summary" cols="80" rows="2" maxlength="140"></textarea></td>
      </tr>      
      <tr>
        <td class="formLeft" valign="top"><?php echo $lang['Create_News_Content']; ?></td>
        <td class="formRight">
        	<textarea name="content" id="content" class="content" cols="85" rows="20"></textarea>
            
            <script type="text/javascript">
				CKEDITOR.replace( 'content',
                {	
					
					filebrowserBrowseUrl : 'ckeditor/kcfinder/browse.php?opener=ckeditor&type=files',
                    filebrowserImageBrowseUrl : 'ckeditor/kcfinder/browse.php?opener=ckeditor&type=images',
                    filebrowserFlashBrowseUrl : 'ckeditor/kcfinder/browse.php?opener=ckeditor&type=flash',
					filebrowserUploadUrl  :'ckeditor/kcfinder/upload.php?opener=ckeditor&type=files',
					filebrowserImageUploadUrl : 'ckeditor/kcfinder/upload.php?opener=ckeditor&type=images',
					filebrowserFlashUploadUrl : 'ckeditor/kcfinder/upload.php?opener=ckeditor&type=flash',
									
					height: 400, width: '98%'

				});
			</script>  
        </td>
      </tr>      
      <tr>
        <td class="formLeft"><?php echo $lang['Create_News_Photo']; ?></td>
        <td class="formRight"><input type="file" name="image" size="80" /> <sub><?php echo $lang['Create_News_Limit_Mb']; ?></sub></td>
      </tr>       
      <tr>
        <td class="formLeft"><?php echo $lang['Create_News_Caption']; ?></td>
        <td class="formRight"><input type="text" name="caption" size="50" maxlength="100" /></td>
      </tr>
      <tr>
        <td class="formLeft"><?php echo $lang['Create_News_Image_location_in_the_text']; ?></td>
        <td class="formRight">
        	<select name="imgpos">
            	<option value="left">left</option>
                <option value="right">right</option>
                <option value="top">top</option>
                <option value="bottom">bottom</option>
            </select>
        </td>
      </tr>   
      <tr>
        <td class="formLeft"><?php echo $lang['Create_News_Publish date']; ?></td>
        <td class="formRight">
      		<input type="text" name="publish_date" id="publish_date" maxlength="25" size="25" value="<?php echo date("Y-m-d H:i:s"); ?>" readonly /> <a href="javascript:NewCssCal('publish_date','yyyymmdd','dropdown',true,24,false)"><img src="images/cal.gif" width="16" height="16" alt="Pick a date" border="0" /></a>
        </td>
      </tr>     
      <tr>
        <td>&nbsp;</td>
        <td class="formRight"><input name="submit" type="submit" value="<?php echo $lang['Create_News_button']; ?>" class="submitButton" /></td>
      </tr>
  	</table>
	</form>
    

<?php 
} elseif ($_REQUEST["act"]=='editNews') {
	
	$_REQUEST["id"]= (int) SafetyDBNL($_REQUEST["id"]);
	
	$sql = "SELECT * FROM ".$TABLE["Options"];
	$sql_result = sql_resultNL($sql);
	$Options = mysqli_fetch_assoc($sql_result);
	mysqli_free_result($sql_result);
	$OptionsVis = unserialize($Options['visual']);
	
	$sql = "SELECT * FROM ".$TABLE["News"]." WHERE id='".$_REQUEST["id"]."'";
	$sql_result = sql_resultNL($sql);
	$News = mysqli_fetch_assoc($sql_result);
	mysqli_free_result($sql_result);
?>
	<form action="admin.php" method="post" name="form" enctype="multipart/form-data">
  	<input type="hidden" name="act" value="updateNews" />
  	<input type="hidden" name="id" value="<?php echo $News["id"]; ?>" />
  	<div class="pageDescr"><?php echo $lang['edit_News_To_edit_news']; ?></div>
	<table border="0" cellspacing="0" cellpadding="8" class="fieldTables">
      <tr>
      	<td colspan="2" valign="top" class="headlist"><?php echo $lang['edit_News']; ?></td>
      </tr>
      <tr>
      	<td class="formLeft"><?php echo $lang['edit_News_Status']; ?></td>
      	<td>
            <select name="status">
              	<option value="Published"<?php if ($News["status"]=='Published') echo ' selected="selected"'; ?>><?php echo $lang['edit_News_Published']; ?></option>
              	<option value="Hidden"<?php if ($News["status"]=='Hidden') echo ' selected="selected"'; ?>><?php echo $lang['edit_News_Hidden']; ?></option>
            </select>
      	</td>
      </tr>
      <tr>
      	<td class="formLeft"><?php echo $lang['edit_News_Category']; ?> </td>
      	<td class="formRight">
        	<select name="cat_id">
            	<option value="0">---------</option>
			<?php
            $sql = "SELECT * FROM ".$TABLE["Categories"]." ORDER BY cat_name ASC";
            $sql_result = sql_resultNL($sql);
            if (mysqli_num_rows($sql_result)>0) {
              while ($Cat = mysqli_fetch_assoc($sql_result)) {
            ?>
         		<option value="<?php echo $Cat["id"]; ?>"<?php if($Cat["id"]==$News["cat_id"]) echo ' selected="selected"'; ?>><?php echo ReadDB($Cat["cat_name"]); ?></option>
            <?php
			  }
			} 
			?>
      		</select>
		</td>
      </tr>   
      <tr>
        <td class="formLeft"><?php echo $lang['edit_News_Title']; ?></td>
        <td class="formRight"><input class="input_post" type="text" name="title" value="<?php echo ReadHTML($News["title"]); ?>" /></td>
      </tr>      
      <tr>
        <td class="formLeft" valign="top"><?php echo $lang['edit_News_Summary']; ?></td>
        <td class="formRight"><textarea name="summary" cols="80" rows="2" maxlength="140"><?php echo ReadDB($News["summary"]); ?></textarea></td>
      </tr>      
      <tr>
        <td class="formLeft" valign="top"><?php echo $lang['edit_News_Content']; ?></td>
        <td class="formRight">
        	<textarea name="content" id="content" class="content" cols="85" rows="20"><?php echo ReadDB($News["content"]); ?></textarea>
           	<script type="text/javascript">
				CKEDITOR.replace( 'content',
                {	
					
					filebrowserBrowseUrl : 'ckeditor/kcfinder/browse.php?opener=ckeditor&type=files',
                    filebrowserImageBrowseUrl : 'ckeditor/kcfinder/browse.php?opener=ckeditor&type=images',
                    filebrowserFlashBrowseUrl : 'ckeditor/kcfinder/browse.php?opener=ckeditor&type=flash',
					filebrowserUploadUrl  :'ckeditor/kcfinder/upload.php?opener=ckeditor&type=files',
					filebrowserImageUploadUrl : 'ckeditor/kcfinder/upload.php?opener=ckeditor&type=images',
					filebrowserFlashUploadUrl : 'ckeditor/kcfinder/upload.php?opener=ckeditor&type=flash',
									
					height: 400, width: '98%'

				});
			</script>     
        </td>
      </tr>      
      <tr>
        <td class="formLeft"><?php echo $lang['edit_News_Photo']; ?></td>
        <td class="formRight">
        <?php if(ReadDB($News["image"]) != "") { ?>
			<img src="<?php echo $CONFIG["upload_folderNL"].ReadDB($News["image"]); ?>" border="0" width="160" /> 			&nbsp;&nbsp;<a href="<?php $_SERVER["PHP_SELF"]; ?>?act=delImage&id=<?php echo $News["id"]; ?>"><?php echo $lang['edit_News_delete']; ?></a><br /> 
            <?php echo $lang['edit_News_If_you_upload']; ?> <br />
            <?php } ?>
          	<input type="file" name="image" size="70" /> <sub><?php echo $lang['edit_News_Limit_2Mb']; ?></sub>
        </td>
      </tr>       
      <tr>
        <td class="formLeft"><?php echo $lang['edit_News_Caption']; ?></td>
        <td class="formRight"><input type="text" name="caption" size="50" maxlength="100" value="<?php echo ReadHTML($News["caption"]); ?>" /></td>
      </tr>
      <tr>
        <td class="formLeft"><?php echo $lang['edit_News_Image_location_in_the_text']; ?></td>
        <td class="formRight">
        	<select name="imgpos">
                <option value="top"<?php if($News["imgpos"]=='top') echo ' selected="selected"' ?>>top</option>
            	<option value="left"<?php if($News["imgpos"]=='left') echo ' selected="selected"' ?>>left</option>
                <option value="right"<?php if($News["imgpos"]=='right') echo ' selected="selected"' ?>>right</option>
                <option value="bottom"<?php if($News["imgpos"]=='bottom') echo ' selected="selected"' ?>>bottom</option>
            </select>
        </td>
      </tr>  
      <tr>
        <td class="formLeft"><?php echo $lang['edit_News_Publish_date']; ?></td>
        <td class="formRight">
      		<input type="text" name="publish_date" id="publish_date" maxlength="25" size="25" value="<?php echo $News["publish_date"]; ?>" readonly /> <a href="javascript:NewCssCal('publish_date','yyyymmdd','dropdown',true,24,false)"><img src="images/cal.gif" width="16" height="16" alt="Pick a date" border="0" ></a>
        </td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td class="formRight">
        	<input name="submit" type="submit" value="<?php echo $lang['edit_News_Update_News']; ?>" class="submitButton" /> &nbsp; &nbsp; &nbsp; &nbsp; 
        	<input name="updatepreview" type="submit" value="<?php echo $lang['edit_News_Update_and_Preview']; ?>" class="submitButton" />
        </td>
      </tr>
  	</table>
	</form>
    
    
<?php 
} elseif ($_REQUEST["act"]=='viewNews') {
	
	$_REQUEST["id"]= (int) SafetyDBNL($_REQUEST["id"]);
	
	$sql = "SELECT * FROM ".$TABLE["Options"];
	$sql_result = sql_resultNL($sql);
	$Options = mysqli_fetch_assoc($sql_result);
	mysqli_free_result($sql_result);
	$OptionsVis = unserialize($Options['visual']);
	$OptionsLang = unserialize(base64_decode($Options['language']));
	
	$sql = "SELECT * FROM ".$TABLE["News"]." WHERE id='".$_REQUEST["id"]."'";
	$editCommand = "editNews";
	$backLinkValie = "news";
	
	$sql_result = sql_resultNL($sql);
	$News = mysqli_fetch_assoc($sql_result);
		// fetch post category
		$sqlCat   = "SELECT * FROM ".$TABLE["Categories"]." WHERE `id`='".$News["cat_id"]."'";
		$sql_resultCat = sql_resultNL($sqlCat);
		$Cat = mysqli_fetch_array($sql_resultCat);
?>
	<script src="lightbox/js/lightbox.min.js"></script>
	<link href="lightbox/css/lightbox.css" rel="stylesheet" />
    <?php include ("styles/css_front_end.php");?>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    
	<div style="clear:both;padding-left:40px;padding-top:10px;padding-bottom:10px;"><a href="admin.php?act=<?php echo $editCommand; ?>&id=<?php echo ReadDB($News['id']); ?>"><?php echo $lang['Preview_News_Edit_Article']; ?></a></div>
    
	<div class="front_wrapper">
    
    <!-- news title -->    
    <div class="news_title">	  
		<?php echo ReadDB($News["title"]); ?>     
    </div>
    
    <div class="dist_title_date"></div>    
    
    <?php if($OptionsVis["show_date"]!='no' or $OptionsVis["show_aa"]!='no' or $OptionsVis["showhits"]!='no' or $OptionsVis["show_cat"]!='no') { ?>
    <div class="date_style">
    	<?php if($Cat["id"]>0 and $OptionsVis["show_cat"]!='no') echo "<span class='catLine'><a href='#'>".$Cat["cat_name"]."</a></span> &nbsp;<span class='straightLine'>|</span>&nbsp; "; ?>
		<?php if($OptionsVis["show_date"]!='no') { ?> 
        	<i class="material-icons">&#xe924;</i>       
            <?php echo lang_date(date($OptionsVis["date_format"],strtotime($News["publish_date"]))); ?> 
            <?php if($OptionsVis["showing_time"]!='') echo date($OptionsVis["showing_time"],strtotime($News["publish_date"])); ?>
        <?php } ?>    
        <?php if($OptionsVis["showhits"]!='no') { ?> 
        	<?php if($OptionsVis["show_date"]!='no') { ?>       
            &nbsp;<span class='straightLine'>|</span>&nbsp; 
			<?php } ?> 
			<?php echo ReadDB($OptionsLang["Article_Hits"]); ?> <?php echo $News["reviews"]; ?>
        <?php } ?>   
    	<?php if($OptionsVis["show_aa"]!='no') { ?>
    	 	&nbsp;<span class='straightLine'>|</span>&nbsp; <a href="javascript:ts('content',+1)">A<sup>+</sup></a> | <a href="javascript:ts('content',-1)">a<sup>-</sup></a>
        <?php } ?>        
    </div>
    <?php } ?>
    
    <?php if($OptionsVis["show_share_this_top"]=='yes') { ?>
    <div class="share_buttons">
        <!-- Go to www.addthis.com/dashboard to customize your tools -->
        <script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-53a185413dedbffa"></script>
        <div class="addthis_sharing_toolbox"></div>
    </div>
    <?php } ?>
    
    <div class="dist_date_text"></div>
    
    <!-- news text --> 
    <div class="news_text">
    
      <?php if(ReadDB($News["image"])!='') { ?>
      
		<?php if(ReadDB($News["imgpos"])=='left') { /// if image is on the left in content /// ?>
        <div class="img_left">
        	<a href="<?php echo $CONFIG["full_url"].$CONFIG["upload_folderNL"].ReadDB($News["image"]); ?>" rel="lightbox[]" title="<?php echo ReadHTML($News["caption"]); ?>">
        		<img src="<?php echo $CONFIG["full_url"].$CONFIG["upload_folderNL"].ReadDB($News["image"]); ?>" alt="<?php echo ReadHTML($News["caption"]); ?>" />
            </a>
            <?php if(trim($News["caption"]!='')) {?>          
            <div class="imgCaptionWrap"><div class="img_caption"><?php echo ReadDB($News["caption"]); ?></div></div>
            <?php }?>
        </div>
		<?php } ?>
        
        <?php if(ReadDB($News["imgpos"])=='right') { /// if image is on the left in content /// ?>
        <div class="img_right">
        	<a href="<?php echo $CONFIG["full_url"].$CONFIG["upload_folderNL"].ReadDB($News["image"]); ?>" rel="lightbox[]" title="<?php echo ReadHTML($News["caption"]); ?>">
        		<img src="<?php echo $CONFIG["full_url"].$CONFIG["upload_folderNL"].ReadDB($News["image"]); ?>" alt="<?php echo ReadHTML($News["caption"]); ?>" />
            </a> 
            <?php if(trim($News["caption"]!='')) {?>           
            <div class="imgCaptionWrap"><div class="img_caption"><?php echo ReadDB($News["caption"]); ?></div>
            </div>
            <?php }?>
        </div>
		<?php } ?>
        
        <?php if(ReadDB($News["imgpos"])=='top') { /// if image is on the top of content /// ?>
        <div class="img_top">
        	<a href="<?php echo $CONFIG["full_url"].$CONFIG["upload_folderNL"].ReadDB($News["image"]); ?>" rel="lightbox[]" title="<?php echo ReadHTML($News["caption"]); ?>">
        		<img src="<?php echo $CONFIG["full_url"].$CONFIG["upload_folderNL"].ReadDB($News["image"]); ?>" alt="<?php echo ReadHTML($News["caption"]); ?>" />
            </a>    
            <?php if(trim($News["caption"]!='')) {?>           
             <div class="imgCaptionWrap"><div class="img_caption"><?php echo ReadDB($News["caption"]); ?></div></div>
            <?php }?>
        </div>
		<?php } ?>
      <?php } /// end of image if statement for images left, right and top /// ?>
      
        <span id="content"><?php echo ReadDB($News["content"]); ?> </span>
        
      <?php if(ReadDB($News["image"])!='') { ?>
        <?php if(ReadDB($News["imgpos"])=='bottom') { /// if image is at the bottom of content /// ?>
        <div class="img_bottom">
        	<a href="<?php echo $CONFIG["full_url"].$CONFIG["upload_folderNL"].ReadDB($News["image"]); ?>" rel="lightbox[]" title="<?php echo ReadHTML($News["caption"]); ?>">
        		<img src="<?php echo $CONFIG["full_url"].$CONFIG["upload_folderNL"].ReadDB($News["image"]); ?>" alt="<?php echo ReadHTML($News["caption"]); ?>" />
            </a> 
            <?php if(trim($News["caption"]!='')) {?>            
            <div class="imgCaptionWrap"><div class="img_caption"><?php echo ReadDB($News["caption"]); ?></div></div>
            <?php } ?>
        </div>
		<?php } ?>
        
      <?php } /// end of image if statement for image at the bottom /// ?>
    </div>
    
    <div style="clear:both; height: 12px;"></div>
    </div>
    
    
<?php 
} elseif ($_REQUEST["act"]=='cats') {
	
	if(isset($_REQUEST["p"]) and $_REQUEST["p"]!='') { 
		$pageNum = (int) SafetyDBNL(urldecode($_REQUEST["p"]));
		if($pageNum<=0) $pageNum = 1;
	} else { 
		$pageNum = 1;
	}
	
	$orderByArr = array("cat_name");
	if(isset($_REQUEST["orderBy"]) and $_REQUEST["orderBy"]!='' and in_array($_REQUEST["orderBy"], $orderByArr)) { 
		$orderBy = $_REQUEST["orderBy"];
	} else { 
		$orderBy = "cat_name";
	}	
	
    $orderTypeArr = array("DESC", "ASC");	
    if(isset($_REQUEST["orderType"]) and $_REQUEST["orderType"]!='' and in_array($_REQUEST["orderType"], $orderTypeArr)) { 
		$orderType = $_REQUEST["orderType"];
	} else {
		$orderType = "ASC";
	}
	if ($orderType == 'DESC') { $norderType = 'ASC'; } else { $norderType = 'DESC'; }
?>
	<div class="pageDescr"><?php echo $lang['Category_Below_is_a_list']; ?></div>
        
	<table border="0" cellspacing="0" cellpadding="8" class="allTables">
  	  <tr>
        <td width="33%" class="headlist"><a href="admin.php?act=cats&orderType=<?php echo $norderType; ?>&orderBy=cat_name"><?php echo $lang['Category_Category']; ?></a></td>
        <td width="33%" class="headlist"><?php echo $lang['Category_Put_this_category']; ?></td>
        <td class="headlist" colspan="2">&nbsp;</td>
  	  </tr>
      
  	<?php 
	$sql   = "SELECT count(*) as total FROM ".$TABLE["Categories"];
	$sql_result = sql_resultNL($sql);
	$row   = mysqli_fetch_array($sql_result);
	$count = $row["total"];
	$pages = ceil($count/100);

	$sql = "SELECT * FROM ".$TABLE["Categories"]."   
			ORDER BY " . $orderBy . " " . $orderType."  
			LIMIT " . ($pageNum-1)*100 . ",100";
	$sql_result = sql_resultNL($sql);
	
	if (mysqli_num_rows($sql_result)>0) {	
		while ($Cat = mysqli_fetch_assoc($sql_result)) {			
	?>
  	  <tr>
        <td class="bodylist"<?php if($Cat["cat_show"]=="no") echo "style='color:gray;'"; ?>><?php echo ReadDB($Cat["cat_name"]); ?></td>
        <td class="bodylist"><?php if($Cat["cat_show"]!="no") { ?><a href='admin.php?act=HTML_Cat&id=<?php echo $Cat["id"]; ?>'><?php echo $lang['Category_Copy_the_code']; ?></a><?php } ?></td>
        <td class="bodylistAct"><a href='admin.php?act=editCat&id=<?php echo $Cat["id"]; ?>' title="Edit"><img class="act" src="images/edit.png" alt="Edit" /></a></td>
        <td class="bodylistAct"><a class="delete" href="admin.php?act=delCat&id=<?php echo $Cat["id"]; ?>" onclick="return confirm('Are you sure you want to delete it?');" title="DELETE"><img class="act" src="images/delete.png" alt="DELETE" /></a></td>
  	  </tr>
  	<?php 
		}
	} else {
	?>
      <tr>
      	<td colspan="8" class="borderBottomList"><?php echo $lang['Category_No_Categories']; ?></td>
      </tr>
    <?php	
	}
	?>
    
	<?php
    if ($pages>1) {
    ?>
  	  <tr>
      	<td colspan="8" class="bottomlist"><div class='paging'><?php echo $lang['Category_Page']; ?> </div>
		<?php
        for($i=1;$i<=$pages;$i++){ 
            if($i == $pageNum ) echo "<div class='paging'>" .$i. "</div>";
            else echo "<a href='admin.php?act=cats&p=".$i."' class='paging'>".$i."</a>"; 
            echo "&nbsp; ";
        }
        ?>
      	</td>
      </tr>
	<?php
    }
    ?>
	</table>


<?php 
} elseif ($_REQUEST["act"]=='newCat') { 
?>
	<form action="admin.php" method="post" name="form">
        <input type="hidden" name="act" value="addCat" />
        <div class="pageDescr"><?php echo $lang['Category_To_create_Category']; ?></div>
        <table border="0" cellspacing="0" cellpadding="8" class="fieldTables">
          <tr>
            <td colspan="2" valign="top" class="headlist"><?php echo $lang['Category_Create_Category']; ?></td>
          </tr>
          
          <tr>
            <td class="formLeft"><?php echo $lang['Category_Category_name']; ?></td>
            <td class="formRight">
            	<input type="text" name="cat_name" size="40" maxlength="50" />
                
                &nbsp;&nbsp;&nbsp;
                Show it: 
                <select name="cat_show"> 
                    <option value="yes">yes</option>
                    <option value="no">no</option>
               	</select>
            </td>
          </tr>      
                
          <tr>
            <td>&nbsp;</td>
            <td class="formRight"><input name="submit" type="submit" value="<?php echo $lang['Category_Create_Category_but']; ?>" class="submitButton" /></td>
          </tr>
        </table>
	</form>
    
<?php 
} elseif ($_REQUEST["act"]=='editCat') {
	$sql = "SELECT * FROM ".$TABLE["Categories"]." WHERE id='".$_REQUEST["id"]."'";
	$sql_result = sql_resultNL($sql);
	$Cat = mysqli_fetch_assoc($sql_result);	
?>
	<form action="admin.php" method="post" name="form">
        <input type="hidden" name="act" value="updateCat" />
        <input type="hidden" name="id" value="<?php echo $Cat["id"]; ?>" />
        <div class="pageDescr"><?php echo $lang['Category_change_details']; ?></div>
        <table border="0" cellspacing="0" cellpadding="8" class="fieldTables">
          <tr>
            <td colspan="2" valign="top" class="headlist"><?php echo $lang['Category_Edit_Category']; ?></td>
          </tr>
           
          <tr>
            <td class="formLeft"><?php echo $lang['Category_Category_name_edit']; ?></td>
            <td class="formRight">
            	<input type="text" name="cat_name" size="40" maxlength="50" value="<?php echo ReadHTML($Cat["cat_name"]); ?>" />
                
                &nbsp;&nbsp;&nbsp;
                Show it: 
                <select name="cat_show"> 
                    <option value="yes"<?php if ($Cat["cat_show"]=='yes') echo ' selected="selected"'; ?>>yes</option>
                    <option value="no"<?php if ($Cat["cat_show"]=='no') echo ' selected="selected"'; ?>>no</option>
               	</select>
                
                </td>
          </tr>
          
          <tr>
            <td>&nbsp;</td>
            <td class="formRight">
                <input name="submit" type="submit" value="<?php echo $lang['Category_Update_Category']; ?>" class="submitButton" />
            </td>
          </tr>
        </table>
	</form>


<?php 
} elseif ($_REQUEST["act"]=='HTML_Cat') { 
	$sql = "SELECT * FROM ".$TABLE["Categories"]." WHERE id='".$_REQUEST["id"]."'";
	$sql_result = sql_resultNL($sql);
	$Cat = mysqli_fetch_assoc($sql_result);	
?>
	
    <div style="clear:both; padding-top: 20px;">
    
    <div class="pageDescr">There is one easy way to put <strong>'<?php echo $Cat['cat_name']; ?>'</strong> category on your webpage.</div> 
        
    <table border="0" cellspacing="0" cellpadding="8" class="allTables">
    
      <tr>
        <td class="copycode"><strong>Using PHP include()</strong> - you can use a PHP include() in any of your PHP pages. Edit your .php page and put the code below where you want the news to be.</td>
      </tr>
      
      <tr>
        <td class="putonwebpage">        	
        	<div class="divCode">&lt;?php $_REQUEST['cat_id']=<?php echo $_REQUEST["id"]; ?>; $_REQUEST['hide_cat']='yes'; include(&quot;<?php echo $CONFIG["server_path"]; ?>news.php&quot;); ?&gt; </div>     
        </td>
      </tr>
            
    </table>
    
    </div>


<?php 
} elseif ($_REQUEST["act"]=='sendNewsletter') {
	
	if(isset($_REQUEST["cat_id"]) and $_REQUEST["cat_id"]!='') { 
		$_REQUEST["cat_id"] = (int) SafetyDBNL($_REQUEST["cat_id"]);
	} else {
		$_REQUEST["cat_id"] = ''; 
	}
	
	$_REQUEST["id"]= (int) SafetyDBNL($_REQUEST["id"]);
	
	$sql = "SELECT * FROM ".$TABLE["News"]." WHERE id='".$_REQUEST["id"]."'";
	$sql_result = sql_resultNL($sql);
	$News = mysqli_fetch_assoc($sql_result);
	mysqli_free_result($sql_result);
?>
	<form action="admin.php" method="post" name="form" enctype="multipart/form-data">
  	<input type="hidden" name="act" value="sendToSubscribers" />
  	<input type="hidden" name="id" value="<?php echo $News["id"]; ?>" />
  	<input type="hidden" name="cat_id" value="<?php echo $_REQUEST["cat_id"]; ?>" />
  	<div class="pageDescr"><?php echo $lang['Send_NewsLetter_To_send_newsletter']; ?></div>
	<table border="0" cellspacing="0" cellpadding="8" class="fieldTables">
      <tr>
      	<td colspan="2" valign="top" class="headlist"><?php echo $lang['Send_NewsLetter']; ?></td>
      </tr>
      <tr>
        <td class="formLeft"><?php echo $lang['Send_NewsLetter_News_Title']; ?></td>
        <td class="formRight"><div style="float:left;"><strong><?php echo ReadHTML($News["title"]); ?></strong> </div>
        
        
        <div class="filterForm" style="float:right;"><?php echo $lang['Send_Choose_Categ']; ?>
        <select name="cat_id" onchange="window.location.href='admin.php?act=sendNewsletter&id=<?php echo $News["id"]; ?>&cat_id='+this.value">
            <option value="0"><?php echo $lang['Send_List_ALL']; ?></option>
            <?php 		
            $sql = "SELECT * FROM ".$TABLE["Categories"]." ORDER BY cat_name ASC";
            $sql_result = sql_resultNL($sql);
            while ($Cat = mysqli_fetch_assoc($sql_result)) { ?>
            <option value="<?php echo $Cat["id"]; ?>"<?php if ($Cat["id"]==$_REQUEST["cat_id"]) echo ' selected="selected"'?>><?php echo ReadDB($Cat["cat_name"]); ?></option>
            <?php } ?>  
            
            <option value="9999"<?php if ($Cat["id"]==$_REQUEST["cat_id"]) echo ' selected="selected"'?>>Test</option>
                 
        </select>
        </div>
        
        </td>
      </tr>
      <tr>
      	<td class="formLeft" valign="top"><?php echo $lang['Send_NewsLetter_Choose_Emails']; ?> <br /><br />
            <span style="font-style:italic; font-size:11px;"><?php echo $lang['Send_NewsLetter_Choose_Emails_description']; ?></span>
        </td>
      	<td class="formRight">
        <select name="subscribers[]" size="12" multiple="multiple" class="subscribers_select">
        	<option value="0">All Subscribed Emails</option>
            <?php 
			if(isset($_REQUEST["cat_id"]) and $_REQUEST["cat_id"]>0) {
				$searchCatId = " AND `cat_id`='".$_REQUEST["cat_id"]."' ";
			} else {
				$searchCatId = "";
			}
			
			$sql = "SELECT * FROM ".$TABLE["Subscribers"]." 
					WHERE `status`='active' ".$searchCatId." 
					ORDER BY subscribe_date DESC";
			$sql_result = sql_resultNL($sql);
			while ($Subscriber = mysqli_fetch_assoc($sql_result)) {	?>
          	<option value="<?php echo $Subscriber["id"]; ?>"><?php echo ReadHTML($Subscriber["email"]); ?></option>
            <?php } ?>
        </select>
      	</td>
      </tr>
            
      <tr>
        <td>&nbsp;</td>
        <td class="formRight">
        	<input name="submit" type="submit" value="<?php echo $lang['Send_NewsLetter_Button']; ?>" class="submitButton" />
        </td>
      </tr>
  	</table>
	</form>    
    
    
<?php 
} elseif ($_REQUEST["act"]=='subscribers') {
	
	if(isset($_REQUEST["search"]) and $_REQUEST["search"]!='') {
		$_REQUEST["search"] = htmlspecialchars(urldecode($_REQUEST["search"]), ENT_QUOTES);
	} else { 
		$_REQUEST["search"] = ''; 
	}
	
	if(isset($_REQUEST["p"]) and $_REQUEST["p"]!='') { 
		$pageNum = (int) SafetyDBNL(urldecode($_REQUEST["p"]));
		if($pageNum<=0) $pageNum = 1;
	} else { 
		$pageNum = 1;
	}
	
	$orderByArr = array("email", "name", "status", "subscribe_date", "receive_to", "cat_id");
	if(isset($_REQUEST["orderBy"]) and $_REQUEST["orderBy"]!='' and in_array($_REQUEST["orderBy"], $orderByArr)) { 
		$orderBy = $_REQUEST["orderBy"];
	} else { 
		$orderBy = "email";
	}	
	
    $orderTypeArr = array("DESC", "ASC");	
    if(isset($_REQUEST["orderType"]) and $_REQUEST["orderType"]!='' and in_array($_REQUEST["orderType"], $orderTypeArr)) { 
		$orderType = $_REQUEST["orderType"];
	} else {
		$orderType = "ASC";
	}
	if ($orderType == 'DESC') { $norderType = 'ASC'; } else { $norderType = 'DESC'; }
	
	
	$sqlActive   = "SELECT id FROM ".$TABLE["Subscribers"]." WHERE status='active'";
	$sql_resultActive = sql_resultNL($sqlActive);
	$SubsActive = mysqli_num_rows($sql_resultActive);
	
	$sqlCount   = "SELECT id FROM ".$TABLE["Subscribers"];
	$sql_resultCount = sql_resultNL($sqlCount);
	$SubsCount = mysqli_num_rows($sql_resultCount);
?>
	<div class="pageDescr"><?php echo $lang['Subscribers_Below_is_a_list']; ?> <strong style="font-size:16px"><?php echo $SubsActive; ?></strong> <?php echo $lang['Subscribers_active_inactive']; ?> <strong style="font-size:16px"><?php echo ($SubsCount-$SubsActive); ?></strong><?php echo $lang['Subscribers_total_subscr']; ?><strong style="font-size:16px"><?php echo $SubsCount; ?></strong>.</div>
    
    <div class="searchForm">    
    <form action="admin.php?act=subscribers" method="post" name="form" class="formStyle">
      <input type="text" name="search" value="<?php echo $_REQUEST["search"]; ?>" class="searchfield" placeholder="enter subscriber's name or email" />
      <input type="submit" value="<?php echo $lang['Subscribers_Search_Button']; ?>" class="submitButton" />
    </form>
	</div>
        
	<table border="0" cellspacing="0" cellpadding="8" class="allTables">
  	  <tr>
        <td class="headlist"><a href="admin.php?act=subscribers&orderType=<?php echo $norderType; ?>&orderBy=email"><?php echo $lang['Subscribers_Email']; ?></a></td>
        <td width="15%" class="headlist"><a href="admin.php?act=subscribers&orderType=<?php echo $norderType; ?>&orderBy=name"><?php echo $lang['Subscribers_Name']; ?></a></td>
        <td width="23%" class="headlist"><a href="admin.php?act=subscribers&orderType=<?php echo $norderType; ?>&search=<?php echo urlencode($_REQUEST["search"]); ?>&orderBy=cat_id"><?php echo $lang['List_Category']; ?></a></td>
        <td width="6%" class="headlist"><a href="admin.php?act=subscribers&orderType=<?php echo $norderType; ?>&orderBy=status"><?php echo $lang['Subscribers_Status']; ?></a></td>
        <td width="14%" class="headlist"><a href="admin.php?act=subscribers&orderType=<?php echo $norderType; ?>&orderBy=subscribe_date"><?php echo $lang['Subscribers_Date']; ?></a></td>
        <td width="14%" class="headlist"><a href="admin.php?act=subscribers&orderType=<?php echo $norderType; ?>&orderBy=receive_to"><?php echo $lang['Subscribers_Unsub_Date']; ?></a></td>
        <td class="headlist" colspan="2">&nbsp;</td>
  	  </tr>
      
  	<?php 
	$search = '';
	if(isset($_REQUEST["search"]) and ($_REQUEST["search"]!="")) {
		$find = SafetyDBNL($_REQUEST["search"]);
		$search .= "WHERE (name LIKE '%".$find."%' OR email LIKE '%".$find."%')";
	}
	
	
	$sql   = "SELECT count(*) as total FROM ".$TABLE["Subscribers"]." ".$search;
	$sql_result = sql_resultNL($sql);
	$row   = mysqli_fetch_array($sql_result);
	$count = $row["total"];
	$pages = ceil($count/100);

	$sql = "SELECT * FROM ".$TABLE["Subscribers"]." ".$search." 
			ORDER BY " . $orderBy . " " . $orderType."  
			LIMIT " . ($pageNum-1)*100 . ",100";
	$sql_result = sql_resultNL($sql);
	
	if (mysqli_num_rows($sql_result)>0) {	
		while ($Subscriber = mysqli_fetch_assoc($sql_result)) {			
	?>
  	  <tr>
        <td class="bodylist"><?php echo ReadDB($Subscriber["email"]); ?></td>
        <td class="bodylist"><?php echo ReadDB($Subscriber["name"]); ?></td>
        <td class="bodylist">
        	<?php 
			$sqlCat = "SELECT * FROM ".$TABLE["Categories"]." WHERE id='".$Subscriber["cat_id"]."'";
			$sql_resultCat = sql_resultNL($sqlCat);
			$Cat = mysqli_fetch_assoc($sql_resultCat);	
			if($Cat["id"]>0) echo ReadDB($Cat["cat_name"]); else echo "------"; ?>
        </td>
        <td class="bodylist"><?php echo ReadDB($Subscriber["status"]); ?></td>
        <td class="bodylist"><?php echo admin_date($Subscriber["subscribe_date"]); ?></td>
        <td class="bodylist"><?php echo trim($Subscriber["receive_to"])!='' ? admin_date($Subscriber["receive_to"]) : "" ; ?></td>
        <td class="bodylistAct"><a href='admin.php?act=editSubscriber&id=<?php echo $Subscriber["id"]; ?>' title="Edit"><img class="act" src="images/edit.png" alt="Edit" /></a></td>
        <td class="bodylistAct"><a class="delete" href="admin.php?act=delSubscriber&id=<?php echo $Subscriber["id"]; ?>" onclick="return confirm('Are you sure you want to delete it?');" title="DELETE"><img class="act" src="images/delete.png" alt="DELETE" /></a></td>
  	  </tr>
  	<?php 
		}
	} else {
	?>
      <tr>
      	<td colspan="8" class="borderBottomList"><?php echo $lang['Subscribers_No_Subscribers']; ?></td>
      </tr>
    <?php	
	}
	?>
    
	<?php
    if ($pages>1) {
    ?>
  	  <tr>
      	<td colspan="8" class="bottomlist"><div class='paging'><?php echo $lang['Subscribers_Page']; ?> </div>
		<?php
        for($i=1;$i<=$pages;$i++){ 
            if($i == $pageNum ) echo "<div class='paging'>" .$i. "</div>";
            else echo "<a href='admin.php?act=subscribers&p=".$i."&search=".$_REQUEST["search"]."&amp;orderBy=".$_REQUEST["orderBy"]."&amp;orderType=".$_REQUEST["orderType"]."' class='paging'>".$i."</a>"; 
            echo "&nbsp; ";
        }
        ?>
      	</td>
      </tr>
	<?php
    }
    ?>
	</table>


<?php 
} elseif ($_REQUEST["act"]=='newSubscriber') { 
	$sql = "SELECT * FROM ".$TABLE["Options"];
	$sql_result = sql_resultNL($sql);
	$Options = mysqli_fetch_assoc($sql_result);
	mysqli_free_result($sql_result);
	$OptionsVis = unserialize($Options['visual']);
?>
	<form action="admin.php" method="post" name="form">
  	<input type="hidden" name="act" value="addSubscriber" />
  	<div class="pageDescr"><?php echo $lang['Subscriber_Add_To_add_subscriber']; ?></div>
	<table border="0" cellspacing="0" cellpadding="8" class="fieldTables">
      <tr>
      	<td colspan="2" valign="top" class="headlist"><?php echo $lang['Subscriber_Add_Subscriber']; ?></td>
      </tr>
      <tr>
      	<td class="formLeft"><?php echo $lang['Subscriber_Add_Status']; ?></td>
      	<td class="formRight">
        <select name="status">
          <option value="active"><?php echo $lang['Subscriber_Add_active']; ?></option>
          <option value="inactive"><?php echo $lang['Subscriber_Add_inactive']; ?></option>
        </select>
      	</td>
      </tr>  <tr>
      	<td class="formLeft"><?php echo $lang['Subscriber_Add_Category']; ?> </td>
      	<td class="formRight">
        	<select name="cat_id">
            	<!--- <option value="0">---------</option> --->
			<?php
            $sql = "SELECT * FROM ".$TABLE["Categories"]." ORDER BY cat_name ASC";
            $sql_result = sql_resultNL($sql);
            if (mysqli_num_rows($sql_result)>0) {
              while ($Cat = mysqli_fetch_assoc($sql_result)) {
            ?>
         		<option value="<?php echo $Cat["id"]; ?>"><?php echo ReadDB($Cat["cat_name"]); ?></option>
            <?php
			  }
			} 
			?>
      		</select>
		</td>
      </tr>    
      <tr>
        <td class="formLeft"><?php echo $lang['Subscriber_Add_Email']; ?></td>
        <td class="formRight"><input type="text" name="email" size="60" maxlength="250" /></td>
      </tr>      
      <tr>
        <td class="formLeft"><?php echo $lang['Subscriber_Add_Name']; ?></td>
        <td class="formRight"><input type="text" name="name" size="60" maxlength="250" /></td>
      </tr>       
      <tr>
        <td class="formLeft"><?php echo $lang['Subscriber_Add_Address']; ?></td>
        <td class="formRight"><input type="text" name="address" size="60" maxlength="250" /></td>
      </tr>       
      <tr>
        <td class="formLeft"><?php echo $lang['Subscriber_Add_Zip']; ?></td>
        <td class="formRight"><input type="text" name="zip_code" size="60" maxlength="250" /></td>
      </tr>  
      <tr>
        <td class="formLeft"><?php echo $lang['Subscriber_Add_date']; ?></td>
        <td class="formRight">
      		<input type="text" name="subscribe_date" id="subscribe_date" maxlength="25" size="25" value="<?php echo date("Y-m-d H:i:s"); ?>" readonly /> <a href="javascript:NewCssCal('subscribe_date','yyyymmdd','dropdown',true,24,false)"><img src="images/cal.gif" width="16" height="16" alt="Pick a date" border="0" ></a>
        </td>
      </tr>                 
      <tr>
        <td>&nbsp;</td>
        <td class="formRight"><input name="submit" type="submit" value="<?php echo $lang['Subscriber_Add_button']; ?>" class="submitButton" /></td>
      </tr>
  	</table>
	</form>
    
<?php 
} elseif ($_REQUEST["act"]=='editSubscriber') {
	
	$_REQUEST["id"]= (int) SafetyDBNL($_REQUEST["id"]);
	
	$sql = "SELECT * FROM ".$TABLE["Subscribers"]." WHERE id='".$_REQUEST["id"]."'";
	$sql_result = sql_resultNL($sql);
	$Subscriber = mysqli_fetch_assoc($sql_result);	
	mysqli_free_result($sql_result);
?>
	<form action="admin.php" method="post" name="form">
  	<input type="hidden" name="act" value="updateSubscriber" />
  	<input type="hidden" name="id" value="<?php echo $Subscriber["id"]; ?>" />
  	<div class="pageDescr"><?php echo $lang['Subscriber_Edit_To_edit_subscriber']; ?></div>
	<table border="0" cellspacing="0" cellpadding="8" class="fieldTables">
      <tr>
      	<td colspan="2" valign="top" class="headlist"><?php echo $lang['Subscriber_Edit_Subscriber']; ?></td>
      </tr>      
      <tr>
      	<td class="formLeft"><?php echo $lang['Subscriber_Edit_Status']; ?></td>
      	<td class="formRight">
        <select name="status">
          <option value="active"<?php if ($Subscriber["status"]=='active') echo ' selected="selected"'; ?>><?php echo $lang['Subscriber_Edit_active']; ?></option>
          <option value="inactive"<?php if ($Subscriber["status"]=='inactive') echo ' selected="selected"'; ?>><?php echo $lang['Subscriber_Edit_inactive']; ?></option>
        </select>
      	</td>
      </tr>
      <tr>
      	<td class="formLeft"><?php echo $lang['Subscriber_Edit_Category']; ?> </td>
      	<td class="formRight">
        	<select name="cat_id">
            	<!--- <option value="0">---------</option> --->
			<?php
            $sql = "SELECT * FROM ".$TABLE["Categories"]." ORDER BY cat_name ASC";
            $sql_result = sql_resultNL($sql);
            if (mysqli_num_rows($sql_result)>0) {
              while ($Cat = mysqli_fetch_assoc($sql_result)) {
            ?>
         		<option value="<?php echo $Cat["id"]; ?>"<?php if($Cat["id"]==$Subscriber["cat_id"]) echo ' selected="selected"'; ?>><?php echo ReadDB($Cat["cat_name"]); ?></option>
            <?php
			  }
			} 
			?>
      		</select>
		</td>
      </tr>    
      <tr>
        <td class="formLeft"><?php echo $lang['Subscriber_Edit_Email']; ?></td>
        <td class="formRight"><input type="text" name="email" size="60" maxlength="250" value="<?php echo ReadHTML($Subscriber["email"]); ?>" /></td>
      </tr>      
      <tr>
        <td class="formLeft"><?php echo $lang['Subscriber_Edit_Name']; ?></td>
        <td class="formRight"><input type="text" name="name" size="60" maxlength="250" value="<?php echo ReadHTML($Subscriber["name"]); ?>" /></td>
      </tr>         
      <tr>
        <td class="formLeft"><?php echo $lang['Subscriber_Edit_Address']; ?></td>
        <td class="formRight"><input type="text" name="address" size="60" maxlength="250" value="<?php echo ReadHTML($Subscriber["address"]); ?>" /></td>
      </tr>         
      <tr>
        <td class="formLeft"><?php echo $lang['Subscriber_Edit_Zip']; ?></td>
        <td class="formRight"><input type="text" name="zip_code" size="60" maxlength="250" value="<?php echo ReadHTML($Subscriber["zip_code"]); ?>" /></td>
      </tr>    
      <tr>
        <td class="formLeft"><?php echo $lang['Subscriber_Edit_date']; ?></td>
        <td class="formRight">
      		<input type="text" name="subscribe_date" id="subscribe_date" maxlength="25" size="25" value="<?php echo $Subscriber["subscribe_date"]; ?>" readonly /> <a href="javascript:NewCssCal('subscribe_date','yyyymmdd','dropdown',true,24,false)"><img src="images/cal.gif" width="16" height="16" alt="Pick a date" border="0" ></a>
        </td>
      </tr>     
      
      <tr>
        <td>&nbsp;</td>
        <td class="formRight">
        	<input name="submit" type="submit" value="<?php echo $lang['Subscriber_Edit_button']; ?>" class="submitButton" />
        </td>
      </tr>
  	</table>
	</form>


<?php 
} elseif ($_REQUEST["act"]=='newSubscrCSV') { 
?>
  <form action="admin.php" method="post" name="form" enctype="multipart/form-data">
  	<input type="hidden" name="act" value="addSubscrCSV" />
  	<div class="pageDescr"><?php echo $lang['Subscriber_Add_CSV']; ?></div>
	<table border="0" cellspacing="0" cellpadding="8" class="fieldTables">
      <tr>
      	<td colspan="4" valign="top" class="headlist"><?php echo $lang['Subscriber_Add_Subscriber']; ?></td>
      </tr>
           
      <tr>
        <td class="formLeft"><?php echo $lang['Subscriber_Add_CSV_file']; ?></td>
        <td class="formRight"><input type="file" name="csvfile" size="100" /> </td>
        <td rowspan="2" class="formRight"><strong>Example CSV emails only:</strong><br><br>
        name1@email.com<br>
        name2@email.com<br>
        name3@email.com<br>
        name4@email.com<br>
        name5@email.com<br>
		</td>
        <td rowspan="2" class="formRight"><strong>Example CSV email and name:</strong><br>
          <br>
        name1@email.com,NameOne<br>
        name2@email.com,NameTwo<br>
        name3@email.com,NameThree<br>
        name4@email.com,NameFour<br>
        name5@email.com,NameFive<br>
		</td>
      </tr>   
                      
      <tr>
        <td>&nbsp;</td>
        <td class="formRight"><input name="submit" type="submit" value="<?php echo $lang['Subscriber_Add_CSV_button']; ?>" class="submitButton" /></td>
      </tr>
  	</table>
	</form>


<?php 
} elseif ($_REQUEST["act"]=='newsletters_options') {
	$sql = "SELECT * FROM ".$TABLE["Options"];
	$sql_result = sql_resultNL($sql);
	$Options = mysqli_fetch_assoc($sql_result);
	
	$Options["nl_form"] = unserialize($Options["nl_form"]);
	
	if(empty($Options["nl_form"])) {
		$Options["nl_form"] = array();
	}
	
	$OptionsLang = unserialize( base64_decode( $Options['language']));
?>
	
    <div class="paddingtop"></div>
    
    <form action="admin.php" method="post" name="form">
	<input type="hidden" name="act" value="updateOptionsNewsletters" />
    <table border="0" cellspacing="0" cellpadding="8" class="allTables">
      <tr>
        <td colspan="3" class="headlist">NewsLetters options</td>
      </tr>      
      <tr>
        <td class="left_top" width="40%">Admin Email:<br />
          <span style="font-size:11px"><em>NewsLetters will be send from this email</em></span> </td>
        <td class="left_top"><input name="admin_email" type="text" size="50" value="<?php echo ReadDB($Options["admin_email"]); ?>" /></td>
      </tr>           
      <tr>
        <td class="left_top">How the subscription form will be arranged: </td>
        <td class="left_top">
          <select name="form_arrange"> 
            <option value="horizontal"<?php if($Options["form_arrange"]=='horizontal') echo ' selected="selected"'; ?>>By horizontal</option>
            <option value="vertical"<?php if($Options["form_arrange"]=='vertical') echo ' selected="selected"'; ?>>By vertical</option>
          </select>
        </td>
      </tr>           
      <tr>
        <td class="left_top">Type of the Captcha Verification Code in subscription form:<br />
          <span style="font-size:11px"><em>It will work only on the vertical form.</em></span> </td>
        <td class="left_top">
          <select name="captcha"> 
            <option value="cap"<?php if ($Options["captcha"]=='cap') echo ' selected="selected"'; ?>>Simple Captcha</option>
            <option value="vsc"<?php if ($Options["captcha"]=='vsc') echo ' selected="selected"'; ?>>Very Simple Captcha</option>
            <option value="nocap"<?php if ($Options["captcha"]=='nocap') echo ' selected="selected"'; ?>>- No Captcha -</option>
          </select>
        </td>
      </tr>           
      <tr>
        <td class="left_top">Add unsubscribe link underneath the text of newsletter: </td>
        <td class="left_top">
          <select name="unsubscr_link"> 
            <option value="yes"<?php if ($Options["unsubscr_link"]=='yes') echo ' selected="selected"'; ?>>yes</option>
            <option value="no"<?php if ($Options["unsubscr_link"]=='no') echo ' selected="selected"'; ?>>no</option>
          </select>
        </td>
      </tr>      
      <tr>
        <td class="left_top">Collect Name in subscription form: </td>
        <td class="left_top">
          <select name="collect_name"> 
            <option value="yes"<?php if ($Options["collect_name"]=='yes') echo ' selected="selected"'; ?>>yes</option>
            <option value="no"<?php if ($Options["collect_name"]=='no') echo ' selected="selected"'; ?>>no</option>
          </select>
        </td>
      </tr>  
      <tr>
        <td class="left_top_b">Newsletter form additional fields:<br />
          <span style="font-size:11px"><em>select the fields that your visitors should fill in on the GuestBook form.</em></span> </td>
        <td class="left_top_b">
        	<label><input name="nl_form[]" type="checkbox" value="Address"<?php if (in_array("Address", $Options["nl_form"])) echo ' checked="checked"'; ?> /> <?php echo ReadDB($OptionsLang["Form_Address"]); ?></label> &nbsp; 
            <label><input name="nl_form[]" type="checkbox" value="Zip_code"<?php if (in_array("Zip_code", $Options["nl_form"])) echo ' checked="checked"'; ?> /> <?php echo ReadDB($OptionsLang["Form_Zip_code"]); ?></label> &nbsp;  
        </td>
      </tr>    
      <tr>
        <td class="left_top">Send a verification e-mail to the subscriber for activation of subscription: </td>
        <td class="left_top">
          <select name="verify_email"> 
            <option value="yes"<?php if ($Options["verify_email"]=='yes') echo ' selected="selected"'; ?>>yes</option>
            <option value="no"<?php if ($Options["verify_email"]=='no') echo ' selected="selected"'; ?>>no</option>
          </select>
        </td>
      </tr>      
      <tr>
        <td class="left_top">Send notice to admin email when new subscription is submitted: </td>
        <td class="left_top">
          <select name="email_notice"> 
            <option value="yes"<?php if ($Options["email_notice"]=='yes') echo ' selected="selected"'; ?>>yes</option>
            <option value="no"<?php if ($Options["email_notice"]=='no') echo ' selected="selected"'; ?>>no</option>
          </select>
        </td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td><input name="submit" type="submit" value="Save" class="submitButton" /></td>
      </tr>
    </table>    
    
    <table border="0" cellspacing="0" cellpadding="8" class="allTables">
      <tr>
        <td colspan="3" class="headlist">SMTP Authentication options</td>
      </tr> 
      <tr>
        <td class="left_top" width="40%">Use SMTP Authentication for sending email newsletters: </td>
        <td class="left_top">
          <select name="smtp_auth"> 
            <option value="no"<?php if($Options["smtp_auth"]=='no') echo ' selected="selected"'; ?>>no</option>
            <option value="yes"<?php if($Options["smtp_auth"]=='yes') echo ' selected="selected"'; ?>>yes</option>
          </select>
        </td>
      </tr>             
      <tr>
        <td class="left_top">SMTP server:</td>
        <td class="left_top"><input name="smtp_server" type="text" size="30" value="<?php echo ReadDB($Options["smtp_server"]); ?>" /></td>
      </tr>             
      <tr>
        <td class="left_top">SMTP port:</td>
        <td class="left_top"><input name="smtp_port" type="text" size="5" value="<?php echo ReadDB($Options["smtp_port"]); ?>" /></td>
      </tr> 
                 
      <tr>
        <td class="left_top">SMTP email(SMTP account username):</td>
        <td class="left_top"><input name="smtp_email" type="text" size="30" value="<?php echo ReadDB($Options["smtp_email"]); ?>" /></td>
      </tr>  
                 
      <tr>
        <td class="left_top">SMTP password:</td>
        <td class="left_top"><input name="smtp_pass" type="text" size="30" value="<?php echo ReadDB($Options["smtp_pass"]); ?>" /></td>
      </tr> 
      <tr>
        <td class="left_top">Use SMTP secure: </td>
        <td class="left_top">
          <select name="smtp_secure"> 
            <option value=""<?php if($Options["smtp_secure"]=='') echo ' selected="selected"'; ?>>none</option>
            <option value="tls"<?php if($Options["smtp_secure"]=='tls') echo ' selected="selected"'; ?>>tls</option>
            <option value="ssl"<?php if($Options["smtp_secure"]=='ssl') echo ' selected="selected"'; ?>>ssl</option>
          </select>
        </td>
      </tr>          
      <tr>
        <td>&nbsp;</td>
        <td><input name="submit" type="submit" value="Save" class="submitButton" /></td>
      </tr>
    </table> 
	</form>



<?php 
} elseif ($_REQUEST["act"]=='news_options') {
	$sql = "SELECT * FROM ".$TABLE["Options"];
	$sql_result = sql_resultNL($sql);
	$Options = mysqli_fetch_assoc($sql_result);
?>
	
    <div class="paddingtop"></div>
    
    <form action="admin.php" method="post" name="form">
	<input type="hidden" name="act" value="updateOptionsNews" />
    <table border="0" cellspacing="0" cellpadding="8" class="allTables">
      <tr>
        <td colspan="3" class="headlist">News options</td>
      </tr>
      
      <tr>
        <td class="left_top" width="45%">Number of news per page: </td>
        <td class="left_top">
        	<select name="per_page">
                <?php for($i=3; $i<=300; $i=$i+3) {?>
            	<option value="<?php echo $i;?>"<?php if($i==$Options["per_page"]) echo ' selected="selected"'; ?>><?php echo $i;?></option>
                <?php } ?>
            </select>
        </td>
      </tr>
      <tr>
        <td class="left_top">URL of the page where you placed the news:<br />
          /<span style="font-size:11px; font-style:italic;">Put the url of the page where news articles are located. <br />
          It is useful for the rss feed and some other features.</span>/
        </td>
        <td class="left_top">
        	<input class="input_opt" name="news_link" type="text" value="<?php echo ReadDB($Options["news_link"]); ?>" />
            <div style="padding-top:6px;font-size:11px;">for example http://www.yoursite.com/news-page.php</div>
        </td>
      </tr>
      <tr>
        <td class="left_top">Show the menu with categories:</td>
        <td class="left_top">
          <select name="showcategdd"> 
           <option value="yes"<?php if ($Options["showcategdd"]=='yes') echo ' selected="selected"'; ?>>yes</option>       
           <option value="no"<?php if ($Options["showcategdd"]=='no') echo ' selected="selected"'; ?>>no</option>
          </select>
       </td>
      </tr>
      <tr>
        <td class="left_top">Show the news on the date published:<br />
          /<span style="font-size:11px; font-style:italic;">If you choose "yes", the news will be hidden until the datetime of publishing</span>/</td>
        <td class="left_top">
          <select name="publishon">      
           <option value="no"<?php if ($Options["publishon"]=='no') echo ' selected="selected"'; ?>>no</option>
           <option value="yes"<?php if ($Options["publishon"]=='yes') echo ' selected="selected"'; ?>>yes</option>  
          </select>
       </td>
      </tr>      
      <tr>
        <td class="left_top">Set Default Time Zone:</td>
        <td class="left_top">
          <select name="time_zone"> 
           	<option value=""<?php if ($Options["time_zone"]=='') echo ' selected="selected"'; ?>>Server Time</option>
            <?php
			if(!function_exists('timezone_identifiers_list')){ 
				$o = timezone_list();
			} else {
				$o = get_timezones();
			}
			foreach($o as $timezone => $tz_label) {
			?>	
            	<option value='<?php echo $timezone; ?>'<?php if ($Options["time_zone"]==$timezone) echo ' selected="selected"'; ?>><?php echo $tz_label; ?></option>
            <?php 
			}
			?>  
          </select>
       </td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td><input name="submit" type="submit" value="Save" class="submitButton" /></td>
      </tr>
    </table>    
	</form>


<?php
} elseif ($_REQUEST["act"]=='visual_options') {
	$sql = "SELECT * FROM ".$TABLE["Options"];
	$sql_result = sql_resultNL($sql);
	$Options = mysqli_fetch_assoc($sql_result);
	$OptionsVis = unserialize(ReadDB($Options['visual']));
?>

	<script type="text/javascript">
		Event.observe(window, 'load', loadAccordions, false);
		function loadAccordions() {
			var bottomAccordion = new accordion('accordion_container');	
			// Open first one
			//bottomAccordion.activate($$('#accordion_container .accordion_toggle')[0]);
		}	
	</script>
	
    <div class="pageDescr">Click on any of the styles to see the options.</div>
    
    <?php include ("include/form_visual_options.php");?> 
    

<?php
} elseif ($_REQUEST["act"]=='visual_options_newsletters') {
	$sql = "SELECT * FROM ".$TABLE["Options"];
	$sql_result = sql_resultNL($sql);
	$Options = mysqli_fetch_assoc($sql_result);
	$OptionsVis = unserialize(ReadDB($Options['visual_form']));
?>

	<script type="text/javascript">
		Event.observe(window, 'load', loadAccordions, false);
		function loadAccordions() {
			var bottomAccordion = new accordion('accordion_container');	
			// Open first one
			//bottomAccordion.activate($$('#accordion_container .accordion_toggle')[0]);
		}	
	</script>
	
    <div class="pageDescr">Click on any of the styles to see the options.</div>
    
    <?php include ("include/form_visual_options_newsletters.php");?>   


<?php
} elseif ($_REQUEST["act"]=='language_options') {
	$sql = "SELECT * FROM ".$TABLE["Options"];
	$sql_result = sql_resultNL($sql);
	$Options = mysqli_fetch_assoc($sql_result);
	$OptionsLang = unserialize(base64_decode($Options['language']));
?>
	<script type="text/javascript">
		Event.observe(window, 'load', loadAccordions, false);
		function loadAccordions() {
			var bottomAccordion = new accordion('accordion_container');	
			// Open first one
			//bottomAccordion.activate($$('#accordion_container .accordion_toggle')[0]);
		}	
	</script>
	
    <div class="pageDescr">Click on any of the line to see the options.</div>
    
    <?php include ("include/form_language_options.php");?>
    

<?php
} elseif ($_REQUEST["act"]=='html') {
?>
	
        <div class="pageDescr">There are two easy ways to put the newsletter subscription form on your website.</div>

	<table border="0" cellspacing="0" cellpadding="8" class="allTables">
      <tr>
        <td class="copycode">1) <strong>Using iframe code</strong> - just copy the code below and put it on your web page where you want the subscription form to appear.</td>
      </tr>
      <tr>
      	<td class="putonwebpage">        	
        	<div class="divCode">&lt;iframe src=&quot;<?php echo $CONFIG["full_url"]; ?>preview_newsletter_form.php&quot; width=&quot;100%&quot; height=&quot;300px&quot; frameborder=&quot;0&quot; scrolling=&quot;auto&quot;&gt;&lt;/iframe&gt;   </div>     
        </td>
      </tr>
    </table>
    
    <table border="0" cellspacing="0" cellpadding="8" class="allTables">
    
      <tr>
        <td class="copycode">2) <strong>Using PHP include()</strong> - you can use a PHP include() in any of your PHP pages. Edit your .php page and put the code below where you want the subscription form to be.</td>
      </tr>
      
      <tr>
        <td class="putonwebpage">        	
        	<div class="divCode">&lt;?php include(&quot;<?php echo $CONFIG["server_path"]; ?>subscribe_newsletter_form.php&quot;); ?&gt; </div>     
        </td>
      </tr>
      
      <tr>
      	<td>
        	At the top of the php page (first line) you should put this line of code too, so captcha image verification can work on the subscription form.
        </td>
      </tr>
      
      <tr>
        <td class="putonwebpage">        	
        	<div class="divCode">&lt;?php session_start(); ?&gt;</div>     
        </td>
      </tr>
            
    </table>
    
    
    
    <div class="pageDescr">There one easy way to put the popup newsletter subscription form on your website.</div>
    
    <table border="0" cellspacing="0" cellpadding="8" class="allTables">
    
      <tr>
        <td class="copycode"><strong>Using PHP include()</strong> - you can use a PHP include() in any of your PHP pages. Edit the .php on which you want the popup subscription form to appear and paste the code below somewhere in &lt;body&gt; or &lt;head&gt; html section on the page:</td>
      </tr>
      
      <tr>
        <td class="putonwebpage">        	
        	<div class="divCode">&lt;?php include(&quot;<?php echo $CONFIG["server_path"]; ?>popup_form.php&quot;); ?&gt; </div>     
        </td>
      </tr>
            
    </table>
    
    
	<div class="pageDescr">There are two easy ways to put the news script on your website.</div>

	<table border="0" cellspacing="0" cellpadding="8" class="allTables">
      <tr>
        <td class="copycode">1) <strong>Using iframe code</strong> - just copy the code below and put it on your web page where you want the news to appear.</td>
      </tr>
      <tr>
      	<td class="putonwebpage">        	
        	<div class="divCode">&lt;iframe src=&quot;<?php echo $CONFIG["full_url"]; ?>preview.php&quot; width=&quot;100%&quot; height=&quot;700px&quot; frameborder=&quot;0&quot; scrolling=&quot;auto&quot;&gt;&lt;/iframe&gt;   </div>     
        </td>
      </tr>
    </table>
    
    <table border="0" cellspacing="0" cellpadding="8" class="allTables">
    
      <tr>
        <td class="copycode">2) <strong>Using PHP include()</strong> - you can use a PHP include() in any of your PHP pages. Edit your .php page and put the code below where you want the news to be.</td>
      </tr>
      
      <tr>
        <td class="putonwebpage">        	
        	<div class="divCode">&lt;?php include(&quot;<?php echo $CONFIG["server_path"]; ?>news.php&quot;); ?&gt; </div>     
        </td>
      </tr>
      
      <tr>
      	<td>
        	Optionally in the head section of the php page you could put(or replace your meta tags) this line of code, so meta title and meta description will work for better searching engine optimization.
        </td>
      </tr>
      
      <tr>
        <td class="putonwebpage">        	
        	<div class="divCode">&lt;?php include(&quot;<?php echo $CONFIG["server_path"]; ?>meta.php&quot;); ?&gt; </div>     
        </td>
      </tr>
      
      <tr>
        <td class="putonwebpage">        	
        	<div>If you have any problems, please do not hesitate to contact us at info@simplephpscripts.com</div>     
        </td>
      </tr>
            
    </table>
	       
    

<?php
} elseif ($_REQUEST["act"]=='rss') {
?>
    
    <div class="pageDescr">The RSS feed allows other people to keep track of your news using rss readers and to use your news on their websites. <br />
Every time you publish a new article it will appear on your RSS feed and every one using it will be informed about it.</div>
    
    <table border="0" cellspacing="0" cellpadding="8" class="allTables">
    
      <tr>
        <td class="copycode">You can view the RSS feed <a href="rss.php" target="_blank">here(in php)</a>, <a href="rss.xml" target="_blank">here(in xml)</a> or use one of the codes below to place it on your website as RSS link.</td>
      </tr>
      
      <tr>
        <td class="putonwebpage">        	
        	<div class="divCode">&lt;a href=&quot;<?php echo $CONFIG["full_url"]; ?>rss.php&quot; target=&quot;_blank&quot;&gt;RSS feed&lt;/a&gt;</div>     
        </td>
      </tr>
      
      <tr>
        <td class="putonwebpage">        	
        	<div class="divCode">&lt;a href=&quot;<?php echo $CONFIG["full_url"]; ?>rss.xml&quot; target=&quot;_blank&quot;&gt;RSS feed&lt;/a&gt;</div>     
        </td>
      </tr>
            
    </table>
    
<?php
}
?>
</div>


<?php 
} else { ////// Login Form //////
?>
<div class="admin_wrapper login_wrapper">
    <div class="login_head"><?php echo $lang['ADMIN_LOGIN']; ?></div>
    
    <div class="login_sub"><?php echo $lang['Login_context']; ?> </div>
    <form action="admin.php" method="post">
    <input type="hidden" name="act" value="login">
    <table border="0" cellspacing="0" cellpadding="0" class="loginTable">
      <tr>
        <td class="userpass"><?php echo $lang['Username']; ?> </td>
        <td class="userpassfield"><input name="user" type="text" class="loginfield" style="float:left;" /> <?php if(isset($logMessage) and $logMessage!='') {?><div class="logMessage"><?php echo $logMessage; ?></div><?php } ?></td>
      </tr>
      <tr>
        <td class="userpass"><?php echo $lang['Password']; ?> </td>
        <td class="userpassfield"><input name="pass" type="password" class="loginfield" /></td>
      </tr>
      <tr>
        <td class="userpass">&nbsp;</td>
        <td class="userpassfield"><input type="submit" name="button" value="<?php echo $lang['Login']; ?>" class="loginButon" /></td>
      </tr>
    </table>
    </form>
</div>
<?php 
}
?>

<div class="clearfooter"></div>
<div class="divProfiAnts"> <a class="footerlink" href="http://simplephpscripts.com" target="_blank">Product of SimplePHPscripts.com</a></div>

</body>
</html>