<div class="entry-summary">
	
	<?php if ( has_post_thumbnail() ) { ?>
		<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
			<?php the_post_thumbnail('large', array('class' => 'img-fluid mb-2')); ?>
		</a>
	<?php } ?>

	<?php the_excerpt(); ?>

	<?php if ( is_search() ) { ?>
		<div class="entry-links"><?php wp_link_pages(); ?></div>
	<?php } ?>

</div>