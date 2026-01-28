<?php
extract($settings);

if($header_style == ''){
	echo '<div class="elbzotech-text-editor text-css-e">'.bzotech_parse_text_editor($editor).'</div>';

}else if($header_style == 'style3'){
	if(!empty($title_id))$title=$title_id;
	$wdata->add_render_attribute( 'heading', 'class', 'elbzotech-heading text-css-e title24 color-title elbzotech-heading-'.$settings['header_style'] );
	if ( !empty( $settings['link']['url'] ) ) {
			$wdata->add_link_attributes( 'url', $settings['link'] );

			$title = sprintf( '<a %1$s>%2$s</a>', $wdata->get_render_attribute_string( 'url' ), $title );
		}

	echo sprintf( '<%1$s %2$s><span>%3$s</span></%1$s>', $settings['header_size'], $wdata->get_render_attribute_string( 'heading' ), $title );

}
else if($header_style == 'style2'){
	if(!empty($title_id))$title=$title_id;
	$wdata->add_render_attribute( 'heading', 'class', 'elbzotech-heading text-css-e title26 font-weight text-center elbzotech-heading-'.$settings['header_style'] );
	if ( !empty( $settings['link']['url'] ) ) {
			$wdata->add_link_attributes( 'url', $settings['link'] );

			$title = sprintf( '<a %1$s>%2$s</a>', $wdata->get_render_attribute_string( 'url' ), $title );
		}

	echo sprintf( '<%1$s %2$s><span>%3$s</span></%1$s>', $settings['header_size'], $wdata->get_render_attribute_string( 'heading' ), $title );

}else if($header_style == 'style33'){
	if(!empty($title_id))$title=$title_id;
	$wdata->add_render_attribute( 'heading', 'class', 'elbzotech-heading text-css-e title34 font-regular color-home2 text-center elbzotech-heading-'.$settings['header_style'] );
	if ( !empty( $settings['link']['url'] ) ) {
			$wdata->add_link_attributes( 'url', $settings['link'] );

			$title = sprintf( '<a %1$s>%2$s</a>', $wdata->get_render_attribute_string( 'url' ), $title );
		}

	echo sprintf( '<%1$s %2$s><span>%3$s</span></%1$s>', $settings['header_size'], $wdata->get_render_attribute_string( 'heading' ), $title );

}else if($header_style == 'style44'){
	if(!empty($title_id))$title=$title_id;
	$wdata->add_render_attribute( 'heading', 'class', 'elbzotech-heading text-css-e title34 font-bold text-center elbzotech-heading-'.$settings['header_style'] );
	if ( !empty( $settings['link']['url'] ) ) {
			$wdata->add_link_attributes( 'url', $settings['link'] );

			$title = sprintf( '<a %1$s>%2$s</a>', $wdata->get_render_attribute_string( 'url' ), $title );
		}

	echo sprintf( '<%1$s %2$s><span>%3$s</span></%1$s>', $settings['header_size'], $wdata->get_render_attribute_string( 'heading' ), $title );

}else if($header_style == 'style55'){
	if(!empty($title_id))$title=$title_id;
	$wdata->add_render_attribute( 'heading', 'class', 'elbzotech-heading text-css-e title34 font-regular text-center elbzotech-heading-'.$settings['header_style'] );
	if ( !empty( $settings['link']['url'] ) ) {
			$wdata->add_link_attributes( 'url', $settings['link'] );

			$title = sprintf( '<a %1$s>%2$s</a>', $wdata->get_render_attribute_string( 'url' ), $title );
		}

	echo sprintf( '<%1$s %2$s><span>%3$s</span></%1$s>', $settings['header_size'], $wdata->get_render_attribute_string( 'heading' ), $title );

}else {
	if(!empty($title_id))$title=$title_id;
	$wdata->add_render_attribute( 'heading', 'class', 'elbzotech-heading text-css-e title24 color-title elbzotech-heading-'.$settings['header_style'] );
	if ( !empty( $settings['link']['url'] ) ) {
			$wdata->add_link_attributes( 'url', $settings['link'] );

			$title = sprintf( '<a %1$s>%2$s</a>', $wdata->get_render_attribute_string( 'url' ), $title );
		}
		$sub_title_text='';
	if($header_style == 'style4' && !empty($sub_title)) $sub_title_text ='<span class="sub-title-style4 sub-title-e">'.$sub_title.'</span>';
	echo sprintf( '<%1$s %2$s>%3$s'.$sub_title_text.'</%1$s>', $settings['header_size'], $wdata->get_render_attribute_string( 'heading' ), $title );
	
} 