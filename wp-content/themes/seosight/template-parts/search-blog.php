<?php
/**
 * Template part for displaying search form in blog template
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Seosight
 */
global $wp;
$query = filter_input( INPUT_GET, 'search' );
?>
<form class="search-panel" action="<?php echo esc_url( get_pagenum_link() ); ?>" method="GET">
	<div class="h4 title">
		<?php echo esc_attr__( 'Search', 'seosight' ); ?>:
	</div>
	<input type="search" name="search" value="<?php echo esc_attr( $query ); ?>" placeholder="<?php echo esc_attr__( 'What are you looking for?', 'seosight' ); ?>">
	<button type="submit" class="btn btn--dark btn-hover-shadow">
		<?php echo esc_attr__( 'Search', 'seosight' ); ?>
		<span class="semicircle"></span>
	</button>
</form>
