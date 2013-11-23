<?php

/**
*
* Enqueue javascripts
*
* @since 1.0.0
*
**/

add_action('init', 'filepicker_scripts');
function filepicker_scripts()
{

	wp_register_script('filepicker', FILEPICKER_PLUGIN_URL . 'lib/filepicker.js');
	wp_register_script('filepicker_debug', 'https://api.filepicker.io/v1/filepicker_debug.js', array('filepicker'));
	wp_register_script('filepicker_for_wordpress', FILEPICKER_PLUGIN_URL . 'lib/filepicker_for_wordpress.js', array('filepicker', 'jquery'));
	wp_register_script('filepicker_settings', FILEPICKER_PLUGIN_URL . 'lib/filepicker_settings.js.php', array('filepicker'));
	wp_register_script('cross_browser_ajax', FILEPICKER_PLUGIN_URL . 'lib/cross_browser_ajax.js', array('jquery'));

	wp_localize_script( 'filepicker_for_wordpress', 'filepicker_ajax',
		array(
			'ajaxurl' => admin_url( 'admin-ajax.php' ),
			'nonce'   => wp_create_nonce('media-form')
		)
	);

	add_action('wp_enqueue_scripts', function(){
		wp_enqueue_script('filepicker');
		wp_enqueue_script('filepicker_debug');
		wp_enqueue_script('filepicker_for_wordpress');
		wp_enqueue_script('filepicker_settings');
		wp_enqueue_script('cross_browser_ajax');
	});

	add_action('admin_enqueue_scripts', function(){
		wp_enqueue_script('filepicker');
		wp_enqueue_script('filepicker_debug');
		wp_enqueue_script('filepicker_for_wordpress');
		wp_enqueue_script('filepicker_settings');
		wp_enqueue_script('cross_browser_ajax');
	});

}
