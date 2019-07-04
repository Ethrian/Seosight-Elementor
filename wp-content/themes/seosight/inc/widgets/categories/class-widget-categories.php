<?php if ( ! defined( 'ABSPATH' ) ) {
	die( 'Direct access forbidden.' );
}

 class Seosight_Widget_Categories extends WP_Widget {

	/**
	 * Construct.
	 *
	 * @internal
	 */
	public function __construct() {
		$widget_ops = array(
			'description'                 => esc_html__( 'Theme styled categories list', 'seosight' ),
			'classname'                   => 'w-post-category',
			'customize_selective_refresh' => true
		);
		parent::__construct(
			false,
			esc_html__( 'Theme widget: Categories', 'seosight' ),
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
		    if (!empty($instance['title'])){
                $title     = apply_filters( 'widget_title', $instance['title'], $instance, $this->id_base );
            } else {
                $title = '';
            }

			$count    = ! empty( $instance['count'] ) ? $instance['count'] : true;
			$cat_sel   = ! empty( $instance['cat_sel'] ) ? esc_attr( $instance['cat_sel'] ) : 'category';

			// Widget frontend. Can be modified via child theme.
			$view_path = fw_locate_theme_path( '/inc/widgets/categories/views/widget.php' );
			echo fw_render_view( $view_path, compact( 'args', 'title', 'count', 'cat_sel' ) );
		}
	}

	function update( $new_instance, $old_instance ) {

		$instance              = $old_instance;
		$instance['title']     = strip_tags( $new_instance['title'] );
		$instance['count']    = esc_attr( $new_instance['count'] );
		$instance['cat_sel']   = esc_attr( $new_instance['cat_sel'] );


		return $instance;

	}

	function form( $instance ) {
		$title     = empty( $instance['title'] ) ? esc_html__( 'Category list', 'seosight' ) : $instance['title'];
		$count    = ! empty( $instance['count'] ) ? $instance['count'] : true;
		$cat_sel   = ! empty( $instance['cat_sel'] ) ? $instance['cat_sel'] : 'post_tag';
		?>

		<p>
			<label for="<?php echo esc_attr($this->get_field_id( 'title' )); ?>"><?php esc_html_e( 'Title', 'seosight' ); ?></label>
			<input class="widefat" id="<?php echo esc_attr($this->get_field_id( 'title' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'title' )); ?>" type="text" value="<?php echo esc_attr( $title ); ?>"/>
		</p>
		<p>
			<input type="checkbox" class="checkbox" id="<?php echo esc_attr($this->get_field_id('count')); ?>" name="<?php echo esc_attr($this->get_field_name('count')); ?>"<?php checked( $count ); ?> />
			<label for="<?php echo esc_attr($this->get_field_id('count')); ?>"><?php esc_html_e( 'Show post counts', 'seosight' ); ?></label>
		</p>
		<?php
		$taxonomies = get_taxonomies( array(), 'objects' );
		if ( ! empty( $taxonomies ) ) { ?>
			<p>
				<label for="<?php echo esc_attr($this->get_field_id( 'cat_sel' )); ?>"><?php esc_html_e( 'Select Taxonomy', 'seosight' ); ?></label>
				<select class="widefat" id="<?php echo esc_attr($this->get_field_id( 'cat_sel' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'cat_sel' )); ?>">
					<?php
					foreach ( $taxonomies as $taxonomy ) {
						if ( false !== strpos( $taxonomy->name, 'cat' ) ) {
							echo '<option class="widefat" value="' . $taxonomy->name . '" ' . selected( $taxonomy->name, $cat_sel, false ) . '>' . $taxonomy->label . '</option>';
						}
					} ?>
				</select>
			</p>
			<?php
		}
	}
}