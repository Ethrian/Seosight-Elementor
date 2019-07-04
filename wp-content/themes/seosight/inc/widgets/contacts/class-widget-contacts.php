<?php if ( ! defined( 'ABSPATH' ) ) {
    die( 'Direct access forbidden.' );
}

class Seosight_Widget_Contacts extends WP_Widget {

    public function __construct() {
        parent::__construct(
                false,
                esc_html__( 'Theme widget: Contacts', 'seosight' ),
	        array( 'description' => '', 'classname' => 'w-contacts' )
        );
        add_action( 'admin_enqueue_scripts', array( $this, 'upload_scripts' ) );
    }


    public function upload_scripts() {
        wp_enqueue_media();
    }

    /**
     * Renders the widget to the visitors
     */
    public function widget( $args, $instance ) {

        if ( defined( 'FW' ) ) {

            $title    = apply_filters( 'widget_title', $instance['title'], $instance, $this->id_base );
            $text     = isset( $instance['text'] ) ? $instance['text'] : '';
            $contacts = isset( $instance['contacts'] ) ? $instance['contacts'] : array();

            // Widget frontend. Can be modified via child theme.
            $view_path = fw_locate_theme_path( '/inc/widgets/contacts/views/widget.php' );
            echo fw_render_view( $view_path, compact( 'args', 'title', 'text', 'contacts' ) );

        }
    }

    /**
     * Sanitizes the widget input before saving the data
     */
    public function update( $new_instance, $old_instance ) {
        $instance             = array();
        $instance['title']    = wp_kses_post( $new_instance['title'] );
        $instance['contacts'] = $new_instance['contacts'];
        $instance['text']     = $new_instance['text'];

        return $instance;
    }

    /**
     * The most important function, used to show the widget form in the wp-admin
     */
    public function form( $instance ) {
        $title     = isset( $instance['title'] ) ? $instance['title'] : 'Get In Touch';
        $valuetext = isset( $instance['text'] ) ? $instance['text'] : '';
        $contacts  = isset( $instance['contacts'] )
                ? array_values( $instance['contacts'] )
                : array( array( 'id' => 1, 'icon' => '', 'value' => '', 'desc' => '' ) );
        ?>
        <!-- Standard widget fields -->
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_html_e( 'Title', 'seosight' ); ?></label>
            <input type="text" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>"
                   value="<?php echo esc_attr( $title ); ?>" class="widefat"
                   id="<?php esc_attr( $this->get_field_id( 'title' ) ); ?>"/>
        </p>
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'text' ) ); ?>"><?php esc_html_e( 'Description Text', 'seosight' ); ?></label>
            <textarea name="<?php echo esc_attr( $this->get_field_name( 'text' ) ); ?>"
                      class="widefat"
                      id="<?php esc_attr( $this->get_field_id( 'text' ) ); ?>"><?php echo esc_attr( $valuetext ); ?></textarea>
        </p>

        <!-- segment #2 -->
        <?php ob_start(); ?>
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'contacts' ) ); ?>-<%- id %>-icon"><?php esc_html_e( 'Icon', 'seosight' ) ?>
                :</label>
            <input class="widefat widget_image_add"
                   id="<?php echo esc_attr( $this->get_field_id( 'contacts' ) ); ?>-<%- id %>-icon"
                   name="<?php echo esc_attr( $this->get_field_name( 'contacts' ) ); ?>[<%- id %>][icon]" type="text"
                   value="<%- icon %>"/>
            <a href="#" class="add-item-image button"><?php echo esc_html__( 'Add image', 'seosight' ); ?></a>
            <a href="#" class="remove-item-image button"><?php echo esc_html__( 'Remove image', 'seosight' ); ?></a>
        </p>
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'contacts' ) ); ?>-<%- id %>-value"><?php esc_html_e( 'Value Field', 'seosight' ) ?>
                :</label>
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'contacts' ) ); ?>-<%- id %>-value"
                   name="<?php echo esc_attr( $this->get_field_name( 'contacts' ) ); ?>[<%- id %>][value]" type="text"
                   value="<%- value %>"/>
        </p>
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'contacts' ) ); ?>-<%- id %>-desc"><?php esc_html_e( 'Description', 'seosight' ) ?>
                :</label>
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'contacts' ) ); ?>-<%- id %>-desc"
                   name="<?php echo esc_attr( $this->get_field_name( 'contacts' ) ); ?>[<%- id %>][desc]" type="text"
                   value="<%- desc %>"/>
        </p>
        <p>
            <input name="<?php echo esc_attr( $this->get_field_name( 'contacts' ) ); ?>[<%- id %>][id]" type="hidden"
                   value="<%- id %>"/>
            <a href="#"
               class="js-remove-contact widget-control-remove"><?php esc_html_e( 'Remove', 'seosight' ) ?></a>
        </p>
        <?php $js_content = ob_get_clean();
        echo fw_html_tag( 'script', array(
                'type' => 'text/template',
                'id'   => 'js-contact-' . esc_attr( $this->id )
        ), $js_content ); ?>

        <!-- segment #3 -->
        <div id="js-contacts-<?php echo esc_attr( $this->id ); ?>">
            <div id="js-contacts-list"></div>
            <p>
                <a href="#" class="button" id="js-contact-add"><?php esc_html_e( 'Add New', 'seosight' ) ?></a>
            </p>
        </div>

        <!-- segment #4 -->
        <?php ob_start(); ?>
        var contactsJSON = <?php echo json_encode( $contacts ) ?>;
        myWidgets.repopulateContacts('<?php echo esc_attr( $this->id ); ?>', contactsJSON);
        <?php $js_content = ob_get_clean();
        echo fw_html_tag( 'script', array( 'type' => 'text/javascript' ), $js_content );

    }

}
