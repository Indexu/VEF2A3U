<?php


// ----------------- BANNER ---------------------
$banner = [

	["ledtv.jpg", "I want a new tv"],
	["phone.jpg", "Listen to your phone"],
	["transistors.jpg", "My motherboard is dying"],
	["ubuntu.jpg", "I want to know linux"]

];

if(isset($_SESSION['last_image'])) {
	foreach ($banner as $key => $val) {
       if ($val[0] == $_SESSION['last_image']) {
           unset($banner[$key]);
       }
   }
}

$image = 0;

shuffle($banner);
$image = "img/banner/" . $banner[0][0];
$caption = $banner[0][1];

$_SESSION['last_image'] = $banner[0][0];


// -------------- CURRENT PAGE ----------------
$currentPage = basename($_SERVER['SCRIPT_FILENAME']);


// ------------- LOGGED IN CHECK --------------
function check_login()
{
	if(isset($_SESSION['user'])){
		return true;
	}
	else{
		return false;
	}
}