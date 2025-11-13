<?php
/**
 * The main template file
 * LoveMyFluffy Pet Supplies Theme
 */

get_header(); ?>

<main id="main" class="site-main">
    <div class="container">

        <?php if (have_posts()) : ?>

            <div class="posts-grid">
                <?php while (have_posts()) : the_post(); ?>

                    <article id="post-<?php the_ID(); ?>" <?php post_class('post-card'); ?>>

                        <?php if (has_post_thumbnail()) : ?>
                            <div class="post-thumbnail">
                                <a href="<?php the_permalink(); ?>">
                                    <?php the_post_thumbnail('medium'); ?>
                                </a>
                            </div>
                        <?php endif; ?>

                        <div class="post-content">
                            <header class="entry-header">
                                <h2 class="entry-title">
                                    <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                </h2>

                                <div class="entry-meta">
                                    <span class="posted-on">
                                        <?php echo get_the_date(); ?>
                                    </span>
                                    <span class="byline">
                                        by <?php the_author(); ?>
                                    </span>
                                </div>
                            </header>

                            <div class="entry-summary">
                                <?php the_excerpt(); ?>
                            </div>

                            <footer class="entry-footer">
                                <a href="<?php the_permalink(); ?>" class="read-more">
                                    Read More <span class="loading-paw">🐾</span>
                                </a>
                            </footer>
                        </div>

                    </article>

                <?php endwhile; ?>
            </div>

            <div class="pagination">
                <?php
                the_posts_pagination(array(
                    'prev_text' => '← Previous',
                    'next_text' => 'Next →',
                ));
                ?>
            </div>

        <?php else : ?>

            <section class="no-results">
                <header class="page-header">
                    <h1 class="page-title">Nothing here</h1>
                </header>

                <div class="page-content">
                    <p>It looks like nothing was found at this location. Maybe try searching for what you're looking for?</p>
                    <?php get_search_form(); ?>
                </div>
            </section>

        <?php endif; ?>

    </div>
</main>

<?php
get_sidebar();
get_footer();
?>