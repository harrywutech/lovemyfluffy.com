<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @package htvietnam
 */
$page_id = bzotech_get_option('bzotech_404_page');
if(!empty($page_id)){	
	$style = bzotech_get_option('bzotech_404_page_style');
	if($style == 'full-width') {
		get_header('none');
		echo Bzotech_Template::get_vc_pagecontent($page_id);
		get_footer('none');
	}
	else{
		get_header(); ?>
		<div id="main-content" class="main-page-default">
		    <?php do_action('bzotech_before_main_content')?>
		    <div class="bzotech-container">
				<?php echo Bzotech_Template::get_vc_pagecontent($page_id);?>
			</div>
			<?php do_action('bzotech_after_main_content')?>
		</div>
		<?php get_footer();
	}
}
else{
	get_header(); ?>
	<div id="main-content" class="main-page-default">
	    <div class="bzotech-container">
	    	<div class="content-default-404">
		    	<div class="bzotech-row">
		    		<div class="bzotech-col-md-12">
		    			<div class="icon-404 text-center">
		    				<h2 class="number"><?php esc_html_e("404",'bw-petito')?></h2>
		    				<h3 class="text title36 color-title"><?php esc_html_e("Oops! That page can’t be found.",'bw-petito')?></h3>
		    				<p class="desc title18"><?php esc_html_e("It looks like nothing was found at this location. Maybe try one of the links below or a search?",'bw-petito')?></p>
		    				<a href="<?php echo esc_url(home_url('/'))?>" class="elbzotech-bt-default"><?php esc_html_e("Back to home",'bw-petito')?></a>
		    			</div>
		    		</div>
		    	</div>
		    </div>
		</div>
	</div>
	<?php get_footer(); 
}
