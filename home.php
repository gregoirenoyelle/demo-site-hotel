<?php
/**
 * This file adds the Home Page to the CHG home page
 *
 * @author Grégoire Noyelle
 * @package CHG Mont d'Or
 * @subpackage Customizations
 */

add_action( 'genesis_meta', 'chgor_home_genesis_meta' );
/**
 * Add widget support for homepage. If no widgets active, display the default loop.
 *
 */
function chgor_home_genesis_meta() {

	if ( is_active_sidebar( 'home-top' ) || is_active_sidebar( 'home-middle' ) || is_active_sidebar( 'home-bottom' ) ) {

		// Force content-sidebar layout setting
		add_filter( 'genesis_site_layout', '__genesis_return_full_width_content' );

		// Remove main navigation
		remove_action( 'genesis_after_header', 'genesis_do_nav' );

		// Add magazine-home body class
		add_filter( 'body_class', 'chgor_body_class' );

		// Remove the default Genesis loop
		remove_action( 'genesis_loop', 'genesis_do_loop' );

		// Remove main navigation
		remove_action( 'genesis_after_header', 'genesis_do_subnav' );

		// Add homepage widgets
		add_action( 'genesis_loop', 'chgor_homepage_widgets' );

	}
}

function chgor_body_class( $classes ) {

	$classes[] = 'magazine-home chg-home';
	return $classes;

}

function chgor_homepage_widgets() {

	genesis_widget_area( 'home-top', array(
		'before' => '<div class="home-top widget-area">',
		'after'  => '</div>',
	) );

	genesis_widget_area( 'home-bottom', array(
		'before' => '<div class="home-news widget-area">',
		'after'  => '</div>',
	) );


	genesis_widget_area( 'home-middle', array(
		'before' => '<div class="home-middle widget-area">',
		'after'  => '</div>',
	) );

}

genesis();
