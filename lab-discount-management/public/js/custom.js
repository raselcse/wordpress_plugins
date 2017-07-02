jQuery(document).ready(function( $ ) {
	 $('select.percentise_discount').hide();
	$('[type="checkbox"][name="set_discount"]').change(function(){
		  $('select.percentise_discount').toggle(this.checked);
		});
		
	$('select.percentise_discount').change(function(){
	  var percentageValue = $(this).val();
	  var testPrice = $('[type="text"][name="test_price"]').val();
	  var discountPrice =  testPrice - ( (testPrice/100) * percentageValue );
	  $('[type="text"][name="discount_amount"]').val(discountPrice);
	});
	
	var testName = $('#lab_test_dicount_list > ul > li:nth-child(1) > div > div.lab_test_name').text();

	$("#lab_test_dicount_list h2.discount_title").text('For '+ testName + '  Discount list');
	
	// $(".high-price").click(function(){
            // $(this).addClass('active');
            // $(".low-price").removeClass('active');
        // });

        // // if you want first button to be disabled when second button is clicked
        // $(".low-price").click(function(){
			// $(this).addClass('active');
            // $(".high-price").removeClass('active');
        // });
	
});