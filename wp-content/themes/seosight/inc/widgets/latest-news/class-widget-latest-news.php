<?php if ( ! defined( 'ABSPATH' ) ) {
	die( 'Direct access forbidden.' );
}

 class Seosight_Widget_Latest_News extends WP_Widget {

	/**
	 * Construct.
	 *
	 * @internal
	 */
	public function __construct() {
		$widget_ops = array( 'description' => esc_html__( 'Theme styled latest posts', 'seosight' ), 'classname' => 'w-latest-news' );
		parent::__construct( false, esc_html__( 'Theme widget: Latest News', 'seosight' ), $widget_ops );
	}

	/**
	 * Options.
	 *
	 * @param array $args
	 * @param array $instance
	 */
	function widget( $args, $instance ) {

		$cache = wp_cache_get( 'widget_latest_news', 'widget' );

		if ( ! is_array( $cache ) ) {
			$cache = array();
		}
		if ( ! isset( $args['widget_id'] ) ) {
			$args['widget_id'] = $this->id;
		}

		if ( isset( $cache[ $args['widget_id'] ] ) ) {
			seosight_render( $cache[ $args['widget_id'] ] );// WPCS: XSS ok, sanitization ok.
			return;
		}

		if ( defined( 'FW' ) ) {

			$title = apply_filters( 'widget_title', $instance['title'], $instance, $this->id_base );

			$text_button = $instance['text_button'];
			$link_button = $instance['link_button'];

			if ( empty( $instance['number'] ) || ! $number = absint( $instance['number'] ) ) {
				$number = 10;
			}
			$exclude = empty( $instance['exclude'] ) ? '' : $instance['exclude'];

			$the_query = new WP_Query(
				array(
					'posts_per_page'      => $number,
					'no_found_rows'       => true,
					'post_status'         => 'publish',
					'ignore_sticky_posts' => true,
					'category__not_in'    => explode( ',', $exclude ),
				)
			);
			// Widget frontend. Can be modified via child theme.
			$view_path = fw_locate_theme_path( '/inc/widgets/latest-news/views/widget.php' );
            ob_start();

			echo fw_render_view( $view_path, compact( 'args', 'title', 'the_query', 'text_button', 'link_button' ) );

			$cache[ $args['widget_id'] ] = ob_get_flush();
		}
	}


	function update( $new_instance, $old_instance ) {
		$instance            = $old_instance;
		$instance['title']   = strip_tags( $new_instance['title'] );
		$instance['number']  = (int) $new_instance['number'];
		$instance['exclude'] = strip_tags( $new_instance['exclude'] );
		$instance['text_button'] = strip_tags( $new_instance['text_button'] );
		$instance['link_button'] = strip_tags( $new_instance['link_button'] );
		$this->flush_cache();


		$alloptions = wp_cache_get( 'alloptions', 'options' );
		if ( isset( $alloptions['widget_recent_entries'] ) ) {
			delete_option( 'widget_recent_entries' );
		}

		return $instance;
	}

	function flush_cache() {
		wp_cache_delete( 'widget_latest_news', 'widget' );
	}

	function form( $instance ) {
		$title   = isset( $instance['title'] ) ? esc_attr( $instance['title'] ) : '';
		$number  = isset( $instance['number'] ) ? absint( $instance['number'] ) : 5;
		$exclude = isset( $instance['exclude'] ) ? esc_attr( $instance['exclude'] ) : '';
		$text_button = isset( $instance['text_button'] ) ? esc_attr( $instance['text_button'] ) : esc_html__( 'All News', 'seosight' );
		$link_button = isset( $instance['link_button'] ) ? esc_attr( $instance['link_button'] ) : '';


		?>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_html_e( 'Title:', 'seosight' ); ?></label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>"/>
		</p>

		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'number' ) ); ?>"><?php esc_html_e( 'Number of news to show:', 'seosight' ); ?></label>
			<input id="<?php echo esc_attr( $this->get_field_id( 'number' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'number' ) ); ?>" type="text" value="<?php echo esc_attr( $number ); ?>" size="3"/>
		</p>

		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'exclude' ) ); ?>"><?php esc_html_e( 'Exclude Category(s):', 'seosight' ); ?></label>
			<input type="text" value="<?php echo esc_attr( $exclude ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'exclude' ) ); ?>" id="<?php seosight_render( $this->get_field_id( 'exclude' ) ); ?>" class="widefat"/>
			<br/>
			<small><?php esc_html_e( 'Category IDs, separated by commas.', 'seosight' ); ?></small>
		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'text_button' ) ); ?>"><?php esc_html_e( 'Text button', 'seosight' ); ?></label>
			<input type="text" value="<?php echo esc_attr( $text_button ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'text_button' ) ); ?>" id="<?php seosight_render( $this->get_field_id( 'text_button' ) ); ?>" class="widefat"/>
		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'link_button' ) ); ?>"><?php esc_html_e( 'Button link', 'seosight' ); ?></label>
			<input type="text" value="<?php echo esc_attr( $link_button ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'link_button' ) ); ?>" id="<?php seosight_render( $this->get_field_id( 'link_button' ) ); ?>" class="widefat"/>
		</p>
		<?php
	}
}
