<?php
require_once('totsekkidbcon/ekkidbcon.php');
unset($_SESSION['user']);

header("Location: index.php");
die("Redirecting to front page");