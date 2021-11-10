<?php
/**
 * @author  NazmulHasan
 * @since   1.0
 * @version 1.0
 */

namespace BNBF_Woocommerce;

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Customer detail class
 */
class BNBF_Controller {

	public function __construct() {

		if ( self::get_options( 'all' ) ) {
			$this->card_product_button_positions();
		}

		if ( self::get_options( 'single' ) ) {
			$this->single_product_button_positions();
		}

	}

	public function card_product_button_positions() {

		if ( self::get_options( 'card_position' ) === 'before_card' ) {

			add_action( 'woocommerce_after_shop_loop_item', [ $this, 'card_button_template' ], 5 );

		} elseif ( self::get_options( 'card_position' ) === 'after_card' ) {

			add_action( 'woocommerce_after_shop_loop_item', [ $this, 'card_button_template' ] );

		} elseif ( self::get_options( 'card_position' ) === 'replace_card' ) {

			add_action( 'woocommerce_after_shop_loop_item', [ $this, 'card_button_template' ] );

		} else {

			add_action( 'woocommerce_after_shop_loop_item', [ $this, 'card_button_template' ] );

		}
	}

	public function single_product_button_positions() {

		if ( self::get_options( 'single_position' ) === 'before_single' ) {

			add_action( 'woocommerce_before_add_to_cart_button', [ $this, 'single_button_template' ] );

		} elseif ( self::get_options( 'single_position' ) === 'after_single' ) {

			add_action( 'woocommerce_after_add_to_cart_button', [ $this, 'single_button_template' ], 5 );

		} elseif ( self::get_options( 'single_position' ) === 'replace_single' ) {

			add_action( 'woocommerce_after_add_to_cart_button', [ $this, 'single_button_template' ] );

		} else {

			add_action( 'woocommerce_after_add_to_cart_button', [ $this, 'single_button_template' ] );

		}
	}

	/**
	 * Single product buy now button
	 */
	public function card_button_template() {
		
		global $product;

		if ( ! $product->is_type( 'simple' ) ) {
			return false;
		}

		$class = empty( self::button_card_style( true ) ) ? 'button' : '';
		$attr  = ! empty( self::button_card_style() ) ? self::button_card_style() : '';

		printf( '<a %s id="bnbf_woocommerce_card_product" href="buy-now?id=%s" data-quantity="1" class="bnbf_woocommerce_card_product %s" data-product_id="%s">%s</a>', esc_html( $attr ), esc_attr( $product->get_ID() ), esc_html( $class ), esc_attr( $product->get_ID() ), self::get_options( 'label' ) );

	}

	/**
	 * Single product buy now button
	 */
	public function single_button_template() {
		
		global $product;

		$attr  = ! empty( self::button_single_style() ) ? self::button_single_style() : '';

		printf( '<button %s id="bnbf_woocommerce_single_product" type="submit" name="bnbf_woocommerce_single_product" value="%d" class="bnbf_woocommerce_single_product">%s</button>', esc_html( $attr ), esc_attr( $product->get_ID() ), self::get_options( 'label' ) );
	}

	static public function button_card_style( $padding_margin = '' ) {

		$attr = '';

		$color    = ! empty( self::get_options( 'color' ) ) ? 'color:' . self::get_options( 'color' ). ';' : '';
		$bg_color = ! empty( self::get_options( 'bg_color' ) ) ? 'background-color:' . self::get_options( 'bg_color' ). ';' : '';

		$p_top    = ! empty( self::get_options( 'p_top' ) ) ? 'padding-top:' . self::get_options( 'p_top' ). 'px;' : '';
		$p_right  = ! empty( self::get_options( 'p_right' ) ) ? 'padding-right:'. self::get_options( 'p_right' ). 'px;' : '';
		$p_bottom = ! empty( self::get_options( 'p_bottom' ) ) ? 'padding-bottom:' . self::get_options( 'p_bottom' ). 'px;' : '';
		$p_left   = ! empty( self::get_options( 'p_left' ) ) ? 'padding-left:'. self::get_options( 'p_left' ). 'px;' : '';
		
		$m_top    = ! empty( self::get_options( 'm_top' ) ) ? 'margin-top:' . self::get_options( 'm_top' ). 'px;' : '';
		$m_right  = ! empty( self::get_options( 'm_right' ) ) ? 'margin-right:'. self::get_options( 'm_right' ). 'px;' : '';
		$m_bottom = ! empty( self::get_options( 'm_bottom' ) ) ? 'margin-bottom:' . self::get_options( 'm_bottom' ). 'px;' : '';
		$m_left   = ! empty( self::get_options( 'm_left' ) ) ? 'margin-left:'. self::get_options( 'm_left' ). 'px;' : '';

		$padding_margin_atts = $p_top . $p_right . $p_bottom . $p_left . $m_top . $m_right . $m_bottom . $m_left;
		$atts                = $p_top . $p_right . $p_bottom . $p_left . $m_top . $m_right . $m_bottom . $m_left . $color . $bg_color;

		if ( $padding_margin ) {
			$attr = $padding_margin_atts;
		} else {
			$attr = "style={$atts}";
		}

		return $attr;
	}

	static public function button_single_style() {

		$attr = '';
		
		$s_color    = ! empty( self::get_options( 's_color' ) ) ? 'color:' . self::get_options( 's_color' ). ';' : '';
		$bg_s_color = ! empty( self::get_options( 'bg_s_color' ) ) ? 'background-color:' . self::get_options( 'bg_s_color' ). ';' : '';

		$s_p_top    = ! empty( self::get_options( 's_p_top' ) ) ? 'padding-top:' . self::get_options( 's_p_top' ). 'px;' : '';
		$s_p_right  = ! empty( self::get_options( 's_p_right' ) ) ? 'padding-right:'. self::get_options( 's_p_right' ). 'px;' : '';
		$s_p_bottom = ! empty( self::get_options( 's_p_bottom' ) ) ? 'padding-bottom:' . self::get_options( 's_p_bottom' ). 'px;' : '';
		$s_p_left   = ! empty( self::get_options( 's_p_left' ) ) ? 'padding-left:'. self::get_options( 's_p_left' ). 'px;' : '';
		
		$s_m_top    = ! empty( self::get_options( 's_m_top' ) ) ? 'margin-top:' . self::get_options( 's_m_top' ). 'px;' : '';
		$s_m_right  = ! empty( self::get_options( 's_m_right' ) ) ? 'margin-right:'. self::get_options( 's_m_right' ). 'px;' : '';
		$s_m_bottom = ! empty( self::get_options( 's_m_bottom' ) ) ? 'margin-bottom:' . self::get_options( 's_m_bottom' ). 'px;' : '';
		$s_m_left   = ! empty( self::get_options( 's_m_left' ) ) ? 'margin-left:'. self::get_options( 's_m_left' ). 'px;' : '';

		$atts = $s_p_top . $s_p_right . $s_p_bottom . $s_p_left . $s_m_top . $s_m_right . $s_m_bottom . $s_m_left . $s_color . $bg_s_color;

		if ( $atts  ) {
			$attr = "style={$atts}";
		}

		return $attr;
	}

	public static function get_options( $option_key = '' ) {

		$options = array(
			'single'           => 'buy_now_single',
			'all'              => 'buy_now_product_card',
			'label'            => __( 'Buy Now', 'sovware' ),
			'single_position'  => 'after_single',
			'card_position'    => 'after_card',
			'color'            => '#ffffff',
			'hover_color'      => '#ffffff',
			'bg_color'         => '#0073aa',
			'hover_bg_color'   => '#000000',
			's_color'          => '#ffffff',
			'hover_s_color'    => '#ffffff',
			'bg_s_color'       => '#0073aa',
			'hover_bg_s_color' => '#000000',
			'p_top'            => '',
			'p_right'          => '',
			'p_bottom'         => '',
			'p_left'           => '',
			'm_top'            => '',
			'm_right'          => '',
			'm_bottom'         => '',
			'm_left'           => '',
			's_p_top'          => '',
			's_p_right'        => '',
			's_p_bottom'       => '',
			's_p_left'         => '',
			's_m_top'          => '',
			's_m_right'        => '',
			's_m_bottom'       => '',
			's_m_left'         => '',
			'reset_cart'       => '',
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