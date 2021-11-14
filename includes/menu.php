<?php
/**
 * @author  NazmulHasan
 * @since   1.0
 * @version 1.0
 */

namespace BNBF_Woocommerce;

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

            $single           = isset( $_POST['buy_now_single'] ) ? $_POST['buy_now_single'] : false;
            $all              = isset( $_POST['buy_now_product_card'] ) ? $_POST['buy_now_product_card'] : false;
            $btn_label        = isset( $_POST['buy_now_label'] ) ? $_POST['buy_now_label'] : false;
            $single_position  = isset( $_POST['single_product_position'] ) ? $_POST['single_product_position'] : false;
            $card_position    = isset( $_POST['card_product_position'] ) ? $_POST['card_product_position'] : false;
            $color            = isset( $_POST['buy_now_color'] ) ? $_POST['buy_now_color'] : false;
            $hover_color      = isset( $_POST['buy_now_hover_color'] ) ? $_POST['buy_now_hover_color'] : false;
            $bg_color         = isset( $_POST['buy_now_bg_color'] ) ? $_POST['buy_now_bg_color'] : false;
            $hover_bg_color   = isset( $_POST['buy_now_bg_hover_color'] ) ? $_POST['buy_now_bg_hover_color'] : false;
            $s_color          = isset( $_POST['buy_now_s_color'] ) ? $_POST['buy_now_s_color'] : false;
            $hover_s_color    = isset( $_POST['buy_now_hover_s_color'] ) ? $_POST['buy_now_hover_s_color'] : false;
            $bg_s_color       = isset( $_POST['buy_now_bg_s_color'] ) ? $_POST['buy_now_bg_s_color'] : false;
            $hover_bg_s_color = isset( $_POST['buy_now_bg_hover_s_color'] ) ? $_POST['buy_now_bg_hover_s_color'] : false;
            $p_top            = isset( $_POST['buy_now_p_top'] ) ? $_POST['buy_now_p_top'] : false;
            $p_right          = isset( $_POST['buy_now_p_right'] ) ? $_POST['buy_now_p_right'] : false;
            $p_bottom         = isset( $_POST['buy_now_p_bottom'] ) ? $_POST['buy_now_p_bottom'] : false;
            $p_left           = isset( $_POST['buy_now_p_left'] ) ? $_POST['buy_now_p_left'] : false;
            $m_top            = isset( $_POST['buy_now_m_top'] ) ? $_POST['buy_now_m_top'] : false;
            $m_right          = isset( $_POST['buy_now_m_right'] ) ? $_POST['buy_now_m_right'] : false;
            $m_bottom         = isset( $_POST['buy_now_m_bottom'] ) ? $_POST['buy_now_m_bottom'] : false;
            $m_left           = isset( $_POST['buy_now_m_left'] ) ? $_POST['buy_now_m_left'] : false;
            $s_p_top          = isset( $_POST['buy_now_s_p_top'] ) ? $_POST['buy_now_s_p_top'] : false;
            $s_p_right        = isset( $_POST['buy_now_s_p_right'] ) ? $_POST['buy_now_s_p_right'] : false;
            $s_p_bottom       = isset( $_POST['buy_now_s_p_bottom'] ) ? $_POST['buy_now_s_p_bottom'] : false;
            $s_p_left         = isset( $_POST['buy_now_s_p_left'] ) ? $_POST['buy_now_s_p_left'] : false;
            $s_m_top          = isset( $_POST['buy_now_s_m_top'] ) ? $_POST['buy_now_s_m_top'] : false;
            $s_m_right        = isset( $_POST['buy_now_s_m_right'] ) ? $_POST['buy_now_s_m_right'] : false;
            $s_m_bottom       = isset( $_POST['buy_now_s_m_bottom'] ) ? $_POST['buy_now_s_m_bottom'] : false;
            $s_m_left         = isset( $_POST['buy_now_s_m_left'] ) ? $_POST['buy_now_s_m_left'] : false;
            $reset_cart       = isset( $_POST['reset_cart'] ) ? $_POST['reset_cart'] : false;

            $values = array(
                'single'           => $single,
                'all'              => $all,
                'label'            => $btn_label,
                'single_position'  => $single_position,
                'card_position'    => $card_position,
                'color'            => $color,
                'bg_color'         => $bg_color,
                'hover_color'      => $hover_color,
                'hover_bg_color'   => $hover_bg_color,
                's_color'          => $s_color,
                'bg_s_color'       => $bg_s_color,
                'hover_s_color'    => $hover_s_color,
                'hover_bg_s_color' => $hover_bg_s_color,
                'p_top'            => $p_top,
                'p_right'          => $p_right,
                'p_bottom'         => $p_bottom,
                'p_left'           => $p_left,
                'm_top'            => $m_top,
                'm_right'          => $m_right,
                'm_bottom'         => $m_bottom,
                'm_left'           => $m_left,
                's_p_top'          => $s_p_top,
                's_p_right'        => $s_p_right,
                's_p_bottom'       => $s_p_bottom,
                's_p_left'         => $s_p_left,
                's_m_top'          => $s_m_top,
                's_m_right'        => $s_m_right,
                's_m_bottom'       => $s_m_bottom,
                's_m_left'         => $s_m_left,
                'reset_cart'       => $reset_cart,
            );

            foreach ( $values as $key => $value ) {
                update_option( 'BNBFW_' . $key, $value );
            }
        }
        ?>

        <div class="wrap">
            <h1 class="wp-heading-inline">
                <?php echo __( 'Buy Now For Woocommerce', 'buy-now-button' ); ?>
            </h1>

            <?php include __DIR__ .'/customize-settings.php'; ?>
           
        </div>

        <?php
    }
}