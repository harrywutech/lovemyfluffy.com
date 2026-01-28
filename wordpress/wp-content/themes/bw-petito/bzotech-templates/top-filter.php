<?php
$id = get_the_ID();
if(is_front_page() && is_home()) $id = (int)get_option( 'page_on_front' );
if(!is_front_page() && is_home()) $id = (int)get_option( 'page_for_posts' );
if($id) $title  = get_the_title($id);
else $title = esc_html__("Blog",'bw-petito');
if(!empty($title_filter)){
    $title =$title_filter;
}
if(is_archive()) $title = get_the_archive_title();
if(is_search()) $title = esc_html__("Search Result",'bw-petito');
if(function_exists('woocommerce_page_title') && bzotech_is_woocommerce_page()) $title = woocommerce_page_title(false);
global $post;
if($show_number == 'on' || $show_number == '1') $show_number = 'yes';
if($show_type == 'on' || $show_type == '1') $show_type = 'yes';
if(!isset($show_order)) $show_order = false;
if(isset($show_order) && $show_order == 'on' || $show_order == '1') $show_order = true;
?>
<?php if($show_number == 'yes' || $show_type == 'yes' || $show_order):?>
<div class="main-top-filter">
    <?php echo '<input type="hidden" name="load-shop-ajax-nonce" class="load-shop-ajax-nonce" value="' . wp_create_nonce( 'load-shop-ajax-nonce' ) . '" />'; ?>
    <div class="content-top-filter clearfix top-filter">
        <div class="mobile-filter">
            <a href="javascript:void(0);">
            <i class="las la-filter"></i>
            Filter 
            </a>
        </div>
        <?php 
        if(function_exists('is_shop')) if(is_shop()) $show_order = true;
        if($show_order == true) $add_class = 'load-shop-ajax';
        else $add_class = '';
        if($show_number == 'yes'):
                $source = 'blog';
                if(bzotech_is_woocommerce_page() || strpos($post->post_content, '[bzotech_shop')) $source = 'shop';
                $list   = bzotech_get_option($source.'_number_filter_list');
                if(isset($list[0]['number'])) $check_list = trim($list[0]['number']);
                if(empty($list) || !$check_list){
                    $list = array(12,16,20,24);
                }
                else{
                    $temp = array();
                    foreach ($list as $value) {
                        $temp[] = (int)$value['number'];
                    }
                    $list = $temp;
                }
                $number_df = get_option( 'posts_per_page' );
                if(!isset($count_query)){
                    $count_query ='';
                } else{
                     $count_query = '<span class="total-count">'.esc_html__(' of ','bw-petito').$count_query.'</span>';
                }
                if(!in_array((int)$number_df, $list)) $list = array_merge(array((int)$number_df),$list);
                if(!in_array((int)$number, $list) && $number) $list = array_merge(array((int)$number),$list);
                if(isset($wp_query->query_vars['posts_per_page'])) $number = $wp_query->query_vars['posts_per_page'];
                if(isset($_GET['number'])) $number = sanitize_text_field($_GET['number']); ?>
                <div class="show-by elbzotech-dropdown-box title20">
                    <a href="#" class="dropdown-link"><span class="gray"><?php esc_html_e("Showing: ",'bw-petito')?></span><span class="silver number"><?php echo esc_html((int)$number)?></span><?php echo apply_filters('bzotech_output_content',$count_query); ?></a>
                    <ul class=" list-none elbzotech-dropdown-list">
                        <?php
                        if(is_array($list)){
                            foreach ($list as $value) {
                                if($value == $number) $active = ' active';
                                else $active = '';
                                echo '<li><a data-number="'.esc_attr($value).'" class="'.esc_attr($add_class.$active).'" href="'.esc_url(bzotech_get_key_url('number',$value)).'">'.$value.'</a></li>';
                            }
                        }
                        ?>
                    </ul>
                </div>
        <?php endif;?>
       
        <?php if(bzotech_is_woocommerce_page())  woocommerce_result_count(); ?>
        <div class="select-short-by">
                        
        <ul class="sort-pagi-bar list-inline-block">
            <?php
                global $wp_query;
                
                $orderby = apply_filters( 'woocommerce_default_catalog_orderby', get_option( 'woocommerce_default_catalog_orderby' ) );
                if(isset($_GET['orderby'])) $orderby = sanitize_text_field($_GET['orderby']);
                if($show_order):?>
                    <li>
                        <div class="sort-by">
                            <span class="gray"><?php esc_html_e("Sort by:",'bw-petito');?></span>
                            <div class="select-box inline-block">
                                <?php bzotech_catalog_ordering($wp_query,$orderby,true,$add_class);?>
                            </div>
                        </div>
                    </li>
                <?php endif;
            ?>
            
            <?php if($show_type == 'yes'):?>
            <li>
                <div class="view-type">
                <span class="view-as"><?php esc_html_e("View as:",'bw-petito');?></span>
                
                    <a data-type="grid" href="<?php echo esc_url(bzotech_get_key_url('type','grid'))?>" class="grid-view <?php echo esc_attr($add_class)?> <?php if($style == 'grid') echo 'active'?>"><i class="las la-border-all"></i></a>
                    <a data-type="list" href="<?php echo esc_url(bzotech_get_key_url('type','list'))?>" class="list-view <?php echo esc_attr($add_class)?> <?php if($style == 'list') echo 'active'?>"><i class="las la-list"></i></a>
                </div>
            </li>
            <?php endif;?>
        </ul>

        </div>

        
    </div>
</div>
<?php endif; 