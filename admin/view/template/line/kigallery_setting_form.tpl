<?php echo $header; ?>
<div id="content">
  <div class="breadcrumb">
    <?php foreach ($breadcrumbs as $breadcrumb) { ?>
    <?php echo $breadcrumb['separator']; ?><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a>
    <?php } ?>
  </div>
  <?php if ($error_warning) { ?>
  <div class="warning"><?php echo $error_warning; ?></div>
  <?php } ?>
  <div class="box">
    <div class="heading">
      <h1><img src="view/image/category.png" alt="" /> <?php echo $heading_title; ?>
      > <?php echo $text_gallery_texts;?></h1>
      <div class="buttons"><a onclick="$('#form').submit();" class="button"><?php echo $button_save; ?></a>
      <a href="<?php echo $cancel; ?>" class="button"><?php echo $button_cancel; ?></a>
      </div>
    </div>
    <div class="content">
      <div id="tabs" class="htabs"><a href="#tab-general"><?php echo $tab_general; ?></a>
      </div>
      <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form">
        <div id="tab-general">
          <div id="languages" class="htabs">
            <?php foreach ($languages as $language) { ?>
            <a href="#language<?php echo $language['language_id']; ?>"><img src="view/image/flags/<?php echo $language['image']; ?>" title="<?php echo $language['name']; ?>" /> <?php echo $language['name']; ?></a>
            <?php } ?>
          </div>
          <?php foreach ($languages as $language) { ?>
          <div id="language<?php echo $language['language_id']; ?>">
            <table class="form">
            
              <tr>
                <td><span class="required">*</span> <?php echo $entry_comm_auto_string; ?></td>
                <td><input type="text" name="kigallery_description[<?php echo $language['language_id']; ?>][ki_comm_auto_string]" size="100" value="<?php echo isset($kigallery_description[$language['language_id']]) ? $kigallery_description[$language['language_id']]['ki_comm_auto_string'] : ''; ?>" />
 </td>
              </tr>
            
              <tr>
                <td><span class="required">*</span> <?php echo $entry_nav_next; ?></td>
                <td><input type="text" name="kigallery_description[<?php echo $language['language_id']; ?>][ki_nav_next]" size="100" value="<?php echo isset($kigallery_description[$language['language_id']]) ? $kigallery_description[$language['language_id']]['ki_nav_next'] : ''; ?>" />
             </td>
              </tr>
            
              <tr>
                <td><span class="required">*</span><?php echo $entry_nav_back; ?></td>
                <td><input type="text" name="kigallery_description[<?php echo $language['language_id']; ?>][ki_nav_back]" size="100" value="<?php echo isset($kigallery_description[$language['language_id']]) ? $kigallery_description[$language['language_id']]['ki_nav_back'] : ''; ?>" />
            </td>
              </tr>
            
              <tr>
                <td><span class="required">*</span><?php echo $entry_nav_maxi; ?></td>
                <td><input type="text" name="kigallery_description[<?php echo $language['language_id']; ?>][ki_nav_maxi]" size="100" value="<?php echo isset($kigallery_description[$language['language_id']]) ? $kigallery_description[$language['language_id']]['ki_nav_maxi'] : ''; ?>" />
                  </td>
              </tr>
            
              <tr>
                <td><span class="required">*</span><?php echo $entry_nav_kiv_next; ?></td>
                <td><input type="text" name="kigallery_description[<?php echo $language['language_id']; ?>][ki_nav_kiv_next]" size="100" value="<?php echo isset($kigallery_description[$language['language_id']]) ? $kigallery_description[$language['language_id']]['ki_nav_kiv_next'] : ''; ?>" />
               </td>
              </tr>
            
              <tr>
                <td><span class="required">*</span><?php echo $entry_nav_kiv_back; ?></td>
                <td><input type="text" name="kigallery_description[<?php echo $language['language_id']; ?>][ki_nav_kiv_back]" size="100" value="<?php echo isset($kigallery_description[$language['language_id']]) ? $kigallery_description[$language['language_id']]['ki_nav_kiv_back'] : ''; ?>" />
                </td>
              </tr>
            
              <tr>
                <td><span class="required">*</span><?php echo $entry_nav_kiv_close; ?></td>
                <td><input type="text" name="kigallery_description[<?php echo $language['language_id']; ?>][ki_nav_kiv_close]" size="100" value="<?php echo isset($kigallery_description[$language['language_id']]) ? $kigallery_description[$language['language_id']]['ki_nav_kiv_close'] : ''; ?>" />
 </td>
              </tr>
            
              <tr>
                <td><span class="required">*</span><?php echo $entry_nav_gps_coord; ?></td>
                <td><input type="text" name="kigallery_description[<?php echo $language['language_id']; ?>][ki_nav_gps_coord]" size="100" value="<?php echo isset($kigallery_description[$language['language_id']]) ? $kigallery_description[$language['language_id']]['ki_nav_gps_coord'] : ''; ?>" />
</td>
              </tr>
            
              <tr>
                <td><span class="required">*</span> <?php echo $entry_nav_kiv_vcomm; ?></td>
                <td><input type="text" name="kigallery_description[<?php echo $language['language_id']; ?>][ki_nav_kiv_vcomm]" size="100" value="<?php echo isset($kigallery_description[$language['language_id']]) ? $kigallery_description[$language['language_id']]['ki_nav_kiv_vcomm'] : ''; ?>" />
               </td>
              </tr>
            
              <tr>
                <td><span class="required">*</span><?php echo $entry_nav_kiv_download; ?></td>
                <td><input type="text" name="kigallery_description[<?php echo $language['language_id']; ?>][ki_nav_kiv_download]" size="100" value="<?php echo isset($kigallery_description[$language['language_id']]) ? $kigallery_description[$language['language_id']]['ki_nav_kiv_download'] : ''; ?>" />
               </td>
              </tr>
            
              <tr>
                <td><span class="required">*</span><?php echo $entry_slideshow_start; ?></td>
                <td><input type="text" name="kigallery_description[<?php echo $language['language_id']; ?>][ki_slideshow_start]" size="100" value="<?php echo isset($kigallery_description[$language['language_id']]) ? $kigallery_description[$language['language_id']]['ki_slideshow_start'] : ''; ?>" />
                 </td>
              </tr>
            
              <tr>
                <td><span class="required">*</span> <?php echo $entry_slideshow_stop; ?></td>
                <td><input type="text" name="kigallery_description[<?php echo $language['language_id']; ?>][ki_slideshow_stop]" size="100" value="<?php echo isset($kigallery_description[$language['language_id']]) ? $kigallery_description[$language['language_id']]['ki_slideshow_stop'] : ''; ?>" />
             </td>
              </tr>
            
              <tr>
                <td><span class="required">*</span> <?php echo $entry_help_text; ?></td>
                <td><textarea cols="98" rows="4" name="kigallery_description[<?php echo $language['language_id']; ?>][ki_help_text]"><?php echo isset($kigallery_description[$language['language_id']]) ? $kigallery_description[$language['language_id']]['ki_help_text'] : ''; ?></textarea>
                 </td>
              </tr>
            
              <tr>
                <td><span class="required">*</span> <?php echo $entry_vcomm_lac; ?></td>
                <td><input type="text" name="kigallery_description[<?php echo $language['language_id']; ?>][ki_vcomm_lac]" size="100" value="<?php echo isset($kigallery_description[$language['language_id']]) ? $kigallery_description[$language['language_id']]['ki_vcomm_lac'] : ''; ?>" />
                 </td>
              </tr>
            
              <tr>
                <td><span class="required">*</span> <?php echo $entry_vcomm_name; ?></td>
                <td><input type="text" name="kigallery_description[<?php echo $language['language_id']; ?>][ki_vcomm_name]" size="100" value="<?php echo isset($kigallery_description[$language['language_id']]) ? $kigallery_description[$language['language_id']]['ki_vcomm_name'] : ''; ?>" />
   </td>
              </tr>
            
              <tr>
                <td><span class="required">*</span> <?php echo $entry_vcomm_comm; ?></td>
                <td><input type="text" name="kigallery_description[<?php echo $language['language_id']; ?>][ki_vcomm_comm]" size="100" value="<?php echo isset($kigallery_description[$language['language_id']]) ? $kigallery_description[$language['language_id']]['ki_vcomm_comm'] : ''; ?>" />
                </td> 
              </tr>
            
              <tr>
                <td><span class="required">*</span> <?php echo $entry_vcomm_post; ?></td>
                <td><input type="text" name="kigallery_description[<?php echo $language['language_id']; ?>][ki_vcomm_post]" size="100" value="<?php echo isset($kigallery_description[$language['language_id']]) ? $kigallery_description[$language['language_id']]['ki_vcomm_post'] : ''; ?>" />
                  </td>
              </tr>
            
              <tr>
                <td><span class="required">*</span> <?php echo $entry_vcomm_clk; ?></td>
                <td><input type="text" name="kigallery_description[<?php echo $language['language_id']; ?>][ki_vcomm_clk]" size="100" value="<?php echo isset($kigallery_description[$language['language_id']]) ? $kigallery_description[$language['language_id']]['ki_vcomm_clk'] : ''; ?>" />
                  </td>
              </tr>
            
              <tr>
                <td><span class="required">*</span> <?php echo $entry_vcomm_ncy; ?></td>
                <td><input type="text" name="kigallery_description[<?php echo $language['language_id']; ?>][ki_vcomm_ncy]" size="100" value="<?php echo isset($kigallery_description[$language['language_id']]) ? $kigallery_description[$language['language_id']]['ki_vcomm_ncy'] : ''; ?>" />
                  </td>
              </tr>
            </table>
          </div>
          <?php } ?>
        </div>
    
     
      </form>
    </div>
  </div>
</div>
<script type="text/javascript"><!--
$('#tabs a').tabs(); 
$('#languages a').tabs();
//--></script> 
<?php echo $footer; ?>
