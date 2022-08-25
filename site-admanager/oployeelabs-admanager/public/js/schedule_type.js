jQuery(document).ready(function($){

	$("#schedule_status").change(function() {

	var el = $(this) ;

	if(el.val() === "1" ) {
	   $('.date').removeClass('hide-section');
	   $('.max-view,.max-click').addClass('hide-section');
	    $('.max-view,.max-click').removeClass('show-section');
	   $('.date').addClass('show-section');
	}
	else if(el.val() === "2" ) {
	 $('.max-view').removeClass('hide-section');
	   $('.date,.max-click').addClass('hide-section');
	    $('.date,.max-click').removeClass('show-section');
	   $('.max-view').addClass('show-section');

	}

	else if(el.val() === "3" ) {
	   $('.max-click').removeClass('hide-section');
	   $('.date,.max-view').addClass('hide-section');
	    $('.date,.max-view').removeClass('show-section');
	   $('.max-click').addClass('show-section');
	}
	});

});