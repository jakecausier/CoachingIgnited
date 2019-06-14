<div class="entry-meta mb-2">
	<span class="author vcard">by <?php the_author_posts_link(); ?></span>
	<span class="meta-sep mx-2"> | </span>
	<span class="entry-date"><?php the_time( get_option( 'date_format' ) ); ?></span>
	<span class="meta-sep mx-2"> | </span>
	<span class="cat-links"><?php the_category( ', ' ); ?></span>
</div>