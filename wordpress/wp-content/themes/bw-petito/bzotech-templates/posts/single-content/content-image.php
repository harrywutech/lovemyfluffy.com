<?php
if(empty($size)) $size = 'full';
global $post; 
if($style == 'style2'){
$bg_url= get_the_post_thumbnail_url(get_the_ID(),$size); ?>
    <div class="single-post-media-format">
        <div class="format-standard banner-advs bg-color" <?php echo bzotech_add_html_attr('background-image:url('.$bg_url.')'); ?>>
            <?php echo get_the_post_thumbnail(get_the_ID(),$size); ?>
        </div>
        <div class="info-meta-post-single2">
            <div class="bzotech-container">
                <?php 
                if( !empty( $post->post_title ) ){ ?>
                     <h2 class="title48 font-title title-post-single font-bold color-white text-capitalize">
                        <?php the_title()?>
                        <?php echo (is_sticky()) ? '<i class="sticky-icon las la-star"></i>':''?>
                    </h2> <?php }
                if($check_meta == 'yes') bzotech_display_metabox('detail-post',$item_meta_select,'','style-meta-detail-post white'); 
                ?>
             </div>
         </div>
    </div>
    <?php
}else{
    if (has_post_thumbnail()) { ?>
        <div class="single-post-media-format">
            <div class="format-standard banner-advs">
                <?php echo get_the_post_thumbnail(get_the_ID(),$size); ?>
            </div>
        </div>
        <?php
    }
}