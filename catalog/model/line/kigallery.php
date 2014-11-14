<?php
class ModelLineKiGallery extends Model{
       public function getSettings(){
               $ki_query = $this->db->query("SELECT * FROM " . DB_PREFIX . "setting");
                return $ki_query->rows;
        }
        public function getLanguages($code){
                           $query = $this->db->query("SELECT * FROM " . DB_PREFIX . "language WHERE code='".$code."'");
                       $result = $query->row;
                       return $result['language_id'];
        }
        public function getSetup($config_language){
                  $config_language =  $this->checkLanguage_id($config_language);
                          $koschtit = $this->db->query("SELECT * FROM " . DB_PREFIX . "koschtit_gallery_description 
                            WHERE language_id = '" . $config_language . "'");
                            return $koschtit->row;
        }
        public function checkLanguage_id($id){
                           $query = $this->db->query("SELECT * FROM " . DB_PREFIX . "koschtit_gallery_description WHERE language_id='".$id."'");
                       if(isset($query->row['language_id'])){
                                 return $id;
                                 } else{
                           $result = $this->db->query("SELECT * FROM " . DB_PREFIX . "language WHERE code='en' OR code='EN'");
                         return $result->row['language_id'];
                       }
        }
      public function getLayout($route) {
                       $query = $this->db->query("SELECT * FROM " . DB_PREFIX . "layout_route WHERE layout_id='" . $this->db->escape($route) . "'");
                       
                                              return $query->row['route'];
     }
        public function getFolders(){                                       
                     $query = $this->db->query("SELECT * FROM " . DB_PREFIX ."koschtit_gallery_folder kgf LEFT JOIN
                     " . DB_PREFIX ."koschtit_gallery_folder_description kgd ON (kgf.folder_id = kgd.folder_id)  WHERE
                     kgd.language_id = '" . $this->config->get('config_language_id') ."' ORDER BY kgf.sort_order ASC");
                     $folders = $query->rows;
                              return $folders;
        }
}
?>
