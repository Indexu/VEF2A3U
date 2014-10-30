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
		$('#list > .row').empty(); // Empty output

		var files = event.target.files; // The files

		// Loop through files
		for (var i = 0, f; f = files[i]; i++){
			// Filter out anything but images
			if(!f.type.match('image.*')){
				continue;
			}

			var reader = new FileReader(); // FileReader

			// Create a thumbnail for each image
			reader.onload = (function(theFile){
				return function(e){

					// The thumbnail
					var span = '<img class="uploadThumb" src="';
					span = span.concat(e.target.result,
									   '" title="',
									   escape(theFile.name),
									   '" />');

					$('#list > .row').append(span); // Append the thumbnail
				};
			})(f);

			// Read image
			reader.readAsDataURL(f);

		}
	}
	// Event listener
	var inputFile = $('#files')[0];
	inputFile.addEventListener('change', handleFileSelect, false);

	// Upload Button
	$('#uploadButton').click(function(event){
        event.preventDefault();

        var ajaxData = new FormData();

        ajaxData.append('action', 'uploadForm');

        $.each($("#files")[0].files, function(i, file){
        	ajaxData.append('files['+ i +']', file);
        });

       $.ajax({
       		url: 'includes/uploadImg.php',
       		data: ajaxData,
       		cache: false,
       		contentType: false,
       		processType: false,
       		processData: false,
       		type: 'POST',
       		dataType: 'json',
       		success: function(data){
       			if (data == 'success') {
       				alert("UPLOADED");
       			}
       		}
       });

        /*var post_data = {'email':email, 'password':password, 'rememberme':rememberme};

        $.post('core.php', post_data, function(data){

            //Success
            if (data == "success") {
                $('.loadingGif').fadeOut('slow').queue(function() {
                    window.location.replace("http://tsuts.tskoli.is/hopar/gru_h1/hive");
                });

            }

        });*/
    });
	
});