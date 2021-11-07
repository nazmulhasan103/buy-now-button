<div class="wrap">

    </br>

    <form action="" method="post">

        <table class="form-table">

            <h3><?php _e( 'General Settings', 'sovware' ); ?></h3>

            <tbody>

                <tr>

                    <th scope="row"><label for="buy_now_single"><?php _e( 'Enable for single product', 'sovware' ); ?></label></th>

                    <td><input type="checkbox" name="buy_now_single" id="buy_now_single" value=""></td>

                </tr>

                <tr>

                    <th scope="row"><label for="buy_now_product_card"><?php _e( 'Enable for product card', 'sovware' ); ?></label></th>

                    <td><input type="checkbox" name="buy_now_product_card" id="buy_now_product_card" value=""></td>

                </tr>

                <tr>

                    <th scope="row">
                        <label for="buy_now_label"><?php _e( 'Button label', 'sovware' ); ?></label>
                    </th>

                    <td>
                        <input type="text" name="buy_now_label" id="buy_now_label" class="regular-text" value="">
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

                    <td><input type="color" name="buy_now_color" id="buy_now_color" value=""></td>

                </tr>

                <tr>

                    <th scope="row"><label for="buy_now_bg_color"><?php _e( 'Background color', 'sovware' ); ?></label></th>

                    <td><input type="color" name="buy_now_bg_color" id="buy_now_bg_color" value=""></td>

                </tr>
                
                <tr>

                    <th scope="row"><label for="buy_now_hover_color"><?php _e( 'Text hover color', 'sovware' ); ?></label></th>

                    <td><input type="color" name="buy_now_hover_color" id="buy_now_hover_color" value=""></td>

                </tr>

                <tr>

                    <th scope="row"><label for="buy_now_bg_hover_color"><?php _e( 'Background hover color', 'sovware' ); ?></label></th>

                    <td><input type="color" name="buy_now_bg_hover_color" id="buy_now_bg_hover_color" value=""></td>

                </tr>

                <tr>

                    <th scope="row"><label for="buy_now_padding"><?php _e( 'Padding', 'sovware' ); ?></label></th>

                    <td>
                        <input type="text" name="buy_now_padding" id="buy_now_padding" value="" class="regular-text">
                        <p>Insert button padding: top right bottom left. eg: 10 12 10 12</p>
                    </td>

                </tr>

                <tr>

                    <th scope="row"><label for="buy_now_margin"><?php _e( 'Margin', 'sovware' ); ?></label></th>

                    <td>
                        <input type="text" name="buy_now_margin" id="buy_now_margin" value="" class="regular-text">
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

                    <th scope="row"><label for="buy_now_color"><?php _e( 'CSS code', 'sovware' ); ?></label></th>

                    <td><textarea name="address" id="address" rows="5" cols="30" class="regular-text"></textarea></td>

                </tr>

            </tbody>

        </table>

        <?php wp_nonce_field( 'buy-now-button' ) ?>

        <?php submit_button( __( 'Save', 'sovware' ), 'primary', 'save_changes' ); ?>

    </form>

</div>