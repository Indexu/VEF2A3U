<?php
require_once('totsekkidbcon/ekkidbcon.php');
include('includes/variables.php');
include('includes/title.php');
include('includes/login.php');

// If not logged in, go to index page
if(!check_login()){
	header('Location: index.php');
	die();
}

function albumlist(){
	# Localhost
	$destination = trim($_SERVER['DOCUMENT_ROOT'] . "/vef2a/final/VEF2A3U/userImg/" . $_SESSION['user']['email'] . '/');

	# Server
	//$destination = $_SERVER['DOCUMENT_ROOT'] . "/2t/2307942949/VEF2A3U/userImg/" . $_SESSION['user']['email'] . '/';

	$albumArray = scandir($destination);
	array_shift($albumArray);
	array_shift($albumArray);

	$size = 20;

	if(count($albumArray) < $size){
		$size = count($albumArray);
	}

	if(!empty($albumArray)){
		echo "<select name='albumList' class='albumListPhotos' size='$size'>";
		foreach($albumArray as $folder){
			if($folder != '.' && $folder != '..'){
				echo '<option value="' . $folder . '">' . $folder . '</option>';
			}
		}
		echo '</select>';
	}
	else{
		echo '<p>No albums found.</p>';
	}
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
			<div class="medium-2 columns albumListContainer">
				<h3>Albums</h3>
				<?php albumlist(); ?>
			</div>

			<div class="medium-10 columns imageList">
				
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
