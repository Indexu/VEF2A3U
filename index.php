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
	<link rel="stylesheet" type="text/css" href="slick/slick.css"/>
	<link rel="stylesheet" href="css/master.css" />
	<!--<script src="js/vendor/modernizr.js"></script>-->
</head>
<body>

	<div class="wrapper">
		<?php

			if(check_login()){
				include('includes/loggedInHeader.php');
				include('includes/frontLoggedIn.php');
			}

			else{
				include('includes/noLoginHeader.php');
				include('includes/frontNoLogin.php');
			}

		?>
		
	</div>
	

	<?php include('includes/footer.php'); ?>
	

	<script src="js/vendor/jquery.js"></script>
	<script src="js/foundation.min.js"></script>
	<script type="text/javascript" src="slick/slick.min.js"></script>
	<script>
		$(document).foundation();
	</script>
	<script src="js/main.js"></script>
</body>
</html>
