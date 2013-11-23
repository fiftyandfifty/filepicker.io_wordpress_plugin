<?php

add_shortcode( 'filepicker', 'filepicker_show' );
function filepicker_show($atts) {
	global $post;

	extract(shortcode_atts(array(
		'apikey' => FILEPICKER_API_KEY,
	), $atts));

	$post_id = !empty($post->ID)?$post->ID:'';

	print "<button class='fp-pick' data-postid='{$post_id}'>Upload a File</button>";

}