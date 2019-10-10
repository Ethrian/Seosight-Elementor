<?php
class elementor_icon extends \Elementor\Widget_Base {


	public function get_name() {
		return 'icon';
	}


	public function get_title() {
		return esc_html__( 'Icon', 'seosight' );
	}


	public function get_icon() {
		return 'fa fa-circle';		
	}


	public function get_categories() {
		return [ 'theme-elements' ];
	}


	protected function _register_controls() {

		$this->start_controls_section(
			'Icon',
			[
				'label' 		=> esc_html__( 'Icon', 'seosight' ),
				'tab' 			=> \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'icon',
			[
				'label' 		=> esc_html__( 'Icon', 'seosight' ),
				'type' 			=> \Elementor\Controls_Manager::ICONS,
				'descrition' 	=> esc_html__( 'Display single icon', 'seosight' ),
				'default' => [
					'value' => 'fas fa-star',
					'library' => 'solid',
				],
			]
		);

		$this->add_control(
			'title',
			[
				'label'			=> esc_html__( 'Title', 'seosight'),
				'description'	=> esc_html__( 'Enter title (Note: It is located after icon).', 'seosight' ),
				'type'			=> \Elementor\Controls_Manager::TEXT,
			]
		);

		$this->add_control(
			'use_link',
			[
				'label'			=> 'Add Link ?',
				'type'			=> \Elementor\Controls_Manager::SWITCHER,
				'description'	=> esc_html__( 'Add link to the icon', 'seosight' ),
				'label_on'		=> esc_html__('Yes', 'seosight' ),
				'label_off'		=> esc_html__( 'No', 'seosight' ),
				'return_value'	=> 'yes',
				'default'		=> 'no',
			]
		);

		$this->add_control(
			'link',
			[
				'label'			=> esc_html__( 'Link', 'seosight' ),
				'description'	=> esc_html__( 'Add your relative URL. Each URL contains link, anchor text and target attributes.', 'seosight' ),
				'type'			=> \Elementor\Controls_Manager::URL,
				'placeholder'	=> esc_html__( 'https://your-link.com', 'seosight' ),
				'default'		=>
				[
					'url'			=> '#',
					'is_external'	=> false,
					'nofollow'		=> false,
				],
                'condition'     => [
                    'use_link'   => 'yes'
                ]
			]
		);


		$this->end_controls_section();

		$this->start_controls_section(
		        'css',
                [
					'label'     => esc_html__( 'Icon', 'seosight' ),
					'tab'       => \Elementor\Controls_Manager::TAB_STYLE,
                ]

        );

		$this->add_control(
			'color',
			[
				'label'     => esc_html__( 'Icon color', 'seosight' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'scheme' =>
					[
						'type' => \Elementor\Scheme_Color::get_type(),
						'value' => \Elementor\Scheme_Color::COLOR_1,
					],

				'selectors' =>
					[
						'{{WRAPPER}} .icon i' => 'color: {{SCHEME}};'
					]
			]
		);

		$this->add_control(
		        'color-hover',
                [
					'label'     => esc_html__( 'Icon color on hover', 'seosight' ),
					'type'      => \Elementor\Controls_Manager::COLOR,
					'scheme' =>
						[
							'type' => \Elementor\Scheme_Color::get_type(),
							'value' => \Elementor\Scheme_Color::COLOR_1,
						],

					'selectors' =>
						[
							'{{WRAPPER}} .icon i:hover' => 'color: {{SCHEME}};'
                        ]
                ]
        );

		$this->add_group_control(
			'typography',
			[
				'name'      => 'content_typography',
				'label'     => esc_html__( 'Icon typography', 'seosight' ),
				'scheme'    => \Elementor\Scheme_Typography::TYPOGRAPHY_1,
				'selector'  => '{{WRAPPER}} .module-title, .icon i',
			]
		);

		$this->add_control(
			'txt-color',
			[
				'label'     => esc_html__( 'Title color', 'seosight' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'scheme' =>
					[
						'type' => \Elementor\Scheme_Color::get_type(),
						'value' => \Elementor\Scheme_Color::COLOR_1,
					],

				'selectors' =>
					[
						'{{WRAPPER}} .module-title' => 'color: {{SCHEME}};'
					]
			]
		);


		$this->add_control(
			'color-background',
			[
				'label'     => esc_html__( 'Background color', 'seosight' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'scheme' =>
					[
						'type' => \Elementor\Scheme_Color::get_type(),
						'value' => \Elementor\Scheme_Color::COLOR_1,
					],

				'selectors' =>
					[
						'{{WRAPPER}} .icon' => 'color: {{SCHEME}};'
					]
			]
		);

		$this->add_group_control(
			'border',
			[
				'label'     => esc_html__( 'Border', 'seosight' ),
				'selector'  => '{{WRAPPER}} .icon',
			]
		);

		$this->end_controls_section();

	}


	protected function render() {

		$settings = $this->get_settings_for_display();


		$has_link    = false;
		
		$css_class[] 	= 'crumina-module';
		$css_class[] 	= 'crum-icon-module';


		$icon = $settings['icon'];
		$title = $settings['title'];
		$link = $settings['link'];
		if( empty( $icon ) )
			$icon = 'et-layers';

		$class_icon = array( $icon );

		$use_link = $settings['use_link'];
		if( $use_link == 'yes') {

			$link     = $settings['link'];
			$link_att = array();
	
			if ( strlen( $link['url'] ) > 0 ) {

				$has_link = true;
				$a_target = $link['is_external'] ? '_blank' : '_self';
		
				$link_att[] = 'href="' . esc_attr( $link['url'] ) . '"';
				$link_att[] = 'target="' . esc_attr( $a_target ) . '"';

				if($link['nofollow']){
					$link_att[] = 'rel="nofollow"';
				}
				
			}
		}
		?>
		<div class="<?php echo esc_attr( implode( " ", $css_class ) ); ?>">
			<a 
				<?php 
				if( $has_link ) {
					echo implode(' ', $link_att);
				}
				?>
			>				<span class="icon"><?php \Elementor\Icons_Manager::render_icon( $settings['icon'], [ 'aria-hidden' => 'true' ] ); ?></span class="icon">
				<?php if ( ! empty( $title ) ) {
					echo '<span class="h4 module-title">' . esc_html( $title ) . '</span>';
				} ?>
			</a>
		</div>
	<?php

	}

	protected function _content_template() {
		?>
		<#
			var attr = {
		 		icon: settings.icon,
				title: settings.title,
		 		use_link: settings.use_link,
		 		link: settings.link
		 	};

		 	var custom_class = 'crumina-module crum-icon-module';
		 	var href = ''; 
			var target = '';
		 	var rel = '';
		 	var title_html = '';
		 	var has_link = false;

			if (!attr.icon) attr.icon = '';

			if (!attr.title) attr.title ='';
		 	else title_html = '<span class="h4 module-title">' + attr.title + '</span>';

		 	if (attr.use_link) {
		 		if (attr.link) {
		 			if (attr.link.url !== ''){
		 				has_link = true;
		 				href = attr.link.url;
		 				target = (attr.link.is_external) ? '_blank' : '_self';
		 				rel = (attr.link.nofollow) ? 'rel ="nofollow"' : '';
		 			}
		 		}
		 	}

		 #>

		 <div class="icon crumina-module crum-icon-module">
		 <#if (has_link) {#>
    	 	<a href="{{{href}}}" target ="{{{target}}}" {{{rel}}}>
		 <# } #>
         		<span class="icon"><i class="{{attr.icon.value}}"></i></span>
         		{{{title_html}}}
		 <#if (has_link) {#>
    	 	</a>
		 <# } #>
		 </div>
	<?php
	}

}