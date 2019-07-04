<?php

$video_box_id = uniqid( 'video' );
$block_style  = '';
$type         = $data_options = $youtube_id = $full_bg = $video_width = $video_link = $vimeo_id = $auto_play = $placeholder = $source = $mp4 = $webm = $ogg = $full_width = '';

extract( $atts );

$run_js = 'document.addEventListener("DOMContentLoaded", function(){setTimeout(function(){ CRUMINA.initVideo(); }, 600);});';

wp_enqueue_script( 'plyr-js' );
wp_add_inline_script( 'plyr-js', $run_js );

$block_classes   = apply_filters( 'kc-el-class', $atts );
$block_classes[] = 'crumina-module';
$block_classes[] = 'crumina-our-video';


$el_class = 'button' === $type ? 'plyr-module' : 'plyr';

if ( ! empty( $wrap_class ) ) {
    $block_classes[] = $wrap_class;
}
if ( $full_bg !== 'full' ) {
    $block_classes[] = 'height-image';
}

if ( $auto_play == 'yes' ) {
    $data_options = '"autoplay": true';
    $el_class .= ' hide-controls';
}
if ( $full_bg == 'full' ) {
    $thumb_class = 'video-thumb full-block';
    $thumb_style = 'style="background-image:url(' . esc_url( $placeholder ) . ')"';
} else {
    $thumb_class = 'video-thumb';
    $thumb_style = '';
}
if ( $full_width != 'yes' && $type == 'player' && ! empty( $video_width ) ) {
    $video_height = intval( $video_width ) / 1.77;

    $block_style = 'style="width:' . esc_attr( $video_width ) . 'px; height:' . esc_attr( $video_height ) . 'px"';
}


ob_start();
// Generate video player.
?>

<div class="<?php echo esc_attr( $el_class ) ?>" data-source="<?php echo esc_attr( $source ); ?>"
        <?php seosight_render( $block_style ); ?>
     data-plyr='{<?php echo esc_attr( $data_options ) ?>}'>

	<?php if ( 'oembed' === $source ) {
		seosight_show_oembed( $video_link );
	} else { ?>
        <video poster="<?php echo esc_url( $placeholder ); ?>" controls>
            <!-- Video files -->
			<?php
			$mp4_link = $mp4;
			if ( ! empty( $mp4 ) ) {
				echo '<source src="' . esc_url( $mp4 ) . '" type="video/mp4">';
			}
			if ( ! empty( $webm ) ) {
				echo '<source src="' . esc_url( $webm ) . '" type="video/webm">';
			}
			if ( ! empty( $ogg ) ) {
				echo '<source src="' . esc_url( $ogg ) . '" type="video/ogg">';
			} ?>
			<?php if ( ! empty( $mp4_link ) ) { ?>
                <!-- Fallback for browsers that don't support the <video> element -->
                <a href="<?php echo esc_url( $mp4_link ); ?>"><?php esc_html_e( 'Download', 'seosight' ); ?></a>
			<?php } ?>
        </video>
	<?php } ?>
</div>
<?php $video_player_html = ob_get_clean(); ?>

    <div class="<?php echo esc_attr( implode( ' ', $block_classes ) ) ?>">
    <?php if ( 'button' === $type ) { ?>
        <?php if ( ! empty( $placeholder ) ) { ?>
            <div class="<?php echo esc_attr( $thumb_class ) ?>" <?php seosight_render( $thumb_style ) ?>>
                <div class="overlay"></div>
                <?php
                if ( $full_bg == 'image' ) {
                    echo '<img src="' . esc_url( $placeholder ) . '" alt="video background">';
                } ?>
                <a href="#<?php echo esc_attr( $video_box_id ); ?>" class="video-control js-open-video">
                    <img src="<?php echo get_template_directory_uri() ?>/svg/video-control.svg" alt="go">
                </a>
            </div>
        <?php } else { ?>
            <a href="#<?php echo esc_attr( $video_box_id ); ?>" class="video-control js-open-video">
                <img src="<?php echo get_template_directory_uri() ?>/svg/video-control.svg" alt="go">
            </a>
        <?php } ?>
        <div id="<?php echo esc_attr( $video_box_id ); ?>" class="popup-video-holder mfp-hide">
            <?php seosight_render( $video_player_html ); ?>
        </div>
    <?php } else {
        seosight_render( $video_player_html );
    } ?>
</div>
<?php kc_js_callback( 'CRUMINA.initVideo' ); ?>