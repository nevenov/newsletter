<style type="text/css">

/* declare external fonts */
@font-face { font-family: AG-Foreigner-Light-Plain-Medium; src: url('<?php echo $CONFIG["full_url"]; ?>fonts/AG-Foreigner-Light-Plain-Medium.ttf'); } 
@font-face { font-family: Avalon-Bold; src: url('<?php echo $CONFIG["full_url"]; ?>fonts/Avalon-Bold.ttf'); }  
@font-face { font-family: Avalon-Plain; src: url('<?php echo $CONFIG["full_url"]; ?>fonts/Avalon-Plain.ttf'); } 
@font-face { font-family: Azbuka04; src: url('<?php echo $CONFIG["full_url"]; ?>fonts/Azbuka04.ttf'); } 
@font-face { font-family: Cour; src: url('<?php echo $CONFIG["full_url"]; ?>fonts/cour.ttf'); }  
@font-face { font-family: DSNote; src: url('<?php echo $CONFIG["full_url"]; ?>fonts/(DS)_Note.ttf'); }  
@font-face { font-family: HebarU; src: url('<?php echo $CONFIG["full_url"]; ?>fonts/HebarU.ttf'); } 
@font-face { font-family: Montserrat-Regular; src: url('<?php echo $CONFIG["full_url"]; ?>fonts/Montserrat-Regular.otf');}
@font-face { font-family: MTCORSVA; src: url('<?php echo $CONFIG["full_url"]; ?>fonts/MTCORSVA.TTF'); } 
@font-face { font-family: Lato-Regular; src: url('<?php echo $CONFIG["full_url"]; ?>fonts/Lato-Regular.ttf'); }  
@font-face { font-family: Nicoletta_script; src: url('<?php echo $CONFIG["full_url"]; ?>fonts/Nicoletta_script.ttf'); } 
@font-face { font-family: Oswald-Light; src: url('<?php echo $CONFIG["full_url"]; ?>fonts/Oswald-Light.otf'); }
@font-face { font-family: Oswald-Regular; src: url('<?php echo $CONFIG["full_url"]; ?>fonts/Oswald-Regular.ttf'); }
@font-face { font-family: Raleway-Regular; src: url('<?php echo $CONFIG["full_url"]; ?>fonts/Raleway-Regular.ttf'); } 
@font-face { font-family: Regina Kursiv; src: url('<?php echo $CONFIG["full_url"]; ?>fonts/ReginaKursiv.ttf'); }
@font-face { font-family: Segoe-UI; src: url('<?php echo $CONFIG["full_url"]; ?>fonts/Segoe-UI.ttf'); }  
@font-face { font-family: Tex Gyre Adventor;src:url('<?php echo $CONFIG["full_url"];?>fonts/texgyreadventor-regular.otf');}
@font-face { font-family: Ubuntu-R; src: url('<?php echo $CONFIG["full_url"]; ?>fonts/Ubuntu-R.ttf'); }  

.form_wrapper {
	font-family:<?php echo $OptionsVis["form_font_family"];?>; 
	color:<?php echo $OptionsVis["form_font_color"];?>; 
	font-size:<?php echo $OptionsVis["form_font_size"];?>;
	max-width:<?php echo $OptionsVis["form_width"];?><?php echo $OptionsVis["form_width_dim"];?>;
	margin: 0 auto;
	padding: 15px;
}
.form_wrapper * {
	-webkit-box-sizing: border-box;
	-moz-box-sizing: border-box;
	box-sizing: border-box;
}

.form_wrapper_popup {
	font-family:<?php echo $OptionsVis["form_font_family"];?>; 
	color:<?php echo $OptionsVis["form_font_color"];?>; 
	font-size:<?php echo $OptionsVis["form_font_size"];?>;
	max-width: 100%;
	margin: 0 auto;
	padding: 0 15px;
}
.form_wrapper_popup * {
	-webkit-box-sizing: border-box;
	-moz-box-sizing: border-box;
	box-sizing: border-box;
}

.form_defaults {
	margin:0px; 
	padding:0px;
}

/* clear float div */
div.clearboth {
	clear:both !important;
	height:0 !important; 
	line-height:0 !important; 
	font-size:0 !important; 
	padding:0 !important; 
	margin:0 !important;
}
div.clearclean {
	clear:both !important;
}

.form_heading {
	font-family: <?php echo $OptionsVis["head_form_font_family"];?>; 
	color: <?php echo $OptionsVis["head_form_font_color"];?>; 
	font-size: <?php echo $OptionsVis["head_form_font_size"];?>; 
	font-weight: <?php echo $OptionsVis["head_form_font_weight"];?>;
	font-style: <?php echo $OptionsVis["head_form_font_style"];?>;  
	text-align:center; 
	margin-bottom: <?php echo $OptionsVis["head_form_dist"];?>;  
	letter-spacing: 1px;
}

.popup_heading { 
	letter-spacing: 1px;
	color: #19466e;
	font-weight: bold;
	font-size: 20px;
	font-family: Arial, Helvetica, sans-serif;
	line-height: 1.3em;
	text-align: center;
	margin: 26px 0 2px 0;
}
.popup_descr {
	text-align: center;
	padding: 6px 12px 0 12px;
	font-size: 15px;
}

table.table_form {
	border-spacing: 0px !important;;
	width: 100% !important;;
	border: 0 !important;;
}
table.table_form td, table.table_form th {
	<?php if($Options['form_arrange']=='vertical') { ?>
    padding: 1%;
	<?php } else { ?>
	padding: 0;
	<?php } ?>
	text-align: left !important;
}

table.table_form_popup {
	border-spacing: 0px !important;
	width: 100% !important;
	border: 0 !important;
	margin: 0 auto;
	padding-bottom: 4px;
}
table.table_form_popup td, table.table_form_popup th {
    padding: 1.5%;
}
table.table_form_popup * {
	-webkit-box-sizing:border-box;
	-moz-box-sizing:border-box;
	box-sizing:border-box;	
}

.form_message {
	color:red;
	font-size:<?php echo $OptionsVis["form_font_size"];?>;
	height: <?php echo $OptionsVis["form_font_size"];?>;
	padding: 0 0 0 0.1% !important;
}

.confirm_message {
	min-width: 480px; 
	max-width: 600px; 
	margin: 20px auto; 
	padding: 20px; 
	color: #A94442; 
	background-color:#f2dede; 
	border: solid 1px #EBCCD1; 
	border-radius: 4px; text-align: 
	center; font-family: Helvetica,Arial,sans-serif; 
	font-size: 16px; 
	letter-spacing: 1px;
}
.cancel_message {
	min-width: 550px; 
	max-width: 700px; 
	margin: 20px auto; 
	padding: 20px; 
	color: #A94442; 
	background-color:#f2dede; 
	border: solid 1px #EBCCD1; 
	border-radius: 4px; 
	text-align: center; 
	font-family: Helvetica,Arial,sans-serif; 
	font-size: 16px; letter-spacing: 1px;
}

/* horizontal form style */
input[type=text].horizontal {
	font-family:<?php echo $OptionsVis["form_font_family"];?>; 
	color:<?php echo $OptionsVis["form_font_color"];?>; 
	font-size:<?php echo $OptionsVis["form_font_size"];?>;
    width: 39%;
    padding: 12px;
    margin-left: 1%;
    display: inline-block;
    border: 1px solid #ccc;
    box-sizing: border-box;
    float:left;
	border-radius: .125rem;
	/*box-shadow: 0 2px 5px 0 rgba(0,0,0,.16),0 2px 10px 0 rgba(0,0,0,.12);*/
	transition: color .15s ease-in-out,background-color .15s ease-in-out,border-color .15s ease-in-out,box-shadow .15s ease-in-out,-webkit-box-shadow .15s ease-in-out;
}

input[type=text].horizontal:focus, input[type=text].horizontal:active {
	border: solid 1px #03A9F4 !important;
	box-shadow: 0 2px 5px 0 rgba(0,0,0,.16),0 2px 10px 0 rgba(0,0,0,.12);
	outline: 0;
}
input[type=submit].horizontal {
	font-size:<?php echo $OptionsVis["form_font_size"];?>;
	width: 19%;
    padding: 12px;
    margin-left: 1%;
    display: inline-block;
    border: 1px solid <?php echo $OptionsVis["butt_bgr_color"];?>;
	border-radius: .125rem;
    box-sizing: border-box;
    float:left;
	cursor: pointer !important;
    background-color: <?php echo $OptionsVis["butt_bgr_color"];?>;
    color: white;
	box-shadow: 0 2px 5px 0 rgba(0,0,0,.16),0 2px 10px 0 rgba(0,0,0,.12);
	transition: color .15s ease-in-out,background-color .15s ease-in-out,border-color .15s ease-in-out,box-shadow .15s ease-in-out,-webkit-box-shadow .15s ease-in-out;
	opacity: 0.97;
}
input[type=submit].horizontal:hover, input[type=submit].horizontal:active {   
	opacity: 1; 
	box-shadow: 0 3px 7px 0 rgba(0,0,0,.18),0 4px 15px 0 rgba(0,0,0,.15);
	outline: 0;
	transition: color .15s ease-in-out,background-color .15s ease-in-out,border-color .15s ease-in-out,box-shadow .15s ease-in-out,-webkit-box-shadow .15s ease-in-out;
}

@media (max-width:500px) {
	input[type=text].horizontal  { 
		width:100%;
    	margin-left: 0;	
		margin-bottom: 6px;
	}
	input[type=submit].horizontal  { 
		width:100%;
    	margin-left: 0;	
	}
}



/* vertical form style */
input[type=text].vertical {
	font-family:<?php echo $OptionsVis["form_font_family"];?>; 
	color:<?php echo $OptionsVis["form_font_color"];?>; 
	font-size:<?php echo $OptionsVis["form_font_size"];?>;
    width: 100%;
    padding: 12px;
    display: inline-block;
    border: 1px solid #ccc;
    box-sizing: border-box;
	margin-bottom: 15px;
	border-radius: .125rem;
	/*box-shadow: 0 2px 5px 0 rgba(0,0,0,.16),0 2px 10px 0 rgba(0,0,0,.12);*/
	transition: color .15s ease-in-out,background-color .15s ease-in-out,border-color .15s ease-in-out,box-shadow .15s ease-in-out,-webkit-box-shadow .15s ease-in-out;
}
select.vertical {
	font-family:<?php echo $OptionsVis["form_font_family"];?>; 
	color:<?php echo $OptionsVis["form_font_color"];?>; 
	font-size:<?php echo $OptionsVis["form_font_size"];?>;
    width: 100%;
    padding: 12px;
    display: inline-block;
    border: 1px solid #ccc;
    box-sizing: border-box;
	margin-bottom: 15px;
	border-radius: .125rem;
	/*box-shadow: 0 2px 5px 0 rgba(0,0,0,.16),0 2px 10px 0 rgba(0,0,0,.12);*/
	transition: color .15s ease-in-out,background-color .15s ease-in-out,border-color .15s ease-in-out,box-shadow .15s ease-in-out,-webkit-box-shadow .15s ease-in-out;
}
input[type=text].input_captcha {
	font-family:<?php echo $OptionsVis["form_font_family"];?>; 
	color:<?php echo $OptionsVis["form_font_color"];?>; 
	font-size:<?php echo $OptionsVis["form_font_size"];?>;
    width: 40%;
    padding: 12px;
    display: inline-block;
    border: 1px solid #ccc;
    box-sizing: border-box;
	margin-bottom: 15px;
	float: left;
	border-radius: .125rem;
	/*box-shadow: 0 2px 5px 0 rgba(0,0,0,.16),0 2px 10px 0 rgba(0,0,0,.12);*/
	transition: color .15s ease-in-out,background-color .15s ease-in-out,border-color .15s ease-in-out,box-shadow .15s ease-in-out,-webkit-box-shadow .15s ease-in-out;
}
input[type=text].vertical:focus, input[type=text].input_captcha:focus {
	border: solid 1px #03A9F4 !important;
	box-shadow: 0 2px 5px 0 rgba(0,0,0,.16),0 2px 10px 0 rgba(0,0,0,.12);
	outline: 0;
}
img.img_captcha {
	float:left;
	margin-left: 2%;
	margin-top: 2px;
    display: inline-block;
}

input[type=submit].vertical {
	font-family:<?php echo $OptionsVis["form_font_family"];?>; 
    color: white;
	font-size:<?php echo $OptionsVis["form_font_size"];?>;
	width: 100%;
    padding: 12px;
    display: inline-block;
    border: 1px solid <?php echo $OptionsVis["butt_bgr_color"];?>;
	border-radius: .125rem;
    box-sizing: border-box;
	cursor: pointer !important;
    background-color: <?php echo $OptionsVis["butt_bgr_color"];?>;
	box-shadow: 0 2px 5px 0 rgba(0,0,0,.16),0 2px 10px 0 rgba(0,0,0,.12);
	transition: color .15s ease-in-out,background-color .15s ease-in-out,border-color .15s ease-in-out,box-shadow .15s ease-in-out,-webkit-box-shadow .15s ease-in-out;
	opacity: 0.97;
}
input[type=submit].vertical:hover {  
	opacity: 1; 
	box-shadow: 0 3px 7px 0 rgba(0,0,0,.18),0 4px 15px 0 rgba(0,0,0,.15);
	outline: 0;
	transition: color .15s ease-in-out,background-color .15s ease-in-out,border-color .15s ease-in-out,box-shadow .15s ease-in-out,-webkit-box-shadow .15s ease-in-out;
}

.checkbox_terms {
	padding-top: 20px;
}
.data_protection {
	display:block;
	float: left;
	width: 18%;
	font-size: 12px;
}
.terms_condit {	
	display:block;
	float: right;
	width: 77%;
	cursor:pointer;
	font-size: 11px;
}


</style>