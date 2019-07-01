<?php get_header() ?>

<section id="videos">
	<div class="content container">
		<div class="row">
			<div class="col-12 text-center mb-4">
				<h1>All Videos</h1>
			</div>
		</div>

		<div class="row">
			<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
				<?php get_template_part('loop_videos'); ?>
			<?php endwhile; endif; ?>
		</div>

	</div>
</section>

<?php get_footer() ?>