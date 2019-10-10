<?php

class Elementor_button extends \Elementor\Widget_Base {


	public function get_name() {
		return 'button';
	}


	public function get_title() {
		return esc_html__( 'Button', 'seosight' );
	}


	public function get_icon() {
		return 'fa fa-toggle-right';
	}


	public function get_categories() {
		return [ 'theme-elements' ];
	}


	protected function _register_controls() {

		$this->start_controls_section(
			'button',
			[
				'label'         => esc_html__( 'Button', 'seosight' ),
				'tab'           => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'button_title',
			[
				'label'         => esc_html__( 'Title', 'seosight' ),
                'type'          => \Elementor\Controls_Manager::TEXT,
                'description'   => esc_html__( 'This is the text that appears on your button', 'seosight' ),
			]
        );
        
        $this->add_control(
            'show_icon', 
            [
                'label'         => esc_html__( 'Show Icon ?', 'seosight' ),
                'type'          => \Elementor\Controls_Manager::SWITCHER,
				'label_on'		=> esc_html__('Yes', 'seosight' ),
				'label_off'		=> esc_html__( 'No', 'seosight' ),
                'default'       => 'no',
                'return_value'  => 'yes',
            ]
        );

        $this->add_control(
            'button_icon', 
            [
                'label'         => esc_html__( 'Icon', 'seosight' ),
                'type'          => \Elementor\Controls_Manager::ICONS,
                'description'   => esc_html__( 'Select icon for your button', 'seosight' ),
				'default'       => [
					'value' => 'fas fa-star',
					'library' => 'solid',
				],
                'condition'     => [
                        'show_icon' => 'yes'
                ]
            ]
        );

        $this->add_control(
            'button_label_pos', 
            [
                'label'         => esc_html__( 'How to arange an icon?', 'seosight' ),
                'type'          => \Elementor\Controls_Manager::CHOOSE,
                'description'   => esc_html__( 'The horizontal alignment of icon', 'seosight' ),
                'options'       => [
					'left'          => [
						'title'         => esc_html__( 'Left', 'seosight' ),
						'icon'          => 'fa fa-align-left',
					],
					'right'         => [
						'title'         => esc_html__( 'Right', 'seosight' ),
						'icon'          => 'fa fa-align-right',
					],
                ],
				'condition'     => [
					'show_icon' => 'yes'
				]
            ]
        );

        $this->add_control(
            'button_size', 
            [
                'label'         => esc_html__( 'Button size', 'seosight' ),
                'type'          => \Elementor\Controls_Manager::SELECT,
                'description'   => esc_html__( 'Customize button size as you like', 'seosight' ),
                'options'       => 
                [
                    'btn-small'         => esc_html__( 'small', 'seosight' ),
                    'btn-medium'        => esc_html__( 'medium', 'seosight' ),
                    'btn-large'         => esc_html__( 'large', 'seosight' ),
                ],
                'default'       => 'btn-small',
            ]
        );

        $this->add_control(
            'button_color',
            [
                'label'         => esc_html__( 'Button color', 'seosight' ),
                'type'          => \Elementor\Controls_Manager::SELECT,
                'description'   => esc_html__( 'Customize button color as you like', 'seosight' ),
                'options'       =>
                [
                    'btn--dark'          => esc_html__( 'black', 'seosight' ),
                    'btn--white'         => esc_html__( 'white', 'seosight' ),
                    'btn--gray'          => esc_html__( 'gray', 'seosight' ),
                    'btn--blue'          => esc_html__( 'blue', 'seosight' ),
                    'btn--purple'        => esc_html__( 'purple', 'seosight' ),
                    'btn--orange'        => esc_html__( 'orange', 'seosight' ),
                    'btn--yellow'        => esc_html__( 'yellow', 'seosight' ),
                    'btn--green'         => esc_html__( 'green', 'seosight' ),
                    'btn--dark-gray'     => esc_html__( 'dark gray', 'seosight' ),
                    'btn--brown'         => esc_html__( 'brown', 'seosight' ),
                    'btn--rose'          => esc_html__( 'rose', 'seosight' ),
                    'btn--violet'        => esc_html__( 'violet', 'seosight' ),
                    'btn--olive'         => esc_html__( 'olive', 'seosight' ),
                    'btn--light-green'   => esc_html__( 'light green', 'seosight' ),
                    'btn--dark-blue'     => esc_html__( 'dark blue', 'seosight' ),
                ],
                'default'       => 'btn--gray',
            ]
        );

        $this->add_control(
            'button_border', 
            [
                'label'         => esc_html__( 'Border', 'seosight' ),
                'type'          => \Elementor\Controls_Manager::SWITCHER,
                'description'   => esc_html__( 'Use border?', 'seosight' ),
				'label_on'		=> esc_html__('Yes', 'seosight' ),
				'label_off'		=> esc_html__( 'No', 'seosight' ),
                'default'       => 'no',
                'return_value'  => 'yes',    
            ]            
        );

        $this->add_control(
            'button_shadow', 
            [
                'label'         => esc_html__( 'Shadow', 'seosight' ),
                'type'          => \Elementor\Controls_Manager::SWITCHER,
                'description'   => esc_html__( 'Show shadow when hovering over button?', 'seosight' ),
				'label_on'		=> esc_html__('Yes', 'seosight' ),
				'label_off'		=> esc_html__( 'No', 'seosight' ),
                'default'       => 'no',
                'return_value'  => 'yes',    
            ]            
        );

        $this->add_control(
            'button_dec', 
            [
                'label'         => esc_html__( 'Semicircle', 'seosight' ),
                'type'          => \Elementor\Controls_Manager::SWITCHER,
                'description'   => esc_html__( 'How to arange semicircle?', 'seosight' ),
				'label_on'		=> esc_html__('Right', 'seosight' ),
				'label_off'		=> esc_html__( 'Left', 'seosight' ),
                'default'       => 'Right',
                'return_value'  => '--right',    
            ]            
        );

        $this->add_control(
            'button_pos', 
            [
                'label'         => esc_html__( 'How to arange an button?', 'seosight' ),
                'type'          => \Elementor\Controls_Manager::CHOOSE,
                'description'   => esc_html__( 'The horizontal alignment of button', 'seosight' ),
                'options'       => [
					'left'          => [
						'title'         => esc_html__( 'Left', 'seosight' ),
						'icon'          => 'fa fa-align-left',
                    ],
                    'center'        => [
						'title'         => esc_html__( 'Right', 'seosight' ),
						'icon'          => 'fa fa-align-center',
                    ],
                    
					'right'         => [
						'title'         => esc_html__( 'Right', 'seosight' ),
						'icon'          => 'fa fa-align-right',
					],
                ]
            ]
        );

        $this->add_control(
            'button_link', 
            [
                'label'         => esc_html__( 'Link', 'seosight' ),
                'type'          => \Elementor\Controls_Manager::URL,
                'description'   => esc_html__( 'Add your relative URL. Each URL contains link, anchor text and target attributes.', 'seosight' ),
                'placeholder'	=> esc_html__( 'https://your-link.com', 'seosight' ),
				'default'		=>
				[
					'url'			=> '#',
					'is_external'	=> false,
					'nofollow'		=> false,
				]
            ]
        );

        $this->add_control(
            'button_event',
            [
                'label'         => esc_html__( 'On-click event', 'seosight' ),
                'type'          => \Elementor\Controls_Manager::TEXT,
                'description'   => esc_html__( 'Add on-click event for button', 'seosight' ),
            ]
        );

        $this->add_control(
            'button_id',
            [
                'label'         => esc_html__( 'Button ID attribute', 'seosight' ),
                'type'          => \Elementor\Controls_Manager::TEXT,
                'description' => esc_html__( 'Only latin charters must be used', 'seosight' ),
            ]
        );


		$this->end_controls_section();

//---------------------------------------------------------------------

        $this->start_controls_section(
            'css',
            [
                'label'         => esc_html__( 'Button', 'seosight' ),
                'tab'           => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'text-color',
            [
                'label'     => esc_html__( 'Text color', 'seosight' ),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'scheme' =>
                    [
                    'type' => \Elementor\Scheme_Color::get_type(),
                    'value' => \Elementor\Scheme_Color::COLOR_1,
                    ],

                'selectors' =>
                [
                    '{{WRAPPER}} .btn' => 'color: {{SCHEME}};'
                ]
            ]
        );

        $this->add_control(
                'background-color',
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
                            '{{WRAPPER}} .btn' => 'background-color: {{SCHEME}};'                // TODO: SVG!!!
                        ]
                ]
        );

        $this->add_group_control(
			'typography',
			[
				'name'      => 'content_typography',
				'label'     => esc_html__( 'Typography', 'seosight' ),
				'scheme'    => \Elementor\Scheme_Typography::TYPOGRAPHY_1,
				'selector'  => '{{WRAPPER}} .btn',
			]
        );

		$this->add_group_control(
			'border',
			[
				'label'     => esc_html__( 'Border', 'seosight' ),
				'selector'  => '{{WRAPPER}} .btn',
			]
		);

        $this->add_control(
                'hover-txt',
                [
                    'label'     => esc_html__( 'Text color on hover', 'seosight' ),
                    'type'      => \Elementor\Controls_Manager::COLOR,
					'scheme' =>
						[
							'type' => \Elementor\Scheme_Color::get_type(),
							'value' => \Elementor\Scheme_Color::COLOR_1,
						],

					'selectors' =>
						[
							'{{WRAPPER}} .btn:hover' => 'color: {{SCHEME}};'
						]
                ]
        );

		$this->add_control(
			'hover-background',
			[
				'label'     => esc_html__( 'Background color on hover', 'seosight' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'scheme' =>
					[
						'type' => \Elementor\Scheme_Color::get_type(),
						'value' => \Elementor\Scheme_Color::COLOR_1,
					],

				'selectors' =>
					[
						'{{WRAPPER}} .btn:hover' => 'background-color: {{SCHEME}};'
					]
			]
		);

		$this->add_group_control(
			'border',
			[
			    'name'      => 'hover',
				'label'     => esc_html__( 'Border on hover', 'seosight' ),
				'selector'  => '{{WRAPPER}} .btn:hover',
			]
		);

        $this->end_controls_section();
	}


	protected function render() {

        $settings = $this->get_settings_for_display();

        $title = $settings['button_title'];
        $show_icon = ($settings['show_icon'] === 'yes') ? true : false;
        $border = ($settings['button_border'] === 'yes') ? 'btn-border' : '';
        $icon = $settings['button_icon'];
        $link = $settings['button_link'];
        $lb_pos = $settings['button_label_pos'];
        $bt_pos = $settings['button_pos'];
        $href = $link['url'];
        $target = ($link['is_external']) ? 'target= "_blank"' : 'target= "_self"';
        $rel = ($link['nofollow']) ? 'rel="nofollow"' : '';
        $size = $settings['button_size'];
        $shadow = ($settings['button_shadow'] === 'yes') ? 'btn-hover-shadow' : '';
        $color = $settings['button_color'];
        $event = $settings['button_event'];
        $el_class = array();
        $button_attr = array();        
        $dec = $settings['button_dec'];

        if (!$color) {
            $color = 'btn--primary';
        }

        if (!$dec) {
            $dec = '';
        }

        if (!$size) {
            $size = 'btn-small';
        }

        $el_class[] = $size;
        $el_class[] = $shadow;
        $el_class[] = $color;
        $el_class[] = $border;

        switch ($bt_pos) {
            case 'left': $bt_pos = 'align = "left"';
            break;

            case 'center': $bt_pos = 'align = "center"';
            break;

            case 'right': $bt_pos = 'align = "right"';
            break;
        }

        if($event) {
            $event = 'onclick="'. $event .'"';
        }

        if ($href) {
            $href = 'href="'. $href .'"';
        }

        $button_attr[] = $href;
        $button_attr[] = $target;
        $button_attr[] = $event;
        $button_attr[] = $rel;
        // fw_print($settings);

    ?>
        <div <?php echo $bt_pos ?>>
            <a <?php echo implode( ' ', $button_attr ); ?> class="btn <?php echo implode( " ", $el_class ); ?>">                   
	        	<?php
		        if ( $show_icon == true ) {
		        	if ( $lb_pos == 'left' ) {
						\Elementor\Icons_Manager::render_icon( $icon, [ 'aria-hidden' => 'true' ] );
		        		echo '<span class="text">' .'  '. esc_attr($title) . '</span>';
	        		} else {
			        	echo '<span class="text">' . esc_attr($title) .'  '. '</span>';
						\Elementor\Icons_Manager::render_icon( $icon, [ 'aria-hidden' => 'true' ] );
			        }
		        } else {
        			if ($title) {
			        	echo '<span class="text">' . esc_attr($title) . '</span>';
	        		}
	        	}
	        	?>
                <span class="semicircle<?php echo $dec;?>"></span>
                
            </a>
        </div>
    <?php
    }
    
    protected function _content_template(){
        ?>
        <#
        var attr = {
            title: settings.button_title,
            show_icon: settings.show_icon,
            border: settings.button_border,
            icon: settings.button_icon,
            link: settings.button_link,
            lb_pos: settings.button_label_pos,
            bt_pos: settings.button_pos,
            size: settings.button_size,
            shadow: settings.button_shadow,
            color: settings.button_color,
            event: settings.button_event,
            dec: settings.button_dec
        };

        var href = '';
        var target = '';
        var rel = '';
        var event = '';

        var el_class = '';
        var button_attr = '';

        if (!attr.dec) {
            attr.dec = '';
        }

        if (attr.show_icon === 'yes') {
            attr.show_icon = true;
        } else {
            attr.show_icon = false;
        }

        if (attr.border === 'yes') {
            attr.border = 'btn-border';
        } else {
            attr.border = '';
        }

        if (attr.link.url) {
            href = 'href= "' + attr.link.url + '"';
        }
        
        if (attr.link.is_external) {
            target = 'target= "_blank"';
        } else {
            target = 'targget = "_self"';
        }
        
        if (attr.link.nofollow) {
            rel = ' rel= "nofollow"';
        } else {
            rel = '';
        }
        
        if (attr.event) {
            event = 'onclick= "' + attr.event + '"';
        }
        
        el_class = attr.size + ' ' + attr.shadow + ' ' + attr.color + ' ' + attr.border;

        switch (attr.bt_pos) {
            case 'left':
                attr.bt_pos = 'align = "left"';
                break;
            
            case 'center':
                attr.bt_pos = 'align = "center"';
                break;
            
            case 'right':
                attr.bt_pos = 'align = "right"';
                break;
        }

        button_attr = href + ' ' + target + ' ' + event + ' ' + rel; 
        #>

        <div {{{attr.bt_pos}}}>
            <a {{{button_attr}}} class="btn {{{el_class}}}">                   
              <#if ( attr.show_icon == true ) { 
		        	if (attr.lb_pos == 'left') {#>
		        		<i class="{{attr.icon.value}}"></i> <span class="text">{{{attr.title}}}</span>
	        		<#} else {#>
			        	<span class="text">{{{attr.title}}}</span> <i class="{{attr.icon}}"></i>
			    <#    }
		        } else {
        			if (attr.title) { #>
			        	<span class="text">{{{attr.title}}}</span>
	        	<#	}
	        	} #>
                <span class="semicircle{{{attr.dec}}}"></span>          
            </a>
        </div>
        <?php
    }
}