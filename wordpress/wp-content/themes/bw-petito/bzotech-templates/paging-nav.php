<?php if ($links) :
    // Custom icon/text
    $links['prev_text'] = '<i class="las la-angle-left" aria-hidden="true"></i>';
    $links['next_text'] = '<i class="las la-angle-right" aria-hidden="true"></i>';
    ?>
    <div class="pagi-nav-block">
	    <div class="pagi-nav">
	        <?php echo apply_filters('bzotech_output_content',paginate_links($links)); ?>
	    </div>
    </div>
<?php endif;?>