<?php 
error_reporting(0);
$installed = '';
if(!isset($configs_are_set_nl)) {
	include( dirname(__FILE__). "/configs.php");
}
//$thisPage = $_SERVER['PHP_SELF'];
$phpSelf = filter_input(INPUT_SERVER, 'PHP_SELF', FILTER_SANITIZE_URL);
$thisPage = $phpSelf;

$EmailExist = "no";

$sql = "SELECT * FROM ".$TABLE["Options"];
$sql_result = sql_resultNL($sql);	
$Options = mysqli_fetch_assoc($sql_result);
mysqli_free_result($sql_result);
$Options["nl_form"] = unserialize($Options["nl_form"]);
$OptionsVis = unserialize($Options['visual_form']);
$OptionsLang = unserialize(base64_decode($Options['language']));

$SysMessage = "";

/////////////////////////////////////////////////
////// checking for correct captcha starts //////
if (isset($_POST["act"]) and $_POST["act"]=='subscribeNewsletter' and $Options['captcha']!='nocap' and $Options['form_arrange']=='vertical') {

	$testvariable = false;	// test variable is set to false
	
	if (preg_match('/^'.$_SESSION['key'].'$/i', $_REQUEST['string'])) { // test variable is set			
			$testvariable = true;			
		} else {		
		$SysMessage .=  ReadDB($OptionsLang["Incorrect_verification_code"]); 
		unset($_REQUEST["act"]);
	}
}
////// checking for correct captcha ends //////
///////////////////////////////////////////////


if(isset($_REQUEST["act"]) and $_REQUEST["act"]=="subscribeNewsletter"){
	
	
	$LastID = 0;
	
	if ($Options['captcha']=='nocap' or $Options['form_arrange']=='horizontal') $testvariable = true;
	
	if ($testvariable==true) { // if test variable is set to true, then go to update database and send emails
	
		$sql = "SELECT * FROM ".$TABLE["Subscribers"]." WHERE email='".SafetyDBNL($_REQUEST["email"])."'";
		$sql_result = sql_resultNL($sql);
		if(mysqli_num_rows($sql_result)>0){
			$Subscriber = mysqli_fetch_assoc($sql_result);
			if($Subscriber["status"]=='inactive') {
				$sql = "UPDATE ".$TABLE["Subscribers"]." 
						SET `status` = 'active' 
						WHERE email='".SafetyDBNL($_REQUEST["email"])."'";
				$sql_result = sql_resultNL($sql);
				$SysMessage = ReadHTML($OptionsLang["resubscribed_successfully"]);
			} else {
				$SysMessage = ReadHTML($OptionsLang["email_already_registered"]);
				unset($_REQUEST["act"]);
			}
			$EmailExist = "yes";
		} elseif(trim($_REQUEST["email"])=='') {
			$SysMessage = ReadHTML($OptionsLang["enter_email_address"]);
			unset($_REQUEST["act"]);
			$EmailExist = "yes";
		} elseif(mysqli_num_rows($sql_result)==0){	
			
			$status = "active";
			if($Options['verify_email']!='no') {
				$status = "inactive";
			}
			
			// check for required fields
			if(trim($_REQUEST["name"])=='' and $Options['collect_name']!='no') {
				$SysMessage .= ReadHTML($OptionsLang["enter_name"]);
				$EmailExist = "yes";
			}
			elseif(trim($_REQUEST["email"])=='') {
				$SysMessage .= ReadHTML($OptionsLang["enter_email_address"]);
				$EmailExist = "yes";
			}
			elseif(preg_match("/[.+a-zA-Z0-9_-]+@[a-zA-Z0-9-_]+/i", $_REQUEST["email"]) == 0 ) { // validate email address
				$SysMessage .= ReadHTML($OptionsLang["correct_email_address"]);
				$EmailExist = "yes";
			}
			else {
				
				if(!isset($_REQUEST["name"]) or $_REQUEST["name"]=="") $_REQUEST["name"]="";
				if(!isset($_REQUEST["address"]) or $_REQUEST["address"]=="") $_REQUEST["address"]="";
				if(!isset($_REQUEST["zip_code"]) or $_REQUEST["zip_code"]=="") $_REQUEST["zip_code"]="";
				
				$sql = "INSERT INTO `".$TABLE["Subscribers"]."` 
						SET	`cat_id` 		= '".SafetyDBNL($_REQUEST["cat_id"])."', 
							`name` 			= '".SafetyDBNL($_REQUEST["name"])."', 
							`email` 		= '".SafetyDBNL($_REQUEST["email"])."',
							`address` 		= '".SafetyDBNL($_REQUEST["address"])."',
							`zip_code` 		= '".SafetyDBNL($_REQUEST["zip_code"])."', 
							`status` 		= '".$status."', 
							`subscribe_date`= now()";
				$sql_result = sql_resultNL($sql);		
				$LastID = mysqli_insert_id($connNL);
			}
		}
	
		if($EmailExist!="yes") {
						
			$mailheader = "From: ".ReadDB($Options["admin_email"])."\r\n";
			$mailheader .= "Reply-To: ".ReadDB($Options["admin_email"])."\r\n";
			$mailheader .= "Content-type: text/html; charset=UTF-8\r\n";
			$Message_body = stripslashes($OptionsLang["Successful_body"]);
			if($Options['verify_email']!='no') {
				$Message_body .= ' <br />'.ReadHTML($OptionsLang["click_to_confirm_link"]).' <br />';
				$Message_body .= '<a href="'.$CONFIG["full_url"].'confirm_subscription.php?a=verify&amp;e='.$_REQUEST["email"].'&amp;i='.$LastID.'&amp;s='.md5($LastID.' - '.$_REQUEST["email"]).'">'.$CONFIG["full_url"].'confirm_subscription.php?a=verify&amp;e='.$_REQUEST["email"].'&amp;i='.$LastID.'&amp;s='.md5($LastID.' - '.$_REQUEST["email"]).'</a> <br />';
			}
			
			//////////// STARTING PHPMailer /////////////////////
			//adding PHPMailer library
			include( dirname(__FILE__). '/phpmailer/PHPMailerAutoload.php');
			
			//Create a new PHPMailer instance
			$mail = new PHPMailer;	
			
			if($Options["smtp_auth"]=="yes") {
				
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
				
				$mail->addAddress($_REQUEST["email"], $_REQUEST["email"]);		// Add a recipient
				
				$mail->AddReplyTo(ReadDB($Options["admin_email"]), ReadDB($Options["admin_email"]));// Add reply To email
				
				$mail->Subject = ReadDB($OptionsLang["Successful_Subject"]); // Set email subject	
		
				$mail->MsgHTML($Message_body);
				//$mail->Body    = $Message_body;
				$mail->AltBody = strip_tags($Message_body);
				
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
				
				
				if($Options['email_notice']!='no') {
					
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
					
					$mail->addAddress($Options["admin_email"], $Options["admin_email"]);		// Add a recipient
					
					$mail->AddReplyTo(ReadDB($Options["admin_email"]), ReadDB($Options["admin_email"]));// Add reply To email
					
					$mail->Subject = ReadDB($OptionsLang["Notice_Subject"]); // Set email subject	
			
					$mail->MsgHTML(ReadDB($OptionsLang["Notice_body"])."<br>".$_REQUEST["email"]."<br>".$_REQUEST["name"]);
					//$mail->Body    = $Message_body;
					$mail->AltBody = strip_tags(ReadDB($OptionsLang["Notice_body"])."<br>".$_REQUEST["email"]."<br>".$_REQUEST["name"]);
					
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
				}
			} else {
				
				//mail($_REQUEST["email"], ReadDB($OptionsLang["Successful_Subject"]), $Message_body, $mailheader);
				
				//Set who the message is to be sent from
				$mail->setFrom(ReadDB($Options["admin_email"]), ReadDB($Options["admin_email"]));
				//Set an alternative reply-to address
				$mail->addReplyTo(ReadDB($Options["admin_email"]), ReadDB($Options["admin_email"]));
				//Set who the message is to be sent to
				$mail->addAddress($_REQUEST["email"], $_REQUEST["email"]);
				$mail->CharSet = "UTF-8"; // force setting charset UTF-8
				//Set the subject line
				$mail->Subject = ReadDB($OptionsLang["Successful_Subject"]); // Set email subject
				//Read an HTML message body from an external file, convert referenced images to embedded,
				//convert HTML into a basic plain-text alternative body
				$mail->msgHTML($Message_body);
				//Replace the plain text body with one created manually
				$mail->AltBody = strip_tags($Message_body);
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
				
				if($Options['email_notice']!='no') {
					
					//mail($Options["admin_email"], ReadDB($OptionsLang["Notice_Subject"]), ReadDB($OptionsLang["Notice_body"]), $mailheader);
					
					//Set who the message is to be sent from
					$mail->setFrom(ReadDB($Options["admin_email"]), ReadDB($Options["admin_email"]));
					//Set an alternative reply-to address
					$mail->addReplyTo(ReadDB($Options["admin_email"]), ReadDB($Options["admin_email"]));
					//Set who the message is to be sent to
					$mail->addAddress($Options["admin_email"], $Options["admin_email"]);
					$mail->CharSet = "UTF-8"; // force setting charset UTF-8
					//Set the subject line
					$mail->Subject = ReadDB($OptionsLang["Notice_Subject"]); // Set email subject
					//Read an HTML message body from an external file, convert referenced images to embedded,
					//convert HTML into a basic plain-text alternative body
					$mail->msgHTML(ReadDB($OptionsLang["Notice_body"])."<br>".$_REQUEST["email"]."<br>".$_REQUEST["name"]);
					//Replace the plain text body with one created manually
					$mail->AltBody = strip_tags(ReadDB($OptionsLang["Notice_body"])."<br>".$_REQUEST["email"]."<br>".$_REQUEST["name"]);
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
			
			//////////// ENDING PHPMailer /////////////////////
			
			$SysMessage = ReadHTML($OptionsLang["subscribed_successfully"]);
			if($Options['verify_email']!='no') { 
				$SysMessage .= ReadHTML($OptionsLang["check_email_verification"]);
			}
			$_REQUEST["name"]='';
			$_REQUEST["email"]='';
			$_REQUEST["address"]='';
			$_REQUEST["zip_code"]='';
		} 
		?>
		<script language="JavaScript">
		
		<?php if($OptionsVis["popup_close_sec"]>0) {?>
		/* closing popup after submitting the form after X seconds */
		var win = parent.jQuery.colorbox;
		setTimeout(function(){
			win.close()
		}, <?php echo $OptionsVis["popup_close_sec"];?>000);
		<?php } else {?>
		window.location = '<?php echo $thisPage; ?>?SysMessage=<?php echo urlencode($SysMessage); ?>#onform'; // thank you on the popup
		<?php } ?>
		
		</script>
		<?php 
	} else {		
		$SysMessage .= $OptionsLang["Incorrect_verification_code"]; 
		unset($_REQUEST["act"]);
	}
} 
?>
<?php 
include($CONFIG["server_path"]."styles/css_front_end_form.php"); 
?>
<div class="form_wrapper">
	
    <?php if(trim($OptionsLang["Subscr_our_newsl"])!="") { ?>
    <div class="form_heading">
    <?php echo $OptionsLang["Subscr_our_newsl"]; ?>
    </div>
	<?php } ?>
    
    
	<a name="onform" id="onform"></a>
	<form name="formnewsletter" method="post" class="form_defaults" id="form_nl_ID">
    <input name="act" type="hidden" value="subscribeNewsletter">
	<table class="table_form_popup" border="0">
    	<tr>
        	<td align="left" colspan="5" class="form_message">
            <?php if(isset($_REQUEST['SysMessage']) and $_REQUEST['SysMessage']!='') { ?>
			<?php echo urldecode($_REQUEST['SysMessage']); ?>
            <?php } elseif(isset($SysMessage) and $SysMessage!='') { ?>
            <?php echo $SysMessage; ?>
            <?php } ?>
            <div id="Message_Validation" style="display:none;"><?php if(isset($OptionsLang["fill_form"]) and trim($OptionsLang["fill_form"])!="") { echo $OptionsLang["fill_form"]; } else { echo "Please, fill the form."; }?></div>
            </td>
        </tr>        
	</table>	
        
        <?php 
		if($Options['form_arrange']=='vertical') {
			include( dirname(__FILE__). "/include/incl_popup_form.php"); 
		} else {
			include( dirname(__FILE__). "/include/incl_form.php");
		}
		?>
	</form>
    
    <script type="text/javascript"> 
	var form = document.getElementById('form_nl_ID'); // form has to have ID: <form id="form_nl_ID">
	form.noValidate = true;
	form.addEventListener('submit', function(event) { // listen for form submitting
			if (!event.target.checkValidity()) {
				event.preventDefault(); // dismiss the default functionality
				//alert('Please, fill the form'); // error message
				document.getElementById('Message_Validation').style.display = 'block';
			}
		}, false);
	</script>
    
</div>