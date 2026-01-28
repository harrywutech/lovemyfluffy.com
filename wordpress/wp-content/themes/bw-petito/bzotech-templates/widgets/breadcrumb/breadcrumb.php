<?php
namespace Elementor;
if(empty($step))$step = '<i  class="step-bread-crumb bread-crumb-e las la-angle-right"></i>';
?>
<div class="wrap-bread-crumb-element bread-crumb-">
	<div class="bread-crumb">
		<?php
			if(!bzotech_is_woocommerce_page()){
                if(function_exists('bcn_display')) bcn_display();
                else bzotech_breadcrumb($step,'bread-crumb-e');
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