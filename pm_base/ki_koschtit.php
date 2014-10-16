<?php
@ob_start("ob_gzhandler");
if(!ini_get('date.timezone') && function_exists("date_default_timezone_set"))date_default_timezone_set('Europe/Berlin');

include_once("../ki_config/ki_setup.php");
$supported = array("jpg","png","gif");

$reldir = "";
if(isset($_POST['reldir']))$reldir = $_POST['reldir'];
$confdir = $ki_config;
$galleriesdir = $ki_galleries;
$basedir = $ki_base;

if(isset($_POST['gallery']))
	$gallery = $_POST['gallery'];
else
	exit();
	
if(isset($_POST['gallerynumber']))
	$gallerynumber = $_POST['gallerynumber'];
else
	exit();
	
if(isset($_POST['startfrom']))
	$startfrom = $_POST['startfrom'];
else
	$startfrom = 0;
	
if(isset($_POST['collectinfo']))
	$collectinfo = 1;
else
	$collectinfo = 0;
	
// -------------- Sicherheitsabfragen!
if(preg_match("/[\.]*\//", $gallery))exit();
// ---------- Ende Sicherheitsabfragen!
	
if(is_file("../ki_config/".$gallery."_ki_setup.php")){
	include_once("../ki_config/".$gallery."_ki_setup.php");
	$configfile = "../ki_config/".$gallery."_ki_setup.php";
} else {
	$configfile = "../ki_config/ki_setup.php";
}

$galleryfolder = '../'.$ki_galleries.$gallery."/";
$thumbsfolder = $galleryfolder."thumbs/";

$temp = getimagesize("ki_nav_next.png");
if($ki_nav_always == 1 && $ki_show_nav == 1)$ki_fr_height -= ($temp[1]+18);
if($ki_th_lines == "auto")$ki_th_lines = ceil($ki_thumbs/($ki_th_per_line));
if($ki_th_width == "auto")$ki_th_width = round($ki_fr_width/($ki_th_per_line)) - round($ki_fr_height*0.04) - 4;
if($ki_th_height == "auto")$ki_th_height = round($ki_fr_height/($ki_th_lines)) - round($ki_fr_height*0.04) - 4;

$ki_th_width = $ki_th_width - 2*$ki_th_bord_size;
$ki_th_height = $ki_th_height - 2*$ki_th_bord_size; 
if(($ki_th_lines*$ki_th_per_line) < $ki_thumbs)$ki_thumbs = $ki_th_lines*$ki_th_per_line;

$zeile = 1;
$spalte = 0;

$spaltenbreite = $ki_fr_width/($ki_th_per_line);
$zeilenhoehe = $ki_fr_height/($ki_th_lines);
/*------------------- error/warning checking ------------------*/
if($collectinfo == 1){

	if (!function_exists('imagecreatetruecolor')) {
		echo "<div style='background:#ffbbbb; color:#000000; margin-bottom:5px; position:relative; z-index:10; padding:4px;'>ERROR: KoschtIT Image Gallery can't find the PHP GD2 Library available. Please make sure you have removed the semicolon from this line ';extension=php_gd2.dll' in your php.ini and the library is correctly installed.</div>";
	}
	if(!is_dir($galleryfolder)) {
		echo "<div style='background:#ffbbbb; color:#000000; margin-bottom:5px; position:relative; z-index:10; padding:4px;'>ERROR: KoschtIT Image Gallery can't find the following folder on the server: '".htmlentities($gallery)."' . Please check if the folder is available in the 'ki_galleries' folder.</div>";
		echo "<input type='hidden' id='".$gallerynumber."_info' value='[ ]' />";
		exit();
	}
	if($ki_checkgps == 1){
		if(!function_exists("exif_read_data")){
			if($ki_show_warnings == 1)echo "<div style='background:#bbbbff; color:#000000; margin-bottom:5px; position:relative; z-index:10; padding:4px;'>WARNING: You don't have the exif extension for PHP installed. The script won't be able to read any positioning metadata from your pictures. Please disable '\$ki_checkgps' for fixing this issue. Set '\$ki_show_warnings = 0' if you don't want to see this warning again.</div>";
		}
	}
	if($ki_checkgps == 1 && $ki_cellinfo == 1){
		if(!function_exists("curl_init")){
			if($ki_show_warnings == 1)echo "<div style='background:#bbbbff; color:#000000; margin-bottom:5px; position:relative; z-index:10; padding:4px;'>WARNING: You don't have the curl extension for PHP installed. You will need this extension for retrieving geo-tagging information from opencellid.com . Please disable '\$ki_cellinfo' for fixing this issue. Set '\$ki_show_warnings = 0' if you don't want to see this warning again.</div>";
		}
	}
	if($ki_thumbs_to_disk == 1){
		$error = 0;
		if(!is_dir($thumbsfolder)){
                                                                     $mask = umask(0);
                                                                     if($ki_permission == 1){
                                                                     
                                                                                            @mkdir($thumbsfolder, 0777);
                                                                     }
                                                                     elseif($ki_permission == 2){
                                                                     
                                                                                            @mkdir($thumbsfolder, 0775);
                                                                     }
                                                                      else{
                                                                                            @mkdir($thumbsfolder, 0755);
                                                                     }
                                                                     umask($mask);
		} else {
			if(!is_writable($thumbsfolder)){
				$error = 1;
			}
		}
		if($error == 1 && $ki_show_warnings == 1)echo "<div style='background:#bbbbff; color:#000000; margin-bottom:5px; position:relative; z-index:10; padding:4px;'>WARNING: KoschtIT Image Gallery can't get writing permission on the server (\"ki_galleries\\".$gallery."\\thumbs\"-folder). Thumbs won't be saved. Please disable '\$ki_thumbs_to_disk' or grant writing permission. Set '\$ki_show_warnings = 0' if you don't want to see this warning again.</div>";
	}
}
/*------------------- end error/warning checking ------------------*/
$files = array();
$temp = array();

          $xfe = explode("/",$gallery);
          $db_folder = $xfe[0];
          
//$folderhash = $ki_pic_order;
$iterator = new DirectoryIterator($galleryfolder);

 function td_get_exif($image) {
                    $filename = $image['FILE']['FileName']; 
                    $exif = $image; 
                    if (is_array($exif) && isset($exif['EXIF'])) {
                    $data = array_merge($exif['IFD0'], $exif['EXIF']);
                    
                    $data2 = array_merge($exif['FILE'],$data);
                    foreach ($data as $key => $value) {
                              if (is_string($value)) {
                              // there are sometimes unicode characters that cause problems with serialize
                              $data2[$key] = preg_replace( '/[^[:print:]]/', '', $value);
                              }
                    }
                    return serialize($data2);
                    }
          }
                          $folderSearch = $ki_db->query("SELECT * FROM " . $db_prefix . "koschtit_gallery_folder WHERE name='".$db_folder."'");
                          $folder_id = $folderSearch->row['folder_id'];
                          
    $exifdata = "";
foreach ($iterator as $fileInfo) {
          
   if(is_file($galleryfolder.$fileInfo)){
                          $fileSearch = $ki_db->query("SELECT * FROM " . $db_prefix . "koschtit_gallery_image WHERE folder_id='".$folder_id."' AND mixname='".$fileInfo."'");
                          if(!isset($fileSearch->row['mixname'])){
                                                 
                                                 $filesize = filesize($galleryfolder.$fileInfo);
                                                 $size = getImagesize($galleryfolder.$fileInfo);
                                                  if(function_exists("exif_read_data")){        
                                                                                     $exif = @exif_read_data($galleryfolder.$fileInfo,'IFD0,EXIF', true);

                                                                                      $exifdata = td_get_exif($exif); 
                                                           }
                                                    $ki_db->query("INSERT INTO " . $db_prefix . "koschtit_gallery_image SET
                                                                                                  folder_id = '".$folder_id."',
                                                                                                  filename='".$fileInfo."',
                                                                                                  mixname='".$fileInfo."',
                                                                                                  width='".$size[0]."',
                                                                                                  height='".$size[1]."',
                                                                                                  filesize='".$filesize."',
                                                                                                  exif_data = '" . $ki_db->escape($exifdata) ."',
                                                                                                  date_added = '".time()."'");      
                                                                                                  
                              $ki_db->query("UPDATE  " . $db_prefix . "koschtit_gallery_folder SET
                      	                                                           files = files+1,
                                                                                   size = size+" . $filesize ."  WHERE folder_id='" . $folder_id ."'"); 
                                   }
                                                 
           }
}

          
if(!isset($ki_img_order)){
                       $ki_img_order = "new";
}

if(!isset($ki_th_margin_left)) $ki_th_margin_left = 10;
if(!isset($ki_th_margin_top)) $ki_th_margin_top = 10;


 $sql = "SELECT * FROM ".$db_prefix ."koschtit_gallery_folder kgf LEFT JOIN ". $db_prefix ."koschtit_gallery_image kgi ON (kgf.folder_id = kgi.folder_id) WHERE kgf.name = '".$db_folder."'";

                    $test = $ki_db->query($sql);
                   if($ki_img_order == 'manual'){
                                          if(isset($test->row['sort_order'])){
                                                                 $sql .= " ORDER BY kgi.sort_order ASC";
                                          } else{
                                                                 $ki_img_order == 'new';
                                          }
                                                                 
                   }
                                          if($ki_img_order == 'old'){
                                                                 $sql .= " ORDER BY kgi.date_added ASC";
                                          }
                                          if($ki_img_order == 'new'){
                                                                 $sql .= " ORDER BY kgi.date_added DESC";
                                          }
                                          if($ki_img_order == 'size'){
                                                                 $sql .= " ORDER BY kgi.filesize DESC";
                                          }
                                          if($ki_img_order == 'name'){
                                                                 $sql .= " ORDER BY kgi.filename ASC";
                                          }
                    $quer = $ki_db->query($sql);

                       $results = $quer->rows;

if(count($results) > 0){
foreach ($results as $file) {
                       $files[] = array($file['mixname'],$file['width'],$file['height']);
                       
}
}
if($collectinfo == 1){
	$id = 0;
	$fileinfo = "";
	foreach ($results as $file) {
		if($id != 0)$fileinfo .= ", ";
		$id++;
		$fileinfo .=  "{ \"file\" : \"".$file['mixname']."\", \"x\" : ".$file['width'].", \"y\" : ".$file['height']." }";
	}
                echo "<input id='".$gallerynumber."_info' type='hidden' value='[ ".$fileinfo." ]' />";
}
$id = 0;	
if(count($results) > 0){
foreach ($results as $file) {
	$id++;
        
	if($id > $startfrom) {
	
		$spalte++;
		if($spalte == $ki_th_per_line+1){
			$zeile++;
			$spalte = 1;
		}
		
		$breite = $file['width'];
		$hoehe = $file['height'];
                       if($breite !=''){
		if( ($breite / $hoehe) > 1){
			$k = $hoehe / $breite;
			$breite = $ki_th_width;
			$hoehe = $k*$breite;
			if($hoehe > $ki_th_height){
				$hoehe = $ki_th_height;
				$breite = (1/$k) * $hoehe;
			}
		} else {
			$k = $breite / $hoehe;
			$hoehe = $ki_th_height;
			$breite = $k*$hoehe;
			if($breite > $ki_th_width){
				$breite = $ki_th_width;
				$hoehe = (1/$k) * $breite;
			}
		}
		
		if($ki_th_to_square == 1) {
			if($ki_th_width < $ki_th_height){
				$breite = $ki_th_width;
			} else {
				$breite = $ki_th_height;
			}
			$hoehe = $breite;
		}
                                              					
		$x_pos = round($spaltenbreite*($spalte - 0.5) - 0.5*$breite) - $ki_th_bord_size;
		$y_pos = round($zeilenhoehe*($zeile - 0.5) - 0.5*$hoehe) - $ki_th_bord_size;
		
		$breite = round($breite);
		$hoehe = round($hoehe);
		
		if($ki_th_bord_hover_increase > 1){
			$inc_breite = round($breite*$ki_th_bord_hover_increase);
			$inc_hoehe = round($breite*$ki_th_bord_hover_increase);
		} else {           
			$inc_breite = $breite;
			$inc_hoehe = $hoehe;	
		} 
 if(!isset($thumb_style)){   ?>     
 <style type="text/css">
 <?php include('../'.$ki_template.'/stylesheet/koschtit_gallery_thumb.css');?>
</style>
<?php
$thumb_style = 1;
}


                    $quer = $ki_db->query("SELECT * FROM ".$db_prefix ."koschtit_gallery_folder WHERE name = '".$db_folder."'");
                    $mixthumb = $quer->row['mixthumb'];

		if($zeile <= $ki_th_lines && ($id-$startfrom) <= $ki_thumbs)
		{
			$src = $basedir."ki_makepic.php?file=".$gallery."/".rawurlencode($file['mixname'])."&width=".$inc_breite."&height=".$inc_hoehe; //img style  parsed: visibility:hidden; 


			if($ki_thumbs_to_disk == 1){
				if(!is_file($thumbsfolder.$mixthumb.$file['mixname'])){
					$src .= "&picname=".$mixthumb.rawurlencode($file['mixname']);
				} else {
					$src = $galleriesdir.$gallery."/thumbs/".$mixthumb.$file['mixname'];
				}
			} 
                                                             

 echo "<img id='".$gallerynumber."_".($id-1)."' src='".$src."' onclick='kib.getImage(this.id)' onload=\"this.style.visibility='visible'\"  alt='".$breite."_".$hoehe."_".$x_pos."_".$y_pos."' class='ki_thumbnail' style='left:".$x_pos."px;top:".$y_pos."px;'/>";

		}
          }
    }
  }
}
if(($id-$startfrom) > $ki_thumbs)echo "<span id='".$gallerynumber."_next' style='display:none;'>".($startfrom+$ki_thumbs)."</span>";
if($startfrom != 0)echo "<span id='".$gallerynumber."_prev' style='display:none;'>".($startfrom-$ki_thumbs)."</span>";

?>
