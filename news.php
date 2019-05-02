<?php 
$installed = '';
if(!isset($configs_are_set_nl)) {
	include( dirname(__FILE__). "/configs.php");
}
//$thisPage = $_SERVER['PHP_SELF'];
$phpSelf = filter_input(INPUT_SERVER, 'PHP_SELF', FILTER_SANITIZE_URL);
$thisPage = $phpSelf;

$sql = "SELECT * FROM ".$TABLE["Options"];
$sql_result = sql_resultNL($sql);
$Options = mysqli_fetch_assoc($sql_result);
mysqli_free_result($sql_result);
$OptionsVis = unserialize($Options['visual']);
$OptionsLang = unserialize(base64_decode($Options['language']));

if(trim($Options['time_zone'])!='') {
	date_default_timezone_set(trim($Options['time_zone']));
}
$cur_date = date('Y-m-d H:i:s');

if(!isset($_REQUEST["p"])) $_REQUEST["p"] = ''; 
//if(!isset($_REQUEST["search"])) $_REQUEST["search"] = ''; 
if(isset($_REQUEST["cat_id"]) and $_REQUEST["cat_id"]!='') { 
	$_REQUEST["cat_id"] = (int) SafetyDBNL($_REQUEST["cat_id"]);
} else {
	$_REQUEST["cat_id"] = ''; 
}
$error='';

// defining recurring url variables in the grid
if (isset($_REQUEST["id"]) and $_REQUEST["id"]>0) $url_vars = "?p="; else $url_vars = "&amp;p=";
if(isset($_REQUEST["p"]) and $_REQUEST["p"]!='') $url_vars .= urlencode($_REQUEST["p"]);
if(isset($_REQUEST["cat_id"]) and $_REQUEST["cat_id"]>0) $url_vars .= "&amp;cat_id=".urlencode($_REQUEST["cat_id"]);
//$url_vars .= "&amp;search=";
//if(isset($_REQUEST["search"]) and $_REQUEST["search"]!='') $url_vars .= urlencode($_REQUEST["search"]);
$url_vars .= "#ontitle";

if(!function_exists('lang_date')){ 
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
}
?>
<meta name="viewport" content="width=device-width, initial-scale=1">
<!-- Latest compiled and minified CSS -->
<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
<?php
include($CONFIG["server_path"]."styles/css_front_end.php"); 

if(!isset($jquery_added)) {?>
<script type="text/javascript">
if (typeof jQuery == 'undefined') {
  document.write('<script type="text/javascript" src="<?php echo $CONFIG["full_url"]; ?>lightbox/js/jquery-1.11.0.min.js"><\/script>');        
} 
</script>
<?php 
}
$jquery_added = true; 
?>

<script src="<?php echo $CONFIG["full_url"]; ?>lightbox/js/lightbox.min.js"></script>
<link href="<?php echo $CONFIG["full_url"]; ?>lightbox/css/lightbox.css" rel="stylesheet" />

<script type="text/javascript" src="<?php echo $CONFIG["full_url"]; ?>include/textsizer.js">
/***********************************************
* Document Text Sizer- Copyright 2003 - Taewook Kang.  All rights reserved.
* Coded by: Taewook Kang (http://www.txkang.com)
***********************************************/
</script>

<div class="front_wrapper">

<?php 
if(!isset($_REQUEST['hide_cat']) and $Options['showcategdd']!='no') { 
	$sql = "SELECT * FROM ".$TABLE["Categories"]." ORDER BY cat_name ASC";
	$sql_result = sql_resultNL($sql);
	if (mysqli_num_rows($sql_result)>0) {
?> 
    <!-- categories -->
    <div class="w3-container w3-margin-top">
        <a class="margin_bottom6 w3-btn<?php if($_REQUEST["cat_id"]>0) echo " cat_menu"; else echo " cat_menu_sel"; ?>" href="?cat_id=0"><?php echo $OptionsLang["Category_all"]; ?></a>
        <?php 
        $sql = "SELECT * FROM ".$TABLE["Categories"]." ORDER BY cat_name ASC";
        $sql_result = sql_resultNL($sql);
        while ($Cat = mysqli_fetch_assoc($sql_result)) { ?>
        <a class="margin_bottom6 w3-btn<?php if($Cat["id"]!=$_REQUEST["cat_id"]) echo " cat_menu"; else echo " cat_menu_sel"; ?>" href="<?php echo $thisPage; ?>?cat_id=<?php echo $Cat["id"]; ?>"><?php echo $Cat["cat_name"]; ?></a>
        <!--<button class="w3-btn w3-light-grey w3-hide-small">Art</button> -->
        <?php } ?>  
    </div>
    
<?php 
		mysqli_free_result($sql_result); 
	}
} ?>  

	<div class="dist_menu_title"></div>
  
  
	
<?php
if (isset($_REQUEST["id"]) and $_REQUEST["id"]>0) {
	$_REQUEST["id"]= (int) SafetyDBNL($_REQUEST["id"]);
?>
	<div class="clearboth"></div> 
    
    <div class="w3-container">
    
    <!-- 'Back' link -->
	<?php if(trim($OptionsLang["Back_to_home"])!='') { ?>
    <div class="back_link"> <a href="<?php echo $thisPage; ?><?php echo $url_vars; ?>"> <?php echo ReadDB($OptionsLang["Back_to_home"]); ?></a></div>    
    <div class="back_link_dist"></div>    
    <?php } ?>

	<?php 
	$sql = "SELECT * FROM ".$TABLE["News"]." WHERE status='Published' AND id='".SafetyDBNL($_REQUEST["id"])."'";
	$sql_result = sql_resultNL($sql);
	if(mysqli_num_rows($sql_result)>0) {	
	  $News = mysqli_fetch_assoc($sql_result);
		
		// fetch post category
		$sqlCat   = "SELECT * FROM ".$TABLE["Categories"]." WHERE `id`='".$News["cat_id"]."'";
		$sql_resultCat = sql_resultNL($sqlCat);
		$Cat = mysqli_fetch_array($sql_resultCat);
	?>
	
    <!-- news title -->
	<div class="news_title">	  
		<?php echo ReadDB($News["title"]); ?>     
    </div>
    
    <div class="dist_title_date"></div>    
    
    <?php if($OptionsVis["show_date"]!='no' or $OptionsVis["show_aa"]!='no' or $OptionsVis["showhits"]!='no' or $OptionsVis["show_cat"]!='no') { ?>
    <div class="date_style">
    	<?php if($Cat["id"]>0 and $OptionsVis["show_cat"]!='no') echo "<span class='catLine'><a href='".$thisPage."?cat_id=".$Cat["id"]."'>".$Cat["cat_name"]."</a></span> &nbsp;<span class='straightLine'>|</span>&nbsp; "; ?>
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
    
    <div class="clearboth"></div> 
    
    <?php 
	$sql = "UPDATE ".$TABLE["News"]." 
			SET reviews = reviews + 1 
			WHERE id='".$News["id"]."'";
	$sql_result = sql_resultNL($sql);
	?>
    
    <?php if($OptionsVis["show_share_this"]=='yes') { ?>
    <div class="share_buttons">
        <!-- Go to www.addthis.com/dashboard to customize your tools -->
        <script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-53a185413dedbffa"></script>
        <div class="addthis_sharing_toolbox"></div>
    </div>
    <?php } ?>
    
    
    <div class="clearboth"></div> 
	
	<?php 
	} // end if news item mysql num rows 
	?>
    
    </div>
    
<?php
} else {
?>  
    

  <div class="w3-row-padding">
    
  	<?php 
	if(isset($_REQUEST["p"]) and $_REQUEST["p"]!='') { 
		$pageNum = (int) SafetyDBNL(urldecode($_REQUEST["p"]));
		if($pageNum<=0) $pageNum = 1;
	} else { 
		$pageNum = 1;
	}
	
	$search = "";
	if ($_REQUEST["cat_id"]>0) $search .= " AND cat_id='".SafetyDBNL($_REQUEST["cat_id"])."'";
	
	//if(isset($_REQUEST["search"]) and ($_REQUEST["search"]!="")) {
	//	$find = SafetyDBNL(urldecode($_REQUEST["search"]));
	//	$search .= " AND (title LIKE '%".$find."%' OR summary LIKE '%".$find."%' OR content LIKE '%".$find."%')";
	//}
	
	if ($Options["publishon"]=="yes") $search .= " AND publish_date <= '".$cur_date."'";
			
	$sql = "SELECT count(*) as total FROM ".$TABLE["News"]." WHERE status='Published' ".$search;
	$sql_result = sql_resultNL($sql);
	$row  = mysqli_fetch_array($sql_result);
	mysqli_free_result($sql_result);
	
	$total_pages = $row["total"];
	$adjacents = 1; // the adjacents to the current page digid when some pages are hidden
	$limit = $Options["per_page"];  //how many items to show per page
	$page = (int) SafetyDBNL(urldecode($_REQUEST["p"]));
	
	if($page) { 
		$start = ($page - 1) * $limit;  //first item to display on this page
	} else {
		$start = 0;	 //if no page var is given, set start to 0
	}
	
	/* Setup page vars for display. */
	if ($page == 0) $page = 1;					//if no page var is given, default to 1.
	$prev = $page - 1;							//previous page is page - 1
	$next = $page + 1;							//next page is page + 1
	$lastpage = ceil($total_pages/$limit);		//lastpage is = total pages / items per page, rounded up.
	$lpm1 = $lastpage - 1;						//last page minus 1
	
	// pagination query and variables ends

	$sql = "SELECT * FROM ".$TABLE["News"]."  
			WHERE status='Published' ".$search." 
			ORDER BY publish_date DESC 
			LIMIT " . ($pageNum-1)*$Options["per_page"] . "," . $Options["per_page"];	
	$sql_result = sql_resultNL($sql);
	
	$i = 1;
	
	if (mysqli_num_rows($sql_result)>0) {	
	  while ($News = mysqli_fetch_assoc($sql_result)) {	
	?>
        <div class="w3-third w3-container">
          
          <?php if(trim($News["image"])!="" and $OptionsVis["summ_show_image"]=='yes') {?>
          <a class="image_wrapper_grid" href="<?php echo $thisPage; ?>?id=<?php echo $News['id']; ?><?php echo $url_vars; ?>">
          	<div class="image_grid" style="background-image:url('<?php echo $CONFIG["full_url"].$CONFIG["upload_folderNL"].ReadDB($News["image"]); ?>');"></div>
          </a>
          <?php } ?>
        	
          <div class="np-title-descr-grid">
            <div><a class="news_title_grid" href="<?php echo $thisPage; ?>?id=<?php echo $News['id']; ?><?php echo $url_vars; ?>"><?php echo ReadDB($News["title"]); ?></a></div>
            <div class="news_short_descr"><?php echo nl2br(ReadDB($News["summary"])); ?></div>
          </div>
          <div class="dist_btw_news"></div>
        </div>
        
        <?php if($i%3==0) { ?>
        <div class="clearboth"></div>
    	<?php } ?>
        
    <?php 
		$i++;
	  } 
	} else {
	?>
	<div class="No_news_published"><?php echo $OptionsLang['No_news_published'] ?></div>
	<?php	
	}
	mysqli_free_result($sql_result);
	?>  
    </div> 

  
  	<!-- Pagination start here --> 
    <?php 
    // pagination starts. It can be shown wherever we need
    if($lastpage > 1) {	
        // defining recurring url variables
        //$paging_vars = "&amp;cat_id=".urlencode($_REQUEST["cat_id"])."&amp;search=".urlencode($_REQUEST["search"]);
		$paging_vars = "&amp;cat_id=".urlencode($_REQUEST["cat_id"]);
		
		$pag_align="w3-center";
		if($OptionsVis["pag_align_to"]=="left") { 
			$pag_align="w3-left-align"; 
		} 
		elseif($OptionsVis["pag_align_to"]=="right") {
			$pag_align="w3-right-align"; 
		} 
    ?>
    <div class="<?php echo $pag_align; ?> w3-padding-32">
      	<ul class="w3-pagination"> 
        <?php
        //previous button starts
        if ($page > 1) {
        ?>
        <li><a class="w3-hover-black page_numbers" href="<?php echo $thisPage."?p=".$prev;?><?php echo $paging_vars; ?>"><?php echo $OptionsLang["Previous"]; ?></a></li>
        <?php 
        }
        //previous button ends
        
        //pages	start
        if ($lastpage < 5 + ($adjacents * 2)) {	//not enough pages to bother breaking it up
            for ($counter = 1; $counter <= $lastpage; $counter++) {
                if ($counter == $page) { ?>
                <li><a class="w3-black page_numbers_sel"><?php echo $counter; ?></a></li>
                <?php } else { ?>
                <li><a class="w3-hover-black page_numbers" href="<?php echo $thisPage."?p=".$counter; ?><?php echo $paging_vars; ?>"><?php echo $counter; ?></a></li>
                <?php } 				
            }
        }
        elseif($lastpage > 3 + ($adjacents * 2)) {	//enough pages to hide some		
            //close to beginning; only hide later pages
            if($page < 1 + ($adjacents * 2)) {
                for ($counter = 1; $counter < 4 + ($adjacents * 2); $counter++) {
                    if ($counter == $page) { ?>
                    <li><a class="w3-black page_numbers_sel"><?php echo $counter; ?></a></li>
                    <?php } else { ?>
                    <li><a class="w3-hover-black page_numbers" href="<?php echo $thisPage."?p=".$counter; ?><?php echo $paging_vars; ?>"><?php echo $counter; ?></a></li>
                    <?php } 				
                } ?>           
            <?php   
            } elseif($lastpage - ($adjacents * 2) > $page && $page > ($adjacents * 2)) { //in middle; hide some front and some back ?>
                <?php 
                for ($counter = $page - $adjacents; $counter <= $page + $adjacents * 3; $counter++) {
                    if ($counter == $page) { ?>
                        <li><a class="w3-black page_numbers_sel"><?php echo $counter; ?></a></li>
                <?php } else { ?>
                        <li><a class="w3-hover-black page_numbers" href="<?php echo $thisPage."?p=".$counter; ?><?php echo $paging_vars; ?>"><?php echo $counter; ?></a></li>
                <?php }                                         
                } ?>
            <?php     		
            } else { //close to end; only hide early pages  ?>
                <?php 
                for ($counter = $lastpage - (2 + ($adjacents * 2)); $counter <= $lastpage; $counter++) {
                    if ($counter == $page) { ?>
                        <li><a class="w3-black page_numbers_sel"><?php echo $counter; ?></a></li>
                    <?php } else { ?>
                        <li><a class="w3-hover-black page_numbers" href="<?php echo $thisPage."?p=".$counter; ?><?php echo $paging_vars; ?>"><?php echo $counter; ?></a></li>
                    <?php } 					
                }
            }
        }
        
        //next button
        if ($page < $counter - 1) { ?>
            <li><a class="w3-hover-black page_numbers" href="<?php echo $thisPage."?p=".$next;?><?php echo $paging_vars; ?>"><?php echo $OptionsLang["Next"]; ?></a></li>
        <?php 
        }
        ?>
        </ul>
  	</div>
    <?php 
    } // pagination ends	
    ?> 
    <!-- Pagination end here --> 
<?php
}
?>


<?php if($OptionsVis["show_scrolltop"]!="no") {?>
<a href="#myAnchor" class="cd-top">Top</a>
<script type="text/javascript">

//$('.front_end_wrapper').prepend('<a href="#0" class="cd-top">Top</a>');

jQuery(document).ready(function($){
	// browser window scroll (in pixels) after which the "back to top" link is shown
	var offset = 300,
	//browser window scroll (in pixels) after which the "back to top" link opacity is reduced
	offset_opacity = 1200,
	//duration of the top scrolling animation (in ms)
	scroll_top_duration = 700,
	//grab the "back to top" link
	$back_to_top = $('.cd-top');

	//hide or show the "back to top" link
	$(window).scroll(function(){
		( $(this).scrollTop() > offset ) ? $back_to_top.addClass('cd-is-visible') : $back_to_top.removeClass('cd-is-visible cd-fade-out');
		if( $(this).scrollTop() > offset_opacity ) { 
			$back_to_top.addClass('cd-fade-out');
		}
	});

	//smooth scroll to top
	$back_to_top.on('click', function(event){
		event.preventDefault();
		$('body,html').animate({
			scrollTop: 0 ,
		 	}, scroll_top_duration
		);
	});

});

</script>
<?php } ?>
</div>

