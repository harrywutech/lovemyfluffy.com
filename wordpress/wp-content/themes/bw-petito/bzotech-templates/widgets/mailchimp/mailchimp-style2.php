<?php

namespace Elementor;
$check = true;
if(isset($_SESSION['dont_show_popup'])) $check = !$_SESSION['dont_show_popup'];
if($check):
	extract($settings);
	$wdata->add_render_attribute( 'wrapper', 'class', 'elbzotech-mailchimp-wrap sv-mailchimp-form  elbzotech-mailchimp-'.$style.' '.$align_form);
	$wdata->add_render_attribute( 'wrapper', 'data-placeholder', $placeholder);
	$wdata->add_render_attribute( 'wrapper', 'data-submit', $mailchimp_bttext);
	$wdata->add_render_attribute( 'wrapper', 'data-icon', $icon_mailchimp);
	$wdata->add_render_attribute( 'wrapper', 'data-textpos', $mailchimp_bttext_pos);
	?>
	<div <?php echo ''.$wdata->get_render_attribute_string('wrapper');?>>
		<div class="content-popup-mailchimp" <?php echo bzotech_add_html_attr('background-image: url('.esc_url($image['url']).');')?>>
			<i class="las la-times icon-bzo icon-bzo-close elbzotech-close-popup"></i>
			<div class="adv-thumb-link"></div>
			<div class="info-mailchimp bzotech-scrollbar">
				<?php if(!empty($title)) echo '<h3 class="title title48 font-title color-title font-semibold">'.$title.'</h3>'; ?>
				<?php if(!empty($desc)) echo '<div class="desc title18 font-regular">'.$desc.'</div>'; ?>
				<?php echo apply_filters('bzotech_mailchimp_form',do_shortcode('[mc4wp_form id="'.$settings['form_id'].'"]'));?>
				 
				<?php 

				if(!empty($list_social)){
					echo '<div class="flex-wrapper align_items-center justify_content-center">';
					foreach (  $list_social as $key => $item ) {
						$wdata->add_render_attribute( 'social-link'.$key, 'class', 'item-social title24');
						if($item['link']['is_external']) $wdata->add_render_attribute( 'social-link'.$key, 'target', "_blank");
						if($item['link']['nofollow']) $wdata->add_render_attribute( 'social-link'.$key, 'rel', "nofollow");
						if($item['link']['url']) $wdata->add_render_attribute( 'social-link'.$key, 'href', $item['link']['url']);
						
						if(!empty($item['icon']['value'])) echo'<a '.apply_filters('bzotech_output_content', $wdata->get_render_attribute_string('social-link'.$key)).'><i class="'.$item['icon']['value'].'"></i></a>';
					}
					echo '</div>';
				}
				?>
				<div class="text-center dont-show"><input type="checkbox" id="close-newsletter"> <label for="close-newsletter"><?php esc_html_e("Don’t show this pop-up again",'bw-petito')?></label></div>
			</div>
		</div>
	</div>
<?php endif;