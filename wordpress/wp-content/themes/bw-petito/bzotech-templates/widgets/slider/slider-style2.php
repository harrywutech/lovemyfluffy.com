<?php
namespace Elementor;
extract($settings); 
use Bzotech_Template;
?>
<?php echo '<div '.$wdata->get_render_attribute_string( 'elbzotech-wrapper' ).'>';?>
    <?php echo '<div '.$wdata->get_render_attribute_string( 'elbzotech-wrapper-slider' ).'>';?>
        <?php echo '<div '.$wdata->get_render_attribute_string( 'elbzotech-inner' ).'>';?>
            <?php 
            foreach (  $list_cate as $key => $item ) {

                $wdata->add_render_attribute( 'elbzotech-item', 'class', 'wslider-item elementor-repeater-item-'.$item['_id'] );
                echo '<div '.$wdata->get_render_attribute_string( 'elbzotech-item' ).'><div class="item-slider-'.$style.'">';
                    
                    $link_html = $title_html =$desc_html = $image_html =$count_html ='';
                    if(!empty($item['category'])){
                        $cat = get_term_by('slug', $item['category'], 'product_cat');
                        if($cat->term_id){
                            $link_html =  'href="'.get_term_link($item['category'],'product_cat').'"';
                            $title_html = $cat->name;
                            $count_html = '<span class="count">'.sprintf( _nx( '%1$s Item', '%1$s Items', $cat->count, 'count category', 'bw-petito' ),number_format_i18n( $cat->count )).'</span>';
                            $thumbnail_id = get_term_meta( $cat->term_id, 'thumbnail_id', true );
                            $image_html    = wp_get_attachment_image( $thumbnail_id ,'full');
                            $desc_html    = category_description($cat->term_id);
                        }
                        
                    }
                    if ( ! empty( $item['link']['url'] ) ) {
                        $wdata->add_link_attributes( 'data_link', $item['link']);
                        if($item['link']['is_external']) $wdata->add_render_attribute( 'data_link', 'target', "_blank");
                        if($item['link']['nofollow']) $wdata->add_render_attribute( 'data_link', 'rel', "nofollow");
                        $link_html = $wdata->get_render_attribute_string( 'data_link');
                    }
                    if(!empty($item['title'])){
                        $title_html = $item['title'];
                    }
                    if(!empty($item['image']['url'])){
                        $image_html = wp_get_attachment_image( $item['image']['id'] ,'full');
                    }
                   
                    
                    if(!empty($item['template'])) 
                        echo Bzotech_Template::get_vc_pagecontent($item['template']);
                    else {
                       echo '<div class="flex-wrapper align_items-center"><a class="adv-thumb-link-cate" '.$link_html.'>'.$image_html.'</a>
        <div class="info"><div class="info-cate"><h2 class="title font-title color-title font-medium title18"><a '.$link_html.'>'.$title_html.'</a></h2><div class="">'.$count_html.'</div></div></div><a class="btn-cate" '.$link_html.'><i class="las la-angle-right"></i></a></div>';
                    }  
                            
                echo '</div></div>';

                $wdata->remove_render_attribute( 'img-link', 'target', "_blank" );
                $wdata->remove_render_attribute( 'img-link', 'rel', "nofollow");
                $wdata->remove_render_attribute( 'img-link', 'href', $item['link']['url']);
                $wdata->remove_render_attribute( 'img-link', 'href', $item['image']['url']);
                $wdata->remove_render_attribute( 'elbzotech-item', 'class', 'elementor-repeater-item-'.$item['_id'] );
            }
            ?>
        </div>
    </div>
    <?php if ( $slider_navigation !== '' ):?>
        <div class="bzotech-swiper-navi">
            <div class="swiper-button-nav swiper-button-next"><?php Icons_Manager::render_icon( $slider_icon_next, [ 'aria-hidden' => 'true' ] );?></div>
            <div class="swiper-button-nav swiper-button-prev"><?php Icons_Manager::render_icon( $slider_icon_prev, [ 'aria-hidden' => 'true' ] );?></div>
        </div>
    <?php endif?>
    <?php if ( $slider_pagination !== '' ):?>
        <div class="swiper-pagination"></div>
    <?php endif?>
    <?php if ( $slider_scrollbar !== '' ):?>
        <div class="swiper-scrollbar"></div>
    <?php endif?>
</div>