<?php
namespace Elementor;
$animation_class = $col_grid_tablet=$col_grid_mobile='';
extract($settings);
if($hover_animation) $animation_class = 'elementor-animation-'.$hover_animation;
$wdata->add_render_attribute( 'elbzotech-wrapper', 'class', '' );


echo'<div class="elbzotech-instagram list-instagram-'.$style.' item-instagram-'.$style_item.'">';
	if($settings['media_from'] == 'media-lib'){
    	foreach (  $settings['list_images'] as $key => $item ) {
			if($item['link']['is_external']) $wdata->add_render_attribute( 'instagram-link', 'target', "_blank");
			if($item['link']['nofollow']) $wdata->add_render_attribute( 'instagram-link', 'rel', "nofollow");
			if($item['link']['url']) $wdata->add_render_attribute( 'instagram-link', 'href', $item['link']['url']);

			echo '<div class="item-instagram item-col-'.$col_grid.' tablet-item-col-'.$col_grid_tablet.' mobile-item-col-'.$col_grid_mobile.'  elementor-repeater-item-'.$item['_id'].'">';
				echo '<a '.$wdata->get_render_attribute_string('instagram-link').' class="img-wrap">';
					echo Group_Control_Image_Size::get_attachment_image_html( $settings['list_images'][$key], 'thumbnail', 'image' );
				
					if($item['text_hover']){
					echo '<h3 class="instagram-text-follow color-white">';
						echo '<i class="lab la-instagram title16"></i><span class="text font-sub title100 ">'.$item['text_hover'].'</span>';
					echo '</h3>';
					}
				echo '</a>';
			echo '</div>';
			$wdata->remove_render_attribute( 'instagram-link', 'target', "_blank" );
			$wdata->remove_render_attribute( 'instagram-link', 'rel', "nofollow");
			$wdata->remove_render_attribute( 'instagram-link', 'href', $item['link']['url']);
		}
	}
	else{
		if(!empty($settings['token']) && function_exists('bzotech_get_data_instagram')){
            $media_array = bzotech_get_data_instagram($settings['token'],$settings['number'],$settings['caption_text_hover']);

            if(!empty($media_array) && is_array($media_array)){
                foreach ($media_array as $item) {
                    if(!empty($item['media_url'])){
                    	echo '<div class="item-instagram item-col-'.$col_grid.' item-col-'.$col_grid.' tablet-item-col-'.$col_grid_tablet.' mobile-item-col-'.$col_grid_mobile.'">';
                    	echo '<a href="'.esc_url($item['permalink']).'" rel="nofollow" class="img-wrap '.esc_attr($animation_class).'"><img src="'.esc_url($item['media_url']).'"/></a>';
		                if(!empty($item['caption']))
		                echo '<h3 class="instagram-text-follow"><i class="lab la-instagram title16"></i> <span class="text">'.$item['caption'].'</span></h3>';
	                    echo '</div>';
                    }
                }              
            }
        }
	}
	?>
</div>