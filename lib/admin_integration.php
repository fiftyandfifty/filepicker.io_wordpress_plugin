<?php

/**
 * Displays the filpicker uploader link in the admin area.
 *
 * @package WordPress
 * @subpackage Filepicker.io Plugin
 * @since 1.0.0
 */

add_action('post-plupload-upload-ui', 'filepicker_media_upload');
function filepicker_media_upload()
{

	if ( $post = get_post() )
		$browser_uploader .= '&amp;post_id=' . intval( $post->ID );
	elseif ( ! empty( $GLOBALS['post_ID'] ) )
		$browser_uploader .= '&amp;post_id=' . intval( $GLOBALS['post_ID'] );

	?>
	<p class="filepickerio_upload">
	<?php printf( __( '<button class="fp-pick button-secondary">Filepicker.io uploader</button>' ) ); ?>
	</p>
	<?php
}



/**
 * Fixes the attachment url (so it doesn't look in the local uploads directory)
 *
 * @package WordPress
 * @subpackage Filepicker.io Plugin
 * @since 1.0.0
 */

add_filter('wp_get_attachment_url', 'filepicker_get_attachment_url', 9, 2);
function filepicker_get_attachment_url($url, $postID)
{
	$filepicker_url = get_post_meta($postID, 'filepicker_url', true);

	if( !empty($filepicker_url) ){
		return $filepicker_url;
	}
	else{
		return $url;
	}
}




