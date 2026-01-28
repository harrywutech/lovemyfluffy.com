<?php
// $column set column in grid style
// $item_wrap set attribute in wrap div
// $item_inner set attribute in wrap inner div
// $item_thumbnail on/off thumbnail yes or empty
// $item_meta on/off meta yes or empty
// $item_title on/off title yes or empty
// $item_excerpt on/off excerpt yes or empty
// $item_button on/off button yes or empty
if(empty($size)) $size = array(500,330);
if(is_array($size)) $size = bzotech_size_random($size);
if(empty($item_thumbnail)){
    $item_thumbnail = 'yes';
}
if(empty($item_title)){
    $item_title = 'yes';
}
if(empty($item_excerpt)){
    $item_excerpt = '';
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
        $item_meta_select = ['cats','comments'];
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
    <svg xmlns="http://www.w3.org/2000/svg" width="460" height="184" viewBox="0 0 460 184" fill="none">
<path d="M118.5 7.53126C76.5 -6.10858 22 1.84799 0 7.53126V169C0 177.284 6.71573 184 15 184H445C453.284 184 460 177.284 460 169V7.53126C449.167 11.8773 394.987 21.4305 361.786 11C320.286 -2.0381 275.599 4 246.286 11C207.907 20.1653 171 24.5811 118.5 7.53126Z" fill="#82B5FF"/>
<path d="M118.5 7.53126C76.5 -6.10858 22 1.84799 0 7.53126V169C0 177.284 6.71573 184 15 184H445C453.284 184 460 177.284 460 169V7.53126C449.167 11.8773 394.987 21.4305 361.786 11C320.286 -2.0381 275.599 4 246.286 11C207.907 20.1653 171 24.5811 118.5 7.53126Z" fill="white" fill-opacity="0.8"/>
</svg>
        <div class="content1">
            <?php if($item_meta == 'yes') bzotech_display_metabox('detail-post',$item_meta_select,'','meta-post-style1');?>
            <?php if($item_title == 'yes'):?><h3 class="title20 post-title font-bold font-title"><a class="color-title" href="<?php echo esc_url(get_the_permalink()) ?>"><?php the_title()?></a></h3><?php endif ?>
            <?php if($item_excerpt == 'yes') echo '<p class="desc color-title title20">'.bzotech_substr(get_the_excerpt(),0,$excerpt).'</p>';?>
            <?php bzotech_display_metabox('post-grid-style2',['author'],'','meta-post-style2');?>
            <?php if($item_button == 'yes'):?>
                <div class="readmore-wrap ">
                    <a href="<?php echo esc_url(get_the_permalink()) ?>" class="elbzotech-bt-default">
                        <?php if($button_icon_pos == 'before-text' && $button_icon) echo '<i class="'.$button_icon['value'].'"></i>';?>
                        <?php echo apply_filters('bzotech_output_content',$button_text); ?>
                        <?php if($button_icon_pos == 'after-text' && $button_icon) echo '<i class="'.$button_icon['value'].'"></i>';?>                    
                    </a>
                </div>
            <?php endif?>
        </div>
    </div>
</div>
</div>