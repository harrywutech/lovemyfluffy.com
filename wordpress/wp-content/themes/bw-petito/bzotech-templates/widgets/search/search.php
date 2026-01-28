<?php
namespace Elementor;
extract($settings);
?>
<div class="elbzotech-search-wrap <?php echo esc_attr($settings['style'].' live-search-'.$live_search)?>">
	<?php if($style == 'elbzotech-search-icon'):?>
		<?php if($button_icon_pos == 'after-text' && !empty($icon_popup['value']) && !empty($text_after_icon)) echo '<span class="text-before-icon text-for-search">'.$text_after_icon.'</span>'; ?>
		<?php if($button_icon_pos == 'below-text' && !empty($icon_popup['value']) && !empty($text_after_icon)) echo '<div class="text-above-icon text-for-search">'.$text_after_icon.'</div>'; ?>
		<div class="search-icon-popup">
			
			<?php if(!empty( $icon_popup['value'])) Icons_Manager::render_icon( $icon_popup, [ 'aria-hidden' => 'true' ] ); ?>
		</div>
		<?php if($button_icon_pos == 'before-text' && !empty($icon_popup['value']) && !empty($text_after_icon)) echo '<span class="text-after-icon text-for-search">'.$text_after_icon.'</span>'; ?>
		<?php if($button_icon_pos == 'above-text' && !empty($icon_popup['value']) && !empty($text_after_icon)) echo '<div class="text-below-icon text-for-search">'.$text_after_icon.'</div>'; ?>
	<?php endif;?>
	<div class="elbzotech-search-form-wrap">
		<?php if($style == 'elbzotech-search-icon') echo '<i class="las la-times elbzotech-close-search-form"></i>';?>
		<form class="elbzotech-search-form <?php echo esc_attr($align_form)?>" action="<?php echo esc_url( home_url( '/' ) ); ?>">
			<?php echo '<input type="hidden" name="live-search-ajax-nonce" class="live-search-ajax-nonce" value="' . wp_create_nonce( 'live-search-ajax-nonce' ) . '" />'; ?>
	        <?php if($show_cat == 'yes' && $search_in != 'all'):?>
	            <div class="elbzotech-dropdown-box dropdown-box-cate">
	                <span class="dropdown-link current-search-cat">
	                	<?php echo esc_html($title_cat)?>
	                	<i class="las la-angle-down"></i>		                		
	                </span>
	                <ul class="list-none elbzotech-dropdown-list">
	                    <li class="active"><a class="select-cat-search" href="#" data-filter=""><?php echo esc_html($title_cat)?></a></li>
	                    <?php
	                        $taxonomy = 'category';
	                        $tax_key = 'category_name';
	                        if($search_in == 'product') $taxonomy = $tax_key = 'product_cat';
	                        if(!empty($cats)){
	                            $custom_list = explode(",",$cats);
	                            foreach ($custom_list as $key => $cat) {
	                                $term = get_term_by( 'slug',$cat, $taxonomy );
	                                if(!empty($term) && is_object($term)){
	                                    if(!empty($term) && is_object($term)){
	                                        echo '<li><a class="select-cat-search" href="#" data-filter="'.$term->slug.'">'.$term->name.'</a></li>';
	                                    }
	                                }
	                            }
	                        }
	                        else{
	                            $product_cat_list = get_terms($taxonomy);
	                            if(is_array($product_cat_list) && !empty($product_cat_list)){
	                                foreach ($product_cat_list as $cat) {
	                                    echo '<li><a class="select-cat-search" href="#" data-filter="'.$cat->slug.'">'.$cat->name.'</a></li>';
	                                }
	                            }
	                        }
	                    ?>
	                </ul>
	            </div>
	            <input class="cat-value" type="hidden" name="<?php echo esc_attr($tax_key)?>" value="" />
	        <?php endif;?>
	        <input name="s" onblur="if (this.value=='') this.value = this.defaultValue" onfocus="if (this.value==this.defaultValue) this.value = ''" value="<?php echo esc_attr($settings['placeholder']);?>" type="text" autocomplete="off">
	        <?php if($search_in != 'all'):?>
	            <input type="hidden" name="post_type" value="<?php echo esc_attr($search_in)?>" />
	        <?php endif;?>
	        <div class="elbzotech-submit-form">
	            <button type="submit" value="" class="elbzotech-text-bt-search">
		            	<?php if($settings['search_bttext'] && $settings['search_bttext_pos'] == 'before-icon') echo '<span>'.$settings['search_bttext'].'</span>'?>
		            	<?php Icons_Manager::render_icon( $settings['icon'], [ 'aria-hidden' => 'true' ] ); ?>
		            	<?php if($settings['search_bttext'] && $settings['search_bttext_pos'] == 'after-icon') echo '<span>'.$settings['search_bttext'].'</span>'?>
	            </button>
	            
	        </div>
	        <div class="elbzotech-list-product-search">
	            <p class="text-center"><?php esc_html_e("Please enter key search to display results.",'bw-petito')?></p>
	        </div>
	    </form>
	</div>
</div>