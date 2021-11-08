<?php
/**
 * @author  NazmulHasan
 * @since   1.0
 * @version 1.0
 */

namespace Buy_Now_Button;

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Customer detail class
 */
class Option_Controller {

	public static $options;

	public static function get_options( $option_key = '' ) {

		$options = array(
			'single'          => true,
			'all'             => true,
			'label'           => __( 'Buy Now', 'sovware' ),
			'single_position' => 'after_single',
			'card_position'   => 'after_card',
			'color'           => '',
			'hover_color'     => '',
			'bg_color'        => '',
			'hover_bg_color'  => '',
			'padding'         => '',
			'margin'          => '',
			'custom_css'      => '',
		);

		if ( !empty( $option_key ) && array_key_exists(  $option_key, $options ) ) {
			return get_option( 'BNBFW_' . $option_key, $options[$option_key] );
		}

		foreach( $options as $key => $value) {
			$options[ $key ] = get_option( 'BNBFW_' . $key, $value );
		}

		return  $options;
	}
}