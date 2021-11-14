<?php
/**
 * Plugin Name:       Buy Now for Woocommerce
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

        add_action( 'plugins_loaded', [ $this, 'load_plugin_textdomain' ] );
        add_action( 'plugins_loaded', [ $this, 'init_plugin' ] );
        add_filter( 'body_class', [ $this, 'body_classes' ] );
        add_action( 'wp_loaded', [ $this, 'single_button_handler' ] );
        add_action( 'template_redirect', [ $this, 'card_button_handler' ] );

        $this->define_constants();
        $this->includes();

    }

    /**
     * Load buy-now-button textdomain.
     */
    public function load_plugin_textdomain() {
        load_plugin_textdomain( 'bnbf-woocommerce', false, dirname( plugin_basename( __FILE__ ) ) . '/languages');
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

        $enable_single = BNBF_Controller::get_options( 'single' ) && ( BNBF_Controller::get_options( 'single_position' ) === 'replace_single' ) ? true : false;
        $enable_card   = BNBF_Controller::get_options( 'all' ) && ( BNBF_Controller::get_options( 'card_position' ) === 'replace_card' ) ? true : false;

		if ( $enable_single ) {
			$classes[] = 'bnbf_woocommerce_single_product bnbf_woocommerce_single_product_hide_buy_now';
		} else {
			$classes[] = 'bnbf_woocommerce_single_product';
        }

		if ( $enable_card ) {
			$classes[] = 'bnbf_woocommerce_card_product bnbf_woocommerce_card_product_hide_buy_now';
		} else {
			$classes[] = 'bnbf_woocommerce_card_product';
        }

		return $classes;
	}

    function single_button_handler() {

        if ( ! isset( $_REQUEST['bnbf_woocommerce_single_product'] ) ) {
            return false;
        }

        if ( BNBF_Controller::get_options( 'reset_cart' ) ) {
            WC()->cart->empty_cart();
        }

        $product_id = absint( $_REQUEST['bnbf_woocommerce_single_product'] );
        $quantity   = absint( $_REQUEST['quantity'] );

        if ( isset( $_REQUEST['variation_id'] ) ) {

            $variation_id = absint( $_REQUEST['variation_id'] );
            WC()->cart->add_to_cart( $product_id, $quantity, $variation_id );

            
        } else {
            WC()->cart->add_to_cart( $product_id, $quantity );
        }

        wp_safe_redirect( wc_get_checkout_url() );
        exit;
    }

    public function card_button_handler() {

		global $wp;

		if ( $wp->request != 'buy-now' ) {
			return;
		}

		$id = isset( $_GET['id'] ) ? $_GET['id'] : '';

		if ( BNBF_Controller::get_options( 'reset_cart' ) ) {
            WC()->cart->empty_cart();
        }

		WC()->cart->add_to_cart( $id, 1 );

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