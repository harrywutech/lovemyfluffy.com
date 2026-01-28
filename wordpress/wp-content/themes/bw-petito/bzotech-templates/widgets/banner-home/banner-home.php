<?php
namespace Elementor;
extract($settings);
?>
<div class="wrapper-banner">
   <div class="image-banner"> <?php echo Group_Control_Image_Size::get_attachment_image_html( $settings);?></div>
    <div class="left-banner">
       <?php  echo '<h2 class="title-banner-1">'.$widget_title_11.'</h2>'; ?>
      <div class="desc-banner-1"> <?php echo bzotech_parse_text_editor ($item_description_1 )?></div> 
   <div class="left-right">
       <?php
       $wdata->add_render_attribute( 'button-banner', 'class', 'button-banner-1' );
		
		if($website_link['is_external']) $wdata->add_render_attribute( 'button-banner', 'target', "_blank");
		if($website_link['nofollow']) $wdata->add_render_attribute( 'button-banner', 'rel', "nofollow");
		if($website_link['url']) $wdata->add_render_attribute( 'button-banner', 'href', $website_link['url']);
		
        echo '<a '.apply_filters('bzotech_output_content', $wdata->get_render_attribute_string('button-banner')).'>'.$button_banner_1.'</a>'; ?>
   
    
    </div>
    </div>
  
</div>