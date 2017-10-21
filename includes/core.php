<?php
/**
 * Core theme functions
 *
 * @package Iris
 */

/**
 * Enqueue Iris Styles
 */
function iris_styles() {
	wp_register_style( 'iris-css', IRIS_THEME_URL . "/dist/iris.min.css", null, IRIS_VERSION );

	wp_enqueue_style( 'iris-css' );
}
add_action( 'wp_enqueue_scripts', 'iris_styles' );

/**
 * Enqueue Iris Scripts
 */
function iris_scripts() {
	wp_register_script( 'iris-js', IRIS_THEME_URL . "/dist/iris.min.js", [], IRIS_VERSION, true );

	wp_enqueue_script( 'iris-js' );
}
add_action( 'wp_enqueue_scripts', 'iris_scripts' );

/**
 * Register Iris menus
 */
function register_iris_menus() {
	register_nav_menus( [
		'primary' => 'Primary Menu'
	] );
}
add_action( 'init', 'register_iris_menus' );
