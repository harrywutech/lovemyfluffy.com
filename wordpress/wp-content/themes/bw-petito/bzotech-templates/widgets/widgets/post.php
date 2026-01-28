<?php
/**
 * Created by PhpStorm.
 * User: mai100it
 * Date: 26/02/2018
 * Time: 10:40 SA
 */
extract($instance);
$image_size = bzotech_get_size_image('500x500',$image_size);
?>
<div class="wg-post-list">
    <?php
    if($post_query->have_posts()) { ?>
    <div class="wg-product-slider">
        <div class="elbzotech-wrapper-slider display-swiper-navi-style1 ">
            <div class="elbzotech-swiper-slider swiper-container slider-wrap" data-items-custom="" data-items="1" data-items-tablet="1" data-items-mobile="1" data-space="40" data-space-tablet="" data-space-mobile="" data-column="<?php echo esc_attr($number_row)?>" data-auto="" data-center="" data-loop="" data-speed="" data-navigation="" data-pagination=""> 
                <div class="swiper-wrapper"> 
                <?php
                while($post_query->have_posts()) {
                    $post_query->the_post(); ?>
                        <div class="swiper-slide item-post-wg flex-wrapper align-content-center">
                            <div class="post-thumb banner-advs zoom-image">
                                <a href="<?php echo esc_url(get_the_permalink()); ?>" class="adv-thumb-link">
                                    <?php
                                    if(has_post_thumbnail()) the_post_thumbnail($image_size);
                                    ?>
                                </a>
                            </div>

                            <div class="post-info">
                                <?php the_title('<h3 class="post-title title18 font-title font-bold"><a class="color-title" href="'.esc_url(get_the_permalink()).'">','</a></h3>')?>
                                <div class="the-date title22">
                                    <?php bzotech_display_metabox('detail-post',array('date'),'','meta-post-style1'); ?>
                                </div>
                            </div>
                        </div>
                <?php }
                wp_reset_postdata(); ?>
                </div>
            </div>
        </div>
    </div>
    <?php } ?>
</div>