<?php get_header(); ?>
<?php $page_id = get_option('page_for_posts'); ?>

<section id="posts">
	<div class="content container">
		<div class="row">

			<div class="col-12">
				<header class="hero">
					<h1 class="title"><?php echo get_post_meta($page_id, 'cignited_blog_hero_title', true); ?></h1>
					<hr class="seperator-short" />
					<h2 class="subtitle"><?php echo get_post_meta($page_id, 'cignited_blog_hero_subtitle', true); ?></h2>
				</header>
			</div>

			<div class="col-12">
				<hr/>
			</div>

			<div class="col-12 masonry two-columns">
				<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
					<?php get_template_part( 'entry' ); ?>
				<?php endwhile; endif; ?>
			</div>

			<div class="col-12">
				<nav id="pagination" aria-label="Page Navigation">
					<?php echo paginate_links(array('prev_text' => "<i class='fas fa-chevron-left fa-fw'></i>", 'next_text' => "<i class='fas fa-chevron-right fa-fw'></i>", 'type' => 'list')); ?>
				</nav>
			</div>
		</div>
	</div>
</section>

<?php get_footer(); ?>