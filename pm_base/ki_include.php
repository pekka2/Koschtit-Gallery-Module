<?php
function draw_image($filename, $id, $style, $params) {
	global $browser, $basedir;
	$idstring = "";
	if($id != "")$idstring = "id='".$id."' ";
	if($browser == "ie6") {
		$imgsize = getimagesize($filename);
		echo "<img ".$idstring."style='filter:progid:DXImageTransform.Microsoft.AlphaImageLoader(src=".$basedir.$filename."); width:".$imgsize[0]."px; height:".$imgsize[1]."px; ".$style."' src='".$basedir."ki_noimage.gif' ".$params." />";
	} else {
		if($style != "")$style = " style='".$style."' ";
		echo "<img ".$idstring."src='".$basedir.$filename."'".$style.$params." />";
	}
}

function addEvent($el, $event, $function){
	global $browser;
	if($browser == "ie6" || $browser == "ie7"){
		echo $el.".attachEvent('on".$event."', ".$function.");\n";
	} else {
		echo $el.".addEventListener('".$event."', ".$function.", false);\n";
	}
}

function removeEvent($el, $event, $function){
	global $browser;
	if($browser == "ie6" || $browser == "ie7"){
		echo $el.".detachEvent('on".$event."', ".$function.");\n";
	} else {
		echo $el.".removeEventListener('".$event."', ".$function.", false);\n";
	}
}
$reldir = $_SERVER['PHP_SELF'];
$basedir = $_SERVER['SCRIPT_FILENAME'];
$confdir = __FILE__;

$reldir = explode("/", dirname(trim(str_replace("\\", "/", $reldir), "/")));
$basedir = explode("/", dirname(trim(str_replace("\\", "/", $basedir), "/")));
$confdir = explode("/", dirname(trim(str_replace("\\", "/", $confdir), "/")));

$reldirsize = count($reldir);
$basedirsize = count($basedir);
$confdirsize = count($confdir);

$foundat = -1;
$reldir = "";

for($i = $basedirsize - 1; $i >= $basedirsize - $reldirsize - 1 && $i >= 0; $i--){
	for($j = $confdirsize - 1; $j >= 0; $j--){
		if($basedir[$i] === $confdir[$j]){
			$foundat = $j;
			break;
		}
	}
	if($foundat != -1)
		break;
	else
		$reldir .= "../";
}

if($foundat != -1){
	for($i = $foundat + 1; $i < $confdirsize; $i++){
		$reldir .= $confdir[$i]."/";
	}
} else {

// Enter the relative path here, if the script asks you to. Example: $reldir = "../script/";
$reldir = "";
// ----------------------------------------------------------------------------------------

}

if (!function_exists('file_put_contents')) {
    function file_put_contents($filename, $data) {
        $f = @fopen($filename, 'w');
        if (!$f) {
            return false;
        } else {
            $bytes = fwrite($f, $data);
            fclose($f);
            return $bytes;
        }
    }
}

$browser = $_SERVER['HTTP_USER_AGENT'];

if(preg_match("/Opera/",$browser))
	$browser = "opera"; 
elseif(preg_match("/MSIE (9|10|11)/",$browser))
	$browser = "ie9";
elseif(preg_match("/MSIE [7-8]/",$browser))
	$browser = "ie7";
elseif(preg_match("/MSIE [1-6]/",$browser))
	$browser = "ie6";
elseif(preg_match("/AppleWebKit/",$browser))
	$browser = "webkit";
else
	$browser = "gecko";
$confdir = $ki_config; // Module SETTINGS
$galleriesdir = $ki_galleries; // GALLERY DIR
$basedir = $ki_base; // BASE DIR

if(!is_file($basedir."ki_js_view.php")){
?>
<script type="text/javascript">
alert("ERROR: KoschtIT Image Gallery couldn't find the path to the script folder. Please enter the relative path from '<?php echo $_SERVER['PHP_SELF'] ?>' to the folder where the 'ki_config' folder is, into the 'ki_include.php' on line 37.");
</script>
<?php
} else { 
	$def_ki_fr_width = 948;
	$def_ki_fr_height = 300;
	$def_ki_fr_color = "#666666";
	$def_ki_thumbs = 14;
	$def_ki_th_per_line = 7;
	$def_ki_th_lines = "auto";
	$def_ki_th_width = "auto";
	$def_ki_th_height = "auto";
	$def_ki_th_bord_size = 5;
	$def_ki_th_bord_color = "#ffffff";
	$def_ki_th_bord_hover_color = "#bbbbbb";
	$def_ki_th_bord_hover_increase = 1.2;
	$def_ki_th_shadow = 1;
	$def_ki_th_to_square = 1;
	$def_ki_th_2sq_crop_hori = "center";
	$def_ki_th_2sq_crop_vert = "middle";
	$def_ki_thumbs_to_disk = 1;
	$def_ki_pic_order = 2;
	$def_ki_resize_auto = 1;
	$def_ki_bord_size = 10;
	$def_ki_bord_color = "#ffffff";
	$def_ki_max_pic_width = "none";
	$def_ki_max_pic_height = 0.75;
	$def_ki_oversize_allowed = 0;
	$def_ki_comments = 1;
	$def_ki_comm_text_size = 12;
	$def_ki_comm_text_color = "#000000";
	$def_ki_comm_text_font = "Tahoma, sans-serif";
	$def_ki_comm_text_align = "left";
	$def_ki_comm_auto = 0;
	$def_ki_comm_auto_string = "KoschtIT Image Gallery - Picture %x of %X Filename: %f, Gallery: %g";
	$def_ki_read_meta = 0;	
	$def_ki_viewercomments = 1;
	$def_ki_moderate_posts = 0;
	$def_ki_vcomm_header_color = "#000000";
	$def_ki_vcomm_box_color = "#000000";
	$def_ki_vcomm_text_color = "#000000";
	$def_ki_vcomm_timedate_color = "#888888";
	$def_ki_vcomm_back_color = "none";
	$def_ki_vcomm_bord_color = "#888888";
	$def_ki_slideshow = 1;
	$def_ki_downloadpics = 1;
	$def_ki_checkgps = 1;
	$def_ki_cellinfo = 0;
	$def_ki_show_nav = 1;
	$def_ki_nav_always = 0;
	$def_ki_nav_pos = "right";
	$def_ki_nav_color = "#ffffff";
	$def_ki_nav_border_color = "#000000";
	$def_ki_nav_style = 1;
	$def_ki_show_image_nav = 1;
	$def_ki_image_nav_always = 0;
	$def_ki_show_share = 1;
	$def_ki_show_help = 1;
	$def_ki_help_pos = "left";
	$def_ki_show_preview = 1;
	$def_ki_preview_style = 1;
	$def_ki_preview_pics = 6;
	$def_ki_show_explorer = 1;
	$def_ki_explorer_padding = 50;
	$def_ki_watermark_hori = "right";
	$def_ki_watermark_vert = "bottom";
	$def_ki_watermark_size = 0;
	$def_ki_fade_color = "#000000";
	$def_ki_fade_alpha = 8;
	$def_ki_shade_while_loading = 0;
	$def_ki_disable_animation = 0;
	$def_ki_slideshow_time = 4000;
	$def_ki_nav_next = "Next page";
	$def_ki_nav_back = "Previous page";
	$def_ki_nav_maxi = "Maximize gallery";
	$def_ki_nav_kiv_next = "Next picture";
	$def_ki_nav_kiv_back = "Previous picture";
	$def_ki_nav_kiv_close = "Close";
	$def_ki_nav_gps_coord = "Show location on map";
	$def_ki_nav_kiv_vcomm = "Add/See viewer comments";
	$def_ki_nav_kiv_download = "Download full resolution picture";
	$def_ki_slideshow_start = "Start slideshow";
	$def_ki_slideshow_stop = "Stop slideshow";
	$def_ki_help_text = "Move your mouse [mouse] beyond the sides of the image to see what image comes next/was last in the gallery. If you move your mouse even further to the border of the window you can see the next/last couple of images. Move your mouse up to the top to view navigation controls and move it down to see a link address of the picture displayed.";
	$def_ki_vcomm_lac = "Leave a comment";
	$def_ki_vcomm_name = "Name";
	$def_ki_vcomm_comm = "Comment";
	$def_ki_vcomm_post = "Post comment";
	$def_ki_vcomm_clk = "Click on the image to flip back to the full image.";
	$def_ki_vcomm_ncy = "No comments yet.";
	$def_ki_admin_mail = 0;
	$def_ki_admin_mail_from = "admin@localhost";
	$def_ki_admin_mail_to = "admin@localhost";
	$def_ki_show_warnings = 1;
	$def_ki_user = "user";
	$def_ki_userpw = "5f4dcc3b5aa765d61d8327deb882cf99";
	$def_ki_admin = "admin";
	$def_ki_pw = "5f4dcc3b5aa765d61d8327deb882cf99";

	$global_start = -1;
	$global_length = -1;
	$global_count = -1;
	
	reset($GLOBALS);
	while (list($key, $val) = each($GLOBALS)) {
		$global_count++;
		if($global_start == -1){
			if($key === "def_ki_fr_width"){
				$global_start = $global_count;
				continue;
			}
		}
		if($global_length == -1){
			if($key === "global_start"){
				$global_length = $global_count - $global_start;
				break;
			}
		}
	}

	if(!is_file($confdir."ki_setup.php")){
?>
<script type="text/javascript">
alert("ERROR: KoschtIT Image Gallery couldn't find the main config file 'ki_setup.php' in the 'ki_config' folder. A new 'ki_setup.php'-file with the default parameters has been created. Please change your username and password.");
</script>
<?php
	} 
	
	$switchtodefaults = 0;
	$params = "";
	reset($GLOBALS);
	for($i = 0; $i < $global_start; $i++)next($GLOBALS);
	for($i = 0; $i < $global_length; $i++){
		list($key, $val) = each($GLOBALS);
		$param = substr($key, 4);
		if(!isset($GLOBALS[$param])){
			$switchtodefaults = 1;
			if(!is_numeric($val))$val = "\"".addslashes($val)."\"";
			$params .= "\$$param = $val;\r\n";
		} else {
			$val = $GLOBALS[$param];
			if($param === "pw"){
				if(strlen($val) != 32){
					$switchtodefaults = 1;
					$val = md5($val);
				}
			}
			if(!is_numeric($val))$val = "\"".addslashes($val)."\"";			
			$params .= "\$$param = $val;\r\n";
		}
	}
	
	if($switchtodefaults == 1){
		$params = "<?php\r\n".$params."?>";
	}
	
	$access = "?reldir=".$reldir;

?>
<script type="text/javascript" src="<?php echo $basedir ?>ki_js_framework.php<?php echo $access ?>"></script>
<?php
if(isset($_GET['kit_code']))
	$kitcode = $_GET['kit_code'];
else
	$kitcode = "";

	if($kitcode !== ""){
?>
<script type="text/javascript">
	function kit_opensharedpic(){
		kib.getImage("<?php echo $kitcode ?>");		
	}
</script>
<?php 
	}
} 

