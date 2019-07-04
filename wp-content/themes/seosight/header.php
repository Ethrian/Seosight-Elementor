<?php
/**
 * The header for our theme.
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link    https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Seosight
 */
$website_preloader = '';
$website_preloader  = function_exists( 'fw_get_db_customizer_option' ) ? fw_get_db_customizer_option( 'website_preloader', false ) : false;

?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
    <head>
        <meta charset="<?php bloginfo( 'charset' ); ?>">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="profile" href="http://gmpg.org/xfn/11">
        <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
		<?php wp_head(); ?>
    </head>
<body <?php body_class(); ?>>
<?php if (true === $website_preloader){
	$preloader_bg = get_template_directory_uri().'/svg/preload.svg';
	echo fw_html_tag( 'div', array( 'id'    => 'hellopreloader',
	), true );
} ?>
<?php if ( ! is_page_template( 'landing-template.php' ) ) {
// Options Variables
	$queried_object        = get_queried_object();
	$header_class          = $header_style = $custom_menu = $header_absolute = $header_animation = $sticky_atts = $sticky_pinned = $sticky_unpinned = $website_preloader ='';
	$header_class          = 'header';
	$page_id               = get_the_ID();
	$show_aside            = function_exists( 'fw_get_db_customizer_option' ) ? fw_get_db_customizer_option( 'aside-panel/value', false ) : false;
	$show_stunning         = function_exists( 'fw_get_db_customizer_option' ) ? fw_get_db_customizer_option( 'stunning-show/value', 'yes' ) : 'yes';
	$show_top_bar          = function_exists( 'fw_get_db_customizer_option' ) && fw_get_db_customizer_option( 'sections-top-bar/status' ) === 'show';
	$sticky_header_desktop = function_exists( 'fw_get_db_customizer_option' ) ? fw_get_db_customizer_option( 'sticky_header_desktop', true ) : true;
	$sticky_header_mobile  = function_exists( 'fw_get_db_customizer_option' ) ? fw_get_db_customizer_option( 'sticky_header_mobile', false ) : false;

	if ( ! $sticky_header_desktop && ! $sticky_header_mobile ) {
		$header_class .= ' header-absolute disable-sticky';
	} else {
		$header_animation = function_exists( 'fw_get_db_customizer_option' ) ? fw_get_db_customizer_option( 'sticky_header_style', 'swing' ) : 'swing';

		switch ( $header_animation ) {
			case 'swing':
				$sticky_pinned   = 'swingInX';
				$sticky_unpinned = 'swingOutX';
				break;
			case 'slide':
				$sticky_pinned   = 'slideDown';
				$sticky_unpinned = 'slideUp';
				break;
			case 'flip':
				$sticky_pinned   = 'flipInX';
				$sticky_unpinned = 'flipOutX';
				break;
			case 'bounce':
				$sticky_pinned   = 'bounceInDown';
				$sticky_unpinned = 'bounceOutUp';
				break;
			case 'none':
				$sticky_pinned   = '';
				$sticky_unpinned = '';
				break;
			default:
				$sticky_pinned   = 'swingInX';
				$sticky_unpinned = 'swingOutX';
		}
	}

	if ( function_exists( 'fw_get_db_post_option' ) ) {
		if ( is_page() || is_singular( 'post' ) || is_singular( 'fw-portfolio' ) ) {
			$metabox_aside        = fw_get_db_post_option( $page_id, 'aside-panel', 'default' );
			$show_aside           = ( 'default' !== $metabox_aside ) ? $metabox_aside : $show_aside;
			$enable_customization = fw_get_db_post_option( $page_id, 'custom-header/enable', 'no' );
			if ( 'yes' === $enable_customization ) {
				$header_absolute = fw_get_db_post_option( $page_id, 'custom-header/yes/header-absolute', false );
				$font_color      = fw_get_db_post_option( $page_id, 'custom-header/yes/header-color', '' );
				if ( true === $header_absolute ) {
					$header_class .= ' header-absolute';
				}
				if ( ! empty( $font_color ) ) {
					$header_class .= ' header-color-inherit';
				}
				$custom_menu = fw_get_db_post_option( $page_id, 'custom-header/yes/select_menu', '' );
			}
			$stunning_customization = fw_get_db_post_option( $page_id, 'custom-stunning/enable', 'no' );

			if ( 'yes' === $stunning_customization ) {
				$show_stunning = fw_get_db_post_option( $page_id, 'custom-stunning/yes/stunning-show/value', 'yes' );
			}
		} elseif ( function_exists( 'fw_get_db_term_option' ) && is_tax() && 'fw-portfolio-category' === $queried_object->taxonomy ) {
			$stunning_customization = fw_get_db_term_option( $queried_object->term_id, $queried_object->taxonomy, 'custom-stunning/enable', 'no' );

			if ( 'yes' === $stunning_customization ) {
				$show_stunning = fw_get_db_term_option( $queried_object->term_id, $queried_object->taxonomy, 'custom-stunning/yes/stunning-show/value', 'yes' );
			}
		}
	}

	set_query_var( 'show_stunning', $show_stunning );


	if ( true === $show_top_bar ) {
		$header_class .= ' header-top-bar';
	}

	if ( true === $sticky_header_desktop ) {
		$header_class .= ' header-sticky-desktop';
	}

	if ( true === $sticky_header_mobile ) {
		$header_class .= ' header-sticky-mobile';
	}


	$menu_args = array(
		'menu'           => $custom_menu,
		'theme_location' => 'primary',
		'menu_id'        => 'primary-menu',
		'menu_class'     => 'primary-menu-menu',
		'container'      => 'ul',
		'fallback_cb'    => 'seosight_menu_fallback'
	);

	if ( class_exists( 'Seosight_Mega_Menu_Custom_Walker' ) ) {
		$menu_args['walker'] = new Seosight_Mega_Menu_Custom_Walker();
	} ?>

    <a class="skip-link screen-reader-text" href="#primary"><?php esc_html_e( 'Skip to content', 'seosight' ); ?></a>
    <!-- Header -->

    <header class="<?php echo esc_attr( $header_class ) ?>" id="site-header"
            data-pinned="<?php echo esc_attr( $sticky_pinned ) ?>"
            data-unpinned="<?php echo esc_attr( $sticky_unpinned ) ?>">
		<?php
		if ( $show_top_bar ) {
			get_template_part( 'template-parts/top-bar' );
		}
		?>
        <div class="container">
            <div class="header-content-wrapper">
				<?php if ( $show_top_bar ) {
					echo '<div id="top-bar-js" class="top-bar-link"><i class="fa fa-arrow-down"></i></div>';
				} ?>
                <div class="logo">
					<?php seosight_logo(); ?>
                </div>

                <nav class="primary-menu">

                    <!-- menu-icon-wrapper -->
                    <a href='javascript:void(0)' id="menu-icon-trigger" class="menu-icon-trigger showhide">
                        <span class="mob-menu--title"><?php esc_html_e( 'Menu', 'seosight' ); ?></span>
                        <span id="menu-icon-wrapper" class="menu-icon-wrapper">
                            <svg width="1000px" height="1000px">
                                <path id="pathD"
                                      d="M 300 400 L 700 400 C 900 400 900 750 600 850 A 400 400 0 0 1 200 200 L 800 800"></path>
                                <path id="pathE" d="M 300 500 L 700 500"></path>
                                <path id="pathF"
                                      d="M 700 600 L 300 600 C 100 600 100 200 400 150 A 400 380 0 1 1 200 800 L 800 200"></path>
                            </svg>
                        </span>
                    </a>

					<?php seosight_additional_nav(); ?>

					<?php wp_nav_menu( $menu_args ); ?>

                </nav>

				<?php
				if ( 'yes' === $show_aside ) {
					$on_mobile            = fw_get_db_customizer_option( 'aside-panel/yes/mobile', false );
					$custom_icon          = fw_akg( 'url', fw_get_db_customizer_option( 'aside-panel/yes/icon', array() ), '' );
					$open_aside_btn_class = true === $on_mobile ? 'user-menu enable-mobile open-overlay' : 'user-menu open-overlay';
					?>
                    <div class="<?php echo esc_attr( $open_aside_btn_class ) ?>">
                        <a href="#" class="user-menu-content  js-open-aside">
							<?php if ( $custom_icon ) { ?>
                                <img src="<?php echo esc_attr( $custom_icon ); ?>" alt="Menu icon">
							<?php } else { ?>
                                <span></span>
                                <span></span>
                                <span></span>
							<?php } ?>
                        </a>
                    </div>
				<?php } ?>

            </div>
        </div>
    </header>
	<?php
	if ( $show_top_bar ) {
		get_template_part( 'template-parts/top-bar' );
	}
	if ( $header_absolute !== true ) {
		echo '<div id="header-spacer" class="header-spacer"></div>';
	} ?>

    <!-- ... End Header -->
	<?php
	if ( 'yes' === $show_aside ) {
		get_template_part( 'template-parts/panel', 'aside' );
	} ?>
    <div class="content-wrapper">

    <?php if ( 'yes' === $show_stunning && ! is_404() ) {
		get_template_part( 'template-parts/stunning', 'header' );
	}
}