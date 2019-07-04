<div class="wrap">
    <div class="top-section">
        <img class="logotype" alt="logo" src="<?php echo $logo ? esc_attr( $logo ) : "{$img_path}/logo.png"; ?>">
        <h3><?php echo $theme->get( 'Description' ); ?></h3>
        <p><?php printf( esc_html__( 'Thank you for choosing %s! Your product must be registred to recive the demos, auto theme updates and included premium plugins.', 'fw' ), $theme->get( 'Name' ) ); ?></p>
    </div>

    <form class="purchase-form" id="purchase-form" name="purchase" action="options.php" method="POST">
        <h3 style="color: <?php echo esc_attr( $status[ 'color' ] ); ?>"><?php echo esc_html( $status[ 'msg' ] ); ?></h3>
        <div class="enter-purchase"><?php _e( 'Enter you Envato username and apikey', 'fw' ); ?></div>

        <div class="input-button-inline">
            <?php
            if ( $status[ 'activated' ] ) {
                settings_fields( $option_revoke_slug );
                ?>
                <input name="holder1" type="password" value="xxxxxxxxxxxxxxxx" readonly>
                <input name="holder2" type="password" value="xxxxxxxxxxxxxxxx" readonly>
                <button type="submit" class="button button-danger button-hero">Revoke</button>
                <?php
            } else {
                settings_fields( $options_slug );
                ?>
                <input name="<?php echo esc_attr( "{$options_slug}[{$option_username_slug}]" ); ?>" value="<?php echo esc_attr( $username ); ?>" placeholder="<?php _e( 'Enter your Envato username here...', 'fw' ); ?>" autocomplete="off" type="text" required>
                <input name="<?php echo esc_attr( "{$options_slug}[{$option_apikey_slug}]" ); ?>" value="<?php echo esc_attr( $apikey ); ?>" placeholder="<?php _e( 'Enter your Envato apikey here...', 'fw' ); ?>" autocomplete="off" type="text" required>
                <button type="submit" class="button button-primary button-hero"><?php _e( 'Activate', 'fw' ); ?></button>
                <?php
            }
            ?>
        </div>

        <div class="block-instruction">
            <a href="https://themeforest.net/downloads"><img alt="logo-item" src="<?php echo $logo_item ? esc_attr( $logo_item ) : "{$img_path}/logo-item.png"; ?>"></a>
            <div class="text">
                <p><?php _e( 'You can generate your API key in your Account -> Settings -> API keys of Envato market', 'fw' ); ?></p>
                <a href="https://support.crumina.net/help-center/articles/253/how-to-generate-api-key"><?php _e( 'Instruction for getting api key', 'fw' ); ?></a>
            </div>
        </div>
    </form>

</div>
