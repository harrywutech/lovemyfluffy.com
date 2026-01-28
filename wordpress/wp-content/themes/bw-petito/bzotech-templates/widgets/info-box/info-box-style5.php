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
		<div class="product-categories">
			<div class="categories-1">
				
					<?php echo '<div class="image"><a '.$link_html.'>'.$image_html .'</a></div>'; ?>
				
				<div class="title_categories">
					<?php echo '<a '.$link_html.'>'.$title_html.'</a>' ?>
				</div>
				<?php if(!empty($cat)){ ?>
					<div class="count-item">
						<?php printf( _nx( '%1$s item', '%1$s items', $cat->count, 'number cate', 'bw-petito' ),number_format_i18n( $cat->count )); ?>
					</div>
				<?php } ?>
			</div>
		</div>
		<?php
	?>
		
			
</div>