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
  <div id="delsuccess"></div>
  <?php if($file_not_found){ ?>
  <div id="delete_error"></div>
 <?php  } ?>
  <div class="box">
    <div class="heading">
      <h1><img src="view/image/information.png" alt="" /> <?php echo $heading_title; ?>
      > <?php echo $text_delete_images;?>
      </h1>
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
                 <td><a href="<?php echo $delete;?>&album=<?php echo $folders[$i];?>"><?php echo $folders[$i];?></a></td>
         <?php   if($r%2 == 0 && $i !='0'){ echo "\r\n".'</tr><tr>';}
                      if($i == $end-1) { ?> </tr><?php } 
         $r++;        } ?>
      </tbody>
      </table>
</div>
</div>
</div>
                 
        <div id="gallery_images">
      <?php if($gallery){  
          for($i=$start; $i<$plimit;$i++){
                    ?>
                  <span id="img_<?php echo $i;?>">
                            <a class="deleted" href="<?php echo $delete;?>&id=img_<?php echo $i;?>&ki_galleries=<?php echo $ki_galleries;?>&ki_base=<?php echo $basedir;?>&album=<?php echo $gallery[$i]['name'];?>&file=<?php echo $gallery[$i]['mixname'];?>&thumb=<?php echo $gallery[$i]['mixthumb']?><?php echo $gallery[$i]['mixname'];?>&page=<?php echo $page;?>">
                            <?php 
                             if(!$no_thumbs){
                                       if(file_exists('../'.$ki_galleries.$gallery[$i]['name'].'/thumbs/'.$gallery[$i]['mixthumb'].$gallery[$i]['mixname'])){ ?>
                                              <img class="gallery" src="../<?php echo $ki_galleries;?><?php echo $gallery[$i]['name'];?>/thumbs/<?php echo $gallery[$i]['mixthumb'].$gallery[$i]['mixname'];?>"  alt="img" title="<?php echo $gallery[$i]['filename'];?>">
                            <?php } elseif(file_exists('../'.$ki_galleries.$gallery[$i]['name'].'/'.$gallery[$i]['mixname'])) { ?>
                                              <img class="gallery" src="../<?php echo $basedir;?>ki_makepic.php?file=<?php echo $gallery[$i]['name'];?>/<?php echo $gallery[$i]['mixname'];?>&width=120&height=120" alt="img" title="<?php echo $gallery[$i]['filename'];?>">
                            <?php } 
                            }else { 
                                      // No folder_dir - file and no thumbs
                                     ?>
                                      <img class="browse" src="../<?php echo $basedir;?>ki_makepic.php?file=<?php echo $gallery[$i]['name'].'/'.$gallery[$i]['mixname'];?>&width=120&height=120"  alt="img" title="<?php echo $gallery[$i]['mixname'];?>">
                                   
                    <?php         } ?>
                            </a>
                    </span>
   <?php } ?>
 
 <?php 
}
?>

  <div class="pagination"><?php echo $pagination; ?></div>
        </div>
    </div>
  </div>
</div>
<script type="text/javascript">
$("a.deleted").click(function(e){
	e.preventDefault();
                    
                    var idname =getParam($(this).attr("href"),'id');
                    
	$.ajax({
                      type	: "GET",
                       data: {
                              action: 'deleteimage',
                              imagefile: getParam($(this).attr("href"),'file'),
                              imagepath: getParam($(this).attr("href"),'ki_galleries') + '/' + getParam($(this).attr("href"),'album')+'/', 
                     }
                      url: $(this).attr("href"),
                      success: function(data) {
                            var sbox = '<div id="ajax-success">';
                            sbox += '<?php echo $text_delete_success;?>';
                            sbox += '</div>';
                            $('#delsuccess') .html(sbox);    
                            $('#' + idname) .html("");   
		}
	});
});
</script>
<?php echo $footer; ?>
