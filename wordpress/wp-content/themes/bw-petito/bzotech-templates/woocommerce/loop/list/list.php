<?php

if(!isset($item_label)){
    $item_label = 'yes';
}
if(!isset($item_quickview)){
    $item_quickview = 'yes';
}

if(!isset($item_list_style)){
    $item_list_style = '';
}
if(!isset($animation)) $animation = bzotech_get_option('shop_thumb_animation');
if(empty($size_list)) $size_list = array(370,370);
$col_class = 'bzotech-col-md-12 bzotech-col-sm-12 bzotech-col-xs-12';
global $post;

?>
<div class="bzotech-col-md-12">
    <div class="item-product item-list-<?php echo esc_attr($item_list_style); ?>">
        <div class="flex-wrapper">
        	<?php do_action( 'woocommerce_before_shop_loop_item' );?>
            <?php if(has_post_thumbnail()):?>
                <div class="list-thumb-wrap">
					<div class="product-thumb">
						<!-- bzotech_woocommerce_thumbnail_loop have $size and $animation -->
						<?php bzotech_woocommerce_thumbnail_loop($size,$animation);?>
						<?php if($item_quickview == 'yes') bzotech_product_quickview()?>
						<?php if($item_label == 'yes') bzotech_product_label()?>
						<?php do_action( 'woocommerce_before_shop_loop_item_title' );?>
					</div>
                </div>
            <?php endif;?>
            <div class="list-info-wrap">
                <div class="product-info">
					<h3 class="title22 product-title font-bold">
						<a title="<?php echo esc_attr(the_title_attribute(array('echo'=>false)))?>" href="<?php the_permalink()?>"><?php the_title()?></a>
					</h3>
				<?php do_action( 'woocommerce_shop_loop_item_title' );?>
				<?php do_action( 'woocommerce_after_shop_loop_item_title' );?>
				<?php  bzotech_get_rating_html(true,false)?>
				<?php  bzotech_get_price_html(); ?>
				
				 <div class="hover-desr-list">
                    <?php echo apply_filters( 'woocommerce_short_description', $post->post_excerpt ); ?>
                    <a href="#" class="more-details-btn" onclick="return false;"><i data-fip-value="la la-ellipsis-h" class="la la-ellipsis-h"></i></a>
                 </div>
				
                </div>
            </div>
			<div class= "list-add-group">
				<div class="product-extra-link addcart-link-wrap">
					<?php 
					$icon_after = $icon = '';
					if(isset($button_icon['value'])){
						$icon = '<i class="'.$button_icon['value'].'"></i>';
						if($button_icon_pos == 'after-text'){
							$icon_after = $icon;
							$icon = '';
						}
					}
					bzotech_addtocart_link([
						'icon'		=>$icon,
						'text'		=>$button_text,
						'icon_after'=>$icon_after,
					]);
				
					?>
					<div class="list-icon product">
						<?php 	
						
						echo bzotech_compare_url();
						echo bzotech_wishlist_url();  //do_shortcode('[yith_wcwl_add_to_wishlist]');
						?>
					</div>
				</div>
			</div>
            <?php do_action( 'woocommerce_after_shop_loop_item' );?>
        </div>
    </div>
</div>