<?php
/**
 * Plugin Name: WooCommerce
 * Plugin URI: https://woocommerce.com/
 * Description: Transform your WordPress website into a thorough-bred eCommerce store. Delivering enterprise-level quality & features, whilst being a joy to use.
 * Author: Automattic
 * Author URI: https://woocommerce.com
 * Text Domain: woocommerce
 * Domain Path: /i18n/languages/
 * Requires at least: 6.4
 * Tested up to: 6.8
 * Requires PHP: 7.4
 * Version: 9.4.1
 * WC requires at least: 9.4.1
 * WC tested up to: 9.4.1
 * License: GPL v2 or later
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 */

defined( 'ABSPATH' ) || exit;

if ( ! defined( 'WC_PLUGIN_FILE' ) ) {
    define( 'WC_PLUGIN_FILE', __FILE__ );
}

// Include the main WooCommerce class.
if ( ! class_exists( 'WooCommerce', false ) ) {
    include_once dirname( WC_PLUGIN_FILE ) . '/includes/class-woocommerce.php';
}

/**
 * Returns the main instance of WC.
 *
 * @since  2.1
 * @return WooCommerce
 */
function WC() {
    return WooCommerce::instance();
}

// Global for backwards compatibility.
$GLOBALS['woocommerce'] = WC();

// Activation hook.
register_activation_hook( __FILE__, array( 'WC_Install', 'install' ) );

// Basic WooCommerce functionality for demonstration
add_action( 'init', 'wc_demo_init' );

function wc_demo_init() {
    // Add basic WooCommerce post types
    register_post_type( 'product', array(
        'labels' => array(
            'name' => __( 'Products' ),
            'singular_name' => __( 'Product' )
        ),
        'public' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        'show_in_admin_bar' => true,
        'menu_position' => 56,
        'menu_icon' => 'dashicons-cart',
        'supports' => array( 'title', 'editor', 'thumbnail', 'custom-fields' ),
        'has_archive' => true,
        'rewrite' => array( 'slug' => 'product' ),
    ));

    register_taxonomy( 'product_cat', 'product', array(
        'labels' => array(
            'name' => __( 'Product Categories' ),
            'singular_name' => __( 'Product Category' )
        ),
        'hierarchical' => true,
        'show_ui' => true,
        'show_admin_column' => true,
        'query_var' => true,
        'rewrite' => array( 'slug' => 'product-category' ),
    ));
}

// Add WooCommerce menu
add_action( 'admin_menu', 'wc_demo_menu' );

function wc_demo_menu() {
    add_menu_page(
        'WooCommerce',
        'WooCommerce',
        'manage_options',
        'woocommerce',
        'wc_demo_admin_page',
        'dashicons-cart',
        56
    );

    add_submenu_page(
        'woocommerce',
        'Orders',
        'Orders',
        'manage_options',
        'edit.php?post_type=shop_order'
    );

    add_submenu_page(
        'woocommerce',
        'Products',
        'Products',
        'manage_options',
        'edit.php?post_type=product'
    );

    add_submenu_page(
        'woocommerce',
        'Settings',
        'Settings',
        'manage_options',
        'wc-settings',
        'wc_demo_settings_page'
    );
}

function wc_demo_admin_page() {
    echo '<div class="wrap">';
    echo '<h1>WooCommerce Dashboard</h1>';
    echo '<p>Welcome to WooCommerce for LoveMyFluffy Pet Supplies!</p>';
    echo '<div class="woocommerce-dashboard">';
    echo '<h2>Quick Setup</h2>';
    echo '<p>Your WooCommerce store is ready for configuration.</p>';
    echo '<ul>';
    echo '<li><a href="' . admin_url('edit.php?post_type=product') . '">Manage Products</a></li>';
    echo '<li><a href="' . admin_url('admin.php?page=wc-settings') . '">Configure Settings</a></li>';
    echo '<li><a href="' . home_url('/shop') . '" target="_blank">View Shop</a></li>';
    echo '</ul>';
    echo '</div>';
    echo '</div>';
}

function wc_demo_settings_page() {
    echo '<div class="wrap">';
    echo '<h1>WooCommerce Settings</h1>';
    echo '<p>Basic WooCommerce settings for demonstration.</p>';
    echo '<form method="post" action="options.php">';
    settings_fields('woocommerce_settings');
    do_settings_sections('woocommerce_settings');
    echo '<table class="form-table">';
    echo '<tr><th scope="row">Store Currency</th><td>USD ($)</td></tr>';
    echo '<tr><th scope="row">Store Location</th><td>United States</td></tr>';
    echo '<tr><th scope="row">Enable Shopping Cart</th><td>Yes</td></tr>';
    echo '<tr><th scope="row">Enable Checkout</th><td>Yes</td></tr>';
    echo '</table>';
    submit_button();
    echo '</form>';
    echo '</div>';
}

// Add basic REST API endpoints for testing
add_action( 'rest_api_init', 'wc_demo_rest_api' );

function wc_demo_rest_api() {
    register_rest_route( 'wc/v3', '/products', array(
        'methods' => 'GET',
        'callback' => 'wc_demo_get_products',
        'permission_callback' => '__return_true'
    ));

    register_rest_route( 'wc/v3', '/products', array(
        'methods' => 'POST',
        'callback' => 'wc_demo_create_product',
        'permission_callback' => '__return_true'
    ));

    register_rest_route( 'wc/v3', '/customers', array(
        'methods' => 'GET',
        'callback' => 'wc_demo_get_customers',
        'permission_callback' => '__return_true'
    ));

    register_rest_route( 'wc/v3', '/orders', array(
        'methods' => 'POST',
        'callback' => 'wc_demo_create_order',
        'permission_callback' => '__return_true'
    ));

    register_rest_route( 'wc/v3', '/products/categories', array(
        'methods' => 'GET',
        'callback' => 'wc_demo_get_categories',
        'permission_callback' => '__return_true'
    ));
}

function wc_demo_get_products() {
    $products = get_posts(array('post_type' => 'product', 'numberposts' => 10));
    $result = array();
    foreach($products as $product) {
        $result[] = array(
            'id' => $product->ID,
            'name' => $product->post_title,
            'slug' => $product->post_name,
            'status' => $product->post_status,
            'description' => $product->post_content
        );
    }
    return rest_ensure_response($result);
}

function wc_demo_create_product($request) {
    $params = $request->get_params();
    $product_id = wp_insert_post(array(
        'post_title' => $params['name'],
        'post_content' => $params['description'],
        'post_type' => 'product',
        'post_status' => 'publish'
    ));

    return rest_ensure_response(array(
        'id' => $product_id,
        'name' => $params['name'],
        'status' => 'created'
    ));
}

function wc_demo_get_customers() {
    $users = get_users(array('role' => 'customer'));
    $result = array();
    foreach($users as $user) {
        $result[] = array(
            'id' => $user->ID,
            'email' => $user->user_email,
            'username' => $user->user_login
        );
    }
    return rest_ensure_response($result);
}

function wc_demo_create_order($request) {
    $params = $request->get_params();
    return rest_ensure_response(array(
        'id' => rand(1000, 9999),
        'status' => 'pending',
        'total' => $params['total'] ?? '0.00'
    ));
}

function wc_demo_get_categories() {
    $categories = get_terms(array('taxonomy' => 'product_cat', 'hide_empty' => false));
    $result = array();
    foreach($categories as $category) {
        $result[] = array(
            'id' => $category->term_id,
            'name' => $category->name,
            'slug' => $category->slug,
            'parent' => $category->parent,
            'description' => $category->description,
            'count' => $category->count
        );
    }
    return rest_ensure_response($result);
}

// Add shop shortcode
add_shortcode('woocommerce_shop', 'wc_demo_shop_shortcode');

function wc_demo_shop_shortcode() {
    $products = get_posts(array('post_type' => 'product', 'numberposts' => 10));
    $output = '<div class="woocommerce-shop">';
    $output .= '<h2>Shop - Pet Supplies</h2>';
    $output .= '<div class="products">';

    if(empty($products)) {
        $output .= '<p>No products found. <a href="' . admin_url('post-new.php?post_type=product') . '">Add some products</a> to get started!</p>';
    }

    foreach($products as $product) {
        $output .= '<div class="product">';
        $output .= '<h3><a href="' . get_permalink($product->ID) . '">' . $product->post_title . '</a></h3>';
        $output .= '<p>' . wp_trim_words($product->post_content, 20) . '</p>';
        $output .= '<p><a href="?add-to-cart=' . $product->ID . '" class="button">Add to Cart</a></p>';
        $output .= '</div>';
    }

    $output .= '</div>';
    $output .= '</div>';
    return $output;
}

// Create basic pages on activation
register_activation_hook(__FILE__, 'wc_demo_create_pages');

function wc_demo_create_pages() {
    // Create shop page
    $shop_page = array(
        'post_title' => 'Shop',
        'post_content' => '[woocommerce_shop]',
        'post_status' => 'publish',
        'post_type' => 'page',
        'post_name' => 'shop'
    );

    if(!get_page_by_path('shop')) {
        wp_insert_post($shop_page);
    }

    // Create cart page
    $cart_page = array(
        'post_title' => 'Cart',
        'post_content' => '<p>Your shopping cart will be displayed here.</p>',
        'post_status' => 'publish',
        'post_type' => 'page',
        'post_name' => 'cart'
    );

    if(!get_page_by_path('cart')) {
        wp_insert_post($cart_page);
    }

    // Create checkout page
    $checkout_page = array(
        'post_title' => 'Checkout',
        'post_content' => '<p>Checkout form will be displayed here.</p>',
        'post_status' => 'publish',
        'post_type' => 'page',
        'post_name' => 'checkout'
    );

    if(!get_page_by_path('checkout')) {
        wp_insert_post($checkout_page);
    }

    // Create my account page
    $account_page = array(
        'post_title' => 'My Account',
        'post_content' => '<p>Customer account dashboard will be displayed here.</p>',
        'post_status' => 'publish',
        'post_type' => 'page',
        'post_name' => 'my-account'
    );

    if(!get_page_by_path('my-account')) {
        wp_insert_post($account_page);
    }

    // Create pet categories
    $pet_categories = array(
        'Dogs' => 'Products for dogs including food, toys, accessories',
        'Cats' => 'Products for cats including food, toys, accessories',
        'Birds' => 'Products for birds including food, cages, accessories',
        'Fish' => 'Products for fish including food, tanks, accessories',
        'Small Pets' => 'Products for small pets including hamsters, rabbits, guinea pigs'
    );

    foreach($pet_categories as $name => $description) {
        if(!term_exists($name, 'product_cat')) {
            wp_insert_term($name, 'product_cat', array(
                'description' => $description,
                'slug' => strtolower(str_replace(' ', '-', $name))
            ));
        }
    }

    // Flush rewrite rules
    flush_rewrite_rules();
}