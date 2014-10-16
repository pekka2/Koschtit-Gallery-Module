<?php
class ControllerModuleKoschtitGallery extends Controller {
	private $error = array(); 
	
	public function index() {   
		$this->language->load('module/koschtit_gallery');

		$this->document->setTitle($this->language->get('heading_title'));
		
		$this->load->model('setting/setting');
				
		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) {
                                                      $this->model_setting_setting->editSetting('kigallery', $this->request->post);		
					
			$this->session->data['success'] = $this->language->get('text_success');
						
			$this->redirect($this->url->link('extension/module', 'token=' . $this->session->data['token'], 'SSL'));
		}
				
		$this->data['heading_title'] = $this->language->get('heading_title');
		$this->data['ki_template'] = $this->config->get('config_template');

		$this->data['text_enabled'] = $this->language->get('text_enabled');
		$this->data['text_disabled'] = $this->language->get('text_disabled');
		$this->data['text_content_top'] = $this->language->get('text_content_top');
		$this->data['text_content_bottom'] = $this->language->get('text_content_bottom');		
		$this->data['text_column_left'] = $this->language->get('text_column_left');
		$this->data['text_column_right'] = $this->language->get('text_column_right');
		$this->data['text_manual'] = $this->language->get('text_manual');
		$this->data['text_size'] = $this->language->get('text_size');
		$this->data['text_name'] = $this->language->get('text_name');
		$this->data['text_news'] = $this->language->get('text_news');
		$this->data['text_olds'] = $this->language->get('text_olds');
		// Entry
		$this->data['entry_layout'] = $this->language->get('entry_layout');
		$this->data['entry_position'] = $this->language->get('entry_position');
		$this->data['entry_template'] = $this->language->get('entry_template');
		$this->data['entry_status'] = $this->language->get('entry_status');
		$this->data['entry_permission'] = $this->language->get('entry_permission');
		$this->data['entry_permission_help'] = $this->language->get('entry_permission_help');
		$this->data['entry_image_order'] = $this->language->get('entry_image_order');
		$this->data['entry_order_help'] = $this->language->get('entry_order_help');
		$this->data['entry_admin_mail'] = $this->language->get('entry_admin_mail');
		$this->data['entry_admin_mail_help'] = $this->language->get('entry_admin_mail_help');
		$this->data['entry_admin_mail_from'] = $this->language->get('entry_admin_mail_from');
		$this->data['entry_admin_mail_to'] = $this->language->get('entry_admin_mail_to');
		$this->data['entry_admin_mail_from_help'] = $this->language->get('entry_admin_mail_from_help');
		$this->data['entry_admin_mail_to_help'] = $this->language->get('entry_admin_mail_to_help');
		$this->data['entry_configdir'] = $this->language->get('entry_configdir');
		$this->data['entry_galleriesdir'] = $this->language->get('entry_galleriesdir');
		$this->data['entry_basedir'] = $this->language->get('entry_basedir');
		$this->data['entry_albums'] = $this->language->get('entry_albums');
		$this->data['entry_albums_help'] = $this->language->get('entry_albums_help');
		$this->data['entry_admin_limit'] = $this->language->get('entry_admin_limit');
		$this->data['entry_sort_order'] = $this->language->get('entry_sort_order');	
		$this->data['entry_pic_frame'] = $this->language->get('entry_pic_frame');	
		$this->data['entry_pic_frame_help'] = $this->language->get('entry_pic_frame_help');	
		$this->data['entry_pic_fr_model_help'] = $this->language->get('entry_pic_fr_model_help');
		$this->data['entry_pic_fr_model'] = $this->language->get('entry_pic_fr_model');
                                    $this->data['entry_fr_galleries'] = $this->language->get('entry_fr_galleries');			
                                    $this->data['entry_fr_width'] = $this->language->get('entry_fr_width');		
                                    $this->data['entry_fr_width_help'] = $this->language->get('entry_fr_width_help');
                                    $this->data['entry_fr_height'] = $this->language->get('entry_fr_height');
                                    $this->data['entry_fr_color'] = $this->language->get('entry_fr_color');
                                    $this->data['entry_fr_color_help'] = $this->language->get('entry_fr_color_help');
                                    
                                    $this->data['entry_ki_mixname'] = $this->language->get('entry_ki_mixname');
                                    $this->data['entry_ki_mixname_help'] = $this->language->get('entry_ki_mixname_help');
                                    $this->data['entry_thumbs'] = $this->language->get('entry_thumbs');
                                    $this->data['entry_thumbs_help'] = $this->language->get('entry_thumbs_help');
                                    $this->data['entry_th_per_line'] = $this->language->get('entry_th_per_line');
                                    $this->data['entry_th_per_line_help'] = $this->language->get('entry_th_per_line_help');
                                    $this->data['entry_th_lines'] = $this->language->get('entry_th_lines');
                                    $this->data['entry_th_lines_help'] = $this->language->get('entry_th_lines_help');
                                    $this->data['entry_th_width'] = $this->language->get('entry_th_width');
                                    $this->data['entry_th_margin_left'] = $this->language->get('entry_th_margin_left');
                                    $this->data['entry_th_margin_top'] = $this->language->get('entry_th_margin_top');
                                    $this->data['entry_th_margin_help'] = $this->language->get('entry_th_margin_help');
                                    $this->data['entry_th_width_help'] = $this->language->get('entry_th_width_help');
                                    $this->data['entry_th_height'] = $this->language->get('entry_th_height');                                   
                                    $this->data['entry_th_bord_size'] = $this->language->get('entry_th_bord_size');                        
                                    $this->data['entry_th_bord_size_help'] = $this->language->get('entry_th_bord_size_help');      
                                    $this->data['entry_th_radius'] = $this->language->get('entry_th_radius');
                                    $this->data['entry_radius'] = $this->language->get('entry_radius');
                                    $this->data['entry_bord_radius'] = $this->language->get('entry_bord_radius');
                                    $this->data['entry_th_radius_help'] = $this->language->get('entry_th_radius_help');
                                    $this->data['entry_th_bord_radius'] = $this->language->get('entry_th_bord_radius');
                                    $this->data['entry_th_bord_radius_help'] = $this->language->get('entry_th_bord_radius_help');
                                    $this->data['entry_th_bord_color'] = $this->language->get('entry_th_bord_color');   
                                    $this->data['entry_th_bord_color_help'] = $this->language->get('entry_th_bord_color_help');
                                    $this->data['entry_th_bord_hover_color'] = $this->language->get('entry_th_bord_hover_color');
                                    $this->data['entry_th_bord_hover_color_help'] = $this->language->get('entry_th_bord_hover_color_help');
                                    $this->data['entry_th_bord_hover_increase'] = $this->language->get('entry_th_bord_hover_increase');
                                    $this->data['entry_th_bord_hover_increase_help'] = $this->language->get('entry_th_bord_hover_increase_help');
                                    $this->data['entry_th_shadow'] = $this->language->get('entry_th_shadow');
                                    $this->data['entry_th_shadow_help'] = $this->language->get('entry_th_shadow_help');
                                    $this->data['entry_th_to_square'] = $this->language->get('entry_th_to_square');
                                    $this->data['entry_th_to_square_help'] = $this->language->get('entry_th_to_square_help');
                                    $this->data['entry_th_2sq_crop_hori'] = $this->language->get('entry_th_2sq_crop_hori');
                                    $this->data['entry_th_2sq_crop_hori_help'] = $this->language->get('entry_th_2sq_crop_hori_help');
                                    $this->data['entry_th_2sq_crop_vert'] = $this->language->get('entry_th_2sq_crop_vert');
                                    $this->data['entry_th_2sq_crop_vert_help'] = $this->language->get('entry_th_2sq_crop_vert_help');
                                    $this->data['entry_thumbs_to_disk'] = $this->language->get('entry_thumbs_to_disk');
                                    $this->data['entry_thumbs_to_disk_help'] = $this->language->get('entry_thumbs_to_disk_help');
                                    $this->data['entry_pic_fr_width'] = $this->language->get('entry_pic_fr_width');
                                    $this->data['entry_pic_fr_width_help'] = $this->language->get('entry_pic_fr_width_help');
                                    
                                    $this->data['entry_pic_order_help'] = $this->language->get('entry_pic_order_help');
                                    $this->data['entry_resize_auto'] = $this->language->get('entry_resize_auto');
                                    $this->data['entry_resize_auto_help'] = $this->language->get('entry_resize_auto_help');
                                    $this->data['entry_bord_size'] = $this->language->get('entry_bord_size');
                                    $this->data['entry_bord_size_help'] = $this->language->get('entry_bord_size_help');
                                    $this->data['entry_bord_color'] = $this->language->get('entry_bord_color');
                                    $this->data['entry_out_bord_size'] = $this->language->get('entry_out_bord_size');
                                    $this->data['entry_out_bord_color'] = $this->language->get('entry_out_bord_color');
                                    $this->data['entry_bord_color_help'] = $this->language->get('entry_bord_color_help');
                                    $this->data['entry_max_pic_width'] = $this->language->get('entry_max_pic_width');
                                    $this->data['entry_max_pic_width_help'] = $this->language->get('entry_max_pic_width_help');
                                    $this->data['entry_max_pic_height'] = $this->language->get('entry_max_pic_height');
                                    $this->data['entry_maxim_pic_width'] = $this->language->get('entry_maxim_pic_width');
                                    $this->data['entry_maxim_pic_width_help'] = $this->language->get('entry_maxim_pic_width_help');
                                    $this->data['entry_maxim_pic_height'] = $this->language->get('entry_maxim_pic_height');
                                    $this->data['entry_oversize_allowed'] = $this->language->get('entry_oversize_allowed');
                                    $this->data['entry_oversize_allowed_help'] = $this->language->get('entry_oversize_allowed_help');
                                    $this->data['entry_comments'] = $this->language->get('entry_comments');
                                    $this->data['entry_comments_help'] = $this->language->get('entry_comments_help');
                                    $this->data['entry_comm_text_size'] = $this->language->get('entry_comm_text_size');
                                    $this->data['entry_comm_text_size_help'] = $this->language->get('entry_comm_text_size_help');
                                    $this->data['entry_comm_text_color'] = $this->language->get('entry_comm_text_color');
                                    $this->data['entry_comm_text_color_help'] = $this->language->get('entry_comm_text_color_help');
                                    $this->data['entry_comm_text_font'] = $this->language->get('entry_comm_text_font');
                                    $this->data['entry_comm_text_font_help'] = $this->language->get('entry_comm_text_font_help');
                                    $this->data['entry_comm_text_align'] = $this->language->get('entry_comm_text_align');
                                    $this->data['entry_comm_text_align_help'] = $this->language->get('entry_comm_text_align_help');
                                    $this->data['entry_comm_auto'] = $this->language->get('entry_comm_auto');
                                    $this->data['entry_comm_auto_help'] = $this->language->get('entry_comm_auto_help');
                                    $this->data['entry_read_meta'] = $this->language->get('entry_read_meta');
                                    $this->data['entry_read_meta_help'] = $this->language->get('entry_read_meta_help');
                                    $this->data['entry_viewercomments'] = $this->language->get('entry_viewercomments');
                                    $this->data['entry_viewercomments_help'] = $this->language->get('entry_viewercomments_help');
                                    $this->data['entry_moderate_posts'] = $this->language->get('entry_moderate_posts');
                                    $this->data['entry_moderate_posts_help'] = $this->language->get('entry_moderate_posts_help');
                                    $this->data['entry_vcomm_header_color'] = $this->language->get('entry_vcomm_header_color');
                                    $this->data['entry_vcomm_header_color_help'] = $this->language->get('entry_vcomm_header_color_help');
                                    $this->data['entry_vcomm_box_color'] = $this->language->get('entry_vcomm_box_color');
                                    $this->data['entry_vcomm_box_color_help'] = $this->language->get('entry_vcomm_box_color_help');
                                    $this->data['entry_vcomm_text_color'] = $this->language->get('entry_vcomm_text_color');
                                    $this->data['entry_vcomm_text_color_help'] = $this->language->get('entry_vcomm_text_color_help');
                                    $this->data['entry_vcomm_timedate_color'] = $this->language->get('entry_vcomm_timedate_color');
                                    $this->data['entry_vcomm_timedate_color_help'] = $this->language->get('entry_vcomm_timedate_color_help');
                                    $this->data['entry_vcomm_back_color'] = $this->language->get('entry_vcomm_back_color');
                                    $this->data['entry_vcomm_back_color_help'] = $this->language->get('entry_vcomm_back_color_help');
                                    $this->data['entry_vcomm_bord_color'] = $this->language->get('entry_vcomm_bord_color');
                                    $this->data['entry_vcomm_bord_color_help'] = $this->language->get('entry_vcomm_bord_color_help');
                                    $this->data['entry_slideshow'] = $this->language->get('entry_slideshow');
                                    $this->data['entry_slideshow_help'] = $this->language->get('entry_slideshow_help');
                                    $this->data['entry_downloadpics'] = $this->language->get('entry_downloadpics');
                                    $this->data['entry_downloadpics_help'] = $this->language->get('entry_downloadpics_help');
                                    $this->data['entry_checkgps'] = $this->language->get('entry_checkgps');
                                    $this->data['entry_checkgps_help'] = $this->language->get('entry_checkgps_help');
                                    $this->data['entry_cellinfo'] = $this->language->get('entry_cellinfo');
                                    $this->data['entry_cellinfo_help'] = $this->language->get('entry_cellinfo_help');
                                    $this->data['entry_show_nav'] = $this->language->get('entry_show_nav');
                                    $this->data['entry_show_nav_help'] = $this->language->get('entry_show_nav_help');
                                    $this->data['entry_nav_always'] = $this->language->get('entry_nav_always');
                                    $this->data['entry_nav_always_help'] = $this->language->get('entry_nav_always_help');
                                    $this->data['entry_nav_pos'] = $this->language->get('entry_nav_pos');
                                    $this->data['entry_nav_pos_help'] = $this->language->get('entry_nav_pos_help');
                                    $this->data['entry_nav_color'] = $this->language->get('entry_nav_color');
                                    $this->data['entry_nav_color_help'] = $this->language->get('entry_nav_color_help');
                                     $this->data['entry_nav_border_color'] = $this->language->get('entry_nav_border_color');
                                     $this->data['entry_nav_border_color_help'] = $this->language->get('entry_nav_border_color_help');
                                    $this->data['entry_nav_style'] = $this->language->get('entry_nav_style');
                                    $this->data['entry_nav_style_help'] = $this->language->get('entry_nav_style_help');
                                    $this->data['entry_show_image_nav'] = $this->language->get('entry_show_image_nav');
                                    $this->data['entry_show_image_nav_help'] = $this->language->get('entry_show_image_nav_help');
                                    $this->data['entry_image_nav_always'] = $this->language->get('entry_image_nav_always');
                                    $this->data['entry_image_nav_always_help'] = $this->language->get('entry_image_nav_always_help');
                                    $this->data['entry_show_share'] = $this->language->get('entry_show_share');
                                    $this->data['entry_show_share_help'] = $this->language->get('entry_show_share_help');
                                    $this->data['entry_show_help'] = $this->language->get('entry_show_help');
                                    $this->data['entry_show_help_help'] = $this->language->get('entry_show_help_help');
                                    $this->data['entry_help_pos'] = $this->language->get('entry_help_pos');
                                    $this->data['entry_help_pos_help'] = $this->language->get('entry_help_pos_help');
                                    $this->data['entry_show_preview'] = $this->language->get('entry_show_preview');
                                    $this->data['entry_show_preview_help'] = $this->language->get('entry_show_preview_help');
                                    $this->data['entry_preview_style'] = $this->language->get('entry_preview_style');
                                    $this->data['entry_preview_style_help'] = $this->language->get('entry_preview_style_help');
                                    $this->data['entry_preview_pics'] = $this->language->get('entry_preview_pics');
                                    $this->data['entry_preview_pics_help'] = $this->language->get('entry_preview_pics_help');
                                    $this->data['entry_show_explorer'] = $this->language->get('entry_show_explorer');
                                    $this->data['entry_show_explorer_help'] = $this->language->get('entry_show_explorer_help');
                                    $this->data['entry_explorer_padding'] = $this->language->get('entry_explorer_padding');
                                    $this->data['entry_explorer_padding_help'] = $this->language->get('entry_explorer_padding_help');
                                    $this->data['entry_watermark_hori'] = $this->language->get('entry_watermark_hori');
                                    $this->data['entry_watermark_hori_help'] = $this->language->get('entry_watermark_hori_help');
                                    $this->data['entry_watermark_vert'] = $this->language->get('entry_watermark_vert');
                                    $this->data['entry_watermark_vert_help'] = $this->language->get('entry_watermark_vert_help');
                                    $this->data['entry_watermark_size'] = $this->language->get('entry_watermark_size');
                                    $this->data['entry_watermark_size_help'] = $this->language->get('entry_watermark_size_help');
                                    $this->data['entry_fade_color'] = $this->language->get('entry_fade_color');
                                    $this->data['entry_fade_color_help'] = $this->language->get('entry_fade_color_help');
                                    $this->data['entry_fade_alpha'] = $this->language->get('entry_fade_alpha');
                                    $this->data['entry_fade_alpha_help'] = $this->language->get('entry_fade_alpha_help');
                                    $this->data['entry_shade_while_loading'] = $this->language->get('entry_shade_while_loading');
                                    $this->data['entry_shade_while_loading_help'] = $this->language->get('entry_shade_while_loading_help');
                                    $this->data['entry_disable_animation'] = $this->language->get('entry_disable_animation');
                                    $this->data['entry_disable_animation_help'] = $this->language->get('entry_disable_animation_help');
                                    $this->data['entry_slideshow_time_help'] = $this->language->get('entry_slideshow_time_help');
                                    $this->data['entry_slideshow_time'] = $this->language->get('entry_slideshow_time');
                                    $this->data['entry_nav_next_help'] = $this->language->get('entry_nav_next_help');
                                    $this->data['entry_nav_next'] = $this->language->get('entry_nav_next');
                                    $this->data['entry_nav_back_help'] = $this->language->get('entry_nav_back_help');
                                    $this->data['entry_nav_back'] = $this->language->get('entry_nav_back');
                                    $this->data['entry_nav_maxi_help'] = $this->language->get('entry_nav_maxi_help');
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
                                    $this->data['entry_show_warnings'] = $this->language->get('entry_show_warnings');
                                    $this->data['entry_show_warnings_help'] = $this->language->get('entry_show_warnings_help');
                                    // Button
		$this->data['button_save'] = $this->language->get('button_save');
		$this->data['button_cancel'] = $this->language->get('button_cancel');
		$this->data['button_add_module'] = $this->language->get('button_add_module');
		$this->data['button_remove'] = $this->language->get('button_remove');
		
 		if (isset($this->error['warning'])) {
			$this->data['error_warning'] = $this->error['warning'];
		} else {
			$this->data['error_warning'] = '';
		}

  		$this->data['breadcrumbs'] = array();
                                              $this->data['token'] = $this->session->data['token'];
                       $this->data['breadcrumbs'][] = array(
                       'text'      => $this->language->get('text_home'),
                       'href'      => $this->url->link('common/home', 'token=' . $this->session->data['token'], 'SSL'),
                       'separator' => false
                       );
                       
                       $this->data['breadcrumbs'][] = array(
                       'text'      => $this->language->get('text_module'),
                       'href'      => $this->url->link('extension/module', 'token=' . $this->session->data['token'], 'SSL'),
                       'separator' => ' :: '
                       );
                       
                       $this->data['breadcrumbs'][] = array(
                       'text'      => $this->language->get('heading_title'),
                       'href'      => $this->url->link('module/koschtit_gallery', 'token=' . $this->session->data['token'], 'SSL'),
                       'separator' => ' :: '
                       );
		
		$this->data['action'] = $this->url->link('module/koschtit_gallery', 'token=' . $this->session->data['token'], 'SSL');
		$this->data['cancel'] = $this->url->link('extension/module', 'token=' . $this->session->data['token'], 'SSL');
		
		$this->data['modules'] = array();
		
		if (isset($this->request->post['kigallery_module'])) {
			$this->data['modules'] = $this->request->post['kigallery_module'];
		} elseif ($this->config->get('kigallery_module')) { 
			$this->data['modules'] = $this->config->get('kigallery_module');
		}	
		
		$this->load->model('design/layout');
		
		$this->data['layouts'] = $this->model_design_layout->getLayouts();

		$this->template = 'module/koschtit_gallery.tpl';
		$this->children = array(
			'common/header',
			'common/footer'
		);
				
		$this->response->setOutput($this->render());
	}
/*	
       public function ajax(){
                   $this->load->model('line/kiframe'); 
		$this->language->load('module/koschtit_gallery');
                    
 		$this->data['text_edit_folder'] = $this->language->get('text_edit_folder');
                    
                       $token = $this->session->data['token'];
                    
                    $json = $this->model_line_kiframe->getFrames();
                    $this->response->setOutput(json_encode($json));
          } */
          
        protected function validate() {
		if (!$this->user->hasPermission('modify', 'module/koschtit_gallery')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}
		
		if (!$this->error) {
			return true;
		} else {
			return false;
		}	
      }
}
?>
