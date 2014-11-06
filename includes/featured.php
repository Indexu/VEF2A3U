<?php

require('totsekkidbcon/ekkidbcon.php');

# Slide Images
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

# Featured Images
function getFeaturedImages(){
	global $pdo;

	$query = "
	SELECT
	userimages.url,
	userimages.fileName,
	users.fullName
	FROM featured_images
	INNER JOIN userimages ON (featured_images.imgID=userimages.id)
	INNER JOIN users ON (userimages.userID=users.userID)
	WHERE
	featured_images.slide = 0
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

# Featured Albums
function getFeaturedAlbums(){
	global $pdo;

	$query = "
	SELECT
	useralbums.albumTitle,
	users.fullName
	FROM featured_albums
	INNER JOIN useralbums ON (featured_albums.albID=useralbums.id)
	INNER JOIN users ON (useralbums.userID=users.userID)
	WHERE
	featured_albums.slide = 0
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

# Latest Images
function getLatestImages(){
	global $pdo;

	$query = "
	SELECT
	userimages.url,
	userimages.fileName,
	users.fullName
	FROM userimages
	INNER JOIN users ON (userimages.userID=users.userID)
	ORDER BY userimages.dateOfUpload desc
	LIMIT 6
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

# Latest Images
function getLatestAlbums(){
	global $pdo;

	$query = "
	SELECT
	useralbums.albumTitle,
	users.fullName
	FROM useralbums
	INNER JOIN users ON (useralbums.userID=users.userID)
	ORDER BY useralbums.dateOfCreation desc
	LIMIT 3
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