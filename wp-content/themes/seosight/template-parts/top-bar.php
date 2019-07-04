<?php

if ( function_exists( 'fw_get_db_customizer_option' ) ) {
    $data = fw_get_db_customizer_option( 'sections-top-bar/show' );
    ?>
    <div class="top-bar <?php echo esc_attr($data['theme-style']); ?>">
        <div class="container">
            <?php if ( ( fw_akg( 'show-languages/status', $data ) == 'show' ) && ( fw_akg( 'show-languages/show/language-select/status', $data ) == 'plugin-select' ) ) {
                echo do_shortcode( fw_akg( 'show-languages/show/language-select/plugin-select/shortcode', $data ) );
            } ?>
            <div class="top-bar-contact">
                <?php
                if ( ( fw_akg( 'show-languages/status', $data ) == 'show' )
                     && ( fw_akg( 'show-languages/show/language-select/status', $data ) != 'plugin-select' )
                     && ( function_exists( 'icl_get_languages' ) )
                ) {
                    $data['top-bar-lang'] = icl_get_languages( 'skip_missing=0&orderby=code' );
                    $active_languages     = ( isset( $data['top-bar-lang'] ) && ! empty( $data['top-bar-lang'] ) ) ? $data['top-bar-lang'] : array();
                    $lang_img             = '';
                    $active_lang_key      = '';
                    $lang_options_str     = '';
                    foreach ( $active_languages as $lang_key => $lang_conf ) {
                        if ( $lang_conf['active'] ) {
                            $lang_img        = $lang_conf['country_flag_url'];
                            $active_lang_key = $lang_key;
                        }
                        $lang_options_str .= '<option data-url="' . $lang_conf['url'] . '" value="' . $lang_key . '"'
                                             . ( ( $lang_key == $active_lang_key ) ? 'selected="selected"' : '' )
                                             . '>' . $lang_conf['native_name'] . '</option>';
                    }
                    ?>
                    <div class="contact-item">
                        <img src="<?php echo esc_attr($lang_img); ?>" class="flags" alt="flags">
                        <select id="top-bar-language" class="nice-select">
                            <?php seosight_render($lang_options_str); ?>
                        </select>
                    </div>
                <?php } ?>
                <?php
                foreach ( fw_akg( 'info-boxes', $data, array() ) as $infoField ) { ?>
                    <div class="contact-item">
                        <?php
                        $field = $infoField['info'];
                        if ( seosight_is_phone( $field ) ) {
                            echo "<a href=\"tel:$field\">$field</a>";
                        } elseif ( seosight_is_email( $field ) ) {
                            echo "<a href=\"mailto:$field\">$field</a>";
                        } else {
                            echo wp_kses( $field, wp_kses_allowed_html( $field ) );
                        }
                        ?>

                    </div>

                <?php } ?>

            </div>

            <?php if ( fw_akg( 'show-login/status', $data ) == 'show' ): ?>
                <div class="login-block">
                    <?php
                    if ( is_user_logged_in() ) {
	                    global $current_user;
	                    echo get_avatar( $current_user->user_email, 28, '', '', array( 'class' => 'sign-in' ) ); ?>
                        <a href="<?php echo wp_logout_url(); ?>"><?php esc_html_e( 'Sign out', 'seosight' ); ?></a>
                    <?php } else { ?>
                        <img src="<?php echo get_template_directory_uri(); ?>/img/signin_dark.png" class="sign-in">
                        <a href="<?php echo wp_login_url(); ?>"><?php esc_html_e( 'Sign in', 'seosight' ); ?></a>
                    <?php } ?>
                </div>
            <?php endif; ?>

            <?php if ( ! empty( $data['social-networks'] ) ) { ?>
                <div class="follow_us">
                    <span><?php esc_html_e( 'Follow us:', 'seosight' ); ?></span>
                    <div class="socials">
                        <?php foreach ( $data['social-networks'] as $social ) { ?>
                            <a href="<?php echo esc_html( $social['link'] ); ?>" target="_blank" class="social__item" rel="nofollow">
                                <img src="<?php echo get_template_directory_uri() . '/svg/socials/' . $social[ 'icon' ]; ?>" alt="<?php echo esc_attr( ucfirst( trim( $social[ 'icon' ], '.svg' ) ) ); ?>">
                            </a>
                        <?php } ?>
                    </div>
                </div>
            <?php } ?>
            <i class="top-bar-close">
                <span></span>
                <span></span>
            </i>
        </div>
    </div>
    <?php
}