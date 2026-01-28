<?php
namespace Elementor;
extract($settings);

$wdata->add_render_attribute( 'wrapper', 'class', 'bzoteche-info-box-'.$settings['style'].' item-info-box');

?>
<div <?php echo apply_filters('bzotech_output_content', $wdata->get_render_attribute_string('wrapper'));?>>
    <div class="client-slider">
        <div class="slick center">
            <?php
            foreach (  $list_testimonial as $key => $item ) {
            
                $wdata->add_render_attribute( 'elbzotech-item', 'class', 'item-client elementor-repeater-item-'.$item['_id'] );
                echo '<div '.$wdata->get_render_attribute_string( 'elbzotech-item' ).'>';
                ?>
                    
                    <div class="client-info">
                        <?php if(!empty($item['content'])) echo '<p class="desc">'.$item['content'].'</p>';?>
                    </div>
                    <div class="client-thumb">
                    <?php if(!empty($item['image'])) echo '<a href="#">'.Group_Control_Image_Size::get_attachment_image_html( $list_testimonial[$key],'image','image').'</a>';?>
                        
                    </div>
                    <div class="title-pos">
                        <?php if(!empty($item['title'])) echo '<h3 class="title20 font-bold">'.$item['title'].'</h3>';?>
                        <?php if(!empty($item['position'])) echo '<p class="position title16 font-weight">'.$item['position'].'</p>';?>
                    </div>
                <?php
                echo '</div>';
                $wdata->remove_render_attribute( 'elbzotech-item', 'class', 'elementor-repeater-item-'.$item['_id'] );
            }
            ?>
        </div>
    </div>
</div>
