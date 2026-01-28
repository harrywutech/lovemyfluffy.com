<?php
/*
 * Template Name: Elementor Theme
 * Template Post Type: post, page, product, bzotech_header, bzotech_footer, bzotech_mega_item
 *
 * */

get_header();

?>
    <?php do_action('bzotech_before_main_content')?>
        <div class="main-elementor-template-theme">
            <?php
            while ( have_posts() ) : the_post();
                ?>
                    <div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                        <?php the_content(); ?>
                        
                    </div><!-- #post-## -->
                <?php
            endwhile; ?>
        </div>
    <?php do_action('bzotech_after_main_content')?>
<?php
get_footer();