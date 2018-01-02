// AJAX messenger
$(document).ready(function() {	
	var currentData = window.form;
	$(currentData).on('submit', function(form){
		currentData.preventDefault();
		jQuery.ajax({
			type: "POST",
			url: $(currentData).attr('action'),    
			data: $(currentData).serialize(),
			beforeSend: function(){
				$("#spinner").html('<i class="fa fa-cog fa-spin fa-2x"></i>');
			},
		    success: function(res) {
		    	$("#alert").css(
		    		'display' : 'hidden'
		    	);
				$("#alert").html(res);
				$("#spinner").html('');
		    }
		});
	});
});
