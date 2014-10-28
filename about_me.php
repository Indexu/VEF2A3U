<?php
require_once('totsekkidbcon/ekkidbcon.php');
include('includes/variables.php');
include('includes/title.php');
include('includes/randomImage.php');
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

				<div class="medium-12 columns">
					<h2 class="mainParagraphHeader">
						About
					</h2>
				</div>

				<div class="medium-12 columns">
					<p>
						Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras sagittis ex at ipsum euismod, ut dapibus nisi fermentum. Nunc tempus, velit vel fringilla tempus, nulla nisi consequat odio, sit amet lacinia elit leo a nisl. Suspendisse potenti. Morbi laoreet nunc vel laoreet cursus. Donec bibendum mattis orci in viverra. Nulla sed nibh eleifend dolor feugiat aliquam. Sed ornare enim sit amet sapien tempor pharetra. Duis quis placerat odio.

						Pellentesque luctus a quam nec dapibus. Phasellus urna mi, aliquet sit amet orci eget, finibus ultricies ante. Suspendisse at condimentum mi, vel consequat dolor. Praesent venenatis imperdiet elit, eget porta neque rhoncus eu. Nullam convallis mauris risus, vel mattis risus tincidunt at. Cras pharetra venenatis eros eu facilisis. Aliquam erat volutpat. Quisque ipsum nisi, commodo pretium laoreet sit amet, ornare eu tortor. Quisque nibh dolor, scelerisque nec euismod a, euismod et odio. Fusce finibus egestas nibh sed elementum. Morbi viverra nibh erat. Duis egestas scelerisque lorem, non faucibus mi sollicitudin ac. Praesent at feugiat velit, id sagittis lacus. Nunc hendrerit lacinia odio, a porta sapien iaculis eu.
					</p>
				</div>

				<div class="medium-6 columns">
					<img src="img/random/<?php randomImg($rowImg); ?>">
				</div>

				<div class="medium-6 columns">
					<img src="img/random/<?php randomImg($rowImg); ?>">
				</div>
			</div>

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
