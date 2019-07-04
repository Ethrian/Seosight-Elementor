<?php if ( ! defined( 'ABSPATH' ) ) {
	die( 'Direct access forbidden.' );
}


 class Seosight_Widget_Banner extends WP_Widget {

	/**
	 * Construct.
	 *
	 * @internal
	 */
	public function __construct() {
		$widget_ops = array( 'description' => 'create own custom banner', 'classname' => 'w-banner' );
		parent::__construct( false, esc_html__( 'Theme widget: Banner', 'seosight' ), $widget_ops );
	}

	/**
	 * Options.
	 *
	 * @param array $args
	 * @param array $instance
	 */

	function widget( $args, $instance ) {
		if ( defined( 'FW' ) ) {

			$title = apply_filters( 'widget_title', $instance['title'], $instance, $this->id_base );
			$background = isset($instance['background']) ? $instance['background'] : '';
			$icon = isset($instance['icon']) ? $instance['icon'] : '';
			$text = isset($instance['description']) ? $instance['description'] : '';
			$button_text = isset($instance['button_text']) ? $instance['button_text'] : '';
			$button_link = isset($instance['button_link']) ? $instance['button_link'] : '';
			$button_color = isset($instance['button_color']) ? $instance['button_color'] : '';

			// Widget frontend. Can be modified via child theme.
			$view_path = fw_locate_theme_path( '/inc/widgets/banner/views/widget.php' );
			echo fw_render_view( $view_path, compact( 'args', 'title','background', 'icon', 'text', 'button_text', 'button_link', 'button_color' ) );
		}
	}

	function update( $new_instance, $old_instance ) {

		$instance = $old_instance;

		$instance['title']        = esc_html( $new_instance['title'] );
		$instance['background'] = esc_url($new_instance['background']);
		$instance['icon'] = esc_url($new_instance['icon']);
		$instance['description']  = $new_instance['description'];
		$instance['button_text']  = esc_html( $new_instance['button_text'] );
		$instance['button_link']  = esc_url( $new_instance['button_link'] );
		$instance['button_color'] = esc_attr( $new_instance['button_color'] );

		return $instance;

	}

	function form( $instance ) {

		$instance = wp_parse_args( (array) $instance, array(
			'title'        => '',
			'background' => '',
			'icon' => '',
			'description'  => '',
			'button_text'  => '',
			'button_link'  => '',
			'button_color' => '',
		) );

		$background  = esc_attr($instance['background']);
		$icon  = esc_url($instance['icon']);
		$title        = strip_tags( $instance['title'] );
		$description  = esc_textarea( $instance['description'] );
		$button_text  = strip_tags( $instance['button_text'] );
		$button_link  = esc_url( $instance['button_link'] );
		$button_color = esc_attr( $instance['button_color'] );

		$widget_output = '';

		//Widget title
		$widget_output .= '<p>';
		$widget_output .= '<label for="' . esc_attr( $this->get_field_id( 'title' ) ) . '">' . esc_html__( 'Title', 'seosight' ) . '</label>';
		$widget_output .= '<input class="widefat" id="' . esc_attr( $this->get_field_id( 'title' ) ) . '" name="' . esc_attr( $this->get_field_name( 'title' ) ) . '" type="text" value="' . esc_attr( $title ) . '">';
		$widget_output .= '</p>';

		//Widget background
		$widget_output .= '<p>';
		$widget_output .= '<label for="' . esc_attr( $this->get_field_id( 'background' ) ) . '">' . esc_html__( 'Background image', 'seosight' ) . '</label>';
		$widget_output .= '<input class="widefat widget_image_add" id="' . esc_attr( $this->get_field_id( 'background' ) ) . '" name="' . esc_attr( $this->get_field_name( 'background' ) ) . '" type="text" value="' . esc_attr( $background ) . '">';
		$widget_output .= '<a href="#" class="add-item-image button">' . esc_html__( 'Add image', 'seosight' ) . '</a><a href="#" class="remove-item-image button">' . esc_html__( 'Remove image', 'seosight' ) . '</a>';
		$widget_output .= '</p>';

		//Widget icon
		$widget_output .= '<p>';
		$widget_output .= '<label for="' . esc_attr( $this->get_field_id( 'icon' ) ) . '">' . esc_html__( 'Icon image', 'seosight' ) . '</label>';
		$widget_output .= '<input class="widefat widget_image_add" id="' . esc_attr( $this->get_field_id( 'icon' ) ) . '" name="' . esc_attr( $this->get_field_name( 'icon' ) ) . '" type="text" value="' . esc_attr( $icon ) . '">';
		$widget_output .= '<a href="#" class="add-item-image button">' . esc_html__( 'Add image', 'seosight' ) . '</a><a href="#" class="remove-item-image button">' . esc_html__( 'Remove image', 'seosight' ) . '</a>';
		$widget_output .= '</p>';

		//Description
		$widget_output .= '<p>';
		$widget_output .= '<label for="' . $this->get_field_id( 'description' ) . '">' . esc_html__( 'Description', 'seosight') . '</label>';
		$widget_output .= '<textarea id="' . $this->get_field_id( 'description' ) . '" name="' . $this->get_field_name( 'description' ) . '" class="widefat" rows="3">';
		$widget_output .=  $description;
		$widget_output .= '</textarea>';
		$widget_output .= '</p>';

		//Button text
		$widget_output .= '<p>';
		$widget_output .= '<label for="' . esc_attr( $this->get_field_id( 'button_text' ) ) . '">' . esc_html__( 'Button text', 'seosight' ) . '</label>';
		$widget_output .= '<input class="widefat" id="' . esc_attr( $this->get_field_id( 'button_text' ) ) . '" name="' . esc_attr( $this->get_field_name( 'button_text' ) ) . '" type="text" value="' . esc_attr( $button_text ) . '">';
		$widget_output .= '</p>';

		//Button link
		$widget_output .= '<p>';
		$widget_output .= '<label for="' . esc_attr( $this->get_field_id( 'button_link' ) ) . '">' . esc_html__( 'Button link', 'seosight' ) . '</label>';
		$widget_output .= '<input class="widefat" id="' . esc_attr( $this->get_field_id( 'button_link' ) ) . '" name="' . esc_attr( $this->get_field_name( 'button_link' ) ) . '" type="text" value="' . esc_attr( $button_link ) . '">';
		$widget_output .= '</p>';

		//Button color
		$widget_output .= '<p>';
		$widget_output .= '<label for="' . esc_attr( $this->get_field_id( 'button_color' ) ) . '">' . esc_html__( 'Button color', 'seosight' ) . '</label>';

		$widget_output .= '<select class="widefat colored-options" id="' . esc_attr( $this->get_field_id( 'button_color' ) ) . '" name="' . esc_attr( $this->get_field_name( 'button_color' ) ) . '">';
		$colors = seosight_button_colors();
		foreach ( $colors as $key => $value ) {
			$widget_output .= '<option value="' . $key . '" ' . selected( $key, $button_color, false ) . '>' . $value . '</option>';
		};
		$widget_output .= '</select>';
		$widget_output .= '</p>';

		seosight_render( $widget_output );

	}

}
