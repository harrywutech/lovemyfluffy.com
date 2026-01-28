<?php
global $post;

if(empty($size_list)) $size_list = array(530,745); //set value default of image size
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
    $item_button = 'no';
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
        $item_meta_select = ['date'];
    }
}
?>
<div class="bzotech-col-md-12">
    <div class="item-post item-list-post-style3 flex-wrapper">
        <?php if($item_thumbnail == 'yes' && has_post_thumbnail()):?>
            <div class="post-thumb <?php echo esc_attr($thumbnail_hover_animation)?>">
                <a href="<?php echo esc_url(get_the_permalink()) ?>">
                    <?php echo get_the_post_thumbnail(get_the_ID(),$size_list);?>
                </a>
            </div>
        <?php endif;?>
            <div class="post-info">
                <div class="post-info2">
                   <?php if($item_meta == 'yes') bzotech_display_metabox('detail-post',$item_meta_select,'','meta-post-style2');?>
                    <?php if($item_title == 'yes'):?><h3 class="post-title title28 font-title post-title font-bold"><a class=" color-title" href="<?php echo esc_url(get_the_permalink()) ?>"><?php the_title()?> <?php echo (is_sticky()) ? '<i class="sticky-icon las la-star"></i>':''?></a></h3><?php endif?>
                    
                    <?php if($item_excerpt == 'yes') echo '<p class="desc color-title title18">'.get_the_excerpt().'</p>';?>

                    <?php if($item_button == 'yes'):?>
                        <div class="readmore-wrap">
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