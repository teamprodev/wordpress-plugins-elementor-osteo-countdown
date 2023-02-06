<?php

namespace Osteo_Countdown;
defined( 'ABSPATH' ) || die();

if ( !class_exists( 'Widgets_Manager' ) ) {

    class Widgets_Manager {

        private static $_instance = null;
        public static function instance() {
            if ( is_null( self::$_instance ) ) {
                self::$_instance = new self();
            }
            return self::$_instance;
        }

        public function __construct() {

            // Add Plugin actions
            add_action( "elementor/widgets/widgets_registered", [$this, 'init_widgets'] );
        }

        // Controll Widgets
        public function init_widgets() {

            $widgets_manager = \Elementor\Plugin::instance()->widgets_manager;

            require_once OSTEO_COUNTDOWN_PATH . 'widgets/flip-clock.php';
            \Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Widgets\Osteo_Flip_Clock_Countdown() );

            require_once OSTEO_COUNTDOWN_PATH . 'widgets/final-countdown.php';
            \Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Widgets\Osteo_Final_Countdown() );

        }

    }

    Widgets_Manager::instance();

}