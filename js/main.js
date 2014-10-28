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

	/* ========= Upload ============ */

	// CREDIT: http://www.html5rocks.com/en/tutorials/file/dndfiles/

	// Handle files
	function handleFileSelect(event){
		// Stop prop and prevent default
		event.stopPropagation();
		event.preventDefault();

		// Files
		var files = event.dataTransfer.files;

		// Output
		var output = [];

		for (var i = 0, f; f = files[i]; i++) {
			output.push('<li><strong>', escape(f.name), '</strong> (',
						f.type || 'n/a', ') - ',
							f.size, ' bytes, last modified: ',
							f.lastModifiedDate ? f.lastModifiedDate.toLocaleDateString() : 'n/a',
						'</li>');
		}

		$('#list')[0].innerHTML = '<ul>' + output.join('') + '</ul>';

	}

	// Drag n drop
	function handleDragOver(event){
		event.stopPropagation();
		event.preventDefault();
		event.dataTransfer.dropEffect = 'copy';
	}

	// The drop zone
	var dropZone = $('#drop_zone')[0];

	// Listeners
	dropZone.addEventListener('dragover', handleDragOver, false);
	dropZone.addEventListener('drop', handleFileSelect, false);

	
});