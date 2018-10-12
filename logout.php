<?php
	
	session_start();
	echo $_SESSION['username'];
	unset($_SESSION['username']);


	header('Location:login.html');

?>