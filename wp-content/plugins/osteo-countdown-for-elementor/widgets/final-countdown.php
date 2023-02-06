<?php

namespace Osteo_Countdown\Widgets;

use Elementor\Group_Control_Background;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Typography;
use Elementor\Controls_Manager;
use Elementor\Widget_Base;

defined( 'ABSPATH' ) || die();

class Osteo_Final_Countdown extends Widget_Base {
    public function get_name() {
        return "Osteo_Final_Countdown";
    }

    public function get_title() {
        return esc_html__( "Final Countdown", 'osteo-countdown' );
    }

    public function get_custom_help_url() {
        return 'https://docs.twinkletheme.com/docs/osteo-countdown-for-elementor/installation/';
    }

    public function get_icon() {
        return 'eicon-countdown';
    }

    public function get_keywords() {
        return ['countdown', 'clock', 'generic countdown'];
    }

    public function get_categories() {
        return ['basic'];
    }

    protected function _register_controls() {
		
        $this->start_controls_section(
			'content',
			[
				'label' 		        => esc_html__( 'Countdown', 'osteo-countdown' ),
				'tab'   		        => \Elementor\Controls_Manager::TAB_CONTENT,
			]
        );

        $this->add_control(
            'countdown_style',
            [
                'label'       => esc_html__( 'Style', 'osteo-countdown' ),
                'type'        => Controls_Manager::SELECT,
                'default'     => 'style-1',
                'label_block' => false,
                'options'     => [
                    'style-1' => esc_html__( 'Style 1', 'osteo-countdown' ),
                    'style-2' => esc_html__( 'Style 2', 'osteo-countdown' ),
                    'style-3' => esc_html__( 'Style 3', 'osteo-countdown' ),
                    'style-4' => esc_html__( 'Style 4', 'osteo-countdown' ),
                ],
            ]
        );

        $this->add_control(
            'date', 
            [
                'label'     => __( 'Target Time', 'timerelement' ),
                'type'      => \Elementor\Controls_Manager::DATE_TIME,
            ]
        );

        $this->end_controls_section();

		$this->start_controls_section(
			'countdown_styles',
			[
				'label' 		        => esc_html__( 'Countdown', 'osteo-countdown' ),
				'tab'   		        => \Elementor\Controls_Manager::TAB_STYLE,
			]
        );

        $this->add_control(
            'countdown_color',
            [
                'label' 	            => esc_html__( 'Color', 'osteo-countdown' ),
                'type' 		            => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .countdown div' 	=> 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'countdown_background',
            [
                'label' 	            => esc_html__( 'Background', 'osteo-countdown' ),
                'type' 		            => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .countdown div'    => 'background-color: {{VALUE}}',
                ],
                'condition' => [
                    'countdown_style' => [ 'style-1', 'style-2' ],
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name'      => 'countdown_border',
                'label'     => esc_html__( 'Border', 'osteo-countdown' ),
                'selector'  => '{{WRAPPER}} .countdown div',
                'condition' => [
                    'countdown_style' => [ 'style-3', 'style-4' ],
                ],
            ]
        );

        $this->add_control(
            'countdown_padding',
            [
                'label'      		    => esc_html__( 'Padding', 'osteo-countdown' ),
                'type'       		    => Controls_Manager::DIMENSIONS,
                'size_units' 		    => [ 'px', 'em', '%' ],
                'selectors'  => [
                    '{{WRAPPER}} .countdown div' 	=> 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' 				    => 'countdown_shadow',
                'selector' 			    => '{{WRAPPER}} .countdown div',
            ]
        );

        $this->add_group_control(
			Group_Control_Typography::get_type(),
			[
            	'name'                  => 'countdown_typography',
				'selector'              => '{{WRAPPER}} .countdown div',
			]
		);

        $this->end_controls_section();

		$this->start_controls_section(
			'tag_styles',
			[
				'label' 		        => esc_html__( 'Tags', 'osteo-countdown' ),
				'tab'   		        => \Elementor\Controls_Manager::TAB_STYLE,
			]
        );

        $this->add_control(
            'tag_color',
            [
                'label' 	            => esc_html__( 'Color', 'osteo-countdown' ),
                'type' 		            => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .countdown span' 	=> 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'tag_padding',
            [
                'label'      		    => esc_html__( 'Padding', 'osteo-countdown' ),
                'type'       		    => Controls_Manager::DIMENSIONS,
                'size_units' 		    => [ 'px', 'em', '%' ],
                'selectors'  => [
                    '{{WRAPPER}} .countdown span' 	=> 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
			Group_Control_Typography::get_type(),
			[
            	'name'                  => 'tag_typography',
				'selector'              => '{{WRAPPER}} .countdown span',
			]
		);

        $this->end_controls_section();

	}

    protected function render() {
        $settings = $this->get_settings_for_display();

        $date          = $this->get_settings('date');
		?>

        <?php if ( 'style-1' === $settings['countdown_style'] ): ?>

            <div class="countdown osteo-countdownt-style-1"
                data-date="<?php echo $date; ?>">
            </div>

        <?php elseif ( 'style-2' === $settings['countdown_style'] ): ?>
            
            <div class="countdown osteo-countdownt-style-2"
                data-date="<?php echo $date; ?>">
            </div>

        <?php elseif ( 'style-3' === $settings['countdown_style'] ): ?>

            <div class="countdown osteo-countdownt-style-3"
                data-date="<?php echo $date; ?>">
            </div>

        <?php elseif ( 'style-4' === $settings['countdown_style'] ): ?>

            <div class="countdown osteo-countdownt-style-4"
                data-date="<?php echo $date; ?>">
            </div>

        <?php elseif ( 'style-2' === $settings['countdown_style'] ): ?>

        <?php endif;?>
		<?php

    }

}
