<?php



class Elementor_slider extends \Elementor\Widget_Base {


	public function get_name() {
		return 'Slider';
	}


	public function get_title() {
		return esc_html__( 'Display theme slider', 'seosight' );
	}


	public function get_icon() {
		return 'fa fa-mail-forward';
	}


	public function get_categories() {
		return [ 'theme-elements' ];
	}


	protected function _register_controls() {

		$this->start_controls_section(
			'slider',
			[
				'label'         => esc_html__( 'Slider', 'seosight' ),
				'tab'           => \Elementor\Controls_Manager::TAB_CONTENT,
			]
        );
        

        $sliders = get_posts(
            array(
                'post_type'   => 'fw-slider',
                'numberposts' => - 1
            )
        );

        if (!empty($sliders)) {
            foreach ($sliders as $slider) {
                $choices[ $slider->ID ] = empty( $slider->post_title ) ? esc_html__( '(no title)', 'seosight' ) : $slider->post_title;
            }
            $this->add_control(
                'slider_id', 
                [
                    'type'          =>\Elementor\Controls_Manager::SELECT,
                    'label'         => esc_html__( 'Select slider', 'seosight' ),
                    'description'   =>
                    str_replace(
                        array(
                            '{br}',
                            '{edit_slider_link}'		
                        ),
                array(      
                    '<br/>',        
                            fw_html_tag( 'a', array( 										
                                'href'   => admin_url( 'edit.php?post_type=fw-slider' ),	
                                'target' => '_blank',
                            ), esc_html__( 'change this Slider', 'seosight' ) )
                        ),
                        esc_html__( 'You can edit sliders in admin interface only. {br} Please go to the Sliders page for {edit_slider_link}.', 'seosight' )
                    ),
                    'options'       => $choices
                ]
            );
        } else {
            $this->add_control(                                         
                'no-forms', 
                [
                    'label'         => false,
                    'type'          => \Elementor\Controls_Manager::RAW_HTML,
                    'raw'           =>
                    '<p>' .
                    '<em>' .
                    str_replace(
                        array(
                            '{br}',
                            '{add_slider_link}'
                        ),
                        array(
                            '<br/>',
                            fw_html_tag( 'a', array(
                                'href'   => admin_url( 'post-new.php?post_type=fw-slider'),
                                'target' => '_blank',
                            ), esc_html__( 'create a new Slider', 'seosight' ) )
                        ),
                        __( 'No Sliders created yet. Please go to the {br}Sliders page and {add_slider_link}.', 'seosight' )
                    ) .
                    '</em>' .
                    '</p>'  
                ]
            );
        }

		$this->end_controls_section();

	}


	protected function render() {

        $settings = $this->get_settings_for_display();

        extract( $settings );

        $css_class = apply_filters( 'kc-el-class', $settings ); ?>

        <div class="<?php echo esc_attr( implode( ' ', $css_class ) ) ?>">
        <?php if ( ! empty( $settings['slider_id'] ) ) {
	        echo fw()->extensions->get( 'slider' )->render_slider( $settings['slider_id'],
		        array() );
        } ?>
            </div>
            
            <script type="text/javascript">
            
            jQuery(document).ready(function(){
                CRUMINA.initSwiper
            });
            </script>

        <?php
    }

    
    protected function _content_template() {
       
    }
}