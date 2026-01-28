<?php
$data = ''; global $post;
$blog_single_title_check = bzotech_get_option('post_single_title','1');
if (get_post_meta(get_the_ID(), 'format_media', true)) {
    $media_url = get_post_meta(get_the_ID(), 'format_media', true); ?>
    <div class="single-post-media-format">
    	<?php
            if($style == 'style2'){ ?>
                <div class="info-meta-post-single2">
                    <div class="bzotech-container">
                        <?php 
                        if( !empty( $post->post_title ) ){ ?>
                             <h2 class="title48 font-title title-post-single font-bold color-white text-capitalize">
                                <?php the_title()?>
                                <?php echo (is_sticky()) ? '<i class="sticky-icon las la-star"></i>':''?>
                            </h2> <?php 
                        }
                        if($check_meta == 'yes') bzotech_display_metabox('detail-post',$item_meta_select,'','style-meta-detail-post white'); 
                        ?>
                     </div>
                 </div>
            <?php } ?>
    <?php
    echo '<div class="format-video">';
    echo bzotech_remove_w3c(wp_oembed_get($media_url, array( 'autoplay' => 1 )));
    echo '</div>';
    ?>
    </div>
    <?php
}
