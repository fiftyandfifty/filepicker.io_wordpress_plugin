<?php header('Content-Type: text/javascript'); /* Force this file to processed as javascript by the browser */ ?>
<?php include_once('../../../../wp-load.php'); /* load in the wordpress core & the filepicker plugin */ ?>

/* set the filepicker.io API key */
filepicker.setKey('<?php print $_GLOBALS['filepicker']->filepicker_options['api_key'] ?>');

/**
*
* custom Ajax function for saving the media to wordpress after filepicker.io uploads it
*
**/
function create_wordpress_media( inkblob, postID )
{
	filepicker_data = {};
	var stats = filepicker.stat
	(
		inkblob, {width: true, height: true},
		function(metadata)
		{

			filepicker_data.post_data = {};

			filepicker_data.post_data.name 			= inkblob.filename;
			filepicker_data.post_data.file_url		= inkblob.url;
			filepicker_data.post_data.type 			= inkblob.mimetype;
			filepicker_data.post_data.width 		= metadata.width;
			filepicker_data.post_data.height 		= metadata.height;
			filepicker_data.post_data.size			= inkblob.size;
			filepicker_data.post_data.isWriteable 	= inkblob.isWriteable;

			filepicker_data.action 		= "filepicker_store_local";
			filepicker_data._ajax_nonce = window.filepicker_ajax.nonce;
			filepicker_data.post_id 	= postID;

			ajaxurl = window.filepicker_ajax.ajaxurl;

			FF_AJAX.make_ajax_request(ajaxurl, filepicker_data);
		}
	);
}



/**
*
* Filepicker.io functions are below
*
**/


/* PICK function */
jQuery(document).ready(function($)
{
	jQuery(".fp-pick").click(function(e)
	{
		e.preventDefault();
		var postID = $(this).attr('data-postid');
		filepicker.pick
		(
			{
				mimetypes: ['image/*', 'text/plain'],
				container: 'window',
				//services:['COMPUTER', 'FACEBOOK', 'GMAIL'],
			},
			function(InkBlob){
				create_wordpress_media( InkBlob, postID );
			},
			function(FPError){
				console.log(FPError.toString());
			}
		);
	});
});

