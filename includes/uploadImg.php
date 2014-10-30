<?php
$max = 2048000;
# Localhost
//$destination = trim($_SERVER['DOCUMENT_ROOT'] . "/vef2a/verkefni1/userImg/" . $_SESSION['user']['email'] . '/');

# Server
$destination = $_SERVER['DOCUMENT_ROOT'] . "/2t/2307942949/VEF2A3U/userImg/" . $_SESSION['user']['email'] . '/';

$makedir = false;
$albumArray = scandir($destination);
$error = "";


if(isset($_POST['uploadFiles'])){
	
	require_once('includes/classes/Ps2/Upload.php');

	try {
		$valid = true;

		$newFolder = trim($_POST['albumFolder']);

		# Ef new folder text field er empty
		if(empty($newFolder)){

			# Ef það er engin albums til
			if(count($albumArray) == 2){
				$error = "You must create your first album";
				$valid = false;
				print $error;
			}

			# Nota albumið sem er selectað
			elseif($_POST['albumlist'] != 'noalbums'){
				$destination .= $_POST['albumlist'];
			}
		}

		# Búa til nýtt album
		else{
			$destination .= $_POST['albumFolder'];
			$makedir = true;
		}

		# Uploada
		if($valid){
			$destination .= '/';

			if($makedir){
				if(!in_array($destination, $albumArray)){
					mkdir($destination);
				}
			}

			$upload = new Ps2_Upload($destination);
			$upload->setMaxSize($max);
			#$upload->setPermittedTypes(array('text/plain'));
			$upload->createAlbumEntry();
			$upload->move();

			$result = $upload->getMessages();
		}

		
		
	} catch (Exception $e) {

		echo $e->getMessages();
		
	}
}