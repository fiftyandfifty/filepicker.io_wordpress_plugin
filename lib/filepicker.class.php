<?php

/**
 *
 * Filepicker Class
 *
 * @package WordPress
 * @subpackage Filepicker.io Plugin
 *
**/
class Filepicker {

	function __construct() {

	}

	function store_local(){

		check_ajax_referer( 'media-form' );

		$attachment = array(
		 'post_author' 		=> (get_current_user_id()?get_current_user_id():null),
		 'post_date' 		=> date('Y-m-d H:i:s'),
		 'post_type' 		=> 'attachment',
		 'post_title' 		=> $_REQUEST['post_data']['name'],
		 'post_parent' 		=> (!empty($_REQUEST['post_id'])?$_REQUEST['post_id']:null),
		 'post_status' 		=> 'inherit',
		 'post_mime_type' 	=> $_REQUEST['post_data']['type'],
		);

		$attachment_id = wp_insert_post( $attachment, true );

		add_post_meta($attachment_id, '_wp_attached_file', $_REQUEST['post_data']['file_url'], true );
		add_post_meta($attachment_id, '_wp_attachment_metadata', $_REQUEST['post_data'], true );
		add_post_meta($attachment_id, 'filepicker_url', $_REQUEST['post_data']['file_url'], true );

	}

}
