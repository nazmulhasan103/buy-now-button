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