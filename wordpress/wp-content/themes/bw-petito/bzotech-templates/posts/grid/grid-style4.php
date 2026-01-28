<?php
// $column set column in grid style
// $item_wrap set attribute in wrap div
// $item_inner set attribute in wrap inner div
// $item_thumbnail on/off thumbnail yes or empty
// $item_meta on/off meta yes or empty
// $item_title on/off title yes or empty
// $item_excerpt on/off excerpt yes or empty
// $item_button on/off button yes or empty
if(empty($size)) $size = array(500,300);
if(is_array($size)) $size = bzotech_size_random($size);
if(!isset($item_thumbnail)){
    $item_thumbnail = 'yes';
}
if(!isset($item_title)){
    $item_title = 'yes';
}
if(!isset($item_excerpt)){
    $item_excerpt = 'no';
}
if(!isset($item_button)){
    $item_button = 'yes';
}
if(!isset($item_meta)) {
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
        $item_meta_select = ['cat'];
    }
}

?>
<?php echo '<div '.$item_wrap.'>';?>
<?php echo '<div '.$item_inner.'>';?>
    <?php if($item_thumbnail == 'yes' && has_post_thumbnail()):?>
        <div class="post-thumb zoom-image">
            <a href="<?php echo esc_url(get_the_permalink()) ?>" class="adv-thumb-link elementor-animation-<?php echo esc_attr($thumbnail_hover_animation)?>">
                <?php echo get_the_post_thumbnail(get_the_ID(),$size); ?>
            </a>
        </div>
    <?php endif?>
    <div class="post-info">
        <?php if($item_meta == 'yes'){
            echo '<div class="post-cat-wrap">';
            echo '<span>'.esc_html__('In','bw-petito').'</span>'; 
            echo get_the_category_list();
            echo '</div>';
        }  ?>
       
        <?php if($item_title == 'yes'):?><h3 class="title22 font-title post-title"><a class="color-title" href="<?php echo esc_url(get_the_permalink()) ?>"><?php the_title()?></a></h3><?php endif ?>
       
        <?php if($item_excerpt == 'yes') echo '<p class="desc">'.bzotech_substr(get_the_excerpt(),0,$excerpt).'</p>';?>
        <?php if($item_button == 'yes'):?>
            <div class="readmore-wrap">
                <a href="<?php echo esc_url(get_the_permalink()) ?>" class="readmore elbzotech-bt-style1">
                    <?php if($button_icon_pos == 'before-text' && $button_icon) echo '<i class="'.$button_icon['value'].'"></i>';?>
                    <?php echo apply_filters('bzotech_output_content',$button_text); ?>
                    <?php if($button_icon_pos == 'after-text' && $button_icon) echo '<i class="'.$button_icon['value'].'"></i>';?>                    
                </a>
            </div>
        <?php endif?>
    </div>
</div>
</div>