<?php require('login.php');

	if(!empty($_SESSION['user'])){
		include('login_ok.php');
	}

	else{
		include('login_form.php');
	}