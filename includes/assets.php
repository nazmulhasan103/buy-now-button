<?php
/**
 * @author  BNBF_Woocommerce
 * @since   1.0
 * @version 1.0
 */

namespace BNBF_Woocommerce;

if ( ! defined( 'ABSPATH' ) ) {
    return;
}

/**
 * Assets handler class
 */
class Assets {

    /**
     * Initializes the class
     */
    function __construct() {
        add_action( 'wp_enqueue_scripts', [ $this, 'register_scripts' ] );
        add_action( 'wp_enqueue_scripts', [ $this, 'enqueue_scripts' ] );
    }

    /**
     * Registered scripts
     */
    public function register_scripts () {

        wp_register_style( 'buy-now-button-style', BNBF_Woocommerce_ASSETS . '/css/main.css', false, filemtime( BNBF_Woocommerce_PATH . '/assets/css/main.css' ) );

        wp_register_script( 'buy-now-button-script', BNBF_Woocommerce_ASSETS . '/js/main.js', false, filemtime( BNBF_Woocommerce_PATH . '/assets/js/main.js' ), true );

    }

    /**
     * Enqueue scripts
     */
    public function enqueue_scripts () {

        wp_enqueue_style( 'buy-now-button-style' );

        wp_enqueue_script( 'buy-now-button-script' );

        $this->inline_style();

    }

    private function inline_style() {

        $s_color    = ! empty( BNBF_Controller::get_options( 'hover_s_color' ) ) ? 'color:' . BNBF_Controller::get_options( 'hover_s_color' ). ' !important; ' : '';
        $bg_s_color = ! empty( BNBF_Controller::get_options( 'hover_bg_s_color' ) ) ? 'background-color:' . BNBF_Controller::get_options( 'hover_bg_s_color' ). ' !important; ' : '';

        $color    = ! empty( BNBF_Controller::get_options( 'hover_color' ) ) ? 'color:' . BNBF_Controller::get_options( 'hover_color' ). ' !important; ' : '';
        $bg_color = ! empty( BNBF_Controller::get_options( 'hover_bg_color' ) ) ? 'background-color:' . BNBF_Controller::get_options( 'hover_bg_color' ). ' !important; ' : '';

        $attr_s = $s_color . $bg_s_color;
        $attr   = $color . $bg_color;

        $dynamic_css = ".bnbf_woocommerce_single_product #bnbf_woocommerce_single_product:hover{{$attr_s}}";
        $dynamic_css .= ".bnbf_woocommerce_card_product #bnbf_woocommerce_card_product:hover{{$attr}}";

		wp_add_inline_style( 'buy-now-button-style', $dynamic_css );
	}
}