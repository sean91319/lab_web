<?php
// 關閉系統提示
	error_reporting(0);
	session_start();

	if(isset($_SESSION['username'])==FALSE) {

		ob_start();
		
		echo"<script>alert('請先登入！');</script>";

 		header('Location: login.html');
 		exit();

	}

	else
		echo $_SESSION['username'];



	$username=$_COOKIE["username"];
	echo "<script>\r\n"; 
	echo "username=\"$username\";\r\n"; 
	echo "</script>\r\n"; 

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>524LAB</title>
	<link rel="stylesheet" href="style/stylesheets/nav.css">
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Teko">
	<script src="jquery.js"></script>
</head>
<body>

	
	<div class="topbar">
	  <div class="logo">524LAB</div>
	  <div class="nav">
	    <ul>
	      <li><a class="navitem link-1 active" href="#home">Home</a></li>
	      <li><a class="navitem link-2" href="sh/index.php">Process</a></li>
	      <li><a class="navitem link-3" href="http://120.126.142.147:8181">Gitlab</a></li>
	      <li><span class="navitem account" id="accname">S</span></li>
	    </ul>
	  </div>
	</div>
	<div class="accspace user">
	  <ul>
	    <li><a class="accitem">Account</a></li>
	    <li><a class="accitem"> </a></li>
	    <li><a class="accitem" href="logout.php">Logout</a></li>
	  </ul>
	</div>
	<div class="tri user"></div>
	<div class="trib user"></div>
	
	<script>
		$(document).ready(function(){
		    $(".account").click(
			    function(){
			      $(".user").toggle();
			    }
		  	);
		});

		$("#accname").text(username.substr(0,1));

	</script>

	
</body>
</html>



