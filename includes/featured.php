<?php

require('totsekkidbcon/ekkidbcon.php');

function getSlideImages(){
	global $pdo;

	$query = "
	SELECT
	userimages.url,
	users.fullName
	FROM featured_images
	INNER JOIN userimages ON (featured_images.imgID=userimages.id)
	INNER JOIN users ON (userimages.userID=users.userID)
	WHERE
	featured_images.slide = 1
	";

	try
	{
		$stmt = $pdo->prepare($query);
		$result = $stmt->execute();
	}
	catch(PDOException $ex)
	{
		die("Failed to run query: " . $ex->getMessage());
	}

	$row = $stmt->fetchAll();

	return $row;
}