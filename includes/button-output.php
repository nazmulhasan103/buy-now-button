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

		if ( Option_Controller::get_options( 'single' ) ) {
			$this->single_product_button_positions();
		}

		if ( Option_Controller::get_options( 'all' ) ) {
			$this->card_product_button_positions();
		}
	}

	public function single_product_button_positions() {

		if ( Option_Controller::get_options( 'single_position' ) === 'before_single' ) {

			add_action( 'woocommerce_before_add_to_cart_button', [ $this, 'single_button_template' ] );

		} elseif ( Option_Controller::get_options( 'single_position' ) === 'after_single' ) {

			add_action( 'woocommerce_after_add_to_cart_button', [ $this, 'single_button_template' ], 5 );

		} elseif ( Option_Controller::get_options( 'single_position' ) === 'replace_single' ) {

			add_action( 'woocommerce_after_add_to_cart_button', [ $this, 'single_button_template' ] );

		} else {

			add_action( 'woocommerce_after_add_to_cart_button', [ $this, 'single_button_template' ] );

		}
	}

	public function card_product_button_positions() {

		if ( Option_Controller::get_options( 'card_position' ) === 'before_card' ) {

			add_action( 'woocommerce_after_shop_loop_item', [ $this, 'card_button_template' ], 5 );

		} elseif ( Option_Controller::get_options( 'card_position' ) === 'after_card' ) {

			add_action( 'woocommerce_after_shop_loop_item', [ $this, 'card_button_template' ] );

		} elseif ( Option_Controller::get_options( 'card_position' ) === 'replace_card' ) {

			add_action( 'woocommerce_after_shop_loop_item', [ $this, 'card_button_template' ] );

		} else {

			add_action( 'woocommerce_after_shop_loop_item', [ $this, 'card_button_template' ] );

		}
	}

	/**
	 * Single product buy now button
	 */
	public function single_button_template() {
		global $product;
		printf( '<button id="sbw_wc-adding-button" type="submit" name="sbw-wc-buy-now" value="%d" class="single_add_to_cart_button buy_now_button button alt">%s</button>', $product->get_ID(), Option_Controller::get_options( 'label' ) );
	}

	/**
	 * Single product buy now button
	 */
	public function card_button_template() {
		global $product;

		if ( ! $product->is_type( 'simple' ) ) {
			return false;
		}

		printf( '<a id="sovware-buy-now" href="%s?buy-now=%s" data-quantity="1" class="button buy_now_button" data-product_id="%s" rel="nofollow">%s</a>', wc_get_checkout_url(), $product->get_ID(), $product->get_ID(), Option_Controller::get_options( 'label' ) );
	}
}