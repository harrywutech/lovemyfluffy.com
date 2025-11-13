<?php
defined( 'ABSPATH' ) || exit;

class WC_Install {

    public static function install() {
        if ( ! is_blog_installed() ) {
            return;
        }

        // Check if we are not already running this routine.
        if ( get_transient( 'wc_installing' ) === 'yes' ) {
            return;
        }

        // If we made it till here nothing is running yet, lets set the transient now.
        set_transient( 'wc_installing', 'yes', MINUTE_IN_SECONDS * 10 );

        self::create_tables();
        self::create_pages();
        self::create_terms();
        self::create_options();

        // Flush rules after install.
        flush_rewrite_rules();

        delete_transient( 'wc_installing' );

        do_action( 'woocommerce_installed' );
    }

    private static function create_tables() {
        // Demo - no additional tables needed for basic functionality
    }

    private static function create_pages() {
        $pages = array(
            'shop' => array(
                'name' => 'shop',
                'title' => 'Shop',
                'content' => '[woocommerce_shop]',
            ),
            'cart' => array(
                'name' => 'cart',
                'title' => 'Cart',
                'content' => 'Your shopping cart',
            ),
            'checkout' => array(
                'name' => 'checkout',
                'title' => 'Checkout',
                'content' => 'Checkout page',
            ),
            'myaccount' => array(
                'name' => 'my-account',
                'title' => 'My account',
                'content' => 'My account page',
            ),
        );

        foreach ( $pages as $key => $page ) {
            if ( ! get_page_by_path( $page['name'] ) ) {
                $page_data = array(
                    'post_status' => 'publish',
                    'post_type' => 'page',
                    'post_author' => 1,
                    'post_name' => $page['name'],
                    'post_title' => $page['title'],
                    'post_content' => $page['content'],
                    'comment_status' => 'closed',
                );
                $page_id = wp_insert_post( $page_data );
                update_option( 'woocommerce_' . $key . '_page_id', $page_id );
            }
        }
    }

    private static function create_terms() {
        $categories = array(
            'Dogs' => 'Products for dogs including food, toys, accessories',
            'Cats' => 'Products for cats including food, toys, accessories',
            'Birds' => 'Products for birds including food, cages, accessories',
            'Fish' => 'Products for fish including food, tanks, accessories',
            'Small Pets' => 'Products for small pets including hamsters, rabbits, guinea pigs'
        );

        foreach ( $categories as $name => $description ) {
            if ( ! term_exists( $name, 'product_cat' ) ) {
                wp_insert_term( $name, 'product_cat', array(
                    'description' => $description,
                    'slug' => sanitize_title( $name ),
                ));
            }
        }
    }

    private static function create_options() {
        $options = array(
            'woocommerce_store_address' => '',
            'woocommerce_store_city' => '',
            'woocommerce_default_country' => 'US',
            'woocommerce_store_postcode' => '',
            'woocommerce_currency' => 'USD',
            'woocommerce_product_type' => 'both',
            'woocommerce_allow_tracking' => 'no',
            'woocommerce_enable_checkout_login_reminder' => 'no',
            'woocommerce_enable_signup_and_login_from_checkout' => 'no',
            'woocommerce_enable_myaccount_registration' => 'no',
            'woocommerce_registration_generate_username' => 'yes',
            'woocommerce_registration_generate_password' => 'yes',
        );

        foreach ( $options as $option_name => $option_value ) {
            if ( get_option( $option_name, null ) === null ) {
                update_option( $option_name, $option_value );
            }
        }
    }
}