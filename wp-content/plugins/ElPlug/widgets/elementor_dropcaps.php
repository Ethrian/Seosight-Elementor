<?php

class Elementor_dropcaps extends \Elementor\Widget_Base {

	public function get_name() {
		return 'Dropcaps';
	}

	public function get_title() {
		return __( 'dropcaps', 'seosight' );
	}

	public function get_icon() {
		return 'fa fa-adn';
	}

	public function get_categories() {
		return [ 'general' ];
	}

	protected function _register_controls() {

		$this->start_controls_section(
			'Dropcaps',
			[
				'label'         => __( 'Dropcaps', 'seosight' ),
				'tab'           => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'dropcaps_desc',
			[
                'label'         => esc_html__( 'Text Paragraph', 'seosight' ),
                'type'          => \Elementor\Controls_Manager::TEXTAREA,
                'rows'          => 7,
                'placeholder'   => esc_html__( 'Bla-bla-bla...', 'seosight' ),    
			]
        );
        
        $this->add_control(
            'dropcaps_style',
            [
                'label'         => esc_html__( 'Base dropcap style', 'seosight' ),
                'type'          => \Elementor\Controls_Manager::SELECT,
                'options'       => 
                [
                    'squared'       => esc_html__( 'Square', 'seosight' ),
                    'dark-round'    => esc_html__( 'Rounded', 'seosight' ),
                    'primary'       => esc_html__( 'Simple', 'seosight' ),
                ],
                'default'       => 'squared',
            ]
        );

		$this->end_controls_section();

	}

	protected function render() {

        $settings = $this->get_settings_for_display();
        // $desc = $settings['dropcaps_desc'];
        // $style = $settings['dropcaps_style'];
        $wrap_class	= apply_filters( 'kc-el-class', $settings );

        extract( $settings );
        
        $wrap_class[] = 'first-letter--' .$dropcaps_style ;
        
        $check = trim(strip_tags($dropcaps_desc));
        
        if( !empty( $check ) ){
            $ch = mb_substr($check, 0,1);
            $pos = strpos($dropcaps_desc, $ch);
            $str_re = '<span class="dropcaps-text">' . $ch .'</span>';
            $dropcaps_desc = substr_replace($dropcaps_desc, $str_re, $pos, $pos+1);
        } else {
            $dropcaps_desc = esc_html__('Dropcap: Text not found', 'seosight');
        }
        
        ?>
        <div class="<?php echo esc_attr( implode( " ", $wrap_class) ); ?>">
            <?php echo do_shortcode($dropcaps_desc); ?>
        </div>
        <?php
	}   

    protected function _content_template() {
        ?>
        <#
        var attr = {
            desc: settings.dropcaps_desc,
            style: settings.dropcaps_style
        };

        var check = attr.desc.replace(' \t\n\r\0\x0B', '');
        if (check != '') {
            var ch = check.substr(0, 1);
            var pos = attr.desc.indexOf(ch);
            var str_re = '<span class="dropcaps-text">' + ch + '</span>';
        } else {
            attr.desc = 'Dropcap: Text not found';
        }
        #>

        <div class="first-letter--{{{style}}}">
            {{{attr.desc}}}
        </div>
        <?php 
    }
}
