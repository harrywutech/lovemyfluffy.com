<?php
namespace Elementor;
extract($settings);
$wdata->add_render_attribute( 'wrapper', 'class', 'bzotech-info-box-'.$settings['style'].' item-info-box');

?>
<div <?php echo apply_filters('bzotech_output_content', $wdata->get_render_attribute_string('wrapper'));?>>
	<?php 
		
		$wdata->add_render_attribute( 'data_link', 'class', 'item-cate ' );
		$link_html = $title_html = $image_html =$count_html =$icon_link=$viewmore_link_html='';
		$cat = get_term_by('slug', $category, 'product_cat');
		if($icon['value'] !=''){
			$icon_link ='<i class="'.$icon['value'].'"></i>';
		}
		if($icon_readmore_image['url'] !=''){
			$icon_link = '<img src="'.$icon_readmore_image['url'].'">';
		}
		if(!empty($cat)){
			

			$link_html =  'class="item-cate" href="'.get_term_link($category,'product_cat').'"';
			$viewmore_link_html =  'class="view-more" href="'.get_term_link($category,'product_cat').'"';
			$title_html = $cat->name;
			if($number_cate == 'yes')
			$count_html = '<span class="count">'.$cat->count.'</span>'.' '.esc_html__('Products','bw-petito');
		}
		if ( ! empty( $link_cate['url'] ) ) {
			$wdata->add_link_attributes( 'data_link', $link_cate);
			$link_html = $wdata->get_render_attribute_string( 'data_link');
			$viewmore_link_html=$link_html;
		}
		if(!empty($title_cate)){
			$title_html = $title_cate;
		}
		if(!empty($des_cate)){
			$count_html = $des_cate;
		}
		?>
         <div class="image">
            <?php if(!empty($image_cate_bg['id'])) echo wp_get_attachment_image( $image_cate_bg['id'] ,'full');?>
        </div>
        <div class="content">
            <?php echo '<h3 class="cat-title title34 font-regular "> <a '.$link_html.'>'.$title_html.'</a></h3>'; ?>    
            <?php echo '<div class="title20 font-weight text-count">'.$count_html.'</div>'; ?>
			<?php echo '<a '.$viewmore_link_html.'>'.$icon_link.'</a>'; ?>
        </div>
		
			
</div>