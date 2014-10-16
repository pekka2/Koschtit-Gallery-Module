<?php echo $header; ?>
<div id="content" style="height:800px;">
                    <div class="breadcrumb">
                      <?php foreach ($breadcrumbs as $breadcrumb) { ?>
                      <?php echo $breadcrumb['separator']; ?><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a>
                      <?php } ?>
                    </div>
  <?php if ($warning) { ?>
                    <div class="warning"><?php echo $warning; ?></div>
  <?php } ?>
  <?php if ($image_not_found) { ?>
                    <div class="warning"><?php echo $image_not_found; ?></div>
  <?php } ?>
  <?php if ($module_not_found) { ?>
                    <div class="warning"><?php echo $module_not_found; ?></div>
  <?php } ?>
  <?php if ($not_permission) { ?>
                    <div class="warning"><?php echo $not_permission; ?></div>
  <?php } ?>
  <?php if ($error_system) { ?>
  <div class="warning"><?php echo $error_system; ?></div>
  <?php } ?>
  <?php if ($error_password) { ?>
  <div class="warning"><?php echo $error_password; ?></div>
  <?php } ?>
  <?php if ($error_username) { ?>
  <div class="warning"><?php echo $error_username; ?></div>
  <?php } ?>
  <?php if ($error_database) { ?>
  <div class="warning"><?php echo $error_database; ?></div>
  <?php } ?>
  <?php if ($error_db_server) { ?>
  <div class="warning"><?php echo $error_db_server; ?></div>
  <?php } ?>
  <?php if ($error_db_prefix) { ?>
  <div class="warning"><?php echo $error_db_prefix; ?></div>
  <?php } ?>
  <?php if ($success) { ?>
                    <div class="success"><?php echo $success; ?></div>
  <?php } ?>
  <div class="box">
                      <div class="heading">
                        <h1><img src="view/image/information.png" alt="" /> <?php echo $heading_title; ?>
                        > <?php echo $text_load_images;?></h1>
                      <div class="buttons">       
      <a onclick="$('#form').submit();" class="button"><?php echo $button_save; ?></a> &nbsp;  
     <a href="<?php echo $cancel; ?>" class="button"><?php echo $button_cancel; ?></a>
     </div>   </div>
                       
    <div class="content" style="height:800px;">
        
        <div id="leftdiv">
          <div id="kigallery_admin_menu">
                                 <a href="<?php echo $setting; ?>"><?php echo $text_settings; ?></a>
                                 <a href="<?php echo $upload; ?>"><?php echo $text_load_images; ?></a>
                                 <a href="<?php echo $managefolder; ?>"><?php echo $text_manage_folder; ?></a>
                                 <a href="<?php echo $change; ?>"><?php echo $text_change; ?></a>
                                 <a href="<?php echo $delete; ?>"><?php echo $text_delete_images; ?></a>
                                 <a href="<?php echo $gallery_texts; ?>"><?php echo $text_gallery_texts; ?></a>
           </div>
              </div> 
      <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form">

       <div id="folder-in">
       <span class="text-folder"><?php echo $text_folders_in;?></span>
       <input type="hidden" name="folder" value="<?php  if($folders) { echo $folders[$to_album]; }?>"/>
       
       <span class="to-album"><?php if($folders) {  echo $folders[$to_album]; } else { echo $text_folder_root; }?></span><br/>
       <span class="folder-selects">
       <?php if($folders) {    for($i=0; $i<count($folders);$i++){ ?>
       <a href="<?php echo $upload;?>&to=<?php echo $i;?>"><?php echo $folders[$i];?></a>&nbsp;
      <?php }
      }
       ?>
       </span>
       </div>
 <div id="add-image">
           
       <input type="hidden" name="galleries" value="<?php echo $ki_galleries;?>"/>
       <input type="hidden" name="basedir" value="<?php echo $ki_basedir;?>"/>
       <input type="hidden" name="watermark_hori" value="<?php echo $watermark_hori;?>"/>
       <input type="hidden" name="watermark_vert" value="<?php echo $watermark_vert;?>"/>
       <input type="hidden" name="watermark_size" value="<?php echo $watermark_size;?>"/>
       
          <span class="upload"><?php echo $entry_upload;?></span>
          <input class="multiple-field" multiple="multiple" type="file" name="file"/>
          <div>
          <span class="upload"><?php echo $entry_sort_order;?></span>
           <input name="sort_order" type="text" value="<?php echo $sort_order;?>" size="3"/>
           </div>
           <div>
               <span class="upload"><?php echo $entry_watermark;?></span>
               <input style="width:350px;border:solid #666666 1px;" type="file" name="watermark"/>
               <br/><br/>
                 <span class="watermark"><?php echo $entry_add_watermark;?></span> <input type="checkbox" name="addwatermark" value="1">
               <br/>
               <br/>
                 <span class="watermark"><?php echo $entry_rotate;?></span> <input type="checkbox" name="rotate" value="1">
               <br/>
               <br/>

               <span class="watermark"><?php echo $entry_maximum_image_size;?></span> <input type="text" name="maxx" value="" size="5"/>x<input type="text" name="maxy" value="" size="5"/>
            </div>
    </div>
   
                 </form>
    </div>
  </div>
</div>
<?php echo $footer; ?>
