<?php
	
	session_start();

	if ($_SESSION['username'] != NULL) {
		echo "session---username: ";
		echo $_SESSION['username'];
		echo "<br>";
	}

	else{
		echo "soooo";
		echo "<br>";
	}


	if ($_COOKIE["username"] != NULL) {
		echo "cookie---username: ";
		echo $_COOKIE["username"];
		echo "<br>";

	}
	else{
		echo "coooo";
		echo "<br>";
	}

	if ($_COOKIE["userProcess"] != NULL) {
		echo "cookie---userProcess: ";
		echo $_COOKIE["userProcess"];
		echo "<br>";

	}
	else{
		echo "NONONONOuserProcess";
		echo "<br>";
	}

	if ($_COOKIE["userProcessLocation"] != NULL) {
		echo "cookie---userProcessLocation: ";
		echo $_COOKIE["userProcessLocation"];
		echo "<br>";

	}
	else{
		echo "NONONONOuserProcessLocation";
		echo "<br>";
	}

	echo $_COOKIE["userProcessLocation"];



?>