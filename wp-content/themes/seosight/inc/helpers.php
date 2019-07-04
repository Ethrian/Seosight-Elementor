<?php
if ( !defined( 'ABSPATH' ) ) {
	die( 'Direct access forbidden.' );
}
/**
 * Helper functions and classes with static methods for usage in theme
 */

/**
 * Callback function will be displayed if main menu is empty.
 *
 */
function seosight_menu_fallback() {

	$output	 = '<ul class="primary-menu-menu"><li><div class="no-menu-box">';
	// Translators 1: Link to Menus, 2: Link to Customize
	$output	 .= sprintf( esc_attr__( 'Please assign a menu to the primary menu location under %1$s or %2$s the design.', 'seosight' ),
			sprintf( wp_kses( __( '<a href="%s">Menus</a>', 'seosight' ), array( 'a' => array( 'href' => array() ) ) ),
					get_admin_url( get_current_blog_id(), 'nav-menus.php' )
			),
			sprintf( wp_kses( __( '<a href="%s">Customize</a>', 'seosight' ), array( 'a' => array( 'href' => array() ) ) ),
					get_admin_url( get_current_blog_id(), 'customize.php' )
			)
	);
	$output	 .= '</div></li></ul>';

	seosight_render( $output );
}

/**
 * Register Lato Google font.
 *
 * @return string
 */
function seosight_font_url() {
	$font_families	 = array();
		
	if ( function_exists( 'fw_get_db_customizer_option' ) ) {
		$tags			 = array( 'body', 'h1', 'h2', 'h3', 'h4', 'h5', 'h6', 'nav' );
		foreach ( $tags as $single_tag ) {

			$font_options = wp_parse_args( fw_get_db_customizer_option( 'typography_' . $single_tag, array() ), array(
				'google_font'	 => '',
				'subset'		 => '',
				'variation'		 => '',
				'family'		 => '',
				'style'			 => '',
				'weight'		 => '',
				'size'			 => '',
				'line-height'	 => '',
				'letter-spacing' => '',
				'color'			 => '',
					) );

			if ( $font_options[ 'family' ] && $font_options[ 'google_font' ] ) {
				$font_families[] = $font_options[ 'family' ] . ':' . $font_options[ 'variation' ] . '&subset=' . $font_options[ 'subset' ] . '';
			} else {
				$font_families[] = 'Varela+Round';
			}
		}
	}

	if ( !count( $font_families ) ) {
		$font_families[] = 'Varela+Round';
	}

	$custom_google_fonts = implode( '|', $font_families );
	$font_url			 = esc_url( add_query_arg( 'family', urlencode( $custom_google_fonts ),
					"//fonts.googleapis.com/css" ) );
	$font_url			 = str_replace( '%2B', '+', $font_url );

	return $font_url;
}

if ( !function_exists( 'seosight_paging_nav' ) ) :

	/**
	 * Display navigation to next/previous set of posts when applicable.
	 *
	 * @param array $wp_query WordPress query.
	 */
	function seosight_paging_nav( $wp_query = null ) {

		if ( !$wp_query ) {
			$wp_query = $GLOBALS[ 'wp_query' ];
		}

		// Don't print empty markup if there's only one page.
		if ( $wp_query->max_num_pages < 2 ) {
			return;
		}

		$paged			 = get_query_var( 'paged' ) ? intval( get_query_var( 'paged' ) ) : 1;
		$pagenum_link	 = html_entity_decode( get_pagenum_link() );
		$query_args		 = array();
		$url_parts		 = explode( '?', $pagenum_link );

		if ( isset( $url_parts[ 1 ] ) ) {
			wp_parse_str( $url_parts[ 1 ], $query_args );
		}

		$pagenum_link	 = remove_query_arg( array_keys( $query_args ), $pagenum_link );
		$pagenum_link	 = trailingslashit( $pagenum_link ) . '%_%';

		$format	 = $GLOBALS[ 'wp_rewrite' ]->using_index_permalinks() && !strpos( $pagenum_link, 'index.php' ) ? 'index.php/' : '';
		$format	 .= $GLOBALS[ 'wp_rewrite' ]->using_permalinks() ? user_trailingslashit( 'page/%#%', 'paged' ) : '?paged=%#%';

		// Set up paginated links.
		$links = paginate_links( array(
			'base'		 => $pagenum_link,
			'format'	 => $format,
			'total'		 => $wp_query->max_num_pages,
			'current'	 => $paged,
			'mid_size'	 => 3,
			'add_args'	 => array_map( 'urlencode', $query_args ),
			'prev_text'	 => '<svg class="btn-prev"><use xlink:href="#arrow-left"></use></svg>',
			'next_text'	 => '<svg class="btn-next"><use xlink:href="#arrow-right"></use></svg>',
				) );

		if ( $links ) :
			$links = str_replace( 'class=\'page-numbers', 'class=\'page-numbers bg-border-color', $links );
			?>
			<h5 class="screen-reader-text"><?php esc_html_e( 'Posts pagination', 'seosight' ); ?></h5>
			<div class="row">
				<div class="col-lg-12">
					<nav class="navigation">
						<?php seosight_render( $links ); ?>
					</nav>
				</div>
			</div>
			<?php
		endif;
	}

endif;
if ( !function_exists( 'seosight_ajax_loadmore' ) ) :

	/**
	 * include localized js file for ajax pagination
	 *
	 * @param array|null $wp_query WordPress query.
	 * @param string $container_id Id of div to append items
	 */
	function seosight_ajax_loadmore( $wp_query = null, $container_id = 'portfolio-loop' ) {
		if ( !$wp_query ) {
			$wp_query = $GLOBALS[ 'wp_query' ];
		}

		// Don't print empty markup if there's only one page.
		if ( $wp_query->max_num_pages < 2 ) {
			return;
		}

		$paged			 = get_query_var( 'paged' ) ? intval( get_query_var( 'paged' ) ) : 1;
		$max_num_pages	 = $wp_query->max_num_pages;

		wp_enqueue_script( 'seosight-loadmore' );
		wp_localize_script(
				'seosight-loadmore',
				'pagination_data',
				array(
					'startPage'	 => $paged,
					'maxPages'	 => $max_num_pages,
					'loadedText' => esc_html__( 'Loaded all', 'seosight' ),
					'container'	 => $container_id
				)
		);
		?>

		<a href="#" class="load-more" id="load-more-button" data-load-link="<?php echo esc_url( next_posts( $max_num_pages, false ) ) ?>" data-container="<?php esc_attr( $container_id ) ?>">
			<span class="load-more-img-wrap"><?php get_template_part( 'svg/load-more-line.svg' ); ?></span>
			<span class="load-more-text"><?php esc_html_e( 'Load more', 'seosight' ); ?></span>
		</a>

		<?php
	}

endif;


if ( !function_exists( 'seosight_backgrounds' ) ):

	/**
	 * Return List of backgrounds patterns.
	 *
	 * @return array
	 */
	function seosight_backgrounds() {
		$background_image[ 'none' ] = array(
			'icon'	 => get_template_directory_uri() . '/images/thumb/bg-0.png',
			'css'	 => array(
				'background-image' => 'none'
			),
		);
		for ( $i = 1; $i < 22; $i ++ ) {
			$background_image[ 'bg-' . $i . '' ] = array(
				'icon'	 => get_template_directory_uri() . '/images/thumb/bg-' . $i . '.png',
				'css'	 => array(
					'background-image' => 'url("' . get_template_directory_uri() . '/images/bg-' . $i . '.png' . '")'
				),
			);
		}

		return $background_image;
	}

endif;


if ( !function_exists( 'seosight_get_menus' ) ) :

	/**
	 * Get array with menus for theme options
	 *
	 * @return array
	 */
	function seosight_get_menus() {
		$menus_list	 = array( '' => '--------------' );
		$menus		 = get_terms( 'nav_menu', array( 'hide_empty' => true ) );
		if ( is_array( $menus ) ) {
			foreach ( $menus as $menu_instance ) {
				$menus_list[ $menu_instance->term_id ] = $menu_instance->name;
			}
		}

		return $menus_list;
	}

endif;



if ( !function_exists( 'seosight_user_social_networks' ) ) {

	/**
	 * List of aviable social networks for user fields.
	 *
	 * @return array
	 */
	function seosight_user_social_networks() {
		$socials = array(
			'twitter'	 => array(
				'label'	 => 'Twitter',
				'icon'	 => 'fa fa-twitter',
			),
			'facebook'	 => array(
				'label'	 => 'Facebook',
				'icon'	 => 'fa fa-facebook',
			),
			'google'	 => array(
				'label'	 => 'Google +',
				'icon'	 => 'fa fa-google-plus',
			),
			'pinterest'	 => array(
				'label'	 => 'Pinterest',
				'icon'	 => 'fa fa-pinterest-p',
			),
			'linkedin'	 => array(
				'label'	 => 'Linkedin',
				'icon'	 => 'fa fa-linkedin',
			),
			'youtube'	 => array(
				'label'	 => 'YouTube',
				'icon'	 => 'fa fa-youtube',
			),
			'instagram'	 => array(
				'label'	 => 'Instagram',
				'icon'	 => 'fa fa-instagram',
			),
			'vk'		 => array(
				'label'	 => 'Vkontakte',
				'icon'	 => 'fa fa-vk',
			),
		);
		return $socials;
	}

}

if ( !function_exists( 'seosight_sidebar_conf' ) ) {

	/**
	 * Return classes for content / sidebar positions.
	 *
	 * @return array
	 */
	function seosight_sidebar_conf() {

		$sidebar_width_classes	 = 'col-lg-3 col-md-4 col-sm-12';
		$content_width_classes	 = 'col-lg-12 col-md-12 col-sm-12';
		$current_position		 = 'full';

		if ( function_exists( 'fw_get_db_customizer_option' ) ) {
			$width = fw_get_db_customizer_option( 'sidebar_width', 'narrow' );
			if ( 'narrow' === $width ) {
				$sidebar_width_right = 'col-lg-3 col-lg-offset-1';
				$sidebar_width_left	 = 'col-lg-3';
			} else {
				$sidebar_width_right = 'col-lg-4';
				$sidebar_width_left	 = 'col-lg-4';
			}
		} else {
			$sidebar_width_right = 'col-lg-3 col-lg-offset-1';
			$sidebar_width_left	 = 'col-lg-3';
		}


		if ( function_exists( 'fw_ext_sidebars_get_current_position' ) ) {
			$current_position = fw_ext_sidebars_get_current_position();
			if ( 'right' === $current_position ) {
				$content_width_classes	 = 'col-lg-8 col-md-8 col-sm-12';
				$sidebar_width_classes	 = $sidebar_width_right . ' col-md-4 col-sm-12';
			} elseif ( 'left' === $current_position ) {
				$content_width_classes	 .= ' col-lg-push-4 col-md-push-4 col-lg-8 col-md-8 col-sm-12';
				$sidebar_width_classes	 = $sidebar_width_left . ' col-lg-pull-8 col-md-pull-8  col-md-4 col-sm-12';
			} else {
				$current_position = 'full';
			}
		}

		return array(
			'content-classes'	 => $content_width_classes,
			'sidebar-classes'	 => $sidebar_width_classes,
			'position'			 => $current_position
		);
	}

}

if ( !function_exists( 'seosight_gen_link_for_shortcode' ) ) :

	/**
	 * Generate link from block options
	 *
	 * @param array $atts Shortcode options
	 *
	 * @return array
	 */
	function seosight_gen_link_for_shortcode( $atts ) {
		$link_source = fw_akg( 'link/selected/selected', $atts, '' );
		if ( 'page' === $link_source ) {
			$link = get_permalink( fw_akg( 'link/selected/page/link/0', $atts, '' ) );
		} else {
			$link = fw_akg( 'link/selected/url/link', $atts, '' );
		}
		$target = fw_akg( 'link/target', $atts, '_self' );

		$url[ 'link' ]	 = $link;
		$url[ 'target' ] = $target;

		return $url;
	}

endif;

if ( !function_exists( 'seosight_social_network_icons()' ) ) :

	/**
	 * List of social networks names with file names for options;
	 *
	 * @return array
	 */
	function seosight_social_network_icons() {
		$networks = array(
			'amazon.svg'			 => 'Amazon',
			'behance.svg'			 => 'Behance',
			'bing.svg'				 => 'Bing',
			'creative-market.svg'	 => 'Creative Market',
			'deviantart.svg'		 => 'Deviantart',
			'dribbble.svg'			 => 'Dribbble',
			'dropbox.svg'			 => 'Dropbox',
			'envato.svg'			 => 'Envato',
			'facebook.svg'			 => 'Facebook',
			'flickr.svg'			 => 'Flickr',
			'google-plus.svg'		 => 'Google+',
			'instagram.svg'			 => 'Instagram',
			'kickstarter.svg'		 => 'Kickstarter',
			'linkedin.svg'			 => 'Linkedin',
			'medium.svg'			 => 'Medium',
			'periscope.svg'			 => 'Periscope',
			'pinterest.svg'			 => 'Pinterest',
			'quora.svg'				 => 'Quora',
			'reddit.svg'			 => 'Reddit',
			'shutterstock.svg'		 => 'Shutterstock',
			'skype.svg'				 => 'Skype',
			'slack.svg'				 => 'Slack',
			'snapchat.svg'			 => 'Snapchat',
			'soundcloud.svg'		 => 'Soundcloud',
			'spotify.svg'			 => 'Spotify',
			'trello.svg'			 => 'Trello',
			'telegram.svg'			 => 'Telegram',
			'tumblr.svg'			 => 'Tumblr',
			'twitter.svg'			 => 'Twitter',
			'vimeo.svg'				 => 'Vimeo',
			'vk.svg'				 => 'VK.com',
			'whatsapp.svg'			 => 'Whatsapp',
			'wikipedia.svg'			 => 'Wikipedia',
			'wordpress.svg'			 => 'WordPress',
			'youtube.svg'			 => 'Youtube',
		);

		return $networks;
	}

endif;


if ( !function_exists( 'seosight_button_colors' ) ) :

	/**
	 * List of button color variations for options;
	 *
	 * @return array
	 */
	function seosight_button_colors() {
		$colors = array(
			'primary'		 => esc_html__( 'Primary color', 'seosight' ),
			'secondary'		 => esc_html__( 'Secondary color', 'seosight' ),
			'white'			 => esc_html__( 'White', 'seosight' ),
			'dark'			 => esc_html__( 'Dark', 'seosight' ),
			'gray'			 => esc_html__( 'Gray', 'seosight' ),
			'blue'			 => esc_html__( 'Blue', 'seosight' ),
			'purple'		 => esc_html__( 'Purple', 'seosight' ),
			'breez'			 => esc_html__( 'Breez', 'seosight' ),
			'orange'		 => esc_html__( 'Orange', 'seosight' ),
			'yellow'		 => esc_html__( 'Yellow', 'seosight' ),
			'green'			 => esc_html__( 'Green', 'seosight' ),
			'dark-gray'		 => esc_html__( 'Dark gray', 'seosight' ),
			'brown'			 => esc_html__( 'Brown', 'seosight' ),
			'rose'			 => esc_html__( 'Rose', 'seosight' ),
			'violet'		 => esc_html__( 'Violet', 'seosight' ),
			'olive'			 => esc_html__( 'Olive', 'seosight' ),
			'light-green'	 => esc_html__( 'Light green', 'seosight' ),
			'dark-blue'		 => esc_html__( 'Dark blue', 'seosight' ),
		);

		return $colors;
	}

endif;

if ( !function_exists( '_seosight_google_map_custom_styles' ) ) {

	/**
	 * Custom styles for map shortcode
	 *
	 * @return array
	 */
	function _seosight_google_map_custom_styles() {
		return array(
			'default'			 => array(
				esc_html__( "Default", 'seosight' ),
				""
			),
			'dark'				 => array(
				esc_html__( "Dark", 'seosight' ),
				"[{'featureType':'all','elementType':'labels.text.fill','stylers':[{'saturation':36},{'color':'#000000'},{'lightness':40}]},{'featureType':'all','elementType':'labels.text.stroke','stylers':[{'visibility':'on'},{'color':'#000000'},{'lightness':16}]},{'featureType':'all','elementType':'labels.icon','stylers':[{'visibility':'off'}]},{'featureType':'administrative','elementType':'geometry.fill','stylers':[{'color':'#000000'},{'lightness':20}]},{'featureType':'administrative','elementType':'geometry.stroke','stylers':[{'color':'#000000'},{'lightness':17},{'weight':1.2}]},{'featureType':'landscape','elementType':'geometry','stylers':[{'color':'#000000'},{'lightness':20}]},{'featureType':'poi','elementType':'geometry','stylers':[{'color':'#000000'},{'lightness':21}]},{'featureType':'road.highway','elementType':'geometry.fill','stylers':[{'color':'#000000'},{'lightness':17}]},{'featureType':'road.highway','elementType':'geometry.stroke','stylers':[{'color':'#000000'},{'lightness':29},{'weight':0.2}]},{'featureType':'road.arterial','elementType':'geometry','stylers':[{'color':'#000000'},{'lightness':18}]},{'featureType':'road.local','elementType':'geometry','stylers':[{'color':'#000000'},{'lightness':16}]},{'featureType':'transit','elementType':'geometry','stylers':[{'color':'#000000'},{'lightness':19}]},{'featureType':'water','elementType':'geometry','stylers':[{'color':'#000000'},{'lightness':17}]}]"
			),
			'omni'				 => array(
				esc_html__( "Omni", 'seosight' ),
				"[{'featureType':'landscape','stylers':[{'saturation':-100},{'lightness':65},{'visibility':'on'}]},{'featureType':'poi','stylers':[{'saturation':-100},{'lightness':51},{'visibility':'simplified'}]},{'featureType':'road.highway','stylers':[{'saturation':-100},{'visibility':'simplified'}]},{'featureType':'road.arterial','stylers':[{'saturation':-100},{'lightness':30},{'visibility':'on'}]},{'featureType':'road.local','stylers':[{'saturation':-100},{'lightness':40},{'visibility':'on'}]},{'featureType':'transit','stylers':[{'saturation':-100},{'visibility':'simplified'}]},{'featureType':'administrative.province','stylers':[{'visibility':'off'}]},{'featureType':'water','elementType':'labels','stylers':[{'visibility':'on'},{'lightness':-25},{'saturation':-100}]},{'featureType':'water','elementType':'geometry','stylers':[{'hue':'#ffff00'},{'lightness':-25},{'saturation':-97}]}]"
			),
			'coy-beauty'		 => array(
				esc_html__( "Coy Beauty", 'seosight' ),
				"[{'featureType':'all','elementType':'geometry.stroke','stylers':[{'visibility':'simplified'}]},{'featureType':'administrative','elementType':'all','stylers':[{'visibility':'off'}]},{'featureType':'administrative','elementType':'labels','stylers':[{'visibility':'simplified'},{'color':'#a31645'}]},{'featureType':'landscape','elementType':'all','stylers':[{'weight':'3.79'},{'visibility':'on'},{'color':'#ffecf0'}]},{'featureType':'landscape','elementType':'geometry','stylers':[{'visibility':'on'}]},{'featureType':'landscape','elementType':'geometry.stroke','stylers':[{'visibility':'on'}]},{'featureType':'poi','elementType':'all','stylers':[{'visibility':'simplified'},{'color':'#a31645'}]},{'featureType':'poi','elementType':'geometry','stylers':[{'saturation':'0'},{'lightness':'0'},{'visibility':'off'}]},{'featureType':'poi','elementType':'geometry.stroke','stylers':[{'visibility':'off'}]},{'featureType':'poi.business','elementType':'all','stylers':[{'visibility':'simplified'},{'color':'#d89ca8'}]},{'featureType':'poi.business','elementType':'geometry','stylers':[{'visibility':'on'}]},{'featureType':'poi.business','elementType':'geometry.fill','stylers':[{'visibility':'on'},{'saturation':'0'}]},{'featureType':'poi.business','elementType':'labels','stylers':[{'color':'#a31645'}]},{'featureType':'poi.business','elementType':'labels.icon','stylers':[{'visibility':'simplified'},{'lightness':'84'}]},{'featureType':'road','elementType':'all','stylers':[{'saturation':-100},{'lightness':45}]},{'featureType':'road.highway','elementType':'all','stylers':[{'visibility':'simplified'}]},{'featureType':'road.arterial','elementType':'labels.icon','stylers':[{'visibility':'off'}]},{'featureType':'transit','elementType':'all','stylers':[{'visibility':'off'}]},{'featureType':'water','elementType':'all','stylers':[{'color':'#d89ca8'},{'visibility':'on'}]},{'featureType':'water','elementType':'geometry.fill','stylers':[{'visibility':'on'},{'color':'#fedce3'}]},{'featureType':'water','elementType':'labels','stylers':[{'visibility':'off'}]}]"
			),
			'subtle-grayscale'	 => array(
				esc_html__( "Subtle Grayscale", 'seosight' ),
				"[{'featureType':'landscape','stylers':[{'saturation':-100},{'lightness':65},{'visibility':'on'}]},{'featureType':'poi','stylers':[{'saturation':-100},{'lightness':51},{'visibility':'simplified'}]},{'featureType':'road.highway','stylers':[{'saturation':-100},{'visibility':'simplified'}]},{'featureType':'road.arterial','stylers':[{'saturation':-100},{'lightness':30},{'visibility':'on'}]},{'featureType':'road.local','stylers':[{'saturation':-100},{'lightness':40},{'visibility':'on'}]},{'featureType':'transit','stylers':[{'saturation':-100},{'visibility':'simplified'}]},{'featureType':'administrative.province','stylers':[{'visibility':'off'}]},{'featureType':'water','elementType':'labels','stylers':[{'visibility':'on'},{'lightness':-25},{'saturation':-100}]},{'featureType':'water','elementType':'geometry','stylers':[{'hue':'#ffff00'},{'lightness':-25},{'saturation':-97}]}]"
			),
			'pale-dawn'			 => array(
				esc_html__( "Pale Dawn", 'seosight' ),
				"[{'featureType':'water','stylers':[{'visibility':'on'},{'color':'#acbcc9'}]},{'featureType':'landscape','stylers':[{'color':'#f2e5d4'}]},{'featureType':'road.highway','elementType':'geometry','stylers':[{'color':'#c5c6c6'}]},{'featureType':'road.arterial','elementType':'geometry','stylers':[{'color':'#e4d7c6'}]},{'featureType':'road.local','elementType':'geometry','stylers':[{'color':'#fbfaf7'}]},{'featureType':'poi.park','elementType':'geometry','stylers':[{'color':'#c5dac6'}]},{'featureType':'administrative','stylers':[{'visibility':'on'},{'lightness':33}]},{'featureType':'road'},{'featureType':'poi.park','elementType':'labels','stylers':[{'visibility':'on'},{'lightness':20}]},{},{'featureType':'road','stylers':[{'lightness':20}]}]"
			),
			'blue-water'		 => array(
				esc_html__( "Blue water", 'seosight' ),
				"[{'featureType':'water','stylers':[{'color':'#46bcec'},{'visibility':'on'}]},{'featureType':'landscape','stylers':[{'color':'#f2f2f2'}]},{'featureType':'road','stylers':[{'saturation':-100},{'lightness':45}]},{'featureType':'road.highway','stylers':[{'visibility':'simplified'}]},{'featureType':'road.arterial','elementType':'labels.icon','stylers':[{'visibility':'off'}]},{'featureType':'administrative','elementType':'labels.text.fill','stylers':[{'color':'#444444'}]},{'featureType':'transit','stylers':[{'visibility':'off'}]},{'featureType':'poi','stylers':[{'visibility':'off'}]}]"
			),
			'shades-of-grey'	 => array(
				esc_html__( "Shades of Grey", 'seosight' ),
				"[{'featureType':'water','elementType':'geometry','stylers':[{'color':'#000000'},{'lightness':17}]},{'featureType':'landscape','elementType':'geometry','stylers':[{'color':'#000000'},{'lightness':20}]},{'featureType':'road.highway','elementType':'geometry.fill','stylers':[{'color':'#000000'},{'lightness':17}]},{'featureType':'road.highway','elementType':'geometry.stroke','stylers':[{'color':'#000000'},{'lightness':29},{'weight':0.2}]},{'featureType':'road.arterial','elementType':'geometry','stylers':[{'color':'#000000'},{'lightness':18}]},{'featureType':'road.local','elementType':'geometry','stylers':[{'color':'#000000'},{'lightness':16}]},{'featureType':'poi','elementType':'geometry','stylers':[{'color':'#000000'},{'lightness':21}]},{'elementType':'labels.text.stroke','stylers':[{'visibility':'on'},{'color':'#000000'},{'lightness':16}]},{'elementType':'labels.text.fill','stylers':[{'saturation':36},{'color':'#000000'},{'lightness':40}]},{'elementType':'labels.icon','stylers':[{'visibility':'off'}]},{'featureType':'transit','elementType':'geometry','stylers':[{'color':'#000000'},{'lightness':19}]},{'featureType':'administrative','elementType':'geometry.fill','stylers':[{'color':'#000000'},{'lightness':20}]},{'featureType':'administrative','elementType':'geometry.stroke','stylers':[{'color':'#000000'},{'lightness':17},{'weight':1.2}]}]"
			),
			'midnight-commander' => array(
				esc_html__( "Midnight Commander", 'seosight' ),
				"[{'featureType':'water','stylers':[{'color':'#021019'}]},{'featureType':'landscape','stylers':[{'color':'#08304b'}]},{'featureType':'poi','elementType':'geometry','stylers':[{'color':'#0c4152'},{'lightness':5}]},{'featureType':'road.highway','elementType':'geometry.fill','stylers':[{'color':'#000000'}]},{'featureType':'road.highway','elementType':'geometry.stroke','stylers':[{'color':'#0b434f'},{'lightness':25}]},{'featureType':'road.arterial','elementType':'geometry.fill','stylers':[{'color':'#000000'}]},{'featureType':'road.arterial','elementType':'geometry.stroke','stylers':[{'color':'#0b3d51'},{'lightness':16}]},{'featureType':'road.local','elementType':'geometry','stylers':[{'color':'#000000'}]},{'elementType':'labels.text.fill','stylers':[{'color':'#ffffff'}]},{'elementType':'labels.text.stroke','stylers':[{'color':'#000000'},{'lightness':13}]},{'featureType':'transit','stylers':[{'color':'#146474'}]},{'featureType':'administrative','elementType':'geometry.fill','stylers':[{'color':'#000000'}]},{'featureType':'administrative','elementType':'geometry.stroke','stylers':[{'color':'#144b53'},{'lightness':14},{'weight':1.4}]}]"
			),
			'retro'				 => array(
				esc_html__( "Retro", 'seosight' ),
				"[{'featureType':'administrative','stylers':[{'visibility':'off'}]},{'featureType':'poi','stylers':[{'visibility':'simplified'}]},{'featureType':'road','elementType':'labels','stylers':[{'visibility':'simplified'}]},{'featureType':'water','stylers':[{'visibility':'simplified'}]},{'featureType':'transit','stylers':[{'visibility':'simplified'}]},{'featureType':'landscape','stylers':[{'visibility':'simplified'}]},{'featureType':'road.highway','stylers':[{'visibility':'off'}]},{'featureType':'road.local','stylers':[{'visibility':'on'}]},{'featureType':'road.highway','elementType':'geometry','stylers':[{'visibility':'on'}]},{'featureType':'water','stylers':[{'color':'#84afa3'},{'lightness':52}]},{'stylers':[{'saturation':-17},{'gamma':0.36}]},{'featureType':'transit.line','elementType':'geometry','stylers':[{'color':'#3f518c'}]}]"
			),
			'light-monochrome'	 => array(
				esc_html__( "Light Monochrome", 'seosight' ),
				"[{'featureType':'water','elementType':'all','stylers':[{'hue':'#e9ebed'},{'saturation':-78},{'lightness':67},{'visibility':'simplified'}]},{'featureType':'landscape','elementType':'all','stylers':[{'hue':'#ffffff'},{'saturation':-100},{'lightness':100},{'visibility':'simplified'}]},{'featureType':'road','elementType':'geometry','stylers':[{'hue':'#bbc0c4'},{'saturation':-93},{'lightness':31},{'visibility':'simplified'}]},{'featureType':'poi','elementType':'all','stylers':[{'hue':'#ffffff'},{'saturation':-100},{'lightness':100},{'visibility':'off'}]},{'featureType':'road.local','elementType':'geometry','stylers':[{'hue':'#e9ebed'},{'saturation':-90},{'lightness':-8},{'visibility':'simplified'}]},{'featureType':'transit','elementType':'all','stylers':[{'hue':'#e9ebed'},{'saturation':10},{'lightness':69},{'visibility':'on'}]},{'featureType':'administrative.locality','elementType':'all','stylers':[{'hue':'#2c2e33'},{'saturation':7},{'lightness':19},{'visibility':'on'}]},{'featureType':'road','elementType':'labels','stylers':[{'hue':'#bbc0c4'},{'saturation':-93},{'lightness':31},{'visibility':'on'}]},{'featureType':'road.arterial','elementType':'labels','stylers':[{'hue':'#bbc0c4'},{'saturation':-93},{'lightness':-2},{'visibility':'simplified'}]}]"
			),
			'paper'				 => array(
				esc_html__( "Paper", 'seosight' ),
				"[{'featureType':'administrative','stylers':[{'visibility':'off'}]},{'featureType':'poi','stylers':[{'visibility':'simplified'}]},{'featureType':'road','stylers':[{'visibility':'simplified'}]},{'featureType':'water','stylers':[{'visibility':'simplified'}]},{'featureType':'transit','stylers':[{'visibility':'simplified'}]},{'featureType':'landscape','stylers':[{'visibility':'simplified'}]},{'featureType':'road.highway','stylers':[{'visibility':'off'}]},{'featureType':'road.local','stylers':[{'visibility':'on'}]},{'featureType':'road.highway','elementType':'geometry','stylers':[{'visibility':'on'}]},{'featureType':'road.arterial','stylers':[{'visibility':'off'}]},{'featureType':'water','stylers':[{'color':'#5f94ff'},{'lightness':26},{'gamma':5.86}]},{},{'featureType':'road.highway','stylers':[{'weight':0.6},{'saturation':-85},{'lightness':61}]},{'featureType':'road'},{},{'featureType':'landscape','stylers':[{'hue':'#0066ff'},{'saturation':74},{'lightness':100}]}]"
			),
			'gowalla'			 => array(
				esc_html__( "Gowalla", 'seosight' ),
				"[{'featureType':'road','elementType':'labels','stylers':[{'visibility':'simplified'},{'lightness':20}]},{'featureType':'administrative.land_parcel','elementType':'all','stylers':[{'visibility':'off'}]},{'featureType':'landscape.man_made','elementType':'all','stylers':[{'visibility':'off'}]},{'featureType':'transit','elementType':'all','stylers':[{'visibility':'off'}]},{'featureType':'road.local','elementType':'labels','stylers':[{'visibility':'simplified'}]},{'featureType':'road.local','elementType':'geometry','stylers':[{'visibility':'simplified'}]},{'featureType':'road.highway','elementType':'labels','stylers':[{'visibility':'simplified'}]},{'featureType':'poi','elementType':'labels','stylers':[{'visibility':'off'}]},{'featureType':'road.arterial','elementType':'labels','stylers':[{'visibility':'off'}]},{'featureType':'water','elementType':'all','stylers':[{'hue':'#a1cdfc'},{'saturation':30},{'lightness':49}]},{'featureType':'road.highway','elementType':'geometry','stylers':[{'hue':'#f49935'}]},{'featureType':'road.arterial','elementType':'geometry','stylers':[{'hue':'#fad959'}]}]"
			),
			'greyscale'			 => array(
				esc_html__( "Greyscale", 'seosight' ),
				"[{'featureType':'all','stylers':[{'saturation':-100},{'gamma':0.5}]}]"
			),
			'apple-maps-esque'	 => array(
				esc_html__( "Apple Maps-esque", 'seosight' ),
				"[{'featureType':'water','elementType':'geometry','stylers':[{'color':'#a2daf2'}]},{'featureType':'landscape.man_made','elementType':'geometry','stylers':[{'color':'#f7f1df'}]},{'featureType':'landscape.natural','elementType':'geometry','stylers':[{'color':'#d0e3b4'}]},{'featureType':'landscape.natural.terrain','elementType':'geometry','stylers':[{'visibility':'off'}]},{'featureType':'poi.park','elementType':'geometry','stylers':[{'color':'#bde6ab'}]},{'featureType':'poi','elementType':'labels','stylers':[{'visibility':'off'}]},{'featureType':'poi.medical','elementType':'geometry','stylers':[{'color':'#fbd3da'}]},{'featureType':'poi.business','stylers':[{'visibility':'off'}]},{'featureType':'road','elementType':'geometry.stroke','stylers':[{'visibility':'off'}]},{'featureType':'road','elementType':'labels','stylers':[{'visibility':'off'}]},{'featureType':'road.highway','elementType':'geometry.fill','stylers':[{'color':'#ffe15f'}]},{'featureType':'road.highway','elementType':'geometry.stroke','stylers':[{'color':'#efd151'}]},{'featureType':'road.arterial','elementType':'geometry.fill','stylers':[{'color':'#ffffff'}]},{'featureType':'road.local','elementType':'geometry.fill','stylers':[{'color':'black'}]},{'featureType':'transit.station.airport','elementType':'geometry.fill','stylers':[{'color':'#cfb2db'}]}]"
			),
			'subtle'			 => array(
				esc_html__( "Subtle", 'seosight' ),
				"[{'featureType':'poi','stylers':[{'visibility':'off'}]},{'stylers':[{'saturation':-70},{'lightness':37},{'gamma':1.15}]},{'elementType':'labels','stylers':[{'gamma':0.26},{'visibility':'off'}]},{'featureType':'road','stylers':[{'lightness':0},{'saturation':0},{'hue':'#ffffff'},{'gamma':0}]},{'featureType':'road','elementType':'labels.text.stroke','stylers':[{'visibility':'off'}]},{'featureType':'road.arterial','elementType':'geometry','stylers':[{'lightness':20}]},{'featureType':'road.highway','elementType':'geometry','stylers':[{'lightness':50},{'saturation':0},{'hue':'#ffffff'}]},{'featureType':'administrative.province','stylers':[{'visibility':'on'},{'lightness':-50}]},{'featureType':'administrative.province','elementType':'labels.text.stroke','stylers':[{'visibility':'off'}]},{'featureType':'administrative.province','elementType':'labels.text','stylers':[{'lightness':20}]}]"
			),
			'neutral-blue'		 => array(
				esc_html__( "Neutral Blue", 'seosight' ),
				"[{'featureType':'water','elementType':'geometry','stylers':[{'color':'#193341'}]},{'featureType':'landscape','elementType':'geometry','stylers':[{'color':'#2c5a71'}]},{'featureType':'road','elementType':'geometry','stylers':[{'color':'#29768a'},{'lightness':-37}]},{'featureType':'poi','elementType':'geometry','stylers':[{'color':'#406d80'}]},{'featureType':'transit','elementType':'geometry','stylers':[{'color':'#406d80'}]},{'elementType':'labels.text.stroke','stylers':[{'visibility':'on'},{'color':'#3e606f'},{'weight':2},{'gamma':0.84}]},{'elementType':'labels.text.fill','stylers':[{'color':'#ffffff'}]},{'featureType':'administrative','elementType':'geometry','stylers':[{'weight':0.6},{'color':'#1a3541'}]},{'elementType':'labels.icon','stylers':[{'visibility':'off'}]},{'featureType':'poi.park','elementType':'geometry','stylers':[{'color':'#2c5a71'}]}]"
			),
			'flat-map'			 => array(
				esc_html__( "Flat Map", 'seosight' ),
				"[{'stylers':[{'visibility':'off'}]},{'featureType':'road','stylers':[{'visibility':'on'},{'color':'#ffffff'}]},{'featureType':'road.arterial','stylers':[{'visibility':'on'},{'color':'#fee379'}]},{'featureType':'road.highway','stylers':[{'visibility':'on'},{'color':'#fee379'}]},{'featureType':'landscape','stylers':[{'visibility':'on'},{'color':'#f3f4f4'}]},{'featureType':'water','stylers':[{'visibility':'on'},{'color':'#7fc8ed'}]},{},{'featureType':'road','elementType':'labels','stylers':[{'visibility':'off'}]},{'featureType':'poi.park','elementType':'geometry.fill','stylers':[{'visibility':'on'},{'color':'#83cead'}]},{'elementType':'labels','stylers':[{'visibility':'off'}]},{'featureType':'landscape.man_made','elementType':'geometry','stylers':[{'weight':0.9},{'visibility':'off'}]}]"
			),
			'shift-worker'		 => array(
				esc_html__( "Shift Worker", 'seosight' ),
				"[{'stylers':[{'saturation':-100},{'gamma':1}]},{'elementType':'labels.text.stroke','stylers':[{'visibility':'off'}]},{'featureType':'poi.business','elementType':'labels.text','stylers':[{'visibility':'off'}]},{'featureType':'poi.business','elementType':'labels.icon','stylers':[{'visibility':'off'}]},{'featureType':'poi.place_of_worship','elementType':'labels.text','stylers':[{'visibility':'off'}]},{'featureType':'poi.place_of_worship','elementType':'labels.icon','stylers':[{'visibility':'off'}]},{'featureType':'road','elementType':'geometry','stylers':[{'visibility':'simplified'}]},{'featureType':'water','stylers':[{'visibility':'on'},{'saturation':50},{'gamma':0},{'hue':'#50a5d1'}]},{'featureType':'administrative.neighborhood','elementType':'labels.text.fill','stylers':[{'color':'#333333'}]},{'featureType':'road.local','elementType':'labels.text','stylers':[{'weight':0.5},{'color':'#333333'}]},{'featureType':'transit.station','elementType':'labels.icon','stylers':[{'gamma':1},{'saturation':50}]}]"
			),
		);
	}

}

/*
 * */
if ( !function_exists( 'seosight_show_oembed' ) ):

	function seosight_show_oembed( $video_link ) {
		$youtube_id	 = $vimeo_id	 = '';
		if ( preg_match( "/(youtube.com)/", $video_link ) ) {
			$video_id	 = explode( "v=", preg_replace( "/(&)+(.*)/", null, $video_link ) );
			$youtube_id	 = $video_id[ 1 ];
		} elseif ( preg_match( "/(youtu.be)/", $video_link ) ) {
			$video_id	 = explode( "/", preg_replace( "/(&)+(.*)/", null, $video_link ) );
			$youtube_id	 = $video_id[ 3 ];
		} elseif ( preg_match( "/(vimeo.com)/", $video_link ) ) {
			$regexstr	 = '/https?:\/\/(?:www\.|player\.)?vimeo.com\/(?:channels\/(?:\w+\/)?|groups\/([^\/]*)\/videos\/|album\/(\d+)\/video\/|video\/|)(\d+)(?:$|\/|\?)/';
			preg_match( $regexstr, $video_link, $matches );
			$vimeo_id	 = $matches[ 3 ];
		}

		if ( !empty( $youtube_id ) ) {
			echo '<div data-video-id="' . $youtube_id . '" data-type="youtube"></div>';
		} elseif ( !empty( $vimeo_id ) ) {
			echo '<div data-video-id="' . $vimeo_id . '" data-type="vimeo"></div>';
		}
	}

endif;

if ( !function_exists( 'seosight_animated_images_collection' ) ):

	function seosight_animated_images_collection( $row_animation ) {
		$data_animation_images = array();

		if ( function_exists( 'fw_locate_theme_path_uri' ) ) {
			$images_path = fw_locate_theme_path_uri( '/images/animated/' );
		} else {
			$images_path = get_template_directory_uri() . '/images/animated/';
		}

		if ( $row_animation === 'your-score' ) {
			$data_animation_images = array(
				'seoscore1'	 => $images_path . 'seoscore1.png',
				'seoscore2'	 => $images_path . 'seoscore2.png',
				'seoscore3'	 => $images_path . 'seoscore3.png',
			);
		} elseif ( $row_animation === 'background-mountains' ) {
			$data_animation_images = array(
				'mountain1'	 => $images_path . 'mountain1.png',
				'mountain2'	 => $images_path . 'mountain2.png',
			);
		} elseif ( $row_animation === 'testimonial-slider' ) {
			$data_animation_images = array(
				'testimonial1'	 => $images_path . 'testimonial1.png',
				'testimonial2'	 => $images_path . 'testimonial2.png',
			);
		} elseif ( $row_animation === 'subscribe' ) {
			$data_animation_images = array(
				'gear'	 => $images_path . 'subscr-gear.png',
				'mail'	 => $images_path . 'subscr1.png',
				'mail2'	 => $images_path . 'subscr-mailopen.png',
			);
		} elseif ( $row_animation === 'our-vision' ) {
			$data_animation_images = array(
				'elements'	 => $images_path . 'elements.png',
				'eye'		 => $images_path . 'eye.png',
			);
		}

		return $data_animation_images;
	}

endif;

if ( !function_exists( 'seosight_get_old_stunning_options' ) ):

	/**
	 * Get old stunning options for backward compatibility.
	 *
	 * @param string $option: stunning_bg_image|stunning_bg_cover
	 * @param string $source: page|customizer
	 *
	 * @return mixed
	 */
	function seosight_get_old_stunning_options( $source = '', $option = '' ) {

		if ( !$option || !$source || !function_exists( 'fw' ) ) {
			return '';
		}

		if ( $source === 'customizer' ) {

			if ( $option === 'stunning_bg_image' ) {
				$bg_image = fw_get_db_customizer_option( "stunning_bg_image", array() );

				if ( fw_akg( 'data/css/background-image', $bg_image, false ) ) {
					return $bg_image;
				}
			}

			if ( $option === 'stunning_bg_cover' ) {
				return fw_get_db_customizer_option( "stunning_bg_cover", false );
			}
		}

		if ( $source === 'page' ) {
			$options	 = array();
			$taxonomy	 = filter_input( INPUT_GET, 'taxonomy' );
			$tag_ID		 = filter_input( INPUT_GET, 'tag_ID', FILTER_VALIDATE_INT );
			$post_ID	 = filter_input( INPUT_GET, 'post', FILTER_VALIDATE_INT );

			if ( $taxonomy && $tag_ID ) {
				$options = fw_get_db_term_option( $tag_ID, $taxonomy, 'custom-stunning/yes/stunning-show', array() );
			} elseif ( $post_ID ) {
				$options = fw_get_db_post_option( $post_ID, 'custom-stunning/yes/stunning-show', array() );
			}

			if ( $option === 'stunning_bg_image' ) {
				return fw_akg( 'yes/stunning_bg_image', $options, 'none' );
			}

			if ( $option === 'stunning_bg_cover' ) {
				return fw_akg( 'yes/stunning_bg_cover', $options, false );
			}
		}

		return '';
	}

endif;

function seosight_empty_content( $str ) {
	return trim( str_replace( '&nbsp;', '', strip_tags( $str ) ) ) == '';
}

/**
 * Convert text in tweets to links.
 *
 * @param string $tweet Tweet.
 *
 * @return string
 */
function seosight_twitter_convert_links( $tweet ) {

	//Convert urls to <a> links
	$tweet = preg_replace( "/([\w]+\:\/\/[\w-?&;#~=\.\/\@]+[\w\/])/", "<a target=\"_blank\" href=\"$1\">$1</a>", $tweet );

//Convert hashtags to twitter searches in <a> links
	$tweet = preg_replace( "/#([A-Za-z0-9\/\.]*)/", "<a target=\"_new\" href=\"https://twitter.com/search?q=$1\">#$1</a>", $tweet );

	return $tweet;
}

// Related posts plugin addition.
add_filter( 'rp4wp_append_content', '__return_false' );

/**
 * Get instagram Photos without API keys
 *
 * @param string $username Instagram Username
 * @param int $slice Limit number of photos
 * @param int $cachetime Time to store in cache (in hours)
 *
 * @return array|WP_Error
 */
function seosight_scrape_instagram( $username, $slice = 9, $cachetime = 2 ) {
	$username		 = trim( strtolower( $username ) );
	$by_hashtag		 = ( substr( $username, 0, 1 ) == '#' );
	$transient_name	 = 'crum_widget_instagram_' . sanitize_title_with_dashes( $username );
	$instagram		 = get_transient( $transient_name );

	if ( false === $instagram ) {

		$request_param	 = ( $by_hashtag ) ? 'explore/tags/' . substr( $username, 1 ) : trim( $username );
		$remote			 = wp_remote_get( 'https://instagram.com/' . $request_param );

		if ( is_wp_error( $remote ) ) {
			return new WP_Error( 'site_down', esc_html__( 'Unable to communicate with Instagram.', 'seosight' ) );
		}

		if ( 200 != wp_remote_retrieve_response_code( $remote ) ) {
			return new WP_Error( 'invalid_response', esc_html__( 'Instagram did not return a 200.', 'seosight' ) );
		}

		$shards		 = explode( 'window._sharedData = ', $remote[ 'body' ] );
		$insta_json	 = explode( ';</script>', $shards[ 1 ] );
		$insta_array = json_decode( $insta_json[ 0 ], TRUE );

		if ( !$insta_array ) {
			return new WP_Error( 'bad_json', esc_html__( 'Instagram has returned invalid data.', 'seosight' ) );
		}

		if ( isset( $insta_array[ 'entry_data' ][ 'ProfilePage' ][ 0 ][ 'graphql' ][ 'user' ][ 'edge_owner_to_timeline_media' ][ 'edges' ] ) ) {
			$images = $insta_array[ 'entry_data' ][ 'ProfilePage' ][ 0 ][ 'graphql' ][ 'user' ][ 'edge_owner_to_timeline_media' ][ 'edges' ];
		} elseif ( $by_hashtag && isset( $insta_array[ 'entry_data' ][ 'TagPage' ][ 0 ][ 'graphql' ][ 'hashtag' ][ 'edge_hashtag_to_media' ][ 'edges' ] ) ) {
			$images = $insta_array[ 'entry_data' ][ 'TagPage' ][ 0 ][ 'graphql' ][ 'hashtag' ][ 'edge_hashtag_to_media' ][ 'edges' ];
		} else {
			return new WP_Error( 'bad_json_2', esc_html__( 'Instagram has returned invalid data.', 'seosight' ) );
		}

		if ( !is_array( $images ) ) {
			return new WP_Error( 'bad_array', esc_html__( 'Instagram has returned invalid data.', 'seosight' ) );
		}

		$instagram = array();

		foreach ( $images as $image ) {
			$image	 = $image[ 'node' ];
			$caption = esc_html__( 'Instagram Image', 'seosight' );
			if ( !empty( $image[ 'edge_media_to_caption' ][ 'edges' ][ 0 ][ 'node' ][ 'text' ] ) )
				$caption = $image[ 'edge_media_to_caption' ][ 'edges' ][ 0 ][ 'node' ][ 'text' ];

			$image[ 'thumbnail_src' ]	 = preg_replace( "/^https:/i", "", $image[ 'thumbnail_src' ] );
			$image[ 'thumbnail' ]		 = preg_replace( "/^https:/i", "", $image[ 'thumbnail_resources' ][ 0 ][ 'src' ] );
			$image[ 'medium' ]			 = preg_replace( "/^https:/i", "", $image[ 'thumbnail_resources' ][ 2 ][ 'src' ] );
			$image[ 'large' ]			 = $image[ 'thumbnail_src' ];

			$type = ( $image[ 'is_video' ] ) ? 'video' : 'image';

			$instagram[] = array(
				'description'	 => $caption,
				'link'			 => '//instagram.com/p/' . $image[ 'shortcode' ],
				'comments'		 => $image[ 'edge_media_to_comment' ][ 'count' ],
				'likes'			 => $image[ 'edge_liked_by' ][ 'count' ],
				'thumbnail'		 => $image[ 'thumbnail' ],
				'medium'		 => $image[ 'medium' ],
				'large'			 => $image[ 'large' ],
				'type'			 => $type
			);
		}

		// Do not set an empty transient - should help catch private or empty accounts.
		if ( !empty( $instagram ) ) {
			$instagram = json_encode( serialize( $instagram ) );
			set_transient( 'crum_instagram_' . sanitize_title_with_dashes( $username ), $instagram, apply_filters( 'null_instagram_cache_time', HOUR_IN_SECONDS * $cachetime ) );
		}
	}
	if ( !empty( $instagram ) ) {
		$instagram = unserialize( json_decode( $instagram ) );

		return array_slice( $instagram, 0, $slice );
	} else {
		return new WP_Error( 'no_images', esc_html__( 'Instagram did not return any images.', 'seosight' ) );
	}
}

//Convert col decimal format to class
// Replace for King Composer plugin class
function seosight_column_width_class( $width ) {

	if ( empty( $width ) )
		return 'col-md-12 col-sm-12';

	if ( strpos( $width, '%' ) !== false ) {
		$width = (float) $width;
		if ( $width < 12 )
			return 'col-md-1 col-sm-6 col-xs-12';
		else if ( $width < 18 )
			return 'col-md-2 col-sm-6 col-xs-12';
		else if ( $width < 22.5 )
			return 'kc_col-of-5';
		else if ( $width < 29.5 )
			return 'col-md-3 col-sm-6 col-xs-12';
		else if ( $width < 37 )
			return 'col-md-4 col-sm-12';
		else if ( $width < 46 )
			return 'col-md-5 col-sm-12';
		else if ( $width < 54.5 )
			return 'col-md-6 col-sm-12';
		else if ( $width < 63 )
			return 'col-md-7 col-sm-12';
		else if ( $width < 71.5 )
			return 'col-md-8 col-sm-12';
		else if ( $width < 79.5 )
			return 'col-md-9 col-sm-12';
		else if ( $width < 87.5 )
			return 'col-md-10 col-sm-12';
		else if ( $width < 95.5 )
			return 'col-md-11 col-sm-12';
		else
			return 'col-md-12 col-sm-12';
	}

	$matches	 = explode( '/', $width );
	$width_class = '';
	$n			 = 12;
	$m			 = 12;

	if ( isset( $matches[ 0 ] ) && !empty( $matches[ 0 ] ) )
		$n	 = $matches[ 0 ];
	if ( isset( $matches[ 1 ] ) && !empty( $matches[ 1 ] ) )
		$m	 = $matches[ 1 ];

	if ( $n == 2.4 ) {
		$width_class = 'kc_col-of-5';
	} else {
		if ( $n > 0 && $m > 0 ) {
			$value = ceil( ($n / $m) * 12 );
			if ( $value > 0 && $value <= 12 ) {
				$width_class = 'col-md-' . $value;
			}
		}
	}

	return $width_class;
}

function seosight_is_phone( $phone ) {
	preg_match( '/^((?:\+\d{1,2})?(?:\s)?)?\(?\d{3}\)?(?:[\s.-])?\d{3}(?:[\s.-])?\d{4}$/', $phone, $output_array );
	return !empty( $output_array );
}

function seosight_is_email( $email ) {
	preg_match( '/^(?!(?:(?:\x22?\x5C[\x00-\x7E]\x22?)|(?:\x22?[^\x5C\x22]\x22?)){255,})(?!(?:(?:\x22?\x5C[\x00-\x7E]\x22?)|(?:\x22?[^\x5C\x22]\x22?)){65,}@)(?:(?:[\x21\x23-\x27\x2A\x2B\x2D\x2F-\x39\x3D\x3F\x5E-\x7E]+)|(?:\x22(?:[\x01-\x08\x0B\x0C\x0E-\x1F\x21\x23-\x5B\x5D-\x7F]|(?:\x5C[\x00-\x7F]))*\x22))(?:\.(?:(?:[\x21\x23-\x27\x2A\x2B\x2D\x2F-\x39\x3D\x3F\x5E-\x7E]+)|(?:\x22(?:[\x01-\x08\x0B\x0C\x0E-\x1F\x21\x23-\x5B\x5D-\x7F]|(?:\x5C[\x00-\x7F]))*\x22)))*@(?:(?:(?!.*[^.]{64,})(?:(?:(?:xn--)?[a-z0-9]+(?:-[a-z0-9]+)*\.){1,126}){1,}(?:(?:[a-z][a-z0-9]*)|(?:(?:xn--)[a-z0-9]+))(?:-[a-z0-9]+)*)|(?:\[(?:(?:IPv6:(?:(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){7})|(?:(?!(?:.*[a-f0-9][:\]]){7,})(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){0,5})?::(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){0,5})?)))|(?:(?:IPv6:(?:(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){5}:)|(?:(?!(?:.*[a-f0-9]:){5,})(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){0,3})?::(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){0,3}:)?)))?(?:(?:25[0-5])|(?:2[0-4][0-9])|(?:1[0-9]{2})|(?:[1-9]?[0-9]))(?:\.(?:(?:25[0-5])|(?:2[0-4][0-9])|(?:1[0-9]{2})|(?:[1-9]?[0-9]))){3}))\]))$/', $email, $output_array );
	return !empty( $output_array );
}

function seosight_bg_video_layer( $video_attr = false ) {

	if ( !is_array( $video_attr ) ) {
		return '';
	}

	$html = '<div class="bg-layer js-section-background"
			 data-background-options="' . esc_attr( json_encode( array(
				'source' => $video_attr
			) ) ) . '"></div>';

	return $html;
}

function seosight_is_ajax() {
	$requested_width = filter_input( INPUT_SERVER, 'HTTP_X_REQUESTED_WITH' );
	return strtolower( $requested_width ) === 'xmlhttprequest' ? true : false;
}

/**
 * Echo data
 */
function seosight_render() {
	foreach ( func_get_args() as $arg ) {
		echo "{$arg}";
	}
}

/**
 *  Generate custom loop from options
 *
 * @return WP_Query
 */
if ( !function_exists( 'seosight_custom_loop' ) ) :

	function seosight_custom_loop( $post_type ) {
		if ( 'fw-portfolio' === $post_type ) {
			$per_page	 = fw_get_db_settings_option( 'per_page', 9 );
			$order		 = fw_get_db_settings_option( 'order', 'DESC' );
			$orderby	 = fw_get_db_settings_option( 'orderby', 'date' );
			$taxonomy	 = 'fw-portfolio-category';
		} else {
			$per_page	 = get_option( 'posts_per_page' );
			$order		 = 'DESC';
			$orderby	 = 'date';
			$taxonomy	 = 'category';
		}

		$meta_per_page			 = fw_get_db_post_option( get_the_ID(), 'per_page' );
		$meta_order				 = fw_get_db_post_option( get_the_ID(), 'order' );
		$meta_orderby			 = fw_get_db_post_option( get_the_ID(), 'orderby' );
		$meta_order_by			 = fw_get_db_post_option( get_the_ID(), 'order_by' );
		$meta_custom_categories	 = fw_get_db_post_option( get_the_ID(), 'taxonomy_select' );
		$meta_exclude			 = fw_get_db_post_option( get_the_ID(), 'exclude' );


		if ( isset( $meta_per_page ) && !empty( $meta_per_page ) ) {
			$per_page = $meta_per_page;
		}

		if ( isset( $meta_order ) && !empty( $meta_order ) && !( 'default' === $meta_order ) ) {
			$order = $meta_order;
		}

		if ( isset( $meta_orderby ) && !empty( $meta_orderby ) && !( 'default' === $meta_orderby ) ) {
			$orderby = $meta_orderby;
		}
		if ( isset( $meta_order_by ) && !empty( $meta_order_by ) && !( 'default' === $meta_order_by ) ) {
			$orderby = $meta_order_by;
		}

		if ( is_front_page() ) {
			$paged = ( get_query_var( 'page' ) ) ? get_query_var( 'page' ) : 1;
		} else {
			$paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
		}

		$args = array(
			'post_type'		 => $post_type,
			'paged'			 => $paged,
			'posts_per_page' => $per_page,
			'order'			 => $order,
			'orderby'		 => $orderby,
		);

		$search = filter_input( INPUT_GET, 'search' );
		if ( $search ) {
			$args[ 's' ] = $search;
		}

		if ( !empty( $meta_custom_categories ) ) {
			if ( true === $meta_exclude ) {
				$operator = 'NOT IN';
			} else {
				$operator = 'IN';
			}
			$args[ 'tax_query' ] = array(
				array(
					'taxonomy'	 => $taxonomy,
					'field'		 => 'term_id',
					'terms'		 => $meta_custom_categories,
					'operator'	 => $operator,
				),
			);
		}

		$porfolio_query = new WP_Query( $args );

		return $porfolio_query;
	}

endif;

/**
 * Get ES Forms
 */
function seosight_get_es_forms( $formatted = false ) {
	global $wpdb;

	$forms = array();
	if ( !defined( 'IG_FORMS_TABLE' ) ) {
		return $forms;
	}

	$sql = 'SELECT * FROM ' . IG_FORMS_TABLE . ' WHERE ( deleted_at IS NULL OR deleted_at = "0000-00-00 00:00:00" )';

	$result = $wpdb->get_results( $sql, 'ARRAY_A' );

	if ( empty( $result ) ) {
		return $forms;
	}

	if ( $formatted ) {
		foreach ( $result as $form ) {
			$forms[ $form[ 'id' ] ] = $form[ 'name' ];
		}

		return $forms;
	}

	return $result;
}

/**
 * Get ES Lists
 */
function seosight_get_es_lists( $formatted = false ) {
	global $wpdb;

	$lists = array();
	if ( !defined( 'IG_LISTS_TABLE' ) ) {
		return $lists;
	}

	$sql = 'SELECT * FROM ' . IG_LISTS_TABLE . ' WHERE ( deleted_at IS NULL OR deleted_at = "0000-00-00 00:00:00" )';

	$result = $wpdb->get_results( $sql, 'ARRAY_A' );

	if ( empty( $result ) ) {
		return $lists;
	}

	if ( $formatted ) {
		foreach ( $result as $list ) {
			$lists[ $list[ 'id' ] ] = $list[ 'name' ];
		}

		return $lists;
	}

	return $result;
}

function seosight_get_project_video() {
	if ( !function_exists( 'fw_get_db_post_option' ) ) {
		return false;
	}

	$type = fw_get_db_post_option( get_the_ID(), 'cover-video-type', 'none' );

	if ( $type === 'source' ) {
		$video = fw_get_db_post_option( get_the_ID(), "cover-video-source/source/video_source/url", null );
		if ( !$video ) {
			return false;
		}

		return "<video controls src=\"{$video}\" width=\"560\" height=\"315\"></video>";
	}

	if ( $type === 'link' ) {
		$video = fw_get_db_post_option( get_the_ID(), "cover-video-source/link/url", null );
		if ( !$video ) {
			return false;
		}

		$ifrm = 'if'. 'rame';
		$matches = array();
		preg_match( '/^.*((youtu.be\/)|(v\/)|(\/u\/\w\/)|(embed\/)|(watch\?))\??v?=?([^#\&\?]*).*/', $video, $matches );

		if ( isset( $matches[ 7 ] ) ) {
			return "<{$ifrm} width=\"560\" height=\"315\" src=\"https://www.youtube.com/embed/{$matches[ 7 ]}\" frameborder=\"0\" allow=\"accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture\" allowfullscreen></{$ifrm}>";
		}

		$matches = array();
		preg_match( '/(http|https)?:\/\/(www\.)?vimeo.com\/(?:channels\/(?:\w+\/)?|groups\/([^\/]*)\/videos\/|)(\d+)(?:|\/\?)/', $video, $matches );

		if ( isset( $matches[ 4 ] ) ) {
			return "<{$ifrm} src=\"https://player.vimeo.com/video/{$matches[ 4 ]}?title=0&byline=0&portrait=0\" width=\"560\" height=\"315\" frameborder=\"0\" allow=\"autoplay; fullscreen\" allowfullscreen></{$ifrm}>";
		}
	}

	return false;
}
