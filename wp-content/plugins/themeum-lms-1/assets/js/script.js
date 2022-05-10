jQuery(function() {
		jQuery("#submitbtn").click(function(){'use strict';
			var site = jQuery( "#checkout-url" ).text();
			
			jQuery('#submitbtn').css('padding','6px 35px');
			jQuery('#spinner').show();

				jQuery("#buy_now_form").submit(function(e){
					var postdata = jQuery(this).serializeArray();
					var formURL = jQuery(this).attr("action");
					jQuery.ajax(
					{
						url : formURL,
						type: "POST",
						data : postdata,
						success:function(data, textStatus, jqXHR) {
							jQuery('#spinner,#submitbtn').hide();
							jQuery("#simple-msg").html('<span><a class="btn btn-primary" href="'+site+'">Checkout</a></span>');
						},
						error: function(jqXHR, textStatus, errorThrown){
							jQuery('#spinner').hide();
							jQuery("#simple-msg-err").html('<span style="color:red">AJAX Request Failed<br/> textStatus='+textStatus+', errorThrown='+errorThrown+'</span>');
						}
					});
					e.preventDefault();	//STOP default action
					e.unbind(); //Remove a previously-attached event handler
				});
			jQuery("#buy_now_form").submit(); //SUBMIT FORM
		});
});