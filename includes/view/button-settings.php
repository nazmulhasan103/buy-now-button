<div class="wrap">
    
    <form action="" method="post">

        <table class="form-table">

            <tbody>

                <tr>

                    <th scope="row">
                        <label for="address"><?php _e( 'Buy Now Button Label', 'sovware' ); ?></label>
                    </th>

                    <td>
                        <input type="text" name="name" id="name" class="regular-text" value="">
                    </td>

                </tr>

            </tbody>
            
        </table>

        <?php wp_nonce_field( 'new-address' ) ?>
        <?php submit_button( __( 'Save', 'sovware' ), 'primary', 'submit_address' ); ?>

    </form>
</div>