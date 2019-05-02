<?php if ( $Logged ){ ?>
	<form action="admin.php" method="post" name="form">
	<input type="hidden" name="act" value="updateOptionsVisualNewsletters" />
    
    <div class="opt_headlist">Set subscription form and newsletter in email visual style</div>
	
    <div id="accordion_container"> 
    <div class="accordion_toggle">Subscription form heading style</div>
    <div class="accordion_content">
    <table border="0" cellspacing="0" cellpadding="8" class="allTables"> 
      <tr>
        <td class="langLeft">Heading font-family:</td>
        <td class="left_top">
        	<select name="head_form_font_family">
                <?php echo font_family_list($OptionsVis['head_form_font_family']); ?>
			</select>
        </td>
      </tr>            
      <tr>
        <td class="langLeft">Heading font-color:</td>
        <td class="left_top"><?php echo color_field("head_form_font_color", $OptionsVis["head_form_font_color"]); ?></td>
      </tr>
      <tr>
        <td class="langLeft">Heading font-size:</td>
        <td class="left_top">
        	<select name="head_form_font_size">
            	<option value="inherit"<?php if($OptionsVis['head_form_font_size']=='inherit') echo ' selected="selected"'; ?>>inherit</option>
                <?php for($i=8; $i<=32; $i++) {?>
            	<option value="<?php echo $i;?>px"<?php if($OptionsVis['head_form_font_size']==$i.'px') echo ' selected="selected"'; ?>><?php echo $i;?>px</option>
                <?php } ?>         
                <?php for($i = 0.5; $i <= 3; $i = $i + 0.1) {?>
            	<option value="<?php echo $i;?>em"<?php if($OptionsVis['head_form_font_size']==$i."em") echo ' selected="selected"'; ?>><?php echo $i;?>em</option>
                <?php } ?>
            </select>
        </td>
      </tr>          
	  <tr>
        <td class="langLeft">Heading font-weight:</td>
        <td class="left_top">
        	<select name="head_form_font_weight">
            	<option value="normal"<?php if($OptionsVis['head_form_font_weight']=='normal') echo ' selected="selected"'; ?>>normal</option>
            	<option value="bold"<?php if($OptionsVis['head_form_font_weight']=='bold') echo ' selected="selected"'; ?>>bold</option>
                <option value="inherit"<?php if($OptionsVis['head_form_font_weight']=='inherit') echo ' selected="selected"'; ?>>inherit</option>
            </select>
        </td>
      </tr>
      <tr>
        <td class="langLeft">Heading font-style:</td>
        <td class="left_top">
        	<select name="head_form_font_style">
            	<option value="normal"<?php if($OptionsVis['head_form_font_style']=='normal') echo ' selected="selected"'; ?>>normal</option>
            	<option value="italic"<?php if($OptionsVis['head_form_font_style']=='italic') echo ' selected="selected"'; ?>>italic</option>
                <option value="oblique"<?php if($OptionsVis['head_form_font_style']=='oblique') echo ' selected="selected"'; ?>>oblique</option>
                <option value="inherit"<?php if($OptionsVis['head_form_font_style']=='inherit') echo ' selected="selected"'; ?>>inherit</option>
            </select>
        </td>
      </tr>        
      <tr>
        <td class="langLeft">Distance Heading to form:</td>
        <td class="left_top">
        	<select name="head_form_dist">
                <?php for($i=0; $i<=50; $i++) {?>
            	<option value="<?php echo $i;?>px"<?php if($OptionsVis['head_form_dist']==$i.'px') echo ' selected="selected"'; ?>><?php echo $i;?>px</option>
                <?php } ?>
                <?php for($i = 0.1; $i <= 5; $i = $i + 0.1) {?>
            	<option value="<?php echo $i;?>em"<?php if($OptionsVis['head_form_dist']==$i."em") echo ' selected="selected"'; ?>><?php echo $i;?>em</option>
                <?php } ?>
            </select>
        </td>
      </tr>           
      <tr>
        <td>&nbsp;</td>
        <td><input name="submit1" type="submit" value="Save" class="submitButton" /></td>
      </tr>   
    </table> 
    </div> 
    
    <div class="accordion_toggle">Subscription form style</div>
    <div class="accordion_content">
    <table border="0" cellspacing="0" cellpadding="8" class="allTables"> 
      <tr>
        <td class="langLeft">Fields font-family:</td>
        <td class="left_top">
        	<select name="form_font_family">
                <?php echo font_family_list($OptionsVis['form_font_family']); ?>
			</select>
        </td>
      </tr>            
      <tr>
        <td class="langLeft">Fields font-color:</td>
        <td class="left_top"><?php echo color_field("form_font_color", $OptionsVis["form_font_color"]); ?></td>
      </tr>
      <tr>
        <td class="langLeft">Fields font-size:</td>
        <td class="left_top">
        	<select name="form_font_size">
            	<option value="inherit"<?php if($OptionsVis['form_font_size']=='inherit') echo ' selected="selected"'; ?>>inherit</option>
                <?php for($i=8; $i<=32; $i++) {?>
            	<option value="<?php echo $i;?>px"<?php if($OptionsVis['form_font_size']==$i.'px') echo ' selected="selected"'; ?>><?php echo $i;?>px</option>
                <?php } ?>         
                <?php for($i = 0.5; $i <= 3; $i = $i + 0.1) {?>
            	<option value="<?php echo $i;?>em"<?php if($OptionsVis['form_font_size']==$i."em") echo ' selected="selected"'; ?>><?php echo $i;?>em</option>
                <?php } ?>
            </select>
        </td>
      </tr>            
      <tr>
        <td class="langLeft">Subscribe button background-color:</td>
        <td class="left_top"><?php echo color_field("butt_bgr_color", $OptionsVis["butt_bgr_color"]); ?></td>
      </tr>         
      <tr>
        <td class="langLeft">Form width:</td>
        <td class="left_top"><input name="form_width" type="text" size="4" value="<?php echo ReadDB($OptionsVis["form_width"]); ?>" />
        <select name="form_width_dim">
            <option value="px"<?php if($OptionsVis['form_width_dim']=='px') echo ' selected="selected"'; ?>>px</option>
            <option value="%"<?php if($OptionsVis['form_width_dim']=='%') echo ' selected="selected"'; ?>>%</option>
            <option value="pt"<?php if($OptionsVis['form_width_dim']=='pt') echo ' selected="selected"'; ?>>pt</option>
            <option value="em"<?php if($OptionsVis['form_width_dim']=='em') echo ' selected="selected"'; ?>>em</option>
        </select> 
        &nbsp; <sub> - leave blank if you don't want fixed width</sub>
        </td>
      </tr>            
      <tr>
        <td>&nbsp;</td>
        <td><input name="submit1" type="submit" value="Save" class="submitButton" /></td>
      </tr>   
    </table> 
    </div> 
    
    
    <div class="accordion_toggle">Popup newsletter subscription form</div>
    <div class="accordion_content">
    <table border="0" cellspacing="0" cellpadding="8" class="allTables">       
      <tr>
        <td class="langLeft">Popup Overlay opacity:</td>
        <td class="left_top">
        	<select name="popup_bgr_trans">
                <?php for($i=0; $i<=1.05; $i += 0.05) {?>
            	<option value="<?php echo $i;?>"<?php if($OptionsVis['popup_bgr_trans']==(string)$i) echo ' selected="selected"'; ?>><?php echo $i*100;?>%</option>
                <?php } ?>
            </select>
        </td>
      </tr> 
      <tr>
        <td class="langLeft">Popup max-width:</td>
        <td class="left_top"><input name="popup_width" type="text" size="4" value="<?php echo ReadDB($OptionsVis["popup_width"]); ?>" />
        <select name="popup_width_dim">
            <option value="px"<?php if($OptionsVis['popup_width_dim']=='px') echo ' selected="selected"'; ?>>px</option>
            <option value="%"<?php if($OptionsVis['popup_width_dim']=='%') echo ' selected="selected"'; ?>>%</option>
            <option value="pt"<?php if($OptionsVis['popup_width_dim']=='pt') echo ' selected="selected"'; ?>>pt</option>
            <option value="em"<?php if($OptionsVis['popup_width_dim']=='em') echo ' selected="selected"'; ?>>em</option>
        </select> 
        </td>
      </tr>    
      <tr>
        <td class="langLeft">Popup max-height:</td>
        <td class="left_top"><input name="popup_height" type="text" size="4" value="<?php echo ReadDB($OptionsVis["popup_height"]); ?>" />
        <select name="popup_height_dim">
            <option value="px"<?php if($OptionsVis['popup_height_dim']=='px') echo ' selected="selected"'; ?>>px</option>
            <option value="%"<?php if($OptionsVis['popup_height_dim']=='%') echo ' selected="selected"'; ?>>%</option>
            <option value="pt"<?php if($OptionsVis['popup_height_dim']=='pt') echo ' selected="selected"'; ?>>pt</option>
            <option value="em"<?php if($OptionsVis['popup_height_dim']=='em') echo ' selected="selected"'; ?>>em</option>
        </select> 
        </td>
      </tr>  
      <tr>
        <td class="langLeft">Number of seconds that popup will appear after landing the page:</td>
        <td class="left_top">
        	<select name="popup_seconds">
                <?php for($i=0; $i<=60; $i++) {?>
            	<option value="<?php echo $i;?>"<?php if($OptionsVis['popup_seconds']==$i) echo ' selected="selected"'; ?>><?php echo $i;?></option>
                <?php } ?>
            </select>
        </td>
      </tr>       
      <tr>
        <td class="langLeft">Popup showing when landing the page:</td>
        <td class="left_top">
        	<select name="popup_showing">
            	<option value="one"<?php if($OptionsVis['popup_showing']=='one') echo ' selected="selected"'; ?>>one time</option>
            	<option value="any"<?php if($OptionsVis['popup_showing']=='any') echo ' selected="selected"'; ?>>any time</option>
            </select>
        </td>
      </tr>    
      <tr>
        <td class="langLeft">Number of seconds that popup will be closed after submitting the form:</td>
        <td class="left_top">
        	<select name="popup_close_sec">
                <?php for($i=0; $i<=60; $i++) {?>
            	<option value="<?php echo $i;?>"<?php if($OptionsVis['popup_close_sec']==$i) echo ' selected="selected"'; ?>><?php echo $i;?></option>
                <?php } ?>
            </select>
        	&nbsp; <sub> - leave "0" if you don't want to be automatically closed</sub>
        </td>
      </tr>       
      <tr>
        <td>&nbsp;</td>
        <td><input name="submit1" type="submit" value="Save" class="submitButton" /></td>
      </tr>   
    </table> 
    </div> 
    
    
    <div class="accordion_toggle">News title in newsletter</div>
    <div class="accordion_content">   
    <table border="0" cellspacing="0" cellpadding="8" class="allTables">  
      <tr>
        <td class="langLeft">Title font-family:</td>
        <td class="left_top" style="font-family:">
        	<select name="nl_tit_font">
            	<?php echo font_family_list($OptionsVis['nl_tit_font']); ?>
            </select>
        </td>
      </tr> 
      <tr>
        <td class="langLeft">Title color:</td>
        <td class="left_top"><?php echo color_field("nl_tit_color", $OptionsVis["nl_tit_color"]); ?></td>
      </tr>
      <tr>
        <td class="langLeft">Title font-size:</td>
        <td class="left_top">
        	<select name="nl_tit_size">
            	<option value="inherit"<?php if($OptionsVis['nl_tit_size']=='inherit') echo ' selected="selected"'; ?>>inherit</option>
            	<?php for($i=8; $i<=32; $i++) {?>
            	<option value="<?php echo $i;?>px"<?php if($OptionsVis['nl_tit_size']==$i.'px') echo ' selected="selected"'; ?>><?php echo $i;?>px</option>
                <?php } ?>       
                <?php for($i = 0.5; $i <= 3; $i = $i + 0.1) {?>
            	<option value="<?php echo $i;?>em"<?php if($OptionsVis['nl_tit_size']==$i."em") echo ' selected="selected"'; ?>><?php echo $i;?>em</option>
                <?php } ?>
            </select>
        </td>
      </tr>
      <tr>
        <td class="langLeft">Title font-weight:</td>
        <td class="left_top">
        	<select name="nl_tit_font_weight">
            	<option value="normal"<?php if($OptionsVis['nl_tit_font_weight']=='normal') echo ' selected="selected"'; ?>>normal</option>
            	<option value="bold"<?php if($OptionsVis['nl_tit_font_weight']=='bold') echo ' selected="selected"'; ?>>bold</option>
                <option value="inherit"<?php if($OptionsVis['nl_tit_font_weight']=='inherit') echo ' selected="selected"'; ?>>inherit</option>
            </select>
        </td>
      </tr>
      <tr>
        <td class="langLeft">Title font-style:</td>
        <td class="left_top">
        	<select name="nl_tit_font_style">
            	<option value="normal"<?php if($OptionsVis['nl_tit_font_style']=='normal') echo ' selected="selected"'; ?>>normal</option>
            	<option value="italic"<?php if($OptionsVis['nl_tit_font_style']=='italic') echo ' selected="selected"'; ?>>italic</option>
                <option value="oblique"<?php if($OptionsVis['nl_tit_font_style']=='oblique') echo ' selected="selected"'; ?>>oblique</option>
                <option value="inherit"<?php if($OptionsVis['nl_tit_font_style']=='inherit') echo ' selected="selected"'; ?>>inherit</option>
            </select>
        </td>
      </tr>      
      <tr>
        <td class="langLeft">Title line-height:</td>
        <td class="left_top">
        	<select name="nl_tit_line_height">
                <option value="inherit"<?php if($OptionsVis['nl_tit_line_height']=='inherit') echo ' selected="selected"'; ?>>inherit</option>
                <?php for($i=12; $i<=100; $i++) {?>
            	<option value="<?php echo $i;?>px"<?php if($OptionsVis['nl_tit_line_height']==$i.'px') echo ' selected="selected"'; ?>><?php echo $i;?>px</option>
                <?php } ?>
                <?php for($h=1; $h<=5; $h+=0.1) {?>
            	<option value="<?php echo round($h,1);?>"<?php if(round($OptionsVis['nl_tit_line_height'],1)==round($h,1)) echo ' selected="selected"'; ?>><?php echo $h;?></option>
                <?php } ?>
            </select>
        </td>
      </tr>    
      <tr>
        <td>&nbsp;</td>
        <td><input name="submit2" type="submit" value="Save" class="submitButton" /></td>
      </tr> 
    </table>
    </div>
    
      
      
    <div class="accordion_toggle">Newsletter content style</div>
    <div class="accordion_content">   
    <table border="0" cellspacing="0" cellpadding="8" class="allTables"> 
      <tr>
        <td class="langLeft">Content font-family:</td>
        <td class="left_top">
        	<select name="nl_cont_font">
            	<?php echo font_family_list($OptionsVis['nl_cont_font']); ?>
            </select>
        </td>
      </tr>
      <tr>
        <td class="langLeft">Content color:</td>
        <td class="left_top"><?php echo color_field("nl_cont_color", $OptionsVis["nl_cont_color"]); ?></td>
      </tr>
      <tr>
        <td class="langLeft">Content font-size:</td>
        <td class="left_top">
        	<select name="nl_cont_size">
            	<option value="inherit"<?php if($OptionsVis['nl_cont_size']=='inherit') echo ' selected="selected"'; ?>>inherit</option>
            	<?php for($i=8; $i<=32; $i++) {?>
            	<option value="<?php echo $i;?>px"<?php if($OptionsVis['nl_cont_size']==$i.'px') echo ' selected="selected"'; ?>><?php echo $i;?>px</option>
                <?php } ?>         
                <?php for($i = 0.5; $i <= 3; $i = $i + 0.1) {?>
            	<option value="<?php echo $i;?>em"<?php if($OptionsVis['nl_cont_size']==$i."em") echo ' selected="selected"'; ?>><?php echo $i;?>em</option>
                <?php } ?>
            </select>
        </td>
      </tr>
      <tr>
        <td class="langLeft">Content font-style:</td>
        <td class="left_top">
        	<select name="nl_cont_font_style">
            	<option value="normal"<?php if($OptionsVis['nl_cont_font_style']=='normal') echo ' selected="selected"'; ?>>normal</option>
            	<option value="italic"<?php if($OptionsVis['nl_cont_font_style']=='italic') echo ' selected="selected"'; ?>>italic</option>
                <option value="oblique"<?php if($OptionsVis['nl_cont_font_style']=='oblique') echo ' selected="selected"'; ?>>oblique</option>
                <option value="inherit"<?php if($OptionsVis['nl_cont_font_style']=='inherit') echo ' selected="selected"'; ?>>inherit</option>
            </select>
        </td>
      </tr>
      <tr>
        <td class="langLeft">Content text-align:</td>
        <td class="left_top">
        	<select name="nl_cont_text_align">
            	<option value="center"<?php if($OptionsVis['nl_cont_text_align']=='center') echo ' selected="selected"'; ?>>center</option>
            	<option value="justify"<?php if($OptionsVis['nl_cont_text_align']=='justify') echo ' selected="selected"'; ?>>justify</option>
                <option value="left"<?php if($OptionsVis['nl_cont_text_align']=='left') echo ' selected="selected"'; ?>>left</option>
                <option value="right"<?php if($OptionsVis['nl_cont_text_align']=='right') echo ' selected="selected"'; ?>>right</option>
                <option value="inherit"<?php if($OptionsVis['nl_cont_text_align']=='inherit') echo ' selected="selected"'; ?>>inherit</option>
            </select>
        </td>
      </tr>
      <tr>
        <td class="langLeft">News content line-height:</td>
        <td class="left_top">
        	<select name="nl_cont_line_height">
            	<option value="inherit"<?php if($OptionsVis['nl_cont_line_height']=='inherit') echo ' selected="selected"'; ?>>inherit</option>
            	<?php for($i=12; $i<=100; $i++) {?>
            	<option value="<?php echo $i;?>px"<?php if($OptionsVis['nl_cont_line_height']==$i.'px') echo ' selected="selected"'; ?>><?php echo $i;?>px</option>
                <?php } ?>
                <?php for($h=1; $h<=5; $h+=0.1) {?>
            	<option value="<?php echo round($h,1);?>"<?php if(round($OptionsVis['nl_cont_line_height'],1)==round($h,1)) echo ' selected="selected"'; ?>><?php echo $h;?></option>
                <?php } ?>
            </select>
        </td>
      </tr>    
      <tr>
        <td class="langLeft">Width of the newsletter in the email:</td>
        <td class="left_top"><input name="newsletter_width" type="text" size="4" value="<?php echo ReadDB($OptionsVis["newsletter_width"]); ?>" />px</td>
      </tr>  
          
      <tr>
        <td class="langLeft">Image max-width:</td>
        <td class="left_top"><input name="image_max_width" type="text" size="4" value="<?php echo ReadDB($OptionsVis["image_max_width"]); ?>" />px</td>
      </tr>    
      <tr>
        <td>&nbsp;</td>
        <td><input name="submit4" type="submit" value="Save" class="submitButton" /></td>
      </tr>
    </table>
    </div>
    
    </div>
	</form>
<?php } ?>