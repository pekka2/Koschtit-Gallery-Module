<?php
@ob_start("ob_gzhandler");

$browser = $_SERVER['HTTP_USER_AGENT'];

if(preg_match("/Opera/",$browser))
	$browser = "opera"; 
elseif(preg_match("/MSIE [7-9]/",$browser))
	$browser = "ie7";
elseif(preg_match("/MSIE [1-6]/",$browser))
	$browser = "ie6";
elseif(preg_match("/AppleWebKit/",$browser))
	$browser = "webkit";
else
	$browser = "gecko";

include_once("../ki_config/ki_setup.php");
$reldir = "";
if(isset($_POST['reldir']))$reldir = $_POST['reldir'];
$confdir = $ki_config;
$galleriesdir = $ki_galleries;
$basedir = $ki_base;


if(isset($_POST['file']))
	$file = rawurldecode($_POST['file']);
else
	exit;

if(isset($_POST['gallery']))
	$gallery = $_POST['gallery'];
else
	exit;

if(isset($_POST['topic']))
	$topic = $_POST['topic'];
else
	exit;

// -------------- Sicherheitsabfragen!
if(preg_match("/[\.]*\//", $file))exit();
if(preg_match("/[\.]*\//", $gallery))exit();
if(!is_file("../".$ki_galleries.$gallery."/".$file))exit();
// ---------- Ende Sicherheitsabfragen!

if(is_file("../ki_config/".$gallery."_ki_setup.php"))include_once("../ki_config/".$gallery."_ki_setup.php");

$supported = array("jpg","png","gif");
$galleryfolder = "../".$ki_galleries.$gallery."/";
if(!is_dir($galleryfolder))exit();

$files = array();
/*
$temp = array();

if(is_file($gallery."_dir")){
	$temp = explode(PHP_EOL, file_get_contents($gallery."_dir"));
	$files = unserialize($temp[1]);		
} else {
	$iterator = new DirectoryIterator($galleryfolder);
	foreach ($iterator as $fileInfo) {
		$tfile = $fileInfo->getFilename();
		if(!in_array(strtolower(substr($tfile, -3)), $supported))$continue;
		$imgsize = @getimagesize($galleryfolder.$tfile);
		if($imgsize[0]){
			$files[] = array($tfile, $imgsize[0], $imgsize[1]);
		}
	}
	switch($ki_pic_order){
		case 0:
			usort($files, "cmp_1");
		break;
		case 1:
			usort($files, "cmp_0");
		break;
		case 2:
			usort($files, "cmp_3");
		break;
		case 3:
			usort($files, "cmp_2");
		break;
		default:
			usort($files, "cmp_1");
		break;
	}
	reset($files);
}
*/

if(!isset($ki_img_order)){
                       $ki_img_order = "new";
}

  
          $xfe = explode("/",$gallery);
          $db_folder = $xfe[0];              
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
foreach ($results as $pic) {
                       $files[] = array($pic['mixname'],$pic['width'],$pic['height']);
}

$id = -1;
foreach ($results as $picfile) {
	$id++;
	if($picfile['mixname'] == $file){
		break;
	}
}

$gesbreite = 0;
if($topic == 1){
	$id++;
	for($i = 0; $i < $ki_preview_pics; $i++){
		if($id + $i >= count($files))break;
		$srcfile = $basedir."ki_makepic.php?file=".$gallery."/".rawurlencode($files[$id+$i][0]);
		$y = 100;
		$x = floor($files[$id+$i][1]/$files[$id+$i][2]*100);
		$gesbreite += $x + 4;
		echo "<img src='".$srcfile."' style='width:".$x."px; height:".$y."px;' onclick=\"kiv.getImage(-1, ".($id+$i).")\" onload=\"this.style.visibility='visible'\" class='ki_thumbnail_preview_left'/>";	

	}
} else {
	$id--;
	for($i = 0; $i < $ki_preview_pics; $i++){
		if($id - $i < 0)break;
		$srcfile = $basedir."ki_makepic.php?file=".$gallery."/".rawurlencode($files[$id-$i][0]);
		$y = 100;
		$x = floor($files[$id-$i][1]/$files[$id-$i][2]*100);
		$gesbreite += $x + 4;
		echo "<img src='".$srcfile."' style='width:".$x."px; height:".$y."px;' onclick=\"kiv.getImage(-1, ".($id-$i).")\" onload=\"this.style.visibility='visible'\" class='ki_thumbnail_preview_right'/>";	
	}
}

echo "<input id='gesbreite' type='hidden' value='".($gesbreite)."' />";
?>

