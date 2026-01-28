<?php
$id = get_the_ID();
if(is_front_page() && is_home()) $id = (int)get_option( 'page_on_front' );
if(!is_front_page() && is_home()) $id = (int)get_option( 'page_for_posts' );
if($id) $title  = get_the_title($id);
else $title = esc_html__("Blog",'bw-petito');
if(is_single()) $title = esc_html__("Blog",'bw-petito');
if(is_singular('product')) $title = esc_html__("Product",'bw-petito');
if(!empty($title_filter)){
    $title =$title_filter;
}

if(is_archive()) $title = get_the_archive_title();
if(is_search()) $title = esc_html__("Search Result",'bw-petito');

if(function_exists('is_shop')&& is_shop()) $title = woocommerce_page_title(false);

if(!isset($breadcrumb)) $breadcrumb = bzotech_get_value_by_id('bzotech_show_breadrumb');
if(!isset($el_class)) $el_class = 'bread-crumb-';
if($breadcrumb == '1'):
    $b_class = bzotech_fill_css_background(bzotech_get_option('bzotech_bg_breadcrumb'));
	$step = '<i class="las la-angle-right"></i>';
$bg_brc = bzotech_get_option('bzotech_bg_breadrumb');
?>
<div class="wrap-bread-crumb <?php echo esc_attr($el_class)?>" <?php echo bzotech_add_html_attr('background-image: url('.$bg_brc['url'].')')?>>
		<div class="bread-crumb bzotech-container <?php echo esc_attr($b_class)?>">
			<?php echo '<h2>'.$title.'</h2>';?>
			<div class="bread-crumb-row">			
				<?php
					if(!bzotech_is_woocommerce_page()){
		                if(function_exists('bcn_display')) bcn_display();
		                else bzotech_breadcrumb($step);
		            }
		            else {
		            	if(function_exists('woocommerce_breadcrumb')){
			            	woocommerce_breadcrumb(array(
			            	'delimiter'		=> $step,
			            	'wrap_before'	=> '',
			            	'wrap_after'	=> '',
			            	'before'      	=> '<span>',
							'after'       	=> '</span>',
			            	));
			            }
		            }
	            ?>
			</div>
		</div>
</div>
<?php endif;?>