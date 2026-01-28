<?php
namespace Elementor;
$slider_items_widescreen =$slider_items_laptop = $slider_items_tablet = $slider_items_tablet_extra =$slider_items_mobile_extra =$slider_items_mobile =$slider_space_widescreen =$slider_space_laptop =$slider_space_tablet_extra =$slider_space_tablet =$slider_space_mobile_extra= $slider_space_mobile ='';
extract($settings);
$wdata->add_render_attribute( 'elbzotech-wrapper', 'class', 'elbzotech-swiper-slider swiper-container' );
$wdata->add_render_attribute( 'elbzotech-wrapper', 'data-items', $slider_items );
$wdata->add_render_attribute( 'elbzotech-wrapper', 'data-items-custom', $slider_items_custom );
$wdata->add_render_attribute( 'elbzotech-wrapper', 'data-items-widescreen', $slider_items_widescreen );
$wdata->add_render_attribute( 'elbzotech-wrapper', 'data-items-laptop', $slider_items_laptop );
$wdata->add_render_attribute( 'elbzotech-wrapper', 'data-items-tablet-extra', $slider_items_tablet_extra);
$wdata->add_render_attribute( 'elbzotech-wrapper', 'data-items-tablet', $slider_items_tablet);
$wdata->add_render_attribute( 'elbzotech-wrapper', 'data-items-mobile-extra', $slider_items_mobile_extra);
$wdata->add_render_attribute( 'elbzotech-wrapper', 'data-items-mobile', $slider_items_mobile );
$wdata->add_render_attribute( 'elbzotech-wrapper', 'data-space', $slider_space );
$wdata->add_render_attribute( 'elbzotech-wrapper', 'data-space-widescreen', $slider_space_widescreen );
$wdata->add_render_attribute( 'elbzotech-wrapper', 'data-space-laptop', $slider_space_laptop );
$wdata->add_render_attribute( 'elbzotech-wrapper', 'data-space-tablet-extra', $slider_space_tablet_extra );
$wdata->add_render_attribute( 'elbzotech-wrapper', 'data-space-tablet', $slider_space_tablet );
$wdata->add_render_attribute( 'elbzotech-wrapper', 'data-space-mobile-extra', $slider_space_mobile_extra );
$wdata->add_render_attribute( 'elbzotech-wrapper', 'data-space-mobile', $slider_space_mobile );
$wdata->add_render_attribute( 'elbzotech-wrapper', 'data-column', $slider_column );
$wdata->add_render_attribute( 'elbzotech-wrapper', 'data-loop', $slider_loop);
$wdata->add_render_attribute( 'elbzotech-wrapper', 'data-speed', $slider_speed );
$wdata->add_render_attribute( 'elbzotech-wrapper', 'data-navigation', $slider_navigation );
$wdata->add_render_attribute( 'elbzotech-wrapper', 'data-pagination', $slider_pagination );
$wdata->add_render_attribute( 'elbzotech-inner', 'class', 'swiper-wrapper' );
$wdata->add_render_attribute( 'elbzotech-item', 'class', 'swiper-slide' );

$animation_class = '';
if($hover_animation) $animation_class = 'elementor-animation-'.$hover_animation;
?>
<div class="elbzotech-instagram elbzotech-wrapper-slider <?php if(!empty($slider_navigation)) echo esc_attr('display-swiper-navi-'.$slider_navigation); ?> <?php if(!empty($slider_pagination)) echo esc_attr('display-swiper-pagination-'.$slider_pagination); ?> <?php if(!empty($slider_scrollbar)) echo esc_attr('display-swiper-scrollbar-'.$slider_scrollbar); ?>">
<?php
	echo '<div '.$wdata->get_render_attribute_string( 'elbzotech-wrapper' ).'>';
		echo '<div '.$wdata->get_render_attribute_string( 'elbzotech-inner' ).'>';

	    	if($settings['media_from'] == 'media-lib'){
		    	foreach (  $settings['list_images'] as $key => $item ) {
					if($item['link']['is_external']) $wdata->add_render_attribute( 'instagram-link', 'target', "_blank");
					if($item['link']['nofollow']) $wdata->add_render_attribute( 'instagram-link', 'rel', "nofollow");
					if($item['link']['url']) $wdata->add_render_attribute( 'instagram-link', 'href', $item['link']['url']);

					$wdata->add_render_attribute( 'elbzotech-item', 'class', 'elementor-repeater-item-'.$item['_id'] );
					echo '<div '.$wdata->get_render_attribute_string( 'elbzotech-item' ).'>';
						echo '<div class="item-instagram item-instagram-'.$style_item.'">';
							echo '<a '.$wdata->get_render_attribute_string('instagram-link').' class="img-wrap">'; 
								echo Group_Control_Image_Size::get_attachment_image_html( $settings['list_images'][$key], 'thumbnail', 'image' );
							
								if($item['text_hover']){
									echo '<h3 class="instagram-text-follow">';
										echo '<i class="lab la-instagram title16"></i><span class="text">'.$item['text_hover'].'</span>';
									echo '</h3>';
								}
							echo '</a>';
						echo '</div>';
					echo '</div>';
					$wdata->remove_render_attribute( 'instagram-link', 'target', "_blank" );
					$wdata->remove_render_attribute( 'instagram-link', 'rel', "nofollow");
					$wdata->remove_render_attribute( 'instagram-link', 'href', $item['link']['url']);
					$wdata->remove_render_attribute( 'elbzotech-item', 'class', 'elementor-repeater-item-'.$item['_id'] );
				}
			}
			else{
				if(!empty($settings['username']) && function_exists('bzotech_scrape_instagram')){
	                $media_array = bzotech_scrape_instagram($settings['username'], $settings['number'], $settings['token'], $settings['photos_size']);
	                if(isset($media_array['photos'])) $media_array = $media_array['photos'];
	                if(!empty($media_array)){
	                    foreach ($media_array as $item) {
	                        if(isset($item['link']) && isset($item['thumbnail_src'])){
	                        	echo '<div '.$wdata->get_render_attribute_string( 'elbzotech-item' ).'>';
	                        		echo '<div class="item-instagram item-instagram-'.$style_item.'">';
			                        	echo '<a href="'.esc_url($item['link']).'" rel="nofollow" class="img-wrap '.esc_attr($animation_class).'">
				                    		<img src="'.esc_url($item['thumbnail_src']).'"/>';
				                		echo '<h3 class="instagram-text-follow"><i class="lab la-instagram title16"></i> <span class="text">'.esc_html__("Instagram",'bw-petito').'</span></h3>';      	
				                    echo '</a></div>';
			                    echo '</div>';
	                        }
	                    }              
	                }
	            }
			}
	    	?>
		</div>
	</div>
	<?php if ( $slider_navigation !== '' ):?>
		<div class="bzotech-swiper-navi">
		    <div class="swiper-button-nav swiper-button-next"><?php Icons_Manager::render_icon( $settings['slider_icon_next'], [ 'aria-hidden' => 'true' ] );?></div>
			<div class="swiper-button-nav swiper-button-prev"><?php Icons_Manager::render_icon( $settings['slider_icon_prev'], [ 'aria-hidden' => 'true' ] );?></div>
		</div>
	<?php endif;
	if ( $slider_pagination !== '' ):?>
		<div class="swiper-pagination"></div>
	<?php endif; ?>
	 <?php if ( $slider_scrollbar !== '' ):?>
        <div class="swiper-scrollbar"></div>
    <?php endif?>
</div>