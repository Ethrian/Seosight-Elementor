<?php

class Elementor_title extends \Elementor\Widget_Base {


	public function get_name() {
		return 'title';
	}


	public function get_title() {
		return esc_html__( 'Title', 'seosight' );
	}


	public function get_icon() {
		return 'fa fa-file-text-o';
	}


	public function get_categories() {
		return [ 'theme-elements' ];
	}


	protected function _register_controls() {

		$this->start_controls_section(
			'Title',
			[
				'label'         => esc_html__( 'Content', 'seosight' ),
				'tab'           => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'post_title',
			[
				'label'         => esc_html__( 'Use post title?', 'seosight' ),
				'type'          => \Elementor\Controls_Manager::SWITCHER,
                'description'   => esc_html__( 'Use the title of current post/page as content element instead of text input value.', 'seosight' ),
				'label_on'		=> esc_html__('Yes', 'seosight' ),
				'label_off'		=> esc_html__( 'No', 'seosight' ),
                'default'       => 'no',
                'return_value'  => 'yes',
			]
        );
        
        $this->add_control(
            'title',
            [
				'label'			=> esc_html__( 'Title', 'seosight'),
				'type'			=> \Elementor\Controls_Manager::TEXT,
				'value'			=> 'The title',
            ]
		);
		
		$this->add_control(
			'type',
			[
				'label'			=> esc_html__( 'Label tag', 'seosight' ),
				'type'			=> \Elementor\Controls_Manager::SELECT,
				'options'		=>
				[
					'h1'   			=> 'H1',
					'h2'   			=> 'H2',
					'h3'   			=> 'H3',
					'h4'   			=> 'H4',
					'h5'   			=> 'H5',
					'h6'   			=> 'H6',
					'div'  			=> 'div',
					'span' 			=> 'Span',
					'p'    			=> 'P'
				]
			]
		);

		$this->add_control(
			'el_class',
			[
				'label'			=> esc_html__( 'Tag class', 'seosight' ),
				'type'			=> \Elementor\Controls_Manager::TEXT,
				'description'	=> esc_html__( 'Add class name for title tag only', 'seosight' )
			]
		);

		$this->add_control(
			'inline_link',
			[
				'label'			=> esc_html__('Add inline link?', 'seosight' ),
				'type'			=> \Elementor\Controls_Manager::SWITCHER,
				'description'	=> esc_html__( 'Additional text with link on one line with title text', 'seosight' ),
				'label_on'		=> esc_html__('Yes', 'seosight' ),
				'label_off'		=> esc_html__( 'No', 'seosight' ),
                'default'       => 'yes',
                'return_value'  => 'yes'
			]
		);

		$this->add_control(
			'title_link',
			[
				'label'			=> esc_html__( 'Link', 'seosight' ),
				'type'			=> \Elementor\Controls_Manager::URL,
				'description'	=> esc_html__( 'Add link with title text', 'seosight' ),
				'placeholder'	=> esc_html__( 'https://your-link.com', 'seosight' ),
				'default'		=>
				[
					'url'			=> '#',
					'is_external'	=> false,
					'nofollow'		=> false
				],
                'condition'     => ['inline_link' => 'yes']
			]
		);

		$this->add_control(
			'title_delim',
			[
				'label'			=> esc_html__( 'Title decoration', 'seosight' ),
				'type'			=> \Elementor\Controls_Manager::SWITCHER,
				'description'	=> esc_html__( 'Visual decoration lines below title text', 'seosight' ),
				'label_on'		=> esc_html__('Yes', 'seosight' ),
				'label_off'		=> esc_html__( 'No', 'seosight' ),
                'default'       => 'no',
                'return_value'  => 'yes'
			]
		);

		$this->add_control(
			'subtitle',
			[
				'label'			=> esc_html__( 'Subtitle',  'seosight' ),
				'type'			=> \Elementor\Controls_Manager::TEXT,
				'value'			=> ''
			]
		);

		$this->add_control(
			'align',
			[
				'label'			=> esc_html__( 'Content align', 'seosight' ),
				'type'			=> \Elementor\Controls_Manager::SELECT,
				'description'	=> esc_html__( 'Horizontal alignment of elements', '' ),
				'options'		=>
				[
					'align-left'   => esc_html__( 'Left', 'seosight' ),
					'align-center' => esc_html__( 'Centered', 'seosight' ),
					'align-right'  => esc_html__( 'Right', 'seosight' )
				],
				'default'		=> 'align-center'
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'css',
			[
				'label'         => esc_html__( 'Title', 'seosight' ),
				'tab'           => \Elementor\Controls_Manager::TAB_STYLE,
			]
        );

		$this->add_control(
			'title-color',
			[
				'label'     => esc_html__('Title color', 'seosight'),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'scheme' =>
					[
						'type' => \Elementor\Scheme_Color::get_type(),
						'value' => \Elementor\Scheme_Color::COLOR_1,
					],
				'default'   => '#000000',

				'selectors' =>
					[
						'{{WRAPPER}} .heading-title' => 'color: {{SCHEME}};'
					]
			]
		);

		$this->add_group_control(
			'typography',
			[
				'name'      => 'title_typography',
				'label'     => esc_html__( 'Title typography', 'seosight' ),
				'scheme'    => \Elementor\Scheme_Typography::TYPOGRAPHY_1,
				'selector'  => '{{WRAPPER}} .heading-title',
			]
		);

		$this->add_control(
			'subtitle-color',
			[
				'label'     => esc_html__('Subtitle color', 'seosight'),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'scheme' =>
					[
						'type' => \Elementor\Scheme_Color::get_type(),
						'value' => \Elementor\Scheme_Color::COLOR_1,
					],
				'default'   => '#2a2a2f',

				'selectors' =>
					[
						'{{WRAPPER}} .heading-text' => 'color: {{SCHEME}};'
					]
			]
		);

		$this->add_group_control(
			'typography',
			[
				'name'      => 'subtitle_typography',
				'label'     => esc_html__( 'Subtitle typography', 'seosight' ),
				'scheme'    => \Elementor\Scheme_Typography::TYPOGRAPHY_1,
				'selector'  => '{{WRAPPER}} .heading-text',
			]
		);

		$this->add_control(
			'decoration-color',
			[
				'label'     => esc_html__('Decoration color', 'seosight'),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'scheme' =>
					[
						'type' => \Elementor\Scheme_Color::get_type(),
						'value' => \Elementor\Scheme_Color::COLOR_1,
					],
				'default'   => '#ba1200',

				'selectors' =>
					[
						'{{WRAPPER}} .heading-decoration' => 'color: {{SCHEME}};'
					]
			]
		);

		$this->end_controls_section();

	}


	protected function render() {

		$settings = $this->get_settings_for_display();

		global $allowedposttags;

		extract( $settings );
		
		if ( empty( $type ) ) {
			$type = 'h1';
		}
		
		$wrap_class   = apply_filters( 'kc-el-class', $settings );
		$wrap_class[] = 'crumina-module';
		$wrap_class[] = 'crumina-heading';
		
		if ( 'yes' !== $inline_link ) {
			$wrap_class[] = $align;
		}
		
		$wrap_class[] = $class;
		// fw_print($inline_link);
		
		if ( $inline_link == 'yes') {
			$wrap_class[] = 'with-read-more';
			if ( ! empty( $title_link ) ) {
				// $link_arr = explode( "|", $title_link );
		
				if ( ! empty( $title_link['url']) ) {
					$href = 'href ="'. $title_link['url']. '"';
				}
		
				// $link_title = ! empty( $ ? $link_arr[1] : esc_html__( 'Read more', 'seosight' );
		
				$target = ( $title_link['is_exernal'] ) ? 'target ="_blank"' : 'target ="_self"';
		
				$rel = ( $title_link['nofollow'] ) ? 'rel ="nofollow"' : ''; 
				;
			}
			if ( ! empty( $href ) ) {
				$link_html = '<a ' . esc_attr( $href ) . ' class="read-more" ' . esc_attr( $target ) . ' ' . esc_attr($rel) . '><i class="seoicon-right-arrow"></i></a>';
			}
		}
		if ( $post_title == 'yes' ) {
			$text_title = get_the_title();
			if ( ! empty( $text_title ) ) {
				$title = esc_attr( $text_title );
			}
		}

		if (!empty($el_class)) {
			$el_class .= ' heading-title';
		} else {
			$el_class = 'h1 heading-title';
        }
		?>
		
		<header class="<?php echo esc_attr( implode( ' ', $wrap_class ) ); ?>">
			<div class="title-text-wrap"><<?php echo esc_attr( $type ) ?> class="<?php echo esc_attr( $el_class ); ?>">
				<?php echo esc_html( $title ); ?></<?php echo esc_attr( $type ) ?>>
			<?php echo $link_html; ?>
			</div>
			<?php if ( 'yes' == $title_delim ) { ?>
				<div class="heading-decoration"><span class="first"></span><span class="second"></span></div>
			<?php }
			if ( ! empty( $subtitle ) ) { ?>
				<div class="h5 heading-text"><?php echo html_entity_decode( wp_kses( $subtitle, $allowedposttags ) ); ?></div>
			<?php } ?>
		</header>
		<?php
	}

	protected function _content_template() {
		?>
		<#
		var attr = {
	    	title: settings.title, 
	    	subtitle: settings.subtitle, 
    		align: settings.align, 
    		post_title: settings.post_title, 
    		title_delim: settings.title_delim, 
    		inline_lnk: settings.inline_link, 
    		link: settings.title_link, 
    		type: settings.type
		};

		var inline_link = 'no';
		inline_link = attr.inline_lnk;

		var delim_html = '';
		var el_class = 'crumina-module crumina-heading';
        var subtitle_html = '';

		if (inline_link !== 'yes') el_class += attr.align;

		if (inline_link == 'yes') {
    		var href = 'href ="'+ attr.link.url +'"';
    		var target = (attr.link.is_external) ? 'target ="_blank"' : 'target ="_self"';
    		var rel = (attr.link.nofollow) ? 'rel ="nofollow"' : '';
			var link_html = href + ' ' + target + ' ' + rel;
		}

		if ( attr.title_delim == 'yes' ) delim_html= '<div class="heading-decoration"><span class="first"></span><span class="second"></span></div>';

		if (attr.post_title === 'yes') attr.title = document.getElementsByClassName('stunning-header-title');

		if (attr.subtitle.length) subtitle_html = '<div class="h5 heading-text">' + attr.subtitle + '</div>';

		#>
 
		<div class='{{el_class}}'>
            <div class="title-text-wrap"></div>
            <{{{attr.type}}} > {{{attr.title}}} </{{{attr.type}}}>
           <a {{link_html}}> </a>
        </div>
		{{{delim_html}}}
		{{{subtitle_html}}}
		</div>
		<?php
	}

}