<?php

require_once(get_template_directory() . '/includes/bs4navwalker.php');


function coachignited_initial_setup()
{
    add_theme_support('title-tag');
    add_theme_support('automatic-feed-links');
    add_theme_support('post-thumbnails');
    add_theme_support('post-formats', array('audio'));
    add_theme_support('custom-logo', array(
        'flex-height' => true,
        'flex-width'  => true,
        'header-text' => array('site-title', 'site-description'),
    ));

    global $content_width;

    // Set content width if not already set
    if (! isset($content_width)) {
        $content_width = 640;
    }

    // Register the navigation menus
    register_nav_menus(
      array(
        'primary-nav' => 'Primary Navigation',
        'footer-left' => 'Footer Left',
        'footer-right' => 'Footer Right',
      )
    );
}
add_action('after_setup_theme', 'coachignited_initial_setup');


function coachignited_load_scripts()
{
    wp_register_script('site', get_template_directory_uri() . '/build/js/coaching-ignited.js', null, bin2hex(random_bytes(5)));
    wp_localize_script('site', 'formVariables', array('adminAjaxUrl' => admin_url('admin-ajax.php')));
    wp_enqueue_script('site');

    // wp_register_script('lazy', get_template_directory_uri() . '/build/js/lazy.js', null, false, true);
    // wp_enqueue_script('lazy');
}
add_action('wp_enqueue_scripts', 'coachignited_load_scripts');


function coachignited_load_styles()
{
    wp_register_style('site', get_template_directory_uri() . '/build/css/coaching-ignited.css', null, bin2hex(random_bytes(5)));
    wp_enqueue_style('site');
}
add_action('wp_enqueue_scripts', 'coachignited_load_styles');