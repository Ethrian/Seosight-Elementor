<?php if ( ! defined( 'ABSPATH' ) ) {
	die( 'Direct access forbidden.' );
}

 class Seosight_Widget_Menus extends WP_Widget {

	/**
	 * Construct.
	 *
	 * @internal
	 */
	public function __construct() {
		$widget_ops = array(
			'description'                 => esc_html__( 'Custom menus widget', 'seosight' ),
			'classname'                   => 'w-custom-menu',
			'customize_selective_refresh' => true
		);
		parent::__construct(
			false,
			esc_html__( 'Theme widget: Menus', 'seosight' ),
			$widget_ops
		);
	}

	/**
	 * Options.
	 *
	 * @param array $args
	 * @param array $instance
	 */

	function widget( $args, $instance ) {
		if ( defined( 'FW' ) ) {

			$title     = apply_filters( 'widget_title', $instance['title'], $instance, $this->id_base );
			$menu    = ! empty( $instance['menu'] ) ? $instance['menu'] : '';
			$menu2    = ! empty( $instance['menu2'] ) ? $instance['menu2'] : '';

			// Widget frontend. Can be modified via child theme.
			$view_path = fw_locate_theme_path( '/inc/widgets/menus/views/widget.php' );
			echo fw_render_view( $view_path, compact( 'args', 'title', 'menu', 'menu2' ) );
		}
	}

	function update( $new_instance, $old_instance ) {

		$instance              = $old_instance;
		$instance['title']     = strip_tags( $new_instance['title'] );
		$instance['menu']    = esc_attr( $new_instance['menu'] );
		$instance['menu2']   = esc_attr( $new_instance['menu2'] );

		return $instance;

	}

	function form( $instance ) {
		$title     = empty( $instance['title'] ) ? esc_html__( 'Menu list', 'seosight' ) : $instance['title'];
		$nav_menu    = ! empty( $instance['menu'] ) ? $instance['menu'] : '';
		$nav_menu2    = ! empty( $instance['menu2'] ) ? $instance['menu2'] : '';
		?>
		<p>
			<label for="<?php echo esc_attr($this->get_field_id( 'title' )); ?>"><?php esc_html_e( 'Title:', 'seosight' ); ?></label>
			<input class="widefat" id="<?php echo esc_attr($this->get_field_id( 'title' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'title' )); ?>" type="text" value="<?php echo esc_attr( $title ); ?>"/>
		</p>
		<?php
		$menus = wp_get_nav_menus( array( 'orderby' => 'name' ) );
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
			<p>
				<label for="<?php echo esc_attr($this->get_field_id( 'menu2' )); ?>"><?php esc_html_e( 'Menu in second column', 'seosight' ); ?></label>
				<select class="widefat" id="<?php echo esc_attr($this->get_field_id( 'menu2' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'menu2' )); ?>">
					<option value=""> --------- </option>';
					<?php foreach ( $menus as $menu ) {
						echo '<option value="' . esc_attr($menu->term_id ). '"'. selected( $nav_menu2, $menu->term_id, false ). '>'. esc_html($menu->name) . '</option>';
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