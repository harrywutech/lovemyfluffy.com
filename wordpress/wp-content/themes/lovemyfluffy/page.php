<?php
/**
 * Page Template
 * LoveMyFluffy Pet Supplies Theme
 */

get_header(); ?>

<main id="main" class="site-main">
    <div class="container">

        <?php while (have_posts()) : the_post(); ?>

            <article id="post-<?php the_ID(); ?>" <?php post_class('page-content'); ?>>

                <header class="entry-header">
                    <h1 class="entry-title"><?php the_title(); ?></h1>

                    <?php
                    // Breadcrumbs
                    if (function_exists('lovemyfluffy_breadcrumbs')) {
                        lovemyfluffy_breadcrumbs();
                    }
                    ?>
                </header>

                <div class="entry-content">
                    <?php
                    the_content();

                    wp_link_pages(array(
                        'before' => '<div class="page-links">' . esc_html__('Pages:', 'lovemyfluffy'),
                        'after'  => '</div>',
                    ));
                    ?>
                </div>

                <?php if (get_edit_post_link()) : ?>
                    <footer class="entry-footer">
                        <div class="edit-link">
                            <?php edit_post_link(
                                sprintf(
                                    wp_kses(
                                        __('Edit <span class="screen-reader-text">%s</span>', 'lovemyfluffy'),
                                        array(
                                            'span' => array(
                                                'class' => array(),
                                            ),
                                        )
                                    ),
                                    get_the_title()
                                )
                            ); ?>
                        </div>
                    </footer>
                <?php endif; ?>

            </article>

        <?php endwhile; ?>

    </div>
</main>

<style>
.page-content {
    background: white;
    padding: 3rem;
    border-radius: 15px;
    box-shadow: 0 4px 6px rgba(0,0,0,0.1);
    margin: 2rem 0;
}

.entry-header {
    margin-bottom: 2rem;
    padding-bottom: 1rem;
    border-bottom: 2px solid #ff6b9d;
}

.entry-title {
    font-size: 2.5rem;
    color: #2c3e50;
    margin-bottom: 1rem;
}

.entry-content {
    line-height: 1.8;
    font-size: 1.1rem;
}

.entry-content h2,
.entry-content h3,
.entry-content h4 {
    color: #2c3e50;
    margin-top: 2rem;
    margin-bottom: 1rem;
}

.entry-content h2 {
    font-size: 2rem;
}

.entry-content h3 {
    font-size: 1.5rem;
}

.entry-content h4 {
    font-size: 1.3rem;
}

.entry-content p {
    margin-bottom: 1.5rem;
}

.entry-content ul,
.entry-content ol {
    margin-bottom: 1.5rem;
    padding-left: 2rem;
}

.entry-content li {
    margin-bottom: 0.5rem;
}

.entry-content a {
    color: #ff6b9d;
    text-decoration: none;
    transition: color 0.3s ease;
}

.entry-content a:hover {
    color: #c44569;
    text-decoration: underline;
}

.page-links {
    margin-top: 2rem;
    padding-top: 1rem;
    border-top: 1px solid #ddd;
}

.entry-footer {
    margin-top: 2rem;
    padding-top: 1rem;
    border-top: 1px solid #ddd;
}

.edit-link a {
    background: #f8f9fa;
    padding: 0.5rem 1rem;
    border-radius: 5px;
    color: #666;
    text-decoration: none;
    font-size: 0.9rem;
}

.edit-link a:hover {
    background: #e9ecef;
}

@media (max-width: 768px) {
    .page-content {
        padding: 2rem 1.5rem;
        margin: 1rem 0;
    }

    .entry-title {
        font-size: 2rem;
    }

    .entry-content {
        font-size: 1rem;
    }
}
</style>

<?php
get_sidebar();
get_footer();
?>