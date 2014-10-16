<?php
class ControllerLineGallery extends Controller {
	private $error = array(); 
	public function index() {   
		$this->language->load('line/gallery');

                                   $this->load->model('line/kigallery');
                                   
		$this->data['breadcrumbs'] = array();
		$this->data['breadcrumbs'][] = array(
			'text'      => $this->language->get('text_home'),
			'href'      => $this->url->link('common/home'),
			'separator' => false
		);
		$this->document->setTitle($this->language->get('heading_title'));
		$this->document->addStyle('catalog/view/theme/'.$this->config->get('config_template').'/stylesheet/koschtit_gallery.css');

		 $this->data['ki_gallery_module'] = '';
		$this->data['heading_title'] = $this->language->get('heading_title');
                            $settings = $this->config->get('kigallery_module');  
                             if(isset($settings[0]['ki_base'])){

                                      $arr = $settings[0];
                                      $setting = array_keys($arr);
                  
                                      for($i=0;$i<count($setting);$i++){
                                                        $this->data[$setting[$i]] = $arr[$setting[$i]];
                                     }   
                                     
                                           $this->data['ki_gallery_module'] = true;
                                           
                                 } 
                                    
                            $foldermodule = $this->config->get('koschtitgallery_folder_module');  
                            
                             if(isset($foldermodule[0]['status'])){
                                           $this->data['koschtitgallery_folder_module'] = true;
                             }
                                       $conf = "";
		$conf = $this->model_line_kigallery->getLanguages($this->config->get('config_language'));
                                    $this->data['link'] = $this->url->link('line/gallery');
                                     $setup = $this->model_line_kigallery->getSetup($conf);
                                   $key = array_keys($setup);
                                   
                    for($i=0;$i<count($key);$i++){
                                                       $this->data[$key[$i]] = $setup[$key[$i]];
                       }
     
                    $this->data['galleries'] = array();
                    $this->data['ki_help_text'] = str_replace("\r\n","",$this->data['ki_help_text']); 
                    $this->data['ki_help_text'] = str_replace("\n","",$this->data['ki_help_text']); 
                    
                    $folders =  $this->model_line_kigallery->getFolders();
    
                    $this->data['folders'] = "";
                    if($folders){
                                      $this->data['folders'] = $folders;
                                                        if(isset($this->request->get['album'])){
                                                                  foreach($folders as $folder){
                                                                      if($folder['folder_id'] == $this->request->get['album']){
                                                                          $this->data['folder'] = $folder['name'];
                                                                          $this->data['folder_description'] = $folder['title'];
                                                                          break;
                                                                          }
                                                                    }
                                                        }
                                                        else{
                                                                          $this->data['folder'] = $folders[0]['name'];
                                                                          $this->data['folder_description'] = $folders[0]['title'];
                                                          }
                   }
                       else{
                                                       $this->data['folder'] = '';
                                                       $this->data['folder_description'] = '';
                      }

 		if (isset($this->error['warning'])) {
			$this->data['error_warning'] = $this->error['warning'];
		} else {
			$this->data['error_warning'] = '';
                    }

                  $this->data['count'] = count($folders);
                  $this->data['album'] = "";
                  if(isset($this->request->get['album'])){
                                      $this->data['album'] = $this->request->get['album'];
                  }
                  
		$this->children = array(
                              'common/header',
                              'common/column_left',
                              'common/column_right',
                              'common/footer',
                              'common/content_top',
                              'common/content_bottom'
		);
                             
                       if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/line/gallery.tpl')) {
                                                                     $this->template = $this->config->get('config_template') . '/template/line/gallery.tpl';
                                              } else {
                                                                     $this->template = 'default/template/line/gallery.tpl';
                      }
       
		 $this->response->setOutput($this->render());
	}
}
?>
