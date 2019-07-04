<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Seosight
 */
get_header();
$layout          = seosight_sidebar_conf();
$main_class      = 'full' !== $layout[ 'position' ] ? 'site-main content-main-sidebar' : 'site-main content-main-full';
$container_width = 'container';
$padding_class   = 'medium-padding120';
?>
<div id="primary" class="<?php echo esc_attr( $container_width ) ?>">
    <div class="row <?php echo esc_attr( $padding_class ) ?>">
        <div class="<?php echo esc_attr( $layout[ 'content-classes' ] ) ?>">
            <main id="main" class="<?php echo esc_attr( $main_class ) ?>" >

                <?php
                $form      = '';

                $ext          = function_exists( 'fw' ) ? fw()->extensions->get( 'forms' ) : false;
                $form_id      = get_the_ID();
                $form_options = get_post_meta( $form_id, 'fw_options', true );

                if ( $ext && !empty( $form_id ) && !empty( $form_options ) && isset( $form_options[ 'form' ] ) ) {
                    $submit_text = __( 'Submit', 'seosight' );

                    $submit_html = '<button type="submit" class="btn btn--primary">' . $submit_text . '</button>';

                    $form_html = $ext->render_form( $form_id, $form_options[ 'form' ], 'contact-forms', $submit_html );
                    
                    $message_html = fw_html_tag( 'div', array( 'class' => 'screen-reader-text form-message-field' ), $form_options['success_message'] );
                
                    $form = "<div class=\"standart-form-flex\">{$form_html}{$message_html}</div>";
                }
                

                seosight_render( $form );
                ?>

            </main><!-- #main -->
        </div>
        <?php if ( 'full' !== $layout[ 'position' ] ) { ?>
            <div class="<?php echo esc_attr( $layout[ 'sidebar-classes' ] ) ?>">
                <?php get_sidebar(); ?>
            </div>
        <?php } ?>
    </div><!-- #row -->
</div><!-- #primary -->
<?php
get_footer();
