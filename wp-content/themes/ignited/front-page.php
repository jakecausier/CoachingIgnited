
<?php get_header() ?>

	<?php
		$hero_background = get_post_meta(get_the_ID(), 'cignited_front_hero_background_id', true) ?? '';
		$hero_colour = get_post_meta(get_the_ID(), 'cignited_front_hero_colour', true) ?? 'black';
		$hero_link = get_post_meta(get_the_ID(), 'cignited_front_hero_btn_link', true) ?? '';
		$hero_label = get_post_meta(get_the_ID(), 'cignited_front_hero_btn_label', true) ?? '';
	?>

	<section id="hero" style="background-image: url('<?php echo ($hero_background) ? wp_get_attachment_image_src($hero_background, 'large')[0] : ''; ?>">
		<header class="content container" style="color: <?php echo $hero_colour ?>">

			<h1 class="title"><?php echo get_post_meta(get_the_ID(), 'cignited_front_hero_title', true) ?></h1>
			<hr class="seperator-short" style="border-color: <?php echo $hero_colour ?>">
			<h2 class="subtitle"><?php echo get_post_meta(get_the_ID(), 'cignited_front_hero_subtitle', true) ?></h2>

			<?php if(!empty($hero_link)) { ?>
				<a href="<?php echo $hero_link ?>" class="btn btn-gradient-primary btn-lg"><?php echo $hero_label ?> <i class="ml-2 fas fa-chevron-circle-right"></i></a>
			<?php } ?>

		</header>
	</section>

	<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

	<section id="content">
		<div class="content container">
			<div class="row mt-5">

				<div class="col-12 col-lg-6 mb-5 mb-lg-0 content-container-left">
					<div class="font-larger font-flex-bottom">
						<?php the_content() ?>
					</div>
				</div>

				<div class="col-12 col-lg-5 offset-lg-1 content-container-right">
					<img src="<?php echo get_template_directory_uri() . '/build/img/undraw_teaching.svg'; ?>" class="img-fluid mb-4" alt="Illustration of a teacher">

					<?php if(!empty($hero_link)) { ?>
						<div class="text-center">
							<a href="<?php echo $hero_link ?>" class="btn btn-gradient-primary btn-lg btn-block"><?php echo $hero_label ?> <i class="ml-2 fas fa-chevron-circle-right"></i></a>
						</div>
					<?php } ?>
				</div>
			</div>
		</div>
	</section>

	<?php endwhile; endif; ?>

	<?php 
		if ( class_exists( 'CoachingIgnited' ) ) {

			$videos_order = get_post_meta(get_the_ID(), 'cignited_front_videos_order', true);

			if (!empty($videos_order)) {
				$videos = $videos_order;
			} else {
				$videos = CoachingIgnited::get_videos(3, 'rand');
			}

			if (!empty($videos)) {
	?>
				<section id="videos">
					<div class="content">
						<div class="container mb-4">
							<hr />

							<div class="text-center">
								<h3><?php echo get_post_meta(get_the_ID(), 'cignited_front_videos_content_title', true); ?></h3>
							</div>
							<?php echo wpautop(get_post_meta(get_the_ID(), 'cignited_front_videos_content_before', true)) ?>
						</div>

						<div class="container">
							<div class="row">
								<?php
									foreach ($videos as $key => $video) {
										$video_id = get_post_meta($video->ID ?? $video, 'cignited_videos_videometa_embed_url', true) ?? '';
										$trainer = get_post_meta($video->ID ?? $video, 'cignited_videos_trainer_name', true) ?? '';
										$position = get_post_meta($video->ID ?? $video, 'cignited_videos_trainer_position', true) ?? '';
										$location = get_post_meta($video->ID ?? $video, 'cignited_videos_trainer_location', true) ?? '';
										$rating = get_post_meta($video->ID ?? $video, 'cignited_videos_trainer_rating', true) ?? NULL;
								?>
									<div class="col-12 col-md-4 mb-4">
										<div class="video-item">
											<button role="button" class="thumbnail embed-responsive embed-responsive-16by9" data-id="<?php echo $video->ID ?? $video ?>" title="View <?php echo $trainer ?>'s video" aria-label="View <?php echo $trainer ?>'s video">
												<i class="fas fa-play-circle"></i>
												<img class="embed-responsive-item" src="<?php echo CoachingIgnited::get_youtube_thumb($video_id) ?>">
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
								<?php
									}
								?>
							</div>
						</div>

						<div class="container mb-max">
							<div class="content-padded mb-5">
								<?php echo wpautop(get_post_meta(get_the_ID(), 'cignited_front_videos_content_after', true)) ?>
							</div>

							<div class="text-center">
								<a href="<?php echo get_post_type_archive_link('coachignited_videos') ?>" class="btn btn-gradient-primary">View all videos</a>
							</div>
						</div>

						<?php if(!empty($hero_link)) { ?>
							<div class="container mb-max">
								<hr />

								<div class="row">
									<div class="col-12 col-lg-5">
										<img src="<?php echo get_template_directory_uri() . '/build/img/undraw_progress.svg'; ?>" class="img-fluid mb-4" alt="Illustration of progression">

									</div>

									<div class="col-12 col-lg-6 offset-lg-1">
										<div class="font-flex-middle">
											<a href="<?php echo $hero_link ?>" class="btn btn-gradient-primary btn-lg btn-block"><?php echo $hero_label ?> <i class="ml-2 fas fa-chevron-circle-right"></i></a>
										</div>
									</div>
								</div>

							</div>
						<?php } ?>
					</div>
				</section>
			<?php
			}
		}
	?>
	

<?php get_footer() ?>