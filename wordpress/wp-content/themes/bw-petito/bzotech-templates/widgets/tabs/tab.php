<?php
namespace Elementor;
use Bzotech_Template;
extract($settings);
$wdata->add_render_attribute( 'wrap', 'class', 'elbzotech-tabs elbzotech-tabs-'.$style.' tabs-'.$type);
$id_int = substr( $wdata->get_id_int(), 0, 3 );
$tab_title_html = $tab_content_html = '';
foreach ( $tabs as $key => $tab ) : 
	extract($tab); 
	if($key == 0) $active = 'active'; else $active = '';
	$tab_title_html .= '<li class="tab-item-wrap '.esc_attr($active).'">';

	$tab_title_html .= '<a class="icon_pos-'.$icon_pos.'" title = "'.$tab_title.'" href="#'.esc_attr($_id).''.$id_int.'" data-target="#'.esc_attr($_id).''.$id_int.'" data-toggle="tab" aria-expanded="false">';
	if(($icon_pos == 'left-text' || $icon_pos == 'top-text') && !empty($icon['value'])) $tab_title_html .= '<i class="'.$icon['value'].'"></i>';
	$tab_title_html .= $tab_title;
	if(($icon_pos == 'right-text' || $icon_pos == 'bottom-text')&& !empty($icon['value'])) $tab_title_html .= '<i class="'.$icon['value'].'"></i>';
	$tab_title_html .= '</a>';
	$tab_title_html .= '</li>';
	$tab_content_html .= '<div id="'.$_id.''.$id_int.'" class="tab-pane '.$active.'">';
	if(!empty($template)) $tab_content_html .= Bzotech_Template::get_vc_pagecontent($template);
	else   $tab_content_html .= bzotech_parse_text_editor( $tab_content); 
    $tab_content_html .= '</div>';

endforeach; ?>
<div <?php echo apply_filters('bzotech_output_content',$wdata->get_render_attribute_string( 'wrap')) ?>>
	<?php if($type == 'horizontal-bottom' || $type == 'vertical-right'){ ?>
		<div class="tab-content <?php if($type == 'vertical-right') echo esc_attr($horizontal_align_content.' '.$vertical_align_content); ?>">
			<?php echo apply_filters('bzotech_output_content',$tab_content_html); ?>
		</div>
	<?php } ?>
	
	<div class="header-tab-layout <?php echo esc_attr($content_width_tab_header);?> <?php if($type == 'vertical-left' || $type == 'vertical-right' and !empty($vertical_tab_header)) echo esc_attr($vertical_tab_header.' '.$horizontal_tab_header); ?>">
		<div class="header-tab title-header-<?php echo esc_attr($style_title_header); ?> item-title-header-<?php echo esc_attr($item_title_header_style); ?> <?php echo esc_attr($layout_tab_header); ?> <?php if(!empty($title_header) || !empty($sub_title_header)) echo "title-subtitle-on"?>">
		
			<?php if(!empty($title_header) || !empty($sub_title_header)){?>
				<div class="div-title-header <?php if($layout_tab_header == 'flex-wrapper flex_wrap-wrap') echo esc_attr($horizontal_align_title.' '.$vertical_align_title); ?>">
					<?php  if(!empty($title_header))echo '<h3 class="title-header">'.$title_header.'</h3>';  ?>
					<?php  if(!empty($sub_title_header))echo '<p class="sub-title-header">'.$sub_title_header.'</p>';  ?>
				</div>
				<?php
			}?>
			<div class="header-tab-list <?php if($layout_tab_header == 'flex-wrapper flex_wrap-wrap') echo esc_attr($horizontal_align_item_tab.' '.$vertical_align_item_tab); ?>">
				<ul class="list-none nav nav-tabs" role="tablist">
					<?php echo apply_filters('bzotech_output_content',$tab_title_html); ?>
				</ul>
			</div>
		
		</div>
	</div>
	<?php if($type == 'horizontal-top' || $type == 'vertical-left'){ ?>
		<div class="tab-content <?php if($type == 'vertical-left') echo esc_attr($horizontal_align_content.' '.$vertical_align_content); ?>">
			<?php echo apply_filters('bzotech_output_content',$tab_content_html); ?>
		</div>
	<?php } ?>
</div>