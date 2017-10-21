<?php
/**
 * Post/Page content functionality
 *
 * @package Iris
 */

namespace Iris;


/**
 * Add .img-fluid to uploaded images
 *
 * @param $class
 * @param $id
 * @param $align
 * @param $size
 *
 * @return string
 */
function add_image_classes( $class, $id, $align, $size) {
	$class .= ' img-fluid';
	return $class;
}
add_filter( 'get_image_tag_class', __NAMESPACE__ . '\\add_image_classes', 10, 4 );
