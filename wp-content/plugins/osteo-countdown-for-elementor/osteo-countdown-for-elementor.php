<?php
/**
 * Plugin Name: Osteo Countdown for Elementor
 * Description: This is a Countdown addon for Elementor Page Builder.
 * Plugin URI:  https://twinkledev.xyz/codecanyon/osteo-countdown/
 * Version:     1.0.0
 * Author:      TwinkleTheme
 * Author URI:  https://codecanyon.net/user/twinkletheme
 * Text Domain: 'osteo-countdown'
 */

namespace Osteo_Countdown;

defined( 'ABSPATH' ) || die();
define( 'OSTEO_COUNTDOWN_VERSION', '1.0.0' );
define( 'OSTEO_COUNTDOWN_ROOT', __FILE__ );
define( 'OSTEO_COUNTDOWN_PATH', plugin_dir_path( OSTEO_COUNTDOWN_ROOT ) );
define( 'OSTEO_COUNTDOWN_URL', plugin_dir_url( OSTEO_COUNTDOWN_ROOT ) );
define( 'OSTEO_COUNTDOWN_ASSETS', trailingslashit( OSTEO_COUNTDOWN_URL . 'assets/' ) );
define( 'OSTEO_COUNTDOWN_PLUGIN_BASE', plugin_basename( OSTEO_COUNTDOWN_ROOT ) );

final class OsteoCountdown {

    const MINIMUM_ELEMENTOR_VERSION = '2.5.0';
    const MINIMUM_PHP_VERSION = '7.0';

    public function __construct() {

        // Load translation
        add_action( 'init', array( $this, 'load_textdomain' ) );

        // Init Plugin
        add_action( 'plugins_loaded', array( $this, 'init' ) );
    }

    public function load_textdomain() {
        load_plugin_textdomain( 'osteo-countdown', FALSE, dirname( plugin_basename( __FILE__ ) ) . '/languages/' );
    }

    public function init() {

        $this->include_files();

        // Check if Elementor installed and activated
        if ( !did_action( 'elementor/loaded' ) ) {
            add_action( 'admin_notices', array( $this, 'admin_notice_missing_main_plugin' ) );
            return;
        }

        // Check for required Elementor version
        if ( !version_compare( ELEMENTOR_VERSION, self::MINIMUM_ELEMENTOR_VERSION, '>=' ) ) {
            add_action( 'admin_notices', array( $this, 'admin_notice_minimum_elementor_version' ) );
            return;
        }

        // Check for required PHP version
        if ( version_compare( PHP_VERSION, self::MINIMUM_PHP_VERSION, '<' ) ) {
            add_action( 'admin_notices', array( $this, 'admin_notice_minimum_php_version' ) );
            return;
        }

    }

    public function admin_notice_missing_main_plugin() {
        if ( isset( $_GET['activate'] ) ) {
            unset( $_GET['activate'] );
        }

        $notice = sprintf(
            /* translators: 1: Plugin name 2: Elementor */
            esc_html__( '"%1$s" requires "%2$s" to be installed and activated.', 'osteo-countdown' ),
            '<strong>' . esc_html__( 'Osteo Countdown for Elementor', 'osteo-countdown' ) . '</strong>',
            '<strong>' . esc_html__( 'Elementor', 'osteo-countdown' ) . '</strong>'
        );

        printf( '<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $notice );
    }

    public function admin_notice_minimum_elementor_version() {
        if ( isset( $_GET['activate'] ) ) {
            unset( $_GET['activate'] );
        }

        $notice = sprintf(
            /* translators: 1: Plugin name 2: Elementor 3: Required Elementor version */
            esc_html__( '"%1$s" requires "%2$s" version %3$s or greater.', 'osteo-countdown' ),
            '<strong>' . esc_html__( 'Osteo Countdown for Elementor', 'osteo-countdown' ) . '</strong>',
            '<strong>' . esc_html__( 'Elementor', 'osteo-countdown' ) . '</strong>',
            self::MINIMUM_ELEMENTOR_VERSION
        );

        printf( '<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $notice );
    }

    public function admin_notice_minimum_php_version() {
        if ( isset( $_GET['activate'] ) ) {
            unset( $_GET['activate'] );
        }

        $notice = sprintf(
            /* translators: 1: Plugin name 2: PHP 3: Required PHP version */
            esc_html__( '"%1$s" requires "%2$s" version %3$s or greater.', 'osteo-countdown' ),
            '<strong>' . esc_html__( 'Osteo Countdown for Elementor', 'osteo-countdown' ) . '</strong>',
            '<strong>' . esc_html__( 'PHP', 'osteo-countdown' ) . '</strong>',
            self::MINIMUM_PHP_VERSION
        );

        printf( '<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $notice );
    }

    public function include_files() {

        include_once OSTEO_COUNTDOWN_PATH . ( 'includes/assets-manager.php' );
        include_once OSTEO_COUNTDOWN_PATH . ( 'includes/widgets-manager.php' );
        include_once OSTEO_COUNTDOWN_PATH . ( 'includes/row-manager.php' );
        include_once OSTEO_COUNTDOWN_PATH . ( 'lib/tgm-active.php' );
    }

}

// Instantiate
new OsteoCountdown();