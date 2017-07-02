jQuery(document).ready(function( $ ) {
	
	$('body').on('click', '.prescription_form_button', function(e){
		e.preventDefault;

		var fd = new FormData();
		var files_data = $('#prescriptionFile'); // The <input type="file" /> field
		
		// Loop through each data and create an array file[] containing our files data.
		$.each($(files_data), function(i, obj) {
			$.each(obj.files,function(j,file){
				fd.append('files[' + j + ']', file);
			})
		});
		
		// our AJAX identifier
		fd.append('action', 'prescription_form_submit');  
		
		// uncomment this code if you do not want to associate your uploads to the current page.
		fd.append('post_id', 10); 
		fd.append('pres_title', $("#prescriptionTitle").val());
		fd.append('pres_description', $("#prescriptionDescription").val());
		fd.append('pres_user_id', $("#prescriptionUserId").val());
		fd.append('pres_user_name', $("#prescriptionUserName").val());
		fd.append('pres_user_email', $("#prescriptionUserEmail").val());
		fd.append('pres_notification_email', $("#prescriptionNotificationEmail").val());
		fd.append('pres_user_phone', $("#prescriptionUserPhone").val());
		$.ajax({
			type: 'POST',
			url: actionUrl.ajaxurl,
			data: fd,
			contentType: false,
			processData: false,
			success: function(response){
				$('.upload-response').html(response); // Append Server Response
				//alert(fd);
			}
		});
	});
	
$("#prescription_order_image").live('click', function() {
      
        var modal = document.getElementById('myModal');

		// Get the image and insert it inside the modal - use its "alt" text as a caption
         
		var img =$(this)[0];
		  //alert(img);
		var modalImg = document.getElementById("img01");
		var captionText = document.getElementById("caption");
		
			modal.style.display = "block";
			modalImg.src = this.src;
			captionText.innerHTML = this.alt;
		

		// Get the <span> element that closes the modal
		var span = document.getElementsByClassName("close")[0];

		// When the user clicks on <span> (x), close the modal
		span.onclick = function() { 
		  modal.style.display = "none";
		}
    });	
	//Get the modal

	
});