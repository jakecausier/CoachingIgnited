<?php /* Template Name: About Page */ ?>

<?php get_header(); ?>

<section id="page">
	<div class="content container">
		<div class="row">

			<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
				<div class="col-12">
					<header class="hero">
						<h1 class="title"><?php the_title(); ?></h1>
						<hr class="seperator-short" />
					</header>
				</div>

				<?php if (has_post_thumbnail()) { ?>
					<div class="col-12 mb-max">
						<?php the_post_thumbnail('large'); ?>
					</div>
				<?php } ?>

				<div class="col-12 mb-max">
					<?php the_content(); ?>
				</div>

			<?php endwhile; endif; ?>
		</div>
	</div>
</section>

<?php if (!empty(get_post_meta(get_the_ID(), 'cignited_about_spinner_logos', true))) { ?>
	<section id="spinner">
		<div class="container">

			<hr>

			<figure id="spinner-element">
				<?php foreach (get_post_meta(get_the_ID(), 'cignited_about_spinner_logos', true) as $key => $item) { ?>
					<a class="cloud9-item" href="">
						<img src="<?php echo wp_get_attachment_image_src($key, 'medium')[0] ?>">
					</a>
				<?php } ?>
			</figure>
			
		</div>
	</section>
<?php } ?>

<?php get_footer(); ?>