
<?php get_header() ?>

	<?php
		$hero_background = get_post_meta(get_the_ID(), 'cignited_front_hero_background_id', true) ?? '';
		$hero_colour = get_post_meta(get_the_ID(), 'cignited_front_hero_colour', true) ?? 'black';
		$hero_link = get_post_meta(get_the_ID(), 'cignited_front_hero_btn_link', true) ?? '';
	?>

	<section id="hero" style="background-image: url('<?php echo ($hero_background) ? wp_get_attachment_image_src($hero_background, 'large')[0] : ''; ?>">
		<header class="content container" style="color: <?php echo $hero_colour ?>">

			<h1 class="title"><?php echo get_post_meta(get_the_ID(), 'cignited_front_hero_title', true) ?></h1>
			<hr class="seperator-short seperator-left" style="border-color: <?php echo $hero_colour ?>">
			<h2 class="subtitle"><?php echo get_post_meta(get_the_ID(), 'cignited_front_hero_subtitle', true) ?></h2>

			<?php if(!empty($hero_link)) { ?>
				<a href="<?php echo $hero_link ?>" class="btn btn-gradient-primary btn-lg">Start Here <i class="ml-2 fas fa-chevron-circle-right"></i></a>
			<?php } ?>

		</header>
	</section>

	<?php if (!empty(get_post_meta(get_the_ID(), 'cignited_front_spinner_logos', true))) { ?>
		<section id="spinner">
			<div class="container">
				<figure id="spinner-element">
					<?php foreach (get_post_meta(get_the_ID(), 'cignited_front_spinner_logos', true) as $key => $item) { ?>
						<a class="cloud9-item" href="">
							<img src="<?php echo wp_get_attachment_image_src($key, 'medium')[0] ?>">
						</a>
					<?php } ?>
				</figure>
			</div>
		</section>
	<?php } ?>

	<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

	<section id="content">
		<div class="content container">

			<hr />

			<div class="content-padded">
				<?php the_content() ?>
			</div>

		</div>
	</section>

	<?php endwhile; endif; ?>

	<?php 
		if ( class_exists( 'CoachingIgnited' ) ) {
			$videos = CoachingIgnited::get_videos(8);
			if (!empty($videos)) {
	?>
				<section id="videos">
					<div class="content">
						<div class="container">
							<hr />
						</div>

						<div class="videos-padding row mb-max">
							<?php
								foreach ($videos as $key => $video) {
									$video_id = get_post_meta($video->ID, 'cignited_videos_videometa_embed_url', true) ?? '';
									$trainer = get_post_meta($video->ID, 'cignited_videos_trainer_name', true) ?? '';
									$position = get_post_meta($video->ID, 'cignited_videos_trainer_position', true) ?? '';
									$location = get_post_meta($video->ID, 'cignited_videos_trainer_location', true) ?? '';
							?>
								<div class="video-item col-12 col-sm-6 col-lg-4 col-xl-3 mb-4">
									<button role="button" class="thumbnail embed-responsive embed-responsive-16by9 mb-4" data-id="<?php echo $video->ID ?>" title="View <?php echo $trainer ?>'s video" aria-label="View <?php echo $trainer ?>'s video">
										<i class="fas fa-play-circle"></i>
										<img class="embed-responsive-item" src="<?php echo CoachingIgnited::get_youtube_thumb($video_id) ?>">
									</button>
									<strong class="name"><?php echo $trainer ?></strong>
									<span class="location"><?php echo $location ?></span>
								</div>
							<?php
								}
							?>
							<div class="col-12 text-center">
								<a href="<?php echo get_post_type_archive_link('coachignited_videos') ?>" class="btn btn-gradient-primary">View all videos</a>
							</div>
						</div>
					</div>
				</section>
			<?php
			}
		}
	?>

	<section id="posts">
		<div class="content container">
			<div class="row">

				<div class="col-12">
					<hr />
				</div>

				<div class="col-12 mb-max">
					<a href="<?php echo $hero_link ?>" class="btn btn-block btn-gradient-primary" aria-label="Start building your personal training client base" title="Start building your personal training client base">Start building your personal training client base <i class="ml-2 fas fa-chevron-circle-right"></i></a>
				</div>

				<div class="col-12 masonry two-columns">
					<?php foreach (CoachingIgnited::get_recent_posts(4) as $key => $post) { ?>
						<?php get_template_part( 'entry' ); ?>
					<?php } ?>
				</div>

				<div class="col-12 text-center mb-max">
					<a href="<?php echo get_permalink(get_option('page_for_posts')) ?>" class="btn btn-gradient-primary">Read all posts</a>
				</div>

				<div class="col-12">
					<hr />
				</div>

				<div class="col-12 mb-max">
					<a href="<?php echo $hero_link ?>" class="btn btn-block btn-gradient-primary" aria-label="Start building your personal training client base" title="Start building your personal training client base"><span>Start building your personal training client base</span> <i class="fas fa-chevron-circle-right"></i></a>
				</div>

		</div>
	</section>
	

<?php get_footer() ?>