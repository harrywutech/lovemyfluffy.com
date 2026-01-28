<?php
namespace Elementor;
extract($settings);

$wdata->add_render_attribute( 'wrapper', 'class', 'bzotech-info-box-'.$settings['style']);
?>
<?php if(!empty($settings['list_info_style11']) and is_array($settings['list_info_style11'])){ ?>
	<div <?php echo ''.$wdata->get_render_attribute_string('wrapper');?>>
    <?php
        $delay_number=0;
		foreach ($settings['list_info_style11'] as $key => $link_info) {
            $delay_number += 0.3;
            $wdata->add_render_attribute( 'elbzotech-item-'.$key, 'class', 'item-info-box elementor-repeater-item-'.$link_info['_id'] ); ?>
            <div <?php echo apply_filters('bzotech_output_content', $wdata->get_render_attribute_string('elbzotech-item-'.$key));?>>
                        <?php
                        extract($link_info);
                        if(!empty($image['url'])) {
                            echo '<div class="info-icon">';
                            echo Group_Control_Image_Size::get_attachment_image_html( $link_info,'thumbnail','image');     
                        }
                        if(!empty($image_hover['url'])) {
                            echo '<div class="info-icon-hover">';
                            echo Group_Control_Image_Size::get_attachment_image_html( $link_info,'thumbnail','image_hover');
                            echo '</div>';
                        }
                        if(!empty($image['url'])) { echo '</div>';}
                        echo'<div class="info-box-content wow fadeInUp" data-wow-duration="0.8s" data-wow-delay="'.$delay_number.'s">';
                        if(!empty($title)) echo '<div class="title-info">'.$title.'</div>';
                        if(!empty($description)) echo '<div class="desc-info">'.$description.'</div>';
                        echo'</div>';
                        ?>
            </div>
        <?php } ?>
    </div>
<?php } ?>
