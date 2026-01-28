<?php
// $column set column in grid style
// $item_wrap set attribute in wrap div
// $item_inner set attribute in wrap inner div
// $item_thumbnail on/off thumbnail yes or empty
// $item_meta on/off meta yes or empty
// $item_title on/off title yes or empty
// $item_excerpt on/off excerpt yes or empty
// $item_button on/off button yes or empty
if(empty($size)) $size = array(500,700);
if(is_array($size)) $size = bzotech_size_random($size);
if(!isset($item_thumbnail)){
    $item_thumbnail = 'yes';
}
if(!isset($item_title)){
    $item_title = 'yes';
}
if(!isset($item_excerpt)){
    $item_excerpt = 'yes';
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
        $item_meta_select = ['date','comments'];
    }
}
?>
<?php echo '<div '.$item_wrap.'>';?>
<?php echo '<div '.$item_inner.'>';?>
    <?php if($item_thumbnail == 'yes' && has_post_thumbnail()):?>
        <div class="post-thumb box-hover-dir">
            <section class="post-thumb-info">
                <?php echo get_the_post_thumbnail(get_the_ID(),$size); ?>
                <section class="post-info flex-wrapper align_items-center">
                    <section class="post-info2">
                        <?php if($item_meta == 'yes') {
                            echo '<span class="date font-title"><span class="day title70 font-bold">'.date('d').'</span><span class="th title28">'.date('M').'</span></span>';
                        }?>
                        <?php if($item_title == 'yes'):?><h3 class="title36 post-title font-title font-bold"><a class="color-title" href="<?php echo esc_url(get_the_permalink()) ?>"><?php the_title()?></a></h3><?php endif ?>
                        <?php if($item_meta == 'yes') bzotech_display_metabox('detail-post',$item_meta_select,'','meta-post-style1');?>
                        <?php if($item_excerpt == 'yes') echo '<p class="desc color-title font-title title22">'.bzotech_substr(get_the_excerpt(),0,$excerpt).'</p>';?>
                    </section>
                </section>
            </section>
            <div class="overlay">
                <a href="<?php echo esc_url(get_the_permalink()) ?>" class="adv-thumb-link elementor-animation-<?php echo esc_attr($thumbnail_hover_animation)?>">
                    <?php echo get_the_post_thumbnail(get_the_ID(),$size); ?>
               </a>
            </div>
        </div>
    <?php endif?>
</div>
</div>