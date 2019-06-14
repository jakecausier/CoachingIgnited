<?php get_header() ?>


<section id="videos">
	<div class="content container">
		<div class="row">
			<div class="col-12 text-center mb-4">
				<h1>All Videos</h1>
			</div>

			<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
				<?php
					$video_id = get_post_meta($post->ID, 'cignited_videos_videometa_embed_url', true) ?? '';
					$trainer = get_post_meta($post->ID, 'cignited_videos_trainer_name', true) ?? '';
					$position = get_post_meta($post->ID, 'cignited_videos_trainer_position', true) ?? '';
					$location = get_post_meta($post->ID, 'cignited_videos_trainer_location', true) ?? '';
				?>

				<div class="video-item col-12 col-sm-6 col-lg-4 col-xl-3 mb-4">
					<button role="button" class="thumbnail embed-responsive embed-responsive-16by9 mb-4" data-id="<?php echo $post->ID ?>" title="View <?php echo $trainer ?>'s video" aria-label="View <?php echo $trainer ?>'s video">
						<i class="fas fa-play-circle"></i>
						<img class="embed-responsive-item" src="<?php echo CoachingIgnited::get_youtube_thumb($video_id) ?>">
					</button>
					<strong class="name"><?php echo $trainer ?></strong>
					<span class="location"><?php echo $location ?></span>
				</div>
			<?php endwhile; endif; ?>
		</div>
	</div>
</section>


<?php get_footer() ?>