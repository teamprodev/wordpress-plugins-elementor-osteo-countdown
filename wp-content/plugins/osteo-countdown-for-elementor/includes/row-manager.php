<?php

namespace Osteo_Countdown;
defined( 'ABSPATH' ) || die();

add_filter( 'plugin_action_links_' . OSTEO_COUNTDOWN_PLUGIN_BASE, function ( $links ) {
    $link = sprintf( "<a href='%s' style='color: #E91E63; font-weight: 700'>%s</a>", esc_url( 'https://docs.twinkletheme.com/docs/osteo-countdown-for-elementor/installation/' ), esc_html__( 'Documentation', 'osteo-countdown' ) );
    array_push( $links, $link );

    return $links;
} );