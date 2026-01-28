<?php
extract($settings);
?>
<div <?php echo apply_filters('bzotech_output_content', $wdata->get_render_attribute_string('button-wrap')); ?> >
    <a <?php echo apply_filters('bzotech_output_content', $wdata->get_render_attribute_string('button-inner')); ?> >
    	<?php if($style == 'style2'|| $style == 'style3') echo '<span class="button-line">'; ?>
        <?php if($button_icon_pos == 'before-text' && !empty($button_icon['value'])) echo '<i class="icon-button-el '.$button_icon['value'].'"></i>';?>
        <?php if($button_icon_pos == 'above-text' && !empty($button_icon['value'])) echo '<div class="bzotech-icon-above"><i class="icon-button-el '.$button_icon['value'].'"></i></div>';?>
        <span class="text-button">
        	<?php echo apply_filters('bzotech_output_content',$button_text); ?>
    	</span>
        <?php if($button_icon_pos == 'after-text' && !empty($button_icon['value'])) echo '<i class="icon-button-el '.$button_icon['value'].'"></i>';?>
        <?php if($button_icon_pos == 'below-text' && !empty($button_icon['value'])) echo '<div class="bzotech-icon-below"><i class="icon-button-el '.$button_icon['value'].'"></i></div>';?>
        <?php if($style == 'style2'|| $style == 'style3') echo '</span>'; ?>            
    </a>
</div>