/*global $:false */

jQuery(document).ready(function($){'use strict';

    // portfolio filter
	$(window).load(function(){'use strict';
		var $portfolio_selectors = $('.portfolio-filter >li>a');
		var $portfolio = $('.portfolio-items');
		$portfolio.isotope({
			itemSelector : '.portfolio-item',
			layoutMode : 'fitRows'
		});
		
		$portfolio_selectors.on('click', function(){
			$portfolio_selectors.removeClass('active');
			$(this).addClass('active');
			var selector = $(this).attr('data-filter');
			$portfolio.isotope({ filter: selector });
			return false;
		});
	});


	var $latestcourse = $('#carousel-latest-course');

	$latestcourse.owlCarousel({
		margin: 30,
		loop: false,
		responsive: {
			0: {
				items: 1
			},
			600: {
				items: 2
			},
			1000: {
				items: 3
			}
		},
		dots:false,
	});


	$('.latestCoursePrev').click(function(){
		$latestcourse.trigger('prev.owl.carousel', [400]);
	});

	$('.latestCourseNext').click(function(){
		$latestcourse.trigger('next.owl.carousel',[400]);
	});


	//event
	var $themeumevent = $('#carousel-event');

	$themeumevent.owlCarousel({
		loop: false,
		responsive: {
			0: {
				items: 1
			},
			600: {
				items: 2
			},
			1000: {
				items: 3
			}
		},
		dots:false,
	});

	$('.eventPrev').click(function(){
		$themeumevent.trigger('prev.owl.carousel', [400]);
	});

	$('.eventNext').click(function(){
		$themeumevent.trigger('next.owl.carousel',[400]);
	});

	
    // Sticky Nav
	$(window).on('scroll', function(){
		if ( $(window).scrollTop() > 0 ) {
			$('#masthead').addClass('sticky');
		} else {
			$('#masthead').removeClass('sticky');
		}
	});

	// Search onclick

	$('.hd-search-btn').on('click', function(event) {
		event.preventDefault();
		var $searchBox = $('.home-search');
		if ($searchBox.hasClass('show')) {
			$searchBox.removeClass('show');
			$searchBox.fadeOut('fast');
		}else{
			$searchBox.addClass('show');
			$searchBox.fadeIn('slow');
		}
	});

	$('.hd-search-btn-close').on('click', function(event) {
		event.preventDefault();

		var $searchBox = $('.home-search');
		$searchBox.removeClass('show');
		$searchBox.fadeOut('fast');
	});


	// Parallax section
	$(window).bind('load', function () {
		parallaxInit();						  
	});
	function parallaxInit() {
		$(document).find('.parallax-section').each(function() {
			$(this).parallax("50%", 0.3);
		});
	}	
	parallaxInit();

	$( window ).resize(function() {
		parallaxInit();
	});


	// Add extra class on iframe
	$("iframe").addClass("embed-responsive-item");
	

	$("a[data-rel]").prettyPhoto();

	$(window).load(function(){
		$('.masonery_area').isotope({
			animationEngine: 'jquery',
			animationOptions: {
				duration: 400,
				queue: false
			},
			itemSelector : '.masonery-post'
		});
	});

	// Load More Pagination
	$('#post-loadmore').on('click',function(event){
		event.preventDefault();

		var $that = $(this);
		if($that.hasClass('disable')){
			return false;
		}

		var container = $('#themeum-area'), // item container
			perpage = $that.data('per_page'), // post per page number
			total_posts = $that.data('total_posts'), // total posts count
			col_grid = $that.data('col_grid'), // output column grid
			ajaxUrl = $that.data('url');

		var items = container.find('.themeum-post-item'),
			itemNumbers = items.length,
			paged = ( itemNumbers / perpage ) + 1; // paged number

		$.ajax({
			url: ajaxUrl,
			type: 'POST',
			data: {perpage: perpage,paged:paged,col_grid:col_grid},
			beforeSend: function(){
				$that.addClass('disable');
				$('<i class="fa fa-spinner fa-spin" style="margin-left:10px"></i>').appendTo( "#post-loadmore" ).fadeIn(100);
			},
			complete:function(){
				$('#post-loadmore .fa-spinner ').remove();
			}
		})
		.done(function(data) {
			var $newItems = $(data);
			container.isotope('insert', $newItems,function(){
				container.isotope('reLayout',{
					animationEngine: 'jquery',
					animationOptions: {
						duration: 400,
						queue: false
					}
				});
				var newLenght  = container.find('.themeum-post-item').length;
				if(total_posts <= newLenght){
					$('.load-wrap').fadeOut(400,function(){
						$('.load-wrap').remove();
					});
				}
				$that.removeClass('disable');
			});
			$("a[data-rel]").prettyPhoto();
		})
		.fail(function() {
			alert('failed');
			console.log("error");
		});
	});

	//WOW JS
	var wow = new WOW(
	{
	    boxClass:     'wow',
	    animateClass: 'animated',
	    offset:       0,
	    mobile:       true,
	    live:         true
	}
	);
	wow.init();
	
	// Owl Tiny Slider
	$("#owl-tiny-slider").owlCarousel({
      loop : true, // Show next and prev buttons
      responsive: {
			0: {
				items: 1
			},
			600: {
				items: 1
			},
			1000: {
				items: 1
			}
		},
		autoplay:true,
		dots:false
  });




// --------------------------------------Quiz Start ----------------------------------------------
	
	jQuery("#quiz-next").hide();
	jQuery('#quiz-body').on('click',function(event){
		jQuery(".quiz-body").hide();
		jQuery("#quiz-next").show();	
		jQuery("#quiz-next").text('Start');	
	});
	var previous_text = jQuery("#quiz-next").text();	



	var select_time = 'first';
	// Load More Pagination
	jQuery('#quiz-next').on('click',function(event){
		event.preventDefault();

		jQuery("#quiz-next").text( previous_text );	


		if( select_time == 'first' ){
			var count = $.trim( jQuery("#total-time").text() );
			var counter=setInterval(timer, 1000); //1000 will  run it every 1 second
			function timer(){
			  count=count-1;
			  if (count <= 0){
			     clearInterval(counter);
			     return;
			  }

		    var min = Math.floor(count/60);
		    var times = '<i class="fa fa-clock-o"></i>' + min + ' Min ' + ( count - min*60 ) + ' Sec';
			jQuery("#timer").html( times ); // watch for spelling

			}
		}
		select_time = 'last';


		var $that = $(this);
		if($that.hasClass('disable')){
			return false;
		}
		var question_exits = 'no';
		var select_ans = '';
		if ( jQuery('#question-area input:radio[name=q1]').length ) {
 			question_exits = 'yes';
 			select_ans = jQuery('#question-area input:radio[name=q1]:checked').val();

 			if( typeof( select_ans ) === "undefined" ){
 				select_ans = 5;
 			}
		}


		var container = $('#question-area'),
			post_id = $that.data('post-id'),
			question_no = $that.data('question-no'),
			user_id = $that.data('user-id'),
			ajaxUrl = $that.data('url');

		$.ajax({
			url: ajaxUrl,
			type: 'POST',
			data: {post_id: post_id,question_no:question_no,user_id:user_id,question_exits:question_exits,select_ans:select_ans},
			beforeSend: function(){
				jQuery('#question-data').html( '<i class="fa fa-spinner fa-spin"></i>' );
			},
			complete:function(){
				jQuery('#question-data .fa-spinner ').remove();
			}
		})
		.done(function(data) {
			
			jQuery("#question-data").html( data );
			if( jQuery(".back-to-home").length > 0 ){
				jQuery("#quiz-next").hide();
			}
			jQuery('#quiz-next').data('question-no', jQuery('#quiz-next').data('question-no')+1 ); 
			
		})
		.fail(function() {
			alert('failed');
			console.log("error");
		});
	});
// ---------------------------------------- New Quiz Stop --------------------------------------------





// ------------------------------------ Review Submit Form Start ----------------------------------------
	function review_submit_form(e){
		var postdata = jQuery(this).serializeArray();
		//console.log( jQuery( this ).serializeArray() );

		var formURL = jQuery(this).attr("action");
		jQuery.ajax({
			url : formURL,
			type: "POST",
			data : postdata,
			success:function(data, textStatus, jqXHR) {
				//jQuery('#review-submit-form')[0].reset();
				//jQuery('#update-msg').modal();
				window.location.href = jQuery('#redirect-url').val();
			},
			error: function(jqXHR, textStatus, errorThrown){
				jQuery("#simple-msg-err").html('<span style="color:red">AJAX Request Failed<br/> textStatus='+textStatus+', errorThrown='+errorThrown+'</span>');
			}
		});
		e.preventDefault();	//STOP default action
		e.unbind(); //Remove a previously-attached event handler
	}
	jQuery("#review-submit-form").submit( review_submit_form ); //SUBMIT FORM
// ------------------------------------ Review Submit Form Start ----------------------------------------

jQuery('.edit-review').on('click',function(event){
	jQuery('#review-form .review-message').val( jQuery(this).closest( "li" ).find( ".rating-body" ).text() );
	var sp = jQuery(this).closest( "li" ).find( ".rating-number" ).text();
	jQuery("input[name=rating][value='"+sp+"']").prop("checked",true);
});

jQuery('input[type=radio][name=rating]').on('change',function(event) {
	for (var i = 0; i <= 4 ; i++) {
		if( i < jQuery(this).closest( "span" ).index() ){
			jQuery('.pull-left span:eq('+i+')').addClass('active');
		}else{
			jQuery('.pull-left span:eq('+i+')').removeClass('active');
		}
	}
});


});



