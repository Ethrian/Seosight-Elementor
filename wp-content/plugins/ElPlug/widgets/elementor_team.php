<?php

class Elementor_team extends \Elementor\Widget_Base {


	public function get_name() {
		return 'team';
	}


	public function get_title() {
		return esc_html__( 'Team', 'seosight' );
	}


	public function get_icon() {
		return 'fa fa-github';
	}


	public function get_categories() {
		return [ 'theme-elements' ];
	}


	protected function _register_controls() {

		$this->start_controls_section(
			'team',
			[
				'label'         => esc_html__( 'Team', 'seosight' ),
				'tab'           => \Elementor\Controls_Manager::TAB_CONTENT,
			]
        );
        
        $this->add_control(
            'image',
            [
                'label'         => esc_html__( 'Avatar', 'seosight' ),
                'type'          => \Elementor\Controls_Manager::MEDIA
            ]
        );

		$this->add_control(
			'title',
			[
				'label'         => esc_html__( 'Name', 'seosight' ),
				'type'          => \Elementor\Controls_Manager::TEXT,
			]
        );
        
        $this->add_control(
            'subtitle',
            [
                'label'         => esc_html__( 'Subtitle', 'seosight' ),
                'type'          => \Elementor\Controls_Manager::TEXT,
            ]
        );

        $this->add_control(
            'link',
            [
                'label'         => esc_html__( 'Custom link', 'seosight' ),
                'type'          => \Elementor\Controls_Manager::URL,
                'placeholder'	=> esc_html__( 'https://your-link.com', 'seosight' ),
				'default'		=>
				[
					'url'			=> '#',
					'is_external'	=> false,
					'nofollow'		=> false
				]
            ]
        );

        $repeater = new \Elementor\Repeater();

        $repeater->add_control(
            'profile',
            [
                'label'         => esc_html__( 'link to your profile', 'seosight' ),
                'type'          => \Elementor\Controls_Manager::URL,
                'placeholder'	=> esc_html__( 'https://your-profile.com', 'seosight' ),
				'default'		=>
				[
					'url'			=> '#',
					'is_external'	=> false,
					'nofollow'		=> false
				]
            ]
        );

        $repeater->add_control(
            'icon',
            [
                'label'         => esc_html__( 'Select icon', 'seosight' ),
                'type'          => \Elementor\Controls_Manager::SELECT,
                'options'       => seosight_social_network_icons(),
                'description'   => esc_html__( 'Choose an icon to display', 'seosight' )
            ]
        );

        $this->add_control(
			'list',
			[
				'label' => esc_html__( 'Links', 'seosight' ),
				'type' => \Elementor\Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
			]
		);

		$this->end_controls_section();

	}


	protected function render() {

		$settings = $this->get_settings_for_display();

        extract( $settings );

        $href = 'href='. $link['url'];
        $target = ($link['is_external']) ? 'target =_blank' : 'target =_self';
        $rel = ($link['nofollow']) ? 'rel=nofollow' : '';

        ?>
        <div class="crumina-module crumina-teammembers-item">
            <div class="module-image">
                        <?php
                if ( $image ) {
                    $img_link = $image['url'];
                    if ( $link['url'] && $link['url'] !== '#' ) {
                        ?>
                        <a <?php echo esc_attr($href) .' '. esc_attr($target) .' '. esc_attr($rel); ?>>
                            <img src="<?php echo esc_url( $img_link ); ?>" alt="<?php echo esc_attr( $title ) ?>">
                        </a>
                    <?php } else { ?>
                        <img src="<?php echo esc_url( $img_link ); ?>" alt="<?php echo esc_attr( $title ) ?>">
                    <?php } ?>
                </div>
            <?php } if ( $title ) { ?>
                <h5 class="teammembers-item-name">
                    <?php
                    if ( $link[ 'url' ] && $link_page[ 'url' ] !== '#' ) {
                        echo '<a '. esc_url($href) .' '. esc_attr($target) .' '. esc_attr($rel). '">' . esc_html( $title ) . '</a>';
                    } else {
                        echo esc_html( $title );
                    }
                    ?>
                </h5>
            <?php } if ( !empty( $subtitle ) ) { ?>
                <p class="teammembers-item-prof"><?php echo esc_html( $subtitle ) ?></p>
                <?php
            }

            if ( $list ) {
                echo '<div class="socials">';
                foreach ( $list as $item ) {

                    $phref = 'href ='. $item['profile']['url'];
                    $ptarget = ($item['profile']['is_external']) ? 'target =_blank' : 'target =_self';
                    $prel = ($item['profile']['nofollow']) ? 'rel =nofollow' : '';
                    echo '<a '. esc_attr( $phref ) .' '. esc_attr($ptarget) .' '. esc_attr($prel). ' class="social__item">';
                    echo '<img src="' . get_template_directory_uri() . '/svg/socials/' . esc_attr( $item['icon'] ) . '" alt="' . esc_attr( $item['icon'] ) . '">';
                    echo '</a>';
                }
                echo '</div>';
            }
            ?>
        </div>
        <?php
    }

}
