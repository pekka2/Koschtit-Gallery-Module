<?php
require("config.php");
require_once(DIR_SYSTEM . 'database/mysql.php');
$php = file("index.php");
$line = '';
$str = 'define(';
for($i=0;$i<11;$i++){
                       if(substr_count($php[$i],$str)){
                                              $line = $php[$i];
                           }
}
$version = explode('\'',$line);

function editUserGroup($db,$user_group_id) {
                       $query = $db->query("SELECT * FROM `" . DB_PREFIX . "user_group` WHERE user_group_id = '" . $user_group_id . "'");
                       $result = $query->row['permission'];
                       $data = unserialize($result);
                       $data['access'][] = 'line/kigallery';
                       $data['access'][] = 'module/koschtit_gallery';
                       $data['access'][] = 'module/koschtitgallery_folder';
                       $data['modify'][] = 'line/kigallery';
                       $data['modify'][] = 'module/koschtit_gallery';
                       $data['modify'][] = 'module/koschtitgallery_folder';
                       sort($data['access']);
                       sort($data['modify']);

$db->query("UPDATE `" . DB_PREFIX . "user_group` SET  permission = '" . serialize($data) . "' WHERE user_group_id = '" . $user_group_id . "'");
}
?>

<html>
<body style="background:rgb(200,200,200);">
<div style="margin-top:20px;margin-left:auto;margin-right:auto;width:980px;height:auto;background:#ffffff;padding:30px;border:2px solid blue;">
<em><strong>FOUND YOUR STORE VERSION: <?php echo $version[3];?></strong></em><br><br>
<?php 
$your_version = $version[3];
$your_version = str_replace('.','',$your_version);
if(strlen($your_version) == 3){
                       $your_version = $your_version.'0';
}
// Database 
if(class_exists("DBMySQL")){
$db = new DBMySQL(DB_HOSTNAME, DB_USERNAME, DB_PASSWORD, DB_DATABASE);
}elseif(class_exits("MySQL")){
$db = new MySQL(DB_HOSTNAME, DB_USERNAME, DB_PASSWORD, DB_DATABASE);
}
?>

<br><br/>
<?php

if(!isset($_POST['administrator'])){
$setup ='<?php'."\r\n";
$setup .='// DB'."\r\n";
$setup .='$dir_system = \''.DIR_SYSTEM.'\';'."\r\n";
$setup .='$db_hostname = \''.DB_HOSTNAME.'\';'."\r\n";
$setup .='$db_username = \''.DB_USERNAME.'\';'."\r\n";
$setup .='$db_password = \''.DB_PASSWORD.'\';'."\r\n";
$setup .='$db_database = \''.DB_DATABASE.'\';'."\r\n";
$setup .='$db_prefix = \''.DB_PREFIX .'\';'."\r\n";
$setup .='require($dir_system . \'database/mysql.php\');'."\r\n";
$setup .='$session = \'\';'."\r\n";
 $setup .='// Database'."\r\n";
 
// Database 
if($your_version > 1560){
$setup .=' $ki_db = new DBMySQL($db_hostname, $db_username, $db_password, $db_database);'."\r\n";
}else{
$setup .=' $ki_db = new MySQL($db_hostname, $db_username, $db_password, $db_database);'."\r\n";
}

$setup .="\r\n";
 $setup .='// Settings'."\r\n";
  $setup .='$ki_query = $ki_db->query("SELECT * FROM " . $db_prefix . "setting WHERE `key`=\'kigallery_module\'");'."\r\n";
$setup .='  $ki_array = $ki_query->row;'."\r\n";
  $setup .='$ki_setup = \'\';'."\r\n";
 $setup .='if($ki_array){'."\r\n";
$setup .='   $ki_setup = unserialize($ki_array[\'value\']);'."\r\n";
 $setup .='}'."\r\n";
$setup .='  $ki_query2 = $ki_db->query("SELECT * FROM " . $db_prefix . "setting WHERE `key`=\'config_language\'");'."\r\n";
$setup .='  $array = $ki_query2->row;'."\r\n";
$setup .=' $config_language = $array[\'value\'];'."\r\n";
 $setup .="\r\n";
$setup .=' if(isset($_SESSION)){'."\r\n";
$setup .='           $session = $_SESSION;'."\r\n";
 $setup .='}'."\r\n";
$setup .="\r\n"; 
$setup .='  $dquery = $ki_db->query("SELECT * FROM " . $db_prefix . "language WHERE `code` =  \'".$config_language."\'");'."\r\n";
$setup .='  $df = $dquery->row[\'language_id\'];'."\r\n";
$setup .= "\r\n";
 $setup .='if(isset($session[\'language\'])){'."\r\n";
$setup .='  $query = $ki_db->query("SELECT * FROM " . $db_prefix . "language WHERE `code` =  \'".$session[\'language\']."\'");'."\r\n";
$setup .='  $lg = $query->row[\'language_id\'];'."\r\n";
$setup .=' } else{'."\r\n";
$setup .='       $lg = $df;'."\r\n";
$setup .='}'."\r\n";
$setup .= "\r\n";
$setup .= "\r\n";
$setup .=' // Select Gallery Texts'."\r\n";
$setup .=' $dkoschtit = $ki_db->query("SELECT * FROM " . $db_prefix . "koschtit_gallery_description '."\r\n";
$setup .='  WHERE language_id = \'" . $df. "\'");'."\r\n";
$setup .='  $df_result = $dkoschtit->row;'."\r\n";
$setup .= "\r\n"; 
$setup .=' $koschtit = $ki_db->query("SELECT * FROM " . $db_prefix . "koschtit_gallery_description'."\r\n"; 
$setup .='  WHERE language_id = \'" . $lg. "\'");'."\r\n";
$setup .='  $ki_result = $koschtit->row;'."\r\n";
$setup .= "\r\n";
$setup .='  if(!isset($ki_result[\'id\'])){'."\r\n";
$setup .='            $ki_result = $df_result;'."\r\n";
$setup .='  }'."\r\n";
$setup .= "\r\n"; 
$setup .='   // Extract'."\r\n";
$setup .='   if(isset($ki_setup[0]) && $ki_setup[0][\'status\'] == 1){'."\r\n";
$setup .='            extract($ki_setup[0]);'."\r\n";
$setup .='  } else{'."\r\n";
$setup .='               include("../pm_base/ki_setup_original.php");'."\r\n";
$setup .='   }'."\r\n";
$setup .='  extract($ki_result);'."\r\n"; 
$setup .='  $ki_help_text = str_replace("\r\n","",$ki_help_text);'."\r\n";
$setup .='  $ki_session_language = $lg;'."\r\n";
$setup .='?>'."\r\n";
//---------------------------------

$path = 'ki_config/';
$filepath = 'ki_config/ki_setup.php';
if(!is_writable($path)){?>
                       <div style="background:rgb(230,180,230);padding:10px;">Error: Not permission to Directory <em>ki_config</em>. Your change permission to 777.</div>
                       <?php
                       $error = true;
}
if(!isset($error)){
   
                       $fw = fopen($filepath,"w");
                       fwrite($fw,$setup);
                       fclose($fw);
                       ?>
                       <div style="background:rgb(180,240,180);padding:10px;">Install is Success to File <em>ki_config/ki_setup.php</em>.</div>
                       
                       <?php
}

?>

<?php
if(!isset($error)){?>
                       
<em><b>Koschtit Gallery tables install in the database</b></em><br/>

<?php
/* ------------------------------------------------------------------------------------- */

$db->query("CREATE TABLE IF NOT EXISTS `" . DB_PREFIX . "koschtit_gallery_admin_comment` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `folder_name` varchar(255) COLLATE utf8_general_ci NOT NULL,
  `image_name` varchar(255) COLLATE utf8_general_ci NOT NULL,
  `comment` text COLLATE utf8_general_ci NOT NULL,
  `language_id` int(5) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci AUTO_INCREMENT=1");

?>


<div style="background:rgb(180,240,180);padding:10px;">Table  <em><?php echo DB_PREFIX;?>koschtit_gallery_admin_comment</em> is added database success!</div><br/>


<?php
/* ------------------------------------------------------------------------------------- */

$db->query("CREATE TABLE IF NOT EXISTS `" . DB_PREFIX . "koschtit_gallery_description` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `language_id` int(11) NOT NULL,
  `ki_comm_auto_string` text NOT NULL,
  `ki_nav_next` varchar(50) NOT NULL,
  `ki_nav_back` varchar(50) NOT NULL,
  `ki_nav_maxi` varchar(50) NOT NULL,
  `ki_nav_kiv_next` varchar(50) NOT NULL,
  `ki_nav_kiv_back` varchar(50) NOT NULL,
  `ki_nav_kiv_close` varchar(50) NOT NULL,
  `ki_nav_gps_coord` varchar(255) NOT NULL,
  `ki_nav_kiv_vcomm` varchar(255) NOT NULL,
  `ki_nav_kiv_download` varchar(255) NOT NULL,
  `ki_slideshow_start` varchar(200) NOT NULL,
  `ki_slideshow_stop` varchar(200) NOT NULL,
  `ki_help_text` text NOT NULL,
  `ki_vcomm_lac` varchar(200) NOT NULL,
  `ki_vcomm_name` varchar(200) NOT NULL,
  `ki_vcomm_comm` varchar(200) NOT NULL,
  `ki_vcomm_post` varchar(200) NOT NULL,
  `ki_vcomm_clk` varchar(200) NOT NULL,
  `ki_vcomm_ncy` varchar(200) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2");

?>


<div style="background:rgb(180,240,180);padding:10px;">Table  <em><?php echo DB_PREFIX;?>koschtit_gallery_description</em> is added database success!</div><br/>


<?php

$db->query("CREATE TABLE IF NOT EXISTS `" . DB_PREFIX . "koschtit_gallery_folder` (
  `folder_id` int(3) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) COLLATE utf8_general_ci NOT NULL,
  `mixthumb` int(30) NOT NULL,
  `size` int(15)  NOT NULL,
  `size_of_fr` int(30) NOT NULL,
  `files` int(5) NOT NULL,
  `last_modified` varchar(30) COLLATE utf8_swedish_ci NOT NULL,
  `sort_order` int(3) NOT NULL,
  `status` int(3) NOT NULL,
  PRIMARY KEY (`folder_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci AUTO_INCREMENT=3");


?>




<div style="background:rgb(180,240,180);padding:10px;">Table  <em><?php echo DB_PREFIX;?>koschtit_gallery_folder</em> is added database success!</div><br/>


<?php

$db->query("CREATE TABLE IF NOT EXISTS `" . DB_PREFIX . "koschtit_gallery_folder_description` (
  `id` int(3) NOT NULL AUTO_INCREMENT,
  `folder_id` int(5) NOT NULL,
  `title` varchar(50) COLLATE utf8_general_ci NOT NULL,
  `description` text COLLATE utf8_general_ci,
  `language_id` int(5) NOT NULL,
  `date_modified` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci AUTO_INCREMENT=3");

?>

<div style="background:rgb(180,240,180);padding:10px;">Table  <em><?php echo DB_PREFIX;?>koschtit_gallery_folder_description</em> is added database success!</div><br/>




<?php

$db->query("CREATE TABLE IF NOT EXISTS `" . DB_PREFIX . "koschtit_gallery_image` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `folder_id` int(3) NOT NULL,
  `title` varchar(40) COLLATE utf8_general_ci NOT NULL,
  `filename` varchar(100) COLLATE utf8_general_ci NOT NULL,
  `mixname` varchar(100) COLLATE utf8_general_ci NOT NULL,
  `width` int(6) NOT NULL,
  `height` int(6) NOT NULL,
  `filesize` int(20) NOT NULL,
  `exif_data` text COLLATE utf8_swedish_ci NOT NULL,
  `watermark` int(5) NOT NULL,
  `imageframe` int(5) NOT NULL,
  `width_of_fr` int(11) NOT NULL,
  `height_of_fr` int(11) NOT NULL,
  `filesize_of_fr` int(20) NOT NULL,
  `viewed` int(11) NOT NULL,
  `date_added` date NOT NULL,
  `sort_order` int(5) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci AUTO_INCREMENT=1");

?>




<div style="background:rgb(180,240,180);padding:10px;">Table  <em><?php echo DB_PREFIX;?>koschtit_gallery_image</em> is added database success!</div><br/>




<?php

$db->query("CREATE TABLE IF NOT EXISTS `" . DB_PREFIX . "koschtit_gallery_viewercomment` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) COLLATE utf8_general_ci NOT NULL,
  `address` varchar(100) COLLATE utf8_general_ci NOT NULL,
  `date` date NOT NULL,
  `folder_name` varchar(255) COLLATE utf8_general_ci NOT NULL,
  `image_name` varchar(255) COLLATE utf8_general_ci NOT NULL,
  `comment` text COLLATE utf8_swedish_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci AUTO_INCREMENT=3");

?>



<div style="background:rgb(180,240,180);padding:10px;">Table  <em><?php echo DB_PREFIX;?>koschtit_gallery_viewercomment</em> is added database success!</div><br/>


<?php

/* ........... Add Gallery texts all language_id of Store langauges */


$query = $db->query("SELECT * FROM `".DB_PREFIX ."language`");
$languages = $query->rows;
$i=1;
$descrip = $db->query("SELECT * FROM `".DB_PREFIX ."koschtit_gallery_description`");
$test = $descrip->rows;
if(!isset($test[0]['id'])){
                       
$db->query("INSERT INTO `".DB_PREFIX ."koschtit_gallery_folder` (`folder_id`, `name`, `mixthumb`, `size`, `files`, `last_modified`, `sort_order`, `status`) VALUES
(1, 'test', 2147483647, '0', 0, '', 1, 1)");


                       foreach($languages as $language){
                                              
                       $db->query("INSERT INTO `" . DB_PREFIX . "koschtit_gallery_folder_description` (`id`, `folder_id`, `title`, `language_id`, `date_modified`) VALUES
                       ($i, 1, 'Test', ".$language['language_id'].", '2014-02-09')");

                                 $db->query("INSERT INTO `" . DB_PREFIX . "koschtit_gallery_description` (`id`, `language_id`, `ki_comm_auto_string`, `ki_nav_next`, `ki_nav_back`, `ki_nav_maxi`, `ki_nav_kiv_next`, `ki_nav_kiv_back`, `ki_nav_kiv_close`, `ki_nav_gps_coord`, `ki_nav_kiv_vcomm`, `ki_nav_kiv_download`, `ki_slideshow_start`, `ki_slideshow_stop`, `ki_help_text`, `ki_vcomm_lac`, `ki_vcomm_name`, `ki_vcomm_comm`, `ki_vcomm_post`, `ki_vcomm_clk`, `ki_vcomm_ncy`) VALUES
                                 ($i, ".$language['language_id'].", 'KoschtIT Image Gallery - Picture %x of %X Filename: %f, Gallery: %g', 
                                 'Next page',
                                 'Previous page', 
                                 'Gallery to maxim size',
                                 'Next picture',
                                 'Previous picture', 
                                 'Close',
                                 'Show location on map', 
                                 'Add/See viewer comments', 
                                 'Download full resolution picture', 
                                 'Start slideshow', 
                                 'Stop slideshow',
                                 'Move your mouse [mouse] beyond the sides of the image to see what image comes next/was last in the gallery. If you move your mouse even further to the border of the window you can see the next/last couple of images. Move your mouse up to the top to view navigation controls and move it down to see a link address of the picture displayed.',
                                 'Leave a comment',
                                 'Name', 
                                 'Comment', 
                                 'Post',
                                 'Click on the image to flip back to the full image.', 
                                 'No comments yet.')");
                         $i++;
                       }

                       ?>


                       <div style="background:rgb(180,240,180);padding:10px;">Gallery Folder `test` add tables <em><?php echo DB_PREFIX;?>koschtit_gallery_folder</em> success!</div><br/>
                       <br/>
                       
                       <div style="background:rgb(180,240,180);padding:10px;">Gallery texts is added  to table <em><?php echo DB_PREFIX;?>koschtit_gallery_description</em>  success!</div><br/>


<?php
}

$next = '';
/* -------------------- Add Layout line/gallery -------------------------------------------- */

$layout_id = $db->query("SELECT MAX(layout_id) FROM " . DB_PREFIX ."layout");
$next = $layout_id->row["MAX(layout_id)"]+1;
   
$layout = $db->query("SELECT * FROM `".DB_PREFIX ."layout` WHERE name = 'Koschtit Gallery'");   
$test2 = $layout->row;

   if(!isset($test2['name'])){    ?>  
                          
                       <br>
                       <b>Add Layouts:</b><br>
                       
                       
                       
                       <?php                 
                       $db->query("INSERT INTO " . DB_PREFIX . "layout SET layout_id = '" . (int)$next . "', name = 'Koschtit Gallery'");
                       $db->query("INSERT INTO " . DB_PREFIX . "layout_route SET layout_id = '" . (int)$next . "', store_id = '0', route = 'line/gallery'");
                       
                       ?> 
                       
                       <div style="background:rgb(180,240,180);padding:10px;">Layout <em>line/gallery</em> is added success!</div><br/>
 <?php } 
 
 
$exten = $db->query("SELECT * FROM `".DB_PREFIX ."extension` WHERE code = 'koschtit_gallery'");   
$test3 = $exten->row;
  if(!isset($test3['code'])){  
                       ?>  
                       <br>
                       <b>Add to Extension:</b><br>
                       
                       
                       
                       <?php                    
                                           $db->query("INSERT INTO " . DB_PREFIX . "extension SET type = 'module', code = 'koschtit_gallery'");
                       
                       ?> 
                       
                       <div style="background:rgb(180,240,180);padding:10px;">Extension <em>koschtit_gallery_module</em> is added success!</div><br/>
                       <?php 
}

 
$extena = $db->query("SELECT * FROM `".DB_PREFIX ."extension` WHERE code = 'koschtitgallery_folder'");   
$test4 = $extena->row;
  if(!isset($test4['code'])){  
                       ?>  
                       <br>
                       <b>Add to Extension:</b><br>
                       
                       
                       
                       <?php                    
                                           $db->query("INSERT INTO " . DB_PREFIX . "extension SET type = 'module', code = 'koschtitgallery_folder'");
                       
                       ?> 
                       
                       <div style="background:rgb(180,240,180);padding:10px;">Extension <em>koschtitgallery_folder_module</em> is added success!</div><br/>
                       <?php 
}

$extenz = $db->query("SELECT * FROM `".DB_PREFIX ."setting` WHERE `key` = 'kigallery_module'");   
$test5 = $extenz->row;

  if(!isset($test5['key'])){  
                       ?>  
                       <br>
                       <b>Add to Setting:</b><br>
                       
                       <?php     
                       
                       $query = $db->query("SELECT * FROM `".DB_PREFIX ."layout_route` WHERE `route` = 'line/gallery'"); 
                       $next_layout = $query->row['layout_id'];
                       
                                 $db->query("INSERT INTO " . DB_PREFIX . "setting SET `store_id`=0,
                                                                                                                   `group` = 'kigallery', 
                                                                                                                   `key` = 'kigallery_module',
                                                                                                                   `value`= '".$db->escape('a:1:{i:0;a:92:{s:10:"sort_order";s:1:"1";s:9:"layout_id";s:2:"'.$next_layout.'";s:8:"position";s:11:"content_top";s:6:"status";s:1:"1";s:13:"ki_admin_mail";s:1:"0";s:18:"ki_admin_mail_from";s:15:"admin@localhost";s:16:"ki_admin_mail_to";s:15:"admin@localhost";s:9:"ki_config";s:10:"ki_config/";s:11:"ki_template";s:26:"catalog/view/theme/default";s:12:"ki_galleries";s:13:"pm_galleries/";s:7:"ki_base";s:8:"pm_base/";s:11:"ki_fr_width";s:3:"770";s:12:"ki_fr_height";s:3:"300";s:11:"ki_fr_color";s:7:"#ffffff";s:13:"ki_permission";s:1:"1";s:12:"ki_img_order";s:6:"manual";s:10:"ki_mixname";s:1:"0";s:9:"ki_thumbs";s:2:"14";s:14:"ki_th_per_line";s:1:"7";s:11:"ki_th_lines";s:4:"auto";s:11:"ki_th_width";s:4:"auto";s:12:"ki_th_height";s:4:"auto";s:15:"ki_th_bord_size";s:1:"5";s:17:"ki_th_margin_left";s:2:"10";s:16:"ki_th_margin_top";s:2:"10";s:16:"ki_th_bord_color";s:7:"#666666";s:22:"ki_th_bord_hover_color";s:7:"#bbbbbb";s:25:"ki_th_bord_hover_increase";s:3:"1.2";s:12:"ki_th_shadow";s:1:"1";s:12:"ki_th_radius";s:1:"1";s:17:"ki_th_bord_radius";s:2:"12";s:15:"ki_th_to_square";s:1:"1";s:19:"ki_th_2sq_crop_hori";s:6:"center";s:19:"ki_th_2sq_crop_vert";s:6:"middle";s:17:"ki_thumbs_to_disk";s:1:"1";s:14:"ki_resize_auto";s:1:"1";s:12:"ki_bord_size";s:2:"10";s:13:"ki_bord_color";s:7:"#666666";s:16:"ki_out_bord_size";s:2:"20";s:17:"ki_out_bord_color";s:7:"#808080";s:9:"ki_radius";s:1:"1";s:14:"ki_bord_radius";s:2:"15";s:18:"ki_maxim_pic_width";s:4:"2048";s:19:"ki_maxim_pic_height";s:4:"1536";s:16:"ki_max_pic_width";s:4:"none";s:17:"ki_max_pic_height";s:4:"0.75";s:19:"ki_oversize_allowed";s:1:"0";s:11:"ki_comments";s:1:"1";s:17:"ki_comm_text_size";s:2:"12";s:18:"ki_comm_text_color";s:7:"#000000";s:17:"ki_comm_text_font";s:18:"Tahoma, sans-serif";s:18:"ki_comm_text_align";s:4:"left";s:12:"ki_comm_auto";s:1:"0";s:12:"ki_read_meta";s:1:"0";s:17:"ki_viewercomments";s:1:"1";s:17:"ki_moderate_posts";s:1:"0";s:21:"ki_vcomm_header_color";s:7:"#000000";s:18:"ki_vcomm_box_color";s:7:"#000000";s:19:"ki_vcomm_text_color";s:7:"#000000";s:23:"ki_vcomm_timedate_color";s:7:"#888888";s:19:"ki_vcomm_back_color";s:4:"none";s:19:"ki_vcomm_bord_color";s:7:"#888888";s:12:"ki_slideshow";s:1:"1";s:15:"ki_downloadpics";s:1:"1";s:11:"ki_checkgps";s:1:"0";s:11:"ki_cellinfo";s:1:"0";s:11:"ki_show_nav";s:1:"1";s:13:"ki_nav_always";s:1:"0";s:10:"ki_nav_pos";s:5:"right";s:12:"ki_nav_color";s:7:"#ffffff";s:19:"ki_nav_border_color";s:7:"#000000";s:12:"ki_nav_style";s:1:"1";s:17:"ki_show_image_nav";s:1:"1";s:19:"ki_image_nav_always";s:1:"0";s:13:"ki_show_share";s:1:"1";s:12:"ki_show_help";s:1:"1";s:11:"ki_help_pos";s:4:"left";s:15:"ki_show_preview";s:1:"0";s:16:"ki_preview_style";s:1:"1";s:15:"ki_preview_pics";s:1:"6";s:16:"ki_show_explorer";s:1:"1";s:19:"ki_explorer_padding";s:2:"50";s:17:"ki_watermark_hori";s:6:"center";s:17:"ki_watermark_vert";s:6:"middle";s:17:"ki_watermark_size";s:3:"0.4";s:13:"ki_fade_color";s:7:"#000000";s:13:"ki_fade_alpha";s:1:"8";s:22:"ki_shade_while_loading";s:1:"0";s:20:"ki_disable_animation";s:1:"0";s:17:"ki_slideshow_time";s:4:"4000";s:16:"ki_show_warnings";s:1:"1";s:14:"ki_admin_limit";s:2:"24";}}')."',
                                                                                                                   `serialized`= 1");
                       
                       ?> 
                       
                       <div style="background:rgb(180,240,180);padding:10px;">Settings of Module <em>kigallery_module</em> is Istall success!</div><br/>
                       <?php 
}
?>

<?php
$extenx = $db->query("SELECT * FROM `".DB_PREFIX ."setting` WHERE `key` = 'koschtitgallery_folder_module'");   
$test6z = $extenx->row;

if(!isset($test6z['key'])){  
                       ?>  
                       <br>
                       <b>Add to Setting:</b><br>
                       <?php     
                       
                       $querys = $db->query("SELECT * FROM `".DB_PREFIX ."layout_route` WHERE `route` = 'line/gallery'"); 
                       $next_layout = $querys->row['layout_id'];
                       
                                 $db->query("INSERT INTO " . DB_PREFIX . "setting SET `store_id`=0,
                                                                                                                   `group` = 'koschtitgallery_folder', 
                                                                                                                   `key` = 'koschtitgallery_folder_module',
                                                                                                                   `value`= '" . $db->escape('a:1:{i:0;a:4:{s:9:"layout_id";s:2:"'.$next_layout.'";s:8:"position";s:11:"column_left";s:6:"status";s:1:"1";s:10:"sort_order";s:1:"1";}}') . "',
                                                                                                                   `serialized`= 1");
                       
                       ?> 
                       
                       <div style="background:rgb(180,240,180);padding:10px;">Settings of Module <em>koschtitgallery_folder_module</em> is Istall success!</div><br/>
                       <?php 
}
                       ?>
                       <h4>Add Full Permission for Adminastor Group to Koschtit Gallery:</h4>
                        <?php                      
                       $query = $db->query("SELECT * FROM `".DB_PREFIX ."user_group`");  
                       $results = $query->rows;
                       ?>
                       
                       <form action="install.php" method="post">
                       <table>
                       <tr>
                       <td>
                       Your Administrator Group: </td><td><select name="user_group_id">
                       
                                              <?php foreach($results as $result){ ?>
                                              <option value="<?php echo $result['user_group_id'];?>"/><?php echo $result['name'];?></option>
                                              <?php } ?>
                                              
                                              </select></td></tr>
                       <tr>
                       <td></td><td><br/>
                                              <input type="submit" name="administrator" value=" - Add - "/>
                                              </td></tr></table>
                       </form>
<?php
}

}
 
if(isset($_POST['user_group_id'])){
$user_group_id = $_POST['user_group_id'];

    editUserGroup($db,$user_group_id);
    ?>
   
<div style="background:rgb(180,240,180);padding:10px;">Permission for <em>koschtit_gallery_module</em> is added success!</div>
<br/>
<?php
}
?>
<a href="index.php">Your Store</a>
</div>
</body>
</html>
