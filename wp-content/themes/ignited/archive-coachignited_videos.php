<?php get_header() ?>

<section id="videos" class="page">
	<div class="content container">
		<div class="row">
			<div class="col-12 mb-4">
				<header class="hero">
					<h1 class="title">Reviews</h1>
					<hr class="seperator-short" />
				</header>
			</div>

			<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
				<?php get_template_part('loop_videos'); ?>
			<?php endwhile; endif; ?>
		</div>

	</div>
</section>

<?php get_footer() ?>