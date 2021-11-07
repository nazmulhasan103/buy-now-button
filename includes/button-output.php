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
class Buy_Now_Button_Output {

	/**
	 * Status.
	 *
	 * @var string
	 */
	private $enabled = 'yes';
	
	/**
	 * Position.
	 *
	 * @var string
	 */
	private $position = 'before';

	public function __construct() {

		if ( $this->is_enabled() ) {
			$this->handle_button_positions();
		}
	}

	public function handle_button_positions() {
		if ( $this->is_before_button() ) {
			add_action( 'woocommerce_before_add_to_cart_button', [ $this, 'button_template' ] );
			add_action( 'woocommerce_after_shop_loop_item', [ $this, 'button_template' ] );
		} elseif ( $this->is_after_button() ) {
			add_action( 'woocommerce_after_add_to_cart_button', [ $this, 'button_template' ], 5 );
			add_action( 'woocommerce_after_shop_loop_item', [ $this, 'button_template' ], 5 );
		} elseif ( $this->is_replace_button() ) {
			add_action( 'woocommerce_after_add_to_cart_button', [ $this, 'button_template' ], 5 );
			add_action( 'woocommerce_after_shop_loop_item', [ $this, 'button_template' ], 5 );
		}
	}

	/**
	 * Is enable.
	 *
	 * @return boolean
	 */
	public function is_enabled() {
		$enabled = get_option( 'buy_now_woo_single_product_enable', $this->enabled );

		return $enabled && 'no' !== $enabled;
	}

	/**
	 * Gets position button.
	 *
	 * @return string
	 */
	public function get_position() {
		return get_option( 'buy_now_woo_single_product_position', $this->position );
	}

	/**
	 * If button position is before `add to cart` button.
	 *
	 * @return boolean
	 */
	public function is_before_button() {
		return ( 'before' === $this->get_position() );
	}

	/**
	 * If button position is after `add to cart` button.
	 *
	 * @return boolean
	 */
	public function is_after_button() {
		return ( 'after' === $this->get_position() );
	}

	/**
	 * If `buy now` button replace `add to cart` button
	 *
	 * @return boolean
	 */
	public function is_replace_button() {
		return ( 'replace' === $this->get_position() );
	}

	/**
	 * Single product buy now button
	 */
	public function button_template() {
		global $product;

		if ( is_singular( 'product' ) ) {
			
			if ( ! $product->is_type( 'simple' ) ) {
				return false;
			}
	
			printf( '<a id="sbw_wc-adding-button-archive" href="%s?buy-now=%s" data-quantity="1" class="button product_type_simple add_to_cart_button  buy_now_button" data-product_id="%s" rel="nofollow">%s</a>', wc_get_checkout_url(), $product->get_ID(), $product->get_ID(), esc_html__( 'Buy Now-', 'sbw-wc' ) );

		} else {

    		printf( '<button id="sbw_wc-adding-button" type="submit" name="sbw-wc-buy-now" value="%d" class="single_add_to_cart_button buy_now_button button alt">%s</button>', $product->get_ID(), esc_html__( 'Buy Now-', 'sbw-wc' ) );

		}
	}
}