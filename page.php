<?php
/**
 * The generic page template file.
 *
 * @package Iris
 */
get_header(); ?>

<?php if ( have_posts() ) : ?>
	<?php while ( have_posts() ) : the_post(); ?>
		<div class="hero is-primary">
			<div class="hero-body">
				<div class="container">
					<h1 class="title"><?php the_title(); ?></h1>
				</div>
			</div>
		</div>

		<div class="container">
			<div class="content">
				<?php the_content(); ?>
			</div>
		</div>
	<?php endwhile; ?>
<?php endif; ?>

<?php get_footer(); ?>

