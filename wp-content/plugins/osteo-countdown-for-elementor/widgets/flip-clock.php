<?php

namespace Osteo_Countdown\Widgets;

use Elementor\Controls_Manager;
use Elementor\Widget_Base;

defined( 'ABSPATH' ) || die();

class Osteo_Flip_Clock_Countdown extends Widget_Base {
    public function get_name() {
        return "Osteo_Flip_Clock_Countdown";
    }

    public function get_title() {
        return esc_html__( "Flip Clock", 'osteo-countdown' );
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
            'content_section',
            [
                'label' => esc_html__( 'Content', 'osteo-countdown' ),
                'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'display_type',
            [
                'label'   => esc_html__( 'Display Type', 'osteo-countdown' ),
                'type'    => \Elementor\Controls_Manager::SELECT,
                'options' => [
                    'clock'     => esc_html__( 'Clock', 'osteo-countdown' ),
                    'countdown' => esc_html__( 'Countdown', 'osteo-countdown' ),
                    'generic'   => esc_html__( 'Generic CountDown', 'osteo-countdown' ),
                ],
                'default' => 'clock',
            ]
        );

        $this->add_control(
            'clock_format',
            [
                'label'     => esc_html__( 'Clock Format', 'osteo-countdown' ),
                'type'      => \Elementor\Controls_Manager::SELECT,
                'options'   => [
                    'TwelveHourClock' => esc_html__( '12 Hour', 'osteo-countdown' ),
                    'TwentyFourHourClock' => esc_html__( '24 Hour', 'osteo-countdown' ),
                ],
                'default'   => 'TwelveHourClock',
                'condition' => [
                    'display_type' => 'clock',
                ],
            ]
        );

        $this->add_control( 
            'target_clock_time', 
            [
                'label'       => esc_html__( 'Target Time', 'osteo-countdown' ),
                'type'        => \Elementor\Controls_Manager::DATE_TIME,
                'condition'   => [
                    'display_type' => 'countdown',
                ],
                'label_block' => false,
            ] 
        );

        $this->add_control( 
            'generic_countdown', 
            [
                'label'       => esc_html__( 'Countdown From', 'osteo-countdown' ),
                'type'        => \Elementor\Controls_Manager::NUMBER,
                'condition'   => [
                    'display_type' => 'generic',
                ],
                'label_block' => false,
            ] 
        );

        $this->end_controls_section();

    }

    protected function render() {
        $settings = $this->get_settings_for_display();
        $clock_format = $this->get_settings( 'clock_format' );
        $target_time = $this->get_settings( 'target_clock_time' );
        $countdown = $this->get_settings( 'generic_countdown' );
        
        ?>

        <?php if ( 'clock' === $settings['display_type'] ): ?>
            <div class="clock-1" data-clock-format="<?php echo $clock_format ?>"></div>

        <?php elseif ( 'countdown' === $settings['display_type'] ): ?>
            <div class="clock-2" data-target-time="<?php echo $target_time ?>"></div>

        <?php elseif ( 'generic' === $settings['display_type'] ): ?>
            <div class="clock-3" data-countdown="<?php echo $countdown ?>"></div>

            <?php endif;?>
		<?php
    }
}
