<?php

class Elementor_client_slider extends \Elementor\Widget_Base {


	public function get_name() {
		return 'client_slider';
	}


	public function get_title() {
		return esc_html__( 'Client slider', 'seosight' );
	}


	public function get_icon() {
		return 'fa fa-reply';
	}


	public function get_categories() {
		return [ 'theme-elements' ];
	}


	protected function _register_controls() {

		$this->start_controls_section(
			'Client-slider',
			[
				'label'         => esc_html__( 'Slider', 'seosight' ),
				'tab'           => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'number-of-items',
			[
				'label'         => esc_html__( 'Number of items', 'seosight' ),
                'type'          => \Elementor\Controls_Manager::SLIDER,
                'description'   => 'Number of items displayed on one screen',
                'size_units'    => ['em'],
                'range'         =>
                [
                    'em'        =>
                    [
                        'min'       => 1,
                        'max'       => 10,
                        'step'      => 1
                    ]
                ],
                'default'       =>
                [
                    'unit'      => 'em',
                    'size'      => 4
                ]
			]
        );

        $this->add_control(
            'arrows',
            [
                'label'         => esc_html__( 'Show arrows?', 'seosight' ),
                'type'          => \Elementor\Controls_Manager::SWITCHER,
                'description'   => esc_html__( 'Next/previous slider buttons', 'seosight' ),
                'label_on'		=> esc_html__('yes', 'seosight' ),
				'label_off'		=> esc_html__( 'no', 'seosight' ),
                'default'       => 'yes',
                'return_value'  => 'yes',
            ]
        );

        $this->add_control(
            'dots', 
            [
                'label'         => esc_html__( 'Show dots?', 'seosight'),
                'type'          => \Elementor\Controls_Manager::SWITCHER,
                'description' => esc_html__( 'Pagination dots', 'seosight' ),
                'label_on'		=> esc_html__('yes', 'seosight' ),
				'label_off'		=> esc_html__( 'no', 'seosight' ),
                'default'       => 'yes',
                'return_value'  => 'yes',
            ]
        );

		$this->add_control(
			'pause_on_hover',
			[
				'label' => __( 'Pause on Hover', 'elementor' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => 'yes',
				'options' => [
					'yes' => __( 'Yes', 'elementor' ),
					'no' => __( 'No', 'elementor' ),
				],
				'frontend_available' => true,
			]
		);

		$this->add_control(
			'autoplay',
			[
				'label' => __( 'Autoplay', 'elementor' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => 'yes',
				'options' => [
					'yes' => __( 'Yes', 'elementor' ),
					'no' => __( 'No', 'elementor' ),
				],
				'frontend_available' => true,
			]
		);

		$this->add_control(
			'autoplay_speed',
			[
				'label' => __( 'Autoplay Speed', 'elementor' ),
				'type' => \Elementor\Controls_Manager::NUMBER,
				'default' => 5000,
				'frontend_available' => true,
			]
		);

		$this->add_control(
			'infinite',
			[
				'label' => __( 'Infinite Loop', 'elementor' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => 'yes',
				'options' => [
					'yes' => __( 'Yes', 'elementor' ),
					'no' => __( 'No', 'elementor' ),
				],
				'frontend_available' => true,
			]
		);

		$this->add_control(
			'effect',
			[
				'label' => __( 'Effect', 'elementor' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => 'slide',
				'options' => [
					'slide' => __( 'Slide', 'elementor' ),
					'fade' => __( 'Fade', 'elementor' ),
				],
				'condition' => [
					'slides_to_show' => '1',
				],
				'frontend_available' => true,
			]
		);

		$this->add_control(
			'speed',
			[
				'label' => __( 'Animation Speed', 'elementor' ),
				'type' => \Elementor\Controls_Manager::NUMBER,
				'default' => 500,
				'frontend_available' => true,
			]
		);

//        $this->add_control(
//            'autoplay',
//            [
//                'label'         => esc_html__( 'Autoslide', 'seosight' ),
//                'type'          => \Elementor\Controls_Manager::SWITCHER,
//                'description' => esc_html__( 'Automatic auto scroll slides', 'seosight' ),
//                'label_on'		=> esc_html__('yes', 'seosight' ),
//				'label_off'		=> esc_html__( 'no', 'seosight' ),
//                'default'       => 'no',
//                'return_value'  => 'yes',
//				'frontend_available' => true,
//            ]
//        );
//
//		$this->add_control(
//			'autoplay_speed',
//			[
//				'label' => __( 'Autoplay Speed', 'seosight' ),
//				'type' => \Elementor\Controls_Manager::NUMBER,
//				'default' => 5000,
//				'frontend_available' => true,
//			]
//		);

		$this->end_controls_section();


		$this->start_controls_section(
			'items',
			[
				'label'         => esc_html__( 'Slider items', 'seosight' ),
                'tab'           => \Elementor\Controls_Manager::TAB_CONTENT
			]
        );

        $repeater = new \Elementor\Repeater();

        $repeater->add_control(
            'image', 
            [
                'label'         => esc_html__( 'Client logo', 'seosight' ),
                'type'          => \Elementor\Controls_Manager::MEDIA,
                'default'       => \Elementor\Utils::get_placeholder_image_src()
            ]
        );

        $repeater->add_control(
            'url', 
            [
                'label'         => esc_html__( 'Custom link', 'seosight' ),
                'type'          => \Elementor\Controls_Manager::URL,
                'placeholder'	=> esc_html__( 'https://your-link.com', 'seosight' )
            ]
        );

        $this->add_control(
			'list',
			[
				'label' => esc_html__( 'Repeater List', 'seosight' ),
				'type' => \Elementor\Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
			]
		);
    
        $this->end_controls_section();
    }


	protected function render() {

        $settings = $this->get_settings_for_display();

        $count = $settings['number-of-items']['size'];
        $arrows = $settings['arrows'];
        $dots = $settings['dots'];
        $autoscroll = $settings['autoplay'];
        $delay = $settings['time']['size'];
        $items = $settings['list'];
        $items_html = '';

        $slider_attr[] = 'data-show-items="' . esc_attr( $count ) . '" ';

        if ( 'yes' === $autoscroll ) {
            $slider_attr[] = 'transition-duration: ' . esc_attr( $delay * 1000 ) . 'ms';
        }
        if ( 'yes' === $arrows ) {
	        $pagination_class = 'pagination-bottom-large ';
        } elseif ( 'yes' === $dots ) {
	        $pagination_class = 'pagination-bottom ';
        } else {
	        $pagination_class = '';
        }

        ?>
        <div class="<?php echo implode( ' ', $wrap_class ); ?>">
            <div class="swiper-container <?php echo esc_attr( $pagination_class ) ?>" style="<?php echo esc_attr($slider_attr[0]); ?>">
                <div class="swiper-wrapper">
                <?php
                    foreach ( $items as $item ) {

                        $item_html = '';

                        if ( $item['image'] ) 
                        {
                            $img_link = $item['image']['url'];
                        

                            if ( $item['url'] ) 
                            {
                                $has_link = true;

                                $link = $item['url'];
                                $href = $link['url'];
                                $target = ( $link['is_external'] ) ? '_blank' : '_self';
                                $rel = ( $link['nofollow'] ) ? 'nofollow' : '';

                            }

                            ?>
                            <div class="swiper-slide client-item">
                            <?php if ( $has_link ) {
                                echo '<a class="client-image" href = "'. esc_url($href) .'" target = "'. esc_attr($target) .'" rel = "'. esc_attr($rel) .'">';
                                echo '<img src="'. esc_html( $img_link ) . '"alt="hover" class="hover">';
                                echo '</a>';
                            } else {
                                echo '<img src="'. esc_html( $img_link ) . '"alt="hover" class="hover">';
                            } ?>
                            </div>
                        <?php }
                    } ?>
                </div>
                <?php if ( 'yes' === $arrows ) {
                    ?>
            <!--Prev Next Arrows-->
                    <svg class="btn-next">
                        <use xlink:href="#arrow-right"></use>
                    </svg>
                    <svg class="btn-prev">
                        <use xlink:href="#arrow-left"></use>
                    </svg>
                <?php } elseif ( 'yes' === $dots ) { ?>
            <!-- Slider pagination -->
                    <div class="swiper-pagination"></div>
                <?php } ?>
            </div>
        </div>
         <?php

    }

}