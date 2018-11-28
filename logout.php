<?php
	// ob_start();
	session_start();
	header('Location: login.html');
	// echo $_SESSION['username'];
	unset($_SESSION['username']);
	setcookie("user", "", time() - 100)or die('unable to create cookie');
	// session_destroy();
	// ob_end_flush();


?>
