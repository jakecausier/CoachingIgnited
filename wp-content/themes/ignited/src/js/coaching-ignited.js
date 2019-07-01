try {
    window.$ = window.jQuery = require('jquery');
} catch (e) {}

const LazyLoad = require('vanilla-lazyload');

require('bootstrap');
require('popper.js');
require('cloud9carousel');

var lazyLoadInstance = new LazyLoad({
    elements_selector: ".lazy"
});

$(function(){
	$("#spinner-element").Cloud9Carousel({
	  autoPlay: 1,
	  farScale: 0.6,
	  bringToFront: true,
	});
});

$(function(){
  $('#videos .video-item .thumbnail').click(function() {
  	var post_id = $(this).attr('data-id');

  	$.ajax({
	    type: "GET",
	    url: formVariables.adminAjaxUrl,
	    data: {
	      action: 'coachingignited_get_video',
	      post_id: post_id
	    }
	  }).done(function(response) {
	  	var response = JSON.parse(response);

			if (response.status === 'success') {
				
				var post = response.data;
				var meta = response.meta;
				var description = post.post_content;
				var trainer = null;
				var location = 'Not Specified';
				var position = 'Not Specified';
				var rating = 0;
				var embed = null;

				if (meta.cignited_videos_trainer_name) {
					trainer = meta.cignited_videos_trainer_name[0];
				}
				if (meta.cignited_videos_trainer_location) {
					location = meta.cignited_videos_trainer_location[0];
				}
				if (meta.cignited_videos_trainer_position) {
					position = meta.cignited_videos_trainer_position[0];
				}
				if (meta.cignited_videos_trainer_rating) {
					rating = meta.cignited_videos_trainer_rating[0];
				}
				if (meta.cignited_videos_videometa_embed_url) {
		  		embed = 'https://www.youtube.com/embed/' + meta.cignited_videos_videometa_embed_url[0] + '?controls=0';
		  	}

		  	if (embed !== null) {
			  	$('#video-modal #video-title').text(trainer);
			  	$('#video-modal #video-trainer-location').text('Location: ' + location);
			  	$('#video-modal #video-trainer-position').text('Occupation: ' + position);
			  	$('#video-modal #video-trainer-rating').text('Rating: ');
			  	$('#video-modal #video-embed').attr('src', embed);
			  	$('#video-modal #video-description').html(description);

			  	for (var i = 0; i < rating; i++) {
			  		$('#video-modal #video-trainer-rating').append('<i class="fas fa-star fa-fw"></i>');
			  	}

	    		$('#video-modal').modal('show');
	    	} else {
	    		console.log('No embed code on this video, cannot open.')
	    	}

			} else {
				error_messages = response.data;
				console.log(error_messages);
      }
	  });
  });

  $('#video-modal .close').click(function() {
  	$('#video-modal').modal('hide');
  });

  $('#video-modal').on('hidden.bs.modal', function (e) {
	  $('#video-modal #video-embed').attr('src', '');
	})
});
