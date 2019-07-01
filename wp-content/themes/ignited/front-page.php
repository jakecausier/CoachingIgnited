
<?php get_header() ?>

	<?php
		$hero_background = get_post_meta(get_the_ID(), 'cignited_front_hero_background_id', true) ?? '';
		$hero_colour = get_post_meta(get_the_ID(), 'cignited_front_hero_colour', true) ?? 'black';
		$hero_link = get_post_meta(get_the_ID(), 'cignited_front_hero_btn_link', true) ?? '';
	?>

	<section id="hero" style="background-image: url('<?php echo ($hero_background) ? wp_get_attachment_image_src($hero_background, 'large')[0] : ''; ?>">
		<header class="content container" style="color: <?php echo $hero_colour ?>">

			<h1 class="title"><?php echo get_post_meta(get_the_ID(), 'cignited_front_hero_title', true) ?></h1>
			<hr class="seperator-short" style="border-color: <?php echo $hero_colour ?>">
			<h2 class="subtitle"><?php echo get_post_meta(get_the_ID(), 'cignited_front_hero_subtitle', true) ?></h2>

			<?php if(!empty($hero_link)) { ?>
				<a href="<?php echo $hero_link ?>" class="btn btn-gradient-primary btn-lg">Book a call <i class="ml-2 fas fa-chevron-circle-right"></i></a>
			<?php } ?>

		</header>
	</section>

	<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

	<section id="content">
		<div class="content container">
			<div class="row mt-5">

				<div class="col-12 col-md-6 order-last order-md-first">
					<div class="mb-max">
						<?php the_content() ?>
					</div>
				</div>

				<div class="col-12 col-md-5 offset-md-1 order-first order-md-last">
					<img src="<?php echo get_template_directory_uri() . '/build/img/undraw_teaching.svg'; ?>" class="img-fluid mb-max" alt="Illustration of a teacher">
				</div>

			</div>

			<?php if(!empty($hero_link)) { ?>
				<div class="text-center">
					<a href="<?php echo $hero_link ?>" class="btn btn-gradient-primary btn-lg">Book a call <i class="ml-2 fas fa-chevron-circle-right"></i></a>
				</div>
			<?php } ?>

		</div>
	</section>

	<?php endwhile; endif; ?>

	<?php 
		if ( class_exists( 'CoachingIgnited' ) ) {
			$videos = CoachingIgnited::get_videos(3, 'rand');
			if (!empty($videos)) {
	?>
				<section id="videos">
					<div class="content">
						<div class="container mb-max">
							<hr />

							<div class="content-padded">
								<?php echo wpautop(get_post_meta(get_the_ID(), 'cignited_front_videos_content_before', true)) ?>
							</div>
						</div>

						<div class="container mb-max">
							<div class="row">
								<?php
									foreach ($videos as $key => $video) {
										$video_id = get_post_meta($video->ID, 'cignited_videos_videometa_embed_url', true) ?? '';
										$trainer = get_post_meta($video->ID, 'cignited_videos_trainer_name', true) ?? '';
										$position = get_post_meta($video->ID, 'cignited_videos_trainer_position', true) ?? '';
										$location = get_post_meta($video->ID, 'cignited_videos_trainer_location', true) ?? '';
										$rating = get_post_meta($video->ID, 'cignited_videos_trainer_rating', true) ?? NULL;
								?>
									<div class="col-12 col-md-4 mb-4">
										<div class="video-item">
											<button role="button" class="thumbnail embed-responsive embed-responsive-16by9" data-id="<?php echo $video->ID ?>" title="View <?php echo $trainer ?>'s video" aria-label="View <?php echo $trainer ?>'s video">
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
								<div class="text-center">
									<a href="<?php echo $hero_link ?>" class="btn btn-gradient-primary btn-xl">Book a call <i class="ml-2 fas fa-chevron-circle-right"></i></a>
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