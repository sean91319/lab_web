<?php
	
	session_start();

	if ($_SESSION['username'] != NULL) {
		echo "session---username: ";
		echo $_SESSION['username'];
		echo "<br>";
	}

	else{
		echo "soooo";
	}


	if ($_COOKIE["username"] != NULL) {
		echo "cookie---username: ";
		echo $_COOKIE["username"];
		echo "<br>";

	}
	else{
		echo "coooo";
	}
?>