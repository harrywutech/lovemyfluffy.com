<?php
namespace Elementor;
extract($settings);

$wdata->add_render_attribute( 'wrapper', 'class', 'bzoteche-info-box-'.$settings['style'].' item-info-box');

?>
<div <?php echo apply_filters('bzotech_output_content', $wdata->get_render_attribute_string('wrapper'));?>>
	<?php
	if(!empty($content)){
		echo'<div class="box-content-custom">
				'.bzotech_parse_text_editor( $content).'
			</div>';	
	} else if(!empty($title)){
		if ( !empty( $link_info['url']) ){ $wdata->add_link_attributes( 'link_blockquote', $link_info); }
		echo'<blockquote class="item-title-e title24 color" '.$wdata->get_render_attribute_string( 'link_blockquote' ).'>'.$title;
		if(!empty($sub_title)) echo '<cite>'.$sub_title.'</cite>';
		echo'</blockquote>';
	} ?>
</div>