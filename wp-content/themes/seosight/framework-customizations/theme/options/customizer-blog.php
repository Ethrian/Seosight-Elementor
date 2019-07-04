<?php if ( ! defined( 'FW' ) ) {
	die( 'Forbidden' );
}


$options = array(
	'section_archive'   => array(
		'title'   => esc_html__( 'Archive / Category options', 'seosight' ),
		'options' => array(
			'blog-search-show' => array(
				'label'        => esc_html__( 'Show Search panel', 'seosight' ),
				'desc'         => esc_html__( 'Show or hide panel before posts list', 'seosight' ),
				'type'         => 'switch',
				'right-choice'  => array(
					'value' => 'yes',
					'label' => esc_html__( 'Show', 'seosight' )
				),
				'left-choice' => array(
					'value' => 'no',
					'label' => esc_html__( 'Hide', 'seosight' )
				),
				'value'        => 'no',
			),
			'blog-author-show' => array(
				'label'        => esc_html__( 'Show author?', 'seosight' ),
				'desc'         => esc_html__( 'Author name and avatar block', 'seosight' ),
				'type'         => 'switch',
				'right-choice'  => array(
					'value' => 'yes',
					'label' => esc_html__( 'Show', 'seosight' )
				),
				'left-choice' => array(
					'value' => 'no',
					'label' => esc_html__( 'Hide', 'seosight' )
				),
				'value'        => 'yes',
			),
			'blog-meta-show' => array(
				'label'        => esc_html__( 'Show post meta?', 'seosight' ),
				'desc'         => esc_html__( 'Post time, categories, tags, comments info', 'seosight' ),
				'type'         => 'switch',
				'right-choice'  => array(
					'value' => 'yes',
					'label' => esc_html__( 'Show', 'seosight' )
				),
				'left-choice' => array(
					'value' => 'no',
					'label' => esc_html__( 'Hide', 'seosight' )
				),
				'value'        => 'yes',
			),
		)
	),
	'section_post'   => array(
		'title'   => esc_html__( 'Single Post options', 'seosight' ),
		'options' => array(
			'single-featured-show' => array(
				'label'        => esc_html__( 'Show featured media?', 'seosight' ),
				'desc'         => esc_html__( 'Featured image or other media on top of post', 'seosight' ),
				'type'         => 'switch',
				'left-choice'  => array(
					'value' => 'yes',
					'label' => esc_html__( 'Show', 'seosight' )
				),
				'right-choice' => array(
					'value' => 'no',
					'label' => esc_html__( 'Hide', 'seosight' )
				),
				'value'        => 'yes',
			),
			'single-author-show' => array(
				'label'        => esc_html__( 'Show author?', 'seosight' ),
				'desc'         => esc_html__( 'Author name and avatar block', 'seosight' ),
				'type'         => 'switch',
				'left-choice'  => array(
					'value' => 'yes',
					'label' => esc_html__( 'Show', 'seosight' )
				),
				'right-choice' => array(
					'value' => 'no',
					'label' => esc_html__( 'Hide', 'seosight' )
				),
				'value'        => 'yes',
			),
			'single-meta-show' => array(
				'label'        => esc_html__( 'Show post meta?', 'seosight' ),
				'desc'         => esc_html__( 'Post time, categories, tags, comments info', 'seosight' ),
				'type'         => 'switch',
				'left-choice'  => array(
					'value' => 'yes',
					'label' => esc_html__( 'Show', 'seosight' )
				),
				'right-choice' => array(
					'value' => 'no',
					'label' => esc_html__( 'Hide', 'seosight' )
				),
				'value'        => 'yes',
			),
			'single-share-show' => array(
				'label'        => esc_html__( 'Show share post buttons?', 'seosight' ),
				'desc'         => esc_html__( 'Show icons that share post on social networks', 'seosight' ),
				'type'         => 'switch',
				'left-choice'  => array(
					'value' => 'yes',
					'label' => esc_html__( 'Show', 'seosight' )
				),
				'right-choice' => array(
					'value' => 'no',
					'label' => esc_html__( 'Hide', 'seosight' )
				),
				'value'        => 'yes',
			),
			'author-box-show' => array(
				'label'        => esc_html__( 'Show author box?', 'seosight' ),
				'desc'         => esc_html__( 'Show box with author avatar and detailed bio description', 'seosight' ),
				'type'         => 'switch',
				'left-choice'  => array(
					'value' => 'yes',
					'label' => esc_html__( 'Show', 'seosight' )
				),
				'right-choice' => array(
					'value' => 'no',
					'label' => esc_html__( 'Hide', 'seosight' )
				),
				'value'        => 'yes',
			),
		),
	)
);


