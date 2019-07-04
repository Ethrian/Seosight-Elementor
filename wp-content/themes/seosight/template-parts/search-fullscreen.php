<?php
/**
 * Template part for displaying search form.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Seosight
 */
?>
<!-- Overlay Search-->
<div class="overlay_search">
	<div class="container">
		<div class="row">
			<div class="form_search-wrap">
				<form method="get" action="<?php echo esc_url( home_url( '/' ) ); ?>">
					<label for="search-full-input" class="screen-reader-text"><?php echo esc_attr__( 'Search', 'seosight' ); ?></label>
					<input class="overlay_search-input" name="s" id="search-full-input" placeholder="<?php esc_html_e('Type and hit Enter...','seosight'); ?>" type="text" value="<?php get_search_query(); ?>" />
					<a href="#" class="overlay_search-close">
						<span></span>
						<span></span>
					</a>
				</form>
			</div>
		</div>
	</div>
</div>
<!-- # Overlay Search-->
