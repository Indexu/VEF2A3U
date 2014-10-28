<?php
require_once('totsekkidbcon/ekkidbcon.php');
include('includes/variables.php');
include('includes/title.php');
?>

<!doctype html>
<html class="no-js" lang="en">
<head>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<title>My Gallery<?php if(isset($title)){echo "&#8212;$title"; }?></title>
	<link rel="stylesheet" href="css/foundation.css" />
	<link rel="stylesheet" href="foundation-icons/foundation-icons.css" />
	<link rel="stylesheet" href="css/master.css" />
	<!--<script src="js/vendor/modernizr.js"></script>-->
</head>
<body>

	<div class="row wrapper">
		<div class="large-12 columns">

			<?php include('includes/topHeader.php'); ?>

			<?php include('includes/header.php'); ?>

			<?php include('includes/nav.php'); ?>

			<div class="row">

				<div class="large-12 columns">
					<h2 class="mainParagraphHeader">
						Contact
					</h2>
				</div>

			</div>

			<form> 
				<div class="row">

					<div class="large-4 columns">
						<label>Name
							<input type="text" placeholder="John Doe" />
						</label>
					</div>

					<div class="large-4 columns">
						<label>Email
							<input type="text" placeholder="example@example.com" /> 
						</label>
					</div>

					<div class="large-4 columns">
						<label>Phone Number
							<input type="text" placeholder="123-4567" />
						</label>
					</div>

				</div>

				<div class="row">
					<div class="large-12 columns">
						<label>Message <textarea class ="contactText" placeholder="Type your message here"></textarea> </label>
					</div> 
				</div>

				<div class="row">
					<div class="large-3 columns large-centered">
						<button class="sendButton">Send</button>
					</div> 
				</div>

			</form>

			<?php include('includes/footer.php'); ?>

		</div>
	</div>

	

	<script src="js/vendor/jquery.js"></script>
	<script src="js/foundation.min.js"></script>
	<script>
		$(document).foundation();
	</script>
</body>
</html>
