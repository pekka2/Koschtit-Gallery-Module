<?php echo $header; ?>
<div id="content">
  <div class="breadcrumb">
    <?php foreach ($breadcrumbs as $breadcrumb) { ?>
              <?php echo $breadcrumb['separator']; ?><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a>
    <?php } ?>
  </div>
  <?php if($error) {?>
            <div class="warning"><?php echo $error;?></div>
  <?php } ?>
  <?php if($success) {?>
            <div class="success"><?php echo $success;?></div>
  <?php } ?>
  
  <div class="box">
    <div class="heading">
      <h1><img src="view/image/information.png" alt="" /> <?php echo $heading_title; ?>
      > <?php echo $text_manage_folder;?></h1>
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
       <div id="newfolder"></div>
       
<?php if(!$images){ ?>
       
    <table id="folders" cellspacing="4">
    <tr><td colspan="4" class="create-folder"><a id="mkdir" class="kg-button" href="<?php echo $managefolder;?>" style="margin-left:340px;"><?php echo $button_create_folder;?></a></td></tr>
    <?php   if($folder_info){ 
                      foreach($folder_info as $info) {
                                $key = array_keys($info);
                                $folder = $key[0];
                      ?>
                   <tr>
                   <td class="files"><?php echo $text_image_files;?> <?php echo $info[$folder]['files']; ?></td>
                   <td class="disk"><?php echo $text_disk_usage;?> <?php echo $info[$folder]['size']; ?> Mb</td>
                   <td class="folder">
                   <div class="folder-button" id="id=<?php echo $info[$folder]['folder_id'];?>">    <?php echo $folder ?>   </div>
                   </td>
                   <td class="empty-delete">
                   <a class="kg-button" href="<?php echo $managefolder;?>&empty=<?php echo $folder; ?>"><?php echo $button_empty_folder;?>
                   <a class="kg-button" href="<?php echo $managefolder;?>&rmdir=<?php echo $folder; ?>"><?php echo $button_delete_folder;?>
                   <a class="kg-button" href="<?php echo $managefolder;?>&images=<?php echo $folder; ?>"><?php echo $button_images;?>
                   </td>
                   </tr>
                  <?php    }
                  } ?>
           </table>
       
<?php } 
else { ?>
  <form action="<?php echo $managefolder;?>" method="post" id="folder-form">
   <input type="hidden" name="folder_name" value="<?php echo  $folder;?>">
  
  <?php if($warning){ ?>
    <div class="warning" style="width:820px;margin-left:250px;"><?php echo $warning; ?></div>
    
          <?php if($error_list){ ?>
                       <div class="buttons"><a onclick="$('#folder-form').submit();" class="button"><?php echo $button_save_list; ?></a></div>
            <?php } ?>
          <?php if($error_modify){ ?>
                       <div class="buttons"><a onclick="$('#folder-form').submit();" class="button"><?php echo $button_update_last_modified; ?></a></div>
            <?php } ?>
  
          <?php if($error_sizes){ ?>
                      <input type="hidden" name="file_sizes" value="<?php echo $file_sizes;?>"/>
                       <div class="buttons"><a onclick="$('#folder-form').submit();" class="button"><?php echo $button_update_folder_size; ?></a></div>
            <?php } ?>
 <?php } ?>
    <table id="folders">
    <tr><td>&nbsp;</td><td><?php echo $text_photoalbum;?></td><td>Mixname</td><td>Filesize</tr>
    <?php  
                for($i=0;$i<count($dir_images);$i++){ ?>
                         <tr><td class="img-left"><?php
                         if(file_exists('../'.$ki_galleries.$folder.'/thumbs/'.$dir_images[$i]['mixthumb'].$dir_images[$i]['mixname'])){ ?>
                         <img  style="width:80px;" src="../<?php echo $ki_galleries.$folder;?>/thumbs/<?php echo $dir_images[$i]['mixthumb'].$dir_images[$i]['mixname'];?>">
                         <?php }
                         else{ ?>
                         <img src="../<?php echo $ki_galleries.$folder;?>/<?php echo $dir_images[$i]['mixname'];?>" style="width:80px;">
                         <?php } ?>
                         </td>
                         <td class="img-left"><?php if(isset($db_image[$i]['filename'])) {echo $db_image[$i]['filename'];} else{ echo $dir_images[$i]['filename'];}?></td>
                         <td class="img-dir"><?php if(isset($db_image[$i]['mixname'])) {echo $db_image[$i]['mixname'];} else{ echo $dir_images[$i]['mixname'];}?></td>
                           <td class="img-dir"><?php if(isset($db_image[$i]['mixname'])) {echo $db_image[$i]['mixname'];} else{ echo $dir_images[$i]['filesize'];}?> bytes</td>
                    </tr>   
                               
            <?php } ?>
    </table>
<?php } ?>
      </table>    
    </div>
  </div>
</div>
<script type="text/javascript">

$("#mkdir").click(function(e){
e.preventDefault();
var sbox = '<div id="create-folder">';
sbox += '<div class="cf-title"><?php echo $text_create_folder;?></div>\r\n'; 
sbox += '<form action="<?php echo $managefolder;?>" method="post" id="form">\r\n';
sbox += '<div class="field-row"><?php echo $entry_directory;?> <input type="text" name="createfolder" size="15"/></div>\r\n'; 
sbox += '<div class="field-row"><?php echo $entry_sort_order;?> <input type="text" name="sort_order" size="3"/></div>\r\n'; 
sbox += '<div class="field-row"><?php echo $entry_status;?>';
sbox += '<input type="radio" name="status" value="1"/> <?php echo $text_enabled;?>\r\n'; 
sbox += '<input type="radio" name="status" value="0"/> <?php echo $text_disabled;?>\r\n'; 
sbox += '</div>';
sbox += '<div id="languages" class="htabs" style="margin-top:16px;">\r\n';<?php foreach ($languages as $language){ 
$language_id = $language['language_id'];?>
sbox += '<a href="#language<?php echo $language_id;?>">';
sbox += '<img src="view/image/flags/<?php echo $language["image"]; ?>" title="<?php echo $language["name"]; ?>" />\r\n';
sbox +='<?php echo $language["name"]; ?>';
sbox += '</a>\r\n';<?php } ?>
sbox += '</div>\r\n';
<?php foreach ($languages as $language) { ?>
sbox += '<div id="language<?php echo $language['language_id']; ?>">\r\n';
sbox += '<?php echo $entry_album_name;?> <input type="text" size="25"  name="managefolder[<?php echo $language['language_id'];?>][title]" value=""/>\r\n';
sbox += '</div>\r\n';<?php } ?>
sbox += '<div style="margin-top:16px;margin-left:300px;" ><a class="kg-button" onclick="$(\'#form\').submit();" ><?php echo $button_save;?></a>\r\n'; 
sbox += '<a class="kg-button" href="<?php echo $managefolder;?>"><?php echo $button_cancel;?></a></div>\r\n'; 
sbox +='<scr'+'ipt type="text/javascript">\r\n';
sbox +='$("#tabs a").tabs();'; 
sbox +='$("#languages a").tabs();';
sbox +='</scr'+'ipt>\r\n'; 
sbox += '</form>\r\n';
sbox += '</div>\r\n';
$('#newfolder') .html(sbox);  
});
</script>
<script type="text/javascript"><!--
$(".folder-button").click(function(e){
 e.preventDefault(); 
         
          var id = getParam($(this).attr("id"),'id');
          var tabs = $.get('index.php?route=line/kigallery/ajax&token=<?php echo $token;?>&folder_id=' + id ).success(function(data){
              var mobj =   $.parseJSON(data);
              var response = '<div id="create-folder">'; 
                    response += '<div class="cf-title"><?php echo $text_edit_folder;?></div>'; 
                    response += '<form action="<?php echo $managefolder;?>" method="post" id="editform">';
                    response += '<input type="hidden" name="editfolder[folder_id]" value="' + id + '"/>';
                    response += '<div class="field-row"><?php echo $entry_directory;?> <input type="text" name="editfolder[name]" size="15" value="' + getParam(mobj[0],'folder') + '"/></div>'; 
                    response += '<div class="field-row"><?php echo $entry_sort_order;?> <input type="text" name="editfolder[sort_order]" size="3" value="' + getParam(mobj[0],'sort_order') + '"/></div>'; 
                    response += '<div class="field-row"><?php echo $entry_status;?>';
                    if(getParam(mobj[0],'status') == 1){
                              response += '<input type="radio" name="editfolder[status]" value="1" checked="checked"/> <?php echo $text_enabled;?>'; 
                              response += '<input type="radio" name="editfolder[status]" value="0"/> <?php echo $text_disabled;?>\r\n'; 
                    }
                    else{
                              response += '<input type="radio" name="editfolder[status]" value="1"/> <?php  echo $text_enabled;?>'; 
                              response += '<input type="radio" name="editfolder[status]" value="0" checked="checked"/> <?php echo $text_disabled;?>'; 
                    } 
                    response += '<div id="languages" class="htabs" style="margin-top:16px;">';
                    for(var i = 0; i< mobj.length;i++){
                              response += '<a href="#language' + getParam(mobj[i],'language_id') + '">';
                              response += '<img src="view/image/flags/' + getParam(mobj[i],'image') + '" title="' + getParam(mobj[i],'name') + '" />';
                              response += getParam(mobj[i],'name') + '</a>' ;
                     }
                    response +='</div>';
                    for(var i = 0; i< mobj.length;i++){         
                              response += '<div id="language' + getParam(mobj[i],'language_id') + '">';
                              response += '<?php echo $entry_album_name;?>   <input type="text" size="25"  name="updatefolder[' + getParam(mobj[i],'language_id') + '][title]" value="' + getParam(mobj[i],'title') + '"/>';         
                              response +=  '</div>';
                    }
                     response += '</div>'; 
                     response += '<div style="margin-top:16px;margin-left:300px;" ><a class="kg-button" onclick="$(\'#editform\').submit();" ><?php echo $button_save;?></a>'; 
                     response += '<a class="kg-button" href="<?php echo $managefolder;?>"><?php echo $button_cancel;?></a></div>'; 
                     response +='<scr'+'ipt type="text/javascript">';
                     response +='$("#tabs a").tabs();'; 
                     response +='$("#languages a").tabs();';
                     response +='</scr'+'ipt>'; 
                     response += '</form>';
                     response += '</div>';
                    $('#newfolder').html(response);  
          }); 
});
</script>

<script type="text/javascript"><!--
$('#tabs a').tabs(); 
$('#languages a').tabs();
//--></script>
<div></div>
