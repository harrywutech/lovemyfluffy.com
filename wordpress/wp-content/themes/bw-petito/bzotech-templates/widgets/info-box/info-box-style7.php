<?php
namespace Elementor;
extract($settings);

$wdata->add_render_attribute( 'wrapper', 'class', 'bzoteche-info-box-'.$settings['style'].' item-info-box text-center');
?>
<div <?php echo apply_filters('bzotech_output_content', $wdata->get_render_attribute_string('wrapper'));?>>
			<?php
			if ( !empty( $link_info['url']) ) { 
				$wdata->add_link_attributes( 'link_icon', $link_info); 
			}
			if(!empty($icon_image['url'])){
				
				$wdata->add_render_attribute( 'link_icon', 'class', 'item-image-icon-e elementor-animation-'.$image_icon_animation_hover_css);
				echo '<div class="info-box-icon"><a '.$wdata->get_render_attribute_string( 'link_icon' ).'>'.Group_Control_Image_Size::get_attachment_image_html( $settings,'image_icon','icon_image').'</a></div>';
			}else if(!empty( $icon['value'])){
				$wdata->add_render_attribute( 'link_icon', 'class', 'item-icon-e title60 color-title elementor-animation-'.$icon_animation_hover_css);
				if(!empty($icon['library']) && $icon['library']=='svg')
					echo'<div class="info-box-icon"><a '.$wdata->get_render_attribute_string( 'link_icon' ).'><img src="'.$icon['value']['url'].'" alt="svg"></a></div>';
				else
					echo '<div class="info-box-icon"><a '.$wdata->get_render_attribute_string( 'link_icon' ).'><i class="'.$icon['value'].'"></i></a></div>';
			} 
			echo'<div class="info-box-content">';
				if(!empty($title)){
					if ( !empty( $link_info['url']) ){ $wdata->add_link_attributes( 'link_title', $link_info); }

					$wdata->add_render_attribute( 'link_title', 'class', 'color-home22 elementor-animation-'.$title_animation_hover_css);
					echo'<h3 class="item-title-e title20 text-center font-regular font-title"><a '.$wdata->get_render_attribute_string( 'link_title' ).'>'.$title.'</a></h3>';
				}
				if(!empty($sub_title)){
					echo'<p class="item-sub-title-e text-center font-weight title16">'.$sub_title.'</p>';
				}
			echo'</div>';
			?>
</div>