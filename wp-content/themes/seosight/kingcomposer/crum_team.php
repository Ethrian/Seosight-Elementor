<?php
$title         = $subtitle      = $desc          = $image         = $custom_class  = $data_img      = $data_title    = $data_desc     = $data_subtitle = $img_size      = $data_socials  = $socials       = $data_button   = $link     = '';
$layout        = 1;
$wrap_class    = apply_filters( 'kc-el-class', $atts );

extract( $atts );

$wrap_class[] = 'crumina-module';
$wrap_class[] = 'crumina-teammembers-item';

if ( !empty( $custom_class ) ) {
    $wrap_class[] = $custom_class;
}

$link_page = kc_parse_link( $link );
?>
<div class="<?php echo implode( ' ', $wrap_class ); ?>">
    <div class="module-image">
        <?php
        if ( $image > 0 ) {
            $img_link = wp_get_attachment_image_src( $image, $img_size );
            $img_link = $img_link[ 0 ];
            if ( $link_page[ 'url' ] && $link_page[ 'url' ] !== '#' ) {
                ?>
                <a href="<?php echo esc_url( $link_page[ 'url' ] ) ?>" title="<?php echo esc_attr( $link_page[ 'title' ] ); ?>" target="<?php echo esc_attr( $link_page[ 'target' ] ); ?>">
                    <img src="<?php echo esc_url( $img_link ); ?>" alt="<?php echo esc_attr( $title ) ?>">
                </a>
            <?php } else { ?>
                <img src="<?php echo esc_url( $img_link ); ?>" alt="<?php echo esc_attr( $title ) ?>">
            <?php } ?>
        </div>
    <?php } if ( !empty( $title ) ) { ?>
        <h5 class="teammembers-item-name">
            <?php
            if ( $link_page[ 'url' ] && $link_page[ 'url' ] !== '#' ) {
                echo '<a href="' . esc_url( $link_page[ 'url' ] ) . '" title="' . $link_page[ 'title' ] . '" target="' . $link_page[ 'target' ] . '">' . esc_html( $title ) . '</a>';
            } else {
                echo esc_html( $title );
            }
            ?>
        </h5>
    <?php } if ( !empty( $subtitle ) ) { ?>
        <p class="teammembers-item-prof"><?php echo esc_html( $subtitle ) ?></p>
        <?php
    }

    if ( !empty( $social_networks ) ) {
        echo '<div class="socials">';
        foreach ( $social_networks as $key => $item ) {
            echo '<a href="' . esc_url( $item->link ) . '" class="social__item">';
            echo '<img src="' . get_template_directory_uri() . '/svg/socials/' . esc_attr( $item->icon ) . '" alt="' . esc_attr( $item->icon ) . '">';
            echo '</a>';
        }
        echo '</div>';
    }
    ?>
</div>