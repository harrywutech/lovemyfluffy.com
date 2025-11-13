<?php
/**
 * LoveMyFluffy Theme Functions
 * Pet supplies e-commerce theme for LoveMyFluffy.com
 */

// Prevent direct access
if (!defined('ABSPATH')) {
    exit;
}

/**
 * Theme setup
 */
function lovemyfluffy_theme_setup() {
    // Add theme support for various features
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_theme_support('html5', array(
        'search-form',
        'comment-form',
        'comment-list',
        'gallery',
        'caption',
    ));

    // WooCommerce support
    add_theme_support('woocommerce');
    add_theme_support('wc-product-gallery-zoom');
    add_theme_support('wc-product-gallery-lightbox');
    add_theme_support('wc-product-gallery-slider');

    // Register navigation menus
    register_nav_menus(array(
        'primary' => __('Primary Menu', 'lovemyfluffy'),
        'footer' => __('Footer Menu', 'lovemyfluffy'),
    ));

    // Set content width
    $GLOBALS['content_width'] = 1200;
}
add_action('after_setup_theme', 'lovemyfluffy_theme_setup');

/**
 * Enqueue scripts and styles
 */
function lovemyfluffy_scripts() {
    // Main stylesheet
    wp_enqueue_style('lovemyfluffy-style', get_stylesheet_uri(), array(), '1.0.0');

    // Google Fonts
    wp_enqueue_style('lovemyfluffy-fonts', 'https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap', array(), null);

    // Main JavaScript
    wp_enqueue_script('lovemyfluffy-script', get_template_directory_uri() . '/js/main.js', array('jquery'), '1.0.0', true);

    // Localize script for AJAX
    wp_localize_script('lovemyfluffy-script', 'lovemyfluffy_ajax', array(
        'ajax_url' => admin_url('admin-ajax.php'),
        'nonce' => wp_create_nonce('lovemyfluffy_nonce')
    ));
}
add_action('wp_enqueue_scripts', 'lovemyfluffy_scripts');

/**
 * Register widget areas
 */
function lovemyfluffy_widgets_init() {
    register_sidebar(array(
        'name'          => __('Sidebar', 'lovemyfluffy'),
        'id'            => 'sidebar-1',
        'description'   => __('Add widgets here.', 'lovemyfluffy'),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget'  => '</section>',
        'before_title'  => '<h2 class="widget-title">',
        'after_title'   => '</h2>',
    ));

    register_sidebar(array(
        'name'          => __('Footer Column 1', 'lovemyfluffy'),
        'id'            => 'footer-1',
        'description'   => __('Footer widget area 1.', 'lovemyfluffy'),
        'before_widget' => '<div class="footer-widget">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3>',
        'after_title'   => '</h3>',
    ));

    register_sidebar(array(
        'name'          => __('Footer Column 2', 'lovemyfluffy'),
        'id'            => 'footer-2',
        'description'   => __('Footer widget area 2.', 'lovemyfluffy'),
        'before_widget' => '<div class="footer-widget">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3>',
        'after_title'   => '</h3>',
    ));

    register_sidebar(array(
        'name'          => __('Footer Column 3', 'lovemyfluffy'),
        'id'            => 'footer-3',
        'description'   => __('Footer widget area 3.', 'lovemyfluffy'),
        'before_widget' => '<div class="footer-widget">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3>',
        'after_title'   => '</h3>',
    ));
}
add_action('widgets_init', 'lovemyfluffy_widgets_init');

/**
 * Pet category helper functions
 */
function lovemyfluffy_get_pet_category_class($category_slug) {
    $pet_classes = array(
        'dogs' => 'pet-dogs',
        'cats' => 'pet-cats',
        'birds' => 'pet-birds',
        'fish' => 'pet-fish',
        'small-pets' => 'pet-small-pets'
    );

    return isset($pet_classes[$category_slug]) ? $pet_classes[$category_slug] : 'pet-general';
}

function lovemyfluffy_get_pet_category_badge($category) {
    $category_slug = $category->slug;
    $badge_class = str_replace('-', '-', $category_slug);

    return '<span class="pet-category-badge ' . esc_attr($badge_class) . '">' . esc_html($category->name) . '</span>';
}

/**
 * Customize WooCommerce
 */
function lovemyfluffy_woocommerce_customizations() {
    // Remove default WooCommerce styles
    add_filter('woocommerce_enqueue_styles', '__return_empty_array');

    // Customize product loop
    remove_action('woocommerce_before_shop_loop_item', 'woocommerce_template_loop_product_link_open', 10);
    remove_action('woocommerce_after_shop_loop_item', 'woocommerce_template_loop_product_link_close', 5);

    // Add custom product categories display
    add_action('woocommerce_shop_loop_item_title', 'lovemyfluffy_display_product_categories', 5);
}
add_action('init', 'lovemyfluffy_woocommerce_customizations');

/**
 * Display product categories with pet-themed styling
 */
function lovemyfluffy_display_product_categories() {
    global $product;

    $categories = get_the_terms($product->get_id(), 'product_cat');
    if ($categories && !is_wp_error($categories)) {
        echo '<div class="product-categories">';
        foreach ($categories as $category) {
            echo lovemyfluffy_get_pet_category_badge($category);
        }
        echo '</div>';
    }
}

/**
 * Customize excerpt length
 */
function lovemyfluffy_excerpt_length($length) {
    return 20;
}
add_filter('excerpt_length', 'lovemyfluffy_excerpt_length');

/**
 * Custom breadcrumbs
 */
function lovemyfluffy_breadcrumbs() {
    if (!is_front_page()) {
        echo '<nav class="breadcrumbs">';
        echo '<a href="' . home_url() . '">Home</a> &raquo; ';

        if (is_category() || is_single()) {
            the_category(' &raquo; ');
            if (is_single()) {
                echo ' &raquo; ';
                the_title();
            }
        } elseif (is_page()) {
            echo the_title();
        }

        echo '</nav>';
    }
}

/**
 * Add custom body classes
 */
function lovemyfluffy_body_classes($classes) {
    if (function_exists('is_woocommerce') && (is_woocommerce() || is_cart() || is_checkout())) {
        $classes[] = 'woocommerce-page';
    }

    if (wp_is_mobile()) {
        $classes[] = 'mobile-device';
    }

    return $classes;
}
add_filter('body_class', 'lovemyfluffy_body_classes');

/**
 * Custom post types for testimonials
 */
function lovemyfluffy_register_testimonials() {
    register_post_type('testimonial', array(
        'labels' => array(
            'name' => 'Testimonials',
            'singular_name' => 'Testimonial',
        ),
        'public' => false,
        'show_ui' => true,
        'show_in_menu' => true,
        'supports' => array('title', 'editor', 'thumbnail'),
        'menu_icon' => 'dashicons-format-quote',
    ));
}
add_action('init', 'lovemyfluffy_register_testimonials');

/**
 * AJAX handler for dynamic product loading
 */
function lovemyfluffy_load_more_products() {
    check_ajax_referer('lovemyfluffy_nonce', 'nonce');

    $page = intval($_POST['page']);
    $category = sanitize_text_field($_POST['category']);

    $args = array(
        'post_type' => 'product',
        'posts_per_page' => 8,
        'paged' => $page,
    );

    if ($category && $category !== 'all') {
        $args['tax_query'] = array(
            array(
                'taxonomy' => 'product_cat',
                'field' => 'slug',
                'terms' => $category,
            ),
        );
    }

    $products = new WP_Query($args);

    if ($products->have_posts()) {
        while ($products->have_posts()) {
            $products->the_post();
            wc_get_template_part('content', 'product');
        }
    }

    wp_die();
}
add_action('wp_ajax_lovemyfluffy_load_more_products', 'lovemyfluffy_load_more_products');
add_action('wp_ajax_nopriv_lovemyfluffy_load_more_products', 'lovemyfluffy_load_more_products');

/**
 * Security enhancements (disabled for development)
 */
function lovemyfluffy_security_headers() {
    // Disabled for development - enable for production
    // if (!is_admin()) {
    //     header('X-Content-Type-Options: nosniff');
    //     header('X-Frame-Options: SAMEORIGIN');
    //     header('X-XSS-Protection: 1; mode=block');
    //     header('Referrer-Policy: strict-origin-when-cross-origin');
    //     header('Permissions-Policy: geolocation=(), microphone=(), camera=()');
    // }
}
// add_action('send_headers', 'lovemyfluffy_security_headers');

/**
 * Optimize images
 */
function lovemyfluffy_add_image_sizes() {
    add_image_size('product-thumb', 300, 300, true);
    add_image_size('product-large', 600, 600, true);
    add_image_size('hero-image', 1200, 400, true);
}
add_action('after_setup_theme', 'lovemyfluffy_add_image_sizes');

/**
 * Performance optimizations
 */
function lovemyfluffy_disable_emojis() {
    remove_action('wp_head', 'print_emoji_detection_script', 7);
    remove_action('admin_print_scripts', 'print_emoji_detection_script');
    remove_action('wp_print_styles', 'print_emoji_styles');
    remove_action('admin_print_styles', 'print_emoji_styles');
}
add_action('init', 'lovemyfluffy_disable_emojis');

/**
 * Remove unnecessary WordPress features for performance (temporarily disabled for debugging)
 */
function lovemyfluffy_performance_optimizations() {
    // Temporarily disabled for debugging
    // Remove WordPress version from head
    // remove_action('wp_head', 'wp_generator');

    // Remove unnecessary link tags
    // remove_action('wp_head', 'rsd_link');
    // remove_action('wp_head', 'wlwmanifest_link');
    // remove_action('wp_head', 'wp_shortlink_wp_head');

    // Remove feed links (if not needed)
    // remove_action('wp_head', 'feed_links', 2);
    // remove_action('wp_head', 'feed_links_extra', 3);

    // Remove REST API links from head
    // remove_action('wp_head', 'rest_output_link_wp_head');
    // remove_action('wp_head', 'wp_oembed_add_discovery_links');
}
// add_action('init', 'lovemyfluffy_performance_optimizations');

/**
 * Add browser caching headers (disabled for development)
 */
function lovemyfluffy_add_caching_headers() {
    // Disabled for development - enable for production
    // if (!is_admin()) {
    //     $expires = 86400; // 24 hours
    //     header('Cache-Control: public, max-age=' . $expires);
    //     header('Pragma: public');
    //     header('Expires: ' . gmdate('D, d M Y H:i:s', time() + $expires) . ' GMT');
    // }
}
// add_action('send_headers', 'lovemyfluffy_add_caching_headers');

/**
 * Optimize database queries
 */
function lovemyfluffy_optimize_queries() {
    // Remove unnecessary meta queries
    remove_action('wp_head', 'adjacent_posts_rel_link_wp_head', 10);

    // Limit post revisions
    if (!defined('WP_POST_REVISIONS')) {
        define('WP_POST_REVISIONS', 3);
    }
}
add_action('init', 'lovemyfluffy_optimize_queries');

/**
 * Fallback menu for when no menu is assigned
 */
function lovemyfluffy_fallback_menu() {
    echo '<ul class="nav-menu">';
    echo '<li><a href="' . home_url() . '">Home</a></li>';

    if (class_exists('WooCommerce') && function_exists('wc_get_page_id')) {
        echo '<li><a href="' . get_permalink(wc_get_page_id('shop')) . '">Shop</a></li>';

        // Pet categories
        $categories = get_terms(array(
            'taxonomy' => 'product_cat',
            'hide_empty' => false,
        ));

        if ($categories && !is_wp_error($categories)) {
            foreach ($categories as $category) {
                $category_link = get_term_link($category);
                if (!is_wp_error($category_link)) {
                    echo '<li><a href="' . esc_url($category_link) . '">' . esc_html($category->name) . '</a></li>';
                }
            }
        }

        if (function_exists('wc_get_cart_url')) {
            echo '<li><a href="' . wc_get_cart_url() . '">Cart</a></li>';
        }
        if (function_exists('wc_get_page_id')) {
            echo '<li><a href="' . get_permalink(wc_get_page_id('checkout')) . '">Checkout</a></li>';
        }
    }

    echo '<li><a href="' . get_permalink(get_page_by_path('about')) . '">About</a></li>';
    echo '<li><a href="' . get_permalink(get_page_by_path('contact')) . '">Contact</a></li>';
    echo '</ul>';
}

/**
 * Include sample products functionality
 */
include_once get_template_directory() . '/sample-products.php';

/**
 * Create test dog product for cart functionality
 */
add_action('woocommerce_init', 'create_test_dog_product_once');

function create_test_dog_product_once() {
    // Check if we've already created the test product
    if (get_option('test_dog_product_created')) {
        return;
    }

    // Check if WooCommerce is active and classes are available
    if (!class_exists('WooCommerce') || !class_exists('WC_Product_Simple')) {
        return;
    }

    try {
        // Create a new product
        $product = new WC_Product_Simple();

    // Set product data
    $product->set_name('Premium Dog Food - Chicken & Rice');
    $product->set_slug('premium-dog-food-chicken-rice');
    $product->set_regular_price('29.99');
    $product->set_sale_price('24.99');
    $product->set_description('High-quality premium dog food made with real chicken and brown rice. Perfect for adult dogs of all sizes. Rich in protein and essential nutrients for healthy growth and energy.');
    $product->set_short_description('Premium dog food with real chicken and brown rice for adult dogs.');
    $product->set_sku('DOG-FOOD-001');
    $product->set_manage_stock(true);
    $product->set_stock_quantity(100);
    $product->set_stock_status('instock');
    $product->set_catalog_visibility('visible');
    $product->set_featured(true);
    $product->set_virtual(false);
    $product->set_downloadable(false);
    $product->set_sold_individually(false);
    $product->set_weight('5'); // 5 lbs
    $product->set_length('10');
    $product->set_width('6');
    $product->set_height('4');

    // Set product status
    $product->set_status('publish');

    // Save the product
    $product_id = $product->save();

    if ($product_id) {
        // Get the Dogs category
        $dogs_category = get_term_by('name', 'Dogs', 'product_cat');

        if ($dogs_category) {
            // Assign to Dogs category
            wp_set_object_terms($product_id, array($dogs_category->term_id), 'product_cat');
        }

        // Add some product tags
        wp_set_object_terms($product_id, array('premium', 'chicken', 'rice', 'adult-dogs'), 'product_tag');

        // Enable reviews
        update_post_meta($product_id, '_reviews_allowed', 'yes');

        // Mark as created so we don't create it again
        update_option('test_dog_product_created', true);
        update_option('test_dog_product_id', $product_id);
    }
    } catch (Exception $e) {
        // Silently fail if WooCommerce isn't ready
        return;
    }
}

/**
 * Configure existing dog product for cart functionality
 */
add_action('woocommerce_init', 'configure_existing_dog_product_once');

function configure_existing_dog_product_once() {
    // Check if we've already configured the existing product
    if (get_option('dog_product_configured')) {
        return;
    }

    // Check if WooCommerce is active
    if (!class_exists('WooCommerce') || !function_exists('wc_get_product')) {
        return;
    }

    try {
        // Find the Premium Dog Food product
        $product_post = get_page_by_title('Premium Dog Food - Chicken & Rice', OBJECT, 'product');

        if ($product_post) {
            // Get the WooCommerce product object
            $product = wc_get_product($product_post->ID);

            if ($product) {
            // Configure the product for cart functionality
            $product->set_regular_price('29.99');
            $product->set_sale_price('24.99');
            $product->set_manage_stock(true);
            $product->set_stock_quantity(100);
            $product->set_stock_status('instock');
            $product->set_catalog_visibility('visible');
            $product->set_featured(true);
            $product->set_virtual(false);
            $product->set_downloadable(false);
            $product->set_sold_individually(false);
            $product->set_status('publish');

            // Update description
            $product->set_description('High-quality premium dog food made with real chicken and brown rice. Perfect for adult dogs of all sizes. Rich in protein and essential nutrients for healthy growth and energy. Now available for purchase!');
            $product->set_short_description('Premium dog food with real chicken and brown rice for adult dogs. Special sale price!');

            // Save the product
            $product->save();

            // Mark as configured
            update_option('dog_product_configured', true);
        }
    }
    } catch (Exception $e) {
        // Silently fail if WooCommerce isn't ready
        return;
    }
}