<?php
/**
 * @author  NazmulHasan
 * @since   1.0
 * @version 1.0
 */

namespace Buy_Now_Button;

if ( ! defined( 'ABSPATH' ) ) {
    return;
}

/**
 * The admin class
 */
class Menu {

    function __construct() {
        add_action( 'admin_menu', [ $this,'admin_menu' ] );
    }

    public function admin_menu() {

        $parent_slug = 'woocommerce';
        $page_title  = 'buy-now-button';
        $menu_title  = __( 'Buy Now Button', 'buy-now-button' );
        $capability  = 'manage_woocommerce';
        $menu_slug   = 'buy-now-button';

        add_submenu_page( $parent_slug, $page_title, $menu_title, $capability, $menu_slug, [ $this, 'menu_callback' ] );
    }

    public function menu_callback() {

        if ( ! empty( $_POST ) ) {

            $single          = isset( $_POST['buy_now_single'] ) ? $_POST['buy_now_single'] : false;
            $all             = isset( $_POST['buy_now_product_card'] ) ? $_POST['buy_now_product_card'] : false;
            $btn_label       = isset( $_POST['buy_now_label'] ) ? $_POST['buy_now_label'] : false;
            $single_position = isset( $_POST['single_product_position'] ) ? $_POST['single_product_position'] : false;
            $card_position   = isset( $_POST['card_product_position'] ) ? $_POST['card_product_position'] : false;
            $color           = isset( $_POST['buy_now_color'] ) ? $_POST['buy_now_color'] : false;
            $hover_color     = isset( $_POST['buy_now_hover_color'] ) ? $_POST['buy_now_hover_color'] : false;
            $bg_color        = isset( $_POST['buy_now_bg_color'] ) ? $_POST['buy_now_bg_color'] : false;
            $hover_bg_color  = isset( $_POST['buy_now_bg_hover_color'] ) ? $_POST['buy_now_bg_hover_color'] : false;
            $padding         = isset( $_POST['buy_now_padding'] ) ? $_POST['buy_now_padding'] : false;
            $margin          = isset( $_POST['buy_now_margin'] ) ? $_POST['buy_now_margin'] : false;
            $custom_css      = isset( $_POST['custom_css'] ) ? $_POST['custom_css'] : false;

            $values = array(
                '_single'          => $single,
                '_all'             => $all,
                '_label'           => $btn_label,
                '_single_position' => $single_position,
                '_card_position'   => $card_position,
                '_color'           => $color,
                '_hover_color'     => $hover_color,
                '_bg_color'        => $bg_color,
                '_hover_bg_color'  => $hover_bg_color,
                '_padding'         => $padding,
                '_margin'          => $margin,
                '_custom_css'      => $custom_css,
            );

            foreach ( $values as $key => $value ) {
                update_option( 'BNBFW' . $key, $value );
            }
        }
        ?>

        <div class="wrap">
            <h1 class="wp-heading-inline">
                <?php echo __( 'Buy Now For Woocommerce', 'buy-now-button' ); ?>
            </h1>

            <?php include __DIR__ .'/view/button-settings.php'; ?>
           
        </div>

        <?php
    }
}