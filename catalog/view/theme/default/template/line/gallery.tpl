<?php echo $header; ?><?php echo $column_left;?>
<?php
if(!$ki_gallery_module or !$status){
          include('pm_base/ki_setup_original.php');
}
 include_once($ki_base."ki_include.php");
?>
<div id="gallery-content" style="width:<?php echo $ki_fr_width;?>px">
<?php echo $content_top; ?>
                         <div class="breadcrumb">
                           <?php foreach ($breadcrumbs as $breadcrumb) { ?>
                           <?php echo $breadcrumb['separator']; ?><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a>
                           <?php } ?>
                         </div>
 <?php if(!isset($koschtitgallery_folder_module)){
                         
if($count > 1){ ?>
  <div id="gallery-menu"> 
          <?php   for($i=0;$i<count($folders);$i++){ ?>
                <a href="<?php echo $link;?>&album=<?php echo $folders[$i]['folder_id'];?>"><?php echo $folders[$i]['title'];?></a>   
         <?php         } ?>
         </div>
         <?php 
         }
}

  if(isset($status) && $status == 1){
 if($folder){ ?>
                <div class="koschtitgallery" title="<?php echo $folder;?>"></div>
<?php } 
}
?>
</div>
<?php echo $column_right; ?>
<?php echo $content_bottom;?>
<?php echo $footer;?>
