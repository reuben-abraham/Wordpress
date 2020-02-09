<?php
/**
 * isha Theme Customizer
 *
 * @package isha
 */
use WPTRT\Customize\Section\Button;

function isha_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';

	if ( isset( $wp_customize->selective_refresh ) ) {
		$wp_customize->selective_refresh->add_partial( 'blogname', array(
			'selector'        => '.site-title a',
			'render_callback' => 'isha_customize_partial_blogname',
		) );
		$wp_customize->selective_refresh->add_partial( 'blogdescription', array(
			'selector'        => '.site-description',
			'render_callback' => 'isha_customize_partial_blogdescription',
		) );
	}

	
	require get_template_directory() . '/inc/customizer/colors.php';

}
add_action( 'customize_register', 'isha_customize_register' );

/**
 * Render the site title for the selective refresh partial.
 *
 * @return void
 */
function isha_customize_partial_blogname() {
	bloginfo( 'name' );
}

/**
 * Render the site tagline for the selective refresh partial.
 *
 * @return void
 */
function isha_customize_partial_blogdescription() {
	bloginfo( 'description' );
}

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function isha_customize_preview_js() {
	wp_enqueue_script( 'isha-customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), '20151215', true );
}
add_action( 'customize_preview_init', 'isha_customize_preview_js' );

/*----------------------------------------------------------------------------------------------------------------------------------------*/
/**
 * Load customizer required panels.
 */
require get_template_directory() . '/inc/customizer/background-color-panel.php';
require get_template_directory() . '/inc/customizer/theme-option-panel.php';

require get_template_directory() . '/inc/customizer/customizer-sanitize.php';
require get_template_directory() . '/inc/customizer/customizer-css.php';