<?php
class ModelLineKiGallery extends Model {
      public function addKoschtitGallery($data) {
                                    $rows = $data['kigallery_description'];
                                    $language = array_keys($rows);
                         for($i=0;$i<count($language);$i++){
		$this->db->query("INSERT INTO " . DB_PREFIX . "koschtit_gallery_description SET
                                    language_id = '" . (int)$language[$i] . "',
                                    ki_comm_auto_string =  '" . $this->db->escape($rows[$language[$i]]['ki_comm_auto_string']) ."',
                                    ki_nav_next = '" . $this->db->escape($rows[$language[$i]]['ki_nav_next']) ."',
                                    ki_nav_back = '" . $this->db->escape($rows[$language[$i]]['ki_nav_back']) ."',
                                    ki_nav_maxi = '" . $this->db->escape($rows[$language[$i]]['ki_nav_maxi']) ."',
                                    ki_nav_kiv_next = '" . $this->db->escape($rows[$language[$i]]['ki_nav_kiv_next']) ."',
                                    ki_nav_kiv_back = '" . $this->db->escape($rows[$language[$i]]['ki_nav_kiv_back']) ."',
                                    ki_nav_kiv_close = '" . $this->db->escape($rows[$language[$i]]['ki_nav_kiv_back']) ."',
                                    ki_nav_gps_coord = '" . $this->db->escape($rows[$language[$i]]['ki_nav_gps_coord']) ."',
                                    ki_nav_kiv_vcomm = '" . $this->db->escape($rows[$language[$i]]['ki_nav_kiv_vcomm']) ."',
                                    ki_nav_kiv_download = '" . $this->db->escape($rows[$language[$i]]['ki_nav_kiv_download']) ."',
                                    ki_slideshow_start = '" . $this->db->escape($rows[$language[$i]]['ki_slideshow_start']) ."',
                                    ki_slideshow_stop = '" . $this->db->escape($rows[$language[$i]]['ki_slideshow_stop']) ."',
                                    ki_help_text = '" . $this->db->escape($rows[$language[$i]]['ki_help_text']) ."', 
                                    ki_vcomm_lac = '" . $this->db->escape($rows[$language[$i]]['ki_vcomm_lac']) ."',
                                    ki_vcomm_name = '" . $this->db->escape($rows[$language[$i]]['ki_vcomm_name']) ."',
                                    ki_vcomm_comm = '" . $this->db->escape($rows[$language[$i]]['ki_vcomm_comm']) ."',
                                    ki_vcomm_post = '" . $this->db->escape($rows[$language[$i]]['ki_vcomm_post']) ."',
                                    ki_vcomm_clk = '" . $this->db->escape($rows[$language[$i]]['ki_vcomm_clk']) ."',
                                    ki_vcomm_ncy = '" . $this->db->escape($rows[$language[$i]]['ki_vcomm_ncy']) ."'");
                          }
       
		$this->cache->delete('koschtit_gallery');
}
public function updateFiles($folder,$ki_gallery){
           if(is_dir($ki_gallery.$folder)){       
$iterator = new DirectoryIterator($ki_gallery.$folder);
              $folderSearch = $this->db->query("SELECT * FROM " . DB_PREFIX . "koschtit_gallery_folder WHERE name='".$folder."'");
                  $folder_id = $folderSearch->row['folder_id'];
                          
    $exifdata = "";
                       foreach ($iterator as $fileInfo) {
                                                 if(is_file($ki_gallery.$folder.'/'.$fileInfo)){
  
                                                                        $fileSearch = $this->db->query("SELECT * FROM " . DB_PREFIX . "koschtit_gallery_image WHERE folder_id='".$folder_id."' AND mixname='".$fileInfo."'");
                                                                                               if(!isset($fileSearch->row['mixname'])){
                                                                                               
                                                                                               $filesize = filesize($ki_gallery.$folder.'/'.$fileInfo);
                                                                                               $size = getImagesize($ki_gallery.$folder.'/'.$fileInfo);
                                                                                                if(function_exists("exif_read_data")){        
                                                                                                                                   $exif = @exif_read_data($ki_gallery.$folder.'/'.$fileInfo,'IFD0,EXIF', true);
                                              
                                                                                                                                    $exifdata = $this->td_get_exif($exif); 
                                                                                                         }
                                                                                                  $this->db->query("INSERT INTO " . DB_PREFIX . "koschtit_gallery_image SET
                                                                                                                                                folder_id = '".$folder_id."',
                                                                                                                                                filename='".$fileInfo."',
                                                                                                                                                mixname='".$fileInfo."',
                                                                                                                                                width='".$size[0]."',
                                                                                                                                                height='".$size[1]."',
                                                                                                                                                filesize='".$filesize."',
                                                                                                                                                exif_data = '" . $this->db->escape($exifdata) ."',
                                                                                                                                                date_added = '".time()."'");      
                                                                                                                                                
                                                                                                   $this->db->query("UPDATE  " . DB_PREFIX . "koschtit_gallery_folder SET
                                                                                                                                files = files+1,
                                                                                                                                 size = size+" . $filesize ."  WHERE folder_id='" . $folder_id ."'"); 
                                                                                 }
                                                                                               
                                                         }
                     }
   }
}
      public function editKoschtitGallery($data) {
		     
                        $this->db->query("TRUNCATE " . DB_PREFIX . "koschtit_gallery_description");
                        $rows = $data['kigallery_description'];
                        $language = array_keys($rows);
                         for($i=0;$i<count($language);$i++){
		$this->db->query("INSERT INTO " . DB_PREFIX . "koschtit_gallery_description SET
                                    language_id = '" . (int)$language[$i] . "',
                                    ki_comm_auto_string =  '" . $this->db->escape($rows[$language[$i]]['ki_comm_auto_string']) ."',
                                    ki_nav_next = '" . $this->db->escape($rows[$language[$i]]['ki_nav_next']) ."',
                                    ki_nav_back = '" . $this->db->escape($rows[$language[$i]]['ki_nav_back']) ."',
                                    ki_nav_maxi = '" . $this->db->escape($rows[$language[$i]]['ki_nav_maxi']) ."',
                                    ki_nav_kiv_next = '" . $this->db->escape($rows[$language[$i]]['ki_nav_kiv_next']) ."',
                                    ki_nav_kiv_back = '" . $this->db->escape($rows[$language[$i]]['ki_nav_kiv_back']) ."',
                                    ki_nav_kiv_close = '" . $this->db->escape($rows[$language[$i]]['ki_nav_kiv_close']) ."',
                                    ki_nav_gps_coord = '" . $this->db->escape($rows[$language[$i]]['ki_nav_gps_coord']) ."',
                                    ki_nav_kiv_vcomm = '" . $this->db->escape($rows[$language[$i]]['ki_nav_kiv_vcomm']) ."',
                                    ki_nav_kiv_download = '" . $this->db->escape($rows[$language[$i]]['ki_nav_kiv_download']) ."',
                                    ki_slideshow_start = '" . $this->db->escape($rows[$language[$i]]['ki_slideshow_start']) ."',
                                    ki_slideshow_stop = '" . $this->db->escape($rows[$language[$i]]['ki_slideshow_stop']) ."',
                                    ki_help_text = '" . $this->db->escape($rows[$language[$i]]['ki_help_text']) ."', 
                                    ki_vcomm_lac = '" . $this->db->escape($rows[$language[$i]]['ki_vcomm_lac']) ."',
                                    ki_vcomm_name = '" . $this->db->escape($rows[$language[$i]]['ki_vcomm_name']) ."',
                                    ki_vcomm_comm = '" . $this->db->escape($rows[$language[$i]]['ki_vcomm_comm']) ."',
                                    ki_vcomm_post = '" . $this->db->escape($rows[$language[$i]]['ki_vcomm_post']) ."',
                                    ki_vcomm_clk = '" . $this->db->escape($rows[$language[$i]]['ki_vcomm_clk']) ."',
                                    ki_vcomm_ncy = '" . $this->db->escape($rows[$language[$i]]['ki_vcomm_ncy']) ."'");

                                    }
                          
		$this->cache->delete('koschtit_gallery');
       }
        public function getKoschtitGallery($languages) {
                                    $key = array_keys($languages);
                                    $arr = array();
                                   
		$sql = "SELECT * FROM  " . DB_PREFIX . "koschtit_gallery_description";
							
		$query = $this->db->query($sql);
		
		$results = $query->rows;
                                    $i=0;
                                    foreach($results as $result){
                                      
                                                      $arr[$result['language_id']] = $results[$i];
                                                      $i++;
                          }
               
                  return $arr;
       }
        public function getComments($dir,$file){
                  $query = $this->db->query("SELECT * FROM " . DB_PREFIX . "koschtit_gallery_viewercomment WHERE folder_name='" . $dir. "' AND image_name='" . $file. "'");
                  $results = $query->rows;
                    return $results;
        }
      public function getComment($album,$file){
                $query = $this->db->query("SELECT * FROM " . DB_PREFIX . "koschtit_gallery_admin_comment WHERE folder_name='" . $album."' AND image_name = '".$file."'");
                $results = $query->rows;
                $content = array();
                foreach($results as $result){
                          $content[$result['language_id']] = array("id"=>$result['id'],
                                                                                      "comment"=>$result['comment']);
                    }
                  return $content;
      }
      public function addComment($data,$ki_gallery,$gallery,$file){
                                
                     $rows = $data['add_kigallery_comment'];
                                     $languages = array_keys($data['add_kigallery_comment']);
                                   for($i=0;$i<count($languages);$i++){
                                      $this->db->query("INSERT " .DB_PREFIX ."koschtit_gallery_admin_comment SET
                                      folder_name='".$this->db->escape($data['foldername'])."',
                                      image_name='".$this->db->escape($data['imagename'])."',
                                      comment='". $this->db->escape($rows[$languages[$i]]['comment'])."',
                                      language_id='".$languages[$i]."'");
                                    }
        }                  
       public function editComment($data){
                 $k = array_keys($data['edit_kigallery']);
                 for($i=0;$i<count($k);$i++){
                   if(trim($data['edit_kigallery'][$k[$i]]['id']) !=''){
                    $this->db->query("UPDATE " . DB_PREFIX . "koschtit_gallery_admin_comment SET
                    comment='" . $this->db->escape($data['edit_kigallery'][$k[$i]]['comment']) . "' WHERE  id='".$data['edit_kigallery'][$k[$i]]['id']."'");
                   } else{
                              $this->db->query("INSERT INTO " . DB_PREFIX . "koschtit_gallery_admin_comment SET 
                              folder_name='" . $data['foldername'] . "',
                              image_name='" . $data['imagename']."',
                              comment='" . $this->db->escape($data['edit_kigallery'][$k[$i]]['comment']) . "',
                              language_id='" . $k[$i]."'");
                    }
              }
   }                    
   public function editViewerComment($data){
                    $this->db->query("UPDATE " . DB_PREFIX . "koschtit_gallery_viewercomment SET name='".$this->db->escape($data['name'])."', comment='" . $this->db->escape($data['comment']) . "'
                    WHERE id='".$data['id']."'");
   }

   private function calcSize($dir){
	$size = 0;
	$num = 0;
	$iterator = new DirectoryIterator($dir);
	foreach ($iterator as $fileInfo){
		if($fileInfo->isDot()){
			continue;
		} else if($fileInfo->isDir()){
			$info = $this->calcSize($dir.$fileInfo->getBasename()."/");
			$size += $info[1];
		} else if($fileInfo->isFile()){
			$size += $fileInfo->getSize();
			$num += 1;
		}
	}
	return array($num, $size);
        }
       
    public function getFolders(){
               $query = $this->db->query("SELECT * FROM " . DB_PREFIX ."koschtit_gallery_folder ORDER BY sort_order ASC");
                      $results = $query->rows;
                      $rows = array();
                      $i=0;
                      foreach($results as $result){
                                $rows[$i] = $result['name'];
                                $i++;
                      }
                      return $rows;
}
    public function getKiSetup(){
                          $test = file('../ki_config/ki_setup.php');
                          
                          $dir_system = '';
                          $username = '';
                          $password = '';
                          $database = '';
                          $server = '';
                          $dbprefix = '';
                          
                         for($i=0;$i<8;$i++){
                              if(strpos($test[$i],'dir_system')){
                                                     $dir_system = $test[$i];
                              }
                              if(strpos($test[$i],'db_username')){
                                                     $username = $test[$i];
                              }
                              if(strpos($test[$i],'db_password')){
                                                     $password = $test[$i];
                              }
                              if(strpos($test[$i],'db_database')){
                                                     $database = $test[$i];
                              }
                              if(strpos($test[$i],'db_hostname')){
                                                     $server = $test[$i];
                              }
                              if(strpos($test[$i],'db_prefix')){
                                                     $dbprefix = $test[$i];
                              }
                            }
     
/*     
$dir_system = 'your system path';
$db_hostname = 'localhost';
$db_username = 'username';
$db_password = 'password';
$db_database = 'database';
$db_prefix = 'db prefix';
*/              
                        $ds = explode('\'',$dir_system);
                        $ds1 = explode('\'',$username);
                        $ds2 = explode('\'',$password);
                        $ds3 = explode('\'',$database);
                        $ds4 = explode('\'',$server);
                        $ds5 = explode('\'',$dbprefix);
                        
                        $dsystem = $ds[1];
                        $duser = $ds1[1];
                        $dpasswd = $ds2[1];
                        $dbase = $ds3[1];
                        $dserver = $ds4[1];
                        $dprefix = $ds5[1];
                       
                        
                        if($dsystem !=DIR_SYSTEM){
                                               return "ErrorSystem";
                        }
                        elseif($dserver !=DB_HOSTNAME){
                                               return "ErrorDbServer";
                        }
                        elseif($duser !=DB_USERNAME){
                                               return "ErrorUser";
                        }
                        elseif($dpasswd !=DB_PASSWORD){
                                               return "ErrorPasswd";
                        }
                        elseif($dbase !=DB_DATABASE){
                                               return "ErrorDatabase";
                        }
                        elseif($dprefix !=DB_PREFIX){
                                               return "ErrorDbPrefix";
                        }
                        
    }
    public function getDatabaseImage(){
                $query = $this->db->query("SELECT * FROM " . DB_PREFIX . "koschtit_gallery_folder kgf LEFT JOIN " . DB_PREFIX . "koschtit_gallery_image kgi 
              ON (kgf.folder_id = kgi.folder_id) ORDER BY id ASC");

                        $results = $query->rows;
              return $results;
          }
    public function getDatabaseImages($folder){
                $query = $this->db->query("SELECT * FROM " . DB_PREFIX . "koschtit_gallery_folder kgf LEFT JOIN " . DB_PREFIX . "koschtit_gallery_image kgi 
              ON (kgf.folder_id = kgi.folder_id) WHERE kgf.name = '".$folder."' ORDER BY id ASC");

                        $results = $query->rows;
              return $results;;
          }
          public function folderSizetoDatabase($data){
                    
                              $this->db->query("UPDATE  " . DB_PREFIX . "koschtit_gallery_folder SET
                                                                                         size = '".$data['file_sizes']."'  WHERE name='" . $data['folder_name'] ."'"); 
          }
          public function deleteViewerComment($data){
                             $this->db->query("DELETE FROM " . DB_PREFIX ."koschtit_gallery_viewercomment WHERE id = '".$data['id']."'");
          }
          public function deleteComment($data){
                             $this->db->query("DELETE FROM " . DB_PREFIX ."koschtit_gallery_admin_comment WHERE folder_name = '".$data['foldername']."' AND image_name='".$data['imagename']."'");
          }
          public function editFolder($data,$setting){
                    $info = $data['editfolder'];
                    $ki_galleries = $setting['ki_galleries'];
                    $ki_base = $setting['ki_base'];
                     $query = $this->db->query("SELECT * FROM " . DB_PREFIX ."koschtit_gallery_folder WHERE folder_id = '".$info['folder_id']."'");
                     $result = $query->row;
                     
                     $path = '../'.$ki_galleries;
                     
                     $path2 = '../'.$ki_galleries.$result['name'];
                     $error = false;
                     if(!is_dir( $path)){
                   
                                              $error = "404";
                                             return $error;
                       }
                     if(!is_dir( $path2)){
                                              $error = "404f";
                                             return $error;
                       }
                     if(!is_writable($path)){
                   
                                              $error = "403";
                                             return $error;
                       }

                     if(!is_writable($path2)){
                                              $error = "403f";
                                             return $error;
                       }
                  if($error == false){
                      rename( '../'.$ki_galleries.$result['name'] , '../'.$ki_galleries.$info['name']);
                      $this->db->query("UPDATE  " . DB_PREFIX . "koschtit_gallery_folder SET
                      	                                                           name = '". $this->db->escape($info['name']) ."',
                                                                                         sort_order= '" . $info['sort_order']. "',
                                                                                         status = '".$info['status'] ."' WHERE folder_id='" . $info['folder_id'] ."'"); 
                    $update = $data['updatefolder'];
                    $lang = array_keys($update);
                    
                      $this->db->query("DELETE FROM  " . DB_PREFIX . "koschtit_gallery_folder_description WHERE folder_id='" . $info['folder_id'] ."'"); 
                   for($i=0;$i<count($lang);$i++){
                      $this->db->query("INSERT INTO  " . DB_PREFIX . "koschtit_gallery_folder_description SET folder_id='" . $info['folder_id'] ."',
                      title='".$this->db->escape($update[$lang[$i]]['title'])."',language_id='".$lang[$i]."', date_modified=NOW()"); 
                 }
                      $this->db->query("UPDATE  " . DB_PREFIX . "koschtit_gallery_admin_comment SET folder_name='".$this->db->escape($info['name'])."' WHERE folder_name='" . $result['name'] ."'"); 
                      $this->db->query("UPDATE  " . DB_PREFIX . "koschtit_gallery_viewercomment SET folder_name='".$this->db->escape($info['name'])."' WHERE folder_name='" . $result['name'] ."'");  
                      }

          }
          public function changeImageFolder($data,$ki_gallery,$ki_base,$ki_permission){
                    if($data['change_folder'] !=$data['foldername']){
                                                   
                        $query=$this->db->query("SELECT * FROM " . DB_PREFIX ."koschtit_gallery_folder WHERE name='".$data['foldername']."'");
                        $mixthumb = $query->row['mixthumb'];
   
                        $image_path = '../'.$ki_gallery.$data['foldername'] .'/'. $data['imagename'];    
                        $thumb_path = '../'.$ki_gallery.$data['foldername'] .'/thumbs/'. $mixthumb.$data['imagename'];   
                        $copy_folder_path = '../'.$ki_gallery.$data['change_folder'].'/'. $data['imagename'];
                        
                        $query2=$this->db->query("SELECT * FROM " . DB_PREFIX ."koschtit_gallery_folder WHERE name='".$data['change_folder']."'");
                        $folder_id = $query2->row['folder_id'];
                        $mixthumb2 = $query2->row['mixthumb'];
                  
                        $copy_thumb_path = '../'.$ki_gallery.$data['change_folder'].'/thumbs/'. $mixthumb2.$data['imagename'];
                        
                        if(file_exists($image_path)){
                          @copy($image_path,$copy_folder_path);
                        $image_size = filesize($copy_folder_path);
                          } else{
                                                 return "Error";
                          } 
                                 
                        if(file_exists($thumb_path)){
                        $thumb_dir = '../'.$ki_gallery.$data['change_folder'] .'/thumbs/';   
                            if(!is_dir($thumb_dir)){
                                                      if($ki_permission == 1){
                                                              $mask = umask(0);
                                                           @mkdir($thumb_dir,0777);
                                                           umask($mask);
                                                           }
                                                       elseif($ki_permission == 2){
                                                              $mask = umask(0);
                                                             @mkdir($thumb_dir,0775);
                                                             umask($mask);
                                                           }else{
                                                              $mask = umask(0);
                                                             @mkdir($thumb_dir,0755);
                                                             umask($mask);
                                                           }
                                 } 
                     
                          @copy($thumb_path,$copy_thumb_path);
                          }
   
                          
                        $image_size = filesize($copy_folder_path);
                              
                        $query=$this->db->query("SELECT * FROM " . DB_PREFIX ."koschtit_gallery_image WHERE id='".$data['image_id']."'");
                        $result = $query->row;
                        $this->db->query("INSERT INTO  " . DB_PREFIX ."koschtit_gallery_image SET folder_id='".$folder_id."',
                                                                                                                                        filename='".$this->db->escape($result['filename'])."',
                                                                                                                                        mixname='".$result['mixname']."',
                                                                                                                                        width='".$result['width']."',
                                                                                                                                        height='".$result['height']."',
                                                                                                                                        filesize='".$result['filesize']."',
                                                                                                                                        exif_data='".$this->db->escape($result['exif_data'])."',
                                                                                                                                        date_added='".$result['date_added']."'");                                                                                                  
                       
                         $this->db->query("UPDATE  " . DB_PREFIX . "koschtit_gallery_folder SET
                      	                                                           files = files+1,
                                                                                         size = size+" . $image_size ."  WHERE folder_id='" . $folder_id ."'"); 

                              
                                $delete_data = array("ki_galleries"=>$ki_gallery,
                                                                "ki_base"=>$ki_base,
                                                                "album"=>$this->db->escape($data['foldername']),
                                                                "file"=>$this->db->escape($data['imagename']),
                                                                "thumb"=>$mixthumb.$data['imagename']);
                        $this->deleteImage($delete_data);
                    }
          }
        public function imgMysql($file,$mysql,$surplus){
               for($i=0;$i<count($surplus[1]);$i++){
                         if(isset($surplus[0][$i])){
                             $this->db->query("DELETE FROM " . DB_PREFIX ."koschtit_gallery_image WHERE id = '".$surplus[1][$i]."' AND mixname='".$surplus[0][$i]."'");
                             }
              }
          }
    public function getDatabaseFolder($folder){
    $query = $this->db->query("SELECT * FROM " . DB_PREFIX . "koschtit_gallery_folder kgf INNER JOIN " . DB_PREFIX . "koschtit_gallery_image kgi 
              ON (kgf.folder_id = kgi.folder_id) WHERE kgf.name = '".$folder."'");
    
              $results = $query->rows;
              return $results;
    }
    public function getImageOrder($folder){
                           $folder_id = $this->db->query("SELECT * FROM " . DB_PREFIX . "koschtit_gallery_folder WHERE name='".$folder."'");
    $query = $this->db->query("SELECT MAX(sort_order) FROM " . DB_PREFIX . "koschtit_gallery_image WHERE folder_id='".$folder_id->row['folder_id']."'");
    
              return $query->row["MAX(sort_order)"]+1;
    }
    public function getFolderInfo(){
              $query = $this->db->query("SELECT * FROM " . DB_PREFIX . "koschtit_gallery_folder  ORDER BY sort_order ASC");
             
              $results = $query->rows;
       
              $info = array();
              $i=0;
              foreach($results as $result){
                        
                  if($result['size'] > 0) $size = round($result['size']/1024/1024,2); else $size = 0;    
                   $info[$i] = array($result['name'] => array("folder_id"=>$result['folder_id'],
                                                                                   "files"=> $result['files'],
                                                                                    "size"=> $size,
                                                                                    "sort_order"=>$result['sort_order'],
                                                                                    "status"=>$result['status']));
                        $i++;
                      }
              return $info;
          }
          public function getFolderDescription($folder_id){
            $query = $this->db->query("SELECT * FROM " . DB_PREFIX . "language");
            $results = $query->rows;
            
            $query2 = $this->db->query("SELECT * FROM " . DB_PREFIX . "koschtit_gallery_folder WHERE folder_id='".$folder_id."'"); 
            $result2 = $query2->row;
          $i=0;
          foreach($results as $language){
                      $desc = $this->db->query("SELECT * FROM " . DB_PREFIX . "koschtit_gallery_folder_description WHERE folder_id='".$folder_id."'  AND language_id='".$language['language_id']."'");
                         $result = $desc->row; 
                         if(!isset($result['title'])){
                                   $result['title'] = ' ';
                         }
                               $description_info[$i] = 'language_id='.$language['language_id'].'&name='.$language['name'].'&image='.$language['image'].'&sort_order='.$result2['sort_order'].'&folder='.$result2['name']. '&status='.$result2['status'].'&title='.$result['title'];
                               $i++;
             }
               return $description_info;
          }
          public function editImageOrder($data){
           foreach ($data['image_change'] as $img){
                         
           $query2 = $this->db->query("UPDATE " . DB_PREFIX . "koschtit_gallery_image SET
            sort_order='".$img['sort_order']."' WHERE id='".$img['image_id']."'");
            }
          }
       public function getImageInfo($data){
                 $folder = $data[0];
                 $image = $data[1];
                 
                  $querys = $this->db->query("SELECT * FROM " . DB_PREFIX . "koschtit_gallery_folder WHERE name = '" .$folder ."'");
                  $folder_id = $querys->row["folder_id"];
                      $query = $this->db->query("SELECT * FROM " . DB_PREFIX . "koschtit_gallery_image WHERE folder_id = '" . $folder_id . "' AND filename = '" . $image . "'");
                      $results = $query->rows;
                      $file = array();
                       $unserialize = '';
                      foreach($results as $result){      
                       if($result['exif_data'] !=""){
                                 $unserialize = unserialize($result['exif_data']);
                       }
                       
                                    $file = array("id"=>$result['id'],
                                                        "folder"=>$folder,
                                                        "filename"=>$result['filename'],
                                                        "mixname"=>$result['mixname'],
                                                        "width" => $result['width'],
                                                        "height" => $result['height'],
                                                        "filesize" => round($result['filesize']/1024,2),
                                                        "exif_data" => $unserialize,
                                                        "watermark"=>$result['watermark'],
                                                        "sort_order"=>$result['watermark']);
                           }
                                
                      return $file;
}
public function addWatermark($data,$ki_gallery,$ki_base){
                       $ki_watermark_hori = $data['watermark_hori'];
                       $ki_watermark_vert = $data['watermark_vert'];
                       $ki_watermark_size = $data['watermark_size'];
                       $picture = '../'.$ki_gallery.$data['foldername'].'/'.$data['imagename'];
                       $watermark = '../'.$ki_base.'ki_watermark.pic';
  if(is_file($watermark)){
                         $image_info = getimagesize($picture);
                         
			$temp = explode('/', strtolower($image_info['mime']));
                                                                     
                                                                     if($temp[1] === "jpeg")$temp[1] = "jpg";
                                                                     
                                                                       switch($temp[1]){
                                                                                                                   case "jpg":
                                                                                                                   $image = imagecreatefromjpeg($picture);
                                                                      $extension = "jpg";
                                                                                              break;
                                                                                                                   case "png":
                                                                                                                   $image = imagecreatefrompng($picture);
                                                                      $extension = "png";
                                                                                                                   break;
                                                                                                                   case "gif":
                                                                                                                   $image = imagecreatefromgif($picture);
                                                                      $extension = "gif";
                                                                                                                   break;
                                                                     }
                                                                     imagealphablending($image, true);
                                                                     imagesavealpha($image, true);
                                                                                                                   
                                                                     $imageWidth = imagesx($image);
                                                                     $imageHeight = imagesy($image);
                                                                     $imageWidth_o = $imageWidth;
                                                                     $imageHeight_o = $imageHeight;
                                                                     
                                                                     // Load the logo image
                                              $logoImage = imagecreatefrompng("../".$ki_base."ki_watermark.pic");
                                              
                                                                     if(!$logoImage){
                                                                                            $logoImage = imagecreatefromjpeg("../".$ki_base."ki_watermark.pic");
                                                                     }
                                                                     if(!$logoImage){
                                                                                            $logoImage = imagecreatefromgif("../".$ki_base."ki_watermark.pic");
                                                                     }
                                                                     if(!$logoImage){
                                                                                           # exit();
                                                                     }							
                                                                     imagealphablending($logoImage, true);
                                                                     imagesavealpha($logoImage, true);

                                                                     $logoWidth = imagesx($logoImage);
                                                                     $logoHeight = imagesy($logoImage);
                                                                     
                                                                     $logoWidth_o = $logoWidth;
                                                                     $logoHeight_o = $logoHeight;
                                  
                       if($ki_watermark_size > 0){
                                                                                            
                                                                                            $logoAspect = $logoWidth / $logoHeight;

                                                                     if($imageWidth > $imageHeight){
                                                                                            $wide = 1;	
                                                                     } else {
                                                                                            $wide = 0;	
                                                                     }
                                                                     
                                                                     if($logoWidth > $logoHeight){
                                                                                            $logoWide = 1;	
                                                                     } else {
                                                                                            $logoWide = 0;	
                                                                     }
                                                                                            
                                                                                            
                                              if($wide == 1){
                                                                                            if($logoWide == 1){
                                                                                                                   $logoWidth = round($ki_watermark_size * $imageWidth);
                                                                                                                   $logoHeight = round((1/$logoAspect) * $logoWidth);
                                                                                                                   if($logoHeight > $imageHeight){
                                                                                                                                          $logoHeight = round($ki_watermark_size * $imageHeight);
                                                                                                                                          $logoWidth = round($logoAspect * $logoHeight);	
                                                                                                                   }
                                                                                            } else {
                                                                                                                   $logoHeight = round($ki_watermark_size * $imageHeight);
                                                                                                                   $logoWidth = round($logoAspect * $logoHeight);
                                                                                            }
                                              } else {
                                                                                            if($logoWide == 0){
                                                                                                                   $logoHeight = round($ki_watermark_size * $imageHeight);
                                                                                                                   $logoWidth = round($logoAspect * $logoHeight);
                                                                                                                   if($logoWidth > $imageWidth){
                                                                                                                                          $logoWidth = round($ki_watermark_size * $imageWidth);
                                                                                                                                          $logoHeight = round((1/$logoAspect) * $logoWidth);
                                                                                                                   } else {
                                                                                                                                                                                        $logoWidth = round($ki_watermark_size * $imageWidth);
                                                                                                                                                                                        $logoHeight = round((1/$logoAspect) * $logoWidth);
                                                                                                                   }
                                                                                            }
                                              }
                    }	
                                                                     switch($ki_watermark_vert){
                                                                                            case "top":
                                                                                                                   $starty = 0;
                                                                                            break;
                                                                                            case "middle";
                                                                                                                   $starty = round(($imageHeight - $logoHeight)*0.5);
                                                                     break;
                                                                     case "bottom":
                                                                                            $starty = $imageHeight-$logoHeight;
                                                                     break;	 
                                                                     }
                                                                     switch($ki_watermark_hori){
                                                                                            case "left":
                                                                                                                   $startx = 0;
                                                                                            break;
                                                                                            case "center";
                                                                                                                   $startx = round(($imageWidth - $logoWidth)*0.5);
                                                                                            break;
                                                                                            case "right":
                                                                                                                   $startx = $imageWidth-$logoWidth;
                                                                                            break;	 
                                                                     }
                                                                     // Paste the logo
                                                                     imagecopyresampled($image, $logoImage, $startx, $starty, 0, 0, $logoWidth, $logoHeight, $logoWidth_o, $logoHeight_o);
                                                                      

                                                                     imageDestroy($logoImage);
                                              
                       // Save image
                       switch($temp[1]){
                                              case "jpg":
                                                                     imagejpeg($image, $picture, 80);
                                              break;
                                              case "png":
                                                                     imagepng($image, $picture);
                                              break;
                                              case "gif":
                                                                     imagegif($image, $picture);
                                              break;
                       }

                       imageDestroy($image);
                                              
                       $this->db->query("UPDATE ".DB_PREFIX ."koschtit_gallery_image SET watermark=1 WHERE id='".$data['image_id']."'");
                       
                           $this->updateDiskUsage($ki_gallery,$data['foldername']);
                                      
                       }
}
    public function addImage($data,$ki_galleries,$ki_base,$ki_mixname,$maxx,$maxy,$ki_permission){
                  $ki_watermark_hori = $data['watermark_hori'];
                  $ki_watermark_vert = $data['watermark_vert'];
                  $ki_watermark_size = $data['watermark_size'];
           $thefile = '';
           $image_name = '';
           $image_not_found = '';
	$supported = array("jpg","png","gif", "jpeg");
	$image_not_found = false;
                      
	$image_not_found = false;
                       $path = "../".$ki_galleries;
                       $path2 = "../".$ki_galleries.$data['folder'].'/';
                  
                       $error = false;
                     if(!is_dir( $path)){
                                              $error = "404";
                                             return $error;
                       }
                     if(!is_writable($path)){
                                              $error = "403";
                                             return $error;
                       }
                     if(!is_dir($path2)){
                                              $error = "404f";
                                             return $error;
                       }
                     if(!is_writable($path2)){
                                              $error = "403f";
                                             return $error;
                       }

        if(is_uploaded_file($_FILES['file']['tmp_name'])){
	
         if($ki_galleries !=''){
	
		$thefile = $_FILES['file'];
                                              
		if(isset($data['watermark'])){
			$target_name = "../".$ki_base."ki_watermark.pic";
                                                      
			$temp = explode('.', strtolower($thefile['name']));
			if(in_array($temp[1], $supported)){
				if(move_uploaded_file($thefile['tmp_name'], $target_name)){

				}
			} 
		} else {
	
			if(!isset($data['folder']))
                                                                        $dir = "";
			else	
				$dir = $data['folder'];


			if(!isset($data['addwatermark']))
				$addwatermak = 0;
			else	
				$addwatermak = $data['addwatermark'];
	
			if(!isset($data['rotate']))
				$rotate = 0;
			else	
				$rotate = intval($data['rotate']);
	
			// -------------- Sicherheitsabfragen!
                                                
			if(preg_match("/[\.]*\//", $dir))exit();
			// ---------- Ende Sicherheitsabfragen!
			if($dir !=""){
                                                                        $p='/';
                                                      }
                                                      else{
                                                                        $p ='';
                                                      }
			$target_path = "../".$ki_galleries.$dir.$p;
                                                                     $targets = "../".$ki_galleries;
                                                            
                                                                                  if($ki_permission == 1){
                                                                                        @chmod($targets,0777);
                                                                                        @chmod($target_path,0777);
                                                                                  }
                                                                 
                                                                                  if($ki_permission == 2){
                                                                                        @chmod($targets,0775);
                                                                                        @chmod($target_path,0775);
                                                                                  }     
                                                       
                                                       
			$temp = explode('.', strtolower($thefile['name']));
   
            if(in_array($temp[1], $supported)){
                                                                     if($temp[1] === "jpeg")$temp[1] = "jpg";
                                                                     $target_name = $target_path.$temp[0].".".$temp[1]; // Endgültige Pfad+Name
                       if(move_uploaded_file($thefile['tmp_name'], $target_name)){
                                                   $path_arr = explode("/",$target_name);
                                                   $path_arr = array_reverse($path_arr);
                                                   $image_name = $path_arr[1].'/'.$path_arr[0];

					// Load the image where the logo will be embeded into
                                                                                            switch($temp[1]){
                                                                                                                   case "jpg":
                                                                                                                                          $image = imagecreatefromjpeg($target_name);
                                               $extension = "jpg";
                                                                                              break;
                                                                                                                   case "png":
                                                                                                                                          $image = imagecreatefrompng($target_name);
                                               $extension = "png";
                                                                                                                   break;
                                                                                                                   case "gif":
                                                                                                                                          $image = imagecreatefromgif($target_name);
                                               $extension = "gif";
                                                                                                                   break;
                                                                                            }
					imagealphablending($image, true);
					imagesavealpha($image, true);

					// Auto rotate
					$orientation = 1;
                                                  $exifdata = "";
                                                                                          if(function_exists("exif_read_data")){
                                                                                                                    if(file_exists($target_name) && is_writable($target_name)){
                                                                                                                                           $img = getimagesize($target_name);
                                                                                                                                     if($img['mime'] !='image/png'){
                                                                                                                                                           $exif = @exif_read_data($target_name,'IFD0,EXIF', true);
                                                                                                                                                           $exifdata = $this->td_get_exif($exif);  
                                                                                                                                    }
                                                                                                             }
                                                                                             
                                                                                   }

                                                                                                           
                                                                   if($rotate == 1){
                                                                                                                   if(isset($exif['Orientation'])){
                                                                                                
                                                                                                                                          if(!is_array($exif['Orientation']))$orientation = $exif['Orientation'];
                                                                                                                   }
                                                                                                                   switch($orientation) {
                                                                                                                                          case 3:
                                                                                                                                                                 $image = imagerotate($image, 180, 0);
                                                                                                                                          break;
                                                                                                                                          case 6:
                                                                                                                                                                 $image = imagerotate($image, -90, 0);
                                                                                                                                          break;
                                                                                                                                          case 8:
                                                                                                                                                                 $image = imagerotate($image, 90, 0);
                                                                                                                                          break;
                                                                                                                                          default:
                                                                                                                                                                 $orientation = 1;
                                                                                                                                          break;
                                                                                                                   }
                                                                                            }

					// Get dimensions
					$imageWidth = imagesx($image);
					$imageHeight = imagesy($image);
					$imageWidth_o = $imageWidth;
					$imageHeight_o = $imageHeight;
                                                                                                                   
                                                                                                                   
                                                                                                                   

					if($addwatermak == 1){
                                                                                            if(is_file("../".$ki_base."ki_watermark.pic")){
                                                                                                                   // Load the logo image
                                                                                                                   $logoImage = imagecreatefrompng("../".$ki_base."ki_watermark.pic");
                                                                                                                   if(!$logoImage){
                                                                                                                                          $logoImage = imagecreatefromjpeg("../".$ki_base."ki_watermark.pic");
                                                                                                                   }
                                                                                                                   if(!$logoImage){
                                                                                                                                          $logoImage = imagecreatefromgif("../".$ki_base."ki_watermark.pic");
                                                                                                                   }
                                                                                                                   if(!$logoImage){
                                                                                                                                          exit();
                                                                                                                   }							
                                                                                                                   imagealphablending($logoImage, true);
                                                                                                                   imagesavealpha($logoImage, true);

                                                                                                                   $logoWidth = imagesx($logoImage);
                                                                                                                   $logoHeight = imagesy($logoImage);
                                                                                                                   
                                                                                                                   $logoWidth_o = $logoWidth;
                                                                                                                   $logoHeight_o = $logoHeight;
                                                                                
                                                                                            if($ki_watermark_size > 0){
                                                                                                                                          
                                                                                                                                          $logoAspect = $logoWidth / $logoHeight;

                                                                                                                                          if($imageWidth > $imageHeight){
                                                                                                                                                                 $wide = 1;	
                                                                                                                                          } else {
                                                                                                                                                                 $wide = 0;	
                                                                                                                                          }
                                                                                                                                          
                                                                                                                                          if($logoWidth > $logoHeight){
                                                                                                                                                                 $logoWide = 1;	
                                                                                                                                          } else {
                                                                                                                                                                 $logoWide = 0;	
                                                                                                                                          }
                                                                                                                                          
                                                                                                                                          if($wide == 1){
                                                                                                                                                                 if($logoWide == 1){
                                                                                                                                                                                        $logoWidth = round($ki_watermark_size * $imageWidth);
                                                                                                                                                                                        $logoHeight = round((1/$logoAspect) * $logoWidth);
                                                                                                                                                                                        if($logoHeight > $imageHeight){
                                                                                                                                                                                                               $logoHeight = round($ki_watermark_size * $imageHeight);
                                                                                                                                                                                                               $logoWidth = round($logoAspect * $logoHeight);	
                                                                                                                                                                                        }
                                                                                                                                                                 } else {
                                                                                                                                                                                        $logoHeight = round($ki_watermark_size * $imageHeight);
                                                                                                                                                                                        $logoWidth = round($logoAspect * $logoHeight);
                                                                                                                                                                 }
                                                                                                                                          } else {
                                                                                                                                                                 if($logoWide == 0){
                                                                                                                                                                                        $logoHeight = round($ki_watermark_size * $imageHeight);
                                                                                                                                                                                        $logoWidth = round($logoAspect * $logoHeight);
                                                                                                                                                                                        if($logoWidth > $imageWidth){
                                                                                                                                                                                                               $logoWidth = round($ki_watermark_size * $imageWidth);
                                                                                                                                                                                                               $logoHeight = round((1/$logoAspect) * $logoWidth);
                                                                                                                                                                                        } else {
                                                                                                                                                                                                               $logoWidth = round($ki_watermark_size * $imageWidth);
                                                                                                                                                                                                               $logoHeight = round((1/$logoAspect) * $logoWidth);
                                                                                                                                                                                        }
                                                                                                                                                                 }
                                                                                                                                          }
                                                                                            }	
                                                                                                                   switch($ki_watermark_vert){
                                                                                                                                          case "top":
                                                                                                                                                                 $starty = 0;
                                                                                                                                          break;
                                                                                                                                          case "middle";
                                                                                                                                                                 $starty = round(($imageHeight - $logoHeight)*0.5);
                                                                                                                                          break;
                                                                                                                                          case "bottom":
                                                                                                                                                                 $starty = $imageHeight-$logoHeight;
                                                                                                                                          break;	 
                                                                                                                   }
                                                                                                                   switch($ki_watermark_hori){
                                                                                                                                          case "left":
                                                                                                                                                                 $startx = 0;
                                                                                                                                          break;
                                                                                                                                          case "center";
                                                                                                                                                                 $startx = round(($imageWidth - $logoWidth)*0.5);
                                                                                                                                          break;
                                                                                                                                          case "right":
                                                                                                                                                                 $startx = $imageWidth-$logoWidth;
                                                                                                                                          break;	 
                                                                                                                   }
                                                                                                                   // Paste the logo
                                                                                                                   imagecopyresampled($image, $logoImage, $startx, $starty, 0, 0, $logoWidth, $logoHeight, $logoWidth_o, $logoHeight_o);
                                                                                                                    

                                                                                                                   imageDestroy($logoImage);
                                                                                                                   
                                                                                                                   
                                                                                            }
                                                                     }
                                                                     
                                                                     if(isset($data['maxx'])){
                                                                                            if(intval($data['maxx']) > 0)$maxx = intval($data['maxx']);
                                                                         }
                                                 if(isset($data['maxy'])){
                                                                                if(intval($data['maxy']) > 0)$maxy = intval($data['maxy']);
                                            }
					$aspect = $imageWidth / $imageHeight;
                                                                                         
					if($aspect > 1){
						if($imageWidth > $maxx){
							$imageWidth = $maxx;
							$imageHeight = round((1/$aspect) * $imageWidth);
						}
						if($imageHeight > $maxy){
							$imageHeight = $maxy;
							$imageWidth = round($aspect * $imageHeight);
						}
					} else {
						if($imageHeight > $maxy){
							$imageHeight = $maxy;
							$imageWidth = round($aspect * $imageHeight);
						}
						if($imageWidth > $maxx){
							$imageWidth = $maxx;
							$imageHeight = round((1/$aspect) * $imageWidth);
						}
					}
					
					if($imageWidth_o != $imageWidth || $imageHeight_o != $imageHeight){
						$bild = imagecreatetruecolor($imageWidth, $imageHeight);
						imagealphablending($bild, false);
						imagesavealpha($bild, true);
						imagecopyresampled($bild, $image, 0, 0, 0, 0, $imageWidth, $imageHeight, $imageWidth_o, $imageHeight_o); 
						switch($temp[1]){
							case "jpg":
								imagejpeg($bild, $target_name, 80);
							break;
							case "png":
								imagepng($bild, $target_name);
							break;
							case "gif":
								imagegif($bild, $target_name);
							break;
                                                                                                                   }
                                                                                                                                                              
						imageDestroy($bild);
					} else {
						if($addwatermak == 1 || $orientation != 1){
							// Save image
							switch($temp[1]){
								case "jpg":
									imagejpeg($image, $target_name, 80);
								break;
								case "png":
									imagepng($image, $target_name);
								break;
								case "gif":
									imagegif($image, $target_name);
								break;
							}
						}
					}
					// Release memory
					imageDestroy($image);
                        if($ki_mixname  == 1){                                                                                                                  
                                                  $mixname = $this->getMixName();
                                                  
                             $mix_path = $target_path.$mixname.'.'.$extension;
                             $fname = $mixname .'.'.$extension;
                             rename($target_name,$mix_path);
                          } else{
                                              
                                                 $mix_path =  $target_name;
                                                 $fname = basename($target_name);
                          }
                            $query = $this->db->query("SELECT (folder_id) FROM " . DB_PREFIX . "koschtit_gallery_folder WHERE name = '" .$dir ."'");
                            $folder_id = $query->row["folder_id"];
                      $size =  filesize($mix_path);
                $max_image = $this->maxImage();
              $query2 = $this->db->query("SELECT * FROM " . DB_PREFIX . "koschtit_gallery_image WHERE id = '" .$max_image ."'");
              $filename = basename($target_name);
              if(isset($query2->row['filename']) && $query2->row['filename'] != $filename ){
                                                             $this->db->query("INSERT INTO " . DB_PREFIX . "koschtit_gallery_image SET
                                                                                                                                      folder_id = '" . $folder_id . "',
                                                                                                                                      filename = '" . $this->db->escape(basename($target_name)) ."',
                                                                                                                                      mixname = '" . $this->db->escape($fname). "',
                                                                                                                                      width = '" . $imageWidth . "',
                                                                                                                                      height = '" . $imageHeight . "',
                                                                                                                                      filesize = '" .$size. "',
                                                                                                                                      exif_data = '" . $this->db->escape($exifdata) ."',
                                                                                                                                      date_added = '".time()."',
                                                                                                                                      sort_order = '".$data['sort_order']."'"); 
                                                
                                                                            $this->db->query("UPDATE  " . DB_PREFIX . "koschtit_gallery_folder SET
                                                                                                                                files = files+1,
                                                                                                                                 size = size+" . $size ."  WHERE folder_id='" . $folder_id ."'"); 
                                        }
				}
                                              }
                                   
                           }
                            }
                             else {
                                     return "Error3";
                             }
	 }elseif($thefile == ''){
                                        $image_not_found = true;
                       }


                    if($image_not_found == true){
                                              return "404fi";
                     } else{
                                     if($image_name !=''){
                                              return $image_name;
                                     } 
                                     else {
                                                            return "filename";
                                     }
                                                                                            
                           }
     }
     public function deleteImage($data){
                  $response = "";
                  $ki_galleries = $data['ki_galleries'];
                  $ki_base = $data['ki_base'];
                  if(isset($data['album']))
                                    $gallery = rawurldecode($data['album']);
                                    
                  if(isset($data['file']))
                                    $file = rawurldecode($data['file']);
	
                  if(isset($data['thumb']))
                                    $thumb = rawurldecode($data['thumb']);
                                     
                  // -------------- Sicherheitsabfragen!
                  if(!is_file("../".$ki_galleries.$gallery."/".$file)) {  $response = "not_found";}
      
         
                                    $imgfile = "../".$ki_galleries.$gallery."/".$file;
                                    $thumbfile = "../".$ki_galleries.$gallery."/thumbs/".$thumb;
                          if(is_file($imgfile)){
                                                 @unlink($imgfile);
                        $query=$this->db->query("SELECT * FROM " . DB_PREFIX ."koschtit_gallery_folder WHERE name='".$gallery."'");
                        $folder_id = $query->row['folder_id'];     
                        
                                 $this->db->query("UPDATE  " . DB_PREFIX . "koschtit_gallery_folder SET
                      	                                                           files = files-1  WHERE folder_id='" . $folder_id ."'"); 
                              
                              $this->db->query("DELETE FROM " . DB_PREFIX ."koschtit_gallery_image WHERE folder_id='".$folder_id."' AND mixname = '".$file."'");   
                              $this->db->query("DELETE FROM " . DB_PREFIX ."koschtit_gallery_admin_comment WHERE folder_name='".$gallery."' AND image_name = '".$file."'");  
                              $this->db->query("DELETE FROM " . DB_PREFIX ."koschtit_gallery_viewercomment WHERE folder_name='".$gallery."' AND image_name = '".$file."'");   
                                              }else{
                                                          $response =  "Error";
                                              }
                                    if(is_file($thumbfile))@unlink($thumbfile);
                                      if(file_exists($imgfile)) {
                                                $response =  "Error Permission";
                                                } 
                          
                           $this->updateDiskUsage($ki_galleries,$gallery);
                           
                                    return $response;

   }
   public function imageResize($data,$ki_gallery,$dir,$file){
                           $query=$this->db->query("SELECT * FROM " . DB_PREFIX ."koschtit_gallery_folder WHERE name='".$dir."'");
                        $folder_id = $query->row['folder_id'];     
                        
                          $query2 =  $this->db->query("SELECT *  FROM " . DB_PREFIX ."koschtit_gallery_image WHERE folder_id='".$folder_id."' AND filename = '".$file."'");   
                        $old_size = $query2->row['filesize'];
                        $img_id = $query2->row['id'];
                              
                   $filename = '../'.$ki_gallery.$dir.'/'.$query2->row['mixname'];
                   list($width_orig, $height_orig) = getimagesize($filename);
                   
                   // Set a maximum height and width
                       $width = $data['width'];
                       $height = $data['height']; 
                  
               if($width > 25 && $height > 25){            
                  $ratio_orig = $width_orig/$height_orig;
                  
                  if ($width/$height > $ratio_orig) {  
                     $width = $height*$ratio_orig;
                  } else {        
                     $height = $width/$ratio_orig;
                  }
              // Resample
             $image_p = imagecreatetruecolor($width, $height);
          
             $temp = array_reverse(explode('.', strtolower($filename)));
                  switch($temp[0]){
                                    case "jpg":
                                                      $image = imagecreatefromjpeg($filename);
                                   break;
                                    case "png":
                                                      $image = imagecreatefrompng($filename);
                                    break;
                                    case "gif":
                                                      $image = imagecreatefromgif($filename);
                                    break;
                  }
         imagecopyresampled($image_p, $image, 0, 0, 0, 0, $width, $height, $width_orig, $height_orig);

            // Output
                  switch($temp[0]){
                                    case "jpg":
                                                      imagejpeg($image_p, $filename, 100);
                                    break;
                                    case "png":
                                                      imagepng($image_p, $filename);
                                    break;
                                    case "gif":
                                                      imagegif($image_p, $filename);
                                    break;
                  }
              $filesize = 0;   
                    
                    if(file_exists($filename)){
                    $filesize = filesize($filename);   
                                           if($filesize > $old_size){
                                                                  $change = $filesize - $old_size;
                                                               $size_change =  " size + ". $change;
                                           }elseif($old_size >$filesize) {
                                                                  $change = $old_size-$filesize;
                                                               $size_change =   " size - " . $change;
                                           } elseif($old_size == $filesize) {
                                           
                                          $size_change =   " size + 0";
                                        
                                           }
                       }         
     $querya = $this->db->query("SELECT (folder_id) FROM " . DB_PREFIX . "koschtit_gallery_folder WHERE name = '" .$dir ."'");
     $folder_id = $querya->row["folder_id"];
                 $this->db->query("UPDATE `".DB_PREFIX."koschtit_gallery_image` SET 
                                                               `width` = '" .$width . "',
                                                               `height` = '"  . $height . "',
                                                               `filesize` = '" . $filesize . "' WHERE id='".$img_id."'");
    $this->updateDiskUsage($ki_gallery,$dir);
              }
                                                                                   
          }
          private function deleteAll($folder,$info="",$last=""){
                    $iterator = new DirectoryIterator($folder);
                    foreach ($iterator as $fileInfo) {
                              if($fileInfo->isDot()){
                                        continue;
                              } else if($fileInfo->isFile()){
                                        @unlink($folder.$fileInfo->getBasename());
                              } else if($fileInfo->isDir()){
                                        $this->deleteAll($folder.$fileInfo->getBasename()."/");
                              }
                       }
   
                       if(file_exists($info)) @unlink($info);
                       if(file_exists($last)) @unlink($last);
             if(is_dir($folder)){
                       $cont = explode("/",$folder);
                       $cont = array_reverse($cont);
                       if($cont[1] !=''){
                         return @rmdir($folder);
                         }
                         else{
                         return true;
                       }
                }
          }          
          private function emptyAll($folder){
                    $iterator = new DirectoryIterator($folder);
                    foreach ($iterator as $fileInfo) {
                              if($fileInfo->isDot()){
                                        continue;
                              } else if($fileInfo->isFile()){
                                        if(!@unlink($folder.$fileInfo->getBasename()))return false;
                              } else if($fileInfo->isDir()){
                                        $this->deleteAll($folder.$fileInfo->getBasename()."/");
                              }
          }
                    return true;
          }
        public function managefolder($data,$setting){
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
             $ki_galleries = $setting['ki_galleries'];
             $ki_base = $setting['ki_base'];
             $ki_thumbs = $setting['ki_thumbs'];
             $ki_th_per_line = $setting['ki_th_per_line'];
             $ki_th_lines = $setting['ki_th_lines'];
             $ki_th_width = $setting['ki_th_width'];
             $ki_th_height = $setting['ki_th_height'];
             $ki_th_bord_size = $setting['ki_bord_size'];
             $ki_th_bord_hover_increase = $setting['ki_th_bord_hover_increase'];
             $ki_th_to_square = $setting['ki_th_to_square'];
             $ki_th_2sq_crop_vert = $setting['ki_th_2sq_crop_vert'];
             $ki_th_2sq_crop_hori = $setting['ki_th_2sq_crop_hori'];
             $ki_show_nav = $setting['ki_show_nav'];
             $ki_nav_always = $setting['ki_nav_always'];
             $ki_permission = $setting['ki_permission'];
             
                $error = false;
                $path = "../".$ki_galleries;
                     if(!is_dir( $path)){
                   
                                              $error = "404";
                                             return $error;
                       }
                     if(!is_writable($path)){
                   
                                              $error = "403";
                                             return $error;
                       }

             if(isset($data['createfolder'])){
                              $folder = "../".$ki_galleries . $data['createfolder']."/";
              } elseif($data['rmdir']){
                              $folder = "../".$ki_galleries . $data['rmdir']."/";
              } elseif($data['empty']){
                              $folder = "../".$ki_galleries . $data['empty']."/";
              }
	if(isset($data['createfolder'])){
                              
                              $new_folder_id = $this->maxFolder();
                            
                                         if(!is_dir($folder)){
                                              $mask=umask(0);
                                                                     if($ki_permission == 1){
                                                                       @mkdir($folder, 0777); 
                                                                     }
                                                                     elseif($ki_permission == 2){
                                                                       @mkdir($folder, 0775); 
                                                                     }
                                                                      else {
                                                                       @mkdir($folder,0755); 
                                                                     }
                                              umask($mask);     
                                              
                                        } /* else {
                                                 
                       $error = "400";
                       return $error;
                                        } */
                    
                                        $lastmodified = time(); 
                                        if(isset($data['managefolder'])){
                                         $languages = array_keys($data['managefolder']);
                                        } else{                                         
                                          $languages = array(0=>1);
                          }
                          if(!isset($data['status'])){
                                                 $data['status'] = '0';
                          }
   
                          $mixthumb = $this->mixThumb();
                          $maxd = $this->maxFolder()-1;
                          
                                        $query = $this->db->query("SELECT * FROM ".DB_PREFIX."koschtit_gallery_folder WHERE folder_id = '".$maxd."'");
                                        
                                     if($query->row['name'] !=$data['createfolder']){
                                                       $this->db->query("INSERT INTO " . DB_PREFIX ."koschtit_gallery_folder SET
                                                                folder_id='" . $new_folder_id ."',
                                                                name = '" . $this->db->escape($data['createfolder']) . "',
                                                                mixthumb = '" . $mixthumb . "',
                                                                size = '0',
                                                                sort_order = '" . $data['sort_order'] . "',
                                                                status = '" . $data['status'] ."'");
                                                                
                                                      for($i=0;$i<count($languages);$i++){
                                                                $this->db->query("INSERT INTO " . DB_PREFIX ."koschtit_gallery_folder_description SET
                                                                folder_id='" . $new_folder_id ."',
                                                                title = '" . $this->db->escape($data['managefolder'][$languages[$i]]['title']). "',
                                                                language_id = '" . $languages[$i] . "',
                                                                date_modified=NOW()");
                                                     }
                              }
          }
         if(isset($data['rmdir'])){     
                                              if(is_dir($folder)){
                                                               if(is_writable($folder)){   
                                                                                            $this->deleteAll($folder);
                                                                } else{
                                                                      $error = "403f";
                                                                      return $error;
                                                                 }
                                              }   else {
                                               $error = "404f";
                                               return $error;
                                           } 
                  
                    
                                        $query = $this->db->query("SELECT (folder_id) FROM ".DB_PREFIX."koschtit_gallery_folder WHERE name = '".$data['rmdir']."'");
                                        
                       $this->db->query("DELETE FROM ".DB_PREFIX."koschtit_gallery_folder WHERE name = '" . $data['rmdir']."'");
                                        
                                       if(isset($query->row["folder_id"])){ 
                                        $folder_id = $query->row["folder_id"];
                                        $this->db->query("DELETE FROM ".DB_PREFIX."koschtit_gallery_folder_description WHERE folder_id = '".$folder_id."'");
                                        $this->db->query("DELETE FROM ".DB_PREFIX."koschtit_gallery_image WHERE folder_id = '".$folder_id."'");
                                        }
                                        
                  }
         
              if(isset($data['empty'])){
                                        $folder = "../".$ki_galleries.$data['empty']."/";
                           if(is_dir($folder)){
                                        if(is_writable($folder)){             
                                           $this->emptyAll($folder);
                                         } else{
                                               $error = "403f";
                                               return $error;
                                          }
                                       }  else {
                                               $error = "404f";
                                               return $error;
                                           }
                                     
                                       $q = $this->db->query("SELECT * FROM " . DB_PREFIX . "koschtit_gallery_folder WHERE name='".$data['empty']."'");
                                       $folder_id = $q->row['folder_id'];
                                       $this->db->query("DELETE FROM " . DB_PREFIX . "koschtit_gallery_image WHERE folder_id='".$folder_id."'");
                                       $this->db->query("UPDATE " . DB_PREFIX . "koschtit_gallery_folder SET size='',files='' WHERE folder_id='".$folder_id."'");
                          
               }
          }
          public function imageCrop($img){                          
                    $valid_exts = array('jpeg', 'jpg', 'png', 'gif');
                    $max_file_size = 200 * 1024; #200kb
                    $nw = $nh = 200; # image with & height
                    
                    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                      if ( isset($_FILES['image']) ) {
                        if (! $_FILES['image']['error'] && $_FILES['image']['size'] < $max_file_size) {
                          # get file extension
                          $ext = strtolower(pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION));
                          # file type validity
                          if (in_array($ext, $valid_exts)) {
                              $path = 'uploads/' . uniqid()  . '.' . $ext;
                              $size = getimagesize($_FILES['image']['tmp_name']);
                              # grab data form post request
                              $x = (int) $_POST['x'];
                              $y = (int) $_POST['y'];
                              $w = (int) $_POST['w'] ? $_POST['w'] : $size[0];
                              $h = (int) $_POST['h'] ? $_POST['h'] : $size[1];
                              # read image binary data
                              $data = file_get_contents($_FILES['image']['tmp_name']);
                              # create v image form binary data
                              $vImg = imagecreatefromstring($data);
                              $dstImg = imagecreatetruecolor($nw, $nh);
                              # copy image
                              imagecopyresampled($dstImg, $vImg, 0, 0, $x, $y, $nw, $nh, $w, $h);
                              # save image
                              imagejpeg($dstImg, $path);
                              # clean memory
                              imagedestroy($dstImg);
                              
                            } else {
                              echo 'unknown problem!';
                            } 
                        } else {
                          echo 'file is too small or large';
                        }
                      } else {
                        echo 'file not set';
                      }
                    } else {
                      echo 'bad request!';
                    }
}

public function updateDiskUsage($ki_gallery,$folder){
                              $path = '../'.$ki_gallery.$folder.'/';                                                    
                              $files = array();
                       if(is_dir($path)){
                                              $pictures = new DirectoryIterator($path);
                                              $filesize = array();
                                              foreach($pictures as $fileInfo){
                                                       if(is_file($path.$fileInfo)){
                                                                              $filesize[] = filesize($path.$fileInfo);
                                                                     $files[] = array('filesize'=>filesize($path.$fileInfo),'filename'=> "".$fileInfo);
                                                                     }
                                              }
                       
                       }      
     $querya = $this->db->query("SELECT * FROM " . DB_PREFIX . "koschtit_gallery_folder WHERE name = '" .$folder ."'");
     $folder_id = $querya->row["folder_id"];
               
                              $this->db->query("UPDATE  " . DB_PREFIX . "koschtit_gallery_folder SET
                                                                                   size = '" . array_sum($filesize). "' WHERE folder_id='" . $folder_id ."'");
                               foreach($files as $file){
                                   $this->db->query("UPDATE  `" . DB_PREFIX . "koschtit_gallery_image` SET
                                                                                   filesize = '" . $file['filesize']. "' WHERE mixname='" . $file['filename'] ."'");
                                 }
                     
}
          private function getMixName(){
           $hash = 'aabcdefghijklmnopqrstuvwxyzabcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYXZABCDEFGHIJKLMNOPQRSTUVWXYXZ123456789012345678901234567890';
           $values = array();
           $result = array();
           $strlen = strlen($hash);
           $strlen--;
            for($i=0;$i<30;$i++){
                    array_push($values,rand(1,$strlen));
            }
  
  
          for($i=1;$i<22;$i++){
                   array_push($result,$hash[$values[$i]]);
            } 
              return implode("",$result);
          }
          private function mixThumb(){
           $hash = '1234567899';
           $values = array();
           $strlen = strlen($hash);
             for($i=0;$i<10;$i++){
                    array_push($values,rand(1,$strlen));
            }
              return implode("",$values);
          }
          private function td_get_exif($image) {
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
          private function maxFolder(){
                          $query = $this->db->query("SELECT MAX(folder_id) FROM ". DB_PREFIX ."koschtit_gallery_folder");
                          
                          return $query->row["MAX(folder_id)"]+1;
          }
          private function maxImage(){
                          $query = $this->db->query("SELECT MAX(id) FROM ". DB_PREFIX ."koschtit_gallery_image");
                          
                          return $query->row["MAX(id)"];
          }
          private function Replace($data){
                          $new = "";
                          for($i=10;$i<strlen($data);$i++){
                                            $new .=$data[$i];
                          }
                          return $new;
          }
        private function changeArrayKeys($array){
                          $new = array();
                         $keys = array_keys($array);
                         for($i=0;$i<count($keys);$i++){
                                           $new[$i] = $array[$keys[$i]];
                }
              
        return $new;
}
}
?>
