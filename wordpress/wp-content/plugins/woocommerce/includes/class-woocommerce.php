<?php
defined( 'ABSPATH' ) || exit;

final class WooCommerce {

    public $version = '9.4.1';

    protected static $_instance = null;

    public static function instance() {
        if ( is_null( self::$_instance ) ) {
            self::$_instance = new self();
        }
        return self::$_instance;
    }

    public function __construct() {
        $this->define_constants();
        $this->includes();
        $this->init_hooks();
    }

    private function define_constants() {
        $this->define( 'WC_ABSPATH', dirname( WC_PLUGIN_FILE ) . '/' );
        $this->define( 'WC_PLUGIN_BASENAME', plugin_basename( WC_PLUGIN_FILE ) );
        $this->define( 'WC_VERSION', $this->version );
    }

    private function define( $name, $value ) {
        if ( ! defined( $name ) ) {
            define( $name, $value );
        }
    }

    public function includes() {
        include_once WC_ABSPATH . 'includes/class-wc-install.php';
    }

    private function init_hooks() {
        add_action( 'plugins_loaded', array( $this, 'init' ), 0 );
    }

    public function init() {
        // Initialize WooCommerce
        do_action( 'woocommerce_init' );
    }

    public function plugin_url() {
        return untrailingslashit( plugins_url( '/', WC_PLUGIN_FILE ) );
    }

    public function plugin_path() {
        return untrailingslashit( plugin_dir_path( WC_PLUGIN_FILE ) );
    }
}