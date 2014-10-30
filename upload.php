<?php
require_once('totsekkidbcon/ekkidbcon.php');
include('includes/variables.php');
include('includes/title.php');
include('includes/randomImage.php');
include('includes/login.php');
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
					<div class="medium-2 columns">
						<h3>Upload Images</h3>
						<input type="file" name="files[]" id="files" multiple />
						<input type="submit" name="uploadButton" id="uploadButton" class="button" value="Upload!" />
					</div>

					<div class="medium-10 columns">
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
