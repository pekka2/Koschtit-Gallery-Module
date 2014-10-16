<?php echo $header; ?>
<div id="content">
<div class="breadcrumb">
  <?php foreach ($breadcrumbs as $breadcrumb) { ?>
  <?php echo $breadcrumb['separator']; ?><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a>
  <?php } ?>
</div>
<?php if ($error_warning) { ?>
<div class="warning"><?php echo $error_warning; ?></div>
<?php } ?>
<div class="box">
  <div class="heading">
    <h1><img src="view/image/module.png" alt="" /> <?php echo $heading_title; ?></h1>
    <div class="buttons">
    <a onclick="$('#form').submit();" class="button"><?php echo $button_save;  ?></a>
    <a onclick="location = '<?php echo $cancel; ?>';" class="button"><?php  echo $button_cancel; ?></a></div>
  </div>
  <div class="content">
    <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form">
  
  
  <table id="module" class="list" style="width:96%;margin-left:2%">
        <?php
              $i = 0; 
    
    if($modules){
        foreach ($modules as $module) {   ?>
          <tbody id="module-row<?php echo $i; ?>">
        <input type="hidden" name="kigallery_module[<?php echo $i; ?>][sort_order]" value="1"/>
           <tr> <td class="left" style="width:20%"><?php echo $entry_layout; ?></td> 
           <td class="left" style="width:20%">
            <select name="kigallery_module[<?php echo $i; ?>][layout_id]">
                <?php foreach ($layouts as $layout) { ?>
                <?php if ($layout['layout_id'] == $module['layout_id']) { ?>
                <option value="<?php echo $layout['layout_id']; ?>" selected="selected"><?php echo $layout['name']; ?></option>
                <?php } else { ?>
                <option value="<?php echo $layout['layout_id']; ?>"><?php echo $layout['name']; ?></option>
                <?php } ?>
                <?php } ?>
              </select>
              </td>
                <td style="width:60%"></td></tr>
                 
              
              <tr><td class="gleft"><?php echo $entry_position; ?></td><td class="gcenter"><select name="kigallery_module[<?php echo $i; ?>][position]">
                
                <?php if ($module['position'] == 'content_top') { ?>
                  <option value="content_top" selected="selected"><?php echo $text_content_top; ?></option>
                  <?php } else { ?>
                  <option value="content_top"><?php echo $text_content_top; ?></option>
                  <?php } ?>
                  <?php if ($module['position'] == 'content_bottom') { ?>
                  <option value="content_bottom" selected="selected"><?php echo $text_content_bottom; ?></option>
                  <?php } else { ?>
                  <option value="content_bottom"><?php echo $text_content_bottom; ?></option>
                  <?php } ?>
                  <?php if ($module['position'] == 'column_left') { ?>
                  <option value="column_left" selected="selected"><?php echo $text_column_left; ?></option>
                  <?php } else { ?>
                  <option value="column_left"><?php echo $text_column_left; ?></option>
                  <?php } ?>
                  <?php if ($module['position'] == 'column_right') { ?>
                  <option value="column_right" selected="selected"><?php echo $text_column_right; ?></option>
                  <?php } else { ?>
                  <option value="column_right"><?php echo $text_column_right; ?></option>
                  <?php } ?>
                </select></td>
                <td class="cright"></td>
                </tr>
              
        
            <tr><td class="left"><?php echo $entry_status; ?></td>
            <td class="left">
                <?php if ($module['status']) { ?>
                <input type="radio" name="kigallery_module[<?php echo $i; ?>][status]" value="1" checked="checked"> <?php echo $text_enabled;?>
                <input type="radio" name="kigallery_module[<?php echo $i; ?>][status]"value="0"> <?php echo $text_disabled;?>
                <?php } else { ?>
                <input type="radio" name="kigallery_module[<?php echo $i; ?>][status]" value="1"> <?php echo $text_enabled;?>
                <input type="radio" name="kigallery_module[<?php echo $i; ?>][status]" value="0" checked="checked">  <?php echo $text_disabled;?>
                <?php } ?>
              </td>    
                <td></td>
                </tr>
              
                           
            <tr><td class="left"><?php echo $entry_admin_mail; ?></td><td class="left">
         <?php   if($module['ki_admin_mail'] == 1){ ?>
              <input name="kigallery_module[<?php echo $i; ?>][ki_admin_mail]" type="radio" value="1"  checked="checked"/> <?php echo $text_enabled;?>
               <input name="kigallery_module[<?php echo $i; ?>][ki_admin_mail]" type="radio" value="0"/> <?php echo $text_disabled;?>
               <?php } else{ ?>
              <input name="kigallery_module[<?php echo $i; ?>][ki_admin_mail]" type="radio" value="1"/><?php echo $text_enabled;?>
               <input name="kigallery_module[<?php echo $i; ?>][ki_admin_mail]" type="radio" value="0"  checked="checked"/> <?php echo $text_disabled;?>
               <?php } ?>            </td>   
                <td><?php echo $entry_admin_mail_help; ?></td>
                </tr>
            
              
            <tr><td class="left"><?php echo $entry_admin_mail_from; ?></td><td class="left">
              <input size="20" name="kigallery_module[<?php echo $i; ?>][ki_admin_mail_from]" type="text" value="<?php echo $module['ki_admin_mail_from'];?>" />
</td><td><?php echo $entry_admin_mail_from_help; ?></td>
                </tr>
                
                 
            <tr><td class="left"><?php echo $entry_admin_mail_to; ?></td><td class="left">  
              <input size="20" name="kigallery_module[<?php echo $i; ?>][ki_admin_mail_to]" type="text" value="<?php echo $module['ki_admin_mail_to'];?>" />
</td><td><?php echo $entry_admin_mail_to_help; ?></td>
                </tr>
                
              <input  name="kigallery_module[<?php echo $i; ?>][ki_config]" type="hidden" value="ki_config/" />
               
                 <tr><td class="left"><?php echo $entry_template; ?></td><td class="left">
<input type="text" name="kigallery_module[<?php echo $i; ?>][ki_template]" value="catalog/view/theme/<?php echo $ki_template;?>" size="35">
              </td>
                <td></td>
                </tr>  
            <tr><td class="left"><?php echo $entry_galleriesdir; ?></td><td class="left">
              <input size="20" name="kigallery_module[<?php echo $i; ?>][ki_galleries]" type="text" value="<?php echo $module['ki_galleries'];?>" />
            </td>
            
                <td></td>
                </tr>
            
            <tr><td class="left"><?php echo $entry_basedir; ?></td><td class="left">
              <input size="20" name="kigallery_module[<?php echo $i; ?>][ki_base]" type="text" value="<?php echo $module['ki_base'];?>" />
            </td>
               
                <td></td>
                </tr>
                
            <tr><td class="left"><?php echo $entry_fr_width; ?></td><td class="left">
              <input size="10" name="kigallery_module[<?php echo $i; ?>][ki_fr_width]" type="text" value="<?php echo $module['ki_fr_width'];?>" />
            </td>
                <td rowspan="2"><?php echo $entry_fr_width_help; ?></td>
                </tr>
            
            
 
           
            <tr><td class="left"><?php echo $entry_fr_height; ?></td> <td class="left">
<input type="text" name="kigallery_module[<?php echo $i; ?>][ki_fr_height]" value="<?php echo $module['ki_fr_height'];?>" size="12">
              </td>
                </tr>
              
              
              
            <tr><td class="left"><?php echo $entry_fr_color; ?></td><td class="left">
<input type="text" name="kigallery_module[<?php echo $i; ?>][ki_fr_color]" value="<?php echo $module['ki_fr_color'];?>" size="12">
              </td>
                <td><?php echo $entry_fr_color_help; ?></td>
                </tr>
                
                       
            <tr><td class="left"><?php echo $entry_permission; ?></td><td class="left">
         <?php   if(isset($module['ki_permission']) &&  $module['ki_permission'] == 1){ ?>
              <input name="kigallery_module[<?php echo $i; ?>][ki_permission]" type="radio" value="1"  checked="checked"/> 777
                 <input name="kigallery_module[<?php echo $i; ?>][ki_permission]" type="radio" value="2"/> 775
            <input name="kigallery_module[<?php echo $i; ?>][ki_permission]" type="radio" value="0"/> 755
               <?php }   elseif($module['ki_permission'] == 2){ ?>
                   <input name="kigallery_module[<?php echo $i; ?>][ki_permission]" type="radio" value="1"/> 777
         <input name="kigallery_module[<?php echo $i; ?>][ki_permission]" type="radio" value="2"  checked="checked"/> 775
               <input name="kigallery_module[<?php echo $i; ?>][ki_permission]" type="radio" value="0"/> 755
               <?php }else{ ?>
              <input name="kigallery_module[<?php echo $i; ?>][ki_permission]" type="radio" value="1"/>777
         <input name="kigallery_module[<?php echo $i; ?>][ki_permission]" type="radio" value="2"/> 775
               <input name="kigallery_module[<?php echo $i; ?>][ki_permission]" type="radio" value="0"  checked="checked"/> 755
               <?php } ?>            </td>   
                <td><?php echo $entry_permission_help; ?></td>
                </tr>
                
                
                
                       
            <tr><td class="left"><?php echo $entry_image_order; ?></td><td class="left">
         <?php   if($module['ki_img_order'] == 'manual'){ ?>
              <input name="kigallery_module[<?php echo $i; ?>][ki_img_order]" type="radio" value="manual"  checked="checked"/> <?php echo $text_manual;?><br>
                 <input name="kigallery_module[<?php echo $i; ?>][ki_img_order]" type="radio" value="size"/> <?php echo $text_size;?><br>
            <input name="kigallery_module[<?php echo $i; ?>][ki_img_order]" type="radio" value="new"/> <?php echo $text_news;?><br>
            <input name="kigallery_module[<?php echo $i; ?>][ki_img_order]" type="radio" value="old"/> <?php echo $text_olds;?><br>
            <input name="kigallery_module[<?php echo $i; ?>][ki_img_order]" type="radio" value="name"/> <?php echo $text_name;?><br>
               <?php }   elseif($module['ki_img_order'] == 'size'){ ?>
              <input name="kigallery_module[<?php echo $i; ?>][ki_img_order]" type="radio" value="manual"/> <?php echo $text_manual;?><br>
                 <input name="kigallery_module[<?php echo $i; ?>][ki_img_order]" type="radio" value="size"   checked="checked"/> <?php echo $text_size;?><br>
            <input name="kigallery_module[<?php echo $i; ?>][ki_img_order]" type="radio" value="new"/> <?php echo $text_news;?><br>
            <input name="kigallery_module[<?php echo $i; ?>][ki_img_order]" type="radio" value="old"/> <?php echo $text_olds;?><br>
            <input name="kigallery_module[<?php echo $i; ?>][ki_img_order]" type="radio" value="name"/> <?php echo $text_name;?><br>
               <?php }elseif($module['ki_img_order'] == 'new'){ ?>
              <input name="kigallery_module[<?php echo $i; ?>][ki_img_order]" type="radio" value="manual"/> <?php echo $text_manual;?><br>
                 <input name="kigallery_module[<?php echo $i; ?>][ki_img_order]" type="radio" value="size"/> <?php echo $text_size;?><br>
            <input name="kigallery_module[<?php echo $i; ?>][ki_img_order]" type="radio" value="new"  checked="checked"/> <?php echo $text_news;?><br>
            <input name="kigallery_module[<?php echo $i; ?>][ki_img_order]" type="radio" value="old"/> <?php echo $text_olds;?><br>
            <input name="kigallery_module[<?php echo $i; ?>][ki_img_order]" type="radio" value="name"/> <?php echo $text_name;?><br>
               <?php } elseif($module['ki_img_order'] == 'old'){ ?>
              <input name="kigallery_module[<?php echo $i; ?>][ki_img_order]" type="radio" value="manual"/> <?php echo $text_manual;?><br>
                 <input name="kigallery_module[<?php echo $i; ?>][ki_img_order]" type="radio" value="size"/> <?php echo $text_size;?><br>
            <input name="kigallery_module[<?php echo $i; ?>][ki_img_order]" type="radio" value="new"/> <?php echo $text_news;?><br>
            <input name="kigallery_module[<?php echo $i; ?>][ki_img_order]" type="radio" value="old"  checked="checked"/> <?php echo $text_olds;?><br>
            <input name="kigallery_module[<?php echo $i; ?>][ki_img_order]" type="radio" value="name"/> <?php echo $text_name;?><br>
               <?php } else{ ?>
              <input name="kigallery_module[<?php echo $i; ?>][ki_img_order]" type="radio" value="manual"/> <?php echo $text_manual;?><br>
                 <input name="kigallery_module[<?php echo $i; ?>][ki_img_order]" type="radio" value="size"/> <?php echo $text_size;?><br>
            <input name="kigallery_module[<?php echo $i; ?>][ki_img_order]" type="radio" value="new"/> <?php echo $text_news;?><br>
            <input name="kigallery_module[<?php echo $i; ?>][ki_img_order]" type="radio" value="old"/> <?php echo $text_olds;?><br>
            <input name="kigallery_module[<?php echo $i; ?>][ki_img_order]" type="radio" value="name"  checked="checked"/> <?php echo $text_name;?><br>
               <?php }?>            </td>   
                <td><?php echo $entry_order_help; ?></td>
                </tr>
                         
            <tr><td class="left"><?php echo $entry_ki_mixname; ?></td><td class="left">
          <?php   if(isset($module['ki_mixname']) && $module['ki_mixname'] == 1){ ?>
              <input  name="kigallery_module[<?php echo $i; ?>][ki_mixname]" type="radio" value="1"  checked="checked"/> <?php echo $text_enabled;?>
               <input  name="kigallery_module[<?php echo $i; ?>][ki_mixname]" type="radio" value="0"/> <?php echo $text_disabled;?>
               <?php } else{ ?>
              <input  name="kigallery_module[<?php echo $i; ?>][ki_mixname]" type="radio" value="1"/><?php echo $text_enabled;?>
               <input  name="kigallery_module[<?php echo $i; ?>][ki_mixname]" type="radio" value="0"  checked="checked"/> <?php echo $text_disabled;?>
               <?php } ?>
          </td>   
                <td><?php echo $entry_ki_mixname_help; ?></td>
                </tr>
             
                
     <tr><td colspan="3"><h2/></td></tr>
   
                
                  <tr><td class="left"><?php echo $entry_thumbs; ?></td><td class="left">	
                  <input type="text" name="kigallery_module[<?php echo $i; ?>][ki_thumbs]" value="<?php echo $module['ki_thumbs'];?>" size="12">
              </td>
           <td><?php echo $entry_thumbs_help; ?></td>
                </tr>
                     

                  <tr><td class="left"><?php echo $entry_th_per_line; ?></td><td class="left">	
                  <input type="text" name="kigallery_module[<?php echo $i; ?>][ki_th_per_line]" value="<?php echo $module['ki_th_per_line'];?>" size="12">
              </td>
              
                <td><?php echo $entry_th_per_line_help; ?></td>
                </tr>
            
          
              	
	   <tr><td class="left"><?php echo $entry_th_lines; ?></td><td class="left">
	 <input type="text" name="kigallery_module[<?php echo $i; ?>][ki_th_lines]" value="<?php echo $module['ki_th_lines'];?>" size="12">
              </td>
                 
                <td><?php echo $entry_th_lines_help; ?></td>
                </tr>
         
          
              
                	   <tr><td class="left"><?php echo $entry_th_width; ?></td><td class="left">
	<input type="text" name="kigallery_module[<?php echo $i; ?>][ki_th_width]" value="<?php echo $module['ki_th_width'];?>" size="12">		
              </td>
                 
                <td rowspan="2"><?php echo $entry_th_width_help; ?></td>
                </tr>
              
              
                 <tr><td class="left"><?php echo $entry_th_height; ?></td><td class="left">
	<input type="text" name="kigallery_module[<?php echo $i; ?>][ki_th_height]" value="<?php echo $module['ki_th_height'];?>" size="12">	
              </td>
                </tr>
              
            
			
                  	     
                  <tr><td class="left"><?php echo $entry_th_bord_size; ?></td>
              	<td class="left">
	<input type="text" name="kigallery_module[<?php echo $i; ?>][ki_th_bord_size]" value="<?php echo $module['ki_th_bord_size'];?>" size="12">		
              </td>
                <td><?php echo $entry_th_bord_size_help; ?></td>
                </tr>
              
                  <tr><td class="left"><?php echo $entry_th_margin_left; ?></td>
            <td class="left">
            <input type="text" name="kigallery_module[<?php echo $i; ?>][ki_th_margin_left]" value="<?php echo $module['ki_th_margin_left'];?>" size="3">
</td>
                <td rowspan="2"><?php echo $entry_th_margin_help; ?></td>
                </tr>
                  <tr><td class="left"><?php echo $entry_th_margin_top; ?></td>
            <td class="left">
            <input type="text" name="kigallery_module[<?php echo $i; ?>][ki_th_margin_top]" value="<?php echo $module['ki_th_margin_top'];?>" size="3">
</td>
                </tr>
         
         
   
                  <tr><td class="left"><?php echo $entry_th_bord_color; ?></td>
            <td class="left">
            <input type="text" name="kigallery_module[<?php echo $i; ?>][ki_th_bord_color]" value="<?php echo $module['ki_th_bord_color'];?>" size="12">
</td>
                <td><?php echo $entry_th_bord_color_help; ?></td>
                </tr>
    
             
            <tr><td class="left"><?php echo $entry_th_bord_hover_color; ?></td><td class="left">
              <input size="10" name="kigallery_module[<?php echo $i; ?>][ki_th_bord_hover_color]" type="text" value="<?php echo $module['ki_th_bord_hover_color'];?>" />
            </td>
                <td><?php echo $entry_th_bord_hover_color_help; ?></td></tr>
            
                     
            <tr><td class="left"><?php echo $entry_th_bord_hover_increase; ?></td><td class="left">
              <input size="10" name="kigallery_module[<?php echo $i; ?>][ki_th_bord_hover_increase]" type="text" value="<?php echo $module['ki_th_bord_hover_increase'];?>" />
                </td>
                <td><?php echo $entry_th_bord_hover_increase_help; ?></td></tr>
                     
            <tr><td class="left"><?php echo $entry_th_shadow; ?></td><td class="left">
          <?php   if($module['ki_th_shadow'] == 1){ ?>
              <input  name="kigallery_module[<?php echo $i; ?>][ki_th_shadow]" type="radio" value="1"  checked="checked"/> <?php echo $text_enabled;?>
               <input  name="kigallery_module[<?php echo $i; ?>][ki_th_shadow]" type="radio" value="0"/> <?php echo $text_disabled;?>
               <?php } else{ ?>
              <input  name="kigallery_module[<?php echo $i; ?>][ki_th_shadow]" type="radio" value="1"/><?php echo $text_enabled;?>
               <input  name="kigallery_module[<?php echo $i; ?>][ki_th_shadow]" type="radio" value="0"  checked="checked"/> <?php echo $text_disabled;?>
               <?php } ?>
          </td>   
                <td><?php echo $entry_th_shadow_help; ?></td>
                </tr>
             
            <tr><td class="left"><?php echo $entry_th_radius; ?></td><td class="left">
          <?php   if($module['ki_th_radius'] == 1){ ?>
              <input  name="kigallery_module[<?php echo $i; ?>][ki_th_radius]" type="radio" value="1"  checked="checked"/> <?php echo $text_enabled;?>
               <input  name="kigallery_module[<?php echo $i; ?>][ki_th_radius]" type="radio" value="0"/> <?php echo $text_disabled;?>
               <?php } else{ ?>
              <input name="kigallery_module[<?php echo $i; ?>][ki_th_radius]" type="radio" value="1"/><?php echo $text_enabled;?>
               <input  name="kigallery_module[<?php echo $i; ?>][ki_th_radius]" type="radio" value="0"  checked="checked"/> <?php echo $text_disabled;?>
               <?php } ?>
          </td>   
                <td></td>
                </tr>
             
            <tr><td class="left"><?php echo $entry_th_bord_radius; ?></td><td class="left">
            
              <input size="10" name="kigallery_module[<?php echo $i; ?>][ki_th_bord_radius]" type="text" value="<?php echo $module['ki_th_bord_radius'];?>" />
            </td>
                <td><?php echo $entry_th_bord_radius_help; ?></td>
                </tr>
     
            <tr><td class="left"><?php echo $entry_th_to_square; ?></td><td class="left">
                       <?php   if($module['ki_th_to_square'] == 1){ ?>      
              <input size="10" name="kigallery_module[<?php echo $i; ?>][ki_th_to_square]" type="radio" value="1"  checked="checked"/> <?php echo $text_enabled;?>
               <input size="10" name="kigallery_module[<?php echo $i; ?>][ki_th_to_square]" type="radio" value="0"/> <?php echo $text_disabled;?>
               <?php } else{ ?>
              <input size="10" name="kigallery_module[<?php echo $i; ?>][ki_th_to_square]" type="radio" value="1"/><?php echo $text_enabled;?>
               <input size="10" name="kigallery_module[<?php echo $i; ?>][ki_th_to_square]" type="radio" value="0"  checked="checked"/> <?php echo $text_disabled;?>
               <?php } ?>             </td>   
                <td><?php echo $entry_th_to_square_help; ?></td>
                </tr>
            
                     
            <tr><td class="left"><?php echo $entry_th_2sq_crop_hori; ?></td><td class="left">
            
              <input size="10" name="kigallery_module[<?php echo $i; ?>][ki_th_2sq_crop_hori]" type="text" value="<?php echo $module['ki_th_2sq_crop_hori'];?>" />
            </td>
                <td><?php echo $entry_th_2sq_crop_hori_help; ?></td>
                </tr>
            
                     
            <tr><td class="left"><?php echo $entry_th_2sq_crop_vert; ?></td><td class="left">
              <input size="10" name="kigallery_module[<?php echo $i; ?>][ki_th_2sq_crop_vert]" type="text" value="<?php echo $module['ki_th_2sq_crop_vert'];?>" />
            </td>   
                <td><?php echo $entry_th_2sq_crop_vert_help; ?></td>
                </tr>
    
      
            <tr><td class="left"><?php echo $entry_thumbs_to_disk; ?></td><td class="left">
              <?php   if($module['ki_thumbs_to_disk'] == 1){ ?>
              <input size="10" name="kigallery_module[<?php echo $i; ?>][ki_thumbs_to_disk]" type="radio" value="1"  checked="checked"/> <?php echo $text_enabled;?>
               <input size="10" name="kigallery_module[<?php echo $i; ?>][ki_thumbs_to_disk]" type="radio" value="0"/> <?php echo $text_disabled;?>
               <?php } else{ ?>
              <input size="10" name="kigallery_module[<?php echo $i; ?>][ki_thumbs_to_disk]" type="radio" value="1"/><?php echo $text_enabled;?>
               <input size="10" name="kigallery_module[<?php echo $i; ?>][ki_thumbs_to_disk]" type="radio" value="0"  checked="checked"/> <?php echo $text_disabled;?>
               <?php } ?>   </td>
            <td><?php echo $entry_thumbs_to_disk_help; ?></td></tr>
            
              
     <tr><td colspan="3"><h2/></td></tr>
     
                     
            <tr><td class="left"><?php echo $entry_resize_auto; ?></td><td class="left">
              <?php   if($module['ki_resize_auto'] == 1){ ?>
              <input size="10" name="kigallery_module[<?php echo $i; ?>][ki_resize_auto]" type="radio" value="1"  checked="checked"/> <?php echo $text_enabled;?>
               <input size="10" name="kigallery_module[<?php echo $i; ?>][ki_resize_auto]" type="radio" value="0"/> <?php echo $text_disabled;?>
               <?php } else{ ?>
              <input size="10" name="kigallery_module[<?php echo $i; ?>][ki_resize_auto]" type="radio" value="1"/><?php echo $text_enabled;?>
               <input size="10" name="kigallery_module[<?php echo $i; ?>][ki_resize_auto]" type="radio" value="0"  checked="checked"/> <?php echo $text_disabled;?>
               <?php } ?>            </td>   
                <td><?php echo $entry_resize_auto_help; ?></td>
                </tr>
    
    
     
            <tr><td class="left"><?php echo $entry_bord_size; ?></td><td class="left">
              <input size="10" name="kigallery_module[<?php echo $i; ?>][ki_bord_size]" type="text" value="<?php echo $module['ki_bord_size'];?>" />
            </td>   
                <td><?php echo $entry_bord_size_help; ?></td>
                </tr>
            
                     
            <tr><td class="left"><?php echo $entry_bord_color; ?></td><td class="left">
              <input size="25" name="kigallery_module[<?php echo $i; ?>][ki_bord_color]" type="text" value="<?php echo $module['ki_bord_color'];?>" />
            </td>   
                <td><?php echo $entry_bord_color_help; ?></td></tr>
                
                
     
            <tr><td class="left"><?php echo $entry_out_bord_size; ?></td><td class="left">
              <input size="10" name="kigallery_module[<?php echo $i; ?>][ki_out_bord_size]" type="text" value="<?php if(isset($module['ki_out_bord_size'])){ echo $module['ki_out_bord_size']; }?>" />
            </td>   
                <td></td>
                </tr>
            
                     
            <tr><td class="left"><?php echo $entry_out_bord_color; ?></td><td class="left">
              <input size="10" name="kigallery_module[<?php echo $i; ?>][ki_out_bord_color]" type="text" value="<?php if(isset($module['ki_out_bord_color'])){ echo $module['ki_out_bord_color']; }?>" />
            </td>   
                <td></td></tr>
                 
            <tr><td class="left"><?php echo $entry_radius; ?></td><td class="left">
          <?php   if(isset($module['ki_radius']) && $module['ki_radius'] == 1){ ?>
              <input  name="kigallery_module[<?php echo $i; ?>][ki_radius]" type="radio" value="1"  checked="checked"/> <?php echo $text_enabled;?>
               <input  name="kigallery_module[<?php echo $i; ?>][ki_radius]" type="radio" value="0"/> <?php echo $text_disabled;?>
               <?php } else{ ?>
              <input name="kigallery_module[<?php echo $i; ?>][ki_radius]" type="radio" value="1"/><?php echo $text_enabled;?>
               <input  name="kigallery_module[<?php echo $i; ?>][ki_radius]" type="radio" value="0"  checked="checked"/> <?php echo $text_disabled;?>
               <?php } ?>
          </td>   
                <td></td>
                </tr>
             
            <tr><td class="left"><?php echo $entry_bord_radius; ?></td><td class="left">
            
              <input size="10" name="kigallery_module[<?php echo $i; ?>][ki_bord_radius]" type="text" value="<?php if(isset($module['ki_bord_radius'])){ echo $module['ki_bord_radius'];}?>" />
            </td>
                <td></td>
                </tr>
               <tr><td class="left"><?php echo $entry_maxim_pic_width; ?></td><td class="left">
              <input size="10" name="kigallery_module[<?php echo $i; ?>][ki_maxim_pic_width]" type="text" value="<?php echo $module['ki_maxim_pic_width'];?>" />
            </td>   
                <td rowspan="2"><?php echo $entry_maxim_pic_width_help; ?></td>
                </tr>
            
            <tr><td class="left"><?php echo $entry_maxim_pic_height; ?></td><td class="left">
              <input size="10" name="kigallery_module[<?php echo $i; ?>][ki_maxim_pic_height]" type="text" value="<?php echo $module['ki_maxim_pic_height'];?>" />
            </td></tr>
                     
            <tr><td class="left"><?php echo $entry_max_pic_width; ?></td><td class="left">
              <input size="10" name="kigallery_module[<?php echo $i; ?>][ki_max_pic_width]" type="text" value="<?php echo $module['ki_max_pic_width'];?>" />
            </td>   
                <td rowspan="2"><?php echo $entry_max_pic_width_help; ?></td>
                </tr>
            
            
            <tr><td class="left"><?php echo $entry_max_pic_height; ?></td><td class="left">
              <input size="10" name="kigallery_module[<?php echo $i; ?>][ki_max_pic_height]" type="text" value="<?php echo $module['ki_max_pic_height'];?>" />
            </td>
                </tr>
            
            
            <tr><td class="left"><?php echo $entry_oversize_allowed; ?></td>
            <td class="left">
            <?php   if($module['ki_oversize_allowed'] == 1){ ?>
              <input size="10" name="kigallery_module[<?php echo $i; ?>][ki_oversize_allowed]" type="radio" value="1"  checked="checked"/> <?php echo $text_enabled;?>
               <input size="10" name="kigallery_module[<?php echo $i; ?>][ki_oversize_allowed]" type="radio" value="0"/> <?php echo $text_disabled;?>
               <?php } else{ ?>
              <input size="10" name="kigallery_module[<?php echo $i; ?>][ki_oversize_allowed]" type="radio" value="1"/><?php echo $text_enabled;?>
               <input size="10" name="kigallery_module[<?php echo $i; ?>][ki_oversize_allowed]" type="radio" value="0"  checked="checked"/> <?php echo $text_disabled;?>
               <?php } ?> 
               </td>   
                <td><?php echo $entry_oversize_allowed_help; ?></td>
                </tr>
            
     <tr><td colspan="3"><h2/></td></tr>
            
            <tr><td class="left"><?php echo $entry_comments; ?></td><td class="left">
             <?php   if($module['ki_comments'] == 1){ ?>
              <input size="10" name="kigallery_module[<?php echo $i; ?>][ki_comments]" type="radio" value="1"  checked="checked"/> <?php echo $text_enabled;?>
               <input size="10" name="kigallery_module[<?php echo $i; ?>][ki_comments]" type="radio" value="0"/> <?php echo $text_disabled;?>
               <?php } else{ ?>
              <input size="10" name="kigallery_module[<?php echo $i; ?>][ki_comments]" type="radio" value="1"/><?php echo $text_enabled;?>
               <input size="10" name="kigallery_module[<?php echo $i; ?>][ki_comments]" type="radio" value="0"  checked="checked"/> <?php echo $text_disabled;?>
               <?php } ?>    </td>
            <td><?php echo $entry_comments_help; ?></td></tr>
            
            
            <tr><td class="left"><?php echo $entry_comm_text_size; ?></td><td class="left">
              <input size="10" name="kigallery_module[<?php echo $i; ?>][ki_comm_text_size]" type="text" value="<?php echo $module['ki_comm_text_size'];?>" />
            </td>
            <td><?php echo $entry_comm_text_size_help; ?></td>
                </tr>
            
            
            <tr><td class="left"><?php echo $entry_comm_text_color; ?></td><td class="left">
              <input size="10" name="kigallery_module[<?php echo $i; ?>][ki_comm_text_color]" type="text" value="<?php echo $module['ki_comm_text_color'];?>" />
            </td>   
                <td><?php echo $entry_comm_text_color_help; ?></td>
                </tr>
            
            
            <tr><td class="left"><?php echo $entry_comm_text_font; ?></td><td class="left">
              <input size="17" name="kigallery_module[<?php echo $i; ?>][ki_comm_text_font]" type="text" value="<?php echo $module['ki_comm_text_font'];?>" />
            </td>   
                <td><?php echo $entry_comm_text_font_help; ?></td></tr>
            
              <tr><td class="left"><?php echo $entry_comm_text_align; ?></td><td class="left">
              <input size="10" name="kigallery_module[<?php echo $i; ?>][ki_comm_text_align]" type="text" value="<?php echo $module['ki_comm_text_align'];?>" />
            </td>   
                <td><?php echo $entry_comm_text_align_help; ?></td>
                </tr>
            
            
            <tr><td class="left"><?php echo $entry_comm_auto; ?></td><td class="left">
             <?php   if($module['ki_comm_auto'] == 1){ ?>
              <input size="10" name="kigallery_module[<?php echo $i; ?>][ki_comm_auto]" type="radio" value="1"  checked="checked"/> <?php echo $text_enabled;?>
               <input size="10" name="kigallery_module[<?php echo $i; ?>][ki_comm_auto]" type="radio" value="0"/> <?php echo $text_disabled;?>
               <?php } else{ ?>
              <input size="10" name="kigallery_module[<?php echo $i; ?>][ki_comm_auto]" type="radio" value="1"/><?php echo $text_enabled;?>
               <input size="10" name="kigallery_module[<?php echo $i; ?>][ki_comm_auto]" type="radio" value="0"  checked="checked"/> <?php echo $text_disabled;?>
               <?php } ?>              </td>   
                <td><?php echo $entry_comm_auto_help; ?></td></tr>
            
            
            
            <tr><td class="left"><?php echo $entry_read_meta; ?></td><td class="left">
             <?php   if($module['ki_read_meta'] == 1){ ?>
              <input size="10" name="kigallery_module[<?php echo $i; ?>][ki_read_meta]" type="radio" value="1"  checked="checked"/> <?php echo $text_enabled;?>
               <input size="10" name="kigallery_module[<?php echo $i; ?>][ki_read_meta]" type="radio" value="0"/> <?php echo $text_disabled;?>
               <?php } else{ ?>
              <input size="10" name="kigallery_module[<?php echo $i; ?>][ki_read_meta]" type="radio" value="1"/><?php echo $text_enabled;?>
               <input size="10" name="kigallery_module[<?php echo $i; ?>][ki_read_meta]" type="radio" value="0"  checked="checked"/> <?php echo $text_disabled;?>
               <?php } ?>      </td>   
                <td><?php echo $entry_read_meta_help; ?></td>
                </tr>
            
     <tr><td colspan="3"><h2/></td></tr>
            
            <tr><td class="left"><?php echo $entry_viewercomments; ?></td><td class="left">
             <?php   if($module['ki_viewercomments'] == 1){ ?>
              <input name="kigallery_module[<?php echo $i; ?>][ki_viewercomments]" type="radio" value="1"  checked="checked"/> <?php echo $text_enabled;?>
               <input name="kigallery_module[<?php echo $i; ?>][ki_viewercomments]" type="radio" value="0"/> <?php echo $text_disabled;?>
               <?php } else{ ?>
              <input name="kigallery_module[<?php echo $i; ?>][ki_viewercomments]" type="radio" value="1"/><?php echo $text_enabled;?>
               <input name="kigallery_module[<?php echo $i; ?>][ki_viewercomments]" type="radio" value="0"  checked="checked"/> <?php echo $text_disabled;?>
               <?php } ?> </td>   
                <td><?php echo $entry_viewercomments_help; ?></td>
                </tr>
            
            
                    <tr><td class="left"><?php echo $entry_moderate_posts;?></td>
          <td class="left"> 
          <?php if($module['ki_moderate_posts'] == 1){ ?>
               <input  name="kigallery_module[<?php echo $i; ?>][ki_moderate_posts]" type="radio"  value="1" checked="checked"/> <?php echo $text_enabled;?>
               <input  name="kigallery_module[<?php echo $i; ?>][ki_moderate_posts]" type="radio" value="0"/> <?php echo $text_disabled;?>
               <?php } else{ ?>    
               <input  name="kigallery_module[<?php echo $i; ?>][ki_moderate_posts]" type="radio" value="1"><?php echo $text_enabled;?>
               <input  name="kigallery_module[<?php echo $i; ?>][ki_moderate_posts]" type="radio" value="0" checked="checked"> <?php echo $text_disabled;?>
               <?php } ?>   </td>   
                <td><?php echo $entry_moderate_posts_help; ?></td>
                </tr>
 
  
                
            <tr><td class="left"><?php echo $entry_vcomm_header_color; ?></td><td class="left">
              <input size="10" name="kigallery_module[<?php echo $i; ?>][ki_vcomm_header_color]" type="text" value="<?php echo $module['ki_vcomm_header_color'];?>" />
            </td>   
                <td><?php echo $entry_vcomm_header_color_help; ?></td>
                </tr>
            
            
 
 <tr><td class="left"><?php echo $entry_vcomm_box_color; ?></td><td>
  
<input type="text" name="kigallery_module[<?php echo $i; ?>][ki_vcomm_box_color]" value="<?php echo $module['ki_vcomm_box_color'];?>" size="6">
 </td>   
                <td><?php echo $entry_vcomm_box_color_help; ?></td>
                </tr>
 
 
 
 <tr><td class="left"><?php echo $entry_vcomm_text_color; ?></td><td>
  
<input type="text" name="kigallery_module[<?php echo $i; ?>][ki_vcomm_text_color]" value="<?php echo $module['ki_vcomm_text_color'];?>" size="6">
 </td>   
                <td><?php echo $entry_vcomm_text_color_help; ?></td>
                </tr>
 
                      
                
            <tr><td class="left"><?php echo $entry_vcomm_timedate_color; ?></td><td class="left">
              <input size="10" name="kigallery_module[<?php echo $i; ?>][ki_vcomm_timedate_color]" type="text" value="<?php echo $module['ki_vcomm_timedate_color'];?>" />
            </td>   
                <td><?php echo $entry_vcomm_timedate_color_help; ?></td>
                </tr>
            
            
              
                
            <tr><td class="left"><?php echo $entry_vcomm_back_color; ?></td><td class="left">
              <input size="10" name="kigallery_module[<?php echo $i; ?>][ki_vcomm_back_color]" type="text" value="<?php echo $module['ki_vcomm_back_color'];?>" />
            </td>   
                <td><?php echo $entry_vcomm_back_color_help; ?></td>
                </tr>
            
            
              
                
            <tr><td class="left"><?php echo $entry_vcomm_bord_color; ?></td><td class="left">
              <input size="10" name="kigallery_module[<?php echo $i; ?>][ki_vcomm_bord_color]" type="text" value="<?php echo $module['ki_vcomm_bord_color'];?>" />
            </td>   
                <td><?php echo $entry_vcomm_bord_color_help; ?></td>
                </tr>
            
            
     <tr><td colspan="3"><h2/></td></tr>
              
                
            <tr><td class="left"><?php echo $entry_slideshow; ?></td><td class="left">
              <?php   if($module['ki_slideshow'] == 1){ ?>
              <input name="kigallery_module[<?php echo $i; ?>][ki_slideshow]" type="radio" value="1"  checked="checked"/> <?php echo $text_enabled;?>
               <input name="kigallery_module[<?php echo $i; ?>][ki_slideshow]" type="radio" value="0"/> <?php echo $text_disabled;?>
               <?php } else{ ?>
              <input name="kigallery_module[<?php echo $i; ?>][ki_slideshow]" type="radio" value="1"/><?php echo $text_enabled;?>
               <input name="kigallery_module[<?php echo $i; ?>][ki_slideshow]" type="radio" value="0"  checked="checked"/> <?php echo $text_disabled;?>
               <?php } ?>          </td>   
                <td><?php echo $entry_slideshow_help; ?></td>
                </tr>
            
            
              
                
            <tr><td class="left"><?php echo $entry_downloadpics; ?></td><td class="left">
             <?php   if($module['ki_downloadpics'] == 1){ ?>
              <input name="kigallery_module[<?php echo $i; ?>][ki_downloadpics]" type="radio" value="1"  checked="checked"/> <?php echo $text_enabled;?>
               <input name="kigallery_module[<?php echo $i; ?>][ki_downloadpics]" type="radio" value="0"/> <?php echo $text_disabled;?>
               <?php } else{ ?>
              <input name="kigallery_module[<?php echo $i; ?>][ki_downloadpics]" type="radio" value="1"/><?php echo $text_enabled;?>
               <input name="kigallery_module[<?php echo $i; ?>][ki_downloadpics]" type="radio" value="0"  checked="checked"/> <?php echo $text_disabled;?>
               <?php } ?>           </td>   
                <td><?php echo $entry_downloadpics_help; ?></td>
                </tr>
            
            
              
                
            <tr><td class="left"><?php echo $entry_checkgps; ?></td><td class="left">
             <?php   if($module['ki_checkgps'] == 1){ ?>
              <input" name="kigallery_module[<?php echo $i; ?>][ki_checkgps]" type="radio" value="1"  checked="checked"/> <?php echo $text_enabled;?>
               <input" name="kigallery_module[<?php echo $i; ?>][ki_checkgps]" type="radio" value="0"/> <?php echo $text_disabled;?>
               <?php } else{ ?>
              <input name="kigallery_module[<?php echo $i; ?>][ki_checkgps]" type="radio" value="1"/><?php echo $text_enabled;?>
               <input name="kigallery_module[<?php echo $i; ?>][ki_checkgps]" type="radio" value="0"  checked="checked"/> <?php echo $text_disabled;?>
               <?php } ?>        </td>   
                <td><?php echo $entry_checkgps_help; ?></td>
                </tr>
       
            
            
              
                
            <tr><td class="left"><?php echo $entry_cellinfo; ?></td><td class="left">
         <?php   if($module['ki_cellinfo'] == 1){ ?>
              <input name="kigallery_module[<?php echo $i; ?>][ki_cellinfo]" type="radio" value="1"  checked="checked"/> <?php echo $text_enabled;?>
               <input name="kigallery_module[<?php echo $i; ?>][ki_cellinfo]" type="radio" value="0"/> <?php echo $text_disabled;?>
               <?php } else{ ?>
              <input name="kigallery_module[<?php echo $i; ?>][ki_cellinfo]" type="radio" value="1"/><?php echo $text_enabled;?>
               <input name="kigallery_module[<?php echo $i; ?>][ki_cellinfo]" type="radio" value="0"  checked="checked"/> <?php echo $text_disabled;?>
               <?php } ?>            </td>   
                <td><?php echo $entry_cellinfo_help; ?></td>
                </tr>
            
            
              
                
            <tr><td class="left"><?php echo $entry_show_nav; ?></td><td class="left">
           <?php   if($module['ki_show_nav'] == 1){ ?>
              <input name="kigallery_module[<?php echo $i; ?>][ki_show_nav]" type="radio" value="1"  checked="checked"/> <?php echo $text_enabled;?>
               <input name="kigallery_module[<?php echo $i; ?>][ki_show_nav]" type="radio" value="0"/> <?php echo $text_disabled;?>
               <?php } else{ ?>
              <input  name="kigallery_module[<?php echo $i; ?>][ki_show_nav]" type="radio" value="1"/><?php echo $text_enabled;?>
               <input name="kigallery_module[<?php echo $i; ?>][ki_show_nav]" type="radio" value="0"  checked="checked"/> <?php echo $text_disabled;?>
               <?php } ?>       </td>   
                <td><?php echo $entry_show_nav_help; ?></td>
                </tr>
            
            
              
                
            <tr><td class="left"><?php echo $entry_nav_always; ?></td><td class="left">
           <?php   if($module['ki_nav_always'] == 1){ ?>
              <input name="kigallery_module[<?php echo $i; ?>][ki_nav_always]" type="radio" value="1"  checked="checked"/> <?php echo $text_enabled;?>
               <input name="kigallery_module[<?php echo $i; ?>][ki_nav_always]" type="radio" value="0"/> <?php echo $text_disabled;?>
               <?php } else{ ?>
              <input  name="kigallery_module[<?php echo $i; ?>][ki_nav_always]" type="radio" value="1"/><?php echo $text_enabled;?>
               <input name="kigallery_module[<?php echo $i; ?>][ki_nav_always]" type="radio" value="0"  checked="checked"/> <?php echo $text_disabled;?>
               <?php } ?>      </td>   
                <td><?php echo $entry_nav_always_help; ?></td>
                </tr>
            
            
              
                
            <tr><td class="left"><?php echo $entry_nav_pos; ?></td><td class="left">
              <input size="10" name="kigallery_module[<?php echo $i; ?>][ki_nav_pos]" type="text" value="<?php echo $module['ki_nav_pos'];?>" />
            </td>   
                <td><?php echo $entry_nav_pos_help; ?></td>
                </tr>
            
            
            
                
            <tr><td class="left"><?php echo $entry_nav_color; ?></td><td class="left">
              <input size="10" name="kigallery_module[<?php echo $i; ?>][ki_nav_color]" type="text" value="<?php echo $module['ki_nav_color'];?>" />
            </td>   
                <td><?php echo $entry_nav_color_help; ?></td>
                </tr>
            
            
              
                
            <tr><td class="left"><?php echo $entry_nav_border_color; ?></td><td class="left">
              <input size="10" name="kigallery_module[<?php echo $i; ?>][ki_nav_border_color]" type="text" value="<?php echo $module['ki_nav_border_color'];?>" />
            </td>   
                <td><?php echo $entry_nav_border_color_help; ?></td>
                </tr>
            
            
              
                
            <tr><td class="left"><?php echo $entry_nav_style; ?></td><td class="left">
              <input size="10" name="kigallery_module[<?php echo $i; ?>][ki_nav_style]" type="text" value="<?php echo $module['ki_nav_style'];?>" />
            </td>   
                <td><?php echo $entry_nav_style_help; ?></td>
                </tr>
            
            
              
                
            <tr><td class="left"><?php echo $entry_show_image_nav; ?></td><td class="left">
              <?php   if($module['ki_show_image_nav'] == 1){ ?>
              <input size="10" name="kigallery_module[<?php echo $i; ?>][ki_show_image_nav]" type="radio" value="1"  checked="checked"/> <?php echo $text_enabled;?>
               <input size="10" name="kigallery_module[<?php echo $i; ?>][ki_show_image_nav]" type="radio" value="0"/> <?php echo $text_disabled;?>
               <?php } else{ ?>
              <input size="10" name="kigallery_module[<?php echo $i; ?>][ki_show_image_nav]" type="radio" value="1"/><?php echo $text_enabled;?>
               <input size="10" name="kigallery_module[<?php echo $i; ?>][ki_show_image_nav]" type="radio" value="0"  checked="checked"/> <?php echo $text_disabled;?>
               <?php } ?>            </td>   
                <td><?php echo $entry_show_image_nav_help; ?></td>
                </tr>
            
            
              
                
            <tr><td class="left"><?php echo $entry_image_nav_always; ?></td><td class="left">
              <?php   if($module['ki_image_nav_always'] == 1){ ?>
              <input size="10" name="kigallery_module[<?php echo $i; ?>][ki_image_nav_always]" type="radio" value="1"  checked="checked"/> <?php echo $text_enabled;?>
               <input size="10" name="kigallery_module[<?php echo $i; ?>][ki_image_nav_always]" type="radio" value="0"/> <?php echo $text_disabled;?>
               <?php } else{ ?>
              <input size="10" name="kigallery_module[<?php echo $i; ?>][ki_image_nav_always]" type="radio" value="1"/><?php echo $text_enabled;?>
               <input size="10" name="kigallery_module[<?php echo $i; ?>][ki_image_nav_always]" type="radio" value="0"  checked="checked"/> <?php echo $text_disabled;?>
               <?php } ?>            </td>   
                <td><?php echo $entry_image_nav_always_help; ?></td>
                </tr>
            
            
              
                
            <tr><td class="left"><?php echo $entry_show_share; ?></td><td class="left">
              <?php   if($module['ki_show_share'] == 1){ ?>
              <input size="10" name="kigallery_module[<?php echo $i; ?>][ki_show_share]" type="radio" value="1"  checked="checked"/> <?php echo $text_enabled;?>
               <input size="10" name="kigallery_module[<?php echo $i; ?>][ki_show_share]" type="radio" value="0"/> <?php echo $text_disabled;?>
               <?php } else{ ?>
              <input size="10" name="kigallery_module[<?php echo $i; ?>][ki_show_share]" type="radio" value="1"/><?php echo $text_enabled;?>
               <input size="10" name="kigallery_module[<?php echo $i; ?>][ki_show_share]" type="radio" value="0"  checked="checked"/> <?php echo $text_disabled;?>
               <?php } ?>
            </td>   
                <td><?php echo $entry_show_share_help; ?></td>
                </tr>
            
            
              
                
            <tr><td class="left"><?php echo $entry_show_help; ?></td><td class="left">
              <?php   if($module['ki_show_help'] == 1){ ?>
              <input size="10" name="kigallery_module[<?php echo $i; ?>][ki_show_help]" type="radio" value="1"  checked="checked"/> <?php echo $text_enabled;?>
               <input size="10" name="kigallery_module[<?php echo $i; ?>][ki_show_help]" type="radio" value="0"/> <?php echo $text_disabled;?>
               <?php } else{ ?>
              <input size="10" name="kigallery_module[<?php echo $i; ?>][ki_show_help]" type="radio" value="1"/><?php echo $text_enabled;?>
               <input size="10" name="kigallery_module[<?php echo $i; ?>][ki_show_help]" type="radio" value="0"  checked="checked"/> <?php echo $text_disabled;?>
               <?php } ?>            </td>   
                <td><?php echo $entry_show_help_help; ?></td>
                </tr>
              
                
            <tr><td class="left"><?php echo $entry_help_pos; ?></td><td class="left">
              <input size="10" name="kigallery_module[<?php echo $i; ?>][ki_help_pos]" type="text" value="<?php echo $module['ki_help_pos'];?>" />
            </td>   
                <td><?php echo $entry_help_pos_help; ?></td>
                </tr>
            
            
              
                
            <tr><td class="left"><?php echo $entry_show_preview; ?></td><td class="left">
           <?php   if($module['ki_show_preview'] == 1){ ?>
              <input size="10" name="kigallery_module[<?php echo $i; ?>][ki_show_preview]" type="radio" value="1"  checked="checked"/> <?php echo $text_enabled;?>
               <input size="10" name="kigallery_module[<?php echo $i; ?>][ki_show_preview]" type="radio" value="0"/> <?php echo $text_disabled;?>
               <?php } else{ ?>
              <input size="10" name="kigallery_module[<?php echo $i; ?>][ki_show_preview]" type="radio" value="1"/><?php echo $text_enabled;?>
               <input size="10" name="kigallery_module[<?php echo $i; ?>][ki_show_preview]" type="radio" value="0"  checked="checked"/> <?php echo $text_disabled;?>
               <?php } ?>            </td>   
                <td><?php echo $entry_show_preview_help; ?></td>
                </tr>
            
              
                
            <tr><td class="left"><?php echo $entry_preview_style; ?></td><td class="left">
              <input size="10" name="kigallery_module[<?php echo $i; ?>][ki_preview_style]" type="text" value="<?php echo $module['ki_preview_style'];?>" />
            </td>   
                <td><?php echo $entry_preview_style_help; ?></td>
                </tr>
            
            
              
                
            <tr><td class="left"><?php echo $entry_preview_pics; ?></td><td class="left">
              <input size="10" name="kigallery_module[<?php echo $i; ?>][ki_preview_pics]" type="text" value="<?php echo $module['ki_preview_pics'];?>" />
            </td>   
                <td><?php echo $entry_preview_pics_help; ?></td>
                </tr>
            
            
              
                
            <tr><td class="left"><?php echo $entry_show_explorer; ?></td><td class="left">
           <?php   if($module['ki_show_explorer'] == 1){ ?>
              <input size="10" name="kigallery_module[<?php echo $i; ?>][ki_show_explorer]" type="radio" value="1"  checked="checked"/> <?php echo $text_enabled;?>
               <input size="10" name="kigallery_module[<?php echo $i; ?>][ki_show_explorer]" type="radio" value="0"/> <?php echo $text_disabled;?>
               <?php } else{ ?>
              <input size="10" name="kigallery_module[<?php echo $i; ?>][ki_show_explorer]" type="radio" value="1"/><?php echo $text_enabled;?>
               <input size="10" name="kigallery_module[<?php echo $i; ?>][ki_show_explorer]" type="radio" value="0"  checked="checked"/> <?php echo $text_disabled;?>
               <?php } ?>            </td>   
                <td><?php echo $entry_show_explorer_help; ?></td>
                </tr>
            
            
              
                
            <tr><td class="left"><?php echo $entry_explorer_padding; ?></td><td class="left">
              <input size="10" name="kigallery_module[<?php echo $i; ?>][ki_explorer_padding]" type="text" value="<?php echo $module['ki_explorer_padding'];?>" />
            </td>   
                <td><?php echo $entry_explorer_padding_help; ?></td>
                </tr>
            
            
              
                
            <tr><td class="left"><?php echo $entry_watermark_hori; ?></td><td class="left">
              <input size="10" name="kigallery_module[<?php echo $i; ?>][ki_watermark_hori]" type="text" value="<?php echo $module['ki_watermark_hori'];?>" />
            </td>   
                <td><?php echo $entry_watermark_hori_help; ?></td>
                </tr>
            
            
              
                
            <tr><td class="left"><?php echo $entry_watermark_vert; ?></td><td class="left">
              <input size="10" name="kigallery_module[<?php echo $i; ?>][ki_watermark_vert]" type="text" value="<?php echo $module['ki_watermark_vert'];?>" />
            </td>   
                <td><?php echo $entry_watermark_vert_help; ?></td></tr>
            
            
              
                
            <tr><td class="left"><?php echo $entry_watermark_size; ?></td><td class="left">
              <input size="10" name="kigallery_module[<?php echo $i; ?>][ki_watermark_size]" type="text" value="<?php echo $module['ki_watermark_size'];?>" />
            </td>   
                <td><?php echo $entry_watermark_size_help; ?></td>
                </tr>
            
            
              

            <tr><td class="left"><?php echo $entry_fade_color; ?></td><td class="left">
              <input size="10" name="kigallery_module[<?php echo $i; ?>][ki_fade_color]" type="text" value="<?php echo $module['ki_fade_color'];?>" />
            </td>   
                <td><?php echo $entry_fade_color_help; ?></td>
                </tr>
            
            
              
                
            <tr><td class="left"><?php echo $entry_fade_alpha; ?></td><td class="left">
              <input size="10" name="kigallery_module[<?php echo $i; ?>][ki_fade_alpha]" type="text" value="<?php echo $module['ki_fade_alpha'];?>" />
            </td>   
                <td><?php echo $entry_fade_alpha_help; ?></td>
                </tr>
            
            
              
                
            <tr><td class="left"><?php echo $entry_shade_while_loading; ?></td><td class="left">
             <?php   if($module['ki_shade_while_loading'] == 1){ ?>
              <input size="10" name="kigallery_module[<?php echo $i; ?>][ki_shade_while_loading]" type="radio" value="1"  checked="checked"/> <?php echo $text_enabled;?>
               <input size="10" name="kigallery_module[<?php echo $i; ?>][ki_shade_while_loading]" type="radio" value="0"/> <?php echo $text_disabled;?>
               <?php } else{ ?>
              <input size="10" name="kigallery_module[<?php echo $i; ?>][ki_shade_while_loading]" type="radio" value="1"/><?php echo $text_enabled;?>
               <input size="10" name="kigallery_module[<?php echo $i; ?>][ki_shade_while_loading]" type="radio" value="0"  checked="checked"/> <?php echo $text_disabled;?>
               <?php } ?>          </td>   
                <td><?php echo $entry_shade_while_loading_help; ?></td>
                </tr>
            
            
              
                
            <tr><td class="left"><?php echo $entry_disable_animation; ?></td><td class="left">
           <?php   if($module['ki_disable_animation'] == 1){ ?>
              <input size="10" name="kigallery_module[<?php echo $i; ?>][ki_disable_animation]" type="radio" value="1"  checked="checked"/> <?php echo $text_enabled;?>
               <input size="10" name="kigallery_module[<?php echo $i; ?>][ki_disable_animation]" type="radio" value="0"/> <?php echo $text_disabled;?>
               <?php } else{ ?>
              <input size="10" name="kigallery_module[<?php echo $i; ?>][ki_disable_animation]" type="radio" value="1"/><?php echo $text_enabled;?>
               <input size="10" name="kigallery_module[<?php echo $i; ?>][ki_disable_animation]" type="radio" value="0"  checked="checked"/> <?php echo $text_disabled;?>
               <?php } ?>     </td>   
                <td><?php echo $entry_disable_animation_help; ?></td>
                </tr>
            
            
              
                
            <tr><td class="left"><?php echo $entry_slideshow_time; ?></td><td class="left">
              <input size="10" name="kigallery_module[<?php echo $i; ?>][ki_slideshow_time]" type="text" value="<?php echo $module['ki_slideshow_time'];?>" />
            </td>   
                <td><?php echo $entry_slideshow_time_help; ?></td>
                </tr>
            
            
              
                
            <tr><td class="left"><?php echo $entry_show_warnings; ?></td><td class="left">
       <?php   if($module['ki_show_warnings'] == 1){ ?>
              <input size="10" name="kigallery_module[<?php echo $i; ?>][ki_show_warnings]" type="radio" value="1"  checked="checked"/> <?php echo $text_enabled;?>
               <input size="10" name="kigallery_module[<?php echo $i; ?>][ki_show_warnings]" type="radio" value="0"/> <?php echo $text_disabled;?>
               <?php } else{ ?>
              <input size="10" name="kigallery_module[<?php echo $i; ?>][ki_show_warnings]" type="radio" value="1"/><?php echo $text_enabled;?>
               <input size="10" name="kigallery_module[<?php echo $i; ?>][ki_show_warnings]" type="radio" value="0"  checked="checked"/> <?php echo $text_disabled;?>
               <?php } ?>                 </td>   
                <td><?php echo $entry_show_warnings_help; ?></td>
                </tr>
        
            <tr><td class="left"><?php echo $entry_admin_limit; ?></td><td class="left">
              <input size="5" name="kigallery_module[<?php echo $i; ?>][ki_admin_limit]" type="text" value="<?php echo $module['ki_admin_limit'];?>" />
            </td>
            
                <td></td>
                </tr>
     <tr><td class="left" colspan="3"><a onclick="$('#module-row<?php echo $i; ?>').remove();" class="button"><?php   echo $button_remove;   ?></a></td>
        
          
        </tbody>
        <?php $i++; ?>
        <?php  }
}?>
       <tfoot>
            <tr>
              <td class="right" colspan="3">
              <?php if(!isset($module['sort_order'])){ 
               ?>
              <a onclick="addModule();" class="button"><?php  echo $button_add_module;  ?></a>
              <?php }

?>
              </td>
            </tr>
          </tfoot>
      </table>
    </form>
  </div>
</div>

<script type="text/javascript"><!--
var module_row = <?php echo $i; ?>;

function addModule() {	
html  = '<tbody id="module-row' + module_row + '">';
html += '  <input type="hidden" name="kigallery_module[' + module_row + '][sort_order]" value="1"/>';
html += '   <td class="left" style="width:20%"><?php echo addslashes($entry_layout); ?></td>';
html += '   <td class="left" style="width:20%"><select name="kigallery_module[' + module_row + '][layout_id]">'; 
<?php foreach ($layouts as $layout) { 
 if($layout['name'] == 'Gallery'){?>
html += '      <option value="<?php echo $layout['layout_id']; ?>" selected="selected"><?php echo addslashes($layout['name']); ?></option>'; 
<?php } else { ?>
html += '      <option value="<?php echo $layout['layout_id']; ?>"><?php echo addslashes($layout['name']); ?></option>'; 
<?php } 
} ?>
html += '    </select></td><td class="left" style="width:60%"></td></tr>';
html += '      <input type="hidden" name="kigallery_module[' + module_row + '][position]" value="content_top">';
html += '      <tr><td class="left" style="width:20%"><?php echo addslashes($entry_status); ?></td><td class="left" style="width:20%">';
html += '      <input name="kigallery_module[' + module_row + '][status]" type="radio" value="1" checked="checked"><?php echo $text_enabled;?>';
html += '      <input name="kigallery_module[' + module_row + '][status]" type="radio" value="0"><?php echo $text_disabled;?>';
html += '    </td><td class="left" style="width:60%"></td></tr>';
html += '   <tr><td class="left"><?php echo addslashes($entry_admin_mail); ?></td><td class="left">';
html += '    <input name="kigallery_module[' + module_row + '][ki_admin_mail]" type="radio" /> <?php echo $text_enabled;?>';
html += '    <input name="kigallery_module[' + module_row + '][ki_admin_mail]" type="radio" checked="checked" value="1" value="0" /> <?php echo $text_disabled;?>';
html += '</td><td class="left"><?php echo addslashes($entry_admin_mail_help); ?></td></tr>';
html += '          <tr><td class="left"><?php echo addslashes($entry_admin_mail_from); ?></td><td class="left">';
html += '           <input size="10" name="kigallery_module[' + module_row + '][ki_admin_mail_from]" type="text" value="admin@localhost" />';
html += '         </td><td class="left"><?php echo addslashes($entry_admin_mail_from_help); ?></td></tr>';
html += '          <tr><td class="left"><?php echo $entry_admin_mail_to; ?></td><td class="left">';
html += '           <input size="10" name="kigallery_module[' + module_row + '][ki_admin_mail_to]" type="text" value="admin@localhost" />';
html += '         </td><td class="left"><?php echo addslashes($entry_admin_mail_to_help); ?></td></tr>';
html += ' <tr><td class="left"><?php echo $entry_template; ?></td><td class="left">';
html += ' <input type="text" name="kigallery_module[' + module_row + '][ki_template]" value="catalog/view/theme/<?php echo $ki_template;?>" size="12">';
html += ' </td>';
html += ' <td><?php echo $entry_template; ?></td>';
html += ' </tr>'; 
html += '                <input s name="kigallery_module[' + module_row + '][ki_config]" type="hidden" value="ki_config/" />';
html += '          <tr><td class="left"><?php echo $entry_galleriesdir; ?></td><td class="left">';
html += '           <input size="10" name="kigallery_module[' + module_row + '][ki_galleries]" type="text" value="pm_galleries/" />';
html += '         </td><td class="left"></td></tr>';
html += '          <tr><td class="left"><?php echo addslashes($entry_basedir); ?></td><td class="left">';
html += '           <input size="10" name="kigallery_module[' + module_row + '][ki_base]" type="text" value="pm_base/" />';
html += '         </td><td class="left"></td></tr>';
html += '          <tr><td class="left"><?php echo addslashes($entry_fr_width); ?></td><td class="left">';
html += '           <input size="10" name="kigallery_module[' + module_row + '][ki_fr_width]" type="text" value="900" />';
html += '         </td><td class="left" rowspan="2"><?php echo addslashes($entry_fr_width_help); ?></td></tr>';
html += '        <tr><td class="left"><?php echo addslashes($entry_fr_height); ?></td> <td class="left">';
html += '<input type="text" name="kigallery_module[' + module_row + '][ki_fr_height]" value="300" size="12">';
html += '             </td></tr>';
html += '          <tr><td class="left"><?php echo addslashes($entry_fr_color); ?></td> <td class="left">';
html += '<input type="text" name="kigallery_module[' + module_row + '][ki_fr_color]" value="#666666" size="12">';
html += '            </td><td class="left"><?php echo addslashes($entry_fr_color_help); ?></td></tr>';   
html += ' <tr><td class="left"><?php echo $entry_permission; ?></td><td class="left">';
html += ' <input name="kigallery_module[' + module_row + '][ki_permission]" type="radio" value="1"  checked="checked"/> 777';
html += ' <input name="kigallery_module[' + module_row + '][ki_permission]" type="radio" value="2"/> 775';   
html += ' <input name="kigallery_module[' + module_row + '][ki_permission]" type="radio" value="0"/> 755    </td>';   
html += ' <td><?php echo $entry_permission_help; ?></td>';
html += ' </tr>';
html += ' <tr><td class="left"><?php echo $entry_image_order; ?></td><td class="left">';  
html += ' <input name="kigallery_module[' + module_row + '][ki_img_order]" type="radio" value="manual"  checked="checked"/> <?php echo $text_manual;?><br>';  
html += ' <input name="kigallery_module[' + module_row + '][ki_img_order]" type="radio" value="size"/> <?php echo $text_size;?><br>';  
html += ' <input name="kigallery_module[' + module_row + '][ki_img_order]" type="radio" value="new"/> <?php echo $text_news;?><br>';  
html += ' <input name="kigallery_module[' + module_row + '][ki_img_order]" type="radio" value="old"/> <?php echo $text_olds;?><br>';  
html += ' <input name="kigallery_module[' + module_row + '][ki_img_order]" type="radio" value="name"/> <?php echo $text_name;?><br>';  
html += '  </td>';   
html += '<td><?php echo $entry_order_help; ?></td>';
html += '</tr>';
html += '       <tr><td class="left"><?php echo $entry_ki_mixname; ?></td><td class="left">'; 
html += '           <input  name="kigallery_module[<?php echo $i; ?>][ki_mixname]" type="radio" value="1"/> <?php echo $text_enabled;?>'; 
html += '        <input  name="kigallery_module[<?php echo $i; ?>][ki_mixname]" type="radio" value="0"  checked="checked"/> <?php echo $text_disabled;?>'; 
html += '  </td>   '; 
html += '     <td><?php echo $entry_ki_mixname_help; ?></td>'; 
html += '     </tr>'; 
html += '               <tr><td class="left"><?php echo addslashes($entry_thumbs); ?></td><td class="left">';
html += '              <input type="text" name="kigallery_module[' + module_row + '][ki_thumbs]" value="14" size="12">';
html += '         </td><td class="left"><?php echo addslashes($entry_thumbs_help); ?></td></tr>';
html += '               <tr><td class="left"><?php echo addslashes($entry_th_per_line); ?></td><td class="left">';
html += '              <input type="text" name="kigallery_module[' + module_row + '][ki_th_per_line]" value="7" size="12">';
html += '         </td><td class="left"><?php echo addslashes($entry_th_per_line_help); ?></td></tr>';
html += '	   <tr><td class="left"><?php echo addslashes($entry_th_lines); ?></td><td class="left">';
html += '	 <input type="text" name="kigallery_module[' + module_row + '][ki_th_lines]" value="auto" size="12">';
html += '            </td><td class="left"><?php echo addslashes($entry_th_lines_help); ?></td></tr>';
html += '          	   <tr><td class="left"><?php echo addslashes($entry_th_width); ?></td><td class="left">';
html += '	<input type="text" name="kigallery_module[' + module_row + '][ki_th_width]" value="auto" size="12">';		
html += '        </td><td class="left" rowspan="2"><?php echo addslashes($entry_th_width_help); ?></td></tr>';
html += '           <tr><td class="left"><?php echo addslashes($entry_th_height); ?></td><td class="left">';
html += '	<input type="text" name="kigallery_module[' + module_row + '][ki_th_height]" value="auto" size="12">';
html += '             </td></tr>'; 
html += '             <tr><td class="left"><?php echo addslashes($entry_th_bord_size); ?></td>';
html += '      <td class="left">';
html += '	<input type="text" name="kigallery_module[' + module_row + '][ki_th_bord_size]" value="5" size="12">';
html += '            </td><td class="left"><?php echo addslashes( $entry_th_bord_size_help); ?></td><td class="left"></td></tr>';

html += '  <tr><td class="left"><?php echo $entry_th_margin_left; ?></td>';
html += '  <td class="left">';
html += '  <input type="text" name="kigallery_module[' + module_row + '][ki_th_margin_left]" value="10" size="3">';
html += '  </td>';
html += '  <td rowspan="2"><?php echo $entry_th_margin_help; ?></td>';
html += '  </tr>';
html += '  <tr><td class="left"><?php echo $entry_th_margin_top; ?></td>';
html += '  <td class="left">';
html += '  <input type="text" name="kigallery_module[' + module_row + '][ki_th_margin_top]" value="10" size="3">';
html += '  </td></tr>';
html += '                 <tr><td class="left"><?php echo addslashes($entry_th_bord_color); ?></td>';
html += '          <td class="left">';
html += '         <input type="text" name="kigallery_module[' + module_row + '][ki_th_bord_color]" value="#ffffff" size="12">';
html += '</td><td class="left"><?php echo addslashes($entry_th_bord_color_help); ?></td></tr>';
html += '           <tr><td class="left"><?php echo addslashes($entry_th_bord_hover_color); ?></td><td class="left">';
html += '            <input size="10" name="kigallery_module[' + module_row + '][ki_th_bord_hover_color]" type="text" value="#bbbbbb" />';
html += '          </td><td class="left"><?php echo addslashes($entry_th_bord_hover_color_help); ?></td></tr>';
html += '          <tr><td class="left"><?php echo addslashes($entry_th_bord_hover_increase); ?></td><td class="left">';
html += '          <input size="10" name="kigallery_module[' + module_row + '][ki_th_bord_hover_increase]" type="text" value="1.2" />';
html += '         </td><td class="left"><?php echo addslashes($entry_th_bord_hover_increase_help); ?></td></tr>';
html += '           <tr><td class="left"><?php echo addslashes($entry_th_shadow); ?></td><td class="left">';
html += '           <input type="radio" name="kigallery_module[' + module_row + '][ki_th_shadow]"  checked="checked" value="1" /> <?php echo $text_enabled;?>';
html += '           <input type="radio" name="kigallery_module[' + module_row + '][ki_th_shadow]" value="0" /> <?php echo $text_disabled;?>';
html += '          </td><td class="left"><?php echo addslashes($entry_th_shadow_help); ?></td></tr>';
html += '          <tr><td class="left"><?php echo addslashes($entry_th_to_square); ?></td><td class="left">';
html += '               <input size="10" name="kigallery_module[' + module_row + '][ki_th_to_square]" type="radio" value="1"  checked="checked"/> <?php echo $text_enabled;?>';
html += '      <input size="10" name="kigallery_module[' + module_row + '][ki_th_to_square]" type="radio" value="0"/> <?php echo $text_disabled;?>';
html += '                      </td> <td><?php echo $entry_th_to_square_help; ?></td>';
html += '            </tr>';
html += '<tr><td class="left"><?php echo $entry_th_radius; ?></td><td class="left">';
html += '<input  name="kigallery_module[' + module_row + '][ki_th_radius]" type="radio" value="1"  checked="checked"/> <?php echo $text_enabled;?>';
html += '<input  name="kigallery_module[' + module_row + '][ki_th_radius]" type="radio" value="0"/> <?php echo $text_disabled;?>';
html += '</td> ';  
html += '<td></td>';
html += '</tr>';
html += '<tr><td class="left"><?php echo $entry_th_bord_radius; ?></td><td class="left">';
html += '<input size="10" name="kigallery_module[' + module_row + '][ki_th_bord_radius]" type="text" value="12" />';
html += '</td>';
html += '<td><?php echo $entry_th_bord_radius_help; ?></td></tr>';
html += '          <tr><td class="left"><?php echo addslashes($entry_th_2sq_crop_hori); ?></td><td class="left">';
html += '           <input size="10" name="kigallery_module[' + module_row + '][ki_th_2sq_crop_hori]" type="text" value="center" />';
html += '          </td><td class="left"><?php echo addslashes($entry_th_2sq_crop_hori_help); ?></td></tr>';
html += '           <tr><td class="left"><?php echo addslashes($entry_th_2sq_crop_vert); ?></td><td class="left">';
html += '            <input size="10" name="kigallery_module[' + module_row + '][ki_th_2sq_crop_vert]" type="text" value="middle" />';
html += '         </td><td class="left"><?php echo addslashes($entry_th_2sq_crop_vert_help); ?></td></tr>';
html += '          <tr><td class="left"><?php echo addslashes($entry_thumbs_to_disk); ?></td><td class="left">';
html += '            <input  name="kigallery_module[' + module_row + '][ki_thumbs_to_disk]" type="radio" checked="checked" value="1" /> <?php echo $text_enabled;?>';
html += '            <input  name="kigallery_module[' + module_row + '][ki_thumbs_to_disk]" type="radio" value="0" /> <?php echo $text_disabled;?>';
html += '         </td><td class="left"><?php echo addslashes($entry_thumbs_to_disk_help); ?></td></tr>';
html += '         <tr><td class="left"><?php echo addslashes($entry_resize_auto); ?></td><td class="left">';
html += '           <input name="kigallery_module[' + module_row + '][ki_resize_auto]" type="radio"  checked="checked" value="1" /> <?php echo $text_enabled;?>';
html += '           <input name="kigallery_module[' + module_row + '][ki_resize_auto]" type="radio" value="0" /> <?php echo $text_disabled;?>';
html += '        </td><td class="left"><?php echo addslashes($entry_resize_auto_help); ?></td></tr>';
html += '         <tr><td class="left"><?php echo addslashes($entry_bord_size); ?></td><td class="left">',
html += '          <input size="10" name="kigallery_module[' + module_row + '][ki_bord_size]" type="text" value="10" />';
html += '         </td><td class="left"><?php echo addslashes($entry_bord_size_help); ?></td></tr>';
html += '        <tr><td class="left"><?php echo addslashes($entry_bord_color); ?></td><td class="left">';
html += '          <input size="25" name="kigallery_module[' + module_row + '][ki_bord_color]" type="text" value="#ffffff" />';
html += '          </td><td class="left"></td></tr>';
html += '               <tr><td class="left"><?php echo addslashes($entry_maxim_pic_width); ?></td><td class="left">';
html += '             <input size="10" name="kigallery_module[' + module_row + '][ki_maxim_pic_width]" type="text" value="2048" />';
html += '             </td> ';
html += '                <td rowspan="2"><?php echo addslashes($entry_maxim_pic_width_help); ?></td>';
html += '                </tr>';
html += '           <tr><td class="left"><?php echo addslashes($entry_maxim_pic_height); ?></td><td class="left">';
html += '           <input size="10" name="kigallery_module[' + module_row + '][ki_maxim_pic_height]" type="text" value="1536" />';
html += '          </td></tr>';                    
html += '         <tr><td class="left"><?php echo addslashes($entry_max_pic_width); ?></td><td class="left">';
html += '          <input size="10" name="kigallery_module[' + module_row + '][ki_max_pic_width]" type="text" value="none" />';
html += '        </td><td class="left" rowspan="2"><?php echo addslashes($entry_max_pic_width_help); ?></td></tr>';
html += '         <tr><td class="left"><?php echo addslashes($entry_max_pic_height); ?></td><td class="left">';
html += '           <input size="10" name="kigallery_module[' + module_row + '][ki_max_pic_height]" type="text" value="0.75" />';
html += '        </td></tr>';
html += '        <tr><td class="left"><?php echo addslashes($entry_oversize_allowed); ?></td><td class="left">';
html += '           <input  name="kigallery_module[' + module_row + '][ki_oversize_allowed]" type="radio" value="1" /> <?php echo $text_enabled;?>';
html += '           <input  name="kigallery_module[' + module_row + '][ki_oversize_allowed]" type="radio"   checked="checked" value="0" /> <?php echo $text_disabled;?>';
html += '        </td><td class="left"><?php echo addslashes($entry_oversize_allowed_help); ?></td></tr>';
html += '        <tr><td colspan="3"><h2/></td></tr>';            
html += '         <tr><td class="left"><?php echo addslashes($entry_comments); ?></td><td class="left">';
html += '          <input  name="kigallery_module[' + module_row + '][ki_comments]" type="radio" checked="checked" value="1" /> <?php echo $text_enabled;?>';
html += '          <input  name="kigallery_module[' + module_row + '][ki_comments]" type="radio" value="0" /> <?php echo $text_disabled;?>';
html += '        </td><td class="left"><?php echo addslashes($entry_comments_help); ?></td></tr>';
html += '        <tr><td class="left"><?php echo addslashes($entry_comm_text_size); ?></td><td class="left">';
html += '         <input size="10" name="kigallery_module[' + module_row + '][ki_comm_text_size]" type="text" value="12" />';
html += '        </td><td class="left"><?php echo addslashes($entry_comm_text_size_help); ?></td></tr>';
html += '         <tr><td class="left"><?php echo addslashes($entry_comm_text_color); ?></td><td class="left">';
html += '           <input size="10" name="kigallery_module[' + module_row + '][ki_comm_text_color]" type="text" value="#000000" />';
html += '        </td><td class="left"><?php echo addslashes($entry_comm_text_color_help); ?></td></tr>';
html += '        <tr><td class="left"><?php echo addslashes($entry_comm_text_font); ?></td><td class="left">';
html += '         <input size="10" name="kigallery_module[' + module_row + '][ki_comm_text_font]" type="text" value="Tahoma, sans-serif" />';
html += '       </td><td class="left"><?php echo addslashes($entry_comm_text_font_help); ?></td></tr>';
html += '           <tr><td class="left"><?php echo addslashes($entry_comm_text_align); ?></td><td class="left">';
html += '           <input size="10" name="kigallery_module[' + module_row + '][ki_comm_text_align]" type="text" value="left" />';
html += '       </td><td class="left"><?php echo addslashes($entry_comm_text_align_help); ?></td></tr>';
html += '       <tr><td class="left"><?php echo addslashes($entry_comm_auto); ?></td><td class="left">';
html += '          <input name="kigallery_module[' + module_row + '][ki_comm_auto]" type="radio" value="1" /> <?php echo $text_enabled;?>';
html += '          <input name="kigallery_module[' + module_row + '][ki_comm_auto]" type="radio" checked="checked" value="0" /> <?php echo $text_disabled;?>';
html += '        </td><td class="left"><?php echo addslashes($entry_comm_auto_help); ?></td></tr>';
html += '         <tr><td class="left"><?php echo addslashes($entry_read_meta); ?></td><td class="left">';
html += '          <input name="kigallery_module[' + module_row + '][ki_read_meta]" type="radio" value="1" /> <?php echo $text_enabled;?>';
html += '          <input name="kigallery_module[' + module_row + '][ki_read_meta]" type="radio" checked="checked" value="0" /> <?php echo $text_disabled;?>';
html += '        </td><td class="left"><?php echo addslashes($entry_read_meta_help); ?></td></tr>';
html += '        <tr><td colspan="3"><h2/></td></tr>';      
html += '        <tr><td class="left"><?php echo addslashes($entry_viewercomments); ?></td><td class="left">';
html += '         <input name="kigallery_module[' + module_row + '][ki_viewercomments]" type="radio" checked="checked" value="1" /> <?php echo $text_enabled;?>';
html += '         <input name="kigallery_module[' + module_row + '][ki_viewercomments]" type="radio" value="0" /> <?php echo $text_disabled;?>'; 
html += '         </td><td class="left"><?php addslashes($entry_viewercomments_help); ?></td></tr>'; 
html += '               <tr><td class="left"><?php echo addslashes($entry_moderate_posts); ?></td><td>';
html += '<input type="radio" name="kigallery_module[' + module_row + '][ki_moderate_posts]" value="1"> <?php echo $text_enabled;?>';
html += '<input type="radio" name="kigallery_module[' + module_row + '][ki_moderate_posts]" checked="checked" value="0"> <?php echo $text_disabled;?>';
html += ' </td><td class="left"><?php echo addslashes($entry_moderate_posts_help); ?></td></tr>'; 
html += '      <tr><td class="left"><?php echo addslashes($entry_vcomm_header_color); ?></td><td class="left">';
html += '         <input size="10" name="kigallery_module[' + module_row + '][ki_vcomm_header_color]" type="text" value="#000000" />';
html += '     </td><td class="left"><?php echo addslashes($entry_vcomm_header_color_help); ?> </td></tr>'; 
html += ' <tr><td class="left"><?php echo addslashes($entry_vcomm_box_color); ?></td><td>';
html += '<input type="text" name="kigallery_module[' + module_row + '][ki_vcomm_box_color]" value="#000000" size="6">';
html += '</td><td class="left"><?php echo addslashes($entry_vcomm_box_color_help); ?></td>';
html += '</tr>';
html += ' <tr><td class="left"><?php echo addslashes($entry_vcomm_text_color); ?></td><td>';
html += '<input type="text" name="kigallery_module[' + module_row + '][ki_vcomm_text_color]" value="#000000" size="6">';
html += '</td><td class="left"><?php echo addslashes($entry_vcomm_text_color_help); ?></td>';
html += '</tr>';              
html += '     <tr><td class="left"><?php echo addslashes($entry_vcomm_timedate_color); ?></td><td class="left">';
html += '        <input size="10" name="kigallery_module[' + module_row + '][ki_vcomm_timedate_color]" type="text" value="#888888" />';
html += '    </td><td class="left"><?php echo addslashes($entry_vcomm_timedate_color_help); ?></td></tr>';
html += '       <tr><td class="left"><?php echo addslashes($entry_vcomm_back_color); ?></td><td class="left">';
html += '       <input size="10" name="kigallery_module[' + module_row + '][ki_vcomm_back_color]" type="text" value="none" />';
html += '    </td><td class="left"><?php echo addslashes($entry_vcomm_back_color_help); ?></td></tr>';
html += '        <tr><td class="left"><?php echo addslashes($entry_vcomm_bord_color); ?></td><td class="left">';
html += '      <input size="10" name="kigallery_module[' + module_row + '][ki_vcomm_bord_color]" type="text" value="#888888" />';
html += '     </td><td class="left"><?php echo addslashes($entry_vcomm_bord_color_help); ?></td></tr>';
html += '     <tr><td class="left"><?php echo addslashes($entry_slideshow); ?></td><td class="left">';
html += '       <input " name="kigallery_module[' + module_row + '][ki_slideshow]" type="radio" checked="checked" value="1" /> <?php echo $text_enabled;?>';
html += '       <input " name="kigallery_module[' + module_row + '][ki_slideshow]" type="radio" value="0" /> <?php echo $text_disabled;?>';
html += '    </td><td class="left"><?php echo addslashes($entry_slideshow_help); ?></td></tr>';
html += '     <tr><td class="left"><?php echo addslashes($entry_downloadpics); ?></td><td class="left">';
html += '      <input  name="kigallery_module[' + module_row + '][ki_downloadpics]" type="radio" checked="checked" value="1" /> <?php echo $text_enabled;?>';
html += '      <input  name="kigallery_module[' + module_row + '][ki_downloadpics]" type="radio" value="0" /> <?php echo $text_disabled;?>';
html += '   </td><td class="left"><?php echo addslashes($entry_downloadpics_help); ?></td></tr>';
html += '     <tr><td class="left"><?php echo addslashes($entry_checkgps); ?></td><td class="left">';
html += '      <input  name="kigallery_module[' + module_row + '][ki_checkgps]" type="radio" value="1" /> <?php echo $text_enabled;?>';
html += '      <input  name="kigallery_module[' + module_row + '][ki_checkgps]" type="radio" value="0"  checked="checked"/> <?php echo $text_disabled;?>';
html += '   </td><td class="left"><?php echo addslashes($entry_checkgps_help); ?></td></tr>';
html += '   <tr><td class="left"><?php echo addslashes($entry_cellinfo); ?></td><td class="left">';
html += '    <input name="kigallery_module[' + module_row + '][ki_cellinfo]" type="radio" value="1" /> <?php echo $text_enabled;?> <?php echo $text_enabled;?>';
html += '    <input name="kigallery_module[' + module_row + '][ki_cellinfo]" type="radio" checked="checked" value="0" /> <?php echo $text_disabled;?>';
html += '  </td><td class="left"><?php echo addslashes($entry_cellinfo_help); ?></td></tr>';
html += '   <tr><td class="left"><?php echo addslashes($entry_show_nav); ?></td><td class="left">';
html += '   <input name="kigallery_module[' + module_row + '][ki_show_nav]" type="radio" checked="checked" value="1" /> <?php echo $text_enabled;?>';
html += '   <input name="kigallery_module[' + module_row + '][ki_show_nav]" type="radio" value="0" /> <?php echo $text_disabled;?>';
html += ' </td><td class="left"><?php echo addslashes($entry_show_nav_help); ?></td></tr>';
html += '     <tr><td class="left"><?php echo addslashes($entry_nav_always); ?></td><td class="left">';
html += '     <input name="kigallery_module[' + module_row + '][ki_nav_always]" type="radio" value="1" /> <?php echo $text_enabled;?>';
html += '     <input name="kigallery_module[' + module_row + '][ki_nav_always]" type="radio" checked="checked" value="0" /> <?php echo $text_disabled;?>';
html += '  </td><td class="left"><?php echo addslashes($entry_nav_always_help); ?></td></tr>';
html += ' <tr><td class="left"><?php echo addslashes($entry_nav_pos); ?></td><td class="left">';
html += '<input size="10" name="kigallery_module[' + module_row + '][ki_nav_pos]" type="text" value="right" />';
html += ' </td><td class="left"><?php echo addslashes($entry_nav_pos_help); ?></td></tr>';
html += '   <tr><td class="left"><?php echo addslashes($entry_nav_color); ?></td><td class="left">';
html += '   <input size="10" name="kigallery_module[' + module_row + '][ki_nav_color]" type="text" value="#ffffff" />';
html += ' </td><td class="left"><?php echo addslashes($entry_nav_color_help); ?></td></tr>';
html += '<tr><td class="left"><?php echo addslashes($entry_nav_border_color); ?></td><td class="left">';
html += '<input size="10" name="kigallery_module[' + module_row + '][ki_nav_border_color]" type="text" value="#000000" />';
html += '</td><td class="left"><?php echo addslashes($entry_nav_border_color_help); ?></td></tr>';
html += '  <tr><td class="left"><?php echo addslashes($entry_nav_style); ?></td><td class="left">';
html += '  <input size="10" name="kigallery_module[' + module_row + '][ki_nav_style]" type="text" value="1" />';
html += '</td><td class="left"><?php echo addslashes($entry_nav_style_help); ?></td></tr>';
html += '<tr><td class="left"><?php echo addslashes($entry_show_image_nav); ?></td><td class="left">';
html += '  <input  name="kigallery_module[' + module_row + '][ki_show_image_nav]" type="radio" checked="checked" value="1" /> <?php echo $text_enabled;?>';
html += '  <input  name="kigallery_module[' + module_row + '][ki_show_image_nav]" type="radio" value="0" /> <?php echo $text_disabled;?>';
html += ' </td><td class="left"><?php echo addslashes($entry_show_image_nav_help); ?></td></tr>';
html += '  <tr><td class="left"><?php echo addslashes($entry_image_nav_always); ?></td><td class="left">';
html += '   <input  name="kigallery_module[' + module_row + '][ki_image_nav_always]" type="radio" value="1" /> <?php echo $text_enabled;?>';
html += '   <input  name="kigallery_module[' + module_row + '][ki_image_nav_always]" type="radio" checked="checked" value="0" /> <?php echo $text_disabled;?>';
html += '</td><td class="left"><?php echo addslashes($entry_image_nav_always_help); ?></td></tr>';
html += '  <tr><td class="left"><?php echo addslashes($entry_show_share); ?></td><td class="left">';
html += '  <input  name="kigallery_module[' + module_row + '][ki_show_share]" type="radio" checked="checked" value="1" /> <?php echo $text_enabled;?>';
html += '  <input  name="kigallery_module[' + module_row + '][ki_show_share]" type="radio" value="0" /> <?php echo $text_disabled;?>';
html += '</td><td class="left"><?php echo addslashes($entry_show_share_help); ?></td></tr>';
html += '  <tr><td class="left"><?php echo addslashes($entry_show_help); ?></td><td class="left">';
html += '   <input  name="kigallery_module[' + module_row + '][ki_show_help]" type="radio" checked="checked" value="1" /> <?php echo $text_enabled;?>';
html += '   <input  name="kigallery_module[' + module_row + '][ki_show_help]" type="radio" value="0" /> <?php echo $text_disabled;?>';
html += '    </td><td class="left"><?php echo addslashes($entry_show_help_help); ?></td></tr>';
html += '    <tr><td class="left"><?php echo addslashes($entry_help_pos); ?></td><td class="left">';
html += '   <input size="10" name="kigallery_module[' + module_row + '][ki_help_pos]" type="text" value="left" />';
html += '</td><td class="left"><?php echo addslashes($entry_help_pos_help); ?></td></tr>';
html += '  <tr><td class="left"><?php echo addslashes($entry_show_preview); ?></td><td class="left">';
html += '   <input  name="kigallery_module[' + module_row + '][ki_show_preview]" type="radio" checked="checked" value="1" /> <?php echo $text_enabled;?>';
html += '   <input  name="kigallery_module[' + module_row + '][ki_show_preview]" type="radio" value="0" /> <?php echo $text_disabled;?>';
html += '    </td><td class="left"><?php echo addslashes($entry_show_preview_help); ?></td></tr>';
html += '   <tr><td class="left"><?php echo addslashes($entry_preview_style); ?></td><td class="left">';
html += '   <input size="10" name="kigallery_module[' + module_row + '][ki_preview_style]" type="text" value="1" />';
html += ' </td><td class="left"><?php echo addslashes($entry_preview_style_help); ?></td></tr>';
html += '  <tr><td class="left"><?php echo addslashes($entry_preview_pics); ?></td><td class="left">';
html += '   <input size="10" name="kigallery_module[' + module_row + '][ki_preview_pics]" type="text" value="6" />';
html += '</td><td class="left"><?php echo addslashes($entry_preview_pics_help); ?></td></tr>'; 
html += ' <tr><td class="left"><?php echo addslashes($entry_show_explorer); ?></td><td class="left">';
html += '<input name="kigallery_module[' + module_row + '][ki_show_explorer]" type="radio" checked="checked" value="1" /> <?php echo $text_enabled;?>';
html += '<input name="kigallery_module[' + module_row + '][ki_show_explorer]" type="radio" value="0" /> <?php echo $text_disabled;?>';
html += ' </td><td class="left"><?php echo addslashes($entry_show_explorer_help); ?></td></tr>'; 
html += ' <tr><td class="left">';
html += ' <?php echo addslashes($entry_explorer_padding); ?>';
html += ' </td><td class="left">';
html += '     <input size="10" name="kigallery_module[' + module_row + '][ki_explorer_padding]" type="text" value="50" />';
html += '  </td><td class="left"><?php echo addslashes($entry_explorer_padding_help); ?></td></tr>'; 
html += '<tr><td class="left"><?php echo addslashes($entry_watermark_hori); ?></td><td class="left">';
html += '  <input size="10" name="kigallery_module[' + module_row + '][ki_watermark_hori]" type="text" value="right" />';
html += ' </td><td class="left"><?php echo addslashes($entry_watermark_hori_help); ?></td></tr>'; 
html += ' <tr><td class="left"><?php echo addslashes($entry_watermark_vert); ?></td><td class="left">';
html += ' <input size="10" name="kigallery_module[' + module_row + '][ki_watermark_vert]" type="text" value="bottom" />';
html += '</td><td class="left"><?php echo addslashes($entry_watermark_vert_help); ?></td></tr>';
html += ' <tr><td class="left"><?php echo addslashes($entry_watermark_size); ?></td><td class="left">';
html += '<input size="10" name="kigallery_module[' + module_row + '][ki_watermark_size]" type="text" value="0" />';
html += ' </td><td class="left"><?php echo addslashes($entry_watermark_size_help); ?></td></tr>';
html += ' <tr><td class="left"><?php echo addslashes($entry_fade_color); ?></td><td class="left">';
html += '  <input size="10" name="kigallery_module[' + module_row + '][ki_fade_color]" type="text" value="#000000" />';
html += '</td><td class="left"><?php echo addslashes($entry_fade_color_help); ?></td></tr>'; 
html += '<tr><td class="left"><?php echo addslashes($entry_fade_alpha); ?></td><td class="left">';
html += '  <input size="10" name="kigallery_module[' + module_row + '][ki_fade_alpha]" type="text" value="8" />';
html += '</td><td class="left"><?php echo addslashes($entry_fade_alpha_help); ?></td></tr>';
html += ' <tr><td class="left"><?php echo addslashes($entry_shade_while_loading); ?></td><td class="left">';
html += '  <input size="10" name="kigallery_module[' + module_row + '][ki_shade_while_loading]" type="radio" value="1" /> <?php echo addslashes($text_enabled);?>';
html += '  <input size="10" name="kigallery_module[' + module_row + '][ki_shade_while_loading]" type="radio" checked="checked" value="0" /> <?php echo addslashes($text_disabled);?>';
html += '</td><td class="left"><?php echo addslashes($entry_shade_while_loading_help); ?></td></tr>';
html += '<tr><td class="left"><?php echo addslashes($entry_disable_animation); ?></td><td class="left">';
html += '  <input size="10" name="kigallery_module[' + module_row + '][ki_disable_animation]" type="radio" value="1" /> <?php echo addslashes($text_enabled);?>';
html += '  <input size="10" name="kigallery_module[' + module_row + '][ki_disable_animation]" type="radio" checked="checked" value="0" /> <?php echo addslashes($text_disabled);?>';
html += '</td><td class="left"><?php echo addslashes($entry_disable_animation_help); ?></td></tr>';
html += '<tr><td class="left"><?php echo addslashes($entry_slideshow_time); ?></td><td class="left">';
html += ' <input size="10"  name="kigallery_module[' + module_row + '][ki_slideshow_time]" type="text" value="4000" />';
html += '</td><td class="left"><?php echo addslashes($entry_slideshow_time_help); ?></td></tr>';
html += '   <tr><td class="left"><?php echo addslashes($entry_show_warnings); ?></td><td class="left">';
html += '    <input name="kigallery_module[' + module_row + '][ki_show_warnings]" type="radio" checked="checked" value="1" /> <?php echo addslashes($text_enabled);?>';
html += '    <input name="kigallery_module[' + module_row + '][ki_show_warnings]" type="radio" value="0" /> <?php echo addslashes($text_disabled);?>';
html += '</td><td class="left"><?php echo addslashes($entry_show_warnings_help); ?></td>';
html += '  </tr>';
html += '    <tr><td class="left"><?php echo $entry_admin_limit; ?></td><td class="left">';
html += '   <input size="5" name="kigallery_module[<?php echo $i; ?>][ki_admin_limit]" type="text" value="24" />';
html += '   </td><td></td> </tr>';
html += '</tbody>';
	
	$('#module tfoot').before(html);
	
	module_row++;
}
//--></script>
