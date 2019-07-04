<?php
/**
 * Template part for displaying search form.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Seosight
 */
?>
<!-- Dropdown Search-->
<div class="popup-search">
	<form method="get" action="<?php echo esc_url( home_url( '/' ) ); ?>" class="search-inline">
		<label for="search-drop-input" class="screen-reader-text"><?php echo esc_attr__( 'Search', 'seosight' ); ?></label>
		<input class="input-standard-grey" id="search-drop-input" required="required" name="s" placeholder="<?php esc_html_e('Type and hit Enter...','seosight'); ?>" type="search" value="<?php get_search_query(); ?>">
		<button class="search-btn">
			<i class="seoicon-loupe"></i>
		</button>
	</form>
</div>
<!-- # Dropdown Search-->