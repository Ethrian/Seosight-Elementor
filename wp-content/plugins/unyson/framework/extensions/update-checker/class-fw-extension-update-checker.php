<?php

if ( !defined( 'FW' ) ) {
    die( 'Forbidden' );
}

class FW_Extension_Update_Checker extends FW_Extension {

    /**
     * Cookie name for redirect parameter.
     *
     * @var        string
     */
    static $REDIRECTED_COOKIE = 'crumina_redirected_to_activate';

    /**
     * Cookie name for dismiss notification.
     *
     * @var        string
     */
    static $DISMISS_COOKIE = 'crumina_notice_dismissed';

    /**
     * Option username database slug
     *
     * @var        string
     */
    static $OPTIONS_SLUG = 'crumina_activate_options';

    /**
     * Option username database slug
     *
     * @var        string
     */
    static $OPTION_USERNAME_SLUG = 'envato_username';

    /**
     * Option apikey database slug
     *
     * @var        string
     */
    static $OPTION_APIKEY_SLUG = 'envato_apikey';

    /**
     * Option apikey database slug
     *
     * @var        string
     */
    static $OPTION_REVOKE_SLUG = 'crumina_envato_revoke';

    /**
     * Option update token
     *
     * @var        string
     */
    static $OPTION_UPDATE_TOKEN_SLUG = 'crumina_update_token';

    /**
     * Option page slug
     *
     * @var        string
     */
    static $PAGE_SLUG = 'crumina_activate_theme';

    public $isNoticed = false;

    public function _init() {
        return; //Disable plugin
        
        if ( !class_exists( "Envato_Protected_API" ) ) {
            require_once $this->locate_path( '/inc/class-envato-protected-api.php' );
        }

        // Check credentials data
        if ( !self::getToken() || !self::getApikey() || !self::getUsername() ) {
            $this->activationNotice();
        }

        // Add admin activation page
        add_action( 'admin_menu', array( $this, 'adminMenu' ) );

        // Register activation form fields and redirect to activate page if needed
        add_action( 'admin_init', array( $this, 'adminInit' ) );

        // Enqueue scripts
        add_action( 'admin_enqueue_scripts', array( $this, 'enqueueScripts' ) );

        // Check for updates
        add_filter( "pre_set_site_transient_update_themes", array( $this, 'checkUpdates' ) );
    }

    /**
     * Run functions in admin init
     */
    public function adminInit() {
        $this->registerFormFields();
        $this->redirectToActivate();
    }

    public function adminMenu() {
        add_submenu_page( 'themes.php', __( 'Activate Theme', 'fw' ), __( 'Activate Theme', 'fw' ), 'administrator', self::$PAGE_SLUG, array( $this, 'renderPageTemplate' ) );
    }

    /**
     * Admin enqueue scripts
     */
    public function enqueueScripts() {
        wp_enqueue_style( 'crumina-update-checker', $this->locate_URI( '/static/css/styles.css' ), false, $this->manifest->get_version() );
        wp_enqueue_script( 'crumina-update-checker', $this->locate_URI( '/static/js/scripts.js' ), false, $this->manifest->get_version() );
    }

    /**
     * Show activation notice if token is not found
     */
    public function activationNotice() {
        if ( $this->isNoticed || filter_input( INPUT_COOKIE, self::$DISMISS_COOKIE ) ) {
            return;
        }

        add_action( 'admin_notices', function () {
            echo '<div class="notice notice-error is-dismissible" onclick="setCookie(\'' . self::$DISMISS_COOKIE . '\', 1, 30)"><p>' . __( 'Check theme activation. To get automatic updates and other features.', 'fw' );
            echo ' <a href="' . add_query_arg( array(
                'page' => self::$PAGE_SLUG,
            ), admin_url( 'admin.php' ) ) . '" class="button button-primary">' . __( 'Activate Theme', 'fw' ) . '</a>';
            echo '</p></div>';
        } );

        $this->isNoticed = true;
    }

    /**
     * Validate Credentials
     */
    public function validateCredentials( $credentials = '' ) {
        $username = isset( $credentials[ 'envato_username' ] ) ? $credentials[ 'envato_username' ] : '';
        $apikey   = isset( $credentials[ 'envato_apikey' ] ) ? $credentials[ 'envato_apikey' ] : '';

        $api     = new Envato_Protected_API( $username, $apikey );
        add_filter( "http_request_args", array( &$this, "httpTimeout" ), 10, 1 );
        $account = $api->private_user_data( 'account' );
        remove_filter( "http_request_args", array( &$this, "httpTimeout" ) );

        if ( $api->api_errors() ) {
            self::removeToken();
        } else {
            self::setToken( md5( $apikey ) );
        }
        delete_transient( 'update_themes' );
        return $credentials;
    }

    /**
     * Check updates on Envato
     */
    public function checkUpdates( $updates ) {
        if ( !isset( $updates->checked ) ) {
            return $updates;
        }

        $username = apply_filters( "crumina_themes_update_username", self::getUsername() );
        $apikey   = apply_filters( "crumina_themes_updater_apikey", self::getApikey() );
        $authors  = apply_filters( "crumina_themes_updater_authors", null );

        if ( isset( $authors ) && !is_array( $authors ) ) {
            $authors = array( $authors );
        }

        if ( empty( $username ) || empty( $apikey ) ) {
            $this->activationNotice();
            return $updates;
        }

        $api       = new Envato_Protected_API( $username, $apikey );
        add_filter( "http_request_args", array( &$this, "httpTimeout" ), 10, 1 );
        $purchased = $api->wp_list_themes( true );

        if ( $api->api_errors() ) {
            $this->activationNotice();
            return $updates;
        }


        $installed = function_exists( "wp_get_themes" ) ? wp_get_themes() : get_themes();
        $filtered  = array();

        foreach ( $installed as $theme ) {
            if ( $authors && !in_array( $theme->{'Author Name'}, $authors ) )
                continue;
            $filtered[ $theme->Name ] = $theme;
        }

        foreach ( $purchased as $theme ) {
            if ( isset( $filtered[ $theme->theme_name ] ) ) {
                // gotcha, compare version now
                $current = $filtered[ $theme->theme_name ];
                if ( version_compare( $current->Version, $theme->version, '<' ) ) {
                    // bingo, inject the update
                    if ( $url = $api->wp_download( $theme->item_id ) ) {
                        $update = array(
                            "url"         => "http://themeforest.net/item/theme/{$theme->item_id}",
                            "new_version" => $theme->version,
                            "package"     => $url
                        );

                        $updates->response[ $current->Stylesheet ] = $update;
                    }
                }
            }
        }

        remove_filter( "http_request_args", array( &$this, "httpTimeout" ) );

        return $updates;
    }

    /**
     * Gets the token from WP Options Table
     *
     * @return     string.
     */
    static function getToken() {
        return get_option( self::$OPTION_UPDATE_TOKEN_SLUG, '' );
    }

    /**
     * Save the token to WP Options Table
     */
    static function setToken( $token = '' ) {
        return update_option( self::$OPTION_UPDATE_TOKEN_SLUG, $token );
    }

    /**
     * Remove the token from WP Options Table
     */
    static function removeToken() {
        return delete_option( self::$OPTION_UPDATE_TOKEN_SLUG );
    }

    /**
     * Gets the username from WP Options Table
     *
     * @return     string.
     */
    static function getUsername() {
        $options = get_option( self::$OPTIONS_SLUG, '' );
        return isset( $options[ self::$OPTION_USERNAME_SLUG ] ) ? $options[ self::$OPTION_USERNAME_SLUG ] : '';
    }

    /**
     * Gets the apikey from WP Options Table
     *
     * @return     string.
     */
    static function getApikey() {
        $options = get_option( self::$OPTIONS_SLUG, '' );
        return isset( $options[ self::$OPTION_APIKEY_SLUG ] ) ? $options[ self::$OPTION_APIKEY_SLUG ] : '';
    }

    /**
     * Redirect to activate page if needed
     */
    public function redirectToActivate() {
        $redirected = filter_input( INPUT_COOKIE, self::$REDIRECTED_COOKIE );

        if ( !$redirected && !self::getToken() && is_admin() && !wp_doing_ajax() ) {
            setcookie( self::$REDIRECTED_COOKIE, 1, time() + 604800 );

            wp_safe_redirect( add_query_arg( array(
                'page' => self::$PAGE_SLUG,
            ), admin_url( 'admin.php' ) ) );
            exit;
        }
    }

    /**
     * Register activation form fields
     */
    public function registerFormFields() {
        register_setting( self::$OPTION_REVOKE_SLUG, self::$OPTION_REVOKE_SLUG, array( $this, 'revokeEnvatoOptions' ) );
        register_setting( self::$OPTIONS_SLUG, self::$OPTIONS_SLUG, array( $this, 'validateCredentials' ) );

        add_settings_field( self::$OPTION_APIKEY_SLUG, __( 'Envato apikey', 'fw' ), function() {
            
        }, self::$PAGE_SLUG );

        add_settings_field( self::$OPTION_USERNAME_SLUG, __( 'Envato username', 'fw' ), function() {
            
        }, self::$PAGE_SLUG );
    }

    /**
     * Revoke activation code
     */
    public function revokeEnvatoOptions( $revoke ) {
        self::removeToken();
        delete_transient( 'update_themes' );
        delete_option( self::$OPTIONS_SLUG );

        return $revoke;
    }

    /**
     * Get Status
     */
    public function getActivateStatus( $token = '', $username = '', $apikey = '' ) {
        $status = array(
            'activated' => false,
            'color'     => '#f00',
            'msg'       => __( 'Your theme is not activated!' )
        );

        if ( !$token && ($username || $apikey) ) {
            $status = array(
                'activated' => false,
                'color'     => '#f00',
                'msg'       => __( 'Your credentials is incorrect!' )
            );
        }

        if ( $token && $username && $apikey ) {
            $status = array(
                'activated' => true,
                'color'     => '#336600',
                'msg'       => __( 'Your theme is activated!' )
            );
        }

        return $status;
    }

    /*
     * Increase timeout for api request
     */

    public function httpTimeout( $req ) {
        $req[ "timeout" ] = 300;
        return $req;
    }

    /**
     * Render option page template
     */
    public function renderPageTemplate() {
        $option_revoke_slug   = self::$OPTION_REVOKE_SLUG;
        $option_apikey_slug   = self::$OPTION_APIKEY_SLUG;
        $option_username_slug = self::$OPTION_USERNAME_SLUG;
        $options_slug         = self::$OPTIONS_SLUG;
        $logo                 = $this->get_config( 'logo-url' );
        $logo_item            = $this->get_config( 'logo-item-url' );
        $img_path             = $this->locate_URI( '/static/img' );
        $view_path            = $this->locate_path( '/views/activate-page.php' );
        $token                = self::getToken();
        $username             = self::getUsername();
        $apikey               = self::getApikey();
        $status               = $this->getActivateStatus( $token, $username, $apikey );
        $theme                = wp_get_theme();

        echo fw_render_view( $view_path, compact( 'logo', 'logo_item', 'img_path', 'view_path', 'option_revoke_slug', 'option_apikey_slug', 'option_username_slug', 'options_slug', 'token', 'username', 'apikey', 'theme', 'status' ) );
    }

}
