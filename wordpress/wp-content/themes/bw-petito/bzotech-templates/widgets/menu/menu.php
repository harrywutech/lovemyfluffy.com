<?php
if($settings['nav_menu'] != '' && wp_get_nav_menu_items($settings['nav_menu']) !== false){
			
	$logo_mobile = $close_bt ='';
	if(isset($settings['bzotech_nav_menu_logo']['url']) && !empty($settings['bzotech_nav_menu_logo']['url'])){
		$logo_mobile = 	'<a class="mobile-logo" href="'.esc_url(home_url('/')).'">
							<img src="'.$settings['bzotech_nav_menu_logo']['url'].'" alt="'.esc_attr__("logo mobile",'bw-petito').'" >
						</a>';
	}

	if($settings['main_menu_style'] =="icon"){
		$menu_title=esc_html__('Menu','bw-petito');
		if(!empty($settings['replace_menu_title'])) $menu_title=$settings['replace_menu_title'];
		$icon_button='';
		if($settings['icon_mobile_menu']['library']=='svg'){
			$icon_button ='<img src="'.$settings['icon_mobile_menu']['url'].'">';
		}else if(!empty($settings['icon_mobile_menu']['value'])){
			$icon_button ='<i class="'.$settings['icon_mobile_menu']['value'].'"></i>';
		}
		$position_content = 'position_content-'.$settings['menu_icon_position_content'];
		$icon_html = '<div class="bzotech-nav-identity-panel toggler-icon">					
							<span class="bzotech-menu-toggler title20">'.$icon_button.'
							<span class="text-menu title18 font-title">'.$menu_title.'</span>
							</span>
					</div>';
		$close_bt = '<div class="bzotech-nav-identity-panel panel-inner">
							'.$logo_mobile.'
							<div class="close-menu">
								<i class="las la-times"></i>
							</div>
						</div>';
	}else{
		$position_content = '';
		$icon_html='<a href="#" class="toggle-mobile-menu"><i class="white la la-reorder"></i></a>';
	}
	
	
	
	echo 	'<div class="bzotech-menu-container bzotech-navbar-nav-default '.$settings['style_tab_submenu_item_arrow'].' menu-style-'.$settings['main_menu_style'].' '.$settings['style_effect_hover'].' '.$position_content.'">
				'.$icon_html.'
				<div class="bzotech-menu-inner">';
					wp_nav_menu([
						'items_wrap'      => $close_bt.'<ul id="%1$s" class="%2$s">%3$s</ul>',
						'container'       => false,
						'menu_id'         => '',
						'menu'         	  => $settings['nav_menu'],
						'menu_class'      => 'bzotech-navbar-nav menu-sticky-'.$settings['menu_sticky'].' style-menu-sticky-'.$settings['style_menu_sticky'],
						'depth'           => 4,
						'echo'            => true,
						'fallback_cb'     => 'wp_page_menu',
						'theme_location'    => 'primary',
						'walker'          => new Bzotech_Walker_Nav_Menu()
					]);
	echo 		'</div>
			</div>';
}
