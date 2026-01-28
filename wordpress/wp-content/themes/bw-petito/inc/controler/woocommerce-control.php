<?php
 /**
 * 
 * Remove action general
 * 
 *
 * */
remove_action( 'woocommerce_before_main_content','woocommerce_breadcrumb',20 );
remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10);
remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10);
remove_action( 'woocommerce_before_shop_loop','woocommerce_result_count',20 );
remove_action( 'woocommerce_before_shop_loop','woocommerce_catalog_ordering',30 );
remove_action( 'woocommerce_after_shop_loop','woocommerce_pagination',10 );
remove_action( 'woocommerce_sidebar','woocommerce_get_sidebar',10 );
remove_action( 'woocommerce_cart_collaterals', 'woocommerce_cross_sell_display' );
 /**
 * 
 * Remove action loop product
 * 
 *
 * */
remove_action( 'woocommerce_before_shop_loop_item','woocommerce_template_loop_product_link_open',10 );
remove_action( 'woocommerce_before_shop_loop_item_title','woocommerce_show_product_loop_sale_flash',10 );
remove_action( 'woocommerce_before_shop_loop_item_title','woocommerce_template_loop_product_thumbnail',10 );
remove_action( 'woocommerce_shop_loop_item_title','woocommerce_template_loop_product_title',10 );
remove_action( 'woocommerce_after_shop_loop_item_title','woocommerce_template_loop_rating',5 );
remove_action( 'woocommerce_after_shop_loop_item_title','woocommerce_template_loop_price',10 );
remove_action( 'woocommerce_after_shop_loop_item','woocommerce_template_loop_product_link_close',5 );
remove_action( 'woocommerce_after_shop_loop_item','woocommerce_template_loop_add_to_cart',10 );

 /**
 * 
 * Remove action single product
 * 
 *
 * */
remove_action( 'woocommerce_before_single_product_summary','woocommerce_show_product_sale_flash',10 );
remove_action( 'woocommerce_before_single_product_summary','woocommerce_show_product_images',20 );
remove_action( 'woocommerce_product_thumbnails','woocommerce_show_product_thumbnails',20 );
remove_action( 'woocommerce_single_product_summary','woocommerce_template_single_title',5 );
remove_action( 'woocommerce_single_product_summary','woocommerce_template_single_sharing',50 );
remove_action( 'woocommerce_single_product_summary','woocommerce_template_single_price',10 );   
//remove_action( 'woocommerce_single_product_summary','woocommerce_template_single_rating',10 ); 
remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_product_data_tabs', 10 );
remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_upsell_display', 15 );
remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 20 );
add_filter( 'woocommerce_show_admin_notice', function ( $show, $notice ) {
    if ( 'template_files' === $notice ) {
        return false;
    }

    return $show;
}, 10, 2 );
/**
 * 
 * 
 ********************* Add hook single product ********************* 
 *  
 *
 * */

 /**
 * 
 * Set template single price
 * Hook to woocommerce_single_product_summary
 *
 * */
add_action( 'woocommerce_single_product_summary','woocommerce_template_single_price',10 );

 /**
 * 
 * Custom description product single
 *  
 * @return html
 *
 * */
add_filter( 'woocommerce_short_description', 'bzotech_custom_short_description', 10 );
if(!function_exists('bzotech_custom_short_description')){
    function bzotech_custom_short_description( $des ) {
        $show_des = bzotech_get_option('show_excerpt','1');
        if($show_des == '1' && $des) return '<div class="product-desc">'.$des.'</div>';
    }
}
/**
 * 
 * Add content before tab
 * Hook to woocommerce_after_single_product_summary
 * 
 * @return void
 *
 * */
add_action( 'woocommerce_after_single_product_summary', 'bzotech_product_tabs_before', 5 );
if(!function_exists('bzotech_product_tabs_before')){
    function bzotech_product_tabs_before(){            
        $page_id = bzotech_get_value_by_id('before_append_tab');
        $class = 'bzotech-'.str_replace ('.php','',get_page_template_slug($page_id));
        if(!empty($page_id)) echo '<div class="content-append-before-tab '.$class.'">'.Bzotech_Template::get_vc_pagecontent($page_id).'</div>';
    }
}

/**
 * 
 * Set tab woocommerce
 * Hook to woocommerce_after_single_product_summary
 * 
 * @return void
 *
 * */
add_action( 'woocommerce_after_single_product_summary', 'bzotech_product_tabs', 10 );
if(!function_exists('bzotech_product_tabs')){
    function bzotech_product_tabs(){            
        bzotech_get_template_woocommerce('single-product/tabs','',false,true);
    }
}

/**
 * 
 * Add content after tab
 * Hook to woocommerce_after_single_product_summary
 * 
 * @return void
 *
 * */
add_action( 'woocommerce_after_single_product_summary', 'bzotech_product_tabs_after', 15 );
if(!function_exists('bzotech_product_tabs_after')){
    function bzotech_product_tabs_after(){            
        $page_id = bzotech_get_value_by_id('after_append_tab');
        $class = 'bzotech-'.str_replace ('.php','',get_page_template_slug($page_id));
        if(!empty($page_id)) echo '<div class="content-append-after-tab '.$class.'">'.Bzotech_Template::get_vc_pagecontent($page_id).'</div>';
    }
}

/**
 * 
 * Add product upsell
 * Hook to woocommerce_after_single_product_summary
 * 
 * @return void
 *
 * */
add_action( 'woocommerce_after_single_product_summary', 'bzotech_single_upsell_product', 15 );
if(!function_exists('bzotech_single_upsell_product')){
    function bzotech_single_upsell_product($style=''){
        bzotech_get_template_woocommerce('single-product/upsell',$style,false,true);
    }
}

/**
 * 
 * Add product related
 * Hook to woocommerce_after_single_product_summary
 * 
 * @return void
 *
 * */
add_action( 'woocommerce_after_single_product_summary', 'bzotech_single_relate_product', 20 );
if(!function_exists('bzotech_single_relate_product')){
    function bzotech_single_relate_product($style=''){            
        bzotech_get_template_woocommerce('single-product/related','',false,true);
    }
}

/**
 * 
 * Add product latest
 * Hook to woocommerce_after_single_product_summary
 * 
 * @return void
 *
 * */
add_action( 'woocommerce_after_single_product_summary', 'bzotech_single_lastest_product', 25 );
if(!function_exists('bzotech_single_lastest_product')){
    function bzotech_single_lastest_product(){
        bzotech_get_template_woocommerce('single-product/latest','',false,true);
    }
}

/**
 * 
 * Custom tab, add tab
 * Hook to woocommerce_product_tabs
 * 
 * @return void
 *
 * */
add_filter( 'woocommerce_product_tabs', 'bzotech_custom_product_tab', 98 );
if(!function_exists('bzotech_custom_product_tab')){
    function bzotech_custom_product_tab( $tabs ) {
        $data_tabs = get_post_meta(get_the_ID(),'bzotech_product_tab_data',true);
        if(!empty($data_tabs) and is_array($data_tabs)){
            foreach ($data_tabs as $key=>$data_tab){
                if(!empty($data_tab['tab_content']) && $data_tab['tab_content'] != ' '){
                    $tabs['bzotech_custom_tab_' . $key] = array(
                        'title' => (!empty($data_tab['title']) ? $data_tab['title'] : $key),
                        'priority' => (!empty($data_tab['priority']) ? (int)$data_tab['priority'] : 50),
                        'callback' => 'bzotech_render_tab',
                        'content' => apply_filters('the_content', $data_tab['tab_content']) //this allows shortcodes in custom tabs
                    );
                }
            }
        }
        return $tabs;
    }
}

if(!function_exists('bzotech_render_tab')){
    function bzotech_render_tab($key, $tab) {
        echo apply_filters('bzotech_product_custom_tab_content', $tab['content'], $tab, $key);
    }
}

/**
 * 
 * Remover description heading of content
 * Hook to woocommerce_product_description_heading
 * 
 * @return void
 *
 * */
add_filter( 'woocommerce_product_description_heading', '__return_null' );

/**
 * 
 * Remover ywctm in single product
 * Hook to ywctm_modify_woocommerce_after_shop_loop_item
 * 
 * @return html
 *
 * */
add_filter( 'ywctm_modify_woocommerce_after_shop_loop_item', 'bzotech_remove_modify_after_shop_loop_item' );
if(!function_exists('bzotech_remove_modify_after_shop_loop_item')){
    function bzotech_remove_modify_after_shop_loop_item(){
        return false;
    }
}

/**
 * 
 * 
 ********************* Add Hook General ********************* 
 *  
 *
 * */

/**
 * 
 * Set wrap before woocommerce page
 * Hook to woocommerce_before_main_content
 * 
 * @return html
 *
 * */
add_action( 'woocommerce_before_main_content','bzotech_woocommerce_wrap_before', 10 );
if(!function_exists('bzotech_woocommerce_wrap_before')){
    function bzotech_woocommerce_wrap_before(){
        $get_style_woo_single = bzotech_get_value_by_id('sv_style_woo_single');
        ?>
        <?php do_action('bzotech_before_main_content')?>
        <div id="main-content" class="content-page">
            <div class="bzotech-container">
                <div class="bzotech-row">
                
                    <?php
                     if(is_singular('product') and $get_style_woo_single == 'style-featured'){
                        //no sidebar
                     }else{
                          bzotech_output_sidebar('left');
                     }
                    ?>
                    <div class="main-wrap-shop <?php echo esc_attr(bzotech_get_main_class()); ?>">
                        <div class="shop-list-view">
        <?php
    }
}

/**
 * 
 * Set wrap after woocommerce page
 * Hook to woocommerce_after_main_content
 * 
 * @return html
 *
 * */
add_action( 'woocommerce_after_main_content', 'bzotech_woocommerce_wrap_after', 10 );
if(!function_exists('bzotech_woocommerce_wrap_after')){
    function bzotech_woocommerce_wrap_after(){
        $get_style_woo_single = bzotech_get_value_by_id('sv_style_woo_single'); ?>
                        </div> <!-- shop-list-view --> 
                    </div><!-- main-wrap-shop -->
                    <?php
                     if(is_singular('product') and $get_style_woo_single == 'style-featured'){
                            //no sidebar
                     }else{
                          bzotech_output_sidebar('right');
                     }
                     ?>
               
                </div> <!-- close row --> 
            </div> <!-- close container --> 
        </div>  <!-- close content-page -->    
        <?php do_action('bzotech_after_main_content')?>
        <?php
    }
}

/**
 * 
 * remove title page woo
 * Hook to woocommerce_show_page_title
 * 
 * @return boolean
 *
 * */
add_filter( 'woocommerce_show_page_title', 'bzotech_remove_page_title' );
if(!function_exists('bzotech_remove_page_title')){
    function bzotech_remove_page_title() {
        return false;
    }
}

/**
 * 
 * Add top filter
 * Hook to woocommerce_before_shop_loop
 * 
 * @return void
 *
 * */
add_action( 'woocommerce_before_shop_loop', 'bzotech_woocommerce_top_filter', 25 );
if(!function_exists('bzotech_woocommerce_top_filter')){
    function bzotech_woocommerce_top_filter(){
        $view          = bzotech_get_option('shop_default_style','grid');
       
     
        $number         = bzotech_get_option('woo_shop_number',12);
       
        $show_number   = bzotech_get_option('shop_number_filter');
       
        $show_type     = bzotech_get_option('shop_type_filter');
        $show_order     = bzotech_get_option('shop_order_filter');
        if(isset($_GET['type'])) $view = sanitize_text_field($_GET['type']);
        if(isset($_GET['number'])) $number = sanitize_text_field($_GET['number']);
        bzotech_get_template('top-filter','',array('style'=>$view,'number'=>$number,'show_number'=>$show_number,'show_type'=>$show_type,'show_order'=>$show_order),true);
    }
}  

/**
 * 
 * Add data wrap loop page shop
 * Hook to woocommerce_before_shop_loop
 * 
 * @return void
 *
 * */
add_action( 'woocommerce_before_shop_loop', 'bzotech_shop_wrap_before', 30 );
if(!function_exists('bzotech_shop_wrap_before')){
    function bzotech_shop_wrap_before(){
        global $wp_query;
        $cats = '';
        $tags = '';
        if(isset($wp_query->query_vars['product_cat'])) $cats = $wp_query->query_vars['product_cat'];
        if(isset($wp_query->query_vars['product_tag'])) $tags = $wp_query->query_vars['product_tag'];
        
        $view          = bzotech_get_option('shop_default_style','grid');
        $grid_type      = bzotech_get_option('shop_grid_type');
        $item_style     = bzotech_get_option('shop_grid_item_style');
        $item_style_list= bzotech_get_option('shop_list_item_style');
        $column         = bzotech_get_option('shop_grid_column',4);
        $number         = bzotech_get_option('woo_shop_number',12);
        $size           = bzotech_get_option('shop_grid_size');
        $size_list      = bzotech_get_option('shop_list_size');
        $gap_product    = bzotech_get_option('shop_gap_product');
        $shop_style    = bzotech_get_option('shop_style');
        $thumbnail_hover_animation      = bzotech_get_option('shop_thumb_animation');
        
        $type_active = $view;
        if(isset($_GET['type']) && $_GET['type']) $type_active = sanitize_text_field($_GET['type']);
        $size = bzotech_get_size_crop($size);
        $size_list = bzotech_get_size_crop($size_list);
        $slug = $item_style;
        if($view == 'grid' && $type_active == 'list'){
            $view = $type_active;
            $slug = $item_style_list;
        }
if(isset($_GET['column'])) $column = sanitize_text_field($_GET['column']);
        $item_wrap = 'class="list-col-item item-'.$view.'-product-'.$item_style.' list-'.$column.'-item"';
        $item_inner = 'class="item-product item-list'.$item_style_list.'"';
        $button_icon_pos = $button_icon = $button_text = $column = '';
        $item_thumbnail = $item_quickview = $item_label = $item_title = $item_rate = $item_price = $item_button = 'yes';

        // data shop ajax
        $attr_ajax = array(
            'item_wrap'         => $item_wrap,
            'item_inner'        => $item_inner,
            'button_icon_pos'   => $button_icon_pos,
            'button_icon'       => $button_icon,
            'button_text'       => $button_text,
            'size'              => $size,
            'size_list'         => $size_list,
            'type_active'       => $type_active,
            'view'              => $view,
            'column'            => $column,
            'item_style'        => $item_style,
            'item_list_style'   => $item_style_list,
            'item_thumbnail'    => $item_thumbnail,
            'item_quickview'    => $item_quickview,
            'item_label'        => $item_label,
            'item_title'        => $item_title,
            'item_rate'         => $item_rate,
            'item_price'        => $item_price,
            'item_button'       => $item_button,
            'animation'         => $thumbnail_hover_animation,
            'cats'              => $cats,
            'tags'              => $tags,
            'shop_style'        => $shop_style,
            );
        $data_ajax = array(
            "attr"        => $attr_ajax,
            );
        $data_ajax = json_encode($data_ajax);
        ?>
        <div class="product-<?php echo esc_attr($view)?>-view <?php echo esc_attr($grid_type.' '.$gap_product)?> products-wrap js-content-wrap content-wrap-shop shop-<?php echo esc_attr($view)?>-product-item-<?php echo esc_attr($slug)?>" data-load="<?php echo esc_attr($data_ajax)?>">
            <div class="products bzotech-row list-product-wrap js-content-main">
        <?php 
    }
}

/**
 * 
 * Add pagination
 * Hook to woocommerce_after_shop_loop
 * 
 * @return void
 *
 * */
add_action( 'woocommerce_after_shop_loop','bzotech_woocommerce_pagination',10 );
if(!function_exists('bzotech_woocommerce_pagination')){
    function bzotech_woocommerce_pagination(){
        echo '</div>';/*close list-product-wrap*/
        $shop_style     = bzotech_get_option('shop_style');
        global $wp_query;
        $max_page = $wp_query->max_num_pages;            
        if($shop_style == 'load-more' && $max_page > 1){
            $view           = bzotech_get_option('shop_default_style','grid');
            $item_style     = bzotech_get_option('shop_grid_item_style');
            $item_style_list= bzotech_get_option('shop_list_item_style');
            $column         = bzotech_get_option('shop_grid_column');
            $size           = bzotech_get_option('shop_grid_size');
            $size_list      = bzotech_get_option('shop_list_size');
            $number         = bzotech_get_option('woo_shop_number',12);
            $thumbnail_hover_animation      = bzotech_get_option('shop_thumb_animation');

            $size = bzotech_get_size_crop($size);
            $size_list = bzotech_get_size_crop($size_list);

            $order_default = apply_filters( 'woocommerce_default_catalog_orderby', get_option( 'woocommerce_default_catalog_orderby' ) );
            if($order_default == 'menu_order') $order_default = $order_default.' title';
            if(!$order_default) $order_default = 'menu_order title';
            $orderby = $order_default;

            if(isset($_GET['orderby']))$orderby = sanitize_text_field($_GET['orderby']);
            $type_active = $view;
            if(isset($_GET['type']) && $_GET['type']) $type_active = sanitize_text_field($_GET['type']);
            if(isset($_GET['number'])) $number = sanitize_text_field($_GET['number']);

            $item_wrap = 'class="list-col-item list-'.$column.'-item list-2-item-tablet list-1-item-mobile item-grid-product-'.$item_style.'"';
            $item_inner = 'class="item-product "';
            $button_icon_pos = $button_icon = $button_text = $column = '';
            $item_thumbnail = $item_quickview = $item_label = $item_title = $item_rate = $item_price = $item_button = 'yes';
            $attr = array(
                'item_wrap'         => $item_wrap,
                'item_inner'        => $item_inner,
                'button_icon_pos'   => $button_icon_pos,
                'button_icon'       => $button_icon,
                'button_text'       => $button_text,
                'size'              => $size,
                'size_list'         => $size_list,
                'view'              => $view,
                'type_active'       => $type_active,
                'column'            => $column,
                'item_style'        => $item_style,
                'item_style_list'   => $item_style_list,
                'item_thumbnail'    => $item_thumbnail,
                'item_quickview'    => $item_quickview,
                'item_label'        => $item_label,
                'item_title'        => $item_title,
                'item_rate'         => $item_rate,
                'item_price'        => $item_price,
                'item_button'       => $item_button,
                'animation'         => $thumbnail_hover_animation,
                );
            $paged = ( get_query_var( 'paged' ) ) ? absint( get_query_var( 'paged' ) ) : 1;                
            $args = array(
                'post_type'         => 'product',
                'post_status'       => 'publish',
                'posts_per_page'    => $number,
                'order'             => 'ASC',
                'paged'             => $paged,
            );
            $curent_query = $GLOBALS['wp_query']->query;
            $curent_tax_query = $GLOBALS['wp_query']->query_vars['tax_query'];
            $curent_meta_query = $GLOBALS['wp_query']->query_vars['meta_query'];
            if(is_array($curent_query)) $args = array_merge($args,$curent_query);
            if(is_array($curent_tax_query)) $args = array_merge($args,$curent_tax_query);
            if(is_array($curent_meta_query)) $args = array_merge($args,$curent_meta_query);
            switch ($orderby) {
                case 'price' :
                    $args['orderby']  = "meta_value_num ID";
                    $args['order']    = 'ASC';
                    $args['meta_key'] = '_price';
                break;

                case 'price-desc' :
                    $args['orderby']  = "meta_value_num ID";
                    $args['order']    = 'DESC';
                    $args['meta_key'] = '_price';
                break;

                case 'popularity' :
                    $args['meta_key'] = 'total_sales';                        
                    $args['order']    = 'DESC';
                    add_filter( 'posts_clauses', array( WC()->query, 'order_by_popularity_post_clauses' ) );
                break;

                case 'rating' :
                    $args['meta_key'] = '_wc_average_rating';
                    $args['orderby'] = 'meta_value_num';
                    $args['order']    = 'DESC';
                    $args['meta_query'] = WC()->query->get_meta_query();
                    $args['tax_query'][] = WC()->query->get_tax_query();
                break;

                case 'date':
                    $args['orderby'] = 'date';
                    $args['order']    = 'DESC';
                    break;
                
                default:
                    $order_default = apply_filters( 'woocommerce_default_catalog_orderby', get_option( 'woocommerce_default_catalog_orderby' ) );
                    if($order_default == 'menu_order') $order_default = $order_default.' title';
                    if(!$order_default) $order_default = 'menu_order title';
                    $args['orderby'] = $order_default;
                    break;
            }
            if(isset($_GET['s'])) if($_GET['s'] && $args['orderby'] == 'menu_order title'){
                unset($args['order']);
                unset($args['orderby']);
            } 
            $data_load = array(
                "args"        => $args,
                "attr"        => $attr,
                );
            $data_loadjs = json_encode($data_load);
            echo    '<input type="hidden" name="load-more-product-ajax-nonce" class="load-more-product-ajax-nonce" value="' . wp_create_nonce( 'load-more-product-ajax-nonce' ) . '" /><div class="btn-loadmore">
                        <a href="#" class="product-loadmore loadmore elbzotech-bt-default elbzotech-bt-medium" 
                            data-load="'.esc_attr($data_loadjs).'" data-paged="1" 
                            data-maxpage="'.esc_attr($max_page).'">
                            '.esc_html__("Load more",'bw-petito').'
                        </a>
                    </div>';
        }
        else bzotech_get_template_woocommerce('loop/pagination','',false,true);
        echo '</div>';/*close div before list-product-wrap*/
    }
}

/**
 * 
 * Custom price html
 * Hook to woocommerce_after_shop_loop
 * 
 * @return html
 *
 * */
add_filter( 'woocommerce_get_price_html', 'bzotech_change_price_html', 100, 2 );
if(!function_exists('bzotech_change_price_html')){
    function bzotech_change_price_html($price, $product){
        global $product;
        $price = str_replace('&ndash;', '<span class="slipt">&ndash;</span>', $price);
        $price = '<div class="product-price price">'.$price.'</div>';
        return $price;
    }
}

/**
 * 
 * Set number product 
 * Hook to pre_get_posts
 * 
 * @return int
 *
 * */
add_action( 'pre_get_posts', 'bzotech_woo_change_number' );
if(!function_exists('bzotech_woo_change_number')){
    function bzotech_woo_change_number( $query ) {
        if($query->is_main_query() && $query->get( 'wc_query' ) == 'product_query' ){
            $number = bzotech_get_option('woo_shop_number',12);
            if(isset($_GET['number'])) $number = sanitize_text_field($_GET['number']);
            $query->set( 'posts_per_page', $number );
        }
    }
}

/**
 * 
 * Custom rating html
 * Hook to woocommerce_product_get_rating_html
 * 
 * @return html
 *
 * */
add_filter( 'woocommerce_product_get_rating_html', 'bzotech_get_rating_html_default', 10, 2 );
if(!function_exists('bzotech_get_rating_html_default')){
    function bzotech_get_rating_html_default($html, $rating){
        if(!isset($count)) $count = false;
        if ( get_option( 'woocommerce_enable_review_rating' ) === 'no' ) return;
        global $product;
        $html = '';
        $width = $rating / 5 * 100;
        $html .=    '<ul class="wrap-rating list-inline-block">
                        <li>
                            <div class="product-rate">
                                <div class="product-rating" '.bzotech_add_html_attr('width:'.$width.'%').'></div>
                            </div>
                        </li>';
        if($count) $html .=     '<li>
                                    <span class="number-rate silver">('.$count.'s)</span>
                                </li>';
        $html .=    '</ul>';
        return apply_filters( 'bzotech_product_get_rating_html',$html);
       
    }
}

/**
 * 
 * Custom size avatar
 * Hook to woocommerce_review_gravatar_size
 * 
 * @return html
 *
 * */
add_filter( 'woocommerce_review_gravatar_size', 'bzotech_review_gravatar_size');
if(!function_exists('bzotech_review_gravatar_size')){
    function bzotech_review_gravatar_size(){
        return 120;
    }
}

/**
 * 
 * Get time countdown product
 * 
 * @return html
 *
 * */
add_action( 'bzotech-countdow-price','bzotech_timer_countdown' );
if(!function_exists('bzotech_timer_countdown')){
    function bzotech_timer_countdown(){
        global $product;
        if($product->get_type() !== 'simple') return;
        $sales_price_from = (int)get_post_meta(get_the_ID(), '_sale_price_dates_from', true);
        $sales_price_to = (int)get_post_meta(get_the_ID(), '_sale_price_dates_to', true);
        $current_time = getdate();
        $data_date = date('m/d/Y',$sales_price_to);
        if($sales_price_from < $current_time[0] && $current_time[0] < $sales_price_to){
            echo '<div class="final-countdown flex-wrapper" data-countdown="'.esc_attr($data_date).'"></div>';
        }
    }
}

/**
 * 
 * Get tabs content summary
 * 
 * @return void
 *
 * */
add_action( 'woocommerce_single_product_summary','bzotech_tab_product_accordion_summary',80);
if(!function_exists('bzotech_tab_product_accordion_summary')){
    function bzotech_tab_product_accordion_summary(){
        bzotech_get_template_woocommerce('single-product/tabs-content-summary','',false,true);
    }
}

/**
 * 
 * Remover yith woocompare
 * 
 * @return bool
 *
 * */
add_filter( 'yith_woocompare_remove_compare_link_by_cat','bzotech_remove_compare_link', 30, 2 );
if(!function_exists('bzotech_remove_compare_link')){
     function bzotech_remove_compare_link(){
        return true;
    }
}

/**
 * 
 * Custom before add_to_cart_form
 * Hook to woocommerce_before_add_to_cart_form
 * @return html
 *
 * */
add_action( 'woocommerce_before_add_to_cart_form', 'bzotech_woocommerce_before_add_to_cart_form', 10 );
if(!function_exists('bzotech_woocommerce_before_add_to_cart_form')){
     function bzotech_woocommerce_before_add_to_cart_form(){
           echo '<div class="bzotech-form-cart-single flex-wrapper">';
    }
}

/**
 * 
 * Custom after add_to_cart_form
 * Hook to woocommerce_after_add_to_cart_form
 * @return html
 *
 * */
add_action( 'woocommerce_after_add_to_cart_form', 'bzotech_woocommerce_after_add_to_cart_form', 40 );
if(!function_exists('bzotech_woocommerce_after_add_to_cart_form')){
     function bzotech_woocommerce_after_add_to_cart_form(){
         echo '</div>';
    }
}

/**
 * 
 * Add wishlist compare link 
 * Hook to woocommerce_single_variation
 * @return html
 *
 * */
add_action( 'woocommerce_single_variation', 'bzotech_wishlist_compare_link_single_product_variable', 30 ); 
if(!function_exists('bzotech_wishlist_compare_link_single_product_variable')){
     function bzotech_wishlist_compare_link_single_product_variable(){
        global $post;
        $product = wc_get_product( $post->ID );
        if(!class_exists('YITH_WCWL_Init') and !class_exists('YITH_Woocompare') || !$product->is_type( 'variable')) return;
            echo '<div class ="wishlist_compare_single_product clearfix ">';
            echo bzotech_compare_url('',false,esc_html__('Add to Compare','bw-petito'));
            echo bzotech_wishlist_url('',esc_html__('Add to wishlist','bw-petito'));
           
            echo '</div>';
    }
} 

/**
 * 
 * Add wishlist compare link 
 * Hook to woocommerce_after_add_to_cart_form
 * @return html
 *
 * */
add_action( 'woocommerce_after_add_to_cart_form', 'bzotech_wishlist_compare_link_single_product', 35 );
if(!function_exists('bzotech_wishlist_compare_link_single_product')){
     function bzotech_wishlist_compare_link_single_product(){
        global $post;
        $product = wc_get_product( $post->ID );
        if(!class_exists('YITH_WCWL_Init') and !class_exists('YITH_Woocompare') || $product->is_type( 'variable')) return;
            echo '<div class ="wishlist_compare_single_product clearfix ">';
            echo bzotech_compare_url('',false,esc_html__('Add to Compare','bw-petito'));
            echo bzotech_wishlist_url('',esc_html__('Add to wishlist','bw-petito'));
            echo '</div>';
    }
}

/**
 * 
 * Get finter search by brand
 * Hook to pre_get_posts
 * @return void
 *
 * */
add_action( 'pre_get_posts','bzotech_brand_product_search_finter');
if(!function_exists('bzotech_brand_product_search_finter')){
    function bzotech_brand_product_search_finter($query){
        if( $query->is_main_query()  && is_post_type_archive( 'product' ) && !is_admin() ) {
                $query->set( 'post_type', 'product' );
                $meta_query = array();
                if(!empty($_REQUEST['brand_product'])){
                    $meta_query[] = array(
                            'key' => 'title_brand_product',
                            'value'         => $_REQUEST['brand_product'],
                            );
                }
                
                $query->set('meta_query',$meta_query);
                return $query;
            
        }
    }
}
/**
 * 
 * 
 ********************* Add Hook Inner Page  ********************* 
 *  
 *
 * */

/**
 * 
 * Custom before cart
 * Hook to woocommerce_before_cart
 * 
 * @return html
 *
 * */
add_action( 'woocommerce_before_cart', 'bzotech_before_cart' );
if(!function_exists('bzotech_before_cart')){
    function bzotech_before_cart(){
        $cart_style = bzotech_get_option('cart_page_style');
        if($cart_style == 'style2'){
            ?>
                <div class="cart-custom">
                    <div class="row">
                        <div class="bzotech-col-md-8 bzotech-col-sm-7 bzotech-col-xs-12">
            <?php
        }
    }
}

/**
 * 
 * Custom after cart
 * Hook to woocommerce_after_cart
 * 
 * @return html
 *
 * */
add_action( 'woocommerce_after_cart', 'bzotech_after_cart' );
if(!function_exists('bzotech_after_cart')){
    function bzotech_after_cart(){
        $cart_style = bzotech_get_option('cart_page_style');
        if($cart_style == 'style2'){
            ?>
                        </div>
                    </div>
                </div>
            <?php
        }
        bzotech_get_template_woocommerce('cart/cross-sells','',false,true);
    }
}

/**
 * 
 * Custom after cart form
 * Hook to bzotech_after_cart_form
 * 
 * @return html
 *
 * */
add_action( 'bzotech_after_cart_form', 'bzotech_after_cart_form' );
if(!function_exists('bzotech_after_cart_form')){
    function bzotech_after_cart_form(){
        $cart_style = bzotech_get_option('cart_page_style');
        if($cart_style == 'style2'){
            ?>
                </div>
                <div class="bzotech-col-md-4 bzotech-col-sm-5 bzotech-col-xs-12">
            <?php
        }
    }
}

/**
 * 
 * Custom before page checkout
 * Hook to bzotech_checkout_before_customer_details
 * 
 * @return html
 *
 * */
add_action( 'woocommerce_checkout_before_customer_details', 'bzotech_checkout_before_customer_details' );
if(!function_exists('bzotech_checkout_before_customer_details')){
    function bzotech_checkout_before_customer_details(){
        $checkout_style = bzotech_get_option('checkout_page_style');
        if($checkout_style == 'style2'){
            ?>
                <div class="checkout-custom">
                    <div class="bzotech-row">
                        <div class="bzotech-col-md-7 bzotech-col-sm-8 bzotech-col-xs-12">
            <?php
        }
    }
}

/**
 * 
 * Custom after page checkout
 * Hook to bzotech_checkout_after_customer_details
 * 
 * @return html
 *
 * */
add_action( 'woocommerce_checkout_after_customer_details', 'bzotech_checkout_after_customer_details' );
if(!function_exists('bzotech_checkout_after_customer_details')){
    function bzotech_checkout_after_customer_details(){
        $checkout_style = bzotech_get_option('checkout_page_style');
        if($checkout_style == 'style2'){
            ?>
                        </div>
                        <div class="bzotech-col-md-5 bzotech-col-sm-4 bzotech-col-xs-12">
                            <div class="order-custom">
            <?php
        }
    }
}

/**
 * 
 * Custom after page checkout
 * Hook to woocommerce_checkout_after_order_review
 * 
 * @return html
 *
 * */
add_action( 'woocommerce_checkout_after_order_review', 'bzotech_checkout_after_order_review' );
if(!function_exists('bzotech_checkout_after_order_review')){
    function bzotech_checkout_after_order_review(){
        $checkout_style = bzotech_get_option('checkout_page_style');
        if($checkout_style == 'style2'){
            ?>
                            </div>
                        </div>
                    </div>
                </div>
            <?php
        }
    }
}

/**
 * 
 * Custom order review
 * Hook to woocommerce_checkout_order_review
 * 
 * @return html
 *
 * */
add_action( 'woocommerce_checkout_order_review', 'bzotech_order_review_before', 5 );
if(!function_exists('bzotech_order_review_before')){
    function bzotech_order_review_before(){
        ?>
            <div class="order-table-wrap">
        <?php
    }
}
add_action( 'woocommerce_checkout_order_review', 'bzotech_order_review_after', 15 );
if(!function_exists('bzotech_order_review_after')){
    function bzotech_order_review_after(){
        ?>
            </div>
        <?php
    }
}

/**
 * 
 * 
 ********************* WooCommerce function  ********************* 
 *  
 *
 * */

/**
 * 
 * Get thumbnail product in loop
 * 
 * @return html
 *
 * */
if(!function_exists('bzotech_woocommerce_thumbnail_loop')){
    function bzotech_woocommerce_thumbnail_loop($size,$animation = '',$echo = true) {
        $img_hover_html = ''; global $product;

        if($animation == 'rotate-thumb' || $animation == 'zoomout-thumb' || $animation == 'translate-thumb') {
            $attachment_ids = $product->get_gallery_image_ids();
            if(!empty($attachment_ids[0])) $img_hover_html = wp_get_attachment_image($attachment_ids[0],$size);
            else $img_hover_html = get_the_post_thumbnail(get_the_ID(),$size);
        }
        $html = '<a href="'.esc_url(get_the_permalink()).'" class="product-thumb-link '.esc_attr($animation).'">
                    '.get_the_post_thumbnail(get_the_ID(),$size).'
                    '.$img_hover_html.'
                </a>';
        if($echo) echo apply_filters( 'woocommerce_product_get_image',$html);
        else return apply_filters( 'woocommerce_product_get_image',$html);
    }
}

/**
 * 
 * Get link Quick View
 * 
 * @return html
 *
 * */
if(!function_exists('bzotech_product_quickview')){
    function bzotech_product_quickview($class = '',$icon = '<i class="las la-search"></i>',$echo = true) {
        $html = '<a title="'.esc_attr__("Quick View",'bw-petito').'" data-product-id="'.get_the_id().'" href="'.esc_url(get_the_permalink()).'" class="product-quick-view quickview-link '.esc_attr($class).'">'.$icon.'<span>Quick View</span></a>';
        if($echo) echo apply_filters( 'bzotech_quickview',$html);
        else return apply_filters( 'bzotech_quickview',$html);
    }
}

/**
 * 
 * Get product label
 * 
 * @return html
 *
 * */
if(!function_exists('bzotech_product_label')){
    function bzotech_product_label($echo = true) {
        global $product,$post;
        $date_pro = strtotime($post->post_date);
        $date_now = strtotime('now');
        $set_timer = bzotech_get_option( 'sv_set_time_woo', 0);
        $uppsell = ($date_now - $date_pro - $set_timer*24*60*60);
        $html = '';
        if($product->is_on_sale() || $uppsell < 0) $html .= '<div class="product-label">';
        if($product->is_on_sale()){
            $from = $product->get_regular_price();
            $to = $product->get_price();
            if($from){
                $percent = round(($from-$to)/$from*100);
                $html .= apply_filters( 'woocommerce_sale_flash','<span class="sale">-'.esc_html($percent).'%</span>');
            }
        }
        if($uppsell < 0) $html .=   '<span class="new">'.esc_html__("new",'bw-petito').'</span>';
        if($product->is_on_sale() || $uppsell < 0) $html .= '</div>';
        if($echo) echo apply_filters( 'bzotech_product_label',$html);
        else return apply_filters( 'bzotech_product_label',$html);
    }
}

/**
 * 
 * Get price
 * 
 * @return html
 *
 * */
if(!function_exists('bzotech_get_price_html')){
    function bzotech_get_price_html($echo = true){
        global $product;
        $html =    $product->get_price_html();
        if($echo) echo apply_filters( 'bzotech_product_price',$html);
        return apply_filters( 'bzotech_product_price',$html);
    }
}


/**
 * 
 * Get rating
 * 
 * @return html
 *
 * */
if(!function_exists('bzotech_get_rating_html')){
    function bzotech_get_rating_html($echo = true, $count = true, $style = ''){
        $html_hidden_star="";
        if ( get_option( 'woocommerce_enable_review_rating' ) === 'no' ) return;
        global $product;
        $html = '';
        $star = $product->get_average_rating();

        $review_count = $product->get_review_count();
        if($review_count!==1){
            $review_count = $review_count.' '.esc_html__('reviews','bw-petito');
        }else {
            $review_count = $review_count.' '.esc_html__('review','bw-petito');
        }
        $width = $star / 5 * 100;
        $html .=    '<ul class="wrap-rating list-inline-block">
                        <li>
                            <div class="product-rate">
                                <div class="product-rating" '.bzotech_add_html_attr('width:'.$width.'%').'></div>
                            </div>
                        </li>';
        if($count) $html .=     '<li>
                                    <span class="number-rate silver title12">'.$review_count.'</span>
                                </li>';
        $html .=    '</ul>';
        if($echo) echo apply_filters( 'bzotech_product_get_rating_html',$html);
        else return apply_filters( 'bzotech_product_get_rating_html',$html);
        
       
    }
}

/**
 * 
 * Get button add to cart link by style
 * 
 * @return html
 *
 * */
if ( ! function_exists( 'bzotech_addtocart_link' ) ) {
    function bzotech_addtocart_link($data=[],$echo = true){
        global $product;
        $datadf=[
            'style'=> '',
            'el_class'=>'',
            'icon'=>'',
            'text'=>'',
            'icon_after'=>'',
            'tooltip'=>true,
        ];
        $data = array_merge($datadf,$data);
        extract($data);
        if ( $product ) {                
            switch ($style) {
                case 'cart-icon':
                    if(!$icon) $icon = '<i class="las la-cart-plus"></i>';
                    $text = '';
                    $btn_class = 'addcart-link case-cart-icon '.$el_class;
                    $icon_after = '';
                    break;
                
                default:
                    if(!$icon) $icon = '';
                    if(!$text) $text = '<span>'.$product->add_to_cart_text().'</span>';
                    $btn_class = 'addcart-link case-cart-default '.$el_class;  
                    if(!$icon_after) $icon_after = '';              
                    break;
            }
            $defaults = array(
                'quantity' => 1,
                'class'    => implode( ' ', array_filter( array(
                        'button',
                        $btn_class,
                        'product_type_' . $product->get_type(),
                        $product->is_purchasable() && $product->is_in_stock() ? 'add_to_cart_button' : '',
                        $product->supports( 'ajax_add_to_cart' ) ? 'bzotech_ajax_add_to_cart' : '',
                ) ) ),
            );
            if($tooltip) $tooltip_html =  'data-toggle="tooltip" data-placement="top"'; else $tooltip_html = '';
            $args = apply_filters( 'woocommerce_loop_add_to_cart_args', wp_parse_args( array(), $defaults ), $product );
            if($args) extract($args);
             echo '<input type="hidden" name="addtocart-ajax-nonce" class="addtocart-ajax-nonce" value="' . wp_create_nonce( 'addtocart-ajax-nonce' ) . '" />';
            $button_html =  apply_filters( 'woocommerce_loop_add_to_cart_link',
                sprintf( '<a href="%s" rel="nofollow" '.$tooltip_html.' data-product_id="%s" data-product_sku="%s" data-quantity="%s" class="%s product_type_%s" data-title="%s">'.$icon.'%s'.$icon_after.'</a>',
                    esc_url( $product->add_to_cart_url() ),
                    esc_attr( $product->get_id() ),
                    esc_attr( $product->get_sku() ),
                    esc_attr( $quantity),
                    esc_attr( $class ),
                    esc_attr( $product->get_type() ),
                    esc_attr($product->add_to_cart_text()),
                    $text
                ),
            $product );
            if($echo) echo apply_filters( 'bzotech_output_content',$button_html);
            else return $button_html;
        }
    }
}

/**
 * 
 * Get catalog ordering
 * 
 * @return html
 *
 * */
if ( !function_exists( 'bzotech_catalog_ordering' ) ) {
    function bzotech_catalog_ordering($query,$set_orderby = '',$list_item = false,$add_class = '') {        
        
        $orderby                 = isset( $_GET['orderby'] ) ? wc_clean( $_GET['orderby'] ) : apply_filters( 'woocommerce_default_catalog_orderby', get_option( 'woocommerce_default_catalog_orderby','menu_order' ) );
        if(!empty($set_orderby)) $orderby = $set_orderby;
        $show_default_orderby    = 'menu_order' === apply_filters( 'woocommerce_default_catalog_orderby', get_option( 'woocommerce_default_catalog_orderby','menu_order' ) );
        $catalog_orderby_options = apply_filters( 'woocommerce_catalog_orderby', array(
            'menu_order' => esc_html__( 'Default sorting', 'bw-petito' ),
            'popularity' => esc_html__( 'Sort by popularity', 'bw-petito' ),
            'rating'     => esc_html__( 'Sort by average rating', 'bw-petito' ),
            'date'       => esc_html__( 'Sort by newness', 'bw-petito' ),
            'price'      => esc_html__( 'Sort by price: low to high', 'bw-petito' ),
            'price-desc' => esc_html__( 'Sort by price: high to low', 'bw-petito' )
        ) );

        $default_orderby = wc_get_loop_prop( 'is_search' ) ? 'relevance' : apply_filters( 'woocommerce_default_catalog_orderby', $orderby );
        $orderby         = isset( $_GET['orderby'] ) ? wc_clean( wp_unslash( $_GET['orderby'] ) ) : $default_orderby; // WPCS: sanitization ok, input var ok, CSRF ok.

        if ( wc_get_loop_prop( 'is_search' ) ) {
            $catalog_orderby_options = array_merge( array( 'relevance' => esc_html__( 'Relevance', 'bw-petito' ) ), $catalog_orderby_options );

            unset( $catalog_orderby_options['menu_order'] );
        }

        if ( ! $show_default_orderby ) {
            unset( $catalog_orderby_options['menu_order'] );
        }

        if ( 'no' === get_option( 'woocommerce_enable_review_rating' ) ) {
            unset( $catalog_orderby_options['rating'] );
        }

        if(!$list_item) wc_get_template( 'loop/orderby.php', array( 'catalog_orderby_options' => $catalog_orderby_options, 'orderby' => $orderby, 'show_default_orderby' => $show_default_orderby ) );
        else {
            if( $orderby == 'menu_order' || $orderby == 'menu_order title' ) $order_key = 'menu_order';
            else $order_key = $orderby;
            ?>
            <div class="elbzotech-dropdown-box show-order">
                <a href="javascript:void(0)" class="dropdown-link">
                    <span class="silver set-orderby"><?php echo esc_html($catalog_orderby_options[$order_key])?></span>
                    
                </a>
                <ul class="elbzotech-dropdown-list list-none">
                    <?php
                    foreach ($catalog_orderby_options as $key => $value) {
                        if($key == $order_key) $active = ' active';
                        else $active = '';
                        echo '<li><a data-orderby="'.esc_attr($key).'" class="'.esc_attr($add_class.$active).'" href="'.esc_url(bzotech_get_key_url('orderby',$key)).'">'.$value.'</a></li>';
                    }
                    ?>
                </ul>
            </div>
        <?php }
    }
}

/********************************** Shop ajax ************************************/
add_action('wp_ajax_get_nonce_product', 'bzotech_get_nonce_product');
add_action('wp_ajax_nopriv_get_nonce_product', 'bzotech_get_nonce_product');

function bzotech_get_nonce_product() {
    wp_send_json_success(array(
        'nonce' => wp_create_nonce('load-shop-ajax-nonce')
    ));
}
/**
 * 
 * Ajax shop
 * Hook to wp_ajax_ , wp_ajax_nopriv_
 * 
 * @return html
 *
 * */
add_action( 'wp_ajax_load_shop', 'bzotech_load_shop' );
add_action( 'wp_ajax_nopriv_load_shop', 'bzotech_load_shop' );
if(!function_exists('bzotech_load_shop')){
    function bzotech_load_shop() {
        check_ajax_referer( 'load-shop-ajax-nonce', 'security');
        if (empty($_POST['filter_data'])) {
            wp_send_json_error(['message' => 'Missing data_filter']);
        }
        $data_filter = sanitize_text_field($_POST['filter_data']); 
        $data_filter = str_replace('\\"', '"', $data_filter);
        $data_filter = str_replace('\"', '"', $data_filter);
        $data_filter = str_replace('\/', '/', $data_filter);
        $data_filter = json_decode($data_filter,true);
        if (!is_array($data_filter)) {
            wp_send_json_error(['message' => 'Invalid data']);
        }
        $page   = isset($data_filter['page']) ? intval($data_filter['page']) : 1;
        $number   = isset($data_filter['number']) ? intval($data_filter['number']) : '';
        $s = isset($data_filter['s']) ? sanitize_text_field($data_filter['s']) : '';
        $args = array(
            'post_type'         => 'product',
            'post_status'    => 'publish',
            'order'             => 'ASC',
            'posts_per_page'    => $number,
            'paged'             => $page,
        );
        if(isset($s)) if(!empty($s)){
            $args['s'] = $s;
            $args['order'] = 'DESC';
        }
        $attributes = isset($data_filter['attributes']) && is_array($data_filter['attributes']) ? $data_filter['attributes'] : [];
       
        $attr_taxquery = array();
        if(!empty($attributes)){
            foreach($attributes as $key => $term){
                $attr_taxquery[] =  array(
                                        'taxonomy'      => 'pa_'.$key,
                                        'terms'         => $term,
                                        'field'         => 'slug',
                                        'operator'      => 'IN'
                                    );
            }
        }
        $cats = isset($data_filter['cats']) ? $data_filter['cats'] : '';
        if(!empty($cats)) {
            if(is_string($cats)) $cats = explode(",",$cats);
            $attr_taxquery[]=array(
                'taxonomy'=>'product_cat',
                'field'=>'slug',
                'terms'=> $cats
            );
        }
        $tags = isset($data_filter['tags']) ? $data_filter['tags'] : '';
        if(!empty($tags)) {
            if(is_string($tags)) $tags = explode(",",$tags);
            $attr_taxquery[]=array(
                'taxonomy'=>'product_tag',
                'field'=>'slug',
                'terms'=> $tags
            );
        }
        if (!empty($attr_taxquery)){
            $attr_taxquery['relation'] = 'AND';
            $args['tax_query'] = $attr_taxquery;
        }
        $price = isset($data_filter['price']) ? $data_filter['price'] : '';

        if( isset( $price['min']) && isset( $price['max']) ){
             $min_price = isset($data_filter['min_price']) ? $data_filter['min_price'] : '';
             $max_price = isset($data_filter['max_price']) ? $data_filter['max_price'] : '';
            $min = $price['min'];
            $max = $price['max'];
            if($max != $max_price || $min != $min_price) $args['post__in'] = bzotech_filter_price($min,$max);
        }
         $orderby = isset($data_filter['orderby']) ? sanitize_key($data_filter['orderby']) : '';
       
        switch ($orderby) {
            case 'price' :
                $args['orderby']  = "meta_value_num ID";
                $args['order']    = 'ASC';
                $args['meta_key'] = '_price';
            break;

            case 'price-desc' :
                $args['orderby']  = "meta_value_num ID";
                $args['order']    = 'DESC';
                $args['meta_key'] = '_price';
            break;

            case 'popularity' :
                $args['meta_key'] = 'total_sales';                        
                $args['order']    = 'DESC';
            break;

            case 'rating' :
                $args['meta_key'] = '_wc_average_rating';
                $args['orderby'] = 'meta_value_num';
                $args['order']    = 'DESC';
            break;

            case 'date':
                $args['orderby'] = 'date';
                $args['order']    = 'DESC';
                break;
            
            default:
                $order_default = apply_filters( 'woocommerce_default_catalog_orderby', get_option( 'woocommerce_default_catalog_orderby' ) );
                if($order_default == 'menu_order') $order_default = $order_default.' title';
                if(!$order_default) $order_default = 'menu_order title';
                $args['orderby'] = $order_default;
                break;
        }
        if(isset($s)){
           if(!empty($s) && $args['orderby'] == 'menu_order title'){
                unset($args['order']);
                unset($args['orderby']);
            }
        }
        $item_wrap = isset($data_filter['item_wrap']) ? sanitize_text_field($data_filter['item_wrap']) : '';
        $item_inner = isset($data_filter['item_inner']) ? sanitize_text_field($data_filter['item_inner']) : '';
        $button_icon_pos = isset($data_filter['button_icon_pos']) ? sanitize_text_field($data_filter['button_icon_pos']) : '';
        $button_icon = isset($data_filter['button_icon']) ? sanitize_text_field($data_filter['button_icon']) : '';
        $button_text = isset($data_filter['button_text']) ? sanitize_text_field($data_filter['button_text']) : '';
        $size = isset($data_filter['size']) ? sanitize_key($data_filter['size']) : '';
        $size_list = isset($data_filter['size_list']) ? sanitize_key($data_filter['size_list']) : '';
        $type_active = isset($data_filter['type_active']) ? sanitize_key($data_filter['type_active']) : '';
        $view = isset($data_filter['view']) ? sanitize_key($data_filter['view']) : '';
        $column = isset($data_filter['column']) ? sanitize_key($data_filter['column']) : '';
        $item_style = isset($data_filter['item_style']) ? sanitize_key($data_filter['item_style']) : '';
        $item_style_list = isset($data_filter['item_style_list']) ? sanitize_key($data_filter['item_style_list']) : '';
        $item_thumbnail = isset($data_filter['item_thumbnail']) ? sanitize_key($data_filter['item_thumbnail']) : '';
        $item_quickview = isset($data_filter['item_quickview']) ? sanitize_key($data_filter['item_quickview']) : '';
        $item_label = isset($data_filter['item_label']) ? sanitize_key($data_filter['item_label']) : '';
        $item_title = isset($data_filter['item_title']) ? sanitize_key($data_filter['item_title']) : '';
        $item_rate = isset($data_filter['item_rate']) ? sanitize_key($data_filter['item_rate']) : '';
        $item_price = isset($data_filter['item_price']) ? sanitize_key($data_filter['item_price']) : '';
        $item_button = isset($data_filter['item_button']) ? sanitize_key($data_filter['item_button']) : '';
        $thumbnail_hover_animation = isset($data_filter['thumbnail_hover_animation']) ? sanitize_key($data_filter['thumbnail_hover_animation']) : '';
        $shop_style = isset($data_filter['shop_style']) ? sanitize_key($data_filter['shop_style']) : '';

        $attr = array(
            'item_wrap'         => $item_wrap,
            'item_inner'        => $item_inner,
            'button_icon_pos'   => $button_icon_pos,
            'button_icon'       => $button_icon,
            'button_text'       => $button_text,
            'size'              => $size,
            'size_list'         => $size_list,
            'type_active'       => $type_active,
            'view'              => $view,
            'column'            => $column,
            'item_style'        => $item_style,
            'item_style_list'   => $item_style_list,
            'item_thumbnail'    => $item_thumbnail,
            'item_quickview'    => $item_quickview,
            'item_label'        => $item_label,
            'item_title'        => $item_title,
            'item_rate'         => $item_rate,
            'item_price'        => $item_price,
            'item_button'       => $item_button,
            'animation'         => $thumbnail_hover_animation,
            );
        
        echo '<div class="products bzotech-row list-product-wrap js-content-main">';
     
        $product_query = new WP_Query($args);
        $max_page = $product_query->max_num_pages;
        if(empty($view)) $view = bzotech_get_option('shop_default_style','grid');
        $slug = $item_style;
        if(($view == 'grid' && $type_active == 'list') || $view == 'list'){
            $view = 'list';
            $slug = $item_list_style;
        }
        $allowed_views = ['grid', 'list'];
        if (!in_array($view, $allowed_views, true)) {
            wp_send_json_error(['message' => 'Invalid view']);
        }
        
        if($product_query->have_posts()) {
            while($product_query->have_posts()) {
                $product_query->the_post();
                bzotech_get_template_woocommerce('loop/'.$view.'/'.$view,$slug,$attr,true);
            }
        }
        echo    '</div>';
        if($shop_style == 'load-more' && $max_page > 1){
            $data_load = array(
                "args"        => $args,
                "attr"        => $attr,
                );
            $data_loadjs = json_encode($data_load);
            echo    '<input type="hidden" name="load-more-product-ajax-nonce" class="load-more-product-ajax-nonce" value="' . wp_create_nonce( 'load-more-product-ajax-nonce' ) . '" /><div class="btn-loadmore">
                        <a href="#" class="product-loadmore loadmore elbzotech-bt-default elbzotech-bt-medium" 
                            data-load="'.esc_attr($data_loadjs).'" data-paged="1" 
                            data-maxpage="'.esc_attr($max_page).'">
                            '.esc_html__("Load more",'bw-petito').'
                        </a>
                    </div>';
        }
        else bzotech_get_template_woocommerce('loop/pagination','',array('wp_query'=>$product_query,'paged'=>$page),true);
        wp_reset_postdata();
        die();/**/
    }
}
/**
 * 
 * Ajax load more
 * Hook to wp_ajax_ , wp_ajax_nopriv_
 * 
 * @return html
 *
 * */
add_action( 'wp_ajax_load_more_product', 'bzotech_load_more_product' );
add_action( 'wp_ajax_nopriv_load_more_product', 'bzotech_load_more_product' );
if(!function_exists('bzotech_load_more_product')){
    function bzotech_load_more_product() {
       check_ajax_referer( 'load-more-product-ajax-nonce', 'security');
        if (empty($_POST['load_data'])) {
            wp_send_json_error(['message' => 'Missing load_data']);
        }
        $paged = isset($_POST['paged']) ? intval($_POST['paged']) : 1;
        $load_data = sanitize_text_field($_POST['load_data']); 
        $load_data = str_replace('\\"', '"', $load_data);
        $load_data = str_replace('\"', '"', $load_data);
        $load_data = str_replace('\/', '/', $load_data);
        $load_data = json_decode($load_data,true);
        if (!is_array($load_data)) {
            wp_send_json_error(['message' => 'Invalid data']);
        }
        $attr = isset($load_data['attr']) && is_array($load_data['attr']) ? $load_data['attr'] : [];
        $view            = isset($attr['view']) ? basename(sanitize_file_name($attr['view'])) : 'grid';
        $slug            = isset($attr['item_style']) ? sanitize_key($attr['item_style']) : '';
        $type_active     = isset($attr['type_active']) ? sanitize_key($attr['type_active']) : '';
        $item_list_style = isset($attr['item_list_style']) ? sanitize_key($attr['item_list_style']) : '';

        
        $args = isset($load_data['args']) && is_array($load_data['args']) ? $load_data['args'] : [];
        $args['paged'] = max(1, $paged);

        $allowed_views = ['grid', 'list'];
        if (!in_array($view, $allowed_views, true)) {
            wp_send_json_error(['message' => 'Invalid view']);
        }

        $query = new WP_Query($args);
        $count = 1;
        $count_query = $query->post_count;
        if($view == 'grid' && $type_active == 'list'){
            $view = $type_active;
            $slug = $item_list_style;
        }        

        if($query->have_posts()) {
            while($query->have_posts()) {
                $query->the_post();
                bzotech_get_template_woocommerce("loop/{$view}/{$view}", $slug, $attr, true);
                $count++;
            }
        }
        wp_reset_postdata();
        die();
    }
}

/**
 * 
 * Ajax filter
 * Hook to wp_ajax_ , wp_ajax_nopriv_
 * 
 * @return html
 *
 * */
add_action( 'wp_ajax_load_product_filter', 'bzotech_load_product_filter' );
add_action( 'wp_ajax_nopriv_load_product_filter', 'bzotech_load_product_filter' );
if(!function_exists('bzotech_load_product_filter')){
    function bzotech_load_product_filter() {
        check_ajax_referer( 'load-product-filter-ajax-nonce', 'security');
        if (empty($_POST['load_data'])) {
            wp_send_json_error(['message' => 'Missing load_data']);
        }
        $paged = isset($_POST['paged']) ? intval($_POST['paged']) : 1;
        $load_data = sanitize_text_field($_POST['load_data']);
        $load_data = str_replace('\\"', '"', $load_data);
        $load_data = str_replace('\"', '"', $load_data);
        $load_data = str_replace('\/', '/', $load_data);
        $load_data = json_decode($load_data,true);
        if (!is_array($load_data)) {
            wp_send_json_error(['message' => 'Invalid data']);
        }
        $filter_data = isset($_POST['filter_data']) ? wp_unslash($_POST['filter_data']) : '';
        if (!is_array($filter_data)) {
            wp_send_json_error(['message' => 'Invalid data']);
        }
        $attr = isset($load_data['attr']) && is_array($load_data['attr']) ? $load_data['attr'] : [];
        $args = isset($load_data['args']) && is_array($load_data['args']) ? $load_data['args'] : [];
        $attributes= isset($filter_data['attributes']) && is_array($filter_data['attributes']) ? $filter_data['attributes'] : [];
        $cats= isset($filter_data['cats']) && is_array($filter_data['cats']) ? $filter_data['cats'] : [];
        $price= isset($filter_data['price']) && is_array($filter_data['price']) ? $filter_data['price'] : [];
        $max_price= isset($filter_data['max_price']) ? $filter_data['max_price'] : '';
        $min_price= isset($filter_data['min_price']) ? $filter_data['min_price'] : '';
        $view            = isset($attr['view']) ? basename(sanitize_file_name($attr['view'])) : 'grid';
        $slug            = isset($attr['item_style']) ? sanitize_key($attr['item_style']) : '';
        $type_active     = isset($attr['type_active']) ? sanitize_key($attr['type_active']) : '';
        $item_list_style = isset($attr['item_list_style']) ? sanitize_key($attr['item_list_style']) : '';
        $pagination = isset($attr['pagination']) ? $attr['pagination'] : '';
    
        
        $args['paged'] = $paged;
        $attr_taxquery = array();
        if(!empty($attributes)){                
            $attr_taxquery['relation'] = 'AND';
            foreach($attributes as $attr_t => $term){
                $attr_taxquery[] =  array(
                                        'taxonomy'      => 'pa_'.$attr_t,
                                        'terms'         => $term,
                                        'field'         => 'slug',
                                        'operator'      => 'IN'
                                    );
            }
        }
        if(!empty($cats)) {
            $attr_taxquery[]=array(
                'taxonomy'=>'product_cat',
                'field'=>'slug',
                'terms'=> $cats
            );
        }
        if ( !empty($attr_taxquery)){                
            $args['tax_query'] = $attr_taxquery;
        }
        if( isset( $price['min']) && isset( $price['max']) ){
            $min = $price['min'];
            $max = $price['max'];
            if($max != $max_price || $min != $min_price) $args['post__in'] = bzotech_filter_price($min,$max);
        }
        $query = new WP_Query($args);
        $count = 1;
        $count_query = $query->post_count;
        $max_page = $query->max_num_pages;
        if($view == 'list') $slug = $item_list_style;

        $allowed_views = ['grid', 'list'];
        if (!in_array($view, $allowed_views, true)) {
            wp_send_json_error(['message' => 'Invalid view']);
        }
        if(isset($pagination) && !empty($pagination)){?>
            <div class="products bzotech-row list-product-wrap js-content-main">
                <?php
                if($query->have_posts()) {
                    while($query->have_posts()) {
                        $query->the_post();
                        bzotech_get_template_woocommerce('loop/'.$view.'/'.$view,$slug,$attr,true);
                        $count++;
                    }
                }
                else echo '<div class="filter-noresult-wrap"><div class="filter-noresult title18 text-center">'.esc_html__("No result found with current filter value.",'bw-petito').'</div></div>';
                ?>
            </div>
            <?php
            if($pagination == 'load-more' && $max_page > 1){
                $data_load = array(
                    "args"        => $args,
                    "attr"        => $attr,
                    );
                $data_loadjs = json_encode($data_load);
                echo    '<input type="hidden" name="load-more-product-ajax-nonce" class="load-more-product-ajax-nonce" value="' . wp_create_nonce( 'load-more-product-ajax-nonce' ) . '" /><div class="btn-loadmore">
                            <a href="#" class="product-loadmore loadmore elbzotech-bt-default elbzotech-bt-medium" 
                                data-load="'.esc_attr($data_loadjs).'" data-paged="1" 
                                data-maxpage="'.esc_attr($max_page).'">
                                '.esc_html__("Load more",'bw-petito').'
                            </a>
                        </div>';
            }
            if($pagination == 'pagination') bzotech_get_template_woocommerce('loop/pagination','',array('wp_query'=>$query,'paged'=>$paged),true);

        }
        else{
            if($query->have_posts()) {
                while($query->have_posts()) {
                    $query->the_post();
                    bzotech_get_template_woocommerce('loop/'.$view.'/'.$view,$slug,$attr,true);
                    $count++;
                }
            }
            else echo '<div class="filter-noresult-wrap"><div class="filter-noresult title18 text-center">'.esc_html__("No result found with current filter value.",'bw-petito').'</div></div>';
        }
        wp_reset_postdata();
        die();
    }
}




/**
 * 
 * Get data option product detail
 * 
 * @return array
 *
 * */
if(!function_exists('bzotech_show_single_product_data')){
    function bzotech_show_single_product_data(){
        $show_latest     = bzotech_get_option('show_latest');
        $show_upsell     = bzotech_get_option('show_upsell');
        $show_related    = bzotech_get_option('show_related');
        $number     = bzotech_get_option('show_single_number');
        $size       = bzotech_get_option('show_single_size');
        if(empty($size)) $size = '300x300';
        // $items_custom ='0:1,480:2,990:3,1200:4';
        $items_custom   = bzotech_get_value_by_id('show_single_itemres');
        $item_style   = bzotech_get_option('show_single_item_style');   
        $attr = array(
            'show_latest'   => $show_latest,
            'show_upsell'   => $show_upsell,
            'show_related'  => $show_related,
            'number'        => $number,
            'size'          => $size,
            'items_custom'      => $items_custom,
            'item_style'    => $item_style,
        );
        return $attr;
    }
}

    
/**
 * 
 * Add to cart style sticky in product detail
 * 
 * @return html
 *
 * */
if(!function_exists('bzotech_product_sticky_addcart')){
    function bzotech_product_sticky_addcart(){
        global $product;
       $sticky_addcart = bzotech_get_value_by_id('bzotech_product_sticky_addcart');
        if($sticky_addcart == 'on'):
            ?>
            <div class="sticky-addcart transition">
                <div class="container">
                    <div class="row">
                        <div class="bzotech-col-md-5 bzotech-col-sm-6 bzotech-col-xs-12">
                            <div class="item-product-sticky-addcart flex-wrapper align_items-center">
                                <div class="product-thumb">
                                    <?php echo get_the_post_thumbnail( get_the_ID(),array(60,60));?>
                                </div>
                                <div class="product-info">
                                    <h3 class="title16 color-title font-title product-title"><?php echo esc_html(get_the_title());?></h3>
                                </div>
                            </div>
                        </div>
                        <div class="bzotech-col-md-7 bzotech-col-sm-6 bzotech-col-xs-12">
                            <div class="wrap-sticky-cart-price flex-wrapper align_items-center justify_content-flex-end">
                                <?php bzotech_get_price_html(); ?>
                                <form class="cart" action="<?php echo esc_url( apply_filters( 'woocommerce_add_to_cart_form_action', $product->get_permalink() ) ); ?>" method="post" enctype='multipart/form-data'>
                                    <?php do_action( 'woocommerce_before_add_to_cart_button' ); ?>

                                    <?php
                                    do_action( 'woocommerce_before_add_to_cart_quantity' );

                                    woocommerce_quantity_input( array(
                                        'min_value'   => apply_filters( 'woocommerce_quantity_input_min', $product->get_min_purchase_quantity(), $product ),
                                        'max_value'   => apply_filters( 'woocommerce_quantity_input_max', $product->get_max_purchase_quantity(), $product ),
                                        'input_value' => isset( $_POST['quantity'] ) ? wc_stock_amount( wp_unslash( $_POST['quantity'] ) ) : $product->get_min_purchase_quantity(), // WPCS: CSRF ok, input var ok.
                                    ) );

                                    do_action( 'woocommerce_after_add_to_cart_quantity' );
                                    ?>

                                    <button type="submit" name="add-to-cart" value="<?php echo esc_attr( $product->get_id() ); ?>" class="single_add_to_cart_button button alt" title="<?php echo esc_attr( $product->single_add_to_cart_text() ); ?>"><i class="la-cart-plus la"></i></button>

                                    <?php do_action( 'woocommerce_after_add_to_cart_button' ); ?>
                                </form>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        <?php endif;
    }
}
 

/**
 * 
 * Get image by color in product loop
 * 
 * @return html
 *
 * */
if(!function_exists('bzotech_product_attribute_image_by_color')){
    function bzotech_product_attribute_image_by_color($class='',$size='full',$animation='',$echo = true){
        $shop_attribute_color = bzotech_get_option('shop_attribute_color','0');
        if($shop_attribute_color !== '1') return;
        $html ='';
        $data_tabs = get_post_meta(get_the_ID(),'bzotech_product_attribute_data',true);
        $img_goc = get_the_post_thumbnail_url(get_the_ID(),$size);
        $img_goc2='';
        if($animation == 'rotate-thumb' || $animation == 'zoomout-thumb' || $animation == 'translate-thumb') {
            $img_hover = get_post_meta(get_the_ID(),'product_thumb_hover',true);
            if(!empty($img_hover['id'])) $img_goc2 = wp_get_attachment_image_url($img_hover['id'],$size);
            else $img_goc2 = get_the_post_thumbnail_url(get_the_ID(),$size);
        }
        if(!empty($data_tabs) and is_array($data_tabs) and !empty($data_tabs[0]['color_att']['color'])){
            $html = '<div class="attribute_data-custom '.$class.'" data-imggoc="'.$img_goc.'" data-imggoc2="'.$img_goc2.'">';
            foreach ($data_tabs as $key=>$data_tab){

                 $image_att2='';
                 if($animation == 'rotate-thumb' || $animation == 'zoomout-thumb' || $animation == 'translate-thumb') {
                     if(!empty($data_tab['image_att2'])){
                        $image_att2 = wp_get_attachment_image_url($data_tab['image_att2']['id'],$size);
                    }
                 }

                if(!empty($data_tab['color_att']['color']) && !empty($data_tab['image_att'])){
                    $image_att = wp_get_attachment_image_url($data_tab['image_att']['id'],$size);
                    $class_white = '';
                    if($data_tab['color_att']['color'] == '#fff' || $data_tab['color_att']['color'] == '#ffffff') $class_white="color-white";
                    $html .= '<span class="attribute-custom '.$class_white.'" title="'.esc_attr($data_tab['title']).'" data-image="'.$image_att.'" data-image2="'.$image_att2.'"  '.bzotech_add_html_attr('background-color:'.$data_tab['color_att']['color']).'></span>';
                }
            }
            $html .= '</div>';
        }
        if($echo) echo apply_filters( 'bzotech_output_content',$html);
            else return $html;
    }
}

/**
 * 
 * Get price in variation
 * 
 * @return void
 *
 * */
if(!function_exists('bzotech_display_price_in_variation_option_name')){
    function bzotech_display_price_in_variation_option_name( $term ) {
        global $wpdb, $product;

        if ( empty( $term ) ) return $term;
        if ( empty( $product->id ) ) return $term;

        $id = $product->get_id();

        $result = $wpdb->get_col( "SELECT slug FROM {$wpdb->prefix}terms WHERE name = '$term'" );

        $term_slug = ( !empty( $result ) ) ? $result[0] : $term;

        $query = "SELECT postmeta.post_id AS product_id
                    FROM {$wpdb->prefix}postmeta AS postmeta
                        LEFT JOIN {$wpdb->prefix}posts AS products ON ( products.ID = postmeta.post_id )
                    WHERE postmeta.meta_key LIKE 'attribute_%'
                        AND postmeta.meta_value = '$term_slug'
                        AND products.post_parent = $id";

        $variation_id = $wpdb->get_col( $query );

        $parent = wp_get_post_parent_id( $variation_id[0] );

        if ( $parent > 0 ) {
             $_product = new WC_Product_Variation( $variation_id[0] );
             return $term . ' (' . wp_kses( woocommerce_price( $_product->get_price() ), array() ) . ')';
        }
        return $term;

    }
}

/**
 * 
 * Get Woocommerce variation price based on product ID
 * 
 * @return void
 *
 * */
if(!function_exists('bzotech_get_variation_price_by_id')){
    function bzotech_get_variation_price_by_id($product_id, $variation_id){
        $currency_symbol = get_woocommerce_currency_symbol();
        $product_variable = new WC_Product_Variable($product_id);
        
        $variations = $product_variable->get_available_variations();
        
        $display_regular_price = $display_price ='';
        foreach ($variations as $variation) {
            if($variation['variation_id'] == $variation_id){
                $display_regular_price = $variation['display_regular_price'].'<span class="currency">'. $currency_symbol .'</span>';
                $display_price = $variation['display_price'].'<span class="currency">'. $currency_symbol .'</span>';
                
                //Check if Regular price is equal with Sale price (Display price)
                if ($display_regular_price == $display_price){
                    $display_price = false;
                }
            }
        }
        $priceArray = array(
            'display_regular_price' => $display_regular_price,
            'display_price' => $display_price
        );
        $priceObject = (object)$priceArray;
        return $priceObject;
    }
}

/**
 * 
 * Get product attribute data
 * 
 * @return void
 *
 * */
if(!function_exists('bzotech_product_attribute_data')){
    function bzotech_product_attribute_data($type='',$class='', $show_type = array(), $echo = true){

        /* @param string $type_data default | click .*/
        /* @param array $show_type image | color | select | label .*/
        if ( is_cart() ) {
            return;
        }
        global $product; $html= $html_ok ='';
        $attributes= $product->get_attributes();
        $product_data_type = $product->get_type();
     
        foreach ( $attributes as $attribute ) {
            $get_type = wc_get_attribute($attribute->get_id());
            if(!empty($get_type))
               $get_type = $get_type->type;
            if(in_array($get_type,$show_type)){
                $html .= '<div class="attr-type-'.$get_type.'">';
                    if ( $attribute->is_taxonomy() ) {
                        $attribute_taxonomy = $attribute->get_taxonomy_object();


                        $attribute_values   = wc_get_product_terms( $product->get_id(), $attribute->get_name(), array( 'fields' => 'all' ) );

                        
                        if(is_array($attribute_values))
                        foreach ( $attribute_values as $attribute_value ) {
                            $value_title = esc_html( $attribute_value->name );
                            $value_name =  $value_title; 
                            $value_desc = $attribute_value->description;
                            if(!empty($value_desc)) $value_desc = '<span class="desc">'.$value_desc.'</span>';
                            if($get_type == 'label'){
                                $value_name = '<span  class="label-text">'.get_term_meta($attribute_value->term_id,'label',true).'</span>';
                            }else if($get_type == 'image'){
                                $value_image = get_term_meta($attribute_value->term_id,'color',true);
                                $value_name = '<img  src="'.esc_url($value_image).'" alt="'.$value_title.'">';
                            }else if($get_type == 'color'){
                                $value_color = get_term_meta($attribute_value->term_id,'color',true);
                                $value_name = '<span '.bzotech_add_html_attr('background-color:'.$value_color).'"></span>';
                            }

                            if($type == 'click' ){
                                $html .= '<a class="item" title="'.$value_title.'" href="' . esc_url( get_term_link( $attribute_value->term_id, $attribute->get_name() ) ) . '" rel="tag">' . $value_name .''.$value_desc. '</a>';
                            }else{ 
                               $html .= '<span class="item" title="'.$value_title.'"  >' . $value_name .''.$value_desc. '</span>';
                            }
                            
                        }
                    }

                $html .= '</div>';
            }
        }
        if(!empty($html)){
          $html_ok .= '<div class="attribute_data-'.$type.' '.$class.' ">'.$html.'</div>';
        }
        if($echo) echo apply_filters( 'bzotech_output_content',$html_ok);
        else return $html_ok;
    }
}



 /**
 * 
 * Enqueue css popup YITH_Woocompare
 * Hook to yith_woocompare_popup_head
 * 
 * @return void
 *
 * */
if(class_exists('YITH_Woocompare_Frontend')){
    add_action( 'yith_woocompare_popup_head', 'bzotech_custom_compare_popup' );
    if(!function_exists('bzotech_custom_compare_popup')){
        function bzotech_custom_compare_popup(){
            $custom_style = Bzotech_Template::load_view('custom_css');
            $title_typo = bzotech_get_value_by_id('title_typo');
            $body_typo = bzotech_get_value_by_id('body_typo');
            $body_font='';
            echo '<style id="bzotech-theme-compare-css" type="text/css">'.$custom_style.' </style>';
            
            echo '<link rel="stylesheet" href="'.get_template_directory_uri() . '/assets/css/custom-compare.css" type="text/css">';
            if(!empty($body_typo['font-family'])) 
                
                $body_font .= $body_typo['font-family'].':100,300,400,500,600,700|';
            if(!empty($title_typo['font-family'])) 
                $body_font .= $title_typo['font-family'].':100,300,400,500,600,700';
            echo'<link rel="stylesheet" id="bzotech-google-fonts-compare-css"  href="'.bzotech_get_google_link(array($body_font)).';ver=6.1.1" type="text/css" media="all" />';
        }
    }
}

/**
 * 
 * Add to cart ajax
 * Hook to wp_ajax_ , wp_ajax_nopriv_
 * 
 * @return void
 *
 * */
add_action( 'wp_ajax_add_to_cart', 'bzotech_minicart_ajax' );
add_action( 'wp_ajax_nopriv_add_to_cart', 'bzotech_minicart_ajax' );
if(!function_exists('bzotech_minicart_ajax')){
    function bzotech_minicart_ajax() {
        check_ajax_referer( 'addtocart-ajax-nonce', 'security');
        $product_id = apply_filters( 'woocommerce_add_to_cart_product_id', absint( $_POST['product_id'] ) );
        $quantity = empty( $_POST['quantity'] ) ? 1 : apply_filters( 'woocommerce_stock_amount', $_POST['quantity'] );
        $passed_validation = apply_filters( 'woocommerce_add_to_cart_validation', true, $product_id, $quantity );

        if ( $passed_validation && WC()->cart->add_to_cart( $product_id, $quantity ) ) {
            do_action( 'woocommerce_ajax_added_to_cart', $product_id );
            WC_AJAX::get_refreshed_fragments();
        } else {
            $this->json_headers();

            // If there was an error adding to the cart, redirect to the product page to show any errors
            $data = array(
                'error' => true,
                'product_url' => apply_filters( 'woocommerce_cart_redirect_after_error', get_permalink( $product_id ), $product_id )
                );
            echo json_encode( $data );
        }
        die();
    }
}



/**
 * 
 * Update to cart ajax
 * Hook to wp_ajax_ , wp_ajax_nopriv_
 * 
 * @return void
 *
 * */
add_action( 'wp_ajax_update_mini_cart', 'bzotech_update_mini_cart' );
add_action( 'wp_ajax_nopriv_update_mini_cart', 'bzotech_update_mini_cart' );
if(!function_exists('bzotech_update_mini_cart')){
    function bzotech_update_mini_cart() {
        check_ajax_referer( 'update-mini-cart-ajax-nonce', 'security');
        WC_AJAX::get_refreshed_fragments();
        die();
    }
}

/**
 * 
 * Remove item mini cart ajax
 * Hook to wp_ajax_ , wp_ajax_nopriv_
 * 
 * @return void
 *
 * */
add_action( 'wp_ajax_product_remove', 'bzotech_product_remove' );
add_action( 'wp_ajax_nopriv_product_remove', 'bzotech_product_remove' );
if(!function_exists('bzotech_product_remove')){
    function bzotech_product_remove() {
        check_ajax_referer( 'product-remove-ajax-nonce', 'security');
        global $wpdb, $woocommerce;
        $cart_item_key = sanitize_text_field($_POST['cart_item_key']);
        if ( $woocommerce->cart->get_cart_item( $cart_item_key ) ) {
            $woocommerce->cart->remove_cart_item( $cart_item_key );
        }
        WC_AJAX::get_refreshed_fragments();
        die();
    }
}

/**
 * 
 * Quick view single product ajax
 * Hook to wp_ajax_ , wp_ajax_nopriv_
 * 
 * @return void
 *
 * */
add_action( 'wp_ajax_product_popup_content', 'bzotech_product_popup_content' );
add_action( 'wp_ajax_nopriv_product_popup_content', 'bzotech_product_popup_content' );
if(!function_exists('bzotech_product_popup_content')){
    function bzotech_product_popup_content() {
        $product_id = absint($_POST['product_id']);
        $query = new WP_Query( array(
            'post_type' => 'product',
            'post__in' => array($product_id)
            ));
        $style = '';
        $style = bzotech_get_option('quick_view_style');
        if( $query->have_posts() ):
            if(class_exists('WPBMap')) WPBMap::addAllMappedShortcodes();
            echo '<div class="woocommerce single-product product-popup-content '.esc_attr($style).'"><div class="product detail-product">';
            while ( $query->have_posts() ) : $query->the_post(); 

                bzotech_get_template_woocommerce('quick-view/view',$style,false,true);
            endwhile;
            echo '</div></div>';
        endif;
        wp_reset_postdata();
    }
}

/**
 * 
 * live search ajax
 * Hook to wp_ajax_ , wp_ajax_nopriv_
 * 
 * @return void
 *
 * */
add_action( 'wp_ajax_live_search', 'bzotech_live_search' );
add_action( 'wp_ajax_nopriv_live_search', 'bzotech_live_search' );
if(!function_exists('bzotech_live_search')){
    function bzotech_live_search() {
        check_ajax_referer( 'live-search-ajax-nonce', 'security');
        $key = isset($_POST['key']) ? $_POST['key'] : '';
        $cat = isset($_POST['cat']) ? $_POST['cat'] : '';
        $post_type = isset($_POST['post_type']) ? $_POST['post_type'] : 'post';
        $taxonomy = isset($_POST['taxonomy']) ? $_POST['taxonomy'] : 'category';

        $trim_key = trim($key);
        $args_search = array(
            'post_type' => $post_type,
            's'         => $key,
            'post_status' => 'publish'
            );
        if($taxonomy == 'category_name') $taxonomy = 'category';
        if(!empty($cat)) {
            $taxonomy = str_replace('_name', '', $taxonomy);
            $args_search['tax_query'][]=array(
                'taxonomy'  =>  $taxonomy,
                'field'     =>  'slug',
                'terms'     =>  $cat
            );
        }
        if($post_type == 'product'){
           $args['tax_query'][] = array(
                'taxonomy' => 'product_visibility',
                'field'    => 'name',
                'terms'    => 'exclude-from-search',
                'operator' => 'NOT IN',
            );
        }
        
        $query = new WP_Query( $args_search );
        if( $query->have_posts() && !empty($key) && !empty($trim_key)){
            while ( $query->have_posts() ) : $query->the_post();
                echo    '<div class="item-search-pro">
                            <div class="search-ajax-thumb product-thumb">
                                <a href="'.esc_url(get_the_permalink()).'" class="product-thumb-link">
                                    '.get_the_post_thumbnail(get_the_ID(),array(50,50)).'
                                </a>
                            </div>
                            <div class="search-ajax-title"><h3 class="title14"><a href="'.esc_url(get_the_permalink()).'">'.get_the_title().'</a></h3></div>';
                            if($post_type == 'product' && class_exists('woocommerce')) echo '<div class="search-ajax-price">'.bzotech_get_price_html(false).'</div>';
                echo    '</div>';
            endwhile;
        }
        else{
            echo '<p class="text-center">'.esc_html__("No any results with this keyword.",'bw-petito').'</p>';
        }
        wp_reset_postdata();
    }

}
add_filter( 'woocommerce_get_availability_text', 'bzotech_customizing_availability_text', 10, 2);
function bzotech_customizing_availability_text( $availability, $product ) {

    if ( ! $product->is_in_stock() ) {
        $availability = esc_html__( 'Out of stock', 'bw-petito' );
    } elseif ( $product->managing_stock() && $product->is_on_backorder( 1 ) ) {
        $availability = $product->backorders_require_notification() ? esc_html__( 'Available on backorder', 'bw-petito' ) : '';
    } elseif ( ! $product->managing_stock() && $product->is_on_backorder( 1 ) ) {
        $availability = esc_html__( 'Available on backorder', 'bw-petito' );
    } elseif ( $product->managing_stock() ) {
        $availability = bzotech_wc_format_stock_for_display( $product );
    } else {
        $availability = '';
    }

    return $availability;
}
if(!function_exists('bzotech_wc_format_stock_for_display')){
    function bzotech_wc_format_stock_for_display( $product ) {
        $display      = esc_html__( 'In stock', 'bw-petito' );
        $stock_amount = $product->get_stock_quantity();

        switch ( get_option( 'woocommerce_stock_format' ) ) {
            case 'low_amount':
                if ( $stock_amount <= wc_get_low_stock_amount( $product ) ) {
                    /* translators: %s: stock amount */
                    $display = sprintf( esc_html__( 'Only %s left in stock', 'bw-petito' ), wc_format_stock_quantity_for_display( $stock_amount, $product ) );
                }
                break;
            case '':
                /* translators: %s: stock amount */
                $display = sprintf( esc_html__( '%s items in stock', 'bw-petito' ), wc_format_stock_quantity_for_display( $stock_amount, $product ) );
                break;
        }

        if ( $product->backorders_allowed() && $product->backorders_require_notification() ) {
            $display .= ' ' . esc_html__( '(can be backordered)', 'bw-petito' );
        }

        return $display;
    }
}