<?php
/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function getwid_base_child_customize_register( $wp_customize ) {
	$hide_search = "getwid_base_hide_header_search";
	$wp_customize->remove_setting( $hide_search );
	$wp_customize->remove_control( $hide_search );
}

function enqueue_customizer_update() {
	add_action( 'customize_register', 'getwid_base_child_customize_register' );
}

add_action( "after_setup_theme", "enqueue_customizer_update" );
