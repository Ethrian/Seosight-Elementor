<?php if ( ! defined( 'ABSPATH' ) ) {
	die( 'Direct access forbidden.' );
}

class Seosight_Widget_Instagram extends WP_Widget {
	/**
	 * Register widget with WordPress.
	 */
	function __construct() {
		parent::__construct(
			'crum-instagram-feed',
			__( 'Theme widget: Instagram', 'seosight' ),
			array( 'classname'   => 'instagramm',
			       'description' => esc_html__( 'Displays your latest Instagram photos', 'seosight' )
			)
		);
	}

	function widget( $args, $instance ) {
		$title = empty( $instance['title'] ) ? '' : apply_filters( 'widget_title', $instance['title'] );
		$username = empty( $instance['username'] ) ? '' : $instance['username'];
		$columns = empty( $instance['columns'] ) ? 2 : $instance['columns'];
		$limit = empty( $instance['number'] ) ? 9 : $instance['number'];
		$size = empty( $instance['size'] ) ? 'large' : $instance['size'];
		$target = empty( $instance['target'] ) ? '_self' : $instance['target'];
		$space = empty( $instance['space'] ) ? '' : $instance['space'];
		$button = empty( $instance['button'] ) ? '' : $instance['button'];

        seosight_render( $args['before_widget'] );
        if ( ! empty( $title ) ) {
            seosight_render( $args[ 'before_title' ] . esc_html( $title ) . $args[ 'after_title' ] );
        };

		if ( ! empty( $username ) ) {
			$media_array = seosight_scrape_instagram( $username, $limit );

			$view_path = get_template_directory() . '/inc/widgets/instagram/views/widget.php';
			echo fw_render_view( $view_path, compact( 'size', 'media_array', 'number', 'target', 'columns', 'space', 'button' ) );
		}

        seosight_render( $args['after_widget'] );
	}

	function form( $instance ) {
		$instance = wp_parse_args( (array) $instance, array( 'title' => esc_html__( 'Instagram', 'seosight' ), 'username' => '', 'size' => 'large', 'space' => '','button' => 0, 'number' => 9, 'target' => '_self' ) );
		$title    = isset( $instance['title'] ) ? $instance['title'] : '';
		$username = isset( $instance['username'] ) ? $instance['username'] : '';
		$number   = isset( $instance['number'] ) ? absint( $instance['number'] ) : 9;
		$columns  = isset( $instance['columns'] ) ? absint( $instance['columns'] ) : 3;
		$size     = isset( $instance['size'] ) ? $instance['size'] : 'large';
		$target   = isset( $instance['target'] ) ? $instance['target'] : '_self';
		$space    = isset( $instance['space'] ) ? $instance['space'] : '';
		$button   = isset( $instance['button'] ) ? $instance['button'] : 0;
		?>
		<p><label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_html_e( 'Title', 'seosight' ); ?>:
				<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
			</label></p>
		<p><label for="<?php echo esc_attr( $this->get_field_id( 'username' ) ); ?>"><?php esc_html_e( 'Username', 'seosight' ); ?>:
				<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'username' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'username' ) ); ?>" type="text" value="<?php echo esc_attr( $username ); ?>" />
			</label></p>
		<p><label for="<?php echo esc_attr( $this->get_field_id( 'number' ) ); ?>"><?php esc_html_e( 'Number of photos', 'seosight' ); ?>:
				<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'number' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'number' ) ); ?>" type="text" value="<?php echo esc_attr( $number ); ?>" />
			</label></p>
		<p><label for="<?php echo esc_attr( $this->get_field_id( 'columns' ) ); ?>"><?php esc_html_e( 'Number of columns', 'seosight' ); ?>:
				<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'columns' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'columns' ) ); ?>" type="text" value="<?php echo esc_attr( $columns ); ?>" />
			</label></p>
		<p><label for="<?php echo esc_attr( $this->get_field_id( 'size' ) ); ?>"><?php esc_html_e( 'Photo size', 'seosight' ); ?>:</label>
			<select id="<?php echo esc_attr( $this->get_field_id( 'size' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'size' ) ); ?>" class="widefat">
				<option value="thumbnail" <?php selected( 'thumbnail', $size ) ?>><?php esc_html_e( 'Thumbnail', 'seosight' ); ?></option>
				<option value="small" <?php selected( 'small', $size ) ?>><?php esc_html_e( 'Small', 'seosight' ); ?></option>
				<option value="large" <?php selected( 'large', $size ) ?>><?php esc_html_e( 'Large', 'seosight' ); ?></option>
				<option value="original" <?php selected( 'original', $size ) ?>><?php esc_html_e( 'Original', 'seosight' ); ?></option>
			</select>
		</p>
		<p><label for="<?php echo esc_attr( $this->get_field_id( 'target' ) ); ?>"><?php esc_html_e( 'Open links in', 'seosight' ); ?>:</label>
			<select id="<?php echo esc_attr( $this->get_field_id( 'target' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'target' ) ); ?>" class="widefat">
				<option value="_self" <?php selected( '_self', $target ) ?>><?php esc_html_e( 'Current window (_self)', 'seosight' ); ?></option>
				<option value="_blank" <?php selected( '_blank', $target ) ?>><?php esc_html_e( 'New window (_blank)', 'seosight' ); ?></option>
			</select>
		</p>
		<p><label for="<?php echo esc_attr( $this->get_field_id( 'space' ) ); ?>"><?php esc_html_e( 'Grid space', 'seosight' ); ?>:</label>
			<select id="<?php echo esc_attr( $this->get_field_id( 'space' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'space' ) ); ?>" class="widefat">
				<option value="" <?php selected( '', $space ) ?>><?php esc_html_e( 'Disable paddings', 'seosight' ); ?></option>
				<option value="padding" <?php selected( 'padding', $space ) ?>><?php esc_html_e( 'Enable paddings', 'seosight' ); ?></option>
			</select>
		</p>
		<?php

	}

	function update( $new_instance, $old_instance ) {
		$instance             = $old_instance;
		$instance['title']    = strip_tags( $new_instance['title'] );
		$instance['username'] = trim( strip_tags( $new_instance['username'] ) );
		$instance['number']   = absint( $new_instance['number'] );
		$instance['columns']  = absint( $new_instance['columns'] );
		$instance['size']     = $new_instance['size'];
		$instance['target']   = $new_instance['target'];
		$instance['space']    = $new_instance['space'];
		$instance['button']    = $new_instance['button'];

		return $instance;
	}

	function images_only( $media_item ) {
		if ( 'image' === $media_item['type'] ) {
			return true;
		}

		return false;
	}
}
