<?php

/*
	Plugin Name: Coaching Ignited Post Types
	Description: Defines the underlying post types for the Coaching Ignited website.
	Author: Jake Causier
	Author URI: https://github.com/jakecausier
	Version: 0.0.1
*/


if (!defined('WPINC')) {
	die;
}


if ( file_exists( WPMU_PLUGIN_DIR . '/cmb2/init.php' ) ) {
	require_once WPMU_PLUGIN_DIR . '/cmb2/init.php';
}


if ( !class_exists( 'CoachingIgnited' ) ) {
  class CoachingIgnited {

  	public static function get_recent_posts($amount = 4) {
  		$args = array(
				'post_type' => 'post',
				'post_status' => 'publish',
				'posts_per_page' => $amount,
				'order' => 'DESC',
				'orderby' => 'date'
			);
			$posts = get_posts($args);
			return $posts;
  	}

  	public static function get_videos($amount = 8, $sort = 'date') {
  		$args = array(
  			'post_type' => 'coachignited_videos',
  			'post_status' => 'publish',
  			'posts_per_page' => $amount,
  			'orderby' => $sort
  		);
  		$posts = get_posts($args);
			return $posts;
  	}

  	public static function get_video() {
	    $id = $_REQUEST['post_id'];
	    if (empty($id)) {
	      $error = new WP_Error('-3', 'No ID passed!');
	      wp_send_json_error($error);
	    } else {
	      $args = array(
	      	'posts_per_page' => -1,
	      	'post_type' => 'coachignited_videos',
  				'post_status' => 'publish',
  				'p' => $id
	      );
	      $post = get_posts($args);
	      if (!is_wp_error($post)) {
	      	$response = [
	      		'data' => $post[0],
	      		'meta' => get_post_meta($post[0]->ID),
	      		'status' => 'success'
	      	];
	      	echo json_encode($response);
	      } else {
	        $error = new WP_Error('-1', $user_id->get_error_message());
	        wp_send_json_error($error);
	      }
		  }
		  die;
		}

  	public static function get_youtube_thumb($id) {
			if ( CoachingIgnited::url_exists( 'https://i.ytimg.com/vi_webp/' .$id . '/maxresdefault.webp' ) ) {
				$image = 'https://i.ytimg.com/vi_webp/' .$id . '/maxresdefault.webp';
			} elseif ( CoachingIgnited::url_exists( 'https://i.ytimg.com/vi_webp/' .$id . '/mqdefault.webp' ) ) {
				$image = 'https://i.ytimg.com/vi_webp/' .$id . '/mqdefault.webp';
			} elseif ( CoachingIgnited::url_exists( 'https://i.ytimg.com/vi/' .$id . '/maxresdefault.jpg' ) ) {
				$image = 'https://i.ytimg.com/vi/' .$id . '/maxresdefault.jpg';
			} elseif ( CoachingIgnited::url_exists( 'https://i.ytimg.com/vi/' .$id . '/mqdefault.jpg' ) ) {
				$image = 'https://i.ytimg.com/vi/' .$id . '/mqdefault.jpg';
			} else {
				$image = false;
			}
			return $image;
		}

		private static function url_exists($url) {
			$headers = get_headers($url);
			return stripos( $headers[0], "200 OK" ) ? true : false;
		}

  }
}


if ( !class_exists( 'CoachingIgnitedSetup' ) ) {
  class CoachingIgnitedSetup {
    

  	public function define_post_podcast_metaboxes() {

  		$prefix = 'cignited_post_';

		  $section = 'podcast_';
		  $cmb = new_cmb2_box(array(
		    'id' 							=> $prefix . $section . 'metaboxes',
		    'title' 					=> __('Podcast', 'coachignited'),
		    'object_types' 		=> array('post'),
		    'show_on_cb' 			=> 'cignited_podcast_callback',
		    'context' 				=> 'after_title',
		    'priority' 				=> 'high',
		    'show_names' 			=> true,
		    'closed' 					=> false,
		  ));

		  	$cmb->add_field(array(
		      'name' 					=> __('Anchor.fm Embed Link', 'coachignited'),
		      'desc' 					=> __('Paste the embed link for the podcast here, found by clicking the Share button. Example: https://anchor.fm/coachingignited/embed/episodes/CoachingIgnited-Ep-42--Tim-Drummond-e4albi/a-ah0f9u', 'coachignited'),
		      'id' 						=> $prefix . $section . 'embed',
		      'type' 					=> 'text',
		      'attributes'		=> array(
		      	'type'					=> 'url'
		      )
		    ));

  	}

  	public function define_front_page_metaboxes() {

  		$prefix = 'cignited_front_';

		  $section = 'hero_';
		  $cmb = new_cmb2_box(array(
		    'id' 							=> $prefix . $section . 'metaboxes',
		    'title' 					=> __('Front Page Hero', 'coachignited'),
		    'object_types' 		=> array('page'),
		    'show_on' 				=> array('id' => get_option('page_on_front')),
		    'context' 				=> 'after_title',
		    'priority' 				=> 'high',
		    'show_names' 			=> true,
		    'closed' 					=> false,
		  ));

		    $cmb->add_field(array(
		      'name' 					=> __('Title', 'coachignited'),
		      'desc' 					=> __('The primary title for the hero.', 'coachignited'),
		      'id' 						=> $prefix . $section . 'title',
		      'type' 					=> 'text',
		    ));

		    $cmb->add_field(array(
		      'name' 					=> __('Subtitle', 'coachignited'),
		      'desc' 					=> __('The secondary subtitle for the hero.', 'coachignited'),
		      'id' 						=> $prefix . $section . 'subtitle',
		      'type' 					=> 'text',
		    ));

		    $cmb->add_field( array(
					'name'    			=> __('Background Image', 'coachignited'),
					'desc'    			=> __('The background image for the hero.', 'coachignited'),
					'id'      			=> $prefix . $section . 'background',
					'type'    			=> 'file',
					'options' 			=> array(
						'url' 					=> false,
					),
					'query_args' 		=> array(
						'type' 					=> array(
							'image/gif',
							'image/jpeg',
							'image/png',
						),
					),
					'preview_size' 	=> 'medium',
				));

				$cmb->add_field(array(
		      'name' 					=> __('Text Colour', 'coachignited'),
		      'desc' 					=> __('Pick a colour that contrasts well with your chosen background.', 'coachignited'),
		      'id' 						=> $prefix . $section . 'colour',
		      'type'    			=> 'colorpicker',
					'default' 			=> '#ffffff',
		    ));

		    $cmb->add_field(array(
		      'name' 					=> __('Button URL', 'coachignited'),
		      'desc' 					=> __('Leave blank to hide the button.', 'coachignited'),
		      'id' 						=> $prefix . $section . 'btn_link',
		      'type'    			=> 'text',
					'attributes'		=> array(
						'placeholder'		=> 'google.com',
						'type'					=> 'url'
					)
		    ));

		  $section = 'videos_';
		  $cmb = new_cmb2_box(array(
		    'id' 							=> $prefix . $section . 'metaboxes',
		    'title' 					=> __('Videos Content', 'coachignited'),
		    'object_types' 		=> array('page'),
		    'show_on' 				=> array('id' => get_option('page_on_front')),
		    'context' 				=> 'normal',
		    'priority' 				=> 'high',
		    'show_names' 			=> true,
		    'closed' 					=> false,
		  ));

			  $cmb->add_field(array(
					'name'    				=> __('Content - Before', 'coachignited'),
					'desc'    				=> __('The text content to appear before the videos row.', 'coachignited'),
					'id' 							=> $prefix . $section . 'content_before',
					'type'    				=> 'wysiwyg',
					'options' 				=> array(),
				));

				$cmb->add_field(array(
					'name'    				=> __('Content - After', 'coachignited'),
					'desc'    				=> __('The text content to appear after the videos row.', 'coachignited'),
					'id' 							=> $prefix . $section . 'content_after',
					'type'    				=> 'wysiwyg',
					'options' 				=> array(),
				));

  	}


  	public function define_about_page_metaboxes() {

  		$prefix = 'cignited_about_';

		  $section = 'spinner_';
		  $cmb = new_cmb2_box(array(
		    'id' 							=> $prefix . $section . 'metaboxes',
		    'title' 					=> __('Logo Spinner', 'coachignited'),
		    'object_types' 		=> array('page'),
		    'show_on' => array(
	        'key' => 'page-template',
	        'value' => array(
	          'page-templates/template-about.php',
	        )
	      ),
		    'context' 				=> 'after_title',
		    'priority' 				=> 'high',
		    'show_names' 			=> true,
		    'closed' 					=> false,
		  ));

		 	 	$cmb->add_field( array(
					'name' => 'Logos',
					'desc' => 'Choose which logos to display and the order of appearance.',
					'id'   => $prefix . $section . 'logos',
					'type' => 'file_list',
					'query_args' => array( 'type' => 'image' ),
				));

		}


  	public function define_blog_page_metaboxes() {
  		
  		$prefix = 'cignited_blog_';

		  $section = 'hero_';
		  $cmb = new_cmb2_box(array(
		    'id' 							=> $prefix . $section . 'metaboxes',
		    'title' 					=> __('Header', 'coachignited'),
		    'object_types' 		=> array('page'),
		    'show_on' 				=> array('id' => get_option('page_for_posts')),
		    'context' 				=> 'after_title',
		    'priority' 				=> 'high',
		    'show_names' 			=> true,
		    'closed' 					=> false,
		  ));

		  	$cmb->add_field(array(
		      'name' 					=> __('Title', 'coachignited'),
		      'desc' 					=> __('The primary title for the header.', 'coachignited'),
		      'id' 						=> $prefix . $section . 'title',
		      'type' 					=> 'text',
		    ));

		    $cmb->add_field(array(
		      'name' 					=> __('Subtitle', 'coachignited'),
		      'desc' 					=> __('The secondary subtitle for the header.', 'coachignited'),
		      'id' 						=> $prefix . $section . 'subtitle',
		      'type' 					=> 'text',
		    ));

  	}


		public function define_post_type_videos() {

	    register_post_type(
	        'coachignited_videos',
	        array(
	          'labels' => array(
	              'name' => __('Videos', 'coachignited'),
	              'singular_name' => __('Video', 'coachignited'),
	              'add_new' => __('Add Video', 'coachignited'),
	              'add_new_item' => __('Add New Video', 'coachignited'),
	              'edit_item' => __('Edit Video', 'coachignited'),
	              'new_item' => __('New Video', 'coachignited'),
	              'view_item' => __('View Video', 'coachignited'),
	              'view_items' => __('View Videos', 'coachignited'),
	              'search_items' => __('Search Videos', 'coachignited'),
	              'not_found' => __('No Videos Found', 'coachignited'),
	              'not_found_in_trash' => __('No Videos Found', 'coachignited'),
	              'parent_item_colon' => __('Parent Videos', 'coachignited'),
	              'all_items' => __('List Videos', 'coachignited'),
	              'archives' => __('Videos Archive', 'coachignited'),
	              'attributes' => __('Video Attributes', 'coachignited'),
	              'insert_into_item' => __('Insert into Video', 'coachignited'),
	              'uploaded_to_this_item' => __('Uploaded to Video', 'coachignited'),
	              'featured_image' => __('Video thumbnail', 'coachignited'),
	              'set_featured_image' => __('Set Video thumbnail', 'coachignited'),
	              'remove_featured_image' => __('Remove Video thumbnail', 'coachignited'),
	              'use_featured_image' => __('Use as Video thumbnail', 'coachignited'),
	              'menu_name' => __('Videos', 'coachignited'),
	              'filter_items_list' => __('Videos', 'coachignited'),
	              'items_list_navigation' => __('Videos', 'coachignited'),
	              'items_list' => __('Videos', 'coachignited'),
	              'name_admin_bar' => __('Video', 'coachignited'),
	          ),
	          'supports' => array(
	              'title',
	              'editor',
	          ),
	          'rewrite' => array(
	          		'slug' => 'videos'
	          ),
	          'public' => true,
	          'has_archive' => true,
	          'menu_icon' => 'dashicons-format-video',
	          'hierarchical' => false,
	        )
	    );
		}

		public function define_post_type_videos_metaboxes() {

		  $prefix = 'cignited_videos_';

		  $section = 'trainer_';
		  $cmb = new_cmb2_box(array(
		    'id' 							=> $prefix . $section . 'metaboxes',
		    'title' 					=> __('Personal Trainer Information', 'coachignited'),
		    'object_types' 		=> array('coachignited_videos'),
		    'context' 				=> 'after_title',
		    'priority' 				=> 'high',
		    'show_names' 			=> true,
		    'closed' 					=> false,
		  ));

		    $cmb->add_field(array(
		      'name' 					=> __('Name', 'coachignited'),
		      'desc' 					=> __('The name of the personal trainer.', 'coachignited'),
		      'id' 						=> $prefix . $section . 'name',
		      'type' 					=> 'text',
		      'attributes'		=> array(
		      	'placeholder' 	=> 'John Smith'
		      )
		    ));

		    $cmb->add_field(array(
		      'name' 					=> __('Position', 'coachignited'),
		      'desc' 					=> __('The role that this person takes on.', 'coachignited'),
		      'id' 						=> $prefix . $section . 'position',
		      'type' 					=> 'text',
		      'attributes'		=> array(
		      	'placeholder' 	=> 'Personal Trainer'
		      )
		    ));

		    $cmb->add_field(array(
		      'name' 					=> __('Location', 'coachignited'),
		      'desc' 					=> __('The location/area the personal trainer works around.', 'coachignited'),
		      'id' 						=> $prefix . $section . 'location',
		      'type' 					=> 'text',
		      'attributes'		=> array(
		      	'placeholder' 	=> 'Stockport, Manchester'
		      )
		    ));

		    $cmb->add_field(array(
		      'name' 					=> __('Rating', 'coachignited'),
		      'desc' 					=> __('The 5-star rating of this trainer.', 'coachignited'),
		      'id' 						=> $prefix . $section . 'rating',
		      'type'    			=> 'radio_inline',
					'options' 			=> array(
						'5' 						=> __('5 Stars', 'coachignited'),
						'4'   					=> __('4 Stars', 'coachignited'),
						'3'     				=> __('3 Stars', 'coachignited'),
						'2'     				=> __('2 Stars', 'coachignited'),
						'1'     				=> __('1 Star', 'coachignited'),
						'0'     				=> __('No Stars', 'coachignited'),
					),
					'default' => '5',
		    ));

		  $section = 'videometa_';
		  $cmb = new_cmb2_box(array(
		    'id' 							=> $prefix . $section . 'metaboxes',
		    'title' 					=> __('Video Metadata', 'coachignited'),
		    'object_types' 		=> array('coachignited_videos'),
		    'context' 				=> 'normal',
		    'priority' 				=> 'high',
		    'show_names' 			=> true,
		    'closed' 					=> false,
		  ));

		    $cmb->add_field(array(
		      'name' 					=> __('YouTube Video ID', 'coachignited'),
		      'desc' 					=> __('Provide the YouTube video ID to use for embedding the video.', 'coachignited'),
		      'id' 						=> $prefix . $section . 'embed_url',
		      'type' 					=> 'text',
		      'attributes' 		=> array(
		      	'max' 					=> '16',
		      	'placeholder'		=> 'ScMzIvxBSi4',
		      	'required'			=> true
		      ),
		    ));
		}
	
	}
}

$CoachingIgnitedSetup = new CoachingIgnitedSetup();
$CoachingIgnited = new CoachingIgnited();

add_action('init', array($CoachingIgnitedSetup, 'define_post_type_videos'));
add_action('cmb2_admin_init', array($CoachingIgnitedSetup, 'define_front_page_metaboxes'));
add_action('cmb2_admin_init', array($CoachingIgnitedSetup, 'define_about_page_metaboxes'));
add_action('cmb2_admin_init', array($CoachingIgnitedSetup, 'define_blog_page_metaboxes'));
add_action('cmb2_admin_init', array($CoachingIgnitedSetup, 'define_post_type_videos_metaboxes'));
add_action('cmb2_admin_init', array($CoachingIgnitedSetup, 'define_post_podcast_metaboxes'));

add_action('wp_ajax_coachingignited_get_video', array($CoachingIgnited, 'get_video'));
add_action('wp_ajax_nopriv_coachingignited_get_video', array($CoachingIgnited, 'get_video'));

function cignited_podcast_callback($cmb) {
	return (has_post_format('audio', $cmb->object_id())) ? true : false;
}