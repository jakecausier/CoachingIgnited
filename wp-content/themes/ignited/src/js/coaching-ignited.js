try {
    window.$ = window.jQuery = require('jquery');
} catch (e) {}

require('bootstrap');
require('popper.js');
require('cloud9carousel');


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
	  	console.log(response);

			if (response.status === 'success') {
				
				var post = response.data;
				var meta = response.meta;

				var title = post.post_title;
				var description = post.post_content;
				var trainer = '';
				var location = '';
				var embed = null;

				if (meta.cignited_videos_trainer_name[0]) {
					trainer = meta.cignited_videos_trainer_name[0];
				}
				if (meta.cignited_videos_trainer_location[0]) {
					location = meta.cignited_videos_trainer_location[0];
				}
				if (meta.cignited_videos_videometa_embed_url[0]) {
		  		embed = 'https://www.youtube.com/embed/' + meta.cignited_videos_videometa_embed_url[0] + '?controls=0';
		  	}

		  	if (embed !== null) {
			  	$('#video-modal #video-title').text(title);
			  	$('#video-modal #video-subtitle').text(trainer + ' from ' + location);
			  	$('#video-modal #video-embed').attr('src', embed);
			  	$('#video-modal #video-description').html(description);
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