<?php
/**
 * Template part for displaying Login widget when user authorized.
 * You free to customize widget contents in child theme.
 * Copy that file into 'template-parts' folder of your Child Theme.
 *
 * @package Seosight
 */

global $allowedposttags;
$template_uri = get_template_directory_uri();
$author_id    = get_the_author_meta( 'ID' );
$description  = get_the_author_meta( 'description' );
$socials      = seosight_user_social_networks();
if ( ! empty( $description ) ) {
    ?>
    <div class="blog-details-author">

        <div class="blog-details-author-thumb">
            <?php echo get_avatar( $author_id, 110 ); ?>

        </div>

        <div class="blog-details-author-content">
            <div class="author-info">
                <h5 class="author-name"><a
                            href="<?php echo get_author_posts_url( $author_id ); ?>"><?php the_author_meta( 'display_name', $author_id ); ?></a>
                </h5>
                <p class="author-info"><?php the_author_meta( 'user_profession' ); ?></p>
            </div>
            <div class="text"><?php echo wp_kses( wpautop( $description ), $allowedposttags ); ?></div>
            <div class="socials">
                <?php
                foreach ( $socials as $network => $data ) {
                    if ( get_the_author_meta( $network ) ) {
                        $url   = get_the_author_meta( $network );
                        $label = $data['label']; ?>
                        <a href="<?php echo esc_attr( $url ); ?>" class="social__item"
                           title="<?php echo esc_attr( $data['label'] ) ?>">
                            <img src="<?php echo esc_url( get_template_directory_uri() . '/svg/socials/' . esc_attr( $network ) . '.svg' ); ?>"
                                 alt="<?php echo esc_attr( $data['label'] ) ?>">
                        </a>
                        <?php
                    }
                }
                ?>
            </div>
        </div>
    </div>
<?php }