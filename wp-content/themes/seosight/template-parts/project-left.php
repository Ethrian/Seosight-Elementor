<?php
/**
 * Template part for displaying portfolio short content.
 *
 * @package Seosight
 */
global $allowedposttags;

$fw_ext_projects_gallery_image	 = fw()->extensions->get( 'portfolio' )->get_config( 'image_sizes' );
$fw_ext_projects_gallery_image	 = $fw_ext_projects_gallery_image[ 'gallery-image' ];


$alt_title	 = fw_get_db_post_option( get_the_ID(), 'project-title', '' );
$page_title	 = !empty( $alt_title ) ? $alt_title : get_the_title();

$desc	 = fw_get_db_post_option( get_the_ID(), 'project-desc', '' );
$button	 = fw_get_db_post_option( get_the_ID(), 'project-button', '' );
if ( !isset( $button[ 'background' ] ) ) {
	$button[ 'background' ] = '';
}

$show_date	 = fw_get_db_customizer_option( 'folio-data-show', 'yes' );
$show_likes	 = fw_get_db_customizer_option( 'folio-likes-show', 'yes' );

$enable_customization = fw_get_db_post_option( $page_id, 'custom-description/enable', 'no' );
if ( 'yes' === $enable_customization ) {
	$show_date_custom	 = fw_get_db_post_option( get_the_ID(), 'custom-description/yes/folio-data-show', 'default' );
	$show_likes_custom	 = fw_get_db_post_option( get_the_ID(), 'custom-description/yes/folio-likes-show', 'default' );
}
$show_date	 = (!empty( $show_date_custom ) && 'default' !== $show_date_custom ) ? $show_date_custom : $show_date;
$show_likes	 = (!empty( $show_likes_custom ) && 'default' !== $show_likes_custom ) ? $show_likes_custom : $show_likes;
?>
<!-- Product description -->
<div class="container-fluid">
	<div class="row bg-border-color medium-padding120">
		<div class="container">
			<div class="row">
				<div class="product-description-ver2">
					<div class="col-lg-7 col-md-7 col-sm-12 col-xs-12">
						<?php
						$video		 = seosight_get_project_video();
						$thumbnails	 = fw_ext_portfolio_get_gallery_images();
						if ( $video ) {
							?>
							<div class="responsive-video">
								<?php seosight_render( $video ); ?>
							</div>
						<?php } else if ( !empty( $thumbnails ) ) { ?>
							<div class="swiper-container auto-height shadow-enable" data-effect="fade" data-autoplay="4000">
								<!-- Additional required wrapper -->
								<div class="swiper-wrapper">
									<!-- Slides -->
									<?php
									foreach ( $thumbnails as $thumbnail ) :
										$attachment = get_post( $thumbnail[ 'attachment_id' ] );
										?>
										<div class="swiper-slide">
											<div class="image-wrap">
												<?php echo wp_get_attachment_image( $thumbnail[ 'attachment_id' ], 'large' ) ?>
											</div>
										</div>
									<?php endforeach ?>
									<!-- If we need pagination -->
									<div class="swiper-pagination"></div>
								</div>
							</div>
							<?php
						} elseif ( has_post_thumbnail() ) {
							the_post_thumbnail( 'large' );
						}
						?>
					</div>

                    <div class="col-lg-4 col-lg-offset-1 col-md-5 col-md-offset-0 col-sm-12 col-xs-12">
						<div class="product-description-ver2-content">
							<div class="project-meta">
								<?php
								if ( 'yes' === $show_date ) {
									echo seosight_posted_time( false );
								}
								?>

								<?php
								if ( 'yes' === $show_likes ) {
									echo get_crumina_likes_button( get_the_ID() );
								}
								?>
							</div>
							<div class="heading">
								<?php echo fw_html_tag( 'h2', array( 'class' => 'h1 heading-title' ), esc_html( $page_title ) ); ?>
								<?php echo wp_kses( $desc, $allowedposttags ); ?>
							</div>
							<?php
							if ( !empty( $button[ 'label' ] ) ) {
								$link = seosight_gen_link_for_shortcode( $button );
								?>
								<a href="<?php echo esc_url( $link[ 'link' ] ) ?>" style="background-color: <?php echo esc_attr( $button[ 'background' ] ? $button[ 'background' ] : '#2f2c2c'  ); ?>;" target="<?php echo esc_attr( $link[ 'target' ] ) ?>" class="btn btn-medium btn-hover-shadow">
									<span class="text"><?php echo esc_html( $button[ 'label' ] ) ?></span>
									<?php
									if ( '_blank' === $link[ 'target' ] ) {
										echo '<i class="seoicon-right-arrow"></i>';
									} else {
										echo '<span class="semicircle"></span>';
									}
									?>
								</a>
							<?php } ?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- End Product description -->