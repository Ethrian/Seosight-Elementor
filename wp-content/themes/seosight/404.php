<?php
/**
 * The template for displaying 404 pages (not found).
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package Seosight
 */

get_header(); ?>
	<!-- Page 404 content  -->
	<div class="container-fluid">
		<div class="row">
			<div class="content-page-404">
				<div class="container">
					<div class="row">
						<div class="col-lg-7 col-md-7 col-sm-12 col-xs-12">
							<h4 class="title">404</h4>
							<div class="subtitle"><?php esc_html_e( 'Sorry! The Page Not Found', 'seosight' ); ?>;(</div>
							<p class="text"><?php esc_html_e( 'Sorry! The Page Is Not Found The Link You Followed Is Probably Broken', 'seosight' ); ?></p>
							<a href="<?php echo esc_url( site_url() ) ?>" class="btn btn-small btn--primary btn-hover-shadow">
								<?php esc_html_e( 'Return to Home', 'seosight' ); ?>
							</a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<!-- End Page 404 content  -->

<?php
get_footer();