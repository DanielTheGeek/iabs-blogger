$(document).ready(function(){
	if ( typeof CKEDITOR !== 'undefined' ) {
		var editor = CKEDITOR.replace( 'post-content' );
	}

	var options = {
		url: 'api/iabs_blogger?endpoint=new',
		type: 'POST', 
		beforeSend: function() {
			$('#response').html('<span class="mr-2 mb-2 btn btn-success btn-sm">processing...</span><br><br>');
		},
		success: function(resp) {
			if ( resp == 'true' ) {
				$('#response').html('<span class="btn-success btn-sm">Entry was successfully published.</span><br><br>');
				window.location = '../containers/view/iabs_blog_posts';
			} else {
				$('#response').html(resp);
			}
		}
	};

	var catOptions = {
		url: 'api/iabs_blogger?endpoint=new-category',
		type: 'POST', 
		beforeSend: function() {
			$('#response').html('<span class="mr-2 mb-2 btn btn-success btn-sm">processing...</span><br><br>');
		},
		success: function(resp) {
			if ( resp == 'true' ) {
				$('#response').html('<span class="btn-success btn-sm">Category was successfully saved.</span><br><br>');
				window.location = '../containers/view/iabs_blog_categories';
			} else {
				$('#response').html(resp);
			}
		}
	};

	var galOptions = {
		url: 'api/iabs_blogger?endpoint=do_new_gallery_post',
		type: 'POST', 
		beforeSend: function() {
			$('#response').html('<span class="mr-2 mb-2 btn btn-success btn-sm">processing...</span><br><br>');
		},
		success: function(resp) {
			if ( resp == 'true' ) {
				$('#response').html('<span class="btn-success btn-sm">Post was successfully saved.</span><br><br>');
				window.location = '../containers/view/iabs_site_gallery';
			} else {
				$('#response').html(resp);
			}
		}
	};

	$('input').click(function(e) {
		$('#response').html('');
	});

	$('textarea').click(function(e) {
		$('#response').html('');
	});

	// pass options to ajaxForm
	$('#new-post').ajaxForm(options);

	$('#new-category').ajaxForm(catOptions);

	$('#new-gallery-post').ajaxForm(galOptions);
});