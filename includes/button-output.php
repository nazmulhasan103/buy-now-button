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

	public function __construct() {
		// Single product buy now button
		add_filter( 'woocommerce_after_add_to_cart_button', [ $this, 'single_product' ] );

		// All products button
		add_filter( 'woocommerce_after_shop_loop_item', [ $this, 'all_products' ] );
	}

	/**
	 * Single product buy now button
	 */
	public function single_product() {
		global $product;

    	printf( '<button id="sbw_wc-adding-button" type="submit" name="sbw-wc-buy-now" value="%d" class="single_add_to_cart_button buy_now_button button alt">%s</button>', $product->get_ID(), esc_html__( 'Buy Now', 'sbw-wc' ) );
	}

	/**
	 * All product button
	 */
	public function all_products() {
		global $product;

		if ( ! $product->is_type( 'simple' ) ) {
			return false;
		}

		printf( '<a id="sbw_wc-adding-button-archive" href="%s?buy-now=%s" data-quantity="1" class="button product_type_simple add_to_cart_button  buy_now_button" data-product_id="%s" rel="nofollow">%s</a>', wc_get_checkout_url(), $product->get_ID(), $product->get_ID(), esc_html__( 'Buy Now', 'sbw-wc' ) );
	}
}