<?php if ( ! defined( 'ABSPATH' ) ) {
    die( 'Direct access forbidden.' );
}
if ( defined( 'FW' ) ) {
    class Seosight_Widget_Follow_Us extends WP_Widget {

        /**
         * Construct.
         *
         * @internal
         */
        public function __construct() {
            $widget_ops = array(
                    'description'                 => esc_html__( 'Links to company social page', 'seosight' ),
                    'classname'                   => 'w-follow',
                    'customize_selective_refresh' => true
            );
            parent::__construct( false, esc_html__( 'Theme widget: Follow us', 'seosight' ), $widget_ops );
        }

        /**
         * Options.
         *
         * @param array $args
         * @param array $instance
         */

        function widget( $args, $instance ) {
            if ( defined( 'FW' ) ) {

                $title   = apply_filters( 'widget_title', $instance['title'], $instance, $this->id_base );
                $socials = $instance['socials'];

                // Widget frontend. Can be modified via child theme.
                $view_path = fw_locate_theme_path( '/inc/widgets/follow-us/views/widget.php' );
                echo fw_render_view( $view_path, compact( 'args', 'title', 'socials' ) );

            }
        }

        function update( $new_instance, $old_instance ) {

            $instance            = $old_instance;
            $instance['title']   = strip_tags( $new_instance['title'] );
            $instance['socials'] = $new_instance['socials'];


            return $instance;

        }

        function form( $instance ) {
            $title   = empty( $instance['title'] ) ? esc_html__( 'Follow Us', 'seosight' ) : $instance['title'];
            $socials = isset( $instance['socials'] )
                    ? array_values( $instance['socials'] )
                    : array( array( 'id' => 1, 'network' => '', 'name' => '', 'link' => '' ) );
            ?>

            <p>
                <label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_html_e( 'Title:', 'seosight' ); ?></label>
                <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"
                       name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text"
                       value="<?php echo esc_attr( $title ); ?>"/>
            </p>

            <!-- segment #2 -->

            <?php ob_start(); ?>
            <p>
                <label for="<?php echo esc_attr( $this->get_field_id( 'socials' ) ); ?>-<%- id %>-network"><?php esc_html_e( 'Social networks', 'seosight' ); ?>
                    :</label>
                <select id="<?php echo esc_attr( $this->get_field_id( 'socials' ) ); ?>-<%- id %>-network"
                        class="widefat"
                        name="<?php echo esc_attr( $this->get_field_name( 'socials' ) ); ?>[<%- id %>][network]">
                    <% if (network !== null) { %>
                    <option selected value="<%- network %>"><%- network %></option>
                    <% } %>
                    <?php
                    $social_networks = seosight_user_social_networks();
                    foreach ( $social_networks as $social_network => $data ) {
                        echo '<option value="' . $social_network . '">' . $data['label'] . '</option>';
                    }
                    ?>
                </select>
            </p>

            <p>
                <label for="<?php echo esc_attr( $this->get_field_id( 'socials' ) ); ?>-<%- id %>-link"><?php esc_html_e( 'Link', 'seosight' ) ?>
                    :</label>
                <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'socials' ) ); ?>-<%- id %>-link"
                       name="<?php echo esc_attr( $this->get_field_name( 'socials' ) ); ?>[<%- id %>][link]" type="text"
                       value="<%- link %>"/>
            </p>
            <p>
                <input name="<?php echo esc_attr( $this->get_field_name( 'socials' ) ); ?>[<%- id %>][id]" type="hidden"
                       value="<%- id %>"/>
                <a href="#"
                   class="js-remove-social widget-control-remove"><?php esc_html_e( 'Remove', 'seosight' ) ?></a>
            </p>
            <?php $js_content = ob_get_clean();
            echo fw_html_tag( 'script', array(
                    'type' => 'text/template',
                    'id'   => 'js-social-' . esc_attr( $this->id )
            ), $js_content ); ?>


            <!-- segment #3 -->
            <div id="js-socials-<?php echo esc_attr( $this->id ); ?>">
                <div id="js-socials-list"></div>
                <p>
                    <a href="#" class="button" id="js-socials-add"><?php esc_html_e( 'Add New', 'seosight' ) ?></a>
                </p>
            </div>

            <!-- segment #4 -->
            <?php ob_start(); ?>
            var socialsJSON = <?php echo json_encode( $socials ) ?>;
            myWidgets.repopulateSocials( '<?php echo esc_attr( $this->id ); ?>', socialsJSON );
            <?php $js_content = ob_get_clean();
            echo fw_html_tag( 'script', array( 'type' => 'text/javascript' ), $js_content ); ?>

            <?php
        }
    }
}