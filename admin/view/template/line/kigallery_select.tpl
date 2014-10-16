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
  <?php if ($success) { ?>
  <div class="success"><?php echo $success; ?></div>
  <?php } ?>
  <div class="box">
    <div class="heading">
      <h1><img src="view/image/information.png" alt="" /> <?php echo $heading_title; ?></h1>
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
               </div>
        </div>
    </div>
  </div>
</div>
<?php echo $footer; ?>
