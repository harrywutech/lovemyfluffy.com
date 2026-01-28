
<?php 
$style = bzotech_get_value_by_id('bzotech_style_post_detail');
$size = bzotech_get_option('post_single_size');
$check_thumb = bzotech_get_option('post_single_thumbnail','1');
$check_meta  = bzotech_get_option('post_single_meta','yes');
$item_meta_select  = bzotech_get_option('single_item_meta_select');
if(empty($item_meta_select)) $item_meta_select = ['author','comments'];
$size = bzotech_get_size_crop($size);



$data = array(
            'size'              => $size,
            'check_thumb'       => $check_thumb,
            'check_meta'        => $check_meta,
            'item_meta_select'  => $item_meta_select,
            'style'  => $style,
        );
?>
<div id="main-content"  class="main-page-default single-blog-<?php echo esc_attr($style); ?>">
    
    <?php
    global $post;
    setup_postdata($post); 
    if($check_thumb == '1')
    bzotech_get_template_post( 'single-content/content',get_post_format(),$data,true );
    wp_reset_postdata() 
      ?>
    <?php do_action('bzotech_before_main_content'); ?>
    <div class="bzotech-container container-single-post2">
        <div class="bzotech-row">
            <?php bzotech_output_sidebar('left')?>
            <div class="<?php echo esc_attr(bzotech_get_main_class()); ?>">
                <?php
                
                while ( have_posts() ) : the_post();
                    global $post;
                    /*
                    * Include the post format-specific template for the content. If you want to
                    * use this in a child theme, then include a file called called content-___.php
                    * (where ___ is the post format) and that will be used instead.
                    */

                    echo '<div class="content-single-blog">'; ?>
                        <div class="metabox-and-content">
                                                    
                            <div class="detail-content-wrap clearfix"><?php the_content(); ?></div>
                        </div>
                        <?php

                        wp_link_pages( array(
                            'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'bw-petito' ),
                            'after'  => '</div>',
                            'link_before' => '<span>',
                            'link_after'  => '</span>',
                        ) );
                      

                        bzotech_get_template_post( 'single-content/author','',false,true );
                        bzotech_get_template_post( 'single-content/navigation','',false,true );
                        bzotech_get_template_post( 'single-content/related','',false,true );
                        if ( comments_open() || get_comments_number() ) { comments_template(); }
                    echo '</div>';
                endwhile; ?>
            </div>
            <?php bzotech_output_sidebar('right')?>
        </div>
    </div>
    <?php do_action('bzotech_after_main_content') ?>
</div>