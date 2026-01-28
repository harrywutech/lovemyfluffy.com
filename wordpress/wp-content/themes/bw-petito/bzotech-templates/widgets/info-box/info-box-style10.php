<?php
namespace Elementor;
extract($settings);
$wdata->add_render_attribute( 'wrapper', 'class', 'bzoteche-info-box-'.$settings['style'].' item-info-box');

?>
<div <?php echo apply_filters('bzotech_output_content', $wdata->get_render_attribute_string('wrapper'));?>>
	<?php 
		
		$wdata->add_render_attribute( 'data_link', 'class', 'item-cate ' );
		$link_html = $title_html = $image_html =$count_html ='';
		$cat = get_term_by('slug', $category, 'product_cat');
		if(!empty($cat)){
			

			$link_html =  'class=" item-cate " href="'.get_term_link($category,'product_cat').'"';
			$title_html = $cat->name;
			if($number_cate == 'yes')
			$count_html = '<span class="count">'.$cat->count.'</span>';
			$thumbnail_id = get_term_meta( $cat->term_id, 'thumbnail_id', true );
			$image_html    = wp_get_attachment_image( $thumbnail_id ,array(50,50));
		}
		if ( ! empty( $link_cate['url'] ) ) {
			$wdata->add_link_attributes( 'data_link', $link_cate);
			$link_html = $wdata->get_render_attribute_string( 'data_link');
		}
		if(!empty($title_cate)){
			$title_html = $title_cate;
		}
		if(!empty($image_cate['url'])){
			$image_html = wp_get_attachment_image( $image_cate['id'] ,'full');
		}
		?>
         <div class="image">
            <?php if(!empty($image_cate_bg['id'])) echo wp_get_attachment_image( $image_cate_bg['id'] ,'full');?>
            <div class="img-content-bg">
                <?php echo '<a class="item-cate"'.$link_html.'>'.$image_html.'</a>'; ?>
                <?php if(!empty($image_cate_hover['id'])) echo '<div class="image-hover position-'.$image_cate_hover_pos.'">'.wp_get_attachment_image( $image_cate_hover['id'] ,'full').'</div>';?>
            </div>
        </div>
        <div class="content">
            <?php echo '<h3 class="title26 font-regular "> <a '.$link_html.'">'.$title_html.'</a></h3>'; ?>    
        
            <?php echo '<div class="title20 font-weight ">'.$count_html.' '.esc_html__('Products','bw-petito').'</div>'; ?>
        </div>
		
			
</div>