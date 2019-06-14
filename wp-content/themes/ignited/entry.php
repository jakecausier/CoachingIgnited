<article id="post-<?php the_ID(); ?>" <?php post_class('masonry-item'); ?>>

	<?php if (!is_singular() || is_front_page()) { ?>
		<header>
			<h2 class="entry-title">
				<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>" rel="bookmark"><?php the_title(); ?></a>
			</h2>
			<?php get_template_part( 'entry', 'meta' ); ?>
		</header>
	<?php } ?>

	<?php get_template_part( 'entry', ( is_front_page() || is_home() || is_front_page() && is_home() || is_archive() || is_search() ? 'summary' : 'content' ) ); ?>
	<?php if ( is_singular() && !is_front_page() ) { get_template_part( 'entry-footer' ); } ?>
</article>