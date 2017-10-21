<?php
/**
 * The header.
 *
 * @package Iris
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>

<nav class="navbar navbar-expand-lg navbar-light bg-light">
	<a class="navbar-brand" href="<?php echo site_url(); ?>" aria-label="<?php echo bloginfo( 'name' ); ?>" title="<?php echo bloginfo( 'name' ); ?>">
		<?php echo bloginfo( 'name' ); ?>
	</a>
	<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#primary-nav" aria-controls="primary-nav" aria-expanded="false" aria-label="Toggle navigation">
		<span class="navbar-toggler-icon"></span>
	</button>
	<?php
		if ( has_nav_menu( 'primary' ) ) {
			wp_nav_menu( [
				'theme_location'  => 'primary',
				'menu_class'      => 'navbar-nav',
				'container'       => 'div',
				'container_class' => 'collapse navbar-collapse justify-content-end',
				'container_id'    => 'primary-nav',
				'walker'          => new Iris_Bootstrap_Walker()
			] );
		}
	?>
</nav>
