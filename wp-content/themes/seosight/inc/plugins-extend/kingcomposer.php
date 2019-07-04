<?php

if ( !defined( 'ABSPATH' ) ) {
    die( 'Direct access forbidden.' );
}

// Verify KingKomposer Extended license.
define('KC_LICENSE', 'cotqi27p-3esf-2rv6-ogzf-lspn-i25jk11s1brl');

/*
 * KingComposer editor additional hooks and actions.
 */
add_action( 'init', 'seosight_kingkomposer_modifications', 999 );

// Plain HTML field for composer admin panel.
function kc_seosight_html_field() {
    echo '<div id="{{data.name}}" class="kc-param">{{{data.value}}}</div>';
}

// Number field for composer admin panel.
function kc_seosight_number_field() {
    echo '<input name="{{data.name}}" class="kc-param" value="{{data.value}}" type="number" min="1" />';
}

// Proper date field for composer admin panel.
function kc_seosight_date_field() {
    ?>
    <input name="{{data.name}}" class="kc-param" value="{{data.value}}" type="text"/>
    <#
    data.callback = function( wrp, $ ){
    var d = new Pikaday(
    {
    field: wrp.find('.kc-param').get(0),
    firstDay: 1,
    formatStrict:true,
    format: 'L',
    minDate: false,
    maxDate: false,
    yearRange: [2000,2020],
    format: 'DD/MM/YYYY'
    });
    }
    #>
    <?php

}

// Theme modifcations and new modules
function seosight_kingkomposer_modifications() {
    global $kc;
    //add new parameters for composer
    $kc->add_param_type( 'html-full', 'kc_seosight_html_field' );
    $kc->add_param_type( 'crum-number', 'kc_seosight_number_field' );
    $kc->add_param_type( 'crum_date_picker', 'kc_seosight_date_field' );

    // Add custom icon pack.
    if ( function_exists( 'kc_add_icon' ) ) {
        kc_add_icon( get_template_directory_uri() . '/css/seotheme.css' );
    }

    $live_tmpl   = get_template_directory() . '/kingcomposer/live_editor/';
    $images_path = get_template_directory_uri() . '/images/admin/';


    /* Row options modifications */
    $kc->remove_map_param( 'kc_row', 'animate', 'animate' );

    $kc->update_map( 'kc_row', 'live_editor', $live_tmpl . 'crum_row.tpl' );

    $kc->add_map_param( 'kc_row', array(
        'name'        => 'row_animation',
        'label'       => esc_html__( 'Row animation effect on scroll', 'seosight' ),
        'type'        => 'radio_image',
        'options'     => array(
            'your-score'            => $images_path . 'animation-1.png',
            'background-mountains' => $images_path . 'animation-2.png',
            'testimonial-slider'   => $images_path . 'animation-3.png',
            'subscribe'            => $images_path . 'animation-4.png',
            'our-vision'           => $images_path . 'animation-5.png',
        ),
        'description' => esc_html__( 'Animations will be hidden in frontend editor for better performance.', 'seosight' )
    ), 1, 'animate' );

    $kc->add_map_param( 'kc_row', array(
        'name'        => 'row_text_color',
        'label'       => esc_html__( 'Text color', 'seosight' ),
        'type'        => 'color_picker',
        'description' => esc_html__( 'Primary color option for inner text. Can be changed in any inner module.', 'seosight' )
    ), 1, 'styling' );

    $kc->add_map_param( 'kc_row', array(
        'name'  => 'enable_particle_bg',
        'label' => esc_html__( 'Enable particle background effect?', 'seosight' ),
        'type'  => 'toggle',
        'value' => 'no'
    ), 10 );

    // Remove some default modules.
    if ( function_exists( 'kc_remove_map' ) ) {
        kc_remove_map( 'kc_nested' );
        kc_remove_map( 'kc_box' );
        kc_remove_map( 'kc_coundown_timer' );
        kc_remove_map( 'kc_pricing' );
        kc_remove_map( 'kc_image_hover_effects' );
        kc_remove_map( 'kc_creative_button' );
        kc_remove_map( 'kc_tooltip' );
        kc_remove_map( 'kc_blog_posts' );
        kc_remove_map( 'kc_post_type_list' );
        kc_remove_map( 'kc_creative_button' );
        kc_remove_map( 'kc_flip_box' );
        kc_remove_map( 'kc_progress_bars' );
        kc_remove_map( 'kc_pie_chart' );
        kc_remove_map( 'kc_button' );
        kc_remove_map( 'kc_title' );
        kc_remove_map( 'kc_accordion' );
        kc_remove_map( 'kc_team' );
        kc_remove_map( 'kc_single_image' );
        kc_remove_map( 'kc_dropcaps' );
        kc_remove_map( 'kc_google_maps' );
        kc_remove_map( 'kc_video_play' );
        kc_remove_map( 'kc_counter_box' );
        kc_remove_map( 'kc_icon' );
        kc_remove_map( 'kc_feature_box' );
        kc_remove_map( 'kc_testimonial' );
        kc_remove_map( 'kc_call_to_action' );
        kc_remove_map( 'kc_carousel_post' );
        kc_remove_map( 'kc_contact_form7' );
    }

    // Small text shortcodes. Without dedicated blocks.
    if ( function_exists( 'kc_add_map' ) ) {
        kc_add_map(
        array(
            'tip' => array(
                'name'        => 'Tooltip',
                'system_only' => true,
                'assets'      =>
                array(
                    'styles'  =>
                    array(
                        'tippy-css' => get_template_directory_uri() . '/css/tippy.css',
                    ),
                    'scripts' =>
                    array(
                        'tippy-js' => get_template_directory_uri() . '/js/tippy.min.js',
                    ),
                ),
                'params'      => array(
                    'general' => array(
                        array(
                            'name'  => 'text',
                            'label' => esc_html__( 'Text', 'seosight' ),
                            'type'  => 'text',
                        ),
                    ),
                )
            ),
        )
        );
    }


    $modules_path = get_template_directory() . '/inc/modules';

    // activate addons one by one from modules directory

    foreach ( glob( $modules_path . "/*.php" ) as $module ) {
        load_template( $module, true );
    }

    function seosight_dequeue_kingcomposer_front_css( $styles ) {

        unset( $styles[ 'kc-general' ] );

        return $styles;
    }

    add_filter( 'kc_enqueue_styles', 'seosight_dequeue_kingcomposer_front_css', 10, 1 );

    add_action( 'admin_init', '_action_seosight_fw_ext_page_builder_remove_support' );

    function _action_seosight_fw_ext_page_builder_remove_support() {
        $extensions = get_option( 'fw_active_extensions' );
        if ( isset( $extensions[ 'page-builder' ] ) ) {
            unset( $extensions[ 'page-builder' ] );
            update_option( 'fw_active_extensions', $extensions );
        }
    }

    add_action( 'wp_enqueue_scripts', '_action_seosight_kingcomposer_extend_styles' );
    function _action_seosight_kingcomposer_extend_styles(){
        wp_enqueue_style( 'kingcomposer-extend', get_template_directory_uri() . '/css/kingcomposer.css' );
    }
}

/**
 * Show a shop page description on product archives.
 *
 * @subpackage  Archives
 */
function woocommerce_product_archive_description() {
    // Don't display the description on search results page
    if ( is_search() ) {
        return;
    }

    if ( is_post_type_archive( 'product' ) && 0 === absint( get_query_var( 'paged' ) ) ) {
        if ( is_shop() ) {
            $shop_page    = wc_get_page_id( 'shop' );
            $builder_meta = get_post_meta( $shop_page, 'kc_data', true );
            if ( isset( $builder_meta[ 'mode' ] ) && 'kc' === $builder_meta[ 'mode' ] ) {
                $page_content = get_post_field( 'post_content_filtered', $shop_page );
                echo apply_filters( 'the_content', $page_content );
            } else {
                $description = wc_format_content( get_post_field( 'post_content', $shop_page ) );
                if ( $description ) {
                    echo '<div class="page-description">' . $description . '</div>';
                }
            }
        }
    }
}
