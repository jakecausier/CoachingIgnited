<?php
	$video_id = get_post_meta($post->ID, 'cignited_videos_videometa_embed_url', true) ?? '';
	$trainer = get_post_meta($post->ID, 'cignited_videos_trainer_name', true) ?? '';
	$position = get_post_meta($post->ID, 'cignited_videos_trainer_position', true) ?? '';
	$location = get_post_meta($post->ID, 'cignited_videos_trainer_location', true) ?? '';
	$rating = get_post_meta($post->ID, 'cignited_videos_trainer_rating', true) ?? NULL;
?>
<div class="col-12 col-sm-6 col-lg-4 col-xl-3 mb-4">
	<div class="video-item">
		<button role="button" class="thumbnail embed-responsive embed-responsive-16by9" data-id="<?php echo $post->ID ?>" title="View <?php echo $trainer ?>'s video" aria-label="View <?php echo $trainer ?>'s video">
			<i class="fas fa-play-circle"></i>
			<img class="embed-responsive-item lazy" src="<?php echo CoachingIgnited::get_youtube_thumb($video_id) ?>">
		</button>
		<div class="meta">
			<strong class="name"><?php echo $trainer ?></strong>
			<span class="location"><?php echo $location ?></span>
			<?php if (!empty($rating)) { ?>
				<div class="rating">
					<span class="top">
						<?php for ($i = 0; $i < $rating; $i++) { ?>
							<i class="fas fa-star fa-fw"></i>
						<?php } ?>
					</span>
					<span class="bottom">
						<i class="fas fa-star fa-fw"></i>
						<i class="fas fa-star fa-fw"></i>
						<i class="fas fa-star fa-fw"></i>
						<i class="fas fa-star fa-fw"></i>
						<i class="fas fa-star fa-fw"></i>
					</span>
				</div>
			<?php } ?>
		</div>
	</div>
</div>
