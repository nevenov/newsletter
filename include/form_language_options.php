<?php if ( $Logged ){ ?>
	<form action="admin.php" method="post" name="frm">
	<input type="hidden" name="act" value="updateOptionsLanguage" />
    
    <div class="opt_headlist">Translate front-end in your own language. </div>
	
    <div id="accordion_container"> 
    
    
    <div class="accordion_toggle">Newsletters - Subscription Form</div>
    <div class="accordion_content">
    <table border="0" cellspacing="0" cellpadding="8" class="allTables">   
      <tr>
        <td class="langLeft">"SUBSCRIBE OUR NEWSLETTERS" heading:</td>
        <td class="left_top"><input name="Subscr_our_newsl" type="text" size="50" value="<?php echo ReadHTML($OptionsLang["Subscr_our_newsl"]); ?>" />&nbsp; <sub> - leave blank if you don't want that heading</sub></td>
      </tr> 
      <tr>
        <td class="langLeft">Email placeholder:</td>
        <td class="left_top"><input name="Form_Email" type="text" size="50" value="<?php echo ReadHTML($OptionsLang["Form_Email"]); ?>" /></td>
      </tr>         
      <tr>
        <td class="langLeft">Name placeholder:</td>
        <td class="left_top"><input name="Form_Name" type="text" size="50" value="<?php echo ReadHTML($OptionsLang["Form_Name"]); ?>" /></td>
      </tr>  
      <tr>
        <td class="langLeft">Address placeholder:</td>
        <td class="left_top"><input name="Form_Address" type="text" size="50" value="<?php echo ReadHTML($OptionsLang["Form_Address"]); ?>" /></td>
      </tr>  
      <tr>
        <td class="langLeft">ZIP Code placeholder:</td>
        <td class="left_top"><input name="Form_Zip_code" type="text" size="50" value="<?php echo ReadHTML($OptionsLang["Form_Zip_code"]); ?>" /></td>
      </tr>  
      <tr>
        <td class="langLeft">Captcha placeholder:</td>
        <td class="left_top"><input name="Form_Captcha" type="text" size="50" value="<?php echo ReadHTML($OptionsLang["Form_Captcha"]); ?>" /></td>
      </tr>  
      <tr>
        <td class="langLeft">Button "Subscribe":</td>
        <td class="left_top"><input name="Button_Subscribe" type="text" size="50" value="<?php echo ReadHTML($OptionsLang["Button_Subscribe"]); ?>" /></td>
      </tr>      
      <tr>
        <td class="langLeft">Data Protection:</td>
        <td class="left_top"><input name="Data_Protection" type="text" size="50" value="<?php echo ReadHTML($OptionsLang["Data_Protection"]); ?>" /></td>
      </tr>      
      <tr>
        <td class="langLeft">Button "Subscribe":</td>
        <td class="left_top"><textarea name="Terms_Condit" rows="4"><?php echo ReadHTML($OptionsLang["Terms_Condit"]); ?></textarea></td>
      </tr>     
      <tr>
        <td>&nbsp;</td>
        <td><input name="submit" type="submit" value="Save" class="submitButton" /></td>
      </tr>
    </table> 
    </div> 
    
    
    <div class="accordion_toggle">Popup Subscription Form Title and Description</div>
    <div class="accordion_content">
    <table border="0" cellspacing="0" cellpadding="8" class="allTables">  
      <tr>
        <td class="langLeft">Popup Title(heading):</td>
        <td class="left_top"><input name="popup_heading" type="text" size="50" value="<?php echo ReadHTML($OptionsLang["popup_heading"]); ?>" /></td>
      </tr>
      <tr>
        <td class="langLeft">Popup description:</td>
        <td class="left_top"><input name="popup_descr" type="text" size="50" value="<?php echo ReadHTML($OptionsLang["popup_descr"]); ?>" /></td>
      </tr> 
      <tr>
        <td>&nbsp;</td>
        <td><input name="submit" type="submit" value="Save" class="submitButton" /></td>
      </tr>
    </table> 
    </div> 
    
        
    <div class="accordion_toggle">Newsletters - Email</div>
    <div class="accordion_content">
    <table border="0" cellspacing="0" cellpadding="8" class="allTables">  
      <tr>
        <td class="langLeft">Newsletter Email Subject:</td>
        <td class="left_top"><input name="Email_Subject" type="text" size="50" value="<?php echo ReadHTML($OptionsLang["Email_Subject"]); ?>" /></td>
      </tr>
      <tr>
        <td class="langLeft">Unsubscribe from newsletters here:</td>
        <td class="left_top"><input name="Unsubscribe_from_newsletters" type="text" size="50" value="<?php echo ReadHTML($OptionsLang["Unsubscribe_from_newsletters"]); ?>" /> <input name="here" type="text" size="10" value="<?php echo ReadHTML($OptionsLang["here"]); ?>" /></td>
      </tr> 
      <tr>
        <td class="langLeft">Newsletter Greetings at the bottom of letter:</td>
        <td class="left_top"><textarea name="Greetings" rows="2"><?php echo ReadHTML($OptionsLang["Greetings"]); ?></textarea></td>
      </tr>
      
      <tr>
        <td class="langLeft">Newsletter Footer:</td>
        <td class="left_top"><textarea name="Newsletter_footer" rows="5"><?php echo ReadHTML($OptionsLang["Newsletter_footer"]); ?></textarea></td>
      </tr>
      
      <tr>
        <td>&nbsp;</td>
        <td><input name="submit" type="submit" value="Save" class="submitButton" /></td>
      </tr>
    </table> 
    </div> 
            
    
    <div class="accordion_toggle">Newsletters - System messages in the Subscription Form</div>
    <div class="accordion_content">
    <table border="0" cellspacing="0" cellpadding="8" class="allTables">            
      <tr>
        <td class="langLeft">Incorrect verification code:</td>
        <td class="left_top"><input name="Incorrect_verification_code" type="text" size="50" value="<?php echo ReadHTML($OptionsLang["Incorrect_verification_code"]); ?>" /></td>
      </tr>
      <tr>
        <td class="langLeft">Your email is already registered:</td>
        <td class="left_top"><input name="email_already_registered" type="text" size="50" value="<?php echo ReadHTML($OptionsLang["email_already_registered"]); ?>" /></td>
      </tr>  
      <tr>
        <td class="langLeft">You are re-subscibed successfully:</td>
        <td class="left_top"><input name="resubscribed_successfully" type="text" size="50" value="<?php echo ReadHTML($OptionsLang["resubscribed_successfully"]); ?>" /></td>
      </tr> 
      <tr>
        <td class="langLeft">Please, fill the form:</td>
        <td valign="top"><input name="fill_form" type="text" size="50" value="<?php echo ReadHTML($OptionsLang["fill_form"]); ?>" /></td> 
      </tr> 
      <tr>
        <td class="langLeft">Please, enter your name:</td>
        <td valign="top"><input name="enter_name" type="text" size="50" value="<?php echo ReadHTML($OptionsLang["enter_name"]); ?>" /></td> 
      </tr> 
      <tr>
        <td class="langLeft">Please, enter your email address:</td>
        <td class="left_top"><input name="enter_email_address" type="text" size="50" value="<?php echo ReadHTML($OptionsLang["enter_email_address"]); ?>" /></td>
      </tr>  
      <tr>
        <td class="langLeft">Please, enter correct email address:</td>
        <td class="left_top"><input name="correct_email_address" type="text" size="50" value="<?php echo ReadHTML($OptionsLang["correct_email_address"]); ?>" /></td>
      </tr>  
      <tr>
        <td class="langLeft">Please, enter your address:</td>
        <td valign="top"><input name="enter_address" type="text" size="50" value="<?php echo ReadHTML($OptionsLang["enter_address"]); ?>" /></td> 
      </tr> 
      <tr>
        <td class="langLeft">Please, enter your zip code:</td>
        <td valign="top"><input name="enter_zip" type="text" size="50" value="<?php echo ReadHTML($OptionsLang["enter_zip"]); ?>" /></td> 
      </tr> 
      <tr>
        <td class="langLeft">Please, enter the verification code:</td>
        <td class="left_top"><input name="field_code" type="text" size="50" value="<?php echo ReadHTML($OptionsLang["field_code"]); ?>" /></td>
      </tr> 
      <tr>
        <td class="langLeft">You are subscribed successfully to our newsletters:</td>
        <td class="left_top"><input name="subscribed_successfully" type="text" size="50" value="<?php echo ReadHTML($OptionsLang["subscribed_successfully"]); ?>" /></td>
      </tr> 
      <tr>
        <td class="langLeft">Please, check your email to confirm your subscription:</td>
        <td class="left_top"><input name="check_email_verification" type="text" size="50" value="<?php echo ReadHTML($OptionsLang["check_email_verification"]); ?>" /></td>
      </tr>      
      <tr>
        <td>&nbsp;</td>
        <td><input name="submit" type="submit" value="Save" class="submitButton" /></td>
      </tr>
    </table> 
    </div> 
	
      
    <div class="accordion_toggle">Newsletters - Email message to subscriber when subscription is successful</div>
    <div class="accordion_content">
    <table border="0" cellspacing="0" cellpadding="8" class="allTables">          
      <tr>
        <td class="langLeft">Please, click on the link below to confirm the subscription:</td>
        <td class="left_top"><input name="click_to_confirm_link" type="text" size="50" value="<?php echo ReadHTML($OptionsLang["click_to_confirm_link"]); ?>" /></td>
      </tr>    
      <tr>
        <td class="langLeft">Subject:</td>
        <td class="left_top"><input name="Successful_Subject" type="text" size="50" value="<?php echo ReadHTML($OptionsLang["Successful_Subject"]); ?>" /></td>
      </tr>
      <tr>
        <td class="langLeft">Email body:</td>
        <td class="left_top"><textarea name="Successful_body" cols="50" rows="3"><?php echo ReadHTML($OptionsLang["Successful_body"]); ?></textarea></td>
      </tr> 
      <tr>
        <td>&nbsp;</td>
        <td><input name="submit" type="submit" value="Save" class="submitButton" /></td>
      </tr>
    </table> 
    </div> 
    
    <div class="accordion_toggle">Newsletters - Email notice to admin when new subscription submitted</div>
    <div class="accordion_content">
    <table border="0" cellspacing="0" cellpadding="8" class="allTables">        
      <tr>
        <td class="langLeft">Subject:</td>
        <td class="left_top"><input name="Notice_Subject" type="text" size="50" value="<?php echo ReadHTML($OptionsLang["Notice_Subject"]); ?>" /></td>
      </tr>
      <tr>
        <td class="langLeft">Email body:</td>
        <td class="left_top"><textarea name="Notice_body" cols="50" rows="3"><?php echo ReadHTML($OptionsLang["Notice_body"]); ?></textarea></td>
      </tr> 
      <tr>
        <td>&nbsp;</td>
        <td><input name="submit" type="submit" value="Save" class="submitButton" /></td>
      </tr>
    </table> 
    </div> 
      
      
    <div class="accordion_toggle">Newsletters - Email message when "Unsubscribed"</div>
    <div class="accordion_content">  
	<table border="0" cellspacing="0" cellpadding="8" class="allTables"> 
      <tr>
        <td class="langLeft">You are unsubscribed successfully from our newsletters list:</td>
        <td class="left_top"><input name="unsubscribed_successfully" type="text" size="50" value="<?php echo ReadHTML($OptionsLang["unsubscribed_successfully"]); ?>" /></td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td><input name="submit" type="submit" value="Save" class="submitButton" /></td>
      </tr>
    </table> 
    </div>    
      
    <div class="accordion_toggle">Newsletters - Subscription verification message</div>
    <div class="accordion_content">  
	<table border="0" cellspacing="0" cellpadding="8" class="allTables"> 
      <tr>
        <td class="langLeft">Error verification of the subscription:</td>
        <td class="left_top"><input name="Error_request_validation" type="text" size="50" value="<?php echo ReadHTML($OptionsLang["Error_request_validation"]); ?>" /></td>
      </tr>
      <tr>
        <td class="langLeft">Successful verification of the subscription:</td>
        <td class="left_top"><input name="validation_successful" type="text" size="50" value="<?php echo ReadHTML($OptionsLang["validation_successful"]); ?>" /></td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td><input name="submit" type="submit" value="Save" class="submitButton" /></td>
      </tr>
    </table> 
    </div> 
    
    
    <div class="accordion_toggle">News navigations, links, category and paging</div>
    <div class="accordion_content">
    <table border="0" cellspacing="0" cellpadding="8" class="allTables">  
      <tr>
        <td class="langLeft">'Back' link:</td>
        <td class="left_top"><input class="input_lan" name="Back_to_home" type="text" value="<?php echo ReadHTML($OptionsLang["Back_to_home"]); ?>" />  &nbsp; <sub> - leave blank if you do not want 'Back' link </sub></td>
      </tr>        
      <tr>
        <td class="langLeft">"-- ALL --" in category:</td>
        <td class="left_top"><input class="input_lan" name="Category_all" type="text" value="<?php echo ReadDB($OptionsLang["Category_all"]); ?>" /></td>
      </tr> 
      <tr>
        <td class="langLeft">Pagination "Previous":</td>
        <td class="left_top"><input class="input_lan" name="Previous" type="text" value="<?php echo ReadHTML($OptionsLang["Previous"]); ?>" /></td>
      </tr> 
      <tr>
        <td class="langLeft">Pagination "Next":</td>
        <td class="left_top"><input class="input_lan" name="Next" type="text" value="<?php echo ReadHTML($OptionsLang["Next"]); ?>" /></td>
      </tr>  
      <tr>
        <td class="langLeft">No news published:</td>
        <td class="left_top"><input class="input_lan" name="No_news_published" type="text" value="<?php echo ReadHTML($OptionsLang["No_news_published"]); ?>" /></td>
      </tr>               
      <tr>
        <td class="langLeft">Article Hits:</td>
        <td class="left_top"><input class="input_lan" name="Article_Hits" type="text" value="<?php echo ReadHTML($OptionsLang["Article_Hits"]); ?>" /></td>
      </tr>              
      <tr>
        <td>&nbsp;</td>
        <td><input name="submit" type="submit" value="Save" class="submitButton" /></td>
      </tr> 
    </table> 
    </div> 
      
    
    <div class="accordion_toggle">Days of the week in the date</div>
    <div class="accordion_content">  
	<table border="0" cellspacing="0" cellpadding="8" class="allTables">         
      <tr>
        <td class="langLeft">Monday:</td>
        <td class="left_top"><input class="input_lan" name="Monday" type="text" value="<?php echo ReadHTML($OptionsLang["Monday"]); ?>" /></td>
      </tr>  
      <tr>
        <td class="langLeft">Tuesday:</td>
        <td class="left_top"><input class="input_lan" name="Tuesday" type="text" value="<?php echo ReadHTML($OptionsLang["Tuesday"]); ?>" /></td>
      </tr> 
      <tr>
        <td class="langLeft">Wednesday:</td>
        <td class="left_top"><input class="input_lan" name="Wednesday" type="text" value="<?php echo ReadHTML($OptionsLang["Wednesday"]); ?>" /></td>
      </tr>  
      <tr>
        <td class="langLeft">Thursday:</td>
        <td class="left_top"><input class="input_lan" name="Thursday" type="text" value="<?php echo ReadHTML($OptionsLang["Thursday"]); ?>" /></td>
      </tr>  
      <tr>
        <td class="langLeft">Friday:</td>
        <td class="left_top"><input class="input_lan" name="Friday" type="text" value="<?php echo ReadHTML($OptionsLang["Friday"]); ?>" /></td>
      </tr>  
      <tr>
        <td class="langLeft">Saturday:</td>
        <td class="left_top"><input class="input_lan" name="Saturday" type="text" value="<?php echo ReadHTML($OptionsLang["Saturday"]); ?>" /></td>
      </tr> 
      <tr>
        <td class="langLeft">Sunday:</td>
        <td class="left_top"><input class="input_lan" name="Sunday" type="text" value="<?php echo ReadHTML($OptionsLang["Sunday"]); ?>" /></td>
      </tr>           
      <tr>
        <td>&nbsp;</td>
        <td><input name="submit1" type="submit" value="Save" class="submitButton" /></td>
      </tr>
    </table> 
    </div> 
      
    
    <div class="accordion_toggle">Months in the date</div>
    <div class="accordion_content">  
	<table border="0" cellspacing="0" cellpadding="8" class="allTables">       
      <tr>
        <td class="langLeft">January:</td>
        <td class="left_top"><input class="input_lan" name="January" type="text" value="<?php echo ReadHTML($OptionsLang["January"]); ?>" /></td>
      </tr>  
      <tr>
        <td class="langLeft">February:</td>
        <td class="left_top"><input class="input_lan" name="February" type="text" value="<?php echo ReadHTML($OptionsLang["February"]); ?>" /></td>
      </tr> 
      <tr>
        <td class="langLeft">March:</td>
        <td class="left_top"><input class="input_lan" name="March" type="text" value="<?php echo ReadHTML($OptionsLang["March"]); ?>" /></td>
      </tr>  
      <tr>
        <td class="langLeft">April:</td>
        <td class="left_top"><input class="input_lan" name="April" type="text" value="<?php echo ReadHTML($OptionsLang["April"]); ?>" /></td>
      </tr>  
      <tr>
        <td class="langLeft">May:</td>
        <td class="left_top"><input class="input_lan" name="May" type="text" value="<?php echo ReadHTML($OptionsLang["May"]); ?>" /></td>
      </tr>  
      <tr>
        <td class="langLeft">June:</td>
        <td class="left_top"><input class="input_lan" name="June" type="text" value="<?php echo ReadHTML($OptionsLang["June"]); ?>" /></td>
      </tr> 
      <tr>
        <td class="langLeft">July:</td>
        <td class="left_top"><input class="input_lan" name="July" type="text" value="<?php echo ReadHTML($OptionsLang["July"]); ?>" /></td>
      </tr>   
      <tr>
        <td class="langLeft">August:</td>
        <td class="left_top"><input class="input_lan" name="August" type="text" value="<?php echo ReadHTML($OptionsLang["August"]); ?>" /></td>
      </tr> 
      <tr>
        <td class="langLeft">September:</td>
        <td class="left_top"><input class="input_lan" name="September" type="text" value="<?php echo ReadHTML($OptionsLang["September"]); ?>" /></td>
      </tr> 
      <tr>
        <td class="langLeft">October:</td>
        <td class="left_top"><input class="input_lan" name="October" type="text" value="<?php echo ReadHTML($OptionsLang["October"]); ?>" /></td>
      </tr> 
      <tr>
        <td class="langLeft">November:</td>
        <td class="left_top"><input class="input_lan" name="November" type="text" value="<?php echo ReadHTML($OptionsLang["November"]); ?>" /></td>
      </tr>   
      <tr>
        <td class="langLeft">December:</td>
        <td class="left_top"><input class="input_lan" name="December" type="text" value="<?php echo ReadHTML($OptionsLang["December"]); ?>" /></td>
      </tr>       
      <tr>
        <td>&nbsp;</td>
        <td><input name="submit2" type="submit" value="Save" class="submitButton" /></td>
      </tr> 
    </table> 
    </div> 
       
    
    <div class="accordion_toggle">Default meta tags for news page</div>
    <div class="accordion_content">  
	<table border="0" cellspacing="0" cellpadding="8" class="allTables">        
      <tr>
        <td class="langLeft">Meta title:</td>
        <td class="left_top"><input class="input_lan" name="metatitle" type="text" value="<?php echo ReadHTML($OptionsLang["metatitle"]); ?>" /></td>
      </tr>
      <tr>
        <td class="langLeft">Meta description:</td>
        <td class="left_top"><input class="input_lan" name="metadescription" type="text" value="<?php echo ReadHTML($OptionsLang["metadescription"]); ?>" /></td>
      </tr>            
      <tr>
        <td>&nbsp;</td>
        <td><input name="submit6" type="submit" value="Save" class="submitButton" /></td>
      </tr>
    </table> 
    </div> 
      
    </div> 
	</form>
<?php } ?>