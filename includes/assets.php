<?php
/**
 * @author  Buy_Now_Button
 * @since   1.0
 * @version 1.0
 */

namespace Buy_Now_Button;

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

        wp_register_style( 'buy-now-button-style', Buy_Now_Button_ASSETS . '/css/main.css', false, filemtime( Buy_Now_Button_PATH . '/assets/css/main.css' ) );

        wp_register_script( 'buy-now-button-script', Buy_Now_Button_ASSETS . '/js/main.js', false, filemtime( Buy_Now_Button_PATH . '/assets/js/main.js' ), true );

    }

    /**
     * Enqueue scripts
     */
    public function enqueue_scripts () {

        wp_enqueue_style( 'buy-now-button-style' );

        wp_enqueue_script( 'buy-now-button-script' );

    }
}