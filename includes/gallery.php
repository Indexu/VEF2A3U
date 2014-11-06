<?php
/*if(!isset($_SESSION)) 
{ 
	session_start(); 
}*/

require('../totsekkidbcon/ekkidbcon.php');

// Fetch album images
if(isset($_POST['album'])){

	$query = "
	SELECT *, users.email AS email, useralbums.albumTitle AS albumTitle FROM userimages
	INNER JOIN useralbums ON (userimages.albumID=useralbums.id)
	INNER JOIN users ON (userimages.userID=users.userID)
	WHERE useralbums.albumTitle = :album
	";

	$query_params = array(
		':album' => $_POST['album']
	);

	try
	{
		$stmt = $pdo->prepare($query);
		$result = $stmt->execute($query_params);
	}
	catch(PDOException $ex)
	{
		die("Failed to run query: " . $ex->getMessage());
	}

	$row = $stmt->fetchAll();

	echo json_encode($row);

}
