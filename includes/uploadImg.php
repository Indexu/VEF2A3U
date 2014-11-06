<?php
if(!isset($_SESSION)) 
{ 
	session_start(); 
}

$max = 2048000;
# Localhost
$destination = trim($_SERVER['DOCUMENT_ROOT'] . "/vef2a/final/VEF2A3U/userImg/" . $_SESSION['user']['email'] . '/');

# Server
//$destination = $_SERVER['DOCUMENT_ROOT'] . "/2t/2307942949/VEF2A3U/userImg/" . $_SESSION['user']['email'] . '/';

$makedir = false;
$albumArray = scandir($destination);
array_shift($albumArray);
array_shift($albumArray);

$error = "";


if(isset($_FILES['files']) && isset($_POST['action'])){

	require_once('classes/Ps2/Upload.php');

	try {
		$valid = true;

		# Ef það er engin albums til
		if(count($albumArray) == 0){
			$error = "You must create your first album";
			$valid = false;
			print $error;
		}

		# Nota albumið sem er selectað
		elseif($_POST['albumList']){
			$destination .= $_POST['albumList'];
		}

		# Uploada
		if($valid){
			$destination .= '/';

			$upload = new Ps2_Upload($destination);
			$upload->setMaxSize($max);
			#$upload->setPermittedTypes(array('text/plain'));
			$upload->createAlbumEntry();
			$upload->move();

			$result = $upload->getMessages();

			echo json_encode($result);
		}

	} catch (Exception $e) {

		echo $e;

	}
} 

// Create new album
if(isset($_POST['newAlbum'])){
	$directory = $_POST['newAlbum'];
	$result = false;
	if(!in_array($directory, $albumArray)){
		$result = mkdir($destination . $directory . '/');
	}

	if($result){
		echo "success";
	}
	else{
		echo "exists";
	}

}

function listAlbums($directory){
	$size = 8;

	if(count($directory) < 8){
		$size = count($directory);
	}

	if(!empty($directory)){
		echo '<p class="albumListHeader">My albums</p>';
		echo "<select name='albumList' class='albumList' size='$size'>";
		foreach($directory as $folder){
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