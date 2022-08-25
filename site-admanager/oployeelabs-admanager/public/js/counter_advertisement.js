jQuery(document).ready(function( $ ) {
	$('#opl-admanager-block').on('click', function () {	

		jQuery.ajax({
			url: countad.ajax_url,
			type:'post',
			data: {
				'action':'counter_advertisement',
				'advertisment_id' : $(this).attr("advertisement_id"),
				'count' : 1
			},
			success:function(data) {
			
			},
			error: function(errorThrown){
				console.log(errorThrown);
				alert(errorThrown);
			}
		}); 
	});

	if ( $( "#opl-admanager-block").length ) {
 
       jQuery.ajax({
			url: countad.ajax_url,
			type:'post',
			data: {
				'action':'view_counter_advertisement',
				'advertisment_id' : $("#opl-admanager-block").attr("advertisement_id"),
				'count' : 1
			},
			success:function(data) {
			
			},
			error: function(errorThrown){
				console.log(errorThrown);
				alert(errorThrown);
			}
		}); 
 
	}
});