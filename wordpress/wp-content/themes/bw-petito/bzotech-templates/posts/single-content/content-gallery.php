<?php
$data = '';
global $post;
$gallery = get_post_meta(get_the_ID(), 'format_gallery', true);
if (!empty($gallery)){
    $array = explode(',', $gallery);
    if(is_array($array) && !empty($array)){?>

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
            <div class="format-gallery">
                <div class="elbzotech-wrapper-slider display-swiper-navi-style1">
                    <div class="elbzotech-swiper-slider swiper-container slider-wrap" data-items="1" data-space="30" data-speed="6000" data-navigation="style1" data-center="yes" data-loop="yes">
                        <div class="swiper-wrapper">
                            <?php
                            foreach ($array as $key => $item) {
                                                $thumbnail_url = wp_get_attachment_url($item);
                            ?>
                            <div class="swiper-slide">
                                <?php echo '<img src="' . esc_url($thumbnail_url) . '" alt="'.esc_attr__("Image slider",'bw-petito').'">'?>
                            </div>
                            <?php
                            
                            }
                            ?>
                        </div>
                    </div>
                    <div class="bzotech-swiper-navi">
                        <div class="swiper-button-nav swiper-button-next"><i class="las la-chevron-right"></i></div>
                        <div class="swiper-button-nav swiper-button-prev"><i class="las la-chevron-left"></i></div>
                    </div>
                </div>
            </div>
        </div>
    <?php
    } 
}