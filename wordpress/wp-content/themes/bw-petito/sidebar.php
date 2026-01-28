<?php
/**
 * The sidebar containing the main widget area.
 *
 * @package BzoTech-Framework
 */
?>
<?php
$sidebar = bzotech_get_sidebar();
if ( is_active_sidebar( $sidebar['id']) && $sidebar['position'] != 'no' ):?>
	<div class="bzotech-col-md-3 bzotech-col-sm-4 bzotech-col-xs-12 sidebar-type-<?php echo esc_attr($sidebar['style'])?> sidebar-position-<?php echo esc_attr($sidebar['position'])?>">
	<?php
		if(is_archive()) {?>
			<div class="closeds-menu">
				<i class="las la-times"></i>
			</div>
		<?php	}
	?>
		
		<div class="sidebar sidebar-<?php echo esc_attr($sidebar['position'])?>">
		
		    <?php dynamic_sidebar($sidebar['id']); ?>
		</div>
	</div>
<?php endif;?>