<?php
/**
 * The generic page template file.
 *
 * @package Iris
 */
get_header(); ?>

<?php if ( have_posts() ) : ?>
	<?php while ( have_posts() ) : the_post(); ?>
		<div class="jumbotron jumbotron-fluid">
			<div class="container">
				<h1 class="display-3"><?php the_title(); ?></h1>
			</div>
		</div>

		<div class="container">
			<?php the_content(); ?>
		</div>
	<?php endwhile; ?>
<?php endif; ?>

<?php get_footer(); ?>

