<?php

$cfg = array();

$cfg['sidebar_positions'] = array(

	'full' => array(
		'icon_url' => 'full.png',
		'sidebars_number' => 0
	),

	'right' => array(
		'icon_url' => 'right.png',
		'sidebars_number' => 1
	),
	'left' => array(
		'icon_url' => 'left.png',
		'sidebars_number' => 1
	),

);
$cfg['show_in_post_types'] = true;

$cfg['dynamic_sidebar_args'] = array(
	'before_widget' => '<aside id="%1$s" class="widget %2$s">',
	'after_widget'  => '</aside>',
	'before_title'  => '<div class="heading"><h5 class="heading-title">',
	'after_title'   => '</h5><div class="heading-line"><span class="short-line"></span><span class="long-line"></span></div></div>',
);
