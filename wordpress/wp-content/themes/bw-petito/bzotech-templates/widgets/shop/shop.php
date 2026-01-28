<?php
extract($settings);
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
    'item_quickview'    => $item_quickview,
    'item_label'        => $item_label,
    'item_title'        => $item_title,
    'item_rate'         => $item_rate,
    'item_price'        => $item_price,
    'item_button'       => $item_button,
    'animation'         => $thumbnail_hover_animation,
    );
?>
<?php echo '<div '.$wdata->get_render_attribute_string( 'elbzotech-wrapper' ).'>';?>
    <?php
    if(isset($_GET['type'])) $view = sanitize_text_field($_GET['type']);
    if(isset($_GET['number'])) $number = sanitize_text_field($_GET['number']);
    if($show_top_filter == 'yes') bzotech_get_template('top-filter','',array('style'=>$view,'number'=>$number,'show_number'=>$show_number,'show_type'=>$show_type,'show_order'=>$show_order),true);
    if($filter_show == 'yes'){
        $data_filter = array(
            'args'          => $args,
            'attr'          => $attr,
            'filter_style'  => $filter_style,
            'filter_column' => $filter_column,
            'filter_cats'   => $filter_cats,
            'filter_price'  => $filter_price,
            'filter_attr'   => $filter_attr,
            'filter_pos'    => '',
        );
        bzotech_get_template_woocommerce('loop/filter-product','',$data_filter,true);
    }
    ?>
    <?php echo '<div '.$wdata->get_render_attribute_string( 'elbzotech-inner' ).'>';?>
        <?php
        $slug = $item_style;
        if($type_active == 'list') $slug = $item_list_style;
        if($product_query->have_posts()) {
            while($product_query->have_posts()) {
                $product_query->the_post();
                $attr['count'] = $count;
                bzotech_get_template_woocommerce('loop/'.$view.'/'.$view,$slug,$attr,true);
                $count++;
            }
        }
        ?>
    </div>
    <?php
    if($pagination == 'load-more' && $max_page > 1){
        $data_load = array(
            "args"        => $args,
            "attr"        => $attr,
            );
        $data_loadjs = json_encode($data_load);
        echo    '<div class="btn-loadmore">
                    <a href="#" class="product-loadmore loadmore elbzotech-bt-default elbzotech-bt-medium" 
                        data-load="'.esc_attr($data_loadjs).'" data-paged="1" 
                        data-maxpage="'.esc_attr($max_page).'">
                        '.esc_html__("Load more",'bw-petito').'
                    </a>
                </div>';
    }
    if($pagination == 'pagination') bzotech_get_template_woocommerce('loop/pagination','',array('wp_query'=>$product_query),true);
    ?>
</div>