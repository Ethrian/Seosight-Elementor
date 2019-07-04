<?php if ( ! defined( 'ABSPATH' ) ) {
	die( 'Direct access forbidden.' );
}
if ( defined( 'FW' ) ) {
	 class Seosight_Widget_Tags extends WP_Widget {

		/**
		 * Construct.
		 *
		 * @internal
		 */
		public function __construct() {
			$widget_ops = array( 'description' => esc_html__( 'Theme styled tags list', 'seosight' ), 'classname' => 'w-tags', 'customize_selective_refresh' => true );
			parent::__construct( false, esc_html__( 'Theme widget: Tags Cloud', 'seosight' ), $widget_ops );
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
				$number    = intval( $instance['number'] );
				$cat_sel   = ! empty( $instance['cat_sel'] ) ? esc_attr( $instance['cat_sel'] ) : 'post_tag';
				$font_size = ! empty( $instance['font_size'] ) ? $instance['font_size'] : 15;


				// Widget frontend. Can be modified via child theme.
				$view_path = fw_locate_theme_path( '/inc/widgets/tags/views/widget.php' );
				echo fw_render_view( $view_path, compact( 'args', 'title', 'number', 'font_size', 'cat_sel' ) );

			}
		}

		function update( $new_instance, $old_instance ) {

			$instance              = $old_instance;
			$instance['title']     = strip_tags( $new_instance['title'] );
			$instance['number']    = strip_tags( intval( $new_instance['number'] ) );
			$instance['font_size'] = strip_tags( intval( $new_instance['font_size'] ) );
			$instance['cat_sel']   = esc_attr( $new_instance['cat_sel'] );


			return $instance;

		}

		function form( $instance ) {
			$title     = empty( $instance['title'] ) ? esc_html__( 'Tags list', 'seosight' ) : $instance['title'];
			$number    = ! empty( $instance['number'] ) ? $instance['number'] : 10;
			$cat_sel   = ! empty( $instance['cat_sel'] ) ? $instance['cat_sel'] : 'post_tag';
			$font_size = ! empty( $instance['font_size'] ) ? $instance['font_size'] : 15;
			?>

			<p>
				<label for="<?php echo esc_attr($this->get_field_id( 'title' )); ?>"><?php esc_html_e( 'Title:', 'seosight' ); ?></label>
				<input class="widefat" id="<?php echo esc_attr($this->get_field_id( 'title' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'title' )); ?>" type="text" value="<?php echo esc_attr( $title ); ?>"/>
			</p>
			<p>
				<label for="<?php echo esc_attr($this->get_field_id( 'number' )); ?>"><?php esc_html_e( 'Number tags:', 'seosight' ); ?></label>
				<input class="widefat" id="<?php echo esc_attr($this->get_field_id( 'number' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'number' )); ?>" type="text" value="<?php echo esc_attr( $number ); ?>"/>
			</p>
			<p>
				<label for="<?php echo esc_attr( $this->get_field_id( 'font_size' ) ); ?>"><?php esc_html_e( 'Font size (in px):', 'seosight' ); ?></label>
				<input id="<?php echo esc_attr( $this->get_field_id( 'font_size' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'font_size' ) ); ?>" type="text" value="<?php echo esc_attr( $font_size ); ?>"/>
			</p>
			<?php
			$taxonomies = get_taxonomies( array(), 'objects' );
			if ( ! empty( $taxonomies ) ) { ?>
				<p>
					<label for="<?php echo esc_attr($this->get_field_id( 'cat_sel' )); ?>"><?php esc_html_e( 'Select Taxonomy', 'seosight' ); ?></label>
					<select class="widefat" id="<?php echo esc_attr($this->get_field_id( 'cat_sel' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'cat_sel' )); ?>">
						<?php
						foreach ( $taxonomies as $taxonomy ) {
							if ( strpos( $taxonomy->name, 'tag' ) ) {
								echo '<option class="widefat" value="' . esc_attr($taxonomy->name) . '" ' . selected( $taxonomy->name, $cat_sel, false ) . '>' . esc_html($taxonomy->label) . '</option>';
							}
						} ?>
					</select>
				</p>
				<?php
			}
		}
	}
}