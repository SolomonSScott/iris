<?php
/**
 * Navigation functionality
 *
 * @package Iris
 */

class Iris_Bulma_Walker extends Walker_Nav_Menu {

	/**
	 * Start Level.
	 *
	 * @see Walker::start_lvl()
	 * @since 3.0.0
	 *
	 * @access public
	 * @param mixed $output Passed by reference. Used to append additional content.
	 * @param int   $depth (default: 0) Depth of page. Used for padding.
	 * @param array $args (default: array()) Arguments.
	 * @return void
	 */
	public function start_lvl( &$output, $depth = 0, $args = array() ) {
		$indent = str_repeat( "\t", $depth );
		$output .= "\n$indent<ul role=\"menu\" class=\"navbar-dropdown\" >\n";
	}
	/**
	 * Start El.
	 *
	 * @see Walker::start_el()
	 * @since 3.0.0
	 *
	 * @access public
	 * @param mixed $output Passed by reference. Used to append additional content.
	 * @param mixed $item Menu item data object.
	 * @param int   $depth (default: 0) Depth of menu item. Used for padding.
	 * @param array $args (default: array()) Arguments.
	 * @param int   $id (default: 0) Menu item ID.
	 * @return void
	 */
	public function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {
		$indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';

		/**
		 * Dividers, Headers or Disabled
		 * =============================
		 * Determine whether the item is a Divider, Header, Disabled or regular
		 * menu item. To prevent errors we use the strcasecmp() function to so a
		 * comparison that is not case sensitive. The strcasecmp() function returns
		 * a 0 if the strings are equal.
		 */
		if ( 0 === strcasecmp( $item->attr_title, 'divider' ) && 1 === $depth ) {
			$output .= $indent . '<li role="presentation" class="divider">';
		} elseif ( 0 === strcasecmp( $item->title, 'divider' ) && 1 === $depth ) {
			$output .= $indent . '<li role="presentation" class="divider">';
		} elseif ( 0 === strcasecmp( $item->attr_title, 'dropdown-header' ) && 1 === $depth ) {
			$output .= $indent . '<li role="presentation" class="dropdown-header">' . esc_attr( $item->title );
		} elseif ( 0 === strcasecmp( $item->attr_title, 'disabled' ) ) {
			$output .= $indent . '<li role="presentation" class="disabled"><a href="#">' . esc_attr( $item->title ) . '</a>';
		} else {
			$value = '';
			$class_names = $value;
			$classes = empty( $item->classes ) ? array() : (array) $item->classes;
			$classes[] = 'navbar-item menu-item-' . $item->ID;

			$class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item, $args ) );
			if ( $args->has_children ) {
				$class_names .= ' has-dropdown is-hoverable';
			}
			if ( in_array( 'current-menu-item', $classes, true ) ) {
				$class_names .= ' active';
			}

			$class_names = $class_names ? ' class="' . esc_attr( $class_names ) . '"' : '';

			$id = apply_filters( 'nav_menu_item_id', 'menu-item-' . $item->ID, $item, $args );
			$id = $id ? ' id="' . esc_attr( $id ) . '"' : '';

			$output .= $indent . '<li ' . $id . $value . $class_names . '>';

			$atts = array();

			if ( empty( $item->attr_title ) ) {
				$atts['title']  = ! empty( $item->title )   ? strip_tags( $item->title ) : '';
			} else {
				$atts['title'] = $item->attr_title;
			}

			$atts['target'] = ! empty( $item->target ) ? $item->target : '';
			$atts['rel']    = ! empty( $item->xfn )    ? $item->xfn    : '';
			$atts['class'] = 'nav-link';
			$atts['href'] = ! empty( $item->url ) ? $item->url : '';

			// If item has_children add atts to a.
			if ( $args->has_children && 0 === $depth ) {
				$atts['data-toggle']    = 'dropdown';
				$atts['class']          = $atts['class'] . ' navbar-link';
				$atts['aria-haspopup']  = 'true';
			}

			$atts = apply_filters( 'nav_menu_link_attributes', $atts, $item, $args );
			$attributes = '';

			foreach ( $atts as $attr => $value ) {
				if ( ! empty( $value ) ) {
					$value = ( 'href' === $attr ) ? esc_url( $value ) : esc_attr( $value );
					$attributes .= ' ' . $attr . '="' . $value . '"';
				}
			}

			$item_output = $args->before;

			$item_output .= '<a' . $attributes . '>';

			$item_output .= $args->link_before . apply_filters( 'the_title', $item->title, $item->ID ) . $args->link_after;
			$item_output .= $args->after;
			$item_output .= '</a>';
			$output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
		} // End if().
	}

	/**
	 * Traverse elements to create list from elements.
	 *
	 * Display one element if the element doesn't have any children otherwise,
	 * display the element and its children. Will only traverse up to the max
	 * depth and no ignore elements under that depth.
	 *
	 * This method shouldn't be called directly, use the walk() method instead.
	 *
	 * @see Walker::start_el()
	 * @since 2.5.0
	 *
	 * @access public
	 * @param mixed $element Data object.
	 * @param mixed $children_elements List of elements to continue traversing.
	 * @param mixed $max_depth Max depth to traverse.
	 * @param mixed $depth Depth of current element.
	 * @param mixed $args Arguments.
	 * @param mixed $output Passed by reference. Used to append additional content.
	 * @return null Null on failure with no changes to parameters.
	 */
	public function display_element( $element, &$children_elements, $max_depth, $depth, $args, &$output ) {
		if ( ! $element ) {
			return; }
		$id_field = $this->db_fields['id'];
		// Display this element.
		if ( is_object( $args[0] ) ) {
			$args[0]->has_children = ! empty( $children_elements[ $element->$id_field ] ); }
		parent::display_element( $element, $children_elements, $max_depth, $depth, $args, $output );
	}
	/**
	 * Menu Fallback
	 * =============
	 * If this function is assigned to the wp_nav_menu's fallback_cb variable
	 * and a menu has not been assigned to the theme location in the WordPress
	 * menu manager the function with display nothing to a non-logged in user,
	 * and will add a link to the WordPress menu manager if logged in as an admin.
	 *
	 * @param array $args passed from the wp_nav_menu function.
	 */
	public static function fallback( $args ) {
		if ( current_user_can( 'edit_theme_options' ) ) {
			/* Get Arguments. */
			$container = $args['container'];
			$container_id = $args['container_id'];
			$container_class = $args['container_class'];
			$menu_class = $args['menu_class'];
			$menu_id = $args['menu_id'];
			if ( $container ) {
				echo '<' . esc_attr( $container );
				if ( $container_id ) {
					echo ' id="' . esc_attr( $container_id ) . '"';
				}
				if ( $container_class ) {
					echo ' class="' . sanitize_html_class( $container_class ) . '"'; }
				echo '>';
			}
			echo '<ul';
			if ( $menu_id ) {
				echo ' id="' . esc_attr( $menu_id ) . '"'; }
			if ( $menu_class ) {
				echo ' class="' . esc_attr( $menu_class ) . '"'; }
			echo '>';
			echo '<li><a href="' . esc_url( admin_url( 'nav-menus.php' ) ) . '" title="">' . esc_attr( 'Add a menu', '' ) . '</a></li>';
			echo '</ul>';
			if ( $container ) {
				echo '</' . esc_attr( $container ) . '>'; }
		}
	}
}
