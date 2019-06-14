
	<footer id="footer" class="bg-dark py-4">
		<div class="container">
			<div class="text-light">
				&copy; <?php echo esc_html( date_i18n( __( 'Y', 'coachignited' ) ) ); ?> <?php echo esc_html( get_bloginfo( 'name' ) ); ?>
			</div>
		</div>
	</footer>

	<div id="video-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="video-modal-title" aria-hidden="true">
	  <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
	    <div class="modal-content">
	    	<h1 id="video-title"></h1>
	    	<h2 id="video-subtitle"></h2>
	    	<div class="embed-responsive embed-responsive-16by9 mb-4">
	    		<iframe id="video-embed" class="embed-responsive-item" src="" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
	    	</div>
	    	<blockquote id="video-description"></blockquote>
	    	<button class="close" title="Close" aria-label="Close">
	    		<i class="fas fa-times"></i>
	    	</button>
	    </div>
	  </div>
	</div>

	<?php wp_footer(); ?>
</body>
</html>