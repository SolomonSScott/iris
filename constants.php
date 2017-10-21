<?php
/**
 * Theme constants.
 *
 * @package Iris
 */
/**
 * Useful global constants for Yeti theme.
 */
function define_iris_constants() {
	if ( ! defined( 'IRIS_VERSION' ) ) {
		define( 'IRIS_VERSION', '1.0.15' );
	}
	if ( ! defined( 'IRIS_THEME_PATH' ) ) {
		define( 'IRIS_THEME_PATH', get_template_directory() . '/' );
	}
	if ( ! defined( 'IRIS_THEME_URL' ) ) {
		define( 'IRIS_THEME_URL', get_template_directory_uri() );
	}
}
add_action( 'init', 'define_iris_constants' );
