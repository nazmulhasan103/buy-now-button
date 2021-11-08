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

use Buy_Now_Button\Option_Controller;

if ( ! defined( 'ABSPATH' ) ) {
    return;
}

/**
 * The main plugin class.
 */
final class Buy_Now_Button {

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
        
        add_action( 'wp_loaded', [ $this, 'sbw_wc_handle_buy_now' ] );
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
     * @return \Buy_Now_Button classes.
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
        define( 'Buy_Now_Button_VERSION', self::version );
        define( 'Buy_Now_Button_FILE', __FILE__ );
        define( 'Buy_Now_Button_PATH', __DIR__ );
        define( 'Buy_Now_Button_URL', plugins_url( '', Buy_Now_Button_FILE ) );
        define( 'Buy_Now_Button_ASSETS', Buy_Now_Button_URL . '/assets' );
    }
    
    /**
     * Included files.
     */
    public function includes() {
        require_once __DIR__ . '/includes/assets.php';
        require_once __DIR__ . '/includes/button-output.php';
        require_once __DIR__ . '/includes/menu.php';
        require_once __DIR__ . '/includes/option-controller.php';
    }

    /**
     * Initializes the plugin.
     *
     * @param void
     */
    public function init_plugin() {
        
        new Buy_Now_Button\Assets;
        new Buy_Now_Button\Buy_Now_Button_Output;
        
        if ( is_admin() ) {
            new Buy_Now_Button\Menu;
        }
    }

    public function body_classes( $classes ) {
        $classes = '';

		if ( Option_Controller::get_options( 'single' ) && ( Option_Controller::get_options( 'single_position' ) === 'replace_single' ) ) {
			$classes .= 'sovware-buy-now-button-hide-for-single-product ';
			
		}

		if ( Option_Controller::get_options( 'all' ) && ( Option_Controller::get_options( 'card_position' ) === 'replace_card' ) ) {
			$classes .= 'sovware-buy-now-button-hide-for-card-product';
		}

		return $classes;
	}

    function sbw_wc_handle_buy_now()
    {
        if ( !isset( $_REQUEST['sbw-wc-buy-now'] ) )
        {
            return false;
        }

        WC()->cart->empty_cart();

        $product_id = absint( $_REQUEST['sbw-wc-buy-now'] );
        $quantity = absint( $_REQUEST['quantity'] );

        if ( isset( $_REQUEST['variation_id'] ) ) {

            $variation_id = absint( $_REQUEST['variation_id'] );
            WC()->cart->add_to_cart( $product_id, 1, $variation_id );

        }else{
            WC()->cart->add_to_cart( $product_id, $quantity );
        }

        wp_safe_redirect( wc_get_checkout_url() );
        exit;
    }

}

/**
 * Initializes the main plugin.
 * @return \Buy_Now_Button
 */
function Woocommerce_Buy_Now_Button() {
    return Buy_Now_Button::init();
}

//Kick off the plugin.
Woocommerce_Buy_Now_Button();