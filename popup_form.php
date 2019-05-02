<?php 
//error_reporting(0);
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
$OptionsVis = unserialize($Options['visual_form']);
$OptionsLang = unserialize(base64_decode($Options['language']));
?>
<style type="text/css">
/*
    Colorbox Core Style:
    The following CSS is consistent between example themes and should not be altered.
*/
#colorbox, #cboxOverlay, #cboxWrapper{position:absolute; top:0; left:0; z-index:9999; overflow:hidden; -webkit-transform: translate3d(0,0,0);}
#cboxWrapper {max-width:none;}
#cboxOverlay{position:fixed; width:100%; height:100%;}
#cboxMiddleLeft, #cboxBottomLeft{clear:left;}
#cboxContent{position:relative;}
#cboxLoadedContent{overflow:auto; -webkit-overflow-scrolling: touch;}
#cboxTitle{margin:0;}
#cboxLoadingOverlay, #cboxLoadingGraphic{position:absolute; top:0; left:0; width:100%; height:100%;}
#cboxPrevious, #cboxNext, #cboxClose, #cboxSlideshow{cursor:pointer;}
.cboxPhoto{float:left; margin:auto; border:0; display:block; max-width:none; -ms-interpolation-mode:bicubic;}
.cboxIframe{width:100%; height:100%; display:block; border:0; padding:0; margin:0;}
#colorbox, #cboxContent, #cboxLoadedContent{box-sizing:content-box; -moz-box-sizing:content-box; -webkit-box-sizing:content-box;}

/* 
    User Style:
    Change the following styles to modify the appearance of Colorbox.  They are
    ordered & tabbed in a way that represents the nesting of the generated HTML.
*/
#cboxOverlay{background:#000; opacity: 0.85; filter: alpha(opacity = 85); }
#colorbox{outline:0;box-shadow: 0px 0px 30px 5px rgb(0,0,0);}
    #cboxContent{padding-top:0px;}
        .cboxIframe{background:#fff;}
        #cboxError{padding:50px; border:1px solid #ccc;}
        #cboxLoadedContent{border:1px solid #000; background:#fff;}
        #cboxTitle{position:absolute; top:-20px; left:0; color:#ccc;}
        #cboxCurrent{position:absolute; top:-20px; right:0px; color:#ccc;}
        #cboxLoadingGraphic{background:url(<?php echo $CONFIG["full_url"]; ?>images/loading.gif) no-repeat center center;}

        /* these elements are buttons, and may need to have additional styles reset to avoid unwanted base styles */
        #cboxPrevious, #cboxNext, #cboxSlideshow, #cboxClose {border:0; padding:0; margin:0; overflow:visible; width:auto; background:none; }
        
        /* avoid outlines on :active (mouseclick), but preserve outlines on :focus (tabbed navigating) */
        #cboxPrevious:active, #cboxNext:active, #cboxSlideshow:active, #cboxClose:active {outline:0;}
        
        #cboxSlideshow{position:absolute; top:-20px; right:90px; color:#fff;}
        #cboxPrevious{position:absolute; top:50%; left:5px; margin-top:-32px; background:url(<?php echo $CONFIG["full_url"]; ?>images/controls.png) no-repeat top left; width:28px; height:65px; text-indent:-9999px;}
        #cboxPrevious:hover{background-position:bottom left;}
        #cboxNext{position:absolute; top:50%; right:5px; margin-top:-32px; background:url(<?php echo $CONFIG["full_url"]; ?>images/controls.png) no-repeat top right; width:28px; height:65px; text-indent:-9999px;}
        #cboxNext:hover{background-position:bottom right;}
        #cboxClose{position:absolute; top:1px; right:5px; display:block; background:url(<?php echo $CONFIG["full_url"]; ?>images/controls.png) no-repeat top center; width:38px; height:19px; text-indent:-9999px;}
        #cboxClose:hover{background-position:bottom center;}

</style>
<?php
if(!isset($jquery_added)) {?>
<script type="text/javascript">
//if (typeof jQuery == 'undefined') {
  document.write('<script type="text/javascript" src="<?php echo $CONFIG["full_url"]; ?>lightbox/js/jquery-1.11.0.min.js"><\/script>');        
//} 
</script>

<?php 
}
$jquery_added = true; 
?>
<script src="<?php echo $CONFIG["full_url"]; ?>include/jquery.colorbox.js"></script>
<script>
	  
<?php if($OptionsVis["popup_showing"]=="one") { ?>
	if (document.cookie.indexOf('colorframe=true') === -1) {
		var expires = new Date();
		expires.setDate(expires.getDate()+1);
		document.cookie = "colorframe=true; escKey=true; expires="+expires.toUTCString();
<?php } ?>		
		
		var myJqueryAlias = jQuery.noConflict();
		myJqueryAlias(document).ready(function(){	
		  setTimeout(function(){
				myJqueryAlias.colorbox({
					iframe:true, 
					width:"100%", 
					height:"100%", 
					maxWidth: "<?php echo $OptionsVis["popup_width"].$OptionsVis["popup_width_dim"];?>",
					maxHeight: "<?php echo $OptionsVis["popup_height"].$OptionsVis["popup_height_dim"];?>",
					opacity: <?php echo $OptionsVis["popup_bgr_trans"];?>,
					href: "<?php echo $CONFIG["full_url"]; ?>preview_iframe_form.php",
					escKey: true
				});
		  }, <?php echo $OptionsVis["popup_seconds"];?>000);
		});
		
		//window.setTimeout(function() {
		//	$.colorbox.close();
		//}, 5000);
<?php if($OptionsVis["popup_showing"]=="one") { ?>
	};
<?php } ?>	
</script>