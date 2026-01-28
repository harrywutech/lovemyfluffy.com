<?php
// $column set column in grid style
// $item_wrap set attribute in wrap div
// $item_inner set attribute in wrap inner div
// $item_thumbnail on/off thumbnail yes or empty
// $item_meta on/off meta yes or empty
// $item_title on/off title yes or empty
// $item_excerpt on/off excerpt yes or empty
// $item_button on/off button yes or empty
//
if(empty($size)) $size = array(500,330);
if(is_array($size)) $size = bzotech_size_random($size);
if(empty($item_thumbnail)){
    $item_thumbnail = 'yes';
}
if(empty($item_title)){
    $item_title = 'yes';
}
if(empty($item_excerpt)){
    $item_excerpt = 'yes';
}
if(empty($item_button)){
    $item_button = '';
}
if(empty($item_meta)) {
    $item_meta_option=bzotech_get_option('post_list_meta');
    if(!empty($item_meta_option))
        $item_meta = $item_meta_option;
    else{
        $item_meta = 'yes';
    }
} 
if(empty($item_meta_select)) {
    $item_meta_select_option=bzotech_get_option('item_meta_select');
    if(!empty($item_meta_select_option))
        $item_meta_select = $item_meta_select_option;
    else{
        $item_meta_select = ['author'];
    }
}
?>
<?php echo '<div '.$item_wrap.'>';?>
    <?php echo '<div '.$item_inner.'>';?>
        
        <div class="post-info">
            <div class="info2">
                  <?php if($item_meta == 'yes') bzotech_display_metabox('post-grid-style2',$item_meta_select,'','meta-post-style2');?>
                <?php if($item_title == 'yes'):?><h3 class="title28 post-title font-title font-bold "><a class="color-title" href="<?php echo esc_url(get_the_permalink()) ?>"><?php the_title()?></a></h3><?php endif ?>
              
                <?php if($item_excerpt == 'yes') echo '<p class="desc color-title color-title title14 font-regular">'.bzotech_substr(get_the_excerpt(),0,$excerpt).'</p>';?>
                <?php if($item_button == 'yes'):?>
                    <div class="readmore-wrap">
                        <a href="<?php echo esc_url(get_the_permalink()) ?>" class="readmore">
                            <?php if($button_icon_pos == 'before-icon' && $button_icon) echo '<i class="'.$button_icon['value'].'"></i>';?>
                     
                            <?php echo apply_filters('bzotech_output_content',$button_text); ?>
                            <?php if($button_icon_pos == 'after-icon' && $button_icon) echo '<i class="'.$button_icon['value'].'"></i>';?>                    
                        </a>
                    </div>
                <?php endif?>
            </div>
            
        </div>
        <?php if($item_thumbnail == 'yes' && bzotech_get_image_thumbnail_by_id($size)):?>
            <div class="post-thumb zoom-image">
                <a href="<?php echo esc_url(get_the_permalink()) ?>" class="adv-thumb-link elementor-animation-<?php echo esc_attr($thumbnail_hover_animation)?>">
                    <?php echo bzotech_get_image_thumbnail_by_id($size); ?>
                </a>
            </div>
        <?php endif?>
    </div>
</div>