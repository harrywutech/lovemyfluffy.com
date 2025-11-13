<?php
/**
 * The Template for displaying product archives, including the main shop page
 * LoveMyFluffy Custom Theme
 */

defined('ABSPATH') || exit;

get_header('shop'); ?>

<div class="woocommerce-shop-page">
    <div class="container">

        <?php if (apply_filters('woocommerce_show_page_title', true)) : ?>
            <header class="woocommerce-products-header">
                <h1 class="woocommerce-products-header__title page-title">
                    <?php woocommerce_page_title(); ?>
                    <span class="loading-paw">🐾</span>
                </h1>

                <?php
                // Category description
                $term_description = term_description();
                if (!empty($term_description)) :
                ?>
                    <div class="archive-description">
                        <?php echo $term_description; ?>
                    </div>
                <?php endif; ?>
            </header>
        <?php endif; ?>

        <?php
        // Pet category filter
        if (is_shop() || is_product_taxonomy()) :
        ?>
            <div class="pet-category-filter">
                <h3>Shop by Pet Type</h3>
                <div class="category-grid">
                    <?php
                    $categories = get_terms(array(
                        'taxonomy' => 'product_cat',
                        'hide_empty' => true,
                    ));

                    foreach ($categories as $category) :
                        $category_link = get_term_link($category);
                        if (!is_wp_error($category_link)) :
                            $category_class = lovemyfluffy_get_pet_category_class($category->slug);
                    ?>
                            <a href="<?php echo esc_url($category_link); ?>"
                               class="category-card <?php echo esc_attr($category_class); ?>">
                                <div class="category-icon">
                                    <?php
                                    $icons = array(
                                        'dogs' => '🐕',
                                        'cats' => '🐱',
                                        'birds' => '🐦',
                                        'fish' => '🐠',
                                        'small-pets' => '🐹'
                                    );
                                    echo isset($icons[$category->slug]) ? $icons[$category->slug] : '🐾';
                                    ?>
                                </div>
                                <h4><?php echo esc_html($category->name); ?></h4>
                                <p><?php echo esc_html($category->description); ?></p>
                                <span class="product-count"><?php echo $category->count; ?> products</span>
                            </a>
                    <?php
                        endif;
                    endforeach;
                    ?>
                </div>
            </div>
        <?php endif; ?>

        <?php
        // Breadcrumbs
        if (function_exists('lovemyfluffy_breadcrumbs')) {
            lovemyfluffy_breadcrumbs();
        }
        ?>

        <?php if (woocommerce_product_loop()) : ?>

            <?php
            // Hook for adding content before the shop loop
            do_action('woocommerce_before_shop_loop');
            ?>

            <div class="shop-controls">
                <div class="shop-view-options">
                    <button class="view-grid active" data-view="grid">Grid View</button>
                    <button class="view-list" data-view="list">List View</button>
                </div>

                <div class="shop-sorting">
                    <?php woocommerce_catalog_ordering(); ?>
                </div>

                <div class="shop-filtering">
                    <div class="price-filter">
                        <label>Price Range:</label>
                        <input type="range" id="price-min" min="0" max="500" value="0">
                        <input type="range" id="price-max" min="0" max="500" value="500">
                        <span class="price-display">$0 - $500</span>
                    </div>
                </div>
            </div>

            <div class="products-container" id="products-container">
                <?php woocommerce_product_loop_start(); ?>

                <?php if (wc_get_loop_prop('is_shortcode')) : ?>
                    <?php
                    foreach ($products as $product) {
                        $post_object = get_post($product->get_id());
                        setup_postdata($GLOBALS['post'] =& $post_object);
                        wc_get_template_part('content', 'product');
                    }
                    ?>
                <?php else : ?>
                    <?php while (have_posts()) : ?>
                        <?php the_post(); ?>
                        <?php
                        // Custom product display
                        global $product;
                        ?>

                        <li <?php wc_product_class('product-item', $product); ?>>
                            <div class="product-image">
                                <a href="<?php the_permalink(); ?>">
                                    <?php echo woocommerce_get_product_thumbnail(); ?>
                                </a>

                                <?php if ($product->is_on_sale()) : ?>
                                    <span class="sale-badge">Sale!</span>
                                <?php endif; ?>

                                <div class="product-actions">
                                    <?php woocommerce_template_loop_add_to_cart(); ?>
                                    <a href="<?php the_permalink(); ?>" class="quick-view">Quick View</a>
                                </div>
                            </div>

                            <div class="product-info">
                                <?php
                                // Display product categories
                                lovemyfluffy_display_product_categories();
                                ?>

                                <h3 class="product-title">
                                    <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                </h3>

                                <div class="product-rating">
                                    <?php woocommerce_template_loop_rating(); ?>
                                </div>

                                <div class="product-price">
                                    <?php woocommerce_template_loop_price(); ?>
                                </div>

                                <div class="product-excerpt">
                                    <?php echo wp_trim_words(get_the_excerpt(), 15); ?>
                                </div>
                            </div>
                        </li>

                    <?php endwhile; ?>
                <?php endif; ?>

                <?php woocommerce_product_loop_end(); ?>
            </div>

            <div class="load-more-section">
                <button id="load-more-products" class="load-more-btn">
                    Load More Products <span class="loading-paw">🐾</span>
                </button>
            </div>

            <?php
            // Hook for adding content after the shop loop
            do_action('woocommerce_after_shop_loop');
            ?>

        <?php else : ?>

            <div class="no-products-found">
                <h2>No products found</h2>
                <p>It looks like we don't have any products in this category yet.</p>
                <p>Check back soon for new arrivals, or browse our other pet categories!</p>

                <div class="suggested-categories">
                    <h3>Try browsing these categories:</h3>
                    <div class="category-suggestions">
                        <?php
                        $all_categories = get_terms(array(
                            'taxonomy' => 'product_cat',
                            'hide_empty' => true,
                            'number' => 4,
                        ));

                        foreach ($all_categories as $cat) :
                            $cat_link = get_term_link($cat);
                            if (!is_wp_error($cat_link)) :
                        ?>
                                <a href="<?php echo esc_url($cat_link); ?>" class="category-suggestion">
                                    <?php echo esc_html($cat->name); ?>
                                </a>
                        <?php
                            endif;
                        endforeach;
                        ?>
                    </div>
                </div>
            </div>

        <?php endif; ?>

    </div>
</div>

<style>
/* Additional styles for the shop page */
.pet-category-filter {
    margin: 2rem 0;
    padding: 2rem;
    background: linear-gradient(135deg, #f8f9fa, #e9ecef);
    border-radius: 15px;
}

.category-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    gap: 1.5rem;
    margin-top: 1rem;
}

.category-card {
    background: white;
    padding: 1.5rem;
    border-radius: 10px;
    text-align: center;
    text-decoration: none;
    color: #333;
    transition: all 0.3s ease;
    box-shadow: 0 4px 6px rgba(0,0,0,0.1);
}

.category-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 8px 15px rgba(0,0,0,0.2);
    text-decoration: none;
}

.category-icon {
    font-size: 3rem;
    margin-bottom: 1rem;
}

.category-card h4 {
    margin-bottom: 0.5rem;
    color: #2c3e50;
}

.product-count {
    font-size: 0.9rem;
    color: #666;
    font-style: italic;
}

.shop-controls {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin: 2rem 0;
    padding: 1rem;
    background: white;
    border-radius: 10px;
    box-shadow: 0 2px 4px rgba(0,0,0,0.1);
}

.shop-view-options button {
    padding: 0.5rem 1rem;
    margin-right: 0.5rem;
    border: 1px solid #ddd;
    background: white;
    cursor: pointer;
    border-radius: 5px;
}

.shop-view-options button.active {
    background: #ff6b9d;
    color: white;
    border-color: #ff6b9d;
}

.load-more-section {
    text-align: center;
    margin: 3rem 0;
}

.load-more-btn {
    padding: 1rem 2rem;
    background: linear-gradient(135deg, #ff6b9d, #c44569);
    color: white;
    border: none;
    border-radius: 25px;
    font-size: 1.1rem;
    cursor: pointer;
    transition: all 0.3s ease;
}

.load-more-btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 8px rgba(0,0,0,0.2);
}

.no-products-found {
    text-align: center;
    padding: 4rem 2rem;
    background: white;
    border-radius: 15px;
    box-shadow: 0 4px 6px rgba(0,0,0,0.1);
}

.category-suggestions {
    display: flex;
    justify-content: center;
    gap: 1rem;
    margin-top: 1rem;
    flex-wrap: wrap;
}

.category-suggestion {
    padding: 0.5rem 1rem;
    background: #ff6b9d;
    color: white;
    text-decoration: none;
    border-radius: 20px;
    transition: background 0.3s ease;
}

.category-suggestion:hover {
    background: #c44569;
    text-decoration: none;
}

.sale-badge {
    position: absolute;
    top: 10px;
    right: 10px;
    background: #e74c3c;
    color: white;
    padding: 0.3rem 0.8rem;
    border-radius: 15px;
    font-size: 0.8rem;
    font-weight: bold;
}

.product-actions {
    position: absolute;
    bottom: 10px;
    left: 50%;
    transform: translateX(-50%);
    opacity: 0;
    transition: opacity 0.3s ease;
    display: flex;
    gap: 0.5rem;
}

.product-item:hover .product-actions {
    opacity: 1;
}

.quick-view {
    padding: 0.5rem 1rem;
    background: rgba(255, 255, 255, 0.9);
    color: #333;
    text-decoration: none;
    border-radius: 15px;
    font-size: 0.9rem;
}

@media (max-width: 768px) {
    .shop-controls {
        flex-direction: column;
        gap: 1rem;
    }

    .category-grid {
        grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
        gap: 1rem;
    }

    .category-suggestions {
        flex-direction: column;
        align-items: center;
    }
}
</style>

<?php
get_footer('shop');
?>