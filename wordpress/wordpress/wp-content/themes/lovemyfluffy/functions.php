<?php
/**
 * LoveMyFluffy Theme Functions
 *
 * @package LoveMyFluffy
 * @version 1.0.0
 */

// Prevent direct access
if (!defined('ABSPATH')) {
    exit;
}

/**
 * LoveMyFluffy Theme Setup
 */
function lovemyfluffy_setup() {
    // Add theme support
    add_theme_support('post-thumbnails');
    add_theme_support('woocommerce');
    add_theme_support('wc-product-gallery-zoom');
    add_theme_support('wc-product-gallery-lightbox');
    add_theme_support('wc-product-gallery-slider');
    add_theme_support('custom-logo');
    add_theme_support('title-tag');
    add_theme_support('html5', array(
        'search-form',
        'comment-form',
        'comment-list',
        'gallery',
        'caption',
    ));

    // Register navigation menus
    register_nav_menus(array(
        'primary' => __('Primary Menu', 'lovemyfluffy'),
        'footer' => __('Footer Menu', 'lovemyfluffy'),
    ));

    // Set content width
    global $content_width;
    if (!isset($content_width)) {
        $content_width = 1200;
    }
}
add_action('after_setup_theme', 'lovemyfluffy_setup');

/**
 * Enqueue scripts and styles
 */
function lovemyfluffy_scripts() {
    // Theme stylesheet
    wp_enqueue_style('lovemyfluffy-style', get_stylesheet_uri(), array(), '1.0.0');

    // Custom JavaScript (if needed)
    wp_enqueue_script('lovemyfluffy-script', get_template_directory_uri() . '/assets/js/custom.js', array('jquery'), '1.0.0', true);

    // Font Awesome for icons
    wp_enqueue_style('font-awesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css', array(), '6.4.0');
}
add_action('wp_enqueue_scripts', 'lovemyfluffy_scripts');

/**
 * Register widget areas
 */
function lovemyfluffy_widgets_init() {
    register_sidebar(array(
        'name'          => __('Shop Sidebar', 'lovemyfluffy'),
        'id'            => 'shop-sidebar',
        'description'   => __('Add widgets here to appear in the shop sidebar.', 'lovemyfluffy'),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget'  => '</section>',
        'before_title'  => '<h3 class="widget-title">',
        'after_title'   => '</h3>',
    ));

    register_sidebar(array(
        'name'          => __('Footer Widget Area', 'lovemyfluffy'),
        'id'            => 'footer-widgets',
        'description'   => __('Add widgets here to appear in the footer.', 'lovemyfluffy'),
        'before_widget' => '<div id="%1$s" class="footer-widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3 class="footer-widget-title">',
        'after_title'   => '</h3>',
    ));
}
add_action('widgets_init', 'lovemyfluffy_widgets_init');

/**
 * WooCommerce customizations
 */

// Change number of products per row
function lovemyfluffy_loop_columns() {
    return 3;
}
add_filter('loop_shop_columns', 'lovemyfluffy_loop_columns');

// Change number of products per page
function lovemyfluffy_products_per_page() {
    return 12;
}
add_filter('loop_shop_per_page', 'lovemyfluffy_products_per_page');

/**
 * Pet-specific customizations
 */

// Add pet category icons
function lovemyfluffy_add_category_icons($category_name) {
    $icons = array(
        'dogs' => 'fas fa-dog',
        'cats' => 'fas fa-cat',
        'birds' => 'fas fa-dove',
        'fish' => 'fas fa-fish',
        'small-pets' => 'fas fa-hamster',
    );

    $slug = sanitize_title($category_name);
    return isset($icons[$slug]) ? '<i class="' . $icons[$slug] . '"></i> ' : '';
}

// Custom product attributes for pets
function lovemyfluffy_add_pet_attributes() {
    // Pet size attribute
    if (!wc_get_attribute_taxonomy_name('pet_size')) {
        wc_create_attribute(array(
            'name' => 'Pet Size',
            'slug' => 'pet_size',
            'type' => 'select',
            'order_by' => 'menu_order',
            'has_archives' => true,
        ));
    }

    // Pet age group attribute
    if (!wc_get_attribute_taxonomy_name('pet_age_group')) {
        wc_create_attribute(array(
            'name' => 'Pet Age Group',
            'slug' => 'pet_age_group',
            'type' => 'select',
            'order_by' => 'menu_order',
            'has_archives' => true,
        ));
    }

    // Pet species attribute
    if (!wc_get_attribute_taxonomy_name('pet_species')) {
        wc_create_attribute(array(
            'name' => 'Pet Species',
            'slug' => 'pet_species',
            'type' => 'select',
            'order_by' => 'menu_order',
            'has_archives' => true,
        ));
    }
}
add_action('init', 'lovemyfluffy_add_pet_attributes');

/**
 * SEO and Schema.org enhancements for Yoast
 */

// Add custom schema for pet products
function lovemyfluffy_add_pet_product_schema($schema) {
    if (is_product()) {
        global $product;
        $schema['@type'] = 'Product';
        $schema['category'] = 'Pet Supplies';

        // Add pet-specific properties
        $pet_size = get_post_meta(get_the_ID(), '_pet_size', true);
        if ($pet_size) {
            $schema['size'] = $pet_size;
        }

        $pet_species = get_post_meta(get_the_ID(), '_pet_species', true);
        if ($pet_species) {
            $schema['audience'] = array(
                '@type' => 'PetOwner',
                'petType' => $pet_species
            );
        }
    }
    return $schema;
}
add_filter('wpseo_schema_product', 'lovemyfluffy_add_pet_product_schema');

/**
 * Custom post types and taxonomies
 */

// Register pet care tips post type
function lovemyfluffy_register_pet_tips() {
    register_post_type('pet_tips', array(
        'labels' => array(
            'name' => 'Pet Care Tips',
            'singular_name' => 'Pet Care Tip',
            'add_new' => 'Add New Tip',
            'add_new_item' => 'Add New Pet Care Tip',
            'edit_item' => 'Edit Pet Care Tip',
            'new_item' => 'New Pet Care Tip',
            'view_item' => 'View Pet Care Tip',
            'search_items' => 'Search Pet Care Tips',
            'not_found' => 'No pet care tips found',
            'not_found_in_trash' => 'No pet care tips found in trash',
        ),
        'public' => true,
        'has_archive' => true,
        'menu_position' => 5,
        'menu_icon' => 'dashicons-heart',
        'supports' => array('title', 'editor', 'thumbnail', 'excerpt', 'author', 'comments'),
        'rewrite' => array('slug' => 'pet-tips'),
    ));
}
add_action('init', 'lovemyfluffy_register_pet_tips');

/**
 * Security enhancements
 */

// Remove WordPress version from head
remove_action('wp_head', 'wp_generator');

// Disable XML-RPC
add_filter('xmlrpc_enabled', '__return_false');

// Remove Windows Live Writer manifest link
remove_action('wp_head', 'wlwmanifest_link');

// Remove RSD link
remove_action('wp_head', 'rsd_link');

/**
 * Performance optimizations
 */

// Remove unnecessary scripts and styles
function lovemyfluffy_dequeue_scripts() {
    if (!is_admin()) {
        // Remove jQuery migrate
        wp_deregister_script('jquery');
        wp_register_script('jquery', includes_url('/js/jquery/jquery.js'), false, NULL);
        wp_enqueue_script('jquery');
    }
}
add_action('wp_enqueue_scripts', 'lovemyfluffy_dequeue_scripts');

// Optimize WordPress heartbeat
function lovemyfluffy_heartbeat_settings($settings) {
    $settings['interval'] = 60; // 60 seconds
    return $settings;
}
add_filter('heartbeat_settings', 'lovemyfluffy_heartbeat_settings');

/**
 * Custom functions for pet e-commerce
 */

// Get featured pet categories
function lovemyfluffy_get_featured_categories($limit = 5) {
    $categories = get_terms(array(
        'taxonomy' => 'product_cat',
        'hide_empty' => true,
        'number' => $limit,
        'meta_query' => array(
            array(
                'key' => 'featured',
                'value' => 'yes',
                'compare' => '='
            )
        )
    ));

    return $categories;
}

// Check if product is suitable for specific pet
function lovemyfluffy_is_product_for_pet($product_id, $pet_type) {
    $product_categories = wp_get_post_terms($product_id, 'product_cat', array('fields' => 'slugs'));
    return in_array(strtolower($pet_type), $product_categories);
}

/**
 * AJAX handlers for enhanced user experience
 */

// Quick view functionality
function lovemyfluffy_product_quick_view() {
    if (isset($_POST['product_id'])) {
        $product_id = intval($_POST['product_id']);
        $product = wc_get_product($product_id);

        if ($product) {
            // Return product data as JSON
            wp_send_json_success(array(
                'title' => $product->get_name(),
                'price' => $product->get_price_html(),
                'description' => $product->get_short_description(),
                'image' => wp_get_attachment_image_url($product->get_image_id(), 'medium'),
                'add_to_cart_url' => $product->add_to_cart_url(),
            ));
        }
    }
    wp_die();
}
add_action('wp_ajax_lovemyfluffy_quick_view', 'lovemyfluffy_product_quick_view');
add_action('wp_ajax_nopriv_lovemyfluffy_quick_view', 'lovemyfluffy_product_quick_view');

/**
 * Theme customizer options
 */
function lovemyfluffy_customize_register($wp_customize) {
    // Pet theme colors
    $wp_customize->add_section('lovemyfluffy_colors', array(
        'title' => __('Pet Theme Colors', 'lovemyfluffy'),
        'priority' => 30,
    ));

    $wp_customize->add_setting('primary_color', array(
        'default' => '#e74c3c',
        'sanitize_callback' => 'sanitize_hex_color',
    ));

    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'primary_color', array(
        'label' => __('Primary Color', 'lovemyfluffy'),
        'section' => 'lovemyfluffy_colors',
        'settings' => 'primary_color',
    )));
}
add_action('customize_register', 'lovemyfluffy_customize_register');

/**
 * Cleanup and maintenance functions
 */

// Clean up WordPress database
function lovemyfluffy_cleanup_database() {
    global $wpdb;

    // Clean up spam comments
    $wpdb->delete($wpdb->comments, array('comment_approved' => 'spam'));

    // Clean up orphaned postmeta
    $wpdb->query("DELETE pm FROM {$wpdb->postmeta} pm LEFT JOIN {$wpdb->posts} wp ON wp.ID = pm.post_id WHERE wp.ID IS NULL");

    // Clean up orphaned term relationships
    $wpdb->query("DELETE tr FROM {$wpdb->term_relationships} tr LEFT JOIN {$wpdb->posts} wp ON wp.ID = tr.object_id WHERE wp.ID IS NULL");
}

// Schedule weekly cleanup
if (!wp_next_scheduled('lovemyfluffy_weekly_cleanup')) {
    wp_schedule_event(time(), 'weekly', 'lovemyfluffy_weekly_cleanup');
}
add_action('lovemyfluffy_weekly_cleanup', 'lovemyfluffy_cleanup_database');