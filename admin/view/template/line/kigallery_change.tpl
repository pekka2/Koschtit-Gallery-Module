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
  <div id="delsuccess"></div>
  <?php if($file_not_found){ ?>
  <div id="delete_error"></div>
 <?php  } ?>
 
  <div class="box">
                       <div class="heading">
                       
                                              <h1><img src="view/image/information.png" alt="" /> <?php echo $heading_title; ?>
                                               > <?php echo $text_change;?></h1>
                                               
                                              <div class="buttons">
                                              <a onclick="$('#form').submit();" class="button"><?php echo $button_save; ?></a>
                                              <a href="<?php echo $cancel; ?>" class="button"><?php echo $button_cancel; ?></a>
                                              </div>
                       
                       </div>
   
    <div class="content">
        <div id="leftdiv">
                            <div id="kigallery_admin_menu">
                                 <a href="<?php echo $setting; ?>"><?php echo $text_settings; ?></a>
                                 <a href="<?php echo $upload; ?>"><?php echo $text_load_images; ?></a>
                                 <a href="<?php echo $managefolder; ?>"><?php echo $text_manage_folder; ?></a>
                                 <a href="<?php echo $change; ?>"><?php echo $text_change; ?></a>
                                 <a href="<?php echo $delete; ?>"><?php echo $text_delete_images; ?></a>
                                 <a href="<?php echo $gallery_texts; ?>"><?php echo $text_gallery_texts; ?></a>
                                 <img src="view/image/grey.gif" alt="gif" width="210"/>
                                 <div>
                                                     
               <table class="folders">
               <tbody>
                 <?php $end = count($folders);
                 $r=1;
                 sort($folders);
                 for($i=0; $i<count($folders);$i++){ 
                           if($i == 0 ){ echo "<tr>";} ?>
                        <td><a href="<?php echo $change;?>&album=<?php echo $folders[$i];?>"><?php echo $folders[$i];?></a></td>
                <?php   if($r%2 == 0 && $i !='0'){ echo "\r\n".'</tr><tr>';}
                             if($i == $end-1) { ?> </tr><?php } 
                $r++;        } ?>
             </tbody>
             </table>
             
      </div>
   </div>
   </div>              
<div id="gallery_images" >
        
        <form action="<?php echo $action;?>" method="post" id="form">
        <table class="image-change">
       <thead> <tr><td class="left">Folder name</td><td>Original filename</td><td>Mixed filename</td><td>Sort Order</td></tr>
       </thead>
      <?php if($gallery){ 
           for($i=$start;$i<$plimit;$i++){     
                 ?>
                 <tr>      
                    <td class="left"><?php echo $gallery[$i]['name'];?></td>
                 <td>
    <a  href="<?php echo $image;?>&image=<?php echo $gallery[$i]['name'];?>/<?php echo $gallery[$i]['filename'];?>"> <?php echo $gallery[$i]['filename'];?></a></td>        
            <td><?php echo $gallery[$i]['mixname'];?></td>
            <input type="hidden" name="image_change[<?php echo $i;?>][image_id]" value="<?php echo $gallery[$i]['id'];?>"/>
               <td><input name="image_change[<?php echo $i;?>][sort_order]" value="<?php echo $gallery[$i]['sort_order'];?>" size="3"/></td>
   <?php }
} ?>
<table>
</form>
 
  <div class="pagination"><?php echo $pagination; ?></div>
        </div>
        
  </div>
</div>
