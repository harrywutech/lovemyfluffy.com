<?php
namespace Elementor;
extract($settings);

$wdata->add_render_attribute( 'wrapper', 'class', 'bzoteche-info-box-'.$settings['style'].' item-info-box');

?>
<div <?php echo apply_filters('bzotech_output_content', $wdata->get_render_attribute_string('wrapper'));?>>
		<div>
			<?php
			
			echo'<div class="info-box-content flex-wrapper">';
			if ( !empty( $link_info['url']) ) { 
				$wdata->add_link_attributes( 'link_icon', $link_info); 
			}
			if(!empty($image['url'])){
				$wdata->add_render_attribute( 'link_icon', 'class', 'item-image-e elementor-animation-'.$image_icon_animation_hover_css);
				echo '<div class="info-box-image"><a '.$wdata->get_render_attribute_string( 'link_icon' ).'>'.Group_Control_Image_Size::get_attachment_image_html( $settings,'image_size','image').'</a></div>';
			}
			
				
				
			echo'</div>';
			
			?>

		</div>
</div>