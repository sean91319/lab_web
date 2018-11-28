<?php 
	session_start();
	$username = $_SESSION['username'];

	$mkdir1 = shell_exec("mkdir $username'/json/");



 ?>