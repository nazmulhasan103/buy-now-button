<?php
/**
 * @author  NazmulHasan
 * @since   1.0
 * @version 1.0
 */

use Buy_Now_Button\Option_Controller;
?>

<div class="wrap">

    </br>

    <form action="" method="post">

        <table class="form-table">

            <h3><?php _e( 'General Settings', 'sovware' ); ?></h3>

            <tbody>

                <tr>

                    <th scope="row"><label for="buy_now_single"><?php _e( 'Enable for single product', 'sovware' ); ?></label></th>

                    <td>
                        <input type="checkbox" name="buy_now_single" id="buy_now_single" value="buy_now_single" <?php echo checked( Option_Controller::get_options('single'), 'buy_now_single' ); ?>>
                    </td>

                </tr>

                <tr>

                    <th scope="row"><label for="buy_now_product_card"><?php _e( 'Enable for card product', 'sovware' ); ?></label></th>

                    <td>
                        <input type="checkbox" name="buy_now_product_card" id="buy_now_product_card" value="buy_now_product_card" <?php echo checked( Option_Controller::get_options('all'), 'buy_now_product_card' ); ?>>
                    </td>

                </tr>

                <tr>

                    <th scope="row">
                        <label for="buy_now_label"><?php _e( 'Button label', 'sovware' ); ?></label>
                    </th>

                    <td>
                        <input type="text" name="buy_now_label" id="buy_now_label" class="regular-text" value="<?php echo esc_attr( Option_Controller::get_options('label') ); ?>">
                    </td>

                </tr>

                <tr>

                    <th scope="row">
                        <label><?php _e( 'Single product button position', 'sovware' ); ?></label>
                    </th>

                    <td>
                        <input type="radio" id="before_single" name="single_product_position" value="before_single" <?php echo checked( Option_Controller::get_options('single_position'), 'before_single' ); ?>>
                        <label for="before_single"><?php echo __( 'Before Add To Cart Button', 'sovware' ); ?></label><br>
                        <input type="radio" id="after_single" name="single_product_position" value="after_single" <?php echo checked( Option_Controller::get_options('single_position'), 'after_single' ); ?>>
                        <label for="after_single"><?php echo __( 'After Add To Cart Button', 'sovware' ); ?></label><br>
                        <input type="radio" id="replace_single" name="single_product_position" value="replace_single" <?php echo checked( Option_Controller::get_options('single_position'), 'replace_single' ); ?>>
                        <label for="replace_single"><?php echo __( 'Replace Add To Cart Button', 'sovware' ); ?></label><br>
                    </td>

                </tr>

                <tr>

                    <th scope="row">
                        <label><?php _e( 'Card product button position', 'sovware' ); ?></label>
                    </th>

                    <td>
                        <input type="radio" id="before_card" name="card_product_position" value="before_card" <?php echo checked( Option_Controller::get_options('card_position'), 'before_card' ); ?>>
                        <label for="before_card"><?php echo __( 'Before Add To Cart Button', 'sovware' ); ?></label><br>
                        <input type="radio" id="after_card" name="card_product_position" value="after_card" <?php echo checked( Option_Controller::get_options('card_position'), 'after_card' ); ?>>
                        <label for="after_card"><?php echo __( 'After Add To Cart Button', 'sovware' ); ?></label><br>
                        <input type="radio" id="replace_card" name="card_product_position" value="replace_card" <?php echo checked( Option_Controller::get_options('card_position'), 'replace_card' ); ?>>
                        <label for="replace_card"><?php echo __( 'Replace Add To Cart Button', 'sovware' ); ?></label><br>
                    </td>

                </tr>

            </tbody>

        </table>

        </br>

        <table class="form-table">
            
            <h3><?php _e( 'Customize Settings', 'sovware' ); ?></h3>
            
            <tbody>

                <tr>

                    <th scope="row"><label for="buy_now_color"><?php _e( 'Text color', 'sovware' ); ?></label></th>

                    <td>
                        <input type="color" name="buy_now_color" id="buy_now_color" value="<?php echo esc_attr( Option_Controller::get_options('color') ); ?>">
                    </td>

                </tr>

                <tr>

                    <th scope="row"><label for="buy_now_bg_color"><?php _e( 'Background color', 'sovware' ); ?></label></th>

                    <td><input type="color" name="buy_now_bg_color" id="buy_now_bg_color" value="<?php echo esc_attr( Option_Controller::get_options('bg_color') ); ?>"></td>

                </tr>
                
                <tr>

                    <th scope="row"><label for="buy_now_hover_color"><?php _e( 'Text hover color', 'sovware' ); ?></label></th>

                    <td>
                        <input type="color" name="buy_now_hover_color" id="buy_now_hover_color" value="<?php echo esc_attr( Option_Controller::get_options('hover_color') ); ?>">
                    </td>

                </tr>

                <tr>

                    <th scope="row"><label for="buy_now_bg_hover_color"><?php _e( 'Background hover color', 'sovware' ); ?></label></th>

                    <td>
                        <input type="color" name="buy_now_bg_hover_color" id="buy_now_bg_hover_color" value="<?php echo esc_attr( Option_Controller::get_options('hover_bg_color') ); ?>">
                    </td>

                </tr>

                <tr>

                    <th scope="row"><label for="buy_now_padding"><?php _e( 'Padding', 'sovware' ); ?></label></th>

                    <td>
                        <input type="text" name="buy_now_padding" id="buy_now_padding" value="<?php echo esc_attr( Option_Controller::get_options('padding') ); ?>" class="regular-text" placeholder="10 10 10 10">
                        <p>Insert button padding: top right bottom left. eg: 10 12 10 12</p>
                    </td>

                </tr>

                <tr>

                    <th scope="row"><label for="buy_now_margin"><?php _e( 'Margin', 'sovware' ); ?></label></th>

                    <td>
                        <input type="text" name="buy_now_margin" id="buy_now_margin" value="<?php echo esc_attr( Option_Controller::get_options('margin') ); ?>" class="regular-text" placeholder="10 10 10 10">
                        <p>Insert button margin: top right bottom left. eg: 10 12 10 12</p>
                    </td>

                </tr>

            </tbody>
            
        </table>

        </br>

        <table class="form-table">
            
            <h3><?php _e( 'Additional CSS', 'sovware' ); ?></h3>
            
            <tbody>

                <tr>

                    <th scope="row"><label for="custom_css"><?php _e( 'CSS code', 'sovware' ); ?></label></th>

                    <td>
                        <textarea name="custom_css" id="custom_css" rows="5" cols="30" class="regular-text"><?php echo esc_attr( Option_Controller::get_options('custom_css') ); ?></textarea>
                    </td>

                </tr>

            </tbody>

        </table>

        <?php wp_nonce_field( 'buy-now-button' ) ?>

        <?php submit_button( __( 'Save', 'sovware' ), 'primary', 'save_changes' ); ?>

    </form>

</div>