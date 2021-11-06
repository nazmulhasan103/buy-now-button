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
        
        ?>

        <div class="wrap">
            <h1 class="wp-heading-inline">
                <?php echo __( 'Buy Now Button Settings', 'buy-now-button' ); ?>
            </h1>

            <?php include __DIR__ .'/view/button-settings.php'; ?>
           
        </div>

        <?php
    }
}