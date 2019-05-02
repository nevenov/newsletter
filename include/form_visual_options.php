<?php if ( $Logged ){ ?>
	<form action="admin.php" method="post" name="form">
	<input type="hidden" name="act" value="updateOptionsVisual" />
    
    <div class="opt_headlist">Set news front-end visual style</div>
	
    <div id="accordion_container"> 
    <div class="accordion_toggle">General style</div>
    <div class="accordion_content">
    <table border="0" cellspacing="0" cellpadding="8" class="allTables"> 
      <tr>
        <td class="langLeft">General font-family:</td>
        <td class="left_top">
        	<select name="gen_font_family">
                <?php echo font_family_list($OptionsVis['gen_font_family']); ?>
			</select>
        </td>
      </tr>            
      <tr>
        <td class="langLeft">General font-color:</td>
        <td class="left_top"><?php echo color_field("gen_font_color", $OptionsVis["gen_font_color"]); ?></td>
      </tr>
      <tr>
        <td class="langLeft">General font-size:</td>
        <td class="left_top">
        	<select name="gen_font_size">
            	<option value="inherit"<?php if($OptionsVis['gen_font_size']=='inherit') echo ' selected="selected"'; ?>>inherit</option>
                <?php for($i=8; $i<=50; $i++) {?>
            	<option value="<?php echo $i;?>px"<?php if($OptionsVis['gen_font_size']==$i.'px') echo ' selected="selected"'; ?>><?php echo $i;?>px</option>
                <?php } ?>           
                <?php for($i = 0.5; $i <= 3; $i = $i + 0.1) {?>
            	<option value="<?php echo $i;?>em"<?php if($OptionsVis['gen_font_size']==$i."em") echo ' selected="selected"'; ?>><?php echo $i;?>em</option>
                <?php } ?>
            </select>
        </td>
      </tr>
      <tr>
        <td class="langLeft">General line-height:</td>
        <td class="left_top">
        	<select name="gen_line_height">
            	<option value="inherit"<?php if($OptionsVis['gen_line_height']=='inherit') echo ' selected="selected"'; ?>>inherit</option>
                <?php for($i=12; $i<=50; $i++) {?>
            	<option value="<?php echo $i;?>px"<?php if($OptionsVis['gen_line_height']==$i.'px') echo ' selected="selected"'; ?>><?php echo $i;?>px</option>
                <?php } ?>
                <?php for($h=1; $h<=5; $h+=0.1) {?>
            	<option value="<?php echo round($h,1);?>"<?php if(round($OptionsVis['gen_line_height'],1)==round($h,1)) echo ' selected="selected"'; ?>><?php echo $h;?></option>
                <?php } ?>
            </select>
        </td>
      </tr>         
      <tr>
        <td class="langLeft">General background-color:</td>
        <td class="left_top"><?php echo color_field("gen_bgr_color", $OptionsVis["gen_bgr_color"]); ?></td>
      </tr>           
      <tr>
        <td class="langLeft">General news width:</td>
        <td class="left_top"><input name="gen_width" type="text" size="4" value="<?php echo ReadDB($OptionsVis["gen_width"]); ?>" />
        <select name="gen_width_dim">
            <option value="px"<?php if($OptionsVis['gen_width_dim']=='px') echo ' selected="selected"'; ?>>px</option>
            <option value="%"<?php if($OptionsVis['gen_width_dim']=='%') echo ' selected="selected"'; ?>>%</option>
            <option value="pt"<?php if($OptionsVis['gen_width_dim']=='pt') echo ' selected="selected"'; ?>>pt</option>
            <option value="em"<?php if($OptionsVis['gen_width_dim']=='em') echo ' selected="selected"'; ?>>em</option>
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
    
    
    <div class="accordion_toggle">Categories menu style</div>
    <div class="accordion_content">  
	<table border="0" cellspacing="0" cellpadding="8" class="allTables">       
      <tr>
        <td class="langLeft">Color:</td>
        <td class="left_top"><?php echo color_field("cat_menu_color", $OptionsVis["cat_menu_color"]); ?></td>
      </tr>         
      <tr>
        <td class="langLeft">Background color:</td>
        <td class="left_top"><?php echo color_field("cat_menu_bgr", $OptionsVis["cat_menu_bgr"]); ?></td>
      </tr>         
      <tr>
        <td class="langLeft">Color selected:</td>
        <td class="left_top"><?php echo color_field("cat_menu_color_sel", $OptionsVis["cat_menu_color_sel"]); ?></td>
      </tr>                     
      <tr>
        <td class="langLeft">Background color selected:</td>
        <td class="left_top"><?php echo color_field("cat_menu_bgr_sel", $OptionsVis["cat_menu_bgr_sel"]); ?></td>
      </tr>  
      <tr>
        <td class="langLeft">Font-family:</td>
        <td class="left_top">
        	<select name="cat_menu_family">
            	<?php echo font_family_list($OptionsVis['cat_menu_family']); ?>
            </select>
        </td>
      </tr>       
      <tr>
        <td class="langLeft">Font-size:</td>
        <td class="left_top">
        	<select name="cat_menu_size">
            	<option value="inherit"<?php if($OptionsVis['cat_menu_size']=='inherit') echo ' selected="selected"'; ?>>inherit</option>
                <?php for($i=8; $i<=32; $i++) {?>
            	<option value="<?php echo $i;?>px"<?php if($OptionsVis['cat_menu_size']==$i.'px') echo ' selected="selected"'; ?>><?php echo $i;?>px</option>
                <?php } ?>           
                <?php for($i = 0.5; $i <= 3; $i = $i + 0.1) {?>
            	<option value="<?php echo $i;?>em"<?php if($OptionsVis['cat_menu_size']==$i."em") echo ' selected="selected"'; ?>><?php echo $i;?>em</option>
                <?php } ?>
            </select>
        </td>
      </tr>
      <tr>
        <td class="langLeft">Font-weight:</td>
        <td class="left_top">
        	<select name="cat_menu_weight">
            	<option value="normal"<?php if($OptionsVis['cat_menu_weight']=='normal') echo ' selected="selected"'; ?>>normal</option>
            	<option value="bold"<?php if($OptionsVis['cat_menu_weight']=='bold') echo ' selected="selected"'; ?>>bold</option>
                <option value="inherit"<?php if($OptionsVis['cat_menu_weight']=='inherit') echo ' selected="selected"'; ?>>inherit</option>
            </select>
        </td>
      </tr>   
      <tr>
        <td>&nbsp;</td>
        <td><input name="submit2" type="submit" value="Save" class="submitButton" /></td>
      </tr> 
      <tr>
        <td colspan="3" height="8"></td>
      </tr>
	</table>
    </div>
    
   	
    <div class="accordion_toggle">'Back' link style</div>
    <div class="accordion_content">  
	<table border="0" cellspacing="0" cellpadding="8" class="allTables"> 
      <tr>
        <td class="langLeft">News summary font-family:</td>
        <td class="left_top">
        	<select name="link_font">
            	<?php echo font_family_list($OptionsVis['link_font']); ?>
            </select>
        </td>
      </tr>   
      <tr>
        <td class="langLeft">Back link font-color:</td>
        <td class="left_top"><?php echo color_field("link_color", $OptionsVis["link_color"]); ?></td>
      </tr> 
      <tr>
        <td class="langLeft">Color on hover(on mouse over):</td>
        <td class="left_top"><?php echo color_field("link_color_hover", $OptionsVis["link_color_hover"]); ?></td>
      </tr>
      <tr>
        <td class="langLeft">Back link font-size:</td>
        <td class="left_top">
        	<select name="link_font_size">
            	<option value="inherit"<?php if($OptionsVis['link_font_size']=='inherit') echo ' selected="selected"'; ?>>inherit</option>
                <?php for($i=8; $i<=32; $i++) {?>
            	<option value="<?php echo $i;?>px"<?php if($OptionsVis['link_font_size']==$i.'px') echo ' selected="selected"'; ?>><?php echo $i;?>px</option>
                <?php } ?>         
                <?php for($i = 0.5; $i <= 3; $i = $i + 0.1) {?>
            	<option value="<?php echo $i;?>em"<?php if($OptionsVis['link_font_size']==$i."em") echo ' selected="selected"'; ?>><?php echo $i;?>em</option>
                <?php } ?>
            </select>
        </td>
      </tr>
      <tr>
        <td class="langLeft">Back link font-weight:</td>
        <td class="left_top">
        	<select name="link_font_weight">
            	<option value="normal"<?php if($OptionsVis['link_font_weight']=='normal') echo ' selected="selected"'; ?>>normal</option>
            	<option value="bold"<?php if($OptionsVis['link_font_weight']=='bold') echo ' selected="selected"'; ?>>bold</option>
                <option value="inherit"<?php if($OptionsVis['link_font_weight']=='inherit') echo ' selected="selected"'; ?>>inherit</option>
            </select>
        </td>
      </tr>   
      <tr>
        <td class="langLeft">Back link alignment:</td>
        <td class="left_top">
        	<select name="link_align">
            	<option value="left"<?php if($OptionsVis['link_align']=='left') echo ' selected="selected"'; ?>>left</option>
            	<option value="center"<?php if($OptionsVis['link_align']=='center') echo ' selected="selected"'; ?>>center</option>
                <option value="right"<?php if($OptionsVis['link_align']=='right') echo ' selected="selected"'; ?>>right</option>
                <option value="inherit"<?php if($OptionsVis['link_align']=='inherit') echo ' selected="selected"'; ?>>inherit</option>
            </select>
        </td>
      </tr>
      <tr>
        <td class="langLeft">Text-decoration:</td>
        <td class="left_top">
        	<select name="link_text_decoration">
            	<option value="none"<?php if($OptionsVis['link_text_decoration']=='none') echo ' selected="selected"'; ?>>none</option>
            	<option value="underline"<?php if($OptionsVis['link_text_decoration']=='underline') echo ' selected="selected"'; ?>>underline</option>
                <option value="inherit"<?php if($OptionsVis['link_text_decoration']=='inherit') echo ' selected="selected"'; ?>>inherit</option>
            </select>
        </td>
      </tr>
      <tr>
        <td class="langLeft">Text-decoration on hover (on mouseover):</td>
        <td class="left_top">
        	<select name="link_text_decoration_hover">
            	<option value="none"<?php if($OptionsVis['link_text_decoration_hover']=='none') echo ' selected="selected"'; ?>>none</option>
            	<option value="underline"<?php if($OptionsVis['link_text_decoration_hover']=='underline') echo ' selected="selected"'; ?>>underline</option>
                <option value="inherit"<?php if($OptionsVis['link_text_decoration_hover']=='inherit') echo ' selected="selected"'; ?>>inherit</option>
            </select>
        </td>
      </tr>            
      <tr>
        <td>&nbsp;</td>
        <td><input name="submit8" type="submit" value="Save" class="submitButton" /></td>
      </tr>
	</table>
    </div>
    
    
    
    <div class="accordion_toggle">Image style in news grid</div>
    <div class="accordion_content">  
	<table border="0" cellspacing="0" cellpadding="8" class="allTables">    
      <tr>
        <td class="langLeft">Show image in the news listing(summary):</td>
        <td class="left_top">
        	<select name="summ_show_image">
            	<option value="yes"<?php if($OptionsVis['summ_show_image']=='yes') echo ' selected="selected"'; ?>>yes</option>
            	<option value="no"<?php if($OptionsVis['summ_show_image']=='no') echo ' selected="selected"'; ?>>no</option>
            </select>
        </td>
      </tr>  
      <tr>
        <td class="langLeft">Summary image width:</td>
        <td class="left_top">
        	<select name="summ_image_ratio">
            	<option value="43"<?php if($OptionsVis['summ_image_ratio']=='43') echo ' selected="selected"'; ?>>4/3</option>
            	<option value="169"<?php if($OptionsVis['summ_image_ratio']=='169') echo ' selected="selected"'; ?>>16/9</option>
            	<option value="11"<?php if($OptionsVis['summ_image_ratio']=='11') echo ' selected="selected"'; ?>>1/1</option>
            </select>
        </td>
      </tr> 
      <tr>
        <td>&nbsp;</td>
        <td><input name="submit5" type="submit" value="Save" class="submitButton" /></td>
      </tr> 
    </table>
    </div>   
    
    
    <div class="accordion_toggle">News grid title style</div>
    <div class="accordion_content">  
	<table border="0" cellspacing="0" cellpadding="8" class="allTables">       
      <tr>
        <td class="langLeft">Font-family:</td>
        <td class="left_top">
        	<select name="summ_title_font">
				<?php echo font_family_list($OptionsVis['summ_title_font']); ?>
			</select>
        </td>
      </tr>  
      <tr>
        <td class="langLeft">Color:</td>
        <td class="left_top"><?php echo color_field("summ_title_color", $OptionsVis["summ_title_color"]); ?></td>
      </tr>
      <tr>
        <td class="langLeft">Color on hover(on mouseover):</td>
        <td class="left_top"><?php echo color_field("summ_title_color_hover", $OptionsVis["summ_title_color_hover"]); ?></td>
      </tr>
      <tr>
        <td class="langLeft">Font-size:</td>
        <td class="left_top">
        	<select name="summ_title_size">
            	<option value="inherit"<?php if($OptionsVis['summ_title_size']=='inherit') echo ' selected="selected"'; ?>>inherit</option>            	
				<?php for($i=8; $i<=32; $i++) {?>
            	<option value="<?php echo $i;?>px"<?php if($OptionsVis['summ_title_size']==$i.'px') echo ' selected="selected"'; ?>><?php echo $i;?>px</option>
                <?php } ?>       
                <?php for($i = 0.5; $i <= 3; $i = $i + 0.1) {?>
            	<option value="<?php echo $i;?>em"<?php if($OptionsVis['summ_title_size']==$i."em") echo ' selected="selected"'; ?>><?php echo $i;?>em</option>
                <?php } ?>
            </select>
        </td>
      </tr>
      <tr>
        <td class="langLeft">Font-weight:</td>
        <td class="left_top">
        	<select name="summ_title_font_weight">
            	<option value="normal"<?php if($OptionsVis['summ_title_font_weight']=='normal') echo ' selected="selected"'; ?>>normal</option>
            	<option value="bold"<?php if($OptionsVis['summ_title_font_weight']=='bold') echo ' selected="selected"'; ?>>bold</option>
                <option value="inherit"<?php if($OptionsVis['summ_title_font_weight']=='inherit') echo ' selected="selected"'; ?>>inherit</option>
            </select>
        </td>
      </tr>
      <tr>
        <td class="langLeft">Font-style:</td>
        <td class="left_top">
        	<select name="summ_title_font_style">
            	<option value="normal"<?php if($OptionsVis['summ_title_font_style']=='normal') echo ' selected="selected"'; ?>>normal</option>
            	<option value="italic"<?php if($OptionsVis['summ_title_font_style']=='italic') echo ' selected="selected"'; ?>>italic</option>
                <option value="oblique"<?php if($OptionsVis['summ_title_font_style']=='oblique') echo ' selected="selected"'; ?>>oblique</option>
                <option value="inherit"<?php if($OptionsVis['summ_title_font_style']=='inherit') echo ' selected="selected"'; ?>>inherit</option>
            </select>
        </td>
      </tr>
      <tr>
        <td class="langLeft">Text-align:</td>
        <td class="left_top">
        	<select name="summ_title_text_align">
            	<option value="center"<?php if($OptionsVis['summ_title_text_align']=='center') echo ' selected="selected"'; ?>>center</option>
            	<option value="justify"<?php if($OptionsVis['summ_title_text_align']=='justify') echo ' selected="selected"'; ?>>justify</option>
                <option value="left"<?php if($OptionsVis['summ_title_text_align']=='left') echo ' selected="selected"'; ?>>left</option>
                <option value="right"<?php if($OptionsVis['summ_title_text_align']=='right') echo ' selected="selected"'; ?>>right</option>
                <option value="inherit"<?php if($OptionsVis['summ_title_text_align']=='inherit') echo ' selected="selected"'; ?>>inherit</option>
            </select>
        </td>
      </tr>     
      <tr>
        <td class="langLeft">Line-height:</td>
        <td class="left_top">
        	<select name="summ_title_line_height">
                <option value="inherit"<?php if($OptionsVis['summ_title_line_height']=='inherit') echo ' selected="selected"'; ?>>inherit</option>
                <?php for($i=12; $i<=50; $i++) {?>
            	<option value="<?php echo $i;?>px"<?php if($OptionsVis['summ_title_line_height']==$i.'px') echo ' selected="selected"'; ?>><?php echo $i;?>px</option>
                <?php } ?>                
                <?php for($h=1; $h<=5; $h+=0.1) {?>
            	<option value="<?php echo round($h,1);?>"<?php if(round($OptionsVis['summ_title_line_height'],1)==round($h,1)) echo ' selected="selected"'; ?>><?php echo $h;?></option>
                <?php } ?>
            </select>
        </td>
      </tr>  
      <tr>
        <td class="langLeft">Text-decoration:</td>
        <td class="left_top">
        	<select name="summ_title_decor">
            	<option value="none"<?php if($OptionsVis['summ_title_decor']=='none') echo ' selected="selected"'; ?>>none</option>
            	<option value="underline"<?php if($OptionsVis['summ_title_decor']=='underline') echo ' selected="selected"'; ?>>underline</option>
                <option value="inherit"<?php if($OptionsVis['summ_title_decor']=='inherit') echo ' selected="selected"'; ?>>inherit</option>
            </select>
        </td>
      </tr>
      <tr>
        <td class="langLeft">Text-decoration(on mouseover):</td>
        <td class="left_top">
        	<select name="summ_title_decor_hover">
            	<option value="none"<?php if($OptionsVis['summ_title_decor_hover']=='none') echo ' selected="selected"'; ?>>none</option>
            	<option value="underline"<?php if($OptionsVis['summ_title_decor_hover']=='underline') echo ' selected="selected"'; ?>>underline</option>
                <option value="inherit"<?php if($OptionsVis['summ_title_decor_hover']=='inherit') echo ' selected="selected"'; ?>>inherit</option>
            </select>
        </td>
      </tr> 
      <tr>
        <td>&nbsp;</td>
        <td><input name="submit2" type="submit" value="Save" class="submitButton" /></td>
      </tr>
    </table>
    </div> 
    
    
    <div class="accordion_toggle">News title style</div>
    <div class="accordion_content">   
    <table border="0" cellspacing="0" cellpadding="8" class="allTables">  
      <tr>
        <td class="langLeft">Title font-family:</td>
        <td class="left_top" style="font-family:">
        	<select name="title_font">
            	<?php echo font_family_list($OptionsVis['title_font']); ?>
            </select>
        </td>
      </tr> 
      <tr>
        <td class="langLeft">Color:</td>
        <td class="left_top"><?php echo color_field("title_color", $OptionsVis["title_color"]); ?></td>
      </tr>
      <tr>
        <td class="langLeft">Font-size:</td>
        <td class="left_top">
        	<select name="title_size">
            	<option value="inherit"<?php if($OptionsVis['title_size']=='inherit') echo ' selected="selected"'; ?>>inherit</option>
            	<?php for($i=8; $i<=32; $i++) {?>
            	<option value="<?php echo $i;?>px"<?php if($OptionsVis['title_size']==$i.'px') echo ' selected="selected"'; ?>><?php echo $i;?>px</option>
                <?php } ?>     
                <?php for($i = 0.5; $i <= 3; $i = $i + 0.1) {?>
            	<option value="<?php echo $i;?>em"<?php if($OptionsVis['title_size']==$i."em") echo ' selected="selected"'; ?>><?php echo $i;?>em</option>
                <?php } ?>
            </select>
        </td>
      </tr>
      <tr>
        <td class="langLeft">Font-weight:</td>
        <td class="left_top">
        	<select name="title_font_weight">
            	<option value="normal"<?php if($OptionsVis['title_font_weight']=='normal') echo ' selected="selected"'; ?>>normal</option>
            	<option value="bold"<?php if($OptionsVis['title_font_weight']=='bold') echo ' selected="selected"'; ?>>bold</option>
                <option value="inherit"<?php if($OptionsVis['title_font_weight']=='inherit') echo ' selected="selected"'; ?>>inherit</option>
            </select>
        </td>
      </tr>
      <tr>
        <td class="langLeft">Font-style:</td>
        <td class="left_top">
        	<select name="title_font_style">
            	<option value="normal"<?php if($OptionsVis['title_font_style']=='normal') echo ' selected="selected"'; ?>>normal</option>
            	<option value="italic"<?php if($OptionsVis['title_font_style']=='italic') echo ' selected="selected"'; ?>>italic</option>
                <option value="oblique"<?php if($OptionsVis['title_font_style']=='oblique') echo ' selected="selected"'; ?>>oblique</option>
                <option value="inherit"<?php if($OptionsVis['title_font_style']=='inherit') echo ' selected="selected"'; ?>>inherit</option>
            </select>
        </td>
      </tr>
      <tr>
        <td class="langLeft">Text-align:</td>
        <td class="left_top">
        	<select name="title_text_align">
            	<option value="center"<?php if($OptionsVis['title_text_align']=='center') echo ' selected="selected"'; ?>>center</option>
            	<option value="justify"<?php if($OptionsVis['title_text_align']=='justify') echo ' selected="selected"'; ?>>justify</option>
                <option value="left"<?php if($OptionsVis['title_text_align']=='left') echo ' selected="selected"'; ?>>left</option>
                <option value="right"<?php if($OptionsVis['title_text_align']=='right') echo ' selected="selected"'; ?>>right</option>
                <option value="inherit"<?php if($OptionsVis['title_text_align']=='inherit') echo ' selected="selected"'; ?>>inherit</option>
            </select>
        </td>
      </tr>      
      <tr>
        <td class="langLeft">Line-height:</td>
        <td class="left_top">
        	<select name="title_line_height">
                <option value="inherit"<?php if($OptionsVis['title_line_height']=='inherit') echo ' selected="selected"'; ?>>inherit</option>
                <?php for($i=12; $i<=50; $i++) {?>
            	<option value="<?php echo $i;?>px"<?php if($OptionsVis['title_line_height']==$i.'px') echo ' selected="selected"'; ?>><?php echo $i;?>px</option>
                <?php } ?>               
                <?php for($h=1; $h<=5; $h+=0.1) {?>
            	<option value="<?php echo round($h,1);?>"<?php if(round($OptionsVis['title_line_height'],1)==round($h,1)) echo ' selected="selected"'; ?>><?php echo $h;?></option>
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
    
    
    
    <div class="accordion_toggle">News short desciption style</div>
    <div class="accordion_content">   
    <table border="0" cellspacing="0" cellpadding="8" class="allTables"> 
      <tr>
        <td class="langLeft">Font-family:</td>
        <td class="left_top">
        	<select name="summ_font">
            	<?php echo font_family_list($OptionsVis['summ_font']); ?>
            </select>
        </td>
      </tr>
      <tr>
        <td class="langLeft">Color:</td>
        <td class="left_top"><?php echo color_field("summ_color", $OptionsVis["summ_color"]); ?></td>
      </tr>
      <tr>
        <td class="langLeft">Font-size:</td>
        <td class="left_top">
        	<select name="summ_size">
            	<option value="inherit"<?php if($OptionsVis['summ_size']=='inherit') echo ' selected="selected"'; ?>>inherit</option>
            	<?php for($i=8; $i<=32; $i++) {?>
            	<option value="<?php echo $i;?>px"<?php if($OptionsVis['summ_size']==$i.'px') echo ' selected="selected"'; ?>><?php echo $i;?>px</option>
                <?php } ?>    
                <?php for($i = 0.5; $i <= 3; $i = $i + 0.1) {?>
            	<option value="<?php echo $i;?>em"<?php if($OptionsVis['summ_size']==$i."em") echo ' selected="selected"'; ?>><?php echo $i;?>em</option>
                <?php } ?>
            </select>
        </td>
      </tr>
      <tr>
        <td class="langLeft">Font-style:</td>
        <td class="left_top">
        	<select name="summ_font_style">
            	<option value="normal"<?php if($OptionsVis['summ_font_style']=='normal') echo ' selected="selected"'; ?>>normal</option>
            	<option value="italic"<?php if($OptionsVis['summ_font_style']=='italic') echo ' selected="selected"'; ?>>italic</option>
                <option value="oblique"<?php if($OptionsVis['summ_font_style']=='oblique') echo ' selected="selected"'; ?>>oblique</option>
                <option value="inherit"<?php if($OptionsVis['summ_font_style']=='inherit') echo ' selected="selected"'; ?>>inherit</option>
            </select>
        </td>
      </tr>
      <tr>
        <td class="langLeft">Text-align:</td>
        <td class="left_top">
        	<select name="summ_text_align">
            	<option value="center"<?php if($OptionsVis['summ_text_align']=='center') echo ' selected="selected"'; ?>>center</option>
            	<option value="justify"<?php if($OptionsVis['summ_text_align']=='justify') echo ' selected="selected"'; ?>>justify</option>
                <option value="left"<?php if($OptionsVis['summ_text_align']=='left') echo ' selected="selected"'; ?>>left</option>
                <option value="right"<?php if($OptionsVis['summ_text_align']=='right') echo ' selected="selected"'; ?>>right</option>
                <option value="inherit"<?php if($OptionsVis['summ_text_align']=='inherit') echo ' selected="selected"'; ?>>inherit</option>
            </select>
        </td>
      </tr>
      <tr>
        <td class="langLeft">Line-height:</td>
        <td class="left_top">
        	<select name="summ_line_height">
            	<option value="inherit"<?php if($OptionsVis['summ_line_height']=='inherit') echo ' selected="selected"'; ?>>inherit</option>
            	<?php for($i=12; $i<=50; $i++) {?>
            	<option value="<?php echo $i;?>px"<?php if($OptionsVis['summ_line_height']==$i.'px') echo ' selected="selected"'; ?>><?php echo $i;?>px</option>
                <?php } ?>             
                <?php for($h=1; $h<=5; $h+=0.1) {?>
            	<option value="<?php echo round($h,1);?>"<?php if(round($OptionsVis['summ_line_height'],1)==round($h,1)) echo ' selected="selected"'; ?>><?php echo $h;?></option>
                <?php } ?>
            </select>
        </td>
      </tr>  
      <tr>
        <td>&nbsp;</td>
        <td><input name="submit5" type="submit" value="Save" class="submitButton" /></td>
      </tr>
    </table>
    </div>    
    
    
    <div class="accordion_toggle">News category, date style, show/hide: Textsizer and Article Hits</div>
    <div class="accordion_content">  
	<table border="0" cellspacing="0" cellpadding="8" class="allTables"> 
      <tr>
        <td class="langLeft">Show categories menu:</td>
        <td class="left_top">
        	<select name="show_cat">
            	<option value="yes"<?php if($OptionsVis['show_cat']=='yes') echo ' selected="selected"'; ?>>yes</option>
            	<option value="no"<?php if($OptionsVis['show_cat']=='no') echo ' selected="selected"'; ?>>no</option>
            </select>
        </td>
      </tr>
      <tr>
        <td class="langLeft">News category font-family:</td>
        <td class="left_top">
        	<select name="cat_font">
            	<?php echo font_family_list($OptionsVis['cat_font']); ?>
            </select>
        </td>
      </tr>
      <tr>
        <td class="langLeft">News category color:</td>
        <td class="left_top"><?php echo color_field("cat_color", $OptionsVis["cat_color"]); ?></td>
      </tr>
      <tr>
        <td class="langLeft">News category font-size:</td>
        <td class="left_top">
        	<select name="cat_size">
            	<option value="inherit"<?php if($OptionsVis['cat_size']=='inherit') echo ' selected="selected"'; ?>>inherit</option>
            	<?php for($i=8; $i<=32; $i++) {?>
            	<option value="<?php echo $i;?>px"<?php if($OptionsVis['cat_size']==$i.'px') echo ' selected="selected"'; ?>><?php echo $i;?>px</option>
                <?php } ?>  
                <?php for($i = 0.5; $i <= 3; $i = $i + 0.1) {?>
            	<option value="<?php echo $i;?>em"<?php if($OptionsVis['cat_size']==$i."em") echo ' selected="selected"'; ?>><?php echo $i;?>em</option>
                <?php } ?>
            </select>
        </td>
      </tr>
      <tr>
        <td class="langLeft">News category font-weight:</td>
        <td class="left_top">
        	<select name="cat_font_weight">
            	<option value="normal"<?php if($OptionsVis['cat_font_weight']=='normal') echo ' selected="selected"'; ?>>normal</option>
            	<option value="bold"<?php if($OptionsVis['cat_font_weight']=='bold') echo ' selected="selected"'; ?>>bold</option>
                <option value="inherit"<?php if($OptionsVis['cat_font_weight']=='inherit') echo ' selected="selected"'; ?>>inherit</option>
            </select>
        </td>
      </tr>   
      <tr>
        <td class="langLeft">News category font-style:</td>
        <td class="left_top">
        	<select name="cat_font_style">
            	<option value="normal"<?php if($OptionsVis['cat_font_style']=='normal') echo ' selected="selected"'; ?>>normal</option>
            	<option value="italic"<?php if($OptionsVis['cat_font_style']=='italic') echo ' selected="selected"'; ?>>italic</option>
                <option value="oblique"<?php if($OptionsVis['cat_font_style']=='oblique') echo ' selected="selected"'; ?>>oblique</option>
                <option value="inherit"<?php if($OptionsVis['cat_font_style']=='inherit') echo ' selected="selected"'; ?>>inherit</option>
            </select>
        </td>
      </tr>  
      <tr>
        <td class="langLeft">Show date on news listing:</td>
        <td class="left_top">
        	<select name="show_date">
            	<option value="yes"<?php if($OptionsVis['show_date']=='yes') echo ' selected="selected"'; ?>>yes</option>
            	<option value="no"<?php if($OptionsVis['show_date']=='no') echo ' selected="selected"'; ?>>no</option>
            </select>
        </td>
      </tr>
      <tr>
        <td class="langLeft">Date font-family:</td>
        <td class="left_top">
        	<select name="date_font">
            	<?php echo font_family_list($OptionsVis['date_font']); ?>
            </select>
        </td>
      </tr>
      <tr>
        <td class="langLeft">Date color:</td>
        <td class="left_top"><?php echo color_field("date_color", $OptionsVis["date_color"]); ?></td>
      </tr>
      <tr>
        <td class="langLeft">Date font-size:</td>
        <td class="left_top">
        	<select name="date_size">
            	<option value="inherit"<?php if($OptionsVis['date_size']=='inherit') echo ' selected="selected"'; ?>>inherit</option>
            	<?php for($i=8; $i<=32; $i++) {?>
            	<option value="<?php echo $i;?>px"<?php if($OptionsVis['date_size']==$i.'px') echo ' selected="selected"'; ?>><?php echo $i;?>px</option>
                <?php } ?> 
                <?php for($i = 0.5; $i <= 3; $i = $i + 0.1) {?>
            	<option value="<?php echo $i;?>em"<?php if($OptionsVis['date_size']==$i."em") echo ' selected="selected"'; ?>><?php echo $i;?>em</option>
                <?php } ?>
            </select>
        </td>
      </tr>
      <tr>
        <td class="langLeft">Date font-style:</td>
        <td class="left_top">
        	<select name="date_font_style">
            	<option value="normal"<?php if($OptionsVis['date_font_style']=='normal') echo ' selected="selected"'; ?>>normal</option>
            	<option value="italic"<?php if($OptionsVis['date_font_style']=='italic') echo ' selected="selected"'; ?>>italic</option>
                <option value="oblique"<?php if($OptionsVis['date_font_style']=='oblique') echo ' selected="selected"'; ?>>oblique</option>
                <option value="inherit"<?php if($OptionsVis['date_font_style']=='inherit') echo ' selected="selected"'; ?>>inherit</option>
            </select>
        </td>
      </tr>
      <tr>
        <td class="langLeft">Date format:</td>
        <td class="left_top">
        	<?php echo date_format_list('date_format', $OptionsVis['date_format']); ?>
        </td>
      </tr>      
      <tr>
        <td class="langLeft">Showing the time:</td>
        <td class="left_top">
        	<select name="showing_time">
            	<option value=""<?php if($OptionsVis['showing_time']=='') echo ' selected="selected"'; ?>>without time</option>
            	<option value="G:i"<?php if($OptionsVis['showing_time']=='G:i') echo ' selected="selected"'; ?>>24h format</option>
            	<option value="g:i a"<?php if($OptionsVis['showing_time']=='g:i a') echo ' selected="selected"'; ?>>12h format</option>
            </select>
        </td>
      </tr>    
      <tr>
        <td class="langLeft">Show A+/a-:</td>
        <td valign="top">
        	<select name="show_aa">
            	<option value="yes"<?php if($OptionsVis['show_aa']=='yes') echo ' selected="selected"'; ?>>yes</option>
            	<option value="no"<?php if($OptionsVis['show_aa']=='no') echo ' selected="selected"'; ?>>no</option>
            </select>
        </td>
      </tr>        
      <tr>
        <td class="langLeft">Show Article Hits:</td>
        <td valign="top">
        	<select name="showhits">
            	<option value="yes"<?php if($OptionsVis['showhits']=='yes') echo ' selected="selected"'; ?>>yes</option>
            	<option value="no"<?php if($OptionsVis['showhits']=='no') echo ' selected="selected"'; ?>>no</option>
            </select>
        </td>
      </tr>       
      <tr>
        <td>&nbsp;</td>
        <td><input name="submit3" type="submit" value="Save" class="submitButton" /></td>
      </tr>
    </table>
    </div>
          
      
    <div class="accordion_toggle">News content style</div>
    <div class="accordion_content">   
    <table border="0" cellspacing="0" cellpadding="8" class="allTables"> 
      <tr>
        <td class="langLeft">News content font-family:</td>
        <td class="left_top">
        	<select name="cont_font">
            	<?php echo font_family_list($OptionsVis['cont_font']); ?>
            </select>
        </td>
      </tr>
      <tr>
        <td class="langLeft">News content color:</td>
        <td class="left_top"><?php echo color_field("cont_color", $OptionsVis["cont_color"]); ?></td>
      </tr>
      <tr>
        <td class="langLeft">News content font-size:</td>
        <td class="left_top">
        	<select name="cont_size">
            	<option value="inherit"<?php if($OptionsVis['cont_size']=='inherit') echo ' selected="selected"'; ?>>inherit</option>
            	<?php for($i=8; $i<=32; $i++) {?>
            	<option value="<?php echo $i;?>px"<?php if($OptionsVis['cont_size']==$i.'px') echo ' selected="selected"'; ?>><?php echo $i;?>px</option>
                <?php } ?>
                <?php for($i = 0.5; $i <= 3; $i = $i + 0.1) {?>
            	<option value="<?php echo $i;?>em"<?php if($OptionsVis['cont_size']==$i."em") echo ' selected="selected"'; ?>><?php echo $i;?>em</option>
                <?php } ?>
            </select>
        </td>
      </tr>
      <tr>
        <td class="langLeft">News content font-style:</td>
        <td class="left_top">
        	<select name="cont_font_style">
            	<option value="normal"<?php if($OptionsVis['cont_font_style']=='normal') echo ' selected="selected"'; ?>>normal</option>
            	<option value="italic"<?php if($OptionsVis['cont_font_style']=='italic') echo ' selected="selected"'; ?>>italic</option>
                <option value="oblique"<?php if($OptionsVis['cont_font_style']=='oblique') echo ' selected="selected"'; ?>>oblique</option>
                <option value="inherit"<?php if($OptionsVis['cont_font_style']=='inherit') echo ' selected="selected"'; ?>>inherit</option>
            </select>
        </td>
      </tr>
      <tr>
        <td class="langLeft">News content text-align:</td>
        <td class="left_top">
        	<select name="cont_text_align">
            	<option value="center"<?php if($OptionsVis['cont_text_align']=='center') echo ' selected="selected"'; ?>>center</option>
            	<option value="justify"<?php if($OptionsVis['cont_text_align']=='justify') echo ' selected="selected"'; ?>>justify</option>
                <option value="left"<?php if($OptionsVis['cont_text_align']=='left') echo ' selected="selected"'; ?>>left</option>
                <option value="right"<?php if($OptionsVis['cont_text_align']=='right') echo ' selected="selected"'; ?>>right</option>
                <option value="inherit"<?php if($OptionsVis['cont_text_align']=='inherit') echo ' selected="selected"'; ?>>inherit</option>
            </select>
        </td>
      </tr>
      <tr>
        <td class="langLeft">News content line-height:</td>
        <td class="left_top">
        	<select name="cont_line_height">
            	<option value="inherit"<?php if($OptionsVis['cont_line_height']=='inherit') echo ' selected="selected"'; ?>>inherit</option>
            	<?php for($i=12; $i<=50; $i++) {?>
            	<option value="<?php echo $i;?>px"<?php if($OptionsVis['cont_line_height']==$i.'px') echo ' selected="selected"'; ?>><?php echo $i;?>px</option>
                <?php } ?>            
                <?php for($h=1; $h<=5; $h+=0.1) {?>
            	<option value="<?php echo round($h,1);?>"<?php if(round($OptionsVis['cont_line_height'],1)==round($h,1)) echo ' selected="selected"'; ?>><?php echo $h;?></option>
                <?php } ?>
            </select>
        </td>
      </tr>    
      <tr>
        <td class="langLeft">Image viewer max-width:</td>
        <td class="left_top"><input name="viewer_width" type="text" size="4" value="<?php echo ReadDB($OptionsVis["viewer_width"]); ?>" />px</td>
      </tr>    
      <tr>
        <td>&nbsp;</td>
        <td><input name="submit4" type="submit" value="Save" class="submitButton" /></td>
      </tr>
    </table>
    </div>
    
    
    <div class="accordion_toggle">News image caption style</div>
    <div class="accordion_content">  
	<table border="0" cellspacing="0" cellpadding="8" class="allTables"> 
      <tr>
        <td class="langLeft">Font-family:</td>
        <td class="left_top">
        	<select name="capt_font">
            	<?php echo font_family_list($OptionsVis['capt_font']); ?>
            </select>
        </td>
      </tr>
      <tr>
        <td class="langLeft">Color:</td>
        <td class="left_top"><?php echo color_field("capt_color", $OptionsVis["capt_color"]); ?></td>
      </tr>
      <tr>
        <td class="langLeft">Background-color:</td>
        <td class="left_top"><?php echo color_field("capt_bgr_color", $OptionsVis["capt_bgr_color"]); ?></td>
      </tr>
      <tr>
        <td class="langLeft">Font-size:</td>
        <td class="left_top">
        	<select name="capt_size">
            	<option value="inherit"<?php if($OptionsVis['capt_size']=='inherit') echo ' selected="selected"'; ?>>inherit</option>
                <?php for($i=8; $i<=32; $i++) {?>
            	<option value="<?php echo $i;?>px"<?php if($OptionsVis['capt_size']==$i.'px') echo ' selected="selected"'; ?>><?php echo $i;?>px</option>
                <?php } ?>
                <?php for($i = 0.5; $i <= 3; $i = $i + 0.1) {?>
            	<option value="<?php echo $i;?>em"<?php if($OptionsVis['capt_size']==$i."em") echo ' selected="selected"'; ?>><?php echo $i;?>em</option>
                <?php } ?>
            </select>
        </td>
      </tr>
      <tr>
        <td class="langLeft">Font-weight:</td>
        <td class="left_top">
        	<select name="capt_font_weight">
            	<option value="normal"<?php if($OptionsVis['capt_font_weight']=='normal') echo ' selected="selected"'; ?>>normal</option>
            	<option value="bold"<?php if($OptionsVis['capt_font_weight']=='bold') echo ' selected="selected"'; ?>>bold</option>
                <option value="inherit"<?php if($OptionsVis['capt_font_weight']=='inherit') echo ' selected="selected"'; ?>>inherit</option>
            </select>
        </td>
      </tr>
      <tr>
        <td class="langLeft">Font-style:</td>
        <td class="left_top">
        	<select name="capt_font_style">
            	<option value="normal"<?php if($OptionsVis['capt_font_style']=='normal') echo ' selected="selected"'; ?>>normal</option>
            	<option value="italic"<?php if($OptionsVis['capt_font_style']=='italic') echo ' selected="selected"'; ?>>italic</option>
                <option value="oblique"<?php if($OptionsVis['capt_font_style']=='oblique') echo ' selected="selected"'; ?>>oblique</option>
                <option value="inherit"<?php if($OptionsVis['capt_font_style']=='inherit') echo ' selected="selected"'; ?>>inherit</option>
            </select>
        </td>
      </tr>
      <tr>
        <td class="langLeft">Text-align:</td>
        <td class="left_top">
        	<select name="capt_text_align">
            	<option value="center"<?php if($OptionsVis['capt_text_align']=='center') echo ' selected="selected"'; ?>>center</option>
            	<option value="justify"<?php if($OptionsVis['capt_text_align']=='justify') echo ' selected="selected"'; ?>>justify</option>
                <option value="left"<?php if($OptionsVis['capt_text_align']=='left') echo ' selected="selected"'; ?>>left</option>
                <option value="right"<?php if($OptionsVis['capt_text_align']=='right') echo ' selected="selected"'; ?>>right</option>
                <option value="inherit"<?php if($OptionsVis['capt_text_align']=='inherit') echo ' selected="selected"'; ?>>inherit</option>
            </select>
        </td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td><input name="submit5" type="submit" value="Save" class="submitButton" /></td>
      </tr>
    </table>
    </div>      
       
          
    
    <div class="accordion_toggle">Links style in the news text</div>
    <div class="accordion_content">  
	<table border="0" cellspacing="0" cellpadding="8" class="allTables">  
      <tr>
        <td class="langLeft">Font color:</td>
        <td class="left_top"><?php echo color_field("links_font_color", $OptionsVis["links_font_color"]); ?></td>
      </tr>
      <tr>
        <td class="langLeft">Color on hover(on mouseover):</td>
        <td class="left_top"><?php echo color_field("links_font_color_hover", $OptionsVis["links_font_color_hover"]); ?></td>
      </tr>   
      <tr>
        <td class="langLeft">Font-size:</td>
        <td class="left_top">
        	<select name="links_font_size">
            	<option value="inherit"<?php if($OptionsVis['links_font_size']=='inherit') echo ' selected="selected"'; ?>>inherit</option>
                <?php for($i=8; $i<=32; $i++) {?>
            	<option value="<?php echo $i;?>px"<?php if($OptionsVis['links_font_size']==$i.'px') echo ' selected="selected"'; ?>><?php echo $i;?>px</option>
                <?php } ?>
                <?php for($i = 0.5; $i <= 3; $i = $i + 0.1) {?>
            	<option value="<?php echo $i;?>em"<?php if($OptionsVis['links_font_size']==$i."em") echo ' selected="selected"'; ?>><?php echo $i;?>em</option>
                <?php } ?>
            </select>
        </td>
      </tr>   
      <tr>
        <td class="langLeft">Text-decoration:</td>
        <td class="left_top">
        	<select name="links_text_decoration">
            	<option value="none"<?php if($OptionsVis['links_text_decoration']=='none') echo ' selected="selected"'; ?>>none</option>
            	<option value="underline"<?php if($OptionsVis['links_text_decoration']=='underline') echo ' selected="selected"'; ?>>underline</option>
                <option value="inherit"<?php if($OptionsVis['links_text_decoration']=='inherit') echo ' selected="selected"'; ?>>inherit</option>
            </select>
        </td>
      </tr>
      <tr>
        <td class="langLeft">Text-decoration(on mouseover):</td>
        <td class="left_top">
        	<select name="links_text_decoration_hover">
            	<option value="none"<?php if($OptionsVis['links_text_decoration_hover']=='none') echo ' selected="selected"'; ?>>none</option>
            	<option value="underline"<?php if($OptionsVis['links_text_decoration_hover']=='underline') echo ' selected="selected"'; ?>>underline</option>
                <option value="inherit"<?php if($OptionsVis['links_text_decoration_hover']=='inherit') echo ' selected="selected"'; ?>>inherit</option>
            </select>
        </td>
      </tr>
      <tr>
        <td class="langLeft">Font-style:</td>
        <td class="left_top">
        	<select name="links_font_style">
            	<option value="normal"<?php if($OptionsVis['links_font_style']=='normal') echo ' selected="selected"'; ?>>normal</option>
            	<option value="italic"<?php if($OptionsVis['links_font_style']=='italic') echo ' selected="selected"'; ?>>italic</option>
                <option value="inherit"<?php if($OptionsVis['links_font_style']=='inherit') echo ' selected="selected"'; ?>>inherit</option>
            </select>
        </td>
      </tr>
      <tr>
        <td class="langLeft">Font-weight:</td>
        <td class="left_top">
        	<select name="links_font_weight">
            	<option value="normal"<?php if($OptionsVis['links_font_weight']=='normal') echo ' selected="selected"'; ?>>normal</option>
            	<option value="bold"<?php if($OptionsVis['links_font_weight']=='bold') echo ' selected="selected"'; ?>>bold</option>
                <option value="inherit"<?php if($OptionsVis['links_font_weight']=='inherit') echo ' selected="selected"'; ?>>inherit</option>
            </select>
        </td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td><input name="submit7" type="submit" value="Save" class="submitButton" /></td>
      </tr>
	</table>
    </div>
      
    
    <div class="accordion_toggle">Pagination style</div>
    <div class="accordion_content">  
	<table border="0" cellspacing="0" cellpadding="8" class="allTables"> 
      <tr>
        <td class="langLeft">Pagination Font-family:</td>
        <td class="left_top">
        	<select name="pag_font_family">
            	<?php echo font_family_list($OptionsVis['pag_font_family']); ?>
            </select>
        </td>
      </tr>      
      <tr>
        <td class="langLeft">Page numbers font color:</td>
        <td class="left_top"><?php echo color_field("pag_font_color", $OptionsVis["pag_font_color"]); ?></td>
      </tr>      
      <tr>
        <td class="langLeft">Page numbers background color:</td>
        <td class="left_top"><?php echo color_field("pag_bgr_color", $OptionsVis["pag_bgr_color"]); ?></td>
      </tr>   
      <tr>
        <td class="langLeft">Pages font color on hover (on mouse over):</td>
        <td class="left_top"><?php echo color_field("pag_font_color_hover", $OptionsVis["pag_font_color_hover"]); ?></td>
      </tr>       
      <tr>
        <td class="langLeft">Pages background color on hover (on mouse over):</td>
        <td class="left_top"><?php echo color_field("pag_bgr_color_hover", $OptionsVis["pag_bgr_color_hover"]); ?></td>
      </tr>      
      <tr>
        <td class="langLeft">Selected page font color:</td>
        <td class="left_top"><?php echo color_field("pag_font_color_sel", $OptionsVis["pag_font_color_sel"]); ?></td>
      </tr>         
      <tr>
        <td class="langLeft">Selected page background color:</td>
        <td class="left_top"><?php echo color_field("pag_bgr_color_sel", $OptionsVis["pag_bgr_color_sel"]); ?></td>
      </tr>       
      <tr>
        <td class="langLeft">Pagination font-size:</td>
        <td class="left_top">
        	<select name="pag_font_size">
            	<option value="inherit"<?php if($OptionsVis['pag_font_size']=='inherit') echo ' selected="selected"'; ?>>inherit</option>
                <?php for($i=8; $i<=32; $i++) {?>
            	<option value="<?php echo $i;?>px"<?php if($OptionsVis['pag_font_size']==$i.'px') echo ' selected="selected"'; ?>><?php echo $i;?>px</option>
                <?php } ?>
                <?php for($i = 0.5; $i <= 3; $i = $i + 0.1) {?>
            	<option value="<?php echo $i;?>em"<?php if($OptionsVis['pag_font_size']==$i."em") echo ' selected="selected"'; ?>><?php echo $i;?>em</option>
                <?php } ?>
            </select>
        </td>
      </tr>  
      <tr>
        <td class="langLeft">Pagination font-style:</td>
        <td class="left_top">
        	<select name="pag_font_style">
            	<option value="normal"<?php if($OptionsVis['pag_font_style']=='normal') echo ' selected="selected"'; ?>>normal</option>
            	<option value="italic"<?php if($OptionsVis['pag_font_style']=='italic') echo ' selected="selected"'; ?>>italic</option>
                <option value="inherit"<?php if($OptionsVis['pag_font_style']=='inherit') echo ' selected="selected"'; ?>>inherit</option>
            </select>
        </td>
      </tr>
      <tr>
        <td class="langLeft">Pagination font-weight:</td>
        <td class="left_top">
        	<select name="pag_font_weight">
            	<option value="normal"<?php if($OptionsVis['pag_font_weight']=='normal') echo ' selected="selected"'; ?>>normal</option>
            	<option value="bold"<?php if($OptionsVis['pag_font_weight']=='bold') echo ' selected="selected"'; ?>>bold</option>
                <option value="inherit"<?php if($OptionsVis['pag_font_weight']=='inherit') echo ' selected="selected"'; ?>>inherit</option>
            </select>
        </td>
      </tr>         
      <tr>
        <td class="langLeft">Align to:</td>
        <td  class="left_top">
        	<select name="pag_align_to">
            	<option value="center"<?php if($OptionsVis['pag_align_to']=='center') echo ' selected="selected"'; ?>>center</option>
            	<option value="left"<?php if($OptionsVis['pag_align_to']=='left') echo ' selected="selected"'; ?>>left</option>
                <option value="right"<?php if($OptionsVis['pag_align_to']=='right') echo ' selected="selected"'; ?>>right</option>
            </select>
        </td>
      </tr>    
      <tr>
        <td>&nbsp;</td>
        <td><input name="submit7" type="submit" value="Save" class="submitButton" /></td>
      </tr>  
	</table>
    </div>
    
    
    <div class="accordion_toggle">"Scrol to top" button style</div>
    <div class="accordion_content">  
	<table border="0" cellspacing="0" cellpadding="8" class="allTables">         
      <tr>
        <td class="langLeft">Show "Scrol to top" button:</td>
        <td class="left_top">
        	<select name="show_scrolltop">
            	<option value="yes"<?php if($OptionsVis['show_scrolltop']=='yes') echo ' selected="selected"'; ?>>yes</option>
            	<option value="no"<?php if($OptionsVis['show_scrolltop']=='no') echo ' selected="selected"'; ?>>no</option>
            </select>
        </td>
      </tr>             
      <tr>
        <td class="langLeft">Width:</td>
        <td class="left_top">
        	<select name="scrolltop_width">
                <?php for($i=0; $i<=100; $i++) {?>
            	<option value="<?php echo $i;?>px"<?php if($OptionsVis['scrolltop_width']==$i.'px') echo ' selected="selected"'; ?>><?php echo $i;?>px</option>
                <?php } ?>
            </select>
        </td>
      </tr>          
      <tr>
        <td class="langLeft">Heght:</td>
        <td class="left_top">
        	<select name="scrolltop_height">
                <?php for($i=0; $i<=100; $i++) {?>
            	<option value="<?php echo $i;?>px"<?php if($OptionsVis['scrolltop_height']==$i.'px') echo ' selected="selected"'; ?>><?php echo $i;?>px</option>
                <?php } ?>
            </select>
        </td>
      </tr>     
      <tr>
        <td class="langLeft">Background color:</td>
        <td class="left_top"><?php echo color_field("scrolltop_bgr_color", $OptionsVis["scrolltop_bgr_color"]); ?></td>
      </tr>        
      <tr>
        <td class="langLeft">Background color on hover (on mouseover):</td>
        <td class="left_top"><?php echo color_field("scrolltop_bgr_color_hover", $OptionsVis["scrolltop_bgr_color_hover"]); ?></td>
      </tr>    
      <tr>
        <td class="langLeft">Opacity:</td>
        <td class="left_top">
        	<select name="scrolltop_opacity">
                <?php for($i=0; $i<=100; $i += 10) {?>
            	<option value="<?php echo $i;?>"<?php if($OptionsVis['scrolltop_opacity']==$i) echo ' selected="selected"'; ?>><?php echo $i;?>%</option>
                <?php } ?>
            </select>
        </td>
      </tr>     
      <tr>
        <td class="langLeft">Opacity when scroll down:</td>
        <td class="left_top">
        	<select name="scrolltop_opacity_hover">
                <?php for($i=0; $i<=100; $i += 10) {?>
            	<option value="<?php echo $i;?>"<?php if($OptionsVis['scrolltop_opacity_hover']==$i) echo ' selected="selected"'; ?>><?php echo $i;?>%</option>
                <?php } ?>
            </select>
        </td>
      </tr>           
      <tr>
        <td class="langLeft">Border radius:</td>
        <td class="left_top">
        	<select name="scrolltop_radius">
                <?php for($i=0; $i<=10; $i++) {?>
            	<option value="<?php echo $i;?>px"<?php if($OptionsVis['scrolltop_radius']==$i.'px') echo ' selected="selected"'; ?>><?php echo $i;?>px</option>
                <?php } ?>
            </select>
        </td>
      </tr>    
             
      <tr>
        <td>&nbsp;</td>
        <td><input name="submit7" type="submit" value="Save" class="submitButton" /></td>
      </tr> 
      <tr>
        <td colspan="3" height="8"></td>
      </tr>
	</table>
    </div>
    
    
    
    <div class="accordion_toggle">'Share This' button below the articles</div>
    <div class="accordion_content">  
	<table border="0" cellspacing="0" cellpadding="8" class="allTables">  
      <tr>
        <td class="langLeft">Show 'Share' buttons above the article:</td>
        <td class="left_top">
        	<select name="show_share_this_top">
            	<option value="yes"<?php if($OptionsVis['show_share_this_top']=='yes') echo ' selected="selected"'; ?>>yes</option>
            	<option value="no"<?php if($OptionsVis['show_share_this_top']=='no') echo ' selected="selected"'; ?>>no</option>
            </select>
        </td>
      </tr>   
      <tr>
        <td class="langLeft">Show 'Share' buttons below the article:</td>
        <td class="left_top">
        	<select name="show_share_this">
            	<option value="yes"<?php if($OptionsVis['show_share_this']=='yes') echo ' selected="selected"'; ?>>yes</option>
            	<option value="no"<?php if($OptionsVis['show_share_this']=='no') echo ' selected="selected"'; ?>>no</option>
            </select>
        </td>
      </tr>       
      <tr>
        <td>&nbsp;</td>
        <td><input name="submit9" type="submit" value="Save" class="submitButton" /></td>
      </tr>
	</table>
    </div>
    
    
    <div class="accordion_toggle">Distances</div>
    <div class="accordion_content">  
	<table border="0" cellspacing="0" cellpadding="8" class="allTables">  
      <tr>
        <td class="langLeft">Distance menu - news:</td>
        <td class="left_top">
        	<select name="dist_menu_title">
                <?php for($i=0; $i<=50; $i++) {?>
            	<option value="<?php echo $i;?>px"<?php if($OptionsVis['dist_menu_title']==$i.'px') echo ' selected="selected"'; ?>><?php echo $i;?>px</option>
                <?php } ?>
                <?php for($i = 0.1; $i <= 5; $i = $i + 0.1) {?>
            	<option value="<?php echo $i;?>em"<?php if($OptionsVis['dist_menu_title']==$i."em") echo ' selected="selected"'; ?>><?php echo $i;?>em</option>
                <?php } ?>
            </select>
        </td>
      </tr>   
      <tr>
        <td class="langLeft">Distance between news in the grid(verical):</td>
        <td class="left_top">
        	<select name="dist_btw_news">
            	<?php for($i=0; $i<=50; $i++) {?>
            	<option value="<?php echo $i;?>px"<?php if($OptionsVis['dist_btw_news']==$i.'px') echo ' selected="selected"'; ?>><?php echo $i;?>px</option>
                <?php } ?>
                <?php for($i = 0.1; $i <= 5; $i = $i + 0.1) {?>
            	<option value="<?php echo $i;?>em"<?php if($OptionsVis['dist_btw_news']==$i."em") echo ' selected="selected"'; ?>><?php echo $i;?>em</option>
                <?php } ?>
            </select>
        </td>
      </tr>    
      <tr>
        <td class="langLeft">Distance 'Back' link - news title:</td>
        <td class="left_top">
        	<select name="back_link_dist">
                <?php for($i=0; $i<=50; $i++) {?>
            	<option value="<?php echo $i;?>px"<?php if($OptionsVis['back_link_dist']==$i.'px') echo ' selected="selected"'; ?>><?php echo $i;?>px</option>
                <?php } ?>
                <?php for($i = 0.1; $i <= 5; $i = $i + 0.1) {?>
            	<option value="<?php echo $i;?>em"<?php if($OptionsVis['back_link_dist']==$i."em") echo ' selected="selected"'; ?>><?php echo $i;?>em</option>
                <?php } ?>
            </select>
        </td>
      </tr>  
      <tr>
        <td class="langLeft">Distance title - date:</td>
        <td class="left_top">
        	<select name="dist_title_date">
            	<?php for($i=0; $i<=50; $i++) {?>
            	<option value="<?php echo $i;?>px"<?php if($OptionsVis['dist_title_date']==$i.'px') echo ' selected="selected"'; ?>><?php echo $i;?>px</option>
                <?php } ?>
                <?php for($i = 0.1; $i <= 5; $i = $i + 0.1) {?>
            	<option value="<?php echo $i;?>em"<?php if($OptionsVis['dist_title_date']==$i."em") echo ' selected="selected"'; ?>><?php echo $i;?>em</option>
                <?php } ?>
            </select>
        </td>
      </tr>    
      <tr>
        <td class="langLeft">Distance  date - news content:</td>
        <td class="left_top">
        	<select name="dist_date_text">
            	<?php for($i=0; $i<=50; $i++) {?>
            	<option value="<?php echo $i;?>px"<?php if($OptionsVis['dist_date_text']==$i.'px') echo ' selected="selected"'; ?>><?php echo $i;?>px</option>
                <?php } ?>
                <?php for($i = 0.1; $i <= 5; $i = $i + 0.1) {?>
            	<option value="<?php echo $i;?>em"<?php if($OptionsVis['dist_date_text']==$i."em") echo ' selected="selected"'; ?>><?php echo $i;?>em</option>
                <?php } ?>
            </select>
        </td>
      </tr>   
      <tr>
        <td>&nbsp;</td>
        <td><input name="submit10" type="submit" value="Save" class="submitButton" /></td>
      </tr>    
    </table>
    </div>
    
    </div>
	</form>
<?php } ?>