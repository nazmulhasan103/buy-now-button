<?php
/**
 * Plugin Name:       Buy Now Button - Woocommerce
 * Plugin URI:        https://github.com/themeaazz/buy-now-button
 * Description:       Buy now button of woocommerce.
 * Version:           1.0
 * Requires at least: 5.2
 * Requires PHP:      7.2
 * Author:            Nazmul Hasan
 * Author URI:        https://github.com/themeaazz
 * Text Domain:       buy-now-button
 * Domain Path:       /languages
 */

use BNBF_Woocommerce\BNBF_Controller;

if ( ! defined( 'ABSPATH' ) ) {
    return;
}

/**
 * The main plugin class.
 */
final class BNBF_Woocommerce {

    const version = '1.0';

    /**
     * Class constructor.
     */
    private function __construct() {

        $this->define_constants();
        $this->includes();

        add_action( 'plugins_loaded', [ $this, 'load_plugin_textdomain' ] );
        add_action( 'plugins_loaded', [ $this, 'init_plugin' ] );
        add_filter( 'body_class', array( $this, 'body_classes' ) );

        add_action( 'wp_loaded', [ $this, 'bnbf_handle_single' ] );
    }

    /**
     * Load buy-now-button textdomain.
     */
    public function load_plugin_textdomain() {
        load_plugin_textdomain( 'buy-now-button', false, dirname( plugin_basename( __FILE__ ) ) . '/languages');
    }

    /**
     * Initializes a singleton instance.
     *
     * @return \BNBF_Woocommerce classes.
     */
    public static function init() {
        static $instance = false;

        if ( ! $instance ) {
            $instance = new self();
        }

        return $instance;
    }

    /**
     * Pre defined constance.
     */
    public function define_constants() {
        define( 'BNBF_Woocommerce_VERSION', self::version );
        define( 'BNBF_Woocommerce_FILE', __FILE__ );
        define( 'BNBF_Woocommerce_PATH', __DIR__ );
        define( 'BNBF_Woocommerce_URL', plugins_url( '', BNBF_Woocommerce_FILE ) );
        define( 'BNBF_Woocommerce_ASSETS', BNBF_Woocommerce_URL . '/assets' );
    }
    
    /**
     * Included files.
     */
    public function includes() {
        require_once __DIR__ . '/includes/assets.php';
        require_once __DIR__ . '/includes/controller.php';
        require_once __DIR__ . '/includes/menu.php';
    }

    /**
     * Initializes the plugin.
     *
     * @param void
     */
    public function init_plugin() {
        
        new BNBF_Woocommerce\Assets;
        new BNBF_Woocommerce\BNBF_Controller;
        
        if ( is_admin() ) {
            new BNBF_Woocommerce\Menu;
        }
    }

    public function body_classes( $classes ) {

        $classes = '';

		if ( BNBF_Controller::get_options( 'single' ) && ( BNBF_Controller::get_options( 'single_position' ) === 'replace_single' ) ) {
			$classes .= 'bnbf_woocommerce_single_product bnbf_woocommerce_single_product_hide_buy_now ';
		} else {
			$classes .= 'bnbf_woocommerce_single_product ';
        }

		if ( BNBF_Controller::get_options( 'all' ) && ( BNBF_Controller::get_options( 'card_position' ) === 'replace_card' ) ) {
			$classes .= 'bnbf_woocommerce_card_product bnbf_woocommerce_card_product_hide_buy_now ';
		} else {
			$classes .= 'bnbf_woocommerce_card_product ';
        }

		return $classes;
	}

    function bnbf_handle_single() {

        if ( !isset( $_REQUEST['sbw-wc-buy-now'] ) ) {
            return false;
        }

        WC()->cart->empty_cart();

        $product_id = absint( $_REQUEST['sbw-wc-buy-now'] );
        $quantity = absint( $_REQUEST['quantity'] );

        WC()->cart->add_to_cart( $product_id, $quantity );

        wp_safe_redirect( wc_get_checkout_url() );
        exit;
    }
}

/**
 * Initializes the main plugin.
 * @return \BNBF_Woocommerce
 */
function Woocommerce_BNBF_Woocommerce() {
    return BNBF_Woocommerce::init();
}

//Kick off the plugin.
Woocommerce_BNBF_Woocommerce();