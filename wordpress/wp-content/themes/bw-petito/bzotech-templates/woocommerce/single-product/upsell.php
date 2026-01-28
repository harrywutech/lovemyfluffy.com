<?php
global $product;
/*'Get value to theme option : $show_latest, $show_upsell, $show_related, $number, $size, $item_res, $item_style,*/
extract(bzotech_show_single_product_data());
$upsells = $product->get_upsell_ids();
if($show_upsell == '1' && $upsells):?>  
    <div class="single-related-product">
          <div class="title-related-product">
                <h2 class="single-title2 elbzotech-heading-style2">
                <?php esc_html_e("You may also like&hellip;",'bw-petito')?>
            </h2>
        </div>
        <?php 
            $items = '3'; /*number*/
            $items_tablet = '3'; /*number*/
            $items_mobile = '1'; /*number*/
            $space = '30'; /*number px*/
            $space_tablet = ''; /*number px*/
            $space_mobile = ''; /*number px*/
            $column = ''; /*number*/
            $auto = ''; /*yes or empty*/
            $center = ''; /*yes or empty*/
            $loop = ''; /*yes or empty*/
            $speed = ''; /*number ms*/
            $slider_navigation = ''; /*yes or empty*/
            $slider_pagination = ''; /*yes or empty*/
            $slider_scrollbar = ''; /*yes or empty*/
            $size = bzotech_get_size_crop($size);

            $item_wrap = 'class="swiper-slide item-grid-product-'.$item_style.'"';
            $item_inner = 'class="item-product"';
            $button_icon_pos = $button_icon = $button_text = $column = '';
            $item_thumbnail = $item_quickview = $item_label = $item_title = $item_rate = $item_price = $item_button = 'yes';
            $thumbnail_hover_animation = 'zoom-thumb';
            $view = 'slider';
            $attr = array(
            'item_wrap'         => $item_wrap,
            'item_inner'        => $item_inner,
            'button_icon_pos'   => $button_icon_pos,
            'button_icon'       => $button_icon,
            'button_text'       => $button_text,
            'size'              => $size,
            'view'              => $view,
            'column'            => $column,
            'item_style'        => $item_style,
            'item_thumbnail'    => $item_thumbnail,
            'item_label'        => $item_label,
            'item_title'        => $item_title,
            'item_price'        => $item_price,
            'item_button'       => $item_button,
            'animation'         => $thumbnail_hover_animation,
            );
        ?>
        <div class="elbzotech-wrapper-slider <?php if(!empty($slider_navigation)) echo esc_attr('display-swiper-navi-'.$slider_navigation); ?> <?php if(!empty($slider_pagination)) echo esc_attr('display-swiper-pagination-'.$slider_pagination); ?> <?php if(!empty($slider_scrollbar)) echo esc_attr('display-swiper-scrollbar-'.$slider_scrollbar); ?>">
            <div class="elbzotech-swiper-slider swiper-container slider-nav-group-top" 
            data-items-custom="<?php echo esc_attr($items_custom)?>" 
                data-items="<?php echo esc_attr($items)?>" 
                data-items-tablet="<?php echo esc_attr($items_tablet)?>" 
                data-items-mobile="<?php echo esc_attr($items_mobile)?>" 
                data-space="<?php echo esc_attr($space)?>" 
                data-space-tablet="<?php echo esc_attr($space_tablet)?>" 
                data-space-mobile="<?php echo esc_attr($space_mobile)?>" 
                data-column="<?php echo esc_attr($column)?>" 
                data-auto="<?php echo esc_attr($auto)?>" 
                data-center="<?php echo esc_attr($center)?>" 
                data-loop="<?php echo esc_attr($loop)?>" 
                data-speed="<?php echo esc_attr($speed)?>" 
                data-navigation="<?php echo esc_attr($slider_navigation)?>" 
                data-pagination="<?php echo esc_attr($slider_pagination)?>" 
            >
                <div class="swiper-wrapper">
                    <?php
                        $meta_query = WC()->query->get_meta_query();
                        $args = array(
                            'post_type'           => 'product',
                            'ignore_sticky_posts' => 1,
                            'no_found_rows'       => 1,
                            'posts_per_page'      => $number,
                            'post__in'            => $upsells,
                            'post__not_in'        => array( $product->get_id() ),
                            'meta_query'          => $meta_query
                        );
                        $products = new WP_Query( $args );
                        if ( $products->have_posts() ) :
                            while ( $products->have_posts() ) : 
                                $products->the_post();                                  
                                bzotech_get_template_woocommerce('loop/grid/grid',$item_style,$attr,true);
                            endwhile;
                        endif;
                        wp_reset_postdata();
                    ?>
                </div>
            </div>
            <?php if ( $slider_navigation !== '' ):?>
                <div class="bzotech-swiper-navi">
                    <div class="swiper-button-nav swiper-button-next"><i class="las la-arrow-right"></i></div>
                    <div class="swiper-button-nav swiper-button-prev"><i class="las la-arrow-left"></i></div>
                </div>
            <?php endif?>
            <?php if ( $slider_pagination !== '' ):?>
                <div class="swiper-pagination "></div>
            <?php endif?>
            <?php if ( $slider_scrollbar !== '' ):?>
                <div class="swiper-scrollbar"></div>
            <?php endif?>
        </div>
    </div>
<?php endif;?>