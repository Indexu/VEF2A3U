<?php
/*if(!isset($_SESSION)) 
{ 
	session_start(); 
}*/

require('../totsekkidbcon/ekkidbcon.php');

// Fetch album images
if(isset($_POST['album'])){

	$query = "
	SELECT * FROM userimages
	INNER JOIN useralbums ON (userimages.albumID=useralbums.id)
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
