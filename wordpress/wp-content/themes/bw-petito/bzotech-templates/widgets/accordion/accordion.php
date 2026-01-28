<?php
namespace Elementor;
extract($settings);
use Bzotech_Template;
$active = (int)$active-1;
echo '<div class="elbzotech-accordion elbzotech-accordion-css elbzotech-accordion-'.$style.'" data-active="'.$active.'" data-animate="'.$animate.'" data-heightstyle="'.$heightstyle.'">';
 	foreach (  $list_accor as $key => $item ) {
        $wdata->add_render_attribute( 'elbzotech-title', 'class', 'item-title-e accordion-title elementor-repeater-item-'.$item['_id'] );
        $wdata->add_render_attribute( 'elbzotech-content', 'class', 'item-content-e accordion-content elementor-repeater-item-'.$item['_id'] );
        $icon_html='';
        if(!empty($icon['value'])) $icon_html = '<i class="icon-accor '.$icon['value'].'"></i>';
        if(!empty($icon_active['value'])) $icon_html .= '<i class="icon-accor-active '.$icon_active['value'].'"></i>';
        if(!empty($icon['value']) || !empty($icon_active['value'])) $icon_html = '<span class="box-icon-accor item-icon-e">'. $icon_html.'</span>';
        $title = '<span>'.$item['title'].'</span>';

        echo '<h3 '.$wdata->get_render_attribute_string( 'elbzotech-title' ).'><span class="text item-title-e">'. $item['title'].'</span>'.$icon_html.'</h3>';
        echo '<div '.$wdata->get_render_attribute_string( 'elbzotech-content' ).'>';
           
            if(!empty($item['template'])) {
             
             echo Bzotech_Template::get_vc_pagecontent($item['template']);
            }
            else if(!empty($item['content'])){
                echo  bzotech_parse_text_editor( $item['content']);
            }  
                    
        echo '</div>';
        $wdata->remove_render_attribute( 'elbzotech-title', 'class', 'accordion-title elementor-repeater-item-'.$item['_id'] );
        $wdata->remove_render_attribute( 'elbzotech-content', 'class', 'accordion-content elementor-repeater-item-'.$item['_id'] );
    }

echo '</div>';