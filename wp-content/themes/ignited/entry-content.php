<div class="entry-content">

	<?php if (has_post_thumbnail()) { ?>
		<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
			<?php the_post_thumbnail('original', array('class' => 'img-fluid mb-max')); ?>
		</a>
	<?php } ?>

	<?php if (has_post_format('audio') && !empty(get_post_meta(get_the_ID(), 'cignited_post_podcast_embed', true))) { ?>
		<?php get_template_part( 'entry', 'podcast' ); ?>
	<?php } ?>

	<div class="mb-max">
		<?php the_content(); ?>
	</div>

	<div class="entry-links"><?php wp_link_pages(); ?></div>

</div>