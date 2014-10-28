$( document ).ready(function() {

	/* Slide down Login / Signup */
	$('.displayLogin').click(function(e){
		e.preventDefault();

		if($(this).hasClass('show')){
			$(".loginSignup").animate({
				top: "-=405"
			}, 700, function() {

    });
			$(this).removeClass('show').addClass('hide');

		}

		else{     
			$( ".loginSignup" ).animate({
				top: "+=405"
			}, 700, function() {

    });
			$(this).removeClass('hide').addClass('show');    
		}
	});

	/* Front Page scroll animations */
	$('.aboutButton').click(function(){
		$("html, body").animate({ scrollTop: $('#about').offset().top }, 500);
	});

	$('.featuresButton').click(function(){
		$("html, body").animate({ scrollTop: $('#features').offset().top }, 750);
	});

	$('.imagesButton').click(function(){
		$("html, body").animate({ scrollTop: $('#frontImages').offset().top }, 1000);
	});

	/* Login form */
	$('.loginButton').click(function(e){
		//e.preventDefault();

		/*
		var email = $('.loginEmail').val();
		var pass = $('.loginPass').val();

		if(email == ""){
			$('.alert-box').slideDown(500, function(){

			});
		}*/
	});

	
});