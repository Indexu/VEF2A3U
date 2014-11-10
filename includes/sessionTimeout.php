<?php

if(isset($_SESSION['timeout'])){

	if ($_SESSION['timeout'] + 30 * 60 < time()) {
		unset($_SESSION['timeout']);
	    header('Location: log_out.php');
		die();
	}
	else{
	     $_SESSION['timeout'] = time();
	}
}