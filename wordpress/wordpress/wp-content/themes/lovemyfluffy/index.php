<?php
/**
 * The main template file
 *
 * @package LoveMyFluffy
 */

get_header(); ?>

<main id="main" class="site-main">
    <div class="container">
        <?php if (have_posts()) : ?>
            <div class="posts-grid">
                <?php while (have_posts()) : the_post(); ?>
                    <article id="post-<?php the_ID(); ?>" <?php post_class('post-item'); ?>>
                        <?php if (has_post_thumbnail()) : ?>
                            <div class="post-thumbnail">
                                <?php the_post_thumbnail('medium'); ?>
                            </div>
                        <?php endif; ?>

                        <div class="post-content">
                            <h2 class="post-title">
                                <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                            </h2>

                            <div class="post-meta">
                                <span class="post-date"><?php echo get_the_date(); ?></span>
                            </div>

                            <div class="post-excerpt">
                                <?php the_excerpt(); ?>
                            </div>

                            <a href="<?php the_permalink(); ?>" class="read-more">Read More</a>
                        </div>
                    </article>
                <?php endwhile; ?>
            </div>

            <?php the_posts_pagination(); ?>

        <?php else : ?>
            <p><?php _e('No posts found.', 'lovemyfluffy'); ?></p>
        <?php endif; ?>
    </div>
</main>

<?php
get_sidebar();
get_footer();