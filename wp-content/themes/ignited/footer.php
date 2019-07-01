
	<footer id="footer" class="bg-dark py-4">
		<div class="container">
			<div class="text-light">
				&copy; <?php echo esc_html( date_i18n( __( 'Y', 'coachignited' ) ) ); ?> <?php echo esc_html( get_bloginfo( 'name' ) ); ?>
			</div>
		</div>
	</footer>

	<div id="video-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="video-modal-title" aria-hidden="true">
	  <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
	    <div class="modal-content">
	    	<div class="row">
		    	<div class="col-12 col-md-7">
		    		<div class="embed-responsive embed-responsive-16by9 mb-4">
			    		<iframe id="video-embed" class="embed-responsive-item" src="" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
			    	</div>
		    	</div>
		    	<div class="col-12 col-md-5 meta">
		    		<h1 id="video-title"></h1>
		    		<p id="video-trainer-rating" class="rating"></p>
			    	<p id="video-trainer-location"></p>
			    	<p id="video-trainer-position"></p>

			    	<a href="<?php echo get_post_meta(get_option('page_on_front'), 'cignited_front_hero_btn_link', true) ?? '' ?>" class="btn btn-gradient-primary btn-lg">Book a call <i class="ml-2 fas fa-chevron-circle-right"></i></a>
		    	</div>
		    	<div class="col-12">
		    		<blockquote id="video-description"></blockquote>
		    	</div>
		    	
		    	<button class="close" title="Close" aria-label="Close">
		    		<i class="fas fa-times"></i>
		    	</button>
		    </div>
		  </div>
	  </div>
	</div>

	<?php wp_footer(); ?>
</body>
</html>