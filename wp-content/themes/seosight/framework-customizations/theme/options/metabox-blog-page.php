<?php if ( ! defined( 'FW' ) ) {
	die( 'Forbidden' );
}

$options = array(
	'pagination_type' => array(
		'label'   => esc_html__( 'Type of pages pagination', 'seosight' ),
		'type'    => 'select',
		'desc'    => esc_html__( 'Select one of pagination types', 'seosight' ),
		'choices' => array(
			'numbers'     => esc_html__( 'Numbers links', 'seosight' ),
			'loadmore'    => esc_html__( 'Load more ajax', 'seosight' ),
		),
	),
	'order'           => array(
		'label'   => esc_html__( 'Order', 'seosight' ),
		'type'    => 'select',
		'desc'    => esc_html__( 'Designates the ascending or descending order of items', 'seosight' ),
		'choices' => array(
			'default' => esc_html__( 'Default', 'seosight' ),
			'DESC'    => esc_html__( 'Descending', 'seosight' ),
			'ASC'     => esc_html__( 'Ascending', 'seosight' ),
		),
	),
	'orderby'         => array(
		'label'   => esc_html__( 'Order posts by', 'seosight' ),
		'type'    => 'select',
		'desc'    => esc_html__( 'Sort retrieved posts by parameter.', 'seosight' ),
		'choices' => array(
			'default'       => esc_html__( 'Default', 'seosight' ),
			'date'          => esc_html__( 'Order by date', 'seosight' ),
			'comment_count' => esc_html__( 'Order by number of comments', 'seosight' ),
			'author'        => esc_html__( 'Order by author.', 'seosight' ),
			'modified'      => esc_html__( 'Order by last modified date.', 'seosight' ),
		),
	),
	'taxonomy_select' => array(
		'type'       => 'multi-select',
		'label'      => esc_html__( 'Categories', 'seosight' ),
		'help'       => esc_html__( 'Click on field and type category name to find  category', 'seosight' ),
		'population' => 'taxonomy',
		'source'     => 'category',
		'limit'      => 100,
	),
	'exclude'         => array(
		'type'  => 'checkbox',
		'value' => false,
		'label' => esc_html__( 'Exclude selected', 'seosight' ),
		'desc'  => esc_html__( 'Show all categories except that selected in "Categories" option', 'seosight' ),
		'text'  => esc_html__( 'Exclude', 'seosight' ),
	),
	'per_page'        => array(
		'label' => esc_html__( 'Items per page', 'seosight' ),
		'desc'  => esc_html__( 'How many portfolios show per page', 'seosight' ),
		'help'  => esc_html__( 'Please input number here. Leave empty for default value', 'seosight' ),
		'type'  => 'text',
	),
);