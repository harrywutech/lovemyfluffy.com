<?php
namespace Elementor;
extract($settings);

$wdata->add_render_attribute( 'banner-wrap', 'class', 'elbzotech-banner-info-wrap elbzotech-banner-info-'.$banner_style.' '.$image_effect_banner.' '.$box_overflow);

$wdata->add_render_attribute( 'banner-image-link', 'class', "adv-thumb-link");
if($link['is_external']) $wdata->add_render_attribute( 'banner-image-link', 'target', "_blank");
if($link['nofollow']) $wdata->add_render_attribute( 'banner-image-link', 'rel', "nofollow");
if($link['url']) $wdata->add_render_attribute( 'banner-image-link', 'href', $link['url']);
?>
<div <?php echo apply_filters('bzotech_output_content', $wdata->get_render_attribute_string('banner-wrap')); ?> >
	<div class="flex-wrapper flex_wrap-wrap justify_content-center align-content-center">
		<?php
		if(!empty($image['url'])) { ?>
			<div class="elbzotech-banner-info-thumb <?php echo esc_attr($image_effect_banner.' '.$box_overflow); ?>" >
				<a <?php echo apply_filters('bzotech_output_content', $wdata->get_render_attribute_string('banner-image-link')); ?> >
					<?php echo Group_Control_Image_Size::get_attachment_image_html( $settings); ?>
					<?php 
					if($image_effect_banner == 'zoom-out' || $image_effect_banner == 'zoom-out overlay-image'){
						if(!empty($image2['url'])) {
							echo Group_Control_Image_Size::get_attachment_image_html( $settings,'image','image2');
						}else echo Group_Control_Image_Size::get_attachment_image_html( $settings);
					}


					if(!empty($sub_title)){
						echo'<p class="item-sub-title-e color-white title100">'.$sub_title.'</p>';
					}
				?>

				</a>
			</div>
		<?php }


		if($title){
			echo '<div class="banner-info ">';
			if($title) echo '<h3 class="item-title-e title28 font-semibold color-title">'.$title.'</h3>';
			
			echo '</div>';
		}?>

	</div>
</div>