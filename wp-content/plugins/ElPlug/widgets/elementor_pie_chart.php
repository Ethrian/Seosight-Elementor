<?php

class Elementor_pie_chart extends \Elementor\Widget_Base {


    public function get_name() {
		return 'pie_chart';
	}


	public function get_title() {
		return esc_html__( 'Pie chart', 'seosight' );
	}


	public function get_icon() {
		return 'fa fa-pie-chart';
	}

	
	public function get_categories() {
		return [ 'theme-elements' ];
	}

	
	protected function _register_controls() {

		$this->start_controls_section(
			'pie_chart',
			[
				'label'         => esc_html__( 'Pie chart', 'seosight' ),
				'tab'           => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'percent',
			[
				'label'         => esc_html__( 'Percent number', 'seosight' ),
                'type'          => \Elementor\Controls_Manager::SLIDER,
                'size_uints'    => [ '%' ],
                'range'         =>
                [
                    '%'         =>
                    [
                        'min'       => 0,
                        'max'       => 100
                    ]
                ],
                'default' => [
					'unit' => '%',
					'size' => 65,
				],
                'description'   => esc_html__( 'Drag slider to select the percentage number displayed', 'seosight' ),
			]
        );

        
        $this->add_control(
            'icon_option',
            [
                'label'         => esc_html__( 'Use icon?', 'seosight' ),
                'type'          => \Elementor\Controls_Manager::SWITCHER,
                'description'   => esc_html__( 'Display an icon instead the number?', 'seosight' ),
            ]
        );

        $this->add_control(
            'icon',
            [
                'label'         => esc_html__( 'Select icon', 'seosight' ),
                'type'          => \Elementor\Controls_Manager::ICON,
            ]
        );

        $this->add_control(
            'title',
            [
                'label'         => esc_html__('Title', 'seosight'),
                'type'          => \Elementor\Controls_Manager::TEXT,
            ]
        );

        $this->add_control(
            'description',
            [
                'label'         => esc_html__( 'Description', 'seosight' ),
                'type'          => \Elementor\Controls_Manager::TEXTAREA,
            ]
        );

        $this->add_control(
            'link',
            [
                'label'         => esc_html__( 'Link', 'seosight' ),
                'type'          => \Elementor\Controls_Manager::URL,
                'description'   => esc_html__( 'Additional link after description', 'seosight' ),
                'default'		=>
				[
					'url'			=> '#',
					'is_external'	=> false,
					'nofollow'		=> false,
				]
            ]
        );

        $this->add_control(
            'startcolor',
            [
                'label'         => esc_html__( 'Circle color start', 'seosight' ),
                'type'          => \Elementor\Controls_Manager::COLOR,
                'description'   => esc_html__( 'Color of the circle bar gradient', 'seosight' ),
                'default'       => '#3b8d8c',
                'scheme' => [
					'type' => \Elementor\Scheme_Color::get_type(),
					'value' => \Elementor\Scheme_Color::COLOR_1,
				]
            ]
        );

        $this->add_control(
            'endcolor',
            [
                'label'         => esc_html__( 'Circle color finish', 'seosight' ),
                'type'          => \Elementor\Controls_Manager::COLOR,
                'description'   => esc_html__( 'Color of the circle bar gradient', 'seosight' ),
                'default'       => '#4cc3c1',
                'scheme' => [
					'type' => \Elementor\Scheme_Color::get_type(),
					'value' => \Elementor\Scheme_Color::COLOR_1,
				]
            ]
        );

		$this->end_controls_section();

	}

	protected function render() {

		$settings = $this->get_settings_for_display();

        extract( $settings );

        fw_print($percent);
        $element_attr .= 'data-value='. esc_attr( $percent['size']) / 100 .' ';
        $element_attr .= 'data-startcolor="' . esc_attr( $startcolor ) . '" ';
        $element_attr .= 'data-endcolor="' . esc_attr( $endcolor ) . '"';

        if( $link['url']) {
            $href = 'href= "'. $link['url'] . '"';
            $target = ($link['target']) ? 'target = "_blank"' : 'taret = "_self"';
            $rel = ($link['rel']) ? 'rel = "nofollow"' : '';
        } 

        ?>
        <div class="crumina-module crumina-pie-chart-item">
            <div class="pie-chart js-run-pie-chart" <?php echo $element_attr; ?> >
		        <?php if ( $icon_option == 'yes' ) { ?>
			        <div class="icon"><i class="<?php seosight_render($icon); ?> pie_chart_icon"></i></div>
		        <?php } else { ?>
			        <div class="content"><?php echo esc_html( $percent['size'] ) ?><span>%</span></div>
		        <?php } ?>
	        </div>
	        <div class="pie-chart-content">
		        <?php if ( ! empty ( $title ) ) {
			        echo '<h4 class="pie-chart-content-title">' . esc_html( $title ) . '</h4>';
		        }
		        if ( ! empty ( $description ) ) {
			        echo '<div class="pie-chart-content-text">' . esc_attr( $description ) . '</div>';
		        }
        		if ( ! empty ( $block_link ) ) {
			        echo '<a  class="more" target="' . esc_attr( $target ) . '" title="' . $title_link . '">' . esc_attr( $title ). '<i class="seoicon-right-arrow"></i></a>';
		        }
		        ?>
	        </div>
        </div>
        <?php
    }
    
    protected function _content_template() {
        ?>
        <#
        var icon_option = (settings.icon_option === 'yes') ? true : false;
        var icon = settings.icon;
        var title = '<h4 class="pie-chart-content-title">' + settings.title + '</h4>';
        var description = '<div class="pie-chart-content-text">' + settings.description + '</div>';

        var href = (settings.link.url) ? 'href = "' + settings.link.url + '"' : '';
        var target = (settings.link.is_external) ? 'target = "_blank"' : 'target = "_self"';
        var rel = (settings.link.nofollow) ? 'rel = "nofollow"' : '';

        var percent = 'data-value="' + settings.percent.size / 100 + '"';
        var startcolor = 'data-startcolor="' + settings.startcolor + '"';
        var endcolor = 'data-encolor="' + settings.endcolor + '"';

        if (icon_option) 
            var icon_html = '<div class="icon"><i class="' + icon + ' pie_chart_icon"></i></div>'; 
        else
            var icon_html  = '<div class="content"><span>%</span></div>';
        #>

        <div class="crumina-module crumina-pie-chart-item">
    <div class="pie-chart" {{{percent}}} {{{startcolor}}} {{{endcolor}}} >
        {{{icon_html}}}
    </div>
    <div class="pie-chart-content">
        {{{title}}}
        {{{description}}}
        <a class="more" {{{href}}}{{{target}}}{{{rel}}}>more<i class="seoicon-right-arrow"></i></a>
    </div>
</div>
        <script type="text/javascript">
            jQuery(document).ready(function(wrp, $){
                CRUMINA.pieCharts( wrp )
            });
        </script>

        <?php
    }

}
