<?php 
class ControllerLineKiGallery extends Controller { 
	private $error = array();
	public function index() {
		$this->language->load('line/koschtit_gallery');
                                    
                $this->document->addStyle('view/stylesheet/ki_gallery.css');
                       $this->document->setTitle($this->language->get('heading_title'));
                               
                       $this->data['breadcrumbs'][] = array(
                       'text'      => $this->language->get('text_home'),
                       'href'      => $this->url->link('common/home', 'token=' . $this->session->data['token'], 'SSL'),
                       'separator' => false
                       );

                       $this->data['breadcrumbs'][] = array(
                       'text'      => $this->language->get('heading_title'),
                       'href'      => $this->url->link('line/kigallery', 'token=' . $this->session->data['token'], 'SSL'),
                       'separator' => ' :: '
                       );
		
                       $this->data['heading_title'] = $this->language->get('heading_title');
                       
                       $this->data['text_load_images'] = $this->language->get('text_load_images');
                       $this->data['text_change_order'] = $this->language->get('text_change_order');
                       $this->data['text_delete_images'] = $this->language->get('text_delete_images');
                       $this->data['text_manage_folder'] = $this->language->get('text_manage_folder');
                       $this->data['text_gallery_texts'] = $this->language->get('text_gallery_texts');
                       $this->data['text_change'] = $this->language->get('text_change');
                       $this->data['text_settings'] = $this->language->get('text_settings');
                                                                                                                                          
                       $this->data['delete'] = $this->url->link('line/kigallery/delete', 'token=' . $this->session->data['token'], 'SSL');			
                       $this->data['upload'] = $this->url->link('line/kigallery/upload', 'token=' . $this->session->data['token'], 'SSL');
                       $this->data['gallery_texts'] = $this->url->link('line/kigallery/settings', 'token=' . $this->session->data['token'], 'SSL');
                       $this->data['managefolder'] = $this->url->link('line/kigallery/managefolder', 'token=' . $this->session->data['token'], 'SSL');
                       $this->data['change'] = $this->url->link('line/kigallery/change', 'token=' . $this->session->data['token'], 'SSL');
                       $this->data['setting'] = $this->url->link('module/koschtit_gallery', 'token=' . $this->session->data['token'], 'SSL');
	
		
                       if (isset($this->error['warning'])) {
                                              $this->data['error_warning'] = $this->error['warning'];
                       } else {
                                              $this->data['error_warning'] = '';
                       }

                       if (isset($this->session->data['success'])) {
                                              $this->data['success'] = $this->session->data['success'];
                       
                                              unset($this->session->data['success']);
                       } else {
                                              $this->data['success'] = '';
                       }
                       
                       $this->template = 'line/kigallery_select.tpl';
                       $this->children = array(
                                              'common/header',
                                              'common/footer'
                       );
                                                                     
                       $this->response->setOutput($this->render());
   }
    public function insert() {
		$this->language->load('line/koschtit_gallery');

		$this->document->setTitle($this->language->get('heading_title'));
		
		$this->load->model('line/kigallery');
		
		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateForm()) {
			$this->model_line_kigallery->addKoschtitGallery($this->request->post);

			$this->session->data['success'] = $this->language->get('text_success');

			$url = '';

			if (isset($this->request->get['page'])) {
				$url .= '&page=' . $this->request->get['page'];
			}
						
                                    $this->redirect($this->url->link('line/kigallery', 'token=' . $this->session->data['token'] . $url, 'SSL')); 
		}

            $this->setting();
    }
     public function update() {
		$this->language->load('line/koschtit_gallery');

		$this->document->setTitle($this->language->get('heading_title'));
		
		$this->load->model('line/kigallery');
		
		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateForm()) {
			$this->model_line_kigallery->editKoschtitGallery($this->request->post);
			
			$this->session->data['success'] = $this->language->get('text_success');
			
			$url = '';

			if (isset($this->request->get['page'])) {
				$url .= '&page=' . $this->request->get['page'];
			}
						
			$this->redirect($this->url->link('line/kigallery', 'token=' . $this->session->data['token'] . $url, 'SSL'));
		}
		$this->setting();
	}
        public function delete(){
                       $this->language->load('line/koschtit_gallery');
	
                     $this->document->addStyle('view/stylesheet/ki_gallery.css');
		$this->document->addScript('view/javascript/koschtit_gallery/urlParam.js');
	
                       $this->data['breadcrumbs'][] = array(
                       'text'      => $this->language->get('text_home'),
                       'href'      => $this->url->link('common/home', 'token=' . $this->session->data['token'], 'SSL'),
                       'separator' => false
                       );
                       
                       $this->data['breadcrumbs'][] = array(
                       'text'      => $this->language->get('heading_title'),
                       'href'      => $this->url->link('line/kigallery', 'token=' . $this->session->data['token'], 'SSL'),
                       'separator' => ' :: '
                       );
                                    
                                    
                       $this->load->model('line/kigallery');
                       $this->data['heading_title'] = $this->language->get('heading_title');
             
                      if (isset($this->error['warning'])) {
                                              $this->data['error_warning'] = $this->error['warning'];
                       } else {
                                              $this->data['error_warning'] = '';
                       }

                       $this->data['text_load_images'] = $this->language->get('text_load_images');
                       $this->data['text_change_order'] = $this->language->get('text_change_order');
                       $this->data['text_delete_images'] = $this->language->get('text_delete_images');
                       $this->data['text_manage_folder'] = $this->language->get('text_manage_folder');
                       $this->data['text_gallery_texts'] = $this->language->get('text_gallery_texts');
                       $this->data['text_settings'] = $this->language->get('text_settings');
                       $this->data['text_change'] = $this->language->get('text_change');
                       $this->data['text_delete_success'] = $this->language->get('text_delete_success');
                                                                                                                                          
                       $this->data['delete'] = $this->url->link('line/kigallery/delete', 'token=' . $this->session->data['token'], 'SSL');			
                       $this->data['upload'] = $this->url->link('line/kigallery/upload', 'token=' . $this->session->data['token'], 'SSL');
                       $this->data['gallery_texts'] = $this->url->link('line/kigallery/settings', 'token=' . $this->session->data['token'], 'SSL');
                       $this->data['managefolder'] = $this->url->link('line/kigallery/managefolder', 'token=' . $this->session->data['token'], 'SSL');
                       $this->data['change'] = $this->url->link('line/kigallery/change', 'token=' . $this->session->data['token'], 'SSL'); 
                       $this->data['setting'] = $this->url->link('module/koschtit_gallery', 'token=' . $this->session->data['token'], 'SSL');
                                  
                                    $ki_gallery = "";
                                    $settings = $this->config->get('kigallery_module');
                                    
             foreach($settings as $setting){
                               if(isset($setting['ki_galleries'])){
                                                      $ki_gallery = $setting['ki_galleries'];
                                                      $this->data['ki_galleries'] = $ki_gallery;
                               }
                               if(isset($setting['ki_base'])){
                                                      $basedir = $setting['ki_base'];
                                                      $this->data['basedir'] = $setting['ki_base'];
                                                      }
                                            
                                 if(isset($setting['ki_admin_limit'])){
                                                      $admin_limit = $setting['ki_admin_limit'];
                               } else{
                                                      $admin_limit = 32;
                               }
            }
                                       
           if(!$ki_gallery){
                                                    $this->error['warning'] = $this->language->get('error_setting_galleries');
                                                    $ki_gallery = 'ki_galleries/';
                                                    $this->data['ki_galleries'] = $ki_gallery;
           }
           if(!$basedir){
                                                    $this->error['warning'] = $this->language->get('error_setting_basedir');
                                                    $basedir = 'ki_base/';
                                                    $this->data['ki_basedir'] = $basedir;
           }
               $this->data['folders'] = $this->model_line_kigallery->getFolders($basedir,$ki_gallery);
                if(isset($this->request->get['album'])){
                                                     
                                  if($this->request->get['album'] !=""){
                                                         $album = $this->request->get['album'];
                                  } else{
                                                          $album = $this->data['folders'][0];
                                  }
               }
               else{
                               $album = $this->data['folders'][0];
            }
                               
                     $this->model_line_kigallery->updateFiles($album,'../'.$ki_gallery);   
                                   
                                      $this->data['file_get_empty'] = "";
                                      $this->data['get_gallery_empty'] = "";
                                      $this->data['file_not_found'] = "";
                                      
                  if(isset($this->request->get['file']) && $this->validateForm()){

                                                    $done =  $this->model_line_kigallery->deleteImage($this->request->get);
             
                                     if($done == 'Error'){
                                        $this->data['error_permission'] = sprintf($this->language->get('text_error_permission'),$done);
                                      } else{
                                        $this->data['error_permission']  = '';
                                      }
                  }
                   $to_database = $this->model_line_kigallery->getDatabaseImages($album);
                   $this->data['gallery'] = $this->model_line_kigallery->getDatabaseFolder($album);
                   $this->data['no_thumbs'] = "";
                  
                       $ki_setup_testing = $this->model_line_kigallery->getKiSetup();
                                  
                                  if($ki_setup_testing == 'ErrorSystem'){
                                                          $this->error['error_system'] = $this->language->get('error_system');
                                  }
                                  if($ki_setup_testing == 'ErrorUser'){
                                                          $this->error['error_username'] = $this->language->get('error_username');
                                  }
                                  if($ki_setup_testing == 'ErrorPasswd'){
                                                          $this->error['error_password'] = $this->language->get('error_password');
                                  }
                                  if($ki_setup_testing == 'ErrorDbServer'){
                                                          $this->error['error_db_server'] = $this->language->get('error_db_server');
                                  }
                                  if($ki_setup_testing == 'ErrorDbPrefix'){
                                                          $this->error['error_db_prefix'] = $this->language->get('error_db_prefix');
                                  }
                                  if($ki_setup_testing == 'ErrorDatabase'){
                                                          $this->error['error_database'] = $this->language->get('error_database');
                                  }
             
                       if (isset($this->error['error_username'])) {
                                              $this->data['error_username'] = $this->error['error_username'];
                       
                       } else {
                                              $this->data['error_username'] = '';
                       }   
                       if (isset($this->error['error_system'])) {
                                              $this->data['error_system'] = $this->error['error_system'];
                       
                       } else {
                                              $this->data['error_system'] = '';
                       }   
                       if (isset($this->error['error_password'])) {
                                              $this->data['error_password'] = $this->error['error_password'];
                       
                       } else {
                                              $this->data['error_password'] = '';
                       } 
                       if (isset($this->error['error_database'])) {
                                              $this->data['error_database'] = $this->error['error_database'];
                       
                       } else {
                                              $this->data['error_database'] = '';
                       }

                       if (isset($this->error['error_db_server'])) {
                                              $this->data['error_db_server'] = $this->error['error_db_server'];
                       
                       } else {
                                              $this->data['error_db_server'] = '';
                       }
                       if (isset($this->error['error_db_prefix'])) {
                                              $this->data['error_db_prefix'] = $this->error['error_db_prefix'];
                       
                       } else {
                                              $this->data['error_db_prefix'] = '';
                       }
                       if (isset($this->session->data['success'])) {
                                              $this->data['success'] = $this->session->data['success'];
                       
                                              unset($this->session->data['success']);
                       } else {
                                              $this->data['success'] = '';
                       }
   $total = count($this->data['gallery']);
                       
          $pages = ceil($total/$admin_limit);
          $max = $pages*$admin_limit;
          
          if(isset($this->request->get['page'])){
                    $this->data['page'] = $this->request->get['page'];
                    $page = $this->request->get['page'];
                    
                    $this->data['start'] = ($page-1)*$admin_limit;
                    
                    if($page !=$pages or $pages == $page && $total == $max){
                      $this->data['plimit'] = $page*$admin_limit;
                    }
                    if($page == $pages && $total < $max){
                      $this->data['plimit'] = $total;
                    }
          } else{
                    $this->request->get['page'] = '';
                    $page = 1;
                    $this->data['page'] = 1;
                    $this->data['start'] = 0;
                    if($total >= $admin_limit){
                    $this->data['plimit'] = $admin_limit;
                    } else{
                     if($total > 0){
                        $this->data['plimit'] =  $total;
                        } else{
                                  $this->data['plimit'] = 0;
                        }
                                  
                    }
          } 
                       $pagination = new Pagination();
                       $pagination->total = $total;
                       $pagination->page = $page;
                       $pagination->limit = $admin_limit;
                       $pagination->text = $this->language->get('text_pagination');
                       $pagination->url = $this->url->link('line/kigallery/delete', 'token=' . $this->session->data['token'].'&album='.$album.'&page={page}','SSL');

                       $this->data['pagination'] = $pagination->render();
                       $this->template = 'line/kigallery_delete.tpl';
                       $this->children = array(
                                              'common/header',
                                              'common/footer'
                       );
				
                       $this->response->setOutput($this->render());
                                    
        }
        public function change(){
		$this->language->load('line/koschtit_gallery');
	
                    $this->document->addStyle('view/stylesheet/ki_gallery.css');
		$this->document->addScript('view/javascript/koschtit_gallery/urlParam.js');
	
                       $this->data['breadcrumbs'][] = array(
                       'text'      => $this->language->get('text_home'),
                       'href'      => $this->url->link('common/home', 'token=' . $this->session->data['token'], 'SSL'),
                       'separator' => false
                       );

                       $this->data['breadcrumbs'][] = array(
                       'text'      => $this->language->get('heading_title'),
                       'href'      => $this->url->link('line/kigallery', 'token=' . $this->session->data['token'], 'SSL'),
                       'separator' => ' :: '
                       );    
                                    
                       $this->load->model('line/kigallery');
                       
                       $this->data['heading_title'] = $this->language->get('heading_title');
                       
                       $this->data['text_load_images'] = $this->language->get('text_load_images');
                       $this->data['text_delete_images'] = $this->language->get('text_delete_images');
                       $this->data['text_manage_folder'] = $this->language->get('text_manage_folder');
                       $this->data['text_gallery_texts'] = $this->language->get('text_gallery_texts');
                       $this->data['text_settings'] = $this->language->get('text_settings');
                       $this->data['text_change'] = $this->language->get('text_change');
                       $this->data['text_delete_success'] = $this->language->get('text_delete_success');
                       
                       $this->data['change'] = $this->url->link('line/kigallery/change', 'token=' . $this->session->data['token'], 'SSL');					
                       $this->data['delete'] = $this->url->link('line/kigallery/delete', 'token=' . $this->session->data['token'], 'SSL');
                       $this->data['gallery_texts'] = $this->url->link('line/kigallery/settings', 'token=' . $this->session->data['token'], 'SSL');	
                       $this->data['image'] = $this->url->link('line/kigallery/image', 'token=' . $this->session->data['token'], 'SSL');	
                       $this->data['managefolder'] = $this->url->link('line/kigallery/managefolder', 'token=' . $this->session->data['token'], 'SSL');
                       $this->data['setting'] = $this->url->link('module/koschtit_gallery', 'token=' . $this->session->data['token'], 'SSL');	
                       $this->data['upload'] = $this->url->link('line/kigallery/upload', 'token=' . $this->session->data['token'], 'SSL');
                                              
                       $this->data['button_cancel'] = $this->language->get('button_cancel');
                       $this->data['button_save'] = $this->language->get('button_save');
                       
                       $this->data['cancel'] = $this->url->link('line/kigallery', 'token=' . $this->session->data['token'], 'SSL');
                       $this->data['action'] = $this->url->link('line/kigallery/change', 'token=' . $this->session->data['token'], 'SSL');
                                              $ki_gallery = "";
                                              $ki_galleries = false;
                                              $ki_basedir = false;
                                              
                                    /* Directories names from Setting */
                                    $settings = $this->config->get('kigallery_module');
                                    foreach($settings as $setting){
                                                      if(isset($setting['ki_galleries'])){
                                                      $ki_gallery = $setting['ki_galleries'];
                                                      $ki_galleries = true;
                                                      $this->data['ki_galleries'] = $ki_gallery;
                                                      } else{
                                                      $ki_gallery = 'ki_galleries/';
                                                      $this->data['ki_galleries'] = $ki_gallery;
                                                      }
                                                      
                                                      if(isset($setting['ki_base'])){
                                                      $basedir = $setting['ki_base'];
                                                      $this->data['basedir'] = $setting['ki_base'];
                                                      $ki_basedir = true;
                                                      } else{
                                                      $basedir = 'ki_base/';
                                                      $this->data['basedir'] = $setting['ki_base'];
                                                        }
                                                        if(isset($setting['ki_admin_limit'])){
                                                      $admin_limit = $setting['ki_admin_limit'];
                                                      } else{
                                                      $admin_limit = 32;
                                                      }
                                   }
                                    $ki_setup_testing = $this->model_line_kigallery->getKiSetup();
                                  
                                  if($ki_setup_testing == 'ErrorSystem'){
                                                          $this->error['error_system'] = $this->language->get('error_system');
                                  }
                                  if($ki_setup_testing == 'ErrorUser'){
                                                          $this->error['error_username'] = $this->language->get('error_username');
                                  }
                                  if($ki_setup_testing == 'ErrorPasswd'){
                                                          $this->error['error_password'] = $this->language->get('error_password');
                                  }
                                  if($ki_setup_testing == 'ErrorDatabase'){
                                                          $this->error['error_database'] = $this->language->get('error_database');
                                  }
                                  if($ki_setup_testing == 'ErrorDbServer'){
                                                          $this->error['error_db_server'] = $this->language->get('error_db_server');
                                  }
                                  if($ki_setup_testing == 'ErrorDbPrefix'){
                                                          $this->error['error_db_prefix'] = $this->language->get('error_db_prefix');
                                  }
                                  
                                  if($ki_galleries == false){
                                                    $this->error['warning'] = $this->language->get('error_setting_galleries');
                                  }
                                  if($ki_basedir == false){
                                                    $this->error['warning'] = $this->language->get('error_setting_basedir');
                                  }
                                      $this->data['folders'] = $this->model_line_kigallery->getFolders($basedir,$ki_gallery);
                                   
                                     
                                      $this->data['file_get_empty'] = "";
                                      $this->data['get_gallery_empty'] = "";
                                      $this->data['file_not_found'] = "";
                                  
         if(isset($this->request->get['album'])){    
                                   $this->model_line_kigallery->updateFiles($this->request->get['album'],'../'.$ki_gallery);    
                                   }else{
                                   $this->model_line_kigallery->updateFiles($this->data['folders'][0],'../'.$ki_gallery); 
                                }
          // Search imagelist from Database
          if(isset($this->request->get['album'])){
                    $album = $this->request->get['album'];
                    $this->data['album'] = $this->request->get['album'];
          }
          else{
                    $album = $this->data['folders'][0];
                    $this->data['album'] = $this->data['folders'][0];
}
                                              if(isset($this->request->post['image_change']) && $this->validateForm()){
                                                           $this->model_line_kigallery->editImageOrder($this->request->post);
                                       
                                                $this->redirect($this->url->link('line/kigallery/change','token=' . $this->session->data['token'].'&success=1', 'SSL'));
                                             
                                              }
              if(isset($this->request->get['album'])){
                  $this->data['gallery'] = $this->model_line_kigallery->getDatabaseFolder($album);
                  } else{
                    $this->data['gallery'] = $this->model_line_kigallery->getDatabaseImage();
                       }

           
                                   
		if (isset($this->session->data['success'])) {
			$this->data['success'] = $this->session->data['success'];
		
			unset($this->session->data['success']);
		} else {
			$this->data['success'] = '';
		}      
		if (isset($this->session->data['warning'])) {
			$this->data['error_warning'] = $this->session->data['warning'];
		
			unset($this->session->data['warning']);
		} else {
			$this->data['error_warning'] = '';
                                              }   
		if (isset($this->error['error_username'])) {
			$this->data['error_username'] = $this->error['error_username'];
		
		} else {
			$this->data['error_username'] = '';
                                              }   
		if (isset($this->error['error_system'])) {
			$this->data['error_system'] = $this->error['error_system'];
		
		} else {
			$this->data['error_system'] = '';
                                              }   
		if (isset($this->error['error_password'])) {
			$this->data['error_password'] = $this->error['error_password'];
		
		} else {
			$this->data['error_password'] = '';
                                              } 
		if (isset($this->error['error_database'])) {
			$this->data['error_database'] = $this->error['error_database'];
		
		} else {
			$this->data['error_database'] = '';
                                              }
		if (isset($this->error['error_db_server'])) {
			$this->data['error_db_server'] = $this->error['error_db_server'];
		
		} else {
			$this->data['error_db_server'] = '';
                                              }
		if (isset($this->error['error_db_prefix'])) {
			$this->data['error_db_prefix'] = $this->error['error_db_prefix'];
		
		} else {
			$this->data['error_db_prefix'] = '';
                                              }

           
          $total = count($this->data['gallery']);
          $pages = ceil($total/$admin_limit);
          $max = $pages*$admin_limit;
               if(isset($this->request->get['page'])){
                    $this->data['page'] = $this->request->get['page'];
                    $page = $this->request->get['page'];
                    
                    $this->data['start'] = ($page-1)*$admin_limit;
                    
                    if($page !=$pages or $pages == $page && $total == $max){
                      $this->data['plimit'] = $page*$admin_limit;
                    }
                    if($page == $pages && $total < $max){
                      $this->data['plimit'] = $total;
                    }
          } else{
                    $this->request->get['page'] = '';
                    $page = 1;
                    $this->data['page'] = 1;
                    $this->data['start'] = 0;
                    if($total >= $admin_limit){
                    $this->data['plimit'] = $admin_limit;
                    } else{
                     if($total > 0){
                        $this->data['plimit'] =  $total;
                        } else{
                                  $this->data['plimit'] = 0;
                        }
                                  
                    }
          }     
                                              $pagination = new Pagination();
                                              $pagination->total = $total;
                                              $pagination->page = $page;
                                              $pagination->limit = $admin_limit;
                                              $pagination->text = $this->language->get('text_pagination');
                                              $pagination->url = $this->url->link('line/kigallery/change', 'token=' . $this->session->data['token'].'&album='.$album.'&page={page}','SSL');
                       
                       $this->data['pagination'] = $pagination->render();
                              
                       $this->template = 'line/kigallery_change.tpl';
                       $this->children = array(
                                              'common/header',
                                              'common/footer'
                       );
                                                                     
                       $this->response->setOutput($this->render());
                                    
     }
      public function upload() {
                       $this->language->load('line/koschtit_gallery');
                                    
              $this->document->addStyle('view/stylesheet/ki_gallery.css');

                       $this->data['breadcrumbs'][] = array(
                       'text'      => $this->language->get('text_home'),
                       'href'      => $this->url->link('common/home', 'token=' . $this->session->data['token'], 'SSL'),
                       'separator' => false
                       );

                       $this->data['breadcrumbs'][] = array(
                       'text'      => $this->language->get('heading_title'),
                       'href'      => $this->url->link('line/kigallery', 'token=' . $this->session->data['token'], 'SSL'),
                       'separator' => ' :: '
                       );
                        $this->data['warning'] = "";            
                       $this->load->model('line/kigallery');
                       
                       $ki_gallery = "";
                       $basedir = '';
                       $settings = $this->config->get('kigallery_module');
                       foreach($settings as $setting){
                                              if(isset($setting['status'])){
                                                                                            $ki_gallery = $setting['ki_galleries'];
                                                                                            $this->data['ki_galleries'] = $ki_gallery;
                                                                                            $basedir = $setting['ki_base'];
                                                                                            $this->data['ki_basedir'] = $basedir;
                                              }
                       
                       $maximwidth = $setting['ki_maxim_pic_width'];
                       $maximheight = $setting['ki_maxim_pic_width'];     
                       $mixname = $setting['ki_mixname'];     
                         
                       $this->data['watermark_hori'] = $setting['ki_watermark_hori'];
                       $this->data['watermark_vert'] = $setting['ki_watermark_vert'];
                       $this->data['watermark_size'] = $setting['ki_watermark_size'];
                       }
                  
                       $this->data['heading_title'] = $this->language->get('heading_title');
                       
                       $this->data['text_error'] = $this->language->get('text_error');
                       $this->data['text_image_files'] = $this->language->get('text_image_files');
                       $this->data['text_oversized_thumb'] = $this->language->get('text_oversized_thumb');
                       
                       $this->data['text_change'] = $this->language->get('text_change');
                       $this->data['text_load_images'] = $this->language->get('text_load_images');
                       $this->data['text_folder_root'] = $this->language->get('text_folder_root');
                        $this->data['text_folders_in'] = sprintf($this->language->get('text_folders_in'),$ki_gallery);
                       $this->data['text_manage_folder'] = $this->language->get('text_manage_folder');
                       $this->data['text_gallery_texts'] = $this->language->get('text_gallery_texts');
                       $this->data['text_delete_images'] = $this->language->get('text_delete_images');
                       $this->data['text_settings'] = $this->language->get('text_settings');
                       $this->data['entry_upload'] = $this->language->get('entry_upload');
                       $this->data['entry_watermark'] = $this->language->get('entry_watermark');
                       $this->data['entry_add_watermark'] = $this->language->get('entry_add_watermark');
                       $this->data['entry_rotate'] = $this->language->get('entry_rotate');
                       $this->data['entry_maximum_image_size'] = $this->language->get('entry_maximum_image_size');
                       
                       $this->data['entry_sort_order'] = $this->language->get('entry_sort_order');                                                                                                                   
                       $this->data['change'] = $this->url->link('line/kigallery/change', 'token=' . $this->session->data['token'], 'SSL');							
                       $this->data['delete'] = $this->url->link('line/kigallery/delete', 'token=' . $this->session->data['token'], 'SSL');
                       $this->data['upload'] = $this->url->link('line/kigallery/upload', 'token=' . $this->session->data['token'], 'SSL');
                       $this->data['gallery_texts'] = $this->url->link('line/kigallery/settings', 'token=' . $this->session->data['token'], 'SSL');
                       $this->data['managefolder'] = $this->url->link('line/kigallery/managefolder', 'token=' . $this->session->data['token'], 'SSL');
                       $this->data['setting'] = $this->url->link('module/koschtit_gallery', 'token=' . $this->session->data['token'], 'SSL');
                       $this->data['edit_image'] = $this->url->link('line/kigallery/image', 'token=' . $this->session->data['token'], 'SSL');
                       
                       $this->data['action'] = $this->url->link('line/kigallery/upload', 'token=' . $this->session->data['token'], 'SSL');
                       $this->data['cancel'] = $this->url->link('line/kigallery', 'token=' . $this->session->data['token'], 'SSL');
                       
                       $this->data['button_save'] = $this->language->get('button_save');
                       $this->data['button_cancel'] = $this->language->get('button_cancel');
                       
                       $this->data['add'] = "";
                       
                                    if(isset($this->request->get['add'])){
                                                      $this->data['add'] = $this->request->get['add'];
                                    }
                     $pfolder = '';
                       if(isset($this->request->get['folder'])){
                                              $pfolder = $this->request->post['folder'];
                       }


                       
                                           $error_list = array("403"=>sprintf($this->language->get('error_not_permission_galleries'),$ki_gallery),
                                                                      "404"=>sprintf($this->language->get('error_directory_not_found'),$ki_gallery),
                                                                      "404fi"=>$this->language->get('error_image_not_found'),
                                                                      "filename"=>$this->language->get('error_image_filename'),
                                                                      "403f"=>sprintf($this->language->get('error_not_permission_galleries'),$ki_gallery.$pfolder),
                                                                      "404f"=>sprintf($this->language->get('error_folder_directory_not_found'),$ki_gallery.$pfolder));

                       if(isset($this->request->post['folder']) && $this->validateForm()){
                                              $done =  $this->model_line_kigallery->addImage($this->request->post,$ki_gallery,$basedir,$mixname,$maximwidth,$maximheight);
                                      
                                      if(!strpos($done,'/')){
                                                  $this->session->data['warning'] = $error_list[$done];
                                        }else{
                                                $this->redirect($this->url->link('line/kigallery/image','image='.$done.'&token=' . $this->session->data['token'].'&success=1', 'SSL'));
                                           }         
                                      }
         
                                     
                                $galleries = array();
                                $this->data['folders'] = "";
                                $folders = array();
                                    if($ki_gallery !=""){
                                                      $folders= $this->model_line_kigallery->getFolders($basedir,$ki_gallery);
                                                      if(count($folders) > 0){
                                                                $this->data['folders']  = $folders;
                                                        } else{
                                                          $this->session->data['warning'] = $this->language->get('notice_empty');
                                                          }
                                                                
                                    }
                   $this->data['to_album'] = "";
                   $this->data['sort_order'] = 0;
                   if(isset($this->request->get['to'])){
                                     $this->data['to_album'] = $this->request->get['to'];
                   }
                   else{
                                      $this->data['to_album'] = 0;
                     }
                             if(count($folders) > 0){
 		$this->data['sort_order'] = $this->model_line_kigallery->getImageOrder($folders[$this->data['to_album']]);
                               }               
                                  if(!$ki_gallery){
                                                    $this->error['warning'] = $this->language->get('error_setting_galleries');
                                                    $ki_gallery = 'ki_galleries/';
                                                    $this->data['ki_galleries'] = $ki_gallery;
                                  }
                                  if(!$basedir){
                                                    $this->error['warning'] = $this->language->get('error_setting_basedir');
                                                    $basedir = 'ki_base/';
                                                    $this->data['ki_basedir'] = $basedir;
           }
           
              $ki_setup_testing = $this->model_line_kigallery->getKiSetup();
                                  
                                  if($ki_setup_testing == 'ErrorSystem'){
                                                          $this->error['error_system'] = $this->language->get('error_system');
                                  }
                                  if($ki_setup_testing == 'ErrorUser'){
                                                          $this->error['error_username'] = $this->language->get('error_username');
                                  }
                                  if($ki_setup_testing == 'ErrorPasswd'){
                                                          $this->error['error_password'] = $this->language->get('error_password');
                                  }
                                  if($ki_setup_testing == 'ErrorDatabase'){
                                                          $this->error['error_database'] = $this->language->get('error_database');
                                  }
                                  if($ki_setup_testing == 'ErrorDbServer'){
                                                          $this->error['error_db_server'] = $this->language->get('error_db_server');
                                  }
                                  if($ki_setup_testing == 'ErrorDbPrefix'){
                                                          $this->error['error_db_prefix'] = $this->language->get('error_db_prefix');
                                  }
             
		if (isset($this->error['error_username'])) {
			$this->data['error_username'] = $this->error['error_username'];
		
		} else {
			$this->data['error_username'] = '';
                                              }   
		if (isset($this->error['error_system'])) {
			$this->data['error_system'] = $this->error['error_system'];
		
		} else {
			$this->data['error_system'] = '';
                                              }   
		if (isset($this->error['error_password'])) {
			$this->data['error_password'] = $this->error['error_password'];
		
		} else {
			$this->data['error_password'] = '';
                                              } 
		if (isset($this->error['error_database'])) {
			$this->data['error_database'] = $this->error['error_database'];
		
		} else {
			$this->data['error_database'] = '';
                                              }
		if (isset($this->error['error_db_server'])) {
			$this->data['error_db_server'] = $this->error['error_db_server'];
		
		} else {
			$this->data['error_db_server'] = '';
                                              }
		if (isset($this->error['error_db_prefix'])) {
			$this->data['error_db_prefix'] = $this->error['error_db_prefix'];
		
		} else {
			$this->data['error_db_prefix'] = '';
                                              }
              if(isset($this->error['image_not_found'])){
                                $this->data['image_not_found'] = $this->error['image_not_found'];
              } else{
                        $this->data['image_not_found'] = '';
              }
              if(isset($this->error['not_permission'])){
                                $this->data['not_permission'] = $this->error['not_permission'];
              } else{
                        $this->data['not_permission'] = '';
              }
              if(isset($this->error['module_not_found'])){
                                $this->data['module_not_found'] = $this->error['module_not_found'];
              } else{
                        $this->data['module_not_found'] = '';
              }
		if (isset($this->session->data['success'])) {
			$this->data['success'] = $this->session->data['success'];
		
			unset($this->session->data['success']);
		} else {
			$this->data['success'] = '';
		}
		
                        if(isset($this->session->data['warning'])){
                                               $this->data['warning'] =$this->session->data['warning'];
                                              $this->session->data['warning'] = '';
                        } else{
                                               $this->data['warning'] = '';
                        }
		$this->template = 'line/kigallery_upload.tpl';
		$this->children = array(
			'common/header',
			'common/footer'
		);
				
		$this->response->setOutput($this->render());
                  }
public function image() {
		$this->language->load('line/koschtit_gallery');
                                    
                $this->document->addStyle('view/stylesheet/ki_gallery.css');
		$this->document->addScript('view/javascript/koschtit_gallery/urlParam.js');

   		$this->data['breadcrumbs'][] = array(
       		'text'      => $this->language->get('text_home'),
                                           'href'      => $this->url->link('common/home', 'token=' . $this->session->data['token'], 'SSL'),
      		'separator' => false
   		);

   		$this->data['breadcrumbs'][] = array(
       		'text'      => $this->language->get('heading_title'),
                                              'href'      => $this->url->link('line/kigallery', 'token=' . $this->session->data['token'], 'SSL'),
      		'separator' => ' :: '
   		);
                    
                       $this->data['heading_title'] = $this->language->get('heading_title');
                       
                       $this->data['text_admin_comment'] = $this->language->get('text_admin_comment');
                       $this->data['text_add_imageframe'] = $this->language->get('text_add_imageframe');
                       $this->data['text_add_watermark'] = $this->language->get('text_add_watermark');
                       $this->data['text_found_watermark'] = $this->language->get('text_found_watermark');
                       $this->data['entry_add_imageframe'] = $this->language->get('entry_add_imageframe');
                       $this->data['entry_add_watermark'] = $this->language->get('entry_add_watermark');
                       $this->data['text_change'] = $this->language->get('text_change');
                       $this->data['text_change_filesize'] = $this->language->get('text_change_filesize');
                       $this->data['text_comment'] = $this->language->get('text_comment');
                       $this->data['text_about_delete_comment'] = $this->language->get('text_about_delete_comment');
                       $this->data['text_del'] = $this->language->get('text_del');
                       $this->data['text_delete'] = $this->language->get('text_delete');
                       $this->data['text_delete_comment'] = $this->language->get('text_delete_comment');
                       $this->data['text_delete_images'] = $this->language->get('text_delete_images');
                       $this->data['text_edit'] = $this->language->get('text_edit');
                       $this->data['text_edit_admin_comment'] = $this->language->get('text_edit_admin_comment');
                       $this->data['text_edit_vcomment'] = $this->language->get('text_edit_vcomment');
                       $this->data['text_filesize'] = $this->language->get('text_filesize');
                       $this->data['text_gallery_texts'] = $this->language->get('text_gallery_texts');
                       $this->data['text_height'] = $this->language->get('text_height');
                       $this->data['text_load_images'] = $this->language->get('text_load_images');
                       $this->data['text_manage_folder'] = $this->language->get('text_manage_folder');
                       $this->data['text_no_comment'] = $this->language->get('text_no_comment');
                       $this->data['text_no_comments'] = $this->language->get('text_no_comments');
                       $this->data['text_pic_height'] = $this->language->get('text_pic_height');
                       $this->data['text_pic_width'] = $this->language->get('text_pic_width');
                       $this->data['text_picture'] = $this->language->get('text_picture');
                       $this->data['text_settings'] = $this->language->get('text_settings');
                       $this->data['text_viewercomments'] = $this->language->get('text_viewercomments');
                       $this->data['text_width'] = $this->language->get('text_width');
                       $this->data['text_exif_data'] = $this->language->get('text_exif_data');
                       $this->data['text_exif_filename'] = $this->language->get('text_exif_filename');
                       $this->data['text_exif_filedatetime'] = $this->language->get('text_exif_filedatetime');
                       $this->data['text_exif_datetimeoriginal']  = $this->language->get('text_exif_datetimeoriginal'); 
                       $this->data['text_exif_filesize']= $this->language->get('text_exif_filesize');
                       $this->data['text_exif_filetype'] = $this->language->get('text_exif_filetype');
                       $this->data['text_exif_mimetype']   = $this->language->get('text_exif_mimetype');
                       $this->data['text_exif_make']   = $this->language->get('text_exif_model');
                       $this->data['text_exif_model']   = $this->language->get('text_exif_makernote');
                       $this->data['text_exif_makernote']  = $this->language->get('text_exif_makernote');
                       $this->data['text_exif_artist']  = $this->language->get('text_exif_artist');
                       $this->data['text_exif_orientation']   = $this->language->get('text_exif_orientation');
                       $this->data['text_exif_xresolution']   = $this->language->get('text_exif_yresolution');
                       $this->data['text_exif_yresolution']   = $this->language->get('text_exif_resolutionunit');
                       $this->data['text_exif_resolutionunit']   = $this->language->get('text_exif_resolutionunit');
                       $this->data['text_exif_isospeedratings'] = $this->language->get('text_exif_isospeedratings');
                       $this->data['text_exif_software']   = $this->language->get('text_exif_software');
                       $this->data['text_exif_flashpixversion']   = $this->language->get('text_exif_flashpixversion');
                       $this->data['text_exif_exposuremode']   = $this->language->get('text_exif_exposuremode');
                       $this->data['text_exif_whitebalance']   = $this->language->get('text_exif_whitebalance');
                       $this->data['text_exif_digitalzoomratio']   = $this->language->get('text_exif_digitalzoomratio');
                       
                       $this->data['entry_add_admin_comment'] = $this->language->get('entry_add_admin_comment');
                       $this->data['text_edit_comment'] = $this->language->get('text_edit_comment');
                       $this->data['entry_folder'] = $this->language->get('entry_folder');
                       $this->data['entry_writer'] = $this->language->get('entry_writer');
                       $this->data['entry_post'] = $this->language->get('entry_post');
                       
                       $this->data['button_cancel'] = $this->language->get('button_cancel');
                       $this->data['button_gallery_images'] = $this->language->get('button_gallery_images');
                       $this->data['button_gallery_texts'] = $this->language->get('button_gallery_texts');
                       $this->data['button_page_texts'] = $this->language->get('button_page_texts');
                       $this->data['button_save'] = $this->language->get('button_save');
                       
                       $this->data['tab_comments'] = $this->language->get('tab_comments');
                       $this->data['tab_crop'] = $this->language->get('tab_crop');
                       $this->data['tab_general'] = $this->language->get('tab_general');
                       $this->data['tab_exifdata'] = $this->language->get('tab_exifdata');
                       $this->data['tab_resize'] = $this->language->get('tab_resize');
                       $this->data['tab_watermark'] = $this->language->get('tab_watermark');
                       $this->data['tab_imageframe'] = $this->language->get('tab_imageframe');
                       
                       $this->data['action'] = $this->url->link('line/kigallery/image', 'image='.$this->request->get['image'].'&token=' . $this->session->data['token'], 'SSL');				
                       $this->data['cancel'] = $this->url->link('line/kigallery', 'token=' . $this->session->data['token'], 'SSL');	
                       $this->data['change'] = $this->url->link('line/kigallery/change', 'token=' . $this->session->data['token'], 'SSL');
                       $this->data['delete'] = $this->url->link('line/kigallery/delete', 'token=' . $this->session->data['token'], 'SSL');
                       $this->data['delete_image'] = $this->url->link('line/kigallery/deleteimage','token=' . $this->session->data['token'], 'SSL');	
                       $this->data['edit_image'] = $this->url->link('line/kigallery/image', 'token=' . $this->session->data['token'], 'SSL');	
                       $this->data['gallery_images'] = $this->url->link('line/kigallery/upload', 'token=' . $this->session->data['token'], 'SSL');
                       $this->data['gallery_texts'] = $this->url->link('line/kigallery/settings', 'token=' . $this->session->data['token'], 'SSL');
                       $this->data['managefolder'] = $this->url->link('line/kigallery/managefolder', 'token=' . $this->session->data['token'], 'SSL');
                       $this->data['setting'] = $this->url->link('module/koschtit_gallery', 'token=' . $this->session->data['token'], 'SSL');	
                       $this->data['upload'] = $this->url->link('line/kigallery/upload', 'token=' . $this->session->data['token'], 'SSL');
  
                                   
                                    if(isset($this->request->get['success'])){
                                     $this->session->data['success'] = $this->language->get('text_upload_success');
                                    }
		$this->load->model('line/kigallery');
                                    
                                    $ki_gallery = "";
                                    $settings = $this->config->get('kigallery_module');
                                    foreach($settings as $setting){
                                                      if(isset($setting['ki_galleries'])){
                                                      $ki_gallery = $setting['ki_galleries'];
                                                      }
                                                      if(isset($setting['ki_base'])){
                                                      $ki_base = $setting['ki_base'];
                                                      }
                                                                                                    
                                                                $this->data['watermark_hori'] = $setting['ki_watermark_hori'];
                                                                $this->data['watermark_vert'] = $setting['ki_watermark_vert'];
                                                                $this->data['watermark_size'] = $setting['ki_watermark_size'];
                                    }
                  
                                  if(!$ki_gallery){
                                                    $this->error['warning'] = $this->language->get('error_setting_galleries');
                                                    $ki_gallery = 'ki_galleries/';
                                  }
                                  if(!$ki_base){
                                                    $this->error['warning'] = $this->language->get('error_setting_basedir');
                                                    $ki_base = 'ki_base/';
                                  }
		$this->load->model('localisation/language');
		
		$this->data['languages'] = $this->model_localisation_language->getLanguages();
                    $this->data['folders'] = $this->model_line_kigallery->getFolders();
		$this->load->model('line/kigallery');
		
                                    $this->data['gallerydir'] = $ki_gallery;
                                    $this->data['vcomments'] = array();
                                    $this->data['comment'] = "";
                                    
                                   $this->data['image_info'] = ''; 
                                    if(isset($this->request->get['image']) && $ki_gallery !=""){
                                           
                                               $parts = explode('/',$this->request->get['image']);   
                                                 $this->data['image']=$this->request->get['image'];
                                      
                                                  $this->data['image_info'] = $this->model_line_kigallery->getImageInfo($parts);
                                                  $dir = $parts[0];
                                                  $this->data['folder'] = $dir.'/';
                                                  $fpart = explode('.',$parts[1]);
                                                  $vfile = str_replace($fpart[1],'txt',$parts[1]);
                                                  $i=0;
                                              
                                               foreach($this->data['languages'] as $language){
                                                  $file[$language['language_id']] = str_replace('.'.$fpart[1],'_'.$language['language_id'].'.txt',$parts[1]);
                                                  $i++;
                                               }
                                               $keys = array_keys($file);
                                               $commentfile = '../'.$ki_gallery.$dir.'/comments/'.$fpart[0].'_'.$keys[0].'.txt';
                                               $query = "";
                                               
	if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateForm()) {
                                              $done = '';
                        if(isset($this->request->post['change_folder'])){
                                          
                                      $done =   $this->model_line_kigallery->changeImageFolder($this->request->post,$ki_gallery,$ki_base);
                                        $plod = explode("/",$this->request->get['image']);
                                        $change_folder = $this->request->post['change_folder'].'/'.$plod[1];
         }
                   if($done !="Error"){
                              if(isset($this->request->post['add_kigallery_comment'])){
                                        $this->model_line_kigallery->addComment($this->request->post,$ki_gallery,$dir,$fpart[0]);
                         }
                        if(isset($this->request->post['addwatermark'])){
                                        $this->model_line_kigallery->addWatermark($this->request->post,$ki_gallery,$ki_base);
                              }
                              if(isset($this->request->post['edit_kigallery'])){
                                        if(!isset($this->request->post['delete_comment'])){
                                        $this->model_line_kigallery->editComment($this->request->post);
                                        }
                                        if(isset($this->request->post['delete_comment'])){
                                                  $this->model_line_kigallery->deleteComment($this->request->post);
                                        }
                              }
                               
                    
                              if(isset($this->request->post['edit_vcomment'])){
                                        $this->model_line_kigallery->editViewerComment($this->request->post['edit_vcomment']);
                              }
                              if(isset($this->request->post['delete_vcomment'])){
                                        $this->model_line_kigallery->deleteViewerComment($this->request->post['delete_vcomment']);
                              }
                              if(isset($this->request->post['width']) && $this->request->post['width'] > 0 && isset($this->request->post['height']) && $this->request->post['height'] > 0){
                                        $this->model_line_kigallery->imageResize($this->request->post,$ki_gallery,$dir,$parts[1]);
                              }
			$this->session->data['success'] = $this->language->get('text_success');
	
                   if(isset($change_folder)){   
                      $this->redirect($this->url->link('line/kigallery/image', 'image='.$change_folder.'&token=' . $this->session->data['token'], 'SSL')); 
                   }
                   else{   
                      $this->redirect($this->url->link('line/kigallery/image', 'image='.$this->request->get['image'].'&token=' . $this->session->data['token'], 'SSL')); 
                   } 
            } else{
                                   $this->error['warning'] = $this->language->get('error_folder_change');
            }
            
                                                      }
                                                   
                                                         $this->data['comment'] = $this->model_line_kigallery->getComment($this->data['image_info']['folder'],$this->data['image_info']['mixname']);   
                                                     
                                                     $this->data['vcomments'] = $this->model_line_kigallery->getComments($this->data['image_info']['folder'],$this->data['image_info']['mixname']);
            }
	
         
	           $this->data['delete_vcomm'] = $this->url->link('line/kigallery/image', 'image='.$this->request->get['image'].'&token=' . $this->session->data['token'], 'SSL');
	           $this->data['edit_vcomm'] = $this->url->link('line/kigallery/image', 'image='.$this->request->get['image'].'&token=' . $this->session->data['token'], 'SSL');
 		if(isset($this->error['warning'])) {
			$this->data['error_warning'] = $this->error['warning'];
		} else {
			$this->data['error_warning'] = '';
		}

		if(isset($this->session->data['success'])) {
			$this->data['success'] = $this->session->data['success'];
		
			unset($this->session->data['success']);
		} else {
			$this->data['success'] = '';
		}
		
		$this->template = 'line/kigallery_image_form.tpl';
		$this->children = array(
			'common/header',
			'common/footer'
		);
				
		$this->response->setOutput($this->render());
   }
   public function managefolder() {
                                    
		$this->language->load('line/koschtit_gallery');
                    $this->document->addStyle('view/stylesheet/ki_gallery.css');
		$this->load->model('line/kigallery');
                     
                       $this->document->addScript('view/javascript/koschtit_gallery/urlParam.js');               
                       $this->data['breadcrumbs'][] = array(
                       'text'      => $this->language->get('text_home'),
                       'href'      => $this->url->link('common/home', 'token=' . $this->session->data['token'], 'SSL'),
                       'separator' => false
                       );
                       
                       $this->data['breadcrumbs'][] = array(
                       'text'      => $this->language->get('heading_title'),
                       'href'      => $this->url->link('line/kigallery', 'token=' . $this->session->data['token'], 'SSL'),
                       'separator' => ' :: '
                       );
                  
                                    $ki_gallery = "";
                                    $settings = $this->config->get('kigallery_module');
                                    foreach($settings as $setting){
                                                      if(isset($setting['ki_galleries'])){
                                                                        $ki_gallery = $setting['ki_galleries'];
                                                                        $this->data['ki_galleries'] = $ki_gallery;
                                                      }
                                                      if(isset($setting['ki_base'])){
                                                                        $basedir = $setting['ki_base'];
                                                                        $this->data['basedir'] = $setting['ki_base'];
                                                      }
                                   }
                                  if(!$ki_gallery){
                                                    $this->error['warning'] = $this->language->get('error_setting_galleries');
                                                    $ki_gallery = 'ki_galleries/';
                                                    $this->data['ki_galleries'] = $ki_gallery;
                                  }
                                  if(!$basedir){
                                                    $this->error['warning'] = $this->language->get('error_setting_basedir');
                                                    $basedir = 'ki_base/';
                                                    $this->data['basedir'] = $setting['ki_base'];
           }
                                  
                       $this->data['heading_title'] = $this->language->get('heading_title');
                       
                       $this->data['text_error'] = $this->language->get('text_error');
                       $this->data['text_create_directory'] = $this->language->get('text_create_directory');
                       $this->data['text_image_files'] = $this->language->get('text_image_files');
                       $this->data['text_oversized_thumb'] = $this->language->get('text_oversized_thumb');
                       
                       $this->data['text_change'] = $this->language->get('text_change');
                       $this->data['text_create_folder'] = $this->language->get('text_create_folder');
                       $this->data['text_delete_images'] = $this->language->get('text_delete_images');
                       $this->data['text_disabled'] = $this->language->get('text_disabled');                
                       $this->data['text_disk_usage'] = $this->language->get('text_disk_usage');     
                       $this->data['text_enabled'] = $this->language->get('text_enabled');
                       $this->data['text_no_results'] = $this->language->get('text_no_results');  
                       $this->data['text_folders_in'] = sprintf($this->language->get('text_folders_in'),$ki_gallery);
                       $this->data['text_gallery_texts'] = $this->language->get('text_gallery_texts');
                       $this->data['text_image_files'] = $this->language->get('text_image_files');
                       $this->data['text_load_images'] = $this->language->get('text_load_images');                   
                       $this->data['text_manage_folder'] = $this->language->get('text_manage_folder');
                       $this->data['text_settings'] = $this->language->get('text_settings');
                       $this->data['text_photoalbum'] = $this->language->get('text_photoalbum');
                       $this->data['text_database'] = $this->language->get('text_database');
                       $this->data['text_edit_folder'] = $this->language->get('text_edit_folder');
                       
                       $this->data['entry_create_folder'] = $this->language->get('entry_create_folder');
                       $this->data['entry_album_name'] = $this->language->get('entry_album_name');
                       $this->data['entry_directory'] = $this->language->get('entry_directory');
                       $this->data['entry_sort_order'] = $this->language->get('entry_sort_order');
                       $this->data['entry_status'] = $this->language->get('entry_status');
                       
                       $this->data['button_cancel'] = $this->language->get('button_cancel');
                       $this->data['button_create_folder'] = $this->language->get('button_create_folder');
                       $this->data['button_delete_folder'] = $this->language->get('button_delete_folder');
                       $this->data['button_empty_folder'] = $this->language->get('button_empty_folder');   
                       $this->data['button_images'] = $this->language->get('button_images');  
                       $this->data['button_save'] = $this->language->get('button_save');
                       $this->data['button_save_list'] = $this->language->get('button_save_list');
                       $this->data['button_update_folder_size'] = $this->language->get('button_update_folder_size');
                       $this->data['button_update_last_modified'] = $this->language->get('button_update_last_modified');
                                                                                            
                       $this->data['change'] = $this->url->link('line/kigallery/change', 'token=' . $this->session->data['token'], 'SSL');							
                       $this->data['delete'] = $this->url->link('line/kigallery/delete', 'token=' . $this->session->data['token'], 'SSL');
                       $this->data['edit_image'] = $this->url->link('line/kigallery/image', 'token=' . $this->session->data['token'], 'SSL');
                       $this->data['gallery_texts'] = $this->url->link('line/kigallery/settings', 'token=' . $this->session->data['token'], 'SSL');
                       $this->data['managefolder'] = $this->url->link('line/kigallery/managefolder', 'token=' . $this->session->data['token'], 'SSL');
                       $this->data['setting'] = $this->url->link('module/koschtit_gallery', 'token=' . $this->session->data['token'], 'SSL');
                       $this->data['upload'] = $this->url->link('line/kigallery/upload', 'token=' . $this->session->data['token'], 'SSL');
                       $this->data['token'] = $this->session->data['token'];
                       $this->data['folders'] = $this->model_line_kigallery->getFolders();
                       $this->data['album'] = "";     
                                                  
         if(isset($this->request->get['album'])){    
                                   $this->model_line_kigallery->updateFiles($this->request->get['album'],'../'.$ki_gallery);    
                                   }else{
                                   if(isset($this->data['folders'][0])){
                                   $this->model_line_kigallery->updateFiles($this->data['folders'][0],'../'.$ki_gallery); 
                                   }
         }
                    if(isset($this->request->get['album'])){
                              $album = $this->request->get['album'];
                              $this->data['album'] = $this->request->get['album'];
                    }
                    else{
                              $album = 0;
                              if(isset($this->data['folders'][0])){
                              $this->data['album'] = $this->data['folders'][0];
                              }
                      }
                       $this->data['folder_info'] = $this->model_line_kigallery->getFolderInfo();          
                       
                       $folder_info =  $this->data['folder_info']; 
                       $this->load->model('localisation/language');
                       $this->data['success']  = "";
                       $this->data['error']  = "";
                       $this->data['images'] = "";
                       $this->data['folder'] = "";
                       $this->data['warning'] = "";
                       $this->data['error_list']  = "";
                       $this->data['error_modify']  = "";
                       $this->data['error_sizes'] = "";
                       $this->data['folder_name'] = "";
                       
                       if(isset($this->request->get['images'])){
                              $this->data['dir_images'] = $this->model_line_kigallery->getDatabaseImages($this->request->get['images']);
                            
                                              
                                              $this->data['images'] = $this->request->get['images'];
                                              
                                              $this->data['folder'] = $this->request->get['images'];
                       
                       }
                       $pfolder = '';
                       if(isset($this->request->post['editfolder'])){
                        $info = $this->request->post['editfolder'];               
                                            $query = $this->db->query("SELECT * FROM " . DB_PREFIX ."koschtit_gallery_folder WHERE folder_id = '".$info['folder_id']."'");
                                            $result = $query->row;
                                              $pfolder = $result['name'];
                       }
                       if(isset($this->request->get['rmdir'])){
                                              $pfolder = $this->request->get['rmdir'];
                       }
                       if(isset($this->request->get['empty'])){
                                              $pfolder = $this->request->get['empty'];
                       }
                       if(isset($this->request->post['createfolder'])){
                                              $pfolder = $this->request->post['createfolder'];
                       }

                       $this->data['languages'] = $this->model_localisation_language->getLanguages();
                                           $error_list = array("403"=>sprintf($this->language->get('error_not_permission_galleries'),$ki_gallery),
                                                                      "404"=>sprintf($this->language->get('error_directory_not_found'),$ki_gallery),
                                                                      "403f"=>sprintf($this->language->get('error_not_permission_galleries'),$ki_gallery.$pfolder),
                                                                      "404f"=>sprintf($this->language->get('error_folder_directory_not_found'),$ki_gallery.$pfolder),
                                                                      "400"=>sprintf($this->language->get('error_folder_is_create'),$ki_gallery.$pfolder));
                                                                      
                    if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateForm()) {
                                        // Create new Folder
                              if(isset($this->request->post['createfolder']) && $this->validateMkdir()){
                                        $done = $this->model_line_kigallery->manageFolder($this->request->post,$settings[0]);  
                                        if($done == false){
                                        $this->session->data['success'] = $this->language->get('text_success');
                                         $this->redirect($this->url->link('line/kigallery/managefolder','token=' . $this->session->data['token'], 'SSL'));
                                         } else {
                                                                $this->session->data['warning'] = $error_list[$done];
                                         }
                              } 
                              if(isset($this->request->post['editfolder'])){
                                        // Create new Folder
                                      $done =  $this->model_line_kigallery->editFolder($this->request->post,$settings[0]);  
                                      if($done == false){
                                        $this->session->data['success'] = $this->language->get('text_success');
                                         $this->redirect($this->url->link('line/kigallery/managefolder','token=' . $this->session->data['token'], 'SSL'));
                                         } else{
                                                                $this->session->data['warning'] = $error_list[$done];
                                         }
                              } 
                          
                              if(isset($this->request->post['files_sizes'])){
                                        $this->model_line_kigallery->folderSizetoDatabase($this->request->post);
                                        $this->redirect($this->url->link('line/kigallery/managefolder','token=' . $this->session->data['token'], 'SSL'));
                              }
                    }
                  
                                   if (($this->request->server['REQUEST_METHOD'] == 'GET') && $this->validateForm()) {
                                                  if(isset($this->request->get['empty']) or isset($this->request->get['rmdir'])){
                                                            // Folder Empty or Delete
                                                   
                                                     $done =   $this->model_line_kigallery->manageFolder($this->request->get,$settings[0]);  
                                                                    if($done == false){    
                                                                      $this->session->data['success'] = $this->language->get('text_success');
                                                                    $this->redirect($this->url->link('line/kigallery/managefolder','token=' . $this->session->data['token'], 'SSL'));
                                                                   } else{
                                                                             $this->session->data['warning'] = $error_list[$done];
                                                                    }
                                                  }
                              }
   
                    if(isset($this->error['createfolder'])){
                                           $this->data['error_create_folder'] = $this->error['createfolder'];
                    } else{
                                           $this->data['error_create_folder'] = '';
                    }
                        if(isset($this->session->data['warning'])){
                                               $this->data['error'] =$this->session->data['warning'];
                                              $this->session->data['warning'] = '';
                        } else{
                                               $this->data['error'] = '';
                        }
    
		$this->template = 'line/kigallery_managefolder.tpl';
		$this->children = array(
			'common/header',
			'common/footer'
		);		
		$this->response->setOutput($this->render());
                       }
                       public function settings() {
                                    
		$this->language->load('line/koschtit_gallery');
		$this->data['heading_title'] = $this->language->get('heading_title');
                                    
		$this->load->model('line/kigallery');
                                    
		$this->data['text_gallery_texts'] = $this->language->get('text_gallery_texts');
                    $this->data['entry_comm_auto_string'] = $this->language->get('entry_comm_auto_string');
                    $this->data['entry_nav_next'] = $this->language->get('entry_nav_next');
                    $this->data['entry_nav_back'] = $this->language->get('entry_nav_back');
                    $this->data['entry_nav_maxi'] = $this->language->get('entry_nav_maxi');
                    $this->data['entry_nav_kiv_next'] = $this->language->get('entry_nav_kiv_next');
                    $this->data['entry_nav_kiv_back'] = $this->language->get('entry_nav_kiv_back');
                    $this->data['entry_nav_kiv_close'] = $this->language->get('entry_nav_kiv_close');
                    $this->data['entry_nav_gps_coord'] = $this->language->get('entry_nav_gps_coord');
                    $this->data['entry_nav_kiv_vcomm'] = $this->language->get('entry_nav_kiv_vcomm');
                    $this->data['entry_nav_kiv_download'] = $this->language->get('entry_nav_kiv_download');
                    $this->data['entry_slideshow_start'] = $this->language->get('entry_slideshow_start');
                    $this->data['entry_slideshow_stop'] = $this->language->get('entry_slideshow_stop');
                    $this->data['entry_help_text'] = $this->language->get('entry_help_text');
                    $this->data['entry_vcomm_lac'] = $this->language->get('entry_vcomm_lac');
                    $this->data['entry_vcomm_name'] = $this->language->get('entry_vcomm_name');
                    $this->data['entry_vcomm_comm'] = $this->language->get('entry_vcomm_comm');
                    $this->data['entry_vcomm_post'] = $this->language->get('entry_vcomm_post');
                    $this->data['entry_vcomm_clk'] = $this->language->get('entry_vcomm_clk');
                    $this->data['entry_vcomm_ncy'] = $this->language->get('entry_vcomm_ncy');
                        
		
		$this->data['button_save'] = $this->language->get('button_save');
		$this->data['button_cancel'] = $this->language->get('button_cancel');

                                    $this->data['tab_general'] = $this->language->get('tab_general');
		

		$this->data['cancel'] = $this->url->link('line/kigallery', '&token=' . $this->session->data['token'], 'SSL');

 		if (isset($this->error['warning'])) {
			$this->data['error_warning'] = $this->error['warning'];
		} else {
			$this->data['error_warning'] = '';
		}
	
 		if (isset($this->error['name'])) {
			$this->data['error_name'] = $this->error['name'];
		} else {
			$this->data['error_name'] = array();
		}

  		$this->data['breadcrumbs'] = array();

                       $this->data['breadcrumbs'][] = array(
                       'text'      => $this->language->get('text_home'),
                       'href'      => $this->url->link('common/home', 'token=' . $this->session->data['token'], 'SSL'),
                       'separator' => false
                       );
                       
                       $this->data['breadcrumbs'][] = array(
                       'text'      => $this->language->get('heading_title'),
                       'href'      => $this->url->link('line/kigallery', 'token=' . $this->session->data['token'], 'SSL'),
                       'separator' => ' :: '
                       );
		$this->data['token'] = $this->session->data['token'];
		
		$this->load->model('localisation/language');
		 $this->data['kigallery_description'] = "";
		$this->data['languages'] = $this->model_localisation_language->getLanguages();

		$lang =  $this->model_localisation_language->getLanguages();
                                    $this->data['kigallery_description'] = $this->model_line_kigallery->getKoschtitGallery($lang);

		if(!$this->data['kigallery_description']){
                                                      $this->data['action'] = $this->url->link('line/kigallery/insert','token=' . $this->session->data['token'], 'SSL');
                                    }
		else{
                                                      $this->data['action'] = $this->url->link('line/kigallery/update','token=' . $this->session->data['token'], 'SSL');
                                    }
						
		$this->template = 'line/kigallery_setting_form.tpl';
		$this->children = array(
			'common/header',
			'common/footer'
		);
				
		$this->response->setOutput($this->render());
	}

	public function ajax(){
                   $this->load->model('line/kigallery'); 
		$this->language->load('line/koschtit_gallery');
                    
 		$this->data['text_edit_folder'] = $this->language->get('text_edit_folder');
                    
 		$language['entry_create_folder'] = $this->language->get('entry_create_folder');
                    $language['entry_album_name'] = $this->language->get('entry_album_name');
                    $language['entry_directory'] = $this->language->get('entry_directory');
                    $language['entry_sort_order'] = $this->language->get('entry_sort_order');
                    $language['entry_status'] = $this->language->get('entry_status');
                    $language['text_disabled'] = $this->language->get('text_disabled');            
		$language['text_enabled'] = $this->language->get('text_enabled');
 		$language['button_cancel'] = $this->language->get('button_cancel');
 		$language['button_save'] = $this->language->get('button_save');
                    $token = $this->session->data['token'];
                    
		$json = $this->model_line_kigallery->getFolderDescription($this->request->get['folder_id']);
                    $this->response->setOutput(json_encode($json));
          }
	protected function validateForm() {
		if (!$this->user->hasPermission('modify', 'line/kigallery')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}

		if ($this->error && !isset($this->error['warning'])) {
			$this->error['warning'] = $this->language->get('error_warning');
		}
					
		if (!$this->error) {
			return true;
		} else {
			return false;
		} 
	}
	protected function validateMkdir() {
		if (!$this->request->post['createfolder']) {
			$this->error['createfolder'] = $this->language->get('error_folder_name');
		}elseif(trim($this->request->post['createfolder'] == '')){
			$this->error['createfolder'] = $this->language->get('error_folder_name');
                                              }
					
		if (!$this->error) {
			return true;
		} else {
			return false;
		} 
	}
}
?>
