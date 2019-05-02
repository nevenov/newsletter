		<?php if(!isset($Options['form_arrange']) or ($Options['form_arrange'])=='') { 
			$Options['form_arrange']='horizontal'; 
		} ?>	
		<?php if($Options['collect_name']!='no') { // collect name ?>		
        <input type="text" class="<?php echo $Options['form_arrange']; ?>" name="name" value="<?php if(isset($_REQUEST['name'])) echo $_REQUEST['name']; ?>" placeholder="<?php echo $OptionsLang["Form_Name"]; ?>" required />
        <?php } ?>    
        
        <input class="<?php echo $Options['form_arrange']; ?>" type="text" name="email" value="<?php if(isset($_REQUEST['email'])) echo $_REQUEST['email']; ?>"  placeholder="<?php echo $OptionsLang["Form_Email"]; ?>" required />
        
        <?php
		if($Options['captcha']!='nocap' and $Options['form_arrange']=='vertical') { // if captcha and vertical form
			if($Options['captcha']=='cap') { $capFile = "captcha.php"; } else { $capFile = "captchasimple.php"; } ?>
        <input type="text" class="input_captcha" name="string" placeholder="<?php echo $OptionsLang["Form_Captcha"]; ?>" required = "true" /> 
        <img src="<?php echo $CONFIG["folder_name"].$capFile; ?>" class="img_captcha" /> 
        <?php 
		} ?>	
        
        <input class="<?php echo $Options['form_arrange']; ?>" name="button" type="submit" value="<?php echo $OptionsLang["Button_Subscribe"]; ?>" />
        
        <div class="clearboth"></div>