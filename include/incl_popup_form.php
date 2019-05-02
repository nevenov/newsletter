		<?php $Options['form_arrange']='vertical';  ?>	
        
        
		
		<?php 
		if(isset($_REQUEST["test"]) && $_REQUEST["test"]!="") {
			$test_cat = " ";
		} else {
			$test_cat = " AND cat_show = 'yes' ";
		}
		
		$sql = "SELECT * FROM ".$TABLE["Categories"]." WHERE id>0 ".$test_cat." ORDER BY cat_name ASC";
        $sql_result = sql_resultNL($sql);
        
		?>
        <select name="cat_id" class="<?php echo $Options['form_arrange']; ?>">
        	<?php
			if (mysqli_num_rows($sql_result)>0) {
				while ($Cat = mysqli_fetch_assoc($sql_result)) { ?>
				<option value="<?php echo $Cat["id"]; ?>"<?php if ($Cat["id"]==$_REQUEST["cat_id"]) echo ' selected="selected"'?>><?php echo ReadDB($Cat["cat_name"]); ?></option>
			<?php 
				}
			} ?> 
            
            <!--- <?php if(isset($_REQUEST["test"]) && $_REQUEST["test"]!="") {?>
            <option value="9999"<?php if ($Cat["id"]==$_REQUEST["cat_id"]) echo ' selected="selected"'?>>Test</option>
            <?php } ?> --->
                   
        </select>

        
        <input class="<?php echo $Options['form_arrange']; ?>" type="text" name="email" value="<?php if(isset($_REQUEST['email'])) echo $_REQUEST['email']; ?>"  placeholder="<?php echo $OptionsLang["Form_Email"]; ?>" required />
        
		<?php if($Options['collect_name']!='no') { // collect name ?>		
        <input type="text" class="<?php echo $Options['form_arrange']; ?>" name="name" value="<?php if(isset($_REQUEST['name'])) echo $_REQUEST['name']; ?>" placeholder="<?php echo $OptionsLang["Form_Name"]; ?>" required />
        <?php } ?> 
        
        
        <?php if (in_array("Address", $Options["nl_form"])) { ?>
        <input type="text" class="<?php echo $Options['form_arrange']; ?>" name="address" value="<?php if(isset($_REQUEST['address'])) echo $_REQUEST['address']; ?>" placeholder="<?php echo $OptionsLang["Form_Address"]; ?>" />
        <?php } ?>  
        
        
        <?php if (in_array("Zip_code", $Options["nl_form"])) { ?>
        <input type="text" class="<?php echo $Options['form_arrange']; ?>" name="zip_code" value="<?php if(isset($_REQUEST['zip_code'])) echo $_REQUEST['zip_code']; ?>" placeholder="<?php echo $OptionsLang["Form_Zip_code"]; ?>" />
        <?php } ?>   
        
        <?php
		if($Options['captcha']!='nocap' and $Options['form_arrange']=='vertical') { // if captcha and vertical form
			if($Options['captcha']=='cap') { $capFile = "captcha.php"; } else { $capFile = "captchasimple.php"; } ?>
        <input type="text" class="input_captcha" name="string" placeholder="<?php echo $OptionsLang["Form_Captcha"]; ?>" required = "true" /> 
        <img src="<?php echo $CONFIG["folder_name"].$capFile; ?>" class="img_captcha" /> 
        <?php 
		} ?>
        
        
        <input class="<?php echo $Options['form_arrange']; ?>" name="button" type="submit" value="<?php echo $OptionsLang["Button_Subscribe"]; ?>" />
        	
        
        
        
        <?php
		if($Options['form_arrange']=='vertical') { // if vertical form ?>        
		<div class="checkbox_terms">
        <label>
            <span class="data_protection">Datenschutz:</span> <input type="checkbox" name="agree" value="agree" id="agree" required /> <span class="terms_condit">Ich willige ein, dass meine Angaben zur Kontaktaufnahme und Zuordnung für eventuelle Rückfragen dauerhaft gespeichert werden. Hinweis: Diese Einwilligung können Sie jederzeit mit Wirkung für die Zukunft widerrufen, indem Sie eine E-Mail an kontakt@oststeinbeker-kulturring.de schicken. </span>
        </label>
        </div>
        <?php 
		} ?>
        
        <div class="clearboth"></div>