<?php if ( ! defined( 'ABSPATH' ) ) {
	die( 'Direct access forbidden.' );
}

 class Seosight_Widget_Login extends WP_Widget {

	/**
	 * Mandatory constructor needs to call the parent constructor with the
	 * following params: id (if false, one will be generated automatically),
	 * the title of the widget (can be translated, of course), and last, params
	 * to further configure the widget.
	 * see https://codex.wordpress.org/Widgets_API for more info
	 */
	public function __construct() {
		parent::__construct(
			false,
			__( 'Theme widget: Login', 'seosight' ),
			array( 'description' => '', 'classname' => 'w-login' )
		);
	}

	/**
	 * Renders the widget to the visitors
	 */
	public function widget( $args, $instance ) {

		if ( defined( 'FW' ) ) {

			$title     = apply_filters( 'widget_title', $instance['title'], $instance, $this->id_base );
			$link = ! empty( $instance['link'] ) ? $instance['link'] : home_url();
			$menu = $instance['menu'];

			// Widget frontend. Can be modified via child theme.
			$view_path = fw_locate_theme_path( '/inc/widgets/login/views/widget.php' );
			echo fw_render_view( $view_path, compact( 'args', 'title', 'link', 'menu' ) );

		}
	}


	public function update( $new_instance, $old_instance ) {
		$instance              = $old_instance;
		$instance['title'] = wp_kses_post( $new_instance['title'] );
		$instance['link']  = esc_url( $new_instance['link'] );
		$instance['menu']  = esc_attr( $new_instance['menu'] );

		return $instance;
	}


	public function form( $instance ) {
		$title = isset( $instance['title'] ) ? $instance['title'] : 'Sign In to Your Account';
		$link  = isset( $instance['link'] ) ? $instance['link'] : '';
		$nav_menu    = ! empty( $instance['menu'] ) ? $instance['menu'] : '';
		$menus = wp_get_nav_menus( array( 'orderby' => 'name' ) );


		$widget_output = '<p>';
		$widget_output .= '<label for="' . esc_attr( $this->get_field_id( 'title' ) ) . '">' . esc_html__( 'Title', 'seosight' ) . ':</label>';
		$widget_output .= '<input class="widefat" id="' . esc_attr( $this->get_field_id( 'title' ) ) . '" name="' . esc_attr( $this->get_field_name( 'title' ) ) . '" type="text" value="' . esc_attr( $title ) . '">';
		$widget_output .= '</p>';

		$widget_output .= '<p>';
		$widget_output .= '<label for="' . esc_attr($this->get_field_id( 'link' )) . '">' . esc_html__( 'URL for redirect after login', 'seosight' ) . ':</label>';
		$widget_output .= '<input class="widefat" id="' . esc_attr( $this->get_field_id( 'link' ) ) . '" name="' . esc_attr( $this->get_field_name( 'link' ) ) . '" type="text" value="' . esc_attr( $link ) . '">';
		$widget_output .= '</p>';
		seosight_render($widget_output);
		if ( ! empty( $menus ) ) { ?>
			<p>
				<label for="<?php echo esc_attr($this->get_field_id( 'menu' )); ?>"><?php esc_html_e( 'Menu in first column', 'seosight' ); ?></label>
				<select class="widefat" id="<?php echo esc_attr($this->get_field_id( 'menu' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'menu' )); ?>">
					<option value=""> --------- </option>';
					<?php foreach ( $menus as $menu ) {
						echo '<option value="' . esc_attr($menu->term_id) . '"'. selected( $nav_menu, $menu->term_id, false ). '>'. esc_html($menu->name) . '</option>';
					} ?>
				</select>
			</p>
			<?php
		} else {
			echo '<p>';
			printf( esc_attr__( 'Please create menu in section %1$s', 'seosight' ),
				sprintf( wp_kses(__( '<a href="%s">Menus</a>', 'seosight' ),array('a' => array('href' => array()))),
					get_admin_url( get_current_blog_id(), 'nav-menus.php' )
				)
			);
			echo '</p>';
		}

	}

}
