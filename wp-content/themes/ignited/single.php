<?php get_header(); ?>

<section id="posts">
	<div class="content container">
		<div class="row">

			<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
				<div class="col-12">
					<header class="hero">
						<h1 class="title"><?php the_title(); ?></h1>
						<hr class="seperator-short" />
						<h3><?php get_template_part( 'entry', 'meta' ); ?></h3>
					</header>
				</div>

				<div class="col-12">
					<?php get_template_part( 'entry' ); ?>
				</div>

			<?php endwhile; endif; ?>
		</div>
	</div>
</section>

<?php get_footer(); ?>