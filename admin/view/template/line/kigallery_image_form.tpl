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
      <h1><img src="view/image/category.png" alt="" /> <?php echo $heading_title; ?>
                        > <?php echo $text_change;?></h1>
      <div class="buttons">
      <a onclick="$('#form').submit();" class="button"><?php echo $button_save; ?></a>
      <a href="<?php echo $cancel; ?>" class="button"><?php echo $button_cancel; ?></a>
      </div>
    </div>
     <div id="viewercomment"></div>
      <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form">
       <div id="tabs" class="htabs">
       <a href="#tab-general"><?php echo $tab_general; ?></a>
    <a href="#tab-resize"><?php echo $tab_resize; ?></a>
    <a href="#tab-comments"><?php echo $tab_comments; ?></a>
    <a href="#tab-watermark"><?php echo $tab_watermark; ?></a>
    <a href="#tab-exifdata"><?php echo $tab_exifdata; ?></a>
    </div>
        <div id="tab-general">
       <div class="image-left">
                            <div id="kigallery_admin_menu">
                                        <a href="<?php echo $setting; ?>"><?php echo $text_settings; ?></a>
                                        <a href="<?php echo $upload; ?>"><?php echo $text_load_images; ?></a>
                                        <a href="<?php echo $managefolder; ?>"><?php echo $text_manage_folder; ?></a>
                                 <a href="<?php echo $change; ?>"><?php echo $text_change; ?></a>
                                        <a href="<?php echo $delete; ?>"><?php echo $text_delete_images; ?></a>
                                        <a href="<?php echo $gallery_texts; ?>"><?php echo $text_gallery_texts; ?></a>
                             </div>
                             <div class="text-image-top">
                             <h4><?php echo $text_picture;?><?php echo $image;?></h4>
                              <table class="image-info" >
                                      <tboby>
                                                <tr><td class="text-image"><?php echo $text_filesize;?> <?php echo $image_info['filesize'];?> Kb</td></tr>
                                                <tr><td class="text-image"><?php echo $text_pic_width;?> <?php echo $image_info['width'];?> px</td></tr>
                                                <tr><td class="text-image"><?php echo $text_pic_height;?> <?php echo $image_info['height'];?> px</td></tr>
                                              <tr><td><?php echo $entry_folder;?>
                                              <select name="change_folder"><?php
                                              for($i=0;$i<count($folders);$i++){
                                                      if(trim($folders[$i]) == trim($image_info['folder'])){?>
                                                      <option value="<?php echo $folders[$i];?>" selected="selected"><?php echo $folders[$i];?></option>
                                                         <?php       } else{ ?>
                                                      <option value="<?php echo $folders[$i];?>" ><?php echo $folders[$i];?></option>
                                             <?php     } 
                                                  }?>
                                                  </select>
                                    </td></tr>
                                       </tbody>
                                 </table>
                                 
                          </div>                                
            </div>
            <div class="image-right">
                              <img src="../<?php echo $gallerydir.$folder.$image_info['mixname'];?>" width="300"/>
            </div>
     
               <div class="admin-comment">
                      
      <div id="languages" class="htabs">
                              <?php foreach ($languages as $language) { ?>
                              <a href="#language<?php echo $language['language_id']; ?>"><img src="view/image/flags/<?php echo $language['image']; ?>" title="<?php echo $language['name']; ?>" /> <?php echo $language['name']; ?></a>
                              <?php } ?>
                                               
              </div>
               <input type="hidden" name="image_id" value="<?php echo $image_info['id'];?>"/>
               <input type="hidden" name="foldername" value="<?php echo $image_info['folder'];?>"/>
               <input type="hidden" name="imagename" value="<?php echo $image_info['mixname'];?>"/>
               
              <div class="comment-title"><?php echo $text_admin_comment;?></div>
              
             <?php foreach ($languages as $language) { 
                            if($comment){?>                                          
                                      <div id="language<?php echo $language['language_id']; ?>">
                                             <input type="hidden" name="edit_kigallery[<?php echo $language['language_id']; ?>][id]" value="<?php if(isset($comment[$language['language_id']])) { echo $comment[$language['language_id']]['id'];}?>"/>

                                              <textarea cols="100" rows="3" name="edit_kigallery[<?php echo $language['language_id'];?>][comment]"><?php if(isset($comment[$language['language_id']])){ echo $comment[$language['language_id']]['comment']; }?></textarea>
                                              <input type="checkbox" name="delete_comment[<?php echo $language['language_id'];?>][comment]" value="1"> <?php echo $text_delete_comment;?>
                                              </div>
                                <?php 
                                } else{ ?>
                                
                                <div id="language<?php echo $language['language_id']; ?>">
                                                  <div><?php echo $text_no_comment;?></div>
                                                  <span><?php echo $entry_add_admin_comment;?></span><br/>
                                                  <textarea cols="100" rows="3" name="add_kigallery_comment[<?php echo $language['language_id'];?>][comment]"></textarea>
                       
                                </div>
                         <?php }
       }?>
     
       </div>
          
   </div> 
    
     <div id="tab-resize">   
       <div class="comment-title">     <?php echo $text_change_filesize;?></div>
                     <div class="change-field">
                               
                                         <div class="cleft"><?php echo $text_width;?> <br/>
                                        <input type="text" size="5" name="width" value="">
                                        </div>
                              
                              <div class="cleft"><?php echo $text_height;?><br/>
                              <input type="text" size="5" name="height" value="">
                              </div>
                    </div>
     </div>
   
     <div id="tab-comments">  
    
       <div class="comment-title"><?php echo $text_viewercomments;?></div>
                               <?php 
                               if(count($vcomments) > 0){
                               for($i=0;$i<count($vcomments);$i++){ ?>
                              <div class="vcomment">
                                           <div class="text"><?php echo $vcomments[$i]['comment'] ?></div> 
                                           <a class="vcomm-edit" id="name=<?php echo $vcomments[$i]['name']; ?>&post=<?php echo $vcomments[$i]['comment'] ?>&id=<?php echo $vcomments[$i]['id'];?>"><?php echo $text_edit;?></a>
                              </div>
                              <div class="vcomment-headdata">&raquo; 
                                                <span><?php echo $vcomments[$i]['date'];?> </span>
                                                <span style="font-weight:bold;"><?php echo $vcomments[$i]['name']; ?></span>
                                                <a class="vcomm-delete"  id="name=<?php echo $vcomments[$i]['name']; ?>&post=<?php echo $vcomments[$i]['comment'] ?>&id=<?php echo $vcomments[$i]['id'];?>"><?php echo $text_del;?></a><h2></div>

                                             <?php    
                                   }
                                              } else{?> 
                                              <span><?php echo $text_no_comments;?></span>
                                              <?php } ?>
                            </div>
    </div>
           <div id="tab-watermark">   
       <div class="comment-title"><?php echo $text_add_watermark;?></div>
                     <div class="change-field">
       <input type="hidden" name="watermark_hori" value="<?php echo $watermark_hori;?>"/>
       <input type="hidden" name="watermark_vert" value="<?php echo $watermark_vert;?>"/>
       <input type="hidden" name="watermark_size" value="<?php echo $watermark_size;?>"/>
                               <?php if($image_info['watermark'] == 1){?>
                                        <span><?php echo $text_found_watermark;?></span><br/><br/>
                                        <?php } ?>
                                         <span><?php echo $entry_add_watermark;?> 
                                        <input type="checkbox"  name="addwatermark" value="1">
                                        </span>
                              </div>
                    </div>
     </div>
     <div id="tab-exifdata">     
       <div class="comment-title"><?php echo " ";?></div>
          <table class="exif-data">
          <?php $exif_data = $image_info['exif_data']; ?>
                      <?php if(isset($exif_data['FileName'])){ ?>   
                    <tr><td><?php echo $text_exif_filename;?> </td><td> <?php echo  $exif_data['FileName'];?></td></tr>
                      <?php } ?>
                       <?php if(isset($exif_data['DateTimeOriginal'])){ ?>
                    <tr><td><?php echo $text_exif_datetimeoriginal;?> </td><td><?php echo  $exif_data['DateTimeOriginal'];?></td></tr>
                        <?php } ?>   
                       <?php if(isset($exif_data['FileDateTime'])){ ?>
                     <tr><td><?php echo $text_exif_filedatetime;?></td><td><?php echo  date('d-m-Y',$exif_data['FileDateTime']);?></td></tr>
                      <?php } ?>
                       <?php if(isset($exif_data['FileDateSize'])){ ?>
                    <tr><td><?php echo text_exif_filesize;?> </td><td><?php echo  $exif_data['FileSize'];?></td></tr>
                      <?php } ?>
                       <?php if(isset($exif_data['FileType'])){ ?>
                     <tr><td><?php echo $text_exif_filetype;?></td><td> <?php echo  $exif_data['FileType'];?></td></tr>
                      <?php } ?>
                       <?php if(isset($exif_data['MimeType'])){ ?>
                   <tr><td><?php echo $text_exif_mimetype;?> </td><td> <?php echo  $exif_data['MimeType'];?></td></tr>
                      <?php } ?>
                       <?php if(isset($exif_data['Make'])){ ?>
                     <tr><td><?php echo $text_exif_make;?> </td><td><?php echo  $exif_data['Make'];?></td></tr>
                      <?php } ?>
                       <?php if(isset($exif_data['Model'])){ ?>
                    <tr><td><?php echo $text_exif_model;?></td><td> <?php echo  $exif_data['Model'];?></td></tr>
                      <?php } ?>
                       <?php if(isset($exif_data['MakerNote'])){ ?>
                     <tr><td><?php echo $text_exif_makernote;?></td><td> <?php echo  $exif_data['MakerNote'];?></td></tr>
                      <?php } ?>
                       <?php if(isset($exif_data['Orientation'])){ ?>
                     <tr><td><?php echo $text_exif_orientation;?></td><td><?php echo  $exif_data['Orientation'];?></td></tr>
                      <?php } ?>
                       <?php if(isset($exif_data['Artist'])){ ?>
                     <tr><td><?php echo $text_exif_artist;?></td><td><?php echo  $exif_data['Artist'];?></td></tr>
                      <?php } ?>
                       <?php if(isset($exif_data['ISOSpeedRatings'])){ ?>
                     <tr><td><?php echo $text_exif_isospeedratings;?></td><td><?php echo  $exif_data['ISOSpeedRatings'];?></td></tr>
                      <?php } ?>
                       <?php if(isset($exif_data['XResolution'])){ ?>
                      <tr><td><?php echo $text_exif_xresolution;?></td><td> <?php echo  $exif_data['XResolution'];?></td></tr>
                      <?php } ?>
                       <?php if(isset($exif_data['YResolution'])){ ?>
                     <tr><td><?php echo $text_exif_yresolution;?> </td><td><?php echo  $exif_data['YResolution'];?></td></tr>
                      <?php } ?>
                       <?php if(isset($exif_data['ResolutionUnit'])){ ?>
                       <tr><td><?php echo $text_exif_resolutionunit;?></td><td> <?php echo  $exif_data['ResolutionUnit'];?> </td></tr>
                      <?php } ?>
                       <?php if(isset($exif_data['Software'])){ ?>
                       <tr><td><?php echo $text_exif_software;?> </td><td><?php echo  $exif_data['Software'];?> </td></tr>
                      <?php } ?>
                       <?php if(isset($exif_data['FlashPixVersion'])){ ?>
                       <tr><td><?php echo $text_exif_flashpixversion;?></td><td> <?php echo  $exif_data['FlashPixVersion'];?></td></tr>
                      <?php } ?>
                       <?php if(isset($exif_data['ExposureMode'])){ ?>
                      <tr><td><?php echo $text_exif_exposuremode;?> </td><td><?php echo  $exif_data['ExposureMode'];?></td></tr>
                      <?php } ?>
                       <?php if(isset($exif_data['WhiteBalance'])){ ?>
                       <tr><td><?php echo $text_exif_whitebalance;?></td><td> <?php echo  $exif_data['WhiteBalance'];?></td></tr>
                      <?php } ?>
                       <?php if(isset($exif_data['DigitalZoomRatio'])){ ?>
                      <tr><td><?php echo $text_exif_digitalzoomratio;?></td><td> <?php echo  $exif_data['DigitalZoomRatio'];?></td></tr>
                  
                      <?php } ?>   
                      </table>
                      </div>
           </div>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>
<script type="text/javascript"><!--
$('#tabs a').tabs(); 
$('#languages a').tabs();
//--></script> 
<script type="text/javascript">
$(".vcomm-edit").click(function(e){
          
                    var comment_id =getParam($(this).attr("id"),'id');
                    var comment =getParam($(this).attr("id"),'post');
                    var name =getParam($(this).attr("id"),'name');
                    
var sbox = '<div id="edit-viewercomment">';
sbox += '<div class="cf-title"><?php echo $text_edit_comment;?></div>\r\n'; 
sbox += '<form action="<?php echo $edit_vcomm;?>" method="post" id="editform">\r\n';
sbox += '<input type="hidden" name="edit_vcomment[id]" value="' + comment_id + '"/>';
sbox += '<div class="field-row"><?php echo $entry_writer;?> <input type="text" name="edit_vcomment[name]" value="' + name + '" size="15"/></div>\r\n'; 
sbox += '<span class="comment"><?php echo $entry_post;?></span><br/>';
sbox += '<textarea name="edit_vcomment[comment]">' + comment + '</textarea>';

sbox += '<div style="margin-top:16px;margin-left:300px;" ><a class="kg-button" onclick="$(\'#editform\').submit();" ><?php echo $button_save;?></a>\r\n'; 
sbox += '<a class="kg-button" href="<?php echo $edit_vcomm;?>"><?php echo $button_cancel;?></a></div>\r\n'; 
sbox += '</form>\r\n';
sbox += '</div>\r\n';
$('#viewercomment') .html(sbox);  
});


$(".vcomm-delete").click(function(e){
          
                    var comment_id =getParam($(this).attr("id"),'id');
                    var name =getParam($(this).attr("id"),'name');
                    var comment =getParam($(this).attr("id"),'post');
                    
var sbox = '<div id="edit-viewercomment">';
sbox += '<div class="cf-title"><?php echo $text_delete_comment;?></div>\r\n'; 
sbox += '<form action="<?php echo $edit_vcomm;?>" method="post" id="deleteform">\r\n';
sbox += '<input type="hidden" name="delete_vcomment[id]" value="' + comment_id + '"/>';
sbox += '<h4><?php echo $text_about_delete_comment;?></h4>';
sbox += ' <div><?php echo $entry_writer;?> '+name+'</div>';
sbox += ' <div><?php echo $entry_post;?> '+comment+'</div>';
sbox += '<div style="margin-top:16px;margin-left:300px;" ><a class="kg-button" onclick="$(\'#deleteform\').submit();" ><?php echo $button_save;?></a>\r\n'; 
sbox += '<a class="kg-button" href="<?php echo $edit_vcomm;?>"><?php echo $button_cancel;?></a></div>\r\n'; 
sbox += '</form>\r\n';
sbox += '</div>\r\n';
$('#viewercomment') .html(sbox);  
});
</script>
<?php echo $footer; ?>
