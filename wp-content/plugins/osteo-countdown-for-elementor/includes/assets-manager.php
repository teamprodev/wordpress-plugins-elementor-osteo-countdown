<?php

namespace Osteo_Countdown;
defined( 'ABSPATH' ) || die();

if ( !class_exists( 'Assets_Manager' ) ) {

    class Assets_Manager {

        private static $_instance = null;
        public static function instance() {
            if ( is_null( self::$_instance ) ) {
                self::$_instance = new self();
            }
            return self::$_instance;
        }

        public function __construct() {
            add_action( "elementor/frontend/after_enqueue_styles", [$this, 'frontend_enqueue_styles'] );
            add_action( 'elementor/frontend/after_enqueue_scripts', [$this, 'frontend_enqueue_scripts'] );
        }

        public function frontend_enqueue_styles() {

            wp_enqueue_style( 'flipclock', OSTEO_COUNTDOWN_ASSETS . 'vendor/flipclock/flipclock.css', array(), '1.0.0' );
            wp_enqueue_style( 'osteo-countdown-style', OSTEO_COUNTDOWN_ASSETS . 'css/style.css', array(), '1.0.0' );

        }

        public function frontend_enqueue_scripts() {

            wp_enqueue_script( 'flipclock', OSTEO_COUNTDOWN_ASSETS . 'vendor/flipclock/flipclock.min.js', array( 'jquery' ), '1.0.0', true );
            wp_enqueue_script( 'final-countdown', OSTEO_COUNTDOWN_ASSETS . 'vendor/final-countdown/jquery.countdown.min.js', array( 'jquery' ), '1.0.0', true );
            wp_enqueue_script( 'osteo-countdown-script', OSTEO_COUNTDOWN_ASSETS . 'js/main.js', array( 'jquery' ), '1.0.0', true );

        }

    }

    Assets_Manager::instance();

}