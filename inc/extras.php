<?php
/**
 * Custom functions that act independently of the theme templates.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package WINSIDER
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function winsider_body_classes( $classes ) {
	// Adds a class of group-blog to blogs with more than 1 published author.
	if ( is_multi_author() ) {
		$classes[] = 'group-blog';
	}

	// Adds a class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}

	return $classes;
}
add_filter( 'body_class', 'winsider_body_classes' );


/**
 * Adds custom classes to menu items.
 *
 * @param array $classes Classes for the ui element.
 * @return array
 */
function winsider_add_menuclass( $ulclass ) {
   return preg_replace('/<a /', '<a class="p2 inline-block m0 hover-bg-black white text-decoration-none" ', $ulclass);
}
add_filter( 'wp_nav_menu' , 'winsider_add_menuclass' );