<?php
require_once('totsekkidbcon/ekkidbcon.php');
require('includes/uploadImg.php');
include('includes/variables.php');
include('includes/title.php');
include('includes/randomImage.php');
include('includes/login.php');

// If not logged in, go to index page
if(!check_login()){
	header('Location: index.php');
	die();
}

?>

<!doctype html>
<html class="no-js" lang="en">
<head>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<title>Armada<?php if(isset($title)){echo "&#8212;$title"; }?></title>
	<link rel="stylesheet" href="css/foundation.css" />
	<link rel="stylesheet" href="foundation-icons/foundation-icons.css" />
	<link rel="stylesheet" href="css/master.css" />
	<!--<script src="js/vendor/modernizr.js"></script>-->
</head>
<body>

	<div class="wrapper">
		<?php include('includes/loggedInHeader.php'); ?>

		<div class="row firstRow">
			<div class="medium-12 columns">

				<form id="uploadForm" method="post" enctype="multipart/form-data" >
					<div class="medium-3 columns">
						<h3>Upload Images</h3>
						<input type="file" name="files[]" id="files" multiple />
						<?php listAlbums($albumArray); ?>
						<button class="createAlbum">Create a new album</button>

						<div class="createAlbumBox">
							<input type="text" placeholder="Album name" name="newAlbum" />
							<button class="createAlbumSubmit">Create Album</button>
						</div>

						<input type="submit" name="uploadButton" id="uploadButton" class="button" value="Upload!" />

						<div class="uploadResults">
							<ul>
								
							</ul>
						</div>

					</div>

					<div class="medium-9 columns">
						<output id="list">
							<div class="row">
								
							</div>
						</output>
					</div>
					
				</form>

			</div>
		</div>
	</div>

	<?php include('includes/footer.php'); ?>
	

	<script src="js/vendor/jquery.js"></script>
	<script src="js/foundation.min.js"></script>
	<script>
		$(document).foundation();
	</script>
	<script src="js/main.js"></script>
</body>
</html>
