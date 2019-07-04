<?php
$show_icon        = $icon_header      = $image_header     = $title            = $subtitle         = $price            = $currency         = $show_on_top      = $duration         = $desc             = $show_icon        = $icon             = $show_button      = $button_text      = $button_link      = $custom_class     = $data_icon_header = $data_title       = $data_price       = $data_currency    = $data_duration    = $data_desc        = $data_button      = '';
$hover_zoom       = $highlight        = $data_head_color  = '';
$layout           = 'classic';
$wrap_class       = apply_filters( 'kc-el-class', $atts );

$primary_color = '#f15b26';
extract( $atts );

$wrap_class[] = 'crumina-module';
$wrap_class[] = 'pricing-tables-item';
$wrap_class[] = 'pricing-tables-item-' . $layout;

if ( $hover_zoom === 'yes' )
    $wrap_class[] = 'hover-zoom';

if ( $highlight === 'yes' ) {
    $wrap_class[] = 'highlight';
} elseif ( $hover_zoom === 'yes' ) {
    $wrap_class[] = 'hover-zoom';
}

if ( !empty( $custom_class ) )
    $wrap_class[] = $custom_class;

if ( $show_on_top == 'yes' )
    $wrap_class[] = 'kc-price-before-currency';

if ( $show_icon != 'no' ) {
    if ( $show_icon == 'icon' ) {
        if ( empty( $icon_header ) || $icon_header == '__empty__' ) {
            $icon_header = 'fa-rocket';
        }
        $icon_header = '<i class="' . esc_attr( $icon_header ) . '"></i>';
    } elseif ( $show_icon == 'image' ) {
        $icon_header = '<img src="' . esc_url( $image_header ) . '" alt="' . esc_html( $title ) . '" />';
    }

    $data_icon_header .= '<div class="pricing-tables-icon">' . $icon_header . '</div>';
} else {
    $wrap_class[] = 'no-icon';
}


if ( !empty( $title ) ) {
    $data_title .= '<div class="pricing-title">' . esc_html( $title ) . '</div>';
}


if ( !empty( $desc ) ) {

    $pros = explode( "\n", $desc );
    if ( count( $pros ) ) {

        $data_desc .= '<ul class="pricing-tables-position">';

        foreach ( $pros as $pro ) {
            $data_desc .= '<li class="position-item">' . do_shortcode( $pro ) . ' </li>';
        }

        $data_desc .= '</ul>';
    }
}

if ( !empty( $price ) ) {
    $price      = html_entity_decode( $price );
    $data_price .= '<span class="content-price">' . $price . '</span>';
}

if ( !empty( $currency ) ) {
    $data_currency .= '<span class="content-currency">' . $currency . '</span>';
}

if ( !empty( $duration ) ) {
    $data_duration .= '<span class="content-duration">' . $duration . '</span>';
}

if ( $show_button == 'yes' ) {
    $button_link = kc_parse_link( $button_link );
    
    $button_class = $layout === 'colored' ? 'btn-border' : 'btn--dark';

    $data_button .= '<a class="btn btn-medium ' . esc_attr( $button_class ) . '" href="' . $button_link['url'] . '" title="' . $button_link['title'] . '" target="' . $button_link['target'] . '">';
    $data_button .= '<span class="text">' . esc_html( $button_text ) . '</span>';
    $data_button .= '<span class="semicircle"></span>';
    $data_button .= '</a>';
}

if ( $layout === 'head' ) {
    $data_head_color = '<div class="bg-layer full-block"><div class="pricing-head" style="background-color:' . $primary_color . '"></div></div>';
} else {
    $data_head_color = '<div class="bg-layer full-block" style="background-color:' . $primary_color . '"></div>';
}
?>

<div class="<?php echo implode( ' ', $wrap_class ); ?>">
    <?php seosight_render( $data_head_color ) ?>
    <div class="pricing-table-content">
        <?php
        seosight_render( $data_icon_header );
        seosight_render( $data_title );
        seosight_render( $data_desc );
        echo '<h4 class="rate">';
        if ( $show_on_top == 'yes' ) {
            seosight_render( $data_price . $data_currency . $data_duration );
        } else {
            seosight_render( $data_currency . $data_price . $data_duration );
        }
        echo '</h4>';
        seosight_render( $data_button );
        ?>
    </div>
</div>