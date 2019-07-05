<?php

class Elementor_shifted_image extends \Elementor\Widget_Base {


	public function get_name() {
		return 'shifted image';
	}


	public function get_title() {
		return esc_html__( 'Shifted image', 'seosight' );
	}


	public function get_icon() {
		return 'fa fa-object-group';
	}


	public function get_categories() {
		return [ 'theme-elements' ];
	}


	protected function _register_controls() {

		$this->start_controls_section(
			'shifted-image',
			[
				'label'         => esc_html__( 'Shifted image', 'seosight' ),
				'tab'           => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'image',
			[
				'label'         => esc_html__( 'Attached image', 'seosight' ),
                'type'          => \Elementor\Controls_Manager::MEDIA,
                'default'       => \Elementor\Utils::get_placeholder_image_src()
			]
        );
        
        $this->add_control(
            'title',
            [
                'label'         => esc_html__( 'Title', 'seosight' ),
                'type'          => \Elementor\Controls_Manager::TEXT,
                'description'   => esc_html__( 'Enter title (Note: It is located above the content).', 'seosight' )
            ]
        );

        $this->add_control(
            'direcion',
            [
                'label'         => esc_html__( 'Content align', 'seosight' ),
                'description'   => esc_html__( 'The horizotal alignment of element', 'seosight' ),
                'type'          => \Elementor\Controls_Manager::SELECT,
                'options'       => 
                [
                    'leftimage'  => esc_html__( 'Image on Left', 'seosight' ),
					'rightimage' => esc_html__( 'Image on Right', 'seosight' )
                ],
                'default'       => 'leftimage'
            ]
        );

        $this->add_control(
            'desc',
            [
                'label'         => esc_html__( 'Text', 'seosight' ),
                'type'          => \Elementor\Controls_Manager::TEXTAREA
            ]
        );

		$this->end_controls_section();

	}


	protected function render() {

        $settings = $this->get_settings_for_display();
        
        global $allowedposttags;

        $title      = $settings['title'];
        $image      = $settings['image'];
        $desc       = $settings['desc'];
        $direction  = $settings['direction'];     

        $image_attr = $image['url'];

        $el_class = 'crumina_module crumina-product-description-border';
        
        if ( $direction === 'rightimage' ) {
            $el_class = $el_class . ' even';
        }

        ?>

<div class="<?php echo esc_attr($el_class) ?>">


<div class="product-description-thumb">
    <img src="<?php echo esc_url( $image_attr ); ?>" alt="<?php echo esc_attr( $title ) ?>" class="shadow-image">
</div>

<div class="product-description-content">
    <div class="crumina-module crumina-heading">
        <h4 class="h1 heading-title"><?php echo esc_html( $title ) ?></h4>
        <div class="heading-decoration">
            <span class="first"></span>
            <span class="second"></span>
        </div>
        <div class="product-description-text"> <?php echo wp_kses( $desc, $allowedposttags ); ?></div>
        </div>
</div>

<div class="product-description-border"></div>
</div>
<?php
	}

}