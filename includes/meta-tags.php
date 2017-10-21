<?php
/**
 * Meta Tag functionality
 *
 * @package Iris
 */

namespace Iris;

/**
 * Set up defaults for meta tags
 *
 * @return array
 */
function header_defaults() {
	$defaults = [
		'site_title' => get_bloginfo( 'name' ),
		'site_description' => get_bloginfo( 'description' ),
		'ogtype' => 'website',
		'canonical_url'  => get_site_url(),
	];

	return $defaults;
}

/**
 * Build meta tags based on page context
 *
 * @param $context
 *
 * @return array
 */
function build_header_data( $context ) {
	$func =  __NAMESPACE__ . "\\build_{$context}_header_data";

	$header_data = array_merge( \Iris\header_defaults(), $func() );

	return $header_data;
}

/**
 * Build Page meta information
 *
 * @return array
 */
function build_page_header_data() {
	$post_id = get_the_ID();

	return [
		'title' => get_the_title( $post_id ),
		'description' => get_the_excerpt( $post_id ),
	];
}

/**
 * Build Post meta information
 *
 * @return array
 */
function build_post_header_data() {
	$post_id = get_the_ID();

	return [
		'title' => get_the_title( $post_id ),
		'description' => get_the_excerpt( $post_id ),
	];
}

/**
 * Build 404 Page meta information
 *
 * @return array
 */
function build_404_header_data() {
	return [
		'title' => 'Page Not Found',
		'description' => '',
	];
}

/**
 * Build Search Page meta information
 *
 * @return array
 */
function build_search_header_data() {
	return [
		'title' => 'Site Search Results',
		'description' => '',
	];
}


/**
 * Build Front Page meta information
 *
 * @return array
 */
function build_front_header_data() {
	return [
		'title' => get_bloginfo( 'name' ),
		'description' => get_bloginfo( 'description' ),
	];
}

/**
 * Get current url context
 *
 * @return bool|false|string
 */
function get_context() {
	if ( is_404() ) {
		return '404';
	}
	if ( is_search() ) {
		return 'search';
	}
	if ( is_front_page() ) {
		return 'front';
	}
	if ( is_singular() ) {
		$post_type = get_post_type();
		return $post_type;
	}
	return false;
}

/**
 * Render title tag and description
 */
function render_meta_tags() {
	$context = \Iris\get_context();

	$header_data = \Iris\build_header_data( $context );

	printf( '<title>%s</title>' . "\n", esc_html( $header_data[ 'title' ] ) );

	printf(
		'<meta name="description" content="%s" />' . "\n",
		esc_attr( wp_strip_all_tags( $header_data[ 'description' ] ) )
	);
}
add_action( 'wp_head', __NAMESPACE__ . '\\render_meta_tags', 20 );
