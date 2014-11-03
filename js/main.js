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
	var inputFile = $('#files');

	if(inputFile.length){
		inputFile[0].addEventListener('change', handleFileSelect, false);
	}

	// Upload Button
	$('#uploadButton').click(function(event){
        event.preventDefault();

        $('.uploadResults').empty();

        var ajaxData = new FormData();

        ajaxData.append('action', 'uploadImages');

        var album = $('.albumList').val();

        if(album){
        	ajaxData.append('albumList', album);
        }

        else{
        	alert("Create an album");
        }

        $.each($("#files")[0].files, function(i, file){
        	ajaxData.append('files['+ i +']', file);
        });

       $.ajax({
       		url: 'includes/uploadImg.php',
       		data: ajaxData,
       		cache: false,
       		contentType: false,
       		processData: false,
       		type: 'POST',
       		success: function(data){
       			if(data.charAt(0) == '['){
	       			messages = JSON.parse(data);
	       			$('.uploadResults').append('<ul></ul>');
	       			for (var i = 0; i < messages.length; i++) {
	       				$('.uploadResults > ul').append('<li>' + messages[i] + '</li>');
	       			}
       			}
       			else{
       				if(data.indexOf("POST Content-Length") != -1){
       					$('.uploadResults').append("The ammount of data you are trying to submit in one go is too much.<br >Try sending the data in smaller batches.");
       				}
       				else{
       					$('.uploadResults').append('<p>' + data + '</p>');
       				}
       				
       			}
       			
       		},
       		error: function(data){
       			alert("error");
       			alert(data);
       			$('.uploadResults').append('<p></p>');
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

	// Create new album button
	$('.createAlbum').click(function(event){
		event.preventDefault();
		$('.createAlbumBox').slideToggle("slow", function(){
			//Animation complete.
		});
	});

	//Create a new album
	$('.createAlbumSubmit').click(function(event){
		event.preventDefault();
		
		var newAlbum = $('input[name="newAlbum"]').val();

		var post_data = {'newAlbum':newAlbum};

        $.post('includes/uploadImg.php', post_data, function(data){

            //Success
            if (data == "success") {
                alert("Album created");

                var albumList = $('.albumList'); // The album list
                // If this isn't the first album, append it to the list
                if(albumList.length){
                	albumList.append("<option value='" + newAlbum + "'>" + newAlbum + "</option>");
                	size = albumList.attr("size");

                	//If there are less than 8, increment the size attribute
                	if(size < 8){
                		size++;
                		albumList.attr("size", size);
                	}
                }

                else{
                	location.reload();
                }
            }
            //Exists
            else if(data == "exists"){
            	alert("Album already exists");
            }
            //Error
            else{
            	alert(data);
            }

        });
	});

	// =========SLICK============
	$('.featuredSlide').slick({
	  autoplay: true,
	  autoplaySpeed: 3000,
	  speed: 600
	});
	
});