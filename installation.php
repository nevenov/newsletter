<?php
$installed = 'yes';
include("configs.php");

if (isset($_GET["install"]) and $_GET["install"]==1) {
	$message = '';
	$connNL = mysqli_connect(trim($_REQUEST["hostname"]), trim($_REQUEST["mysql_user"]), trim($_REQUEST["mysql_password"]));
	if (mysqli_connect_errno()) {
		$message = "MySQL database details are incorrect. Please, check the database details(MySQL server, username and password) and/or contact your hosting company to verify them. If you have troubles just send us login details for your hosting account control panel and we will do the installation of the script for you for free.
		<br /> Error message: " . mysqli_connect_error();
	} else {
		if (!mysqli_select_db($connNL, trim($_REQUEST["mysql_database"]))) {
			$message = "Unable to select database. Database name is incorrect or is not created. Please check database details - MySQL server, Database name, Username and Password and try again. If you have troubles just send us login details for your hosting account control panel and we will do the installation of the script for you for free.";
		} else {
					
			$sql = "DROP TABLE IF EXISTS `".$TABLE["News"]."`;";
			$sql_result = sql_resultNL($sql);
			
			$sql = "CREATE TABLE `".$TABLE["News"]."` (
					  `id` int(11) NOT NULL auto_increment,
					  `publish_date` datetime default NULL,
					  `send_date` datetime default NULL,
					  `status` varchar(50) default NULL,
					  `cat_id` varchar(10) default NULL,
					  `highlight` varchar(50) default NULL,
					  `title` varchar(250) default NULL,
					  `summary` text,
					  `content` text,
					  `image` varchar(250) default NULL,
					  `caption` varchar(250) default NULL,
					  `imgpos` varchar(10) default NULL,
					  `imgwidth` varchar(10) default NULL,
					  `reviews` int(11) default NULL, 
					  PRIMARY KEY  (`id`))
					  CHARACTER SET utf8 COLLATE utf8_unicode_ci";
  			$sql_result = sql_resultNL($sql);
			
			
			
			$sql = "DROP TABLE IF EXISTS `".$TABLE["Subscribers"]."`;";
			$sql_result = sql_resultNL($sql);
			
			$sql = "CREATE TABLE `".$TABLE["Subscribers"]."` (  
					  `id` int(11) NOT NULL auto_increment, 
					  `cat_id` varchar(10) default NULL,                  
					  `name` varchar(250) default NULL,                     
					  `email` varchar(250) default NULL,                         
					  `address` varchar(250) default NULL,                        
					  `zip_code` varchar(250) default NULL,                    
					  `status` varchar(20) default NULL,          
					  `subscribe_date` datetime default NULL,             
					  `receive_to` datetime default NULL,                             
					  PRIMARY KEY  (`id`))
					  CHARACTER SET utf8 COLLATE utf8_unicode_ci";
  			$sql_result = sql_resultNL($sql);
						
			
			$sql = "DROP TABLE IF EXISTS `".$TABLE["Categories"]."`;";
			$sql_result = sql_resultNL($sql);
			
			$sql = "CREATE TABLE `".$TABLE["Categories"]."` (
					  `id` int(11) NOT NULL auto_increment,
					  `cat_name` varchar(250) default NULL,
					  `cat_show` varchar(50) default NULL,
					  PRIMARY KEY  (`id`))
					  CHARACTER SET utf8 COLLATE utf8_unicode_ci";
  			$sql_result = sql_resultNL($sql);
						
			
			$sql = "DROP TABLE IF EXISTS `".$TABLE["Options"]."`;";
			$sql_result = sql_resultNL($sql);
			
			$sql = "CREATE TABLE `".$TABLE["Options"]."` (
					  `options_id` int(11) NOT NULL auto_increment,
					  `admin_email` varchar(250),
					  `captcha` varchar(10),
					  `captcha_theme` varchar(20),
					  `unsubscr_link` varchar(20),
					  `collect_name` varchar(20),
					  `nl_form` text,
					  `verify_email` varchar(20),
					  `email_notice` varchar(20),
					  `form_arrange` varchar(20),
					  `smtp_auth` varchar(20),
					  `smtp_server` varchar(250),
					  `smtp_port` varchar(20),
					  `smtp_email` varchar(250),
					  `smtp_pass` varchar(250),
					  `smtp_secure` varchar(250),
					  `per_page` varchar(10),
					  `shownews` varchar(20),
					  `news_link` varchar(250),
					  `showsearch` varchar(10),
					  `showcategdd` varchar(10),
					  `showhits` varchar(10),
					  `htmleditor` varchar(20),
					  `publishon` varchar(10),
					  `time_zone` varchar(250),
					  `visual_form` text,
					  `visual` text,
					  `language` text,
					  PRIMARY KEY  (`options_id`))
					  CHARACTER SET utf8 COLLATE utf8_unicode_ci";
  			$sql_result = sql_resultNL($sql);
			
			$sql = 'INSERT INTO `'.$TABLE["Options"].'` 
					SET `admin_email`="admin@email.com",
						`captcha`="nocap",
						`unsubscr_link`="yes", 
						`collect_name`="yes", 
						`nl_form`=\'a:2:{i:0;s:7:"Address";i:1;s:8:"Zip_code";}\', 
						`verify_email`="yes",  
						`email_notice`="no", 
						`form_arrange`="vertical",  
						`smtp_auth`="no",  
						`smtp_server`="smtp.server.com",  
						`smtp_port`=587,  
						`smtp_email`="test@server.com",  
						`smtp_pass`="password",  
						`smtp_secure`="tls",
						`per_page`="9",
						`shownews`="TitleAndSummary", 
						`news_link`="http://www.yourwebsite.com/newspage.php", 
						`time_zone`="", 				 
						
						`visual_form`=\'a:34:{s:21:"head_form_font_family";s:41:"Helvetica Neue,Helvetica,Arial,sans-serif";s:20:"head_form_font_color";s:7:"#000000";s:19:"head_form_font_size";s:4:"16px";s:21:"head_form_font_weight";s:4:"bold";s:20:"head_form_font_style";s:6:"normal";s:14:"head_form_dist";s:4:"20px";s:16:"form_font_family";s:41:"Helvetica Neue,Helvetica,Arial,sans-serif";s:14:"form_font_size";s:4:"14px";s:15:"form_font_color";s:7:"#000000";s:14:"butt_bgr_color";s:7:"#4CAF50";s:10:"form_width";s:3:"540";s:14:"form_width_dim";s:2:"px";s:12:"nl_tit_color";s:7:"#00476C";s:11:"nl_tit_font";s:35:"Georgia,Times,Times New Roman,serif";s:11:"nl_tit_size";s:4:"18px";s:18:"nl_tit_font_weight";s:4:"bold";s:17:"nl_tit_font_style";s:6:"normal";s:18:"nl_tit_line_height";s:4:"26px";s:13:"nl_cont_color";s:7:"#333333";s:12:"nl_cont_font";s:41:"Arial,Helvetica Neue,Helvetica,sans-serif";s:12:"nl_cont_size";s:4:"13px";s:18:"nl_cont_font_style";s:6:"normal";s:19:"nl_cont_line_height";s:4:"18px";s:18:"nl_cont_text_align";s:6:"center";s:16:"newsletter_width";s:3:"650";s:15:"image_max_width";s:3:"280";s:15:"popup_bgr_trans";s:3:"0.8";s:11:"popup_width";s:3:"400";s:15:"popup_width_dim";s:2:"px";s:12:"popup_height";s:3:"380";s:16:"popup_height_dim";s:2:"px";s:13:"popup_seconds";s:1:"5";s:13:"popup_showing";s:3:"any";s:15:"popup_close_sec";s:2:"10";}\',	
						
						`visual`=\'a:109:{s:15:"gen_font_family";s:51:"Raleway-Regular,Helvetica Neue,Helvetica,sans-serif";s:13:"gen_font_size";s:7:"inherit";s:14:"gen_font_color";s:7:"#000000";s:13:"gen_bgr_color";s:0:"";s:15:"gen_line_height";s:3:"1.5";s:9:"gen_width";s:3:"900";s:13:"gen_width_dim";s:2:"px";s:14:"cat_menu_color";s:7:"#000000";s:12:"cat_menu_bgr";s:7:"#F1F1F1";s:18:"cat_menu_color_sel";s:7:"#FFFFFF";s:16:"cat_menu_bgr_sel";s:7:"#000000";s:15:"cat_menu_family";s:7:"inherit";s:13:"cat_menu_size";s:7:"inherit";s:15:"cat_menu_weight";s:6:"normal";s:10:"link_color";s:7:"#BDBDBD";s:16:"link_color_hover";s:7:"#333333";s:9:"link_font";s:7:"inherit";s:14:"link_font_size";s:7:"inherit";s:16:"link_font_weight";s:6:"normal";s:10:"link_align";s:4:"left";s:20:"link_text_decoration";s:4:"none";s:26:"link_text_decoration_hover";s:4:"none";s:15:"summ_show_image";s:3:"yes";s:16:"summ_image_ratio";s:2:"43";s:16:"summ_title_color";s:7:"#000000";s:22:"summ_title_color_hover";s:7:"#000000";s:15:"summ_title_font";s:50:"Oswald-Regular,Helvetica Neue,Helvetica,sans-serif";s:15:"summ_title_size";s:4:"18px";s:22:"summ_title_font_weight";s:6:"normal";s:21:"summ_title_font_style";s:6:"normal";s:21:"summ_title_text_align";s:7:"inherit";s:22:"summ_title_line_height";s:7:"inherit";s:16:"summ_title_decor";s:4:"none";s:22:"summ_title_decor_hover";s:9:"underline";s:11:"title_color";s:7:"#000000";s:10:"title_font";s:50:"Oswald-Regular,Helvetica Neue,Helvetica,sans-serif";s:10:"title_size";s:4:"30px";s:17:"title_font_weight";s:6:"normal";s:16:"title_font_style";s:6:"normal";s:16:"title_text_align";s:4:"left";s:17:"title_line_height";s:4:"36px";s:10:"summ_color";s:7:"#666666";s:9:"summ_font";s:7:"inherit";s:9:"summ_size";s:4:"13px";s:15:"summ_font_style";s:6:"normal";s:15:"summ_text_align";s:7:"inherit";s:16:"summ_line_height";s:4:"21px";s:8:"show_cat";s:3:"yes";s:8:"cat_font";s:53:"Tex Gyre Adventor,Helvetica Neue,Helvetica,sans-serif";s:9:"cat_color";s:7:"#676767";s:8:"cat_size";s:7:"inherit";s:15:"cat_font_weight";s:6:"normal";s:14:"cat_font_style";s:6:"normal";s:9:"show_date";s:3:"yes";s:10:"date_color";s:7:"#000000";s:9:"date_font";s:53:"Tex Gyre Adventor,Helvetica Neue,Helvetica,sans-serif";s:9:"date_size";s:4:"12px";s:15:"date_font_style";s:6:"normal";s:11:"date_format";s:5:"m.d.Y";s:12:"showing_time";s:5:"g:i a";s:7:"show_aa";s:3:"yes";s:8:"showhits";s:3:"yes";s:10:"cont_color";s:7:"#3C3C3C";s:9:"cont_font";s:61:"TimesNewRoman,Times New Roman,Times,Baskerville,Georgia,serif";s:9:"cont_size";s:4:"18px";s:15:"cont_font_style";s:6:"normal";s:15:"cont_text_align";s:7:"justify";s:16:"cont_line_height";s:4:"21px";s:12:"viewer_width";s:3:"750";s:10:"capt_color";s:7:"#333333";s:14:"capt_bgr_color";s:0:"";s:9:"capt_font";s:41:"Arial,Helvetica Neue,Helvetica,sans-serif";s:9:"capt_size";s:4:"11px";s:16:"capt_font_weight";s:6:"normal";s:15:"capt_font_style";s:6:"normal";s:15:"capt_text_align";s:4:"left";s:16:"links_font_color";s:7:"#0000CC";s:22:"links_font_color_hover";s:7:"#000000";s:21:"links_text_decoration";s:9:"underline";s:27:"links_text_decoration_hover";s:4:"none";s:15:"links_font_size";s:7:"inherit";s:16:"links_font_style";s:6:"normal";s:17:"links_font_weight";s:6:"normal";s:14:"pag_font_color";s:0:"";s:13:"pag_bgr_color";s:0:"";s:20:"pag_font_color_hover";s:0:"";s:19:"pag_bgr_color_hover";s:0:"";s:18:"pag_font_color_sel";s:0:"";s:17:"pag_bgr_color_sel";s:0:"";s:15:"pag_font_family";s:7:"inherit";s:13:"pag_font_size";s:7:"inherit";s:15:"pag_font_weight";s:7:"inherit";s:14:"pag_font_style";s:7:"inherit";s:12:"pag_align_to";s:6:"center";s:14:"show_scrolltop";s:3:"yes";s:15:"scrolltop_width";s:4:"40px";s:16:"scrolltop_height";s:4:"40px";s:19:"scrolltop_bgr_color";s:7:"#999999";s:25:"scrolltop_bgr_color_hover";s:7:"#000000";s:17:"scrolltop_opacity";s:2:"40";s:23:"scrolltop_opacity_hover";s:2:"60";s:16:"scrolltop_radius";s:3:"0px";s:15:"show_share_this";s:3:"yes";s:19:"show_share_this_top";s:3:"yes";s:15:"dist_menu_title";s:4:"28px";s:13:"dist_btw_news";s:4:"16px";s:14:"back_link_dist";s:4:"10px";s:15:"dist_title_date";s:4:"18px";s:14:"dist_date_text";s:4:"14px";}\',
						 
						`language`=\'YTo1OTp7czoxNjoiU3Vic2NyX291cl9uZXdzbCI7czoyODoiSWNoIG3DtmNodGUgSW5mb3JtYXRpb25lbiB6dSI7czoxMDoiRm9ybV9FbWFpbCI7czoxNDoiRW1haWwtQWRyZXNzZSoiO3M6OToiRm9ybV9OYW1lIjtzOjE0OiJOYW1lLCBWb3JuYW1lKiI7czoxMjoiRm9ybV9BZGRyZXNzIjtzOjIzOiJTdHJhw59lIHVuZCBIYXVzbnVtbWVyKiI7czoxMzoiRm9ybV9aaXBfY29kZSI7czoxMjoiUExaIHVuZCBPcnQqIjtzOjEyOiJGb3JtX0NhcHRjaGEiO3M6MTA6IkNhcHRjaGEuLi4iO3M6MTY6IkJ1dHRvbl9TdWJzY3JpYmUiO3M6ODoiQW5tZWxkZW4iO3M6MTM6InBvcHVwX2hlYWRpbmciO3M6MjU6IlNVQlNDUklCRSBPVVIgTkVXU0xFVFRFUlMiO3M6MTE6InBvcHVwX2Rlc2NyIjtzOjYwOiJHZXQgb3VyIGJlc3Qgb2ZmZXJzIGRlbGl2ZXJlZCBkaXJlY3RseSB0byB5b3VyIGluYm94IC0gZnJlZSEiO3M6MTM6IkVtYWlsX1N1YmplY3QiO3M6MzE6IllvdSBoYXZlIHJlY2VpdmVkIGEgbmV3c2xldHRlciEiO3M6Mjg6IlVuc3Vic2NyaWJlX2Zyb21fbmV3c2xldHRlcnMiO3M6Mjg6IlVuc3Vic2NyaWJlIGZyb20gbmV3c2xldHRlcnMiO3M6NDoiaGVyZSI7czo1OiJoZXJlLiI7czoyNzoiSW5jb3JyZWN0X3ZlcmlmaWNhdGlvbl9jb2RlIjtzOjI5OiJJbmNvcnJlY3QgdmVyaWZpY2F0aW9uIGNvZGUhICI7czoyNDoiZW1haWxfYWxyZWFkeV9yZWdpc3RlcmVkIjtzOjM0OiJZb3VyIGVtYWlsIGlzIGFscmVhZHkgcmVnaXN0ZXJlZCEgIjtzOjI1OiJyZXN1YnNjcmliZWRfc3VjY2Vzc2Z1bGx5IjtzOjM1OiJZb3UgYXJlIHJlLXN1YnNjaWJlZCBzdWNjZXNzZnVsbHkhICI7czo5OiJmaWxsX2Zvcm0iO3M6MjQ6IlBsZWFzZSwgZmlsbCB0aGUgZm9ybSEhISI7czoxMDoiZW50ZXJfbmFtZSI7czoyNToiUGxlYXNlLCBlbnRlciB5b3VyIG5hbWUhICI7czoxOToiZW50ZXJfZW1haWxfYWRkcmVzcyI7czozNDoiUGxlYXNlLCBlbnRlciB5b3VyIGVtYWlsIGFkZHJlc3MhICI7czoyMToiY29ycmVjdF9lbWFpbF9hZGRyZXNzIjtzOjM3OiJQbGVhc2UsIGVudGVyIGNvcnJlY3QgZW1haWwgYWRkcmVzcyEgIjtzOjEzOiJlbnRlcl9hZGRyZXNzIjtzOjQ0OiJCaXR0ZSBnZWJlbiBTaWUgU3RyYcOfZSB1bmQgSGF1c251bW1lciBlaW4hICI7czo5OiJlbnRlcl96aXAiO3M6MzI6IkJpdHRlIGdlYmVuIFNpZSBQTFogdW5kIE9ydCBlaW4hIjtzOjEwOiJmaWVsZF9jb2RlIjtzOjM3OiJQbGVhc2UsIGVudGVyIHRoZSB2ZXJpZmljYXRpb24gY29kZSEgIjtzOjIzOiJzdWJzY3JpYmVkX3N1Y2Nlc3NmdWxseSI7czoyNToiU3Vic2NyaXB0aW9uIHN1Y2Nlc3NmdWwhICI7czoyNDoiY2hlY2tfZW1haWxfdmVyaWZpY2F0aW9uIjtzOjU0OiJQbGVhc2UsIGNoZWNrIHlvdXIgZW1haWwgdG8gY29uZmlybSB0aGUgc3Vic2NyaXB0aW9uISAiO3M6MjE6ImNsaWNrX3RvX2NvbmZpcm1fbGluayI7czo2MDoiUGxlYXNlLCBjbGljayBvbiB0aGUgbGluayBiZWxvdyB0byBjb25maXJtIHRoZSBzdWJzY3JpcHRpb246IjtzOjE4OiJTdWNjZXNzZnVsX1N1YmplY3QiO3M6MjU6IlN1YnNjcmlwdGlvbiBzdWNjZXNzZnVsISAiO3M6MTU6IlN1Y2Nlc3NmdWxfYm9keSI7czo1MjoiWW91IGFyZSBzdWJzY3JpYmVkIHN1Y2Nlc3NmdWxseSB0byBvdXIgbmV3c2xldHRlcnMhICI7czoxNDoiTm90aWNlX1N1YmplY3QiO3M6Mjg6Ik5ldyBzdWJzY3JpcHRpb24gc3VibWl0dGVkISAiO3M6MTE6Ik5vdGljZV9ib2R5IjtzOjI4OiJOZXcgc3Vic2NyaXB0aW9uIHN1Ym1pdHRlZCEgIjtzOjI1OiJ1bnN1YnNjcmliZWRfc3VjY2Vzc2Z1bGx5IjtzOjY4OiJZb3UgYXJlIHVuc3Vic2NyaWJlZCBzdWNjZXNzZnVsbHkgZnJvbSBvdXIgbmV3c2xldHRlcnMgbWFpbGluZyBsaXN0ISI7czoyNDoiRXJyb3JfcmVxdWVzdF92YWxpZGF0aW9uIjtzOjM5OiJFcnJvciB2ZXJpZmljYXRpb24gb2YgdGhlIHN1YnNjcmlwdGlvbiEiO3M6MjE6InZhbGlkYXRpb25fc3VjY2Vzc2Z1bCI7czo0NDoiU3VjY2Vzc2Z1bCB2ZXJpZmljYXRpb24gb2YgdGhlIHN1YnNjcmlwdGlvbiEiO3M6MTI6IkJhY2tfdG9faG9tZSI7czozODoiPGkgY2xhc3M9J21hdGVyaWFsLWljb25zJz4mI3hlMTVlOzwvaT4iO3M6MTI6IkNhdGVnb3J5X2FsbCI7czo5OiItLSBBTEwgLS0iO3M6ODoiUHJldmlvdXMiO3M6MjoiwqsiO3M6NDoiTmV4dCI7czoyOiLCuyI7czoxNzoiTm9fbmV3c19wdWJsaXNoZWQiO3M6MTk6Ik5vIG5ld3MgcHVibGlzaGVkISAiO3M6MTI6IkFydGljbGVfSGl0cyI7czozODoiPGkgY2xhc3M9J21hdGVyaWFsLWljb25zJz4mI3hlNDE3OzwvaT4iO3M6NjoiTW9uZGF5IjtzOjM6Ik1vbiI7czo3OiJUdWVzZGF5IjtzOjM6IlR1ZSI7czo5OiJXZWRuZXNkYXkiO3M6MzoiV2VkIjtzOjg6IlRodXJzZGF5IjtzOjM6IlRodSI7czo2OiJGcmlkYXkiO3M6MzoiRnJpIjtzOjg6IlNhdHVyZGF5IjtzOjM6IlNhdCI7czo2OiJTdW5kYXkiO3M6MzoiU3VuIjtzOjc6IkphbnVhcnkiO3M6MzoiSmFuIjtzOjg6IkZlYnJ1YXJ5IjtzOjM6IkZlYiI7czo1OiJNYXJjaCI7czozOiJNYXIiO3M6NToiQXByaWwiO3M6MzoiQXByIjtzOjM6Ik1heSI7czozOiJNYXkiO3M6NDoiSnVuZSI7czozOiJKdW4iO3M6NDoiSnVseSI7czozOiJKdWwiO3M6NjoiQXVndXN0IjtzOjM6IkF1ZyI7czo5OiJTZXB0ZW1iZXIiO3M6MzoiU2VwIjtzOjc6Ik9jdG9iZXIiO3M6MzoiT2N0IjtzOjg6Ik5vdmVtYmVyIjtzOjM6Ik5vdiI7czo4OiJEZWNlbWJlciI7czozOiJEZWMiO3M6OToibWV0YXRpdGxlIjtzOjQwOiJOZXdzbGV0dGVyIFNjcmlwdCBQSFAgZGVmYXVsdCBtZXRhIHRpdGxlIjtzOjE1OiJtZXRhZGVzY3JpcHRpb24iO3M6NDY6Ik5ld3NsZXR0ZXIgU2NyaXB0IFBIUCBkZWZhdWx0IG1ldGEgZGVzY3JpcHRpb24iO30=\'';
			
			$sql_result = sql_resultNL($sql);
			
					
			
			
			
			$ConfigFile = "allinfo.php";
			$CONFIG='$CONFIG';
			
			$handle = @fopen($ConfigFile, "r");
			
			if ($handle) {
				$buffer = fgets($handle, 4096);
	  			$buffer .=fgets($handle, 4096);	
				$buffer .=fgets($handle, 4096);	
				
				$buffer .=$CONFIG."[\"hostname\"]='".trim($_REQUEST["hostname"])."';\n";
				
				$buffer .=$CONFIG."[\"mysql_user\"]='".trim($_REQUEST["mysql_user"])."';\n";
				
				$buffer .=$CONFIG."[\"mysql_password\"]='".trim($_REQUEST["mysql_password"])."';\n";
				
				$buffer .=$CONFIG."[\"mysql_database\"]='".trim(addslashes($_REQUEST["mysql_database"]))."';\n";
				
				$buffer .=$CONFIG."[\"server_path\"]='".trim($_REQUEST["server_path"])."';\n";
				
				$buffer .=$CONFIG."[\"full_url\"]='".trim(addslashes($_REQUEST["full_url"]))."';\n";
								
				$buffer .=$CONFIG."[\"folder_name\"]='".trim(addslashes($_REQUEST["folder_name"]))."';\n";
				
				$buffer .=$CONFIG."[\"admin_user\"]='".trim($_REQUEST["admin_user"])."';\n";
				
				$buffer .=$CONFIG."[\"admin_pass\"]='".trim($_REQUEST["admin_pass"])."';\n";
				
				while (!feof($handle)) {
					$buffer .= fgets($handle, 4096);
				}
				
				fclose($handle);
				
				$handle = @fopen($ConfigFile, "w");
				
				if (!$handle) {
					echo "Configuration file $ConfigFile is missing or the permissions does not allow to be changed. Please upload the file and/or set the right permissions (CHMOD 777).";
					exit();
				}
				
				if (!fwrite($handle,$buffer)) {
				  	echo "Configuration file $ConfigFile is missing or the permissions does not allow to be changed. Please upload the file and/or set the right permissions (CHMOD 777).";
					exit();
				}
				
				fclose($handle);
				
			} else {
				echo "Error opening file.";
				exit();
			}
			
			$message = 'Script successfully installed';	
?>
		<script type="text/javascript">
			window.document.location.href='installation.php?install=2'
		</script>           		
<?php		
		}
	}
}
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Script installation</title>
<link href="styles/installation.css" rel="stylesheet" type="text/css" />
</head>

<body>

<div class="install_wrap">

<?php if (isset($_GET["install"]) && $_GET["install"]==2) { ?>
	<table border="0" class="form_table" align="center" cellpadding="4">
	  <tr>
      	<td>
			Script successfully installed. <a href='admin.php'>Login here</a>.
        </td>
      </tr>
    </table>
<?php } else {?>

	<form action="installation.php" method="get" name="installform">
    <input name="install" type="hidden" value="1" />
	<table border="0" class="form_table" align="center" cellpadding="4">
      
      
      <tr>
      	<td colspan="3">
        	<?php 
			if (isset($message) and $message!='') { 
				echo "<span class='alerts'>".$message."</span>";
			} else {
				echo 'These are the details that script will use to install and run: ';
			}
			?>
	  	</td>
      </tr>
      
      <tr>
        <td align="left" colspan="3" class="head_row">Minimum version required (PHP <?php echo $php_version_min; ?>, MySQL <?php echo $mysql_version_min; ?>): </td>
      </tr>
      
      	<?php 
		
		$error_msg = "";
		
		//////////////// CHECKING FOR PHP VERSION REQUIRED //////////////////
		
		$curr_php_version = phpversion();
		$check_php_version=true;
		
		
		if (version_compare($curr_php_version, $php_version_min, "<")) {
			//echo 'I am using PHP 5.4, my version: ' . phpversion() . "\n. Minimum is ".$php_version_min;
			$check_php_version=false;
		}
		
		if($check_php_version==false) {
			$not = "<span style='color:red;'>not</span>";
			$error_msg .= "PHP requirement checks failed and the script may not work properly. You have version ".$curr_php_version." but the required version is ".$php_version_min.". Please contact your hosting company or system administrator for assistance. <br />";
		} else {
			$not = "";
		}
		?>
        
      <tr>
        <td width="30%" align="left">PHP: </td>
        <td><?php echo "Server version of PHP '".$curr_php_version."' is ".$not." ok!"; ?> </td>
      </tr>
      
      
      	<?php 	
	  	//////////////// CHECKING FOR MYSQL VERSION REQUIRED //////////////////	
		$curr_mysql_version = '-.-.--';
		$not = "";		
		
		$check_mysql_version=true;		
		
		ob_start(); 
		phpinfo(INFO_MODULES); 
		$info = ob_get_contents(); 
		ob_end_clean(); 
		$info = stristr($info, 'Client API version'); 
		preg_match('/[1-9].[0-9].[1-9][0-9]/', $info, $match); 
		$gd = $match[0]; 
		//echo '</br>MySQL:  '.$gd.' <br />';
		$curr_mysql_version = $gd;
		
		
		if (version_compare($curr_mysql_version, $mysql_version_min, "<")) {
			$check_mysql_version=false;
			$not = "<span style='color:red;'>not</span>";
		} else if(trim($curr_mysql_version)=="-.-.--") {
			$error_msg .= "Information about MySQL version is missing or is incomplete. Please ask your hosting company or system administrator for the version. The minimum required version of MySQL is ".$mysql_version_min.". <br />";
			$not = "<span style='color:red;'>not</span>";
		}
		
		if($check_mysql_version==false) {
			$not = "<span style='color:red;'>not</span>";
			$error_msg .= "MySQL requirement checks failed and the script may not work properly. You have version ".$curr_mysql_version." but the required version is ".$mysql_version_min.". Please contact your hosting company or system administrator for assistance. <br />";
		} 
		?>
        
      <tr>
        <td align="left">MySQL: </td>
        <td><?php echo "Server version of MySQL '".$curr_mysql_version."' is ".$not." ok!"; ?></td>
      </tr> 
      
      <?php if(isset($error_msg) and $error_msg!='') {?>
      <tr>
        <td colspan="2" style="color:#FF0000;"><?php echo $error_msg; ?></td>
      </tr>       
      <?php } ?>
      
      <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
      
      <tr>
        <td align="left" colspan="3" class="head_row">MySQL login details: <span style="font-weight:normal; font-size:11px; font-style:italic;">(In case you don't have database yet, you should enter your hosting control panel and create it)</span></td>
      </tr>
      
      <tr>
        <td align="left">MySQL Server:</td>
        <td align="left"><input type="text" name="hostname" value="<?php if(isset($_REQUEST['hostname'])) echo $_REQUEST['hostname']; else echo 'localhost'; ?>" size="30" /></td>
      </tr>
      <tr>
        <td align="left">MySQL Username: </td>
        <td align="left"><input name="mysql_user" type="text" size="30" maxlength="50" value="<?php if(isset($_REQUEST['mysql_user'])) echo $_REQUEST['mysql_user']; ?>" /></td>
      </tr>
      <tr>
        <td align="left">MySQL Password: </td>
        <td align="left"><input name="mysql_password" type="text" size="30" maxlength="50" value="<?php if(isset($_REQUEST['mysql_password'])) echo $_REQUEST['mysql_password']; ?>" /></td>
      </tr>
      <tr>
        <td align="left">Database name:</td>
        <td align="left"><input name="mysql_database" type="text" size="30" maxlength="50" value="<?php if(isset($_REQUEST['mysql_database'])) echo $_REQUEST['mysql_database']; ?>" /></td>
      </tr>
      
      <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
      
      <tr>
        <td align="left" colspan="3" class="head_row">Installation paths to script directory: </td>
      </tr>
      
      	<?php 
	  	$server_path=$_SERVER['SCRIPT_FILENAME'];
		if (preg_match("/(.*)\//",$server_path,$matches)) {
			$server_path=$matches[0];
		}
		
		$server_path = str_replace("\\","/",$server_path);
		$server_path = str_replace("installation.php","",$server_path);
			
	  	?>
      <tr>
        <td align="left" valign="top">Server path to script directory:</td>
        <td align="left" colspan="2">
        	<input name="server_path" type="text" value="<?php echo $server_path; ?>" style="width:95%" /><br />
        	<span style="font-size:11px;font-style:italic;">Example: /home/server/public_html/SCRIPTFOLDER/ -  for Linux host</span><br />
            <span style="font-size:11px;font-style:italic;">Example: D:/server/www/websitedir/SCRIPTFOLDER/ -  for Windows host</span>
        </td>
      </tr>
      
      <?php 
	  	$full_url = 'http';
		if (array_key_exists('HTTPS', $_SERVER) && $_SERVER["HTTPS"] == "on") {$full_url .= "s";}
		$full_url .= "://";
		if ($_SERVER["SERVER_PORT"] != "80") {
			$full_url .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];
		} else {
			$full_url .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
		}
		if (preg_match("/(.*)\//",$full_url,$matches)) {
			$full_url=$matches[0];
		}
		//$full_url = str_replace("installation.php","",$full_url);
		?>
      <tr>
        <td align="left" valign="top">Full URL to script directory:</td>
        <td align="left" colspan="2">
        	<input name="full_url" type="text" value="<?php echo $full_url; ?>" style="width:95%" /><br />
        	<span style="font-size:11px;font-style:italic;">Example: http://yourdomain.com/SCRIPTFOLDER/</span>
        </td>
      </tr>      
      
      	<?php 
	  	$url = $_SERVER['PHP_SELF']; 
		if (preg_match("/(.*)\//",$url,$matches)) {
			$folder_name=$matches[0];
		}
	  	?>
      <tr>
        <td align="left" valign="top">Script directory name:</td>
        <td align="left" colspan="2">
        	<input name="folder_name" type="text" value="<?php echo $folder_name; ?>" style="width:95%" /><br />
            <span style="font-size:11px;font-style:italic;">Example: /SCRIPTFOLDER/</span>
        </td>
      </tr>
      
      	
      
      <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td align="left" colspan="3" class="head_row">Administrator login details: <span style="font-weight:normal; font-size:11px; font-style:italic;">(Choose Username and Password you should use later when log in admin area)</span></td>
      </tr>
      <tr>
        <td align="left">Admin Username:</td>
        <td align="left"><input name="admin_user" type="text" size="30" maxlength="50" value="<?php if(isset($_REQUEST['admin_user'])) echo $_REQUEST['admin_user']; ?>" /></td>
      </tr>
      <tr>
        <td align="left">Admin Password:</td>
        <td align="left"><input name="admin_pass" type="text" size="30" maxlength="50" value="<?php if(isset($_REQUEST['admin_pass'])) echo $_REQUEST['admin_pass']; ?>" /></td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td><input name="installScript" type="submit" value="Install Script"></td>
      </tr>
    </table>
	</form>
<?php } ?>    

</div>

</body>
</html>
