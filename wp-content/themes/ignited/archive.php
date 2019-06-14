<?php get_header(); ?>

<section id="posts">
	<div class="content container">
		<div class="row">

			<div class="col-12">
				<header class="hero">
					<h1 class="title"><?php single_term_title(); ?></h1>
					<hr class="seperator-short" />
					<h2 class="subtitle"><?php if ( '' != the_archive_description() ) { echo esc_html( the_archive_description() ); } ?></h2>
				</header>
			</div>

			<div class="col-12 masonry two-columns">
				<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
					<?php get_template_part( 'entry' ); ?>
				<?php endwhile; endif; ?>
			</div>
		</div>
	</div>
</section>

<?php get_footer(); ?>