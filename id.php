<?php
	
	session_start();

	if ($_SESSION['username'] != NULL) {
		echo $_SESSION['username'];
	}

	else{
		echo "boooo";
	}


	if ($_COOKIE["user"] != NULL) {
		echo $_COOKIE["user"];	
	}
	else{
		echo "coooo";
	}
?>