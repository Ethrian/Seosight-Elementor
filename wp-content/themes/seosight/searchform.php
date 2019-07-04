<?php
/**
 * Template for displaying search forms in seosight
 *
 * @package seosight
 */

?>
<form method="get" action="<?php echo esc_url( home_url( '/' ) ); ?>" class="w-search">
		<label for="search-widget-input" class="screen-reader-text"><?php echo esc_attr__( 'Search', 'seosight' ); ?></label>
		<input class="email search input-standard-grey" required="required" id="search-widget-input" name="s" placeholder="<?php echo esc_attr__( 'Search', 'seosight' ); ?>" value="<?php get_search_query(); ?>" type="search">
		<button class="icon">
			<i class="seoicon-loupe"></i>
		</button>
</form>
