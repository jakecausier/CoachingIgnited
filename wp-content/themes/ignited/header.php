<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>

	<meta charset="<?php bloginfo('charset'); ?>" />
	<meta name="viewport" content="width=device-width" />
	<link rel="preconnect" href="https://fonts.gstatic.com/" crossorigin>
	<link rel="stylesheet" type="text/css" href="<?php echo get_stylesheet_uri(); ?>" />

	<?php wp_head(); ?>

</head>

<body <?php body_class(); ?>>

	<nav id="primary-navigation" class="navbar navbar-expand-xl navbar-light fixed-top bg-white scrolling">
		<div class="container">
			<a class="navbar-brand" href="<?php echo home_url(); ?>">
				<img src="<?php echo esc_url(wp_get_attachment_image_src(get_theme_mod('custom_logo'), 'medium' )[0]) ?>" alt="<?php bloginfo('name'); ?>">
			</a>

		  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#primary-navigation-dropdown" aria-controls="primary-navigation-dropdown" aria-expanded="false" aria-label="Toggle navigation">
		    <span class="navbar-toggler-icon"></span>
		  </button>

		  <div class="collapse navbar-collapse" id="primary-navigation-dropdown">
		  	<?php
	        wp_nav_menu([
	          'menu'            => 'primary-nav',
	          'theme_location'  => 'primary-nav',
	          'container'       => 'ul',
	          'container_id'    => false,
	          'container_class' => '',
	          'menu_id'         => false,
	          'menu_class'      => 'navbar-nav ml-auto',
	          'depth'           => 4,
	          'fallback_cb'     => 'bs4navwalker::fallback',
	          'walker'          => new bs4navwalker()
	        ]);
	      ?>
		  </div>
		</div>
	</nav>