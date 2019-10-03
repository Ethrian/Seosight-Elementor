<?php

class Elementor_promo_block extends \Elementor\Widget_Base {

	
	public function get_name() {
		return 'promo block';
	}


	public function get_title() {
		return esc_html__( 'Promotion block', 'seosight' );
	}

	
	public function get_icon() {
		return 'fa fa-code';
	}


	public function get_categories() {
		return [ 'theme-elements' ];
	}

	
	protected function _register_controls() {

		$this->start_controls_section(
			'promo-block',
			[
				'label'         => esc_html__( 'Promo block', 'seosight' ),
				'tab'           => \Elementor\Controls_Manager::TAB_CONTENT,
			]           
		);

		$this->add_control(
			'image',
			[
				'label'         => esc_html__( 'Image', 'seosight' ),
				'type'          => \Elementor\Controls_Manager::MEDIA,
			]
        );
        
        $this->add_control(
            'image_hover',
            [
                'label'         => esc_html__( 'Image on hover', 'seosight' ),
                'type'          => \Elementor\Controls_Manager::MEDIA,
                'description'   => esc_html__( 'Use only if you want to show different image on block hover', 'seosight' ),
            ]
        );

        $this->add_control(
            'title',
            [
                'label'         => esc_html__( 'Title', 'seosight' ),
                'type'          => \Elementor\Controls_Manager::TEXT,
                'description'   => esc_html__( 'Enter title for block', 'seosight'),
            ]
        );

        $this->add_control(
            'desc',
            [
                'label'         => esc_html__( 'Description', 'seosight' ),
                'type'          => \Elementor\Controls_Manager::TEXTAREA
            ]
        );

        $this->add_control(
            'link',
            [
                'label'         => esc_html__( 'Button URL', 'seosight'),
                'type'          => \Elementor\Controls_Manager::URL,
                'description'   => esc_html__('Add link to button', 'seosight' ),
                'default'       =>
                [
                    'url'			=> '#',
					'is_external'	=> false,
					'nofollow'		=> false,
                ]
            ]
        );

        $this->add_control(
            'link_title',
            [
                'label'         => esc_html__( 'Link title', 'seosight' ),
                'type'          => \Elementor\Controls_Manager::TEXT
            ]
        );

        $this->add_control(
            'is_button',
            [
                'label'         => esc_html__( 'Show button?', 'seosight' ),
                'type'          => \Elementor\Controls_Manager::SWITCHER,
                'descripton'    => esc_html__( 'Display link as button', 'seosight' ),
                'label_on'		=> esc_html__( 'Yes', 'seosight' ),
				'label_off'		=> esc_html__( 'No', 'seosight' ),
                'default'       => 'No',
                'return_value'  => 'yes',
            ]
        );

        $this->add_control(
            'btn_color',
            [
                'label'         => esc_html__( 'Color', 'seosight' ),
                'type'          => \Elementor\Controls_Manager::SELECT,
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
                'default'       => 'btn--gray'
            ]
        );

        $this->add_control(
            'btn_size', 
            [
                'label'         => esc_html__( 'Button size', 'seosight' ),
                'type'          => \Elementor\Controls_Manager::SELECT,
                'description'   => esc_html__( 'Button size', 'seosight' ),
                'options'       => 
                [
                    'btn-small'         => esc_html__( 'small', 'seosight' ),
                    'btn-medium'        => esc_html__( 'medium', 'seosight' ),
                    'btn-large'         => esc_html__( 'large', 'seosight' ),
                ],
                'default'       => 'btn-medium'
            ]
        );

        $this->add_control(
            'outlined', 
            [
                'label'         => esc_html__( 'Outlined button', 'seosight' ),
                'type'          => \Elementor\Controls_Manager::SWITCHER,
                'description'   => esc_html__( 'Button with border and tranparent background', 'seosight' ),
				'label_on'		=> esc_html__('Yes', 'seosight' ),
				'label_off'		=> esc_html__( 'No', 'seosight' ),
                'default'       => 'no',
                'return_value'  => 'yes',    
            ]            
        );

		$this->end_controls_section();

		$this->start_controls_section(
			'css',
			[
				'label'         => esc_html__( 'Promotion block', 'seosight' ),         //TODO: style tabs!
				'tab'           => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'title-color',
			[
				'label'     => esc_html__( 'Color', 'seosight' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'scheme' =>
					[
						'type' => \Elementor\Scheme_Color::get_type(),
						'value' => \Elementor\Scheme_Color::COLOR_1,
					],

				'selectors' =>
					[
						'{{WRAPPER}} .servises-title' => 'color: {{SCHEME}};'
					]
			]
		);

		$this->add_control(
			'hover-title-color',
			[
				'label'     => esc_html__( 'Color on hover', 'seosight' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'scheme' =>
					[
						'type' => \Elementor\Scheme_Color::get_type(),
						'value' => \Elementor\Scheme_Color::COLOR_1,
					],

				'selectors' =>
					[
						'{{WRAPPER}} .servises-title:hover, .promo-link:hover' => 'color: {{SCHEME}};'
					]
			]
		);

		$this->add_group_control(
			'typography',
			[
				'name'      => 'title_typography',
				'label'     => esc_html__( 'Typography', 'seosight' ),
				'scheme'    => \Elementor\Scheme_Typography::TYPOGRAPHY_1,
				'selector'  => '{{WRAPPER}} .servises-title',
			]
		);

		$this->add_control(
			'subtitle-color',
			[
				'label'     => esc_html__( 'Color', 'seosight' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'scheme' =>
					[
						'type' => \Elementor\Scheme_Color::get_type(),
						'value' => \Elementor\Scheme_Color::COLOR_1,
					],

				'selectors' =>
					[
						'{{WRAPPER}} .servises-text, .promo-link' => 'color: {{SCHEME}};'
					]
			]
		);

		$this->add_control(
			'hover-subtitle-color',
			[
				'label'     => esc_html__( 'Color on hover', 'seosight' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'scheme' =>
					[
						'type' => \Elementor\Scheme_Color::get_type(),
						'value' => \Elementor\Scheme_Color::COLOR_1,
					],

				'selectors' =>
					[
						'{{WRAPPER}} .servises-text:hover, .promo-link:hover' => 'color: {{SCHEME}};'
					]
                ]
        );

		$this->add_group_control(
			'typography',
			[
				'name'      => 'subtitle_typography',
				'label'     => esc_html__( 'Typography', 'seosight' ),
				'scheme'    => \Elementor\Scheme_Typography::TYPOGRAPHY_1,
				'selector'  => '{{WRAPPER}} .servises-text',
			]
		);

		$this->add_control(
			'image-background',
			[
				'label'     => esc_html__( 'Background', 'seosight' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'scheme' =>
					[
						'type' => \Elementor\Scheme_Color::get_type(),
						'value' => \Elementor\Scheme_Color::COLOR_1,
					],

				'selectors' =>
					[
						'{{WRAPPER}} .servises-item__thumb img' => 'background: {{SCHEME}};'
					]
			]
		);

		$this->add_group_control(
			'border',
			[
				'name'      => 'border',
				'label'     => esc_html__( 'Border', 'seosight' ),
				'selector'  => '{{WRAPPER}} .servises-item__thumb img',
			]
		);

		$this->end_controls_section();

    }
    

    protected function render() {

        $settings = $this->get_settings_for_display();

        global $allowedtags;

        extract($settings);

        if ( !empty($image) || !empty($image_hover) ){
            $data_img .= '<div class = "servises-item__thumb">';
            if ( !empty($image_hover) ) {
                $data_img .= '<img src="'. $image_hover['url'] .'" alt ="'. esc_attr($title) .'" class = "hover">';
            } 
            if ( !empty($image)) {
                $data_img .= '<img src="'. $image['url'] .'" alt ="'. esc_attr($title) .'">';
            }
            $data_img .= '</div>';
        }

        if ($link['url']) {
            $href = 'href="'. $link['url'] . '"';
            $target = ($link['is_external']) ? 'target ="_blank"' : 'target = "_self"';
            $rel = ($link['nofollow']) ? 'rel ="nofollow"' : '';

            if($is_button){
                $btn_class = 'btn btn-hover-shadow btn-reverse-bg-color-dark';

                if($outlined == 'yes') {
                    $btn_class .= ' btn-border';
                }
                $btn_class .= ' '. esc_attr($btn_size);
                $btn_class .= ' '. esc_attr($btn_color);

                $data_button = '<a '. esc_url($href) .' '. esc_attr($target) .' '. esc_attr($rel) . 'class ="' . esc_attr($btn_class) . '"><span class="text">'. esc_html($link_title) . '</span><span class="semicircle"></span></a>';
            }
        }

        ?>
        <div class="crumina-module crumina-servises-item bg-border-color servises-item-reverse-color">

            <?php seosight_render( $data_img ); ?>

            <?php if ( ! empty( $title ) ) { ?>
                <h5 class="servises-title"><?php echo wp_kses( $title, $allowedtags ) ?></h5>
            <?php } ?>
            <?php if ( ! empty( $desc ) ) { ?>
                <p class="servises-text"><?php echo do_shortcode( $desc ); ?></p>
            <?php } ?>

	        <?php seosight_render( $data_button ); ?>
        </div>
        <?php
    }

}