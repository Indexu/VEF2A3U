<?php
$filepath = 'userImg/' . $_GET['user'] . '/' . $_GET['album'] . '/';
# Localhost
$filepath = $_SERVER['DOCUMENT_ROOT'] . "/vef2a/final/VEF2A3U/" . $filepath;

# Server
//$filepath = $_SERVER['DOCUMENT_ROOT'] . "/2t/2307942949/VEF2A3U/" . $filepath;

$getfile = NULL;

if (isset($_GET['file']) && basename($_GET['file']) == $_GET['file']) {
	$getfile = $_GET['file'];
} else {
	print "File error";
	exit;
}

if ($getfile) {
	$path = $filepath . $getfile;
// check that it exists and is readable
	if (file_exists($path) && is_readable($path)) {
// get the file's size and send the appropriate headers
		$size = filesize($path);
		header('Content-Type: application/octet-stream');
		header('Content-Length: '. $size);
		header('Content-Disposition: attachment; filename=' . $getfile);
		header('Content-Transfer-Encoding: binary');
// open the file in read-only mode
// suppress error messages if the file can't be opened
		$file = @fopen($path, 'r');
		if ($file) {
// stream the file and exit the script when complete
			fpassthru($file);
			exit;
		} else {
			print "File could not be opened";
		}
	} else {
		print "filepath: " . $filepath;
		print "<br>";
		print "path: " . $path;
		print "<br >File/path either doesn't exist or file/path is not readable";
	}
}