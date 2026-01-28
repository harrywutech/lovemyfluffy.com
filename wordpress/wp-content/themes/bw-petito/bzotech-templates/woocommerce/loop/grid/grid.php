<?php
if(!isset($animation)) $animation = bzotech_get_option('shop_thumb_animation');

if(empty($size)|| $size=='custom') $size = array(400,540);
if(is_array($size)) $size = bzotech_size_random($size);


if(!isset($item_thumbnail)){
    $item_thumbnail = 'yes';
}
if(!isset($item_title)){
    $item_title = 'yes';
}
if(!isset($item_price)){
    $item_price = 'yes';
}
if(!isset($item_rate)){
    $item_rate = 'yes';
}
if(!isset($item_label)){
    $item_label = 'yes';
}
if(!isset($item_quickview)){
    $item_quickview = 'yes';
}
if(!isset($item_button)){
    $item_button = 'yes';
}
$class_attribute = 'attribute-close';
$data_tabs = get_post_meta(get_the_ID(),'bzotech_product_attribute_data',true);
if(!empty($data_tabs) and is_array($data_tabs) and !empty($data_tabs[0]['color_att']['color'])){
	$class_attribute = 'attribute-open';
}
?>
<?php if($view !== 'slider-masory') echo '<div '.$item_wrap.'>';?>
	<?php if($view !== 'slider-masory') echo '<div '.$item_inner.'>';?>
		<?php do_action( 'woocommerce_before_shop_loop_item' );?>
		<?php if($item_thumbnail == 'yes' && has_post_thumbnail()):?>
			<div class="product-thumb <?php echo esc_attr($class_attribute); ?>">
				<!-- bzotech_woocommerce_thumbnail_loop have $size and $animation -->
				<?php if($item_label == 'yes') bzotech_product_label()?>
				<div class="product-grid-title-image">
				<?php if($item_title == 'yes'):?>
					<h3 class="title18 product-title font-weight">
						<a class="color-title" title="<?php echo esc_attr(the_title_attribute(array('echo'=>false)))?>" href="<?php the_permalink()?>"><?php the_title()?></a>
					</h3>
					<?php endif?>
					<?php bzotech_woocommerce_thumbnail_loop($size,$animation);?>
					
				</div>
				<div class="product-extra-link ">
					<div class="grid-product-layout product">
						
						<?php if($item_button == 'yes'):?>
						<?php echo bzotech_wishlist_url('','','',false) ;?>
						<?php if($item_quickview == 'yes') bzotech_product_quickview('item-style-product-extra')?>
						
						<?php 
						$icon_after = $icon = '';
						if(!empty($button_icon['value'])){
							$icon = '<i class="'.$button_icon['value'].'"></i>';
							if($button_icon_pos == 'after-text'){
								$icon_after = $icon;
								$icon = '';
							}
						}else{
							$icon = '<i class="las la-shopping-bag"></i>';
						}
						bzotech_addtocart_link([
							'icon'		=>$icon,
							'text'		=>$button_text,
							'icon_after'=>$icon_after,
							'el_class'=>'addcart-link-style1',
							'style'=>'cart-icon'
						]);
						
						?>
						
						<?php endif?>
					
					</div>
				</div>
				
				<?php do_action( 'woocommerce_before_shop_loop_item_title' );?>
			</div>
		<?php endif?>
		<div class="product-info">
			
			<?php do_action( 'woocommerce_shop_loop_item_title' );?>
			<?php do_action( 'woocommerce_after_shop_loop_item_title' );?>
			<?php if($item_price == 'yes') bzotech_get_price_html()?>
			<?php if($item_rate == 'yes') bzotech_get_rating_html(true,true)?>
			
		</div>		
		<?php do_action( 'woocommerce_after_shop_loop_item' );?>
<?php if($view !== 'slider-masory') echo '</div></div>';
	