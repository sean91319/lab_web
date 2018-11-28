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
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
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
	      <li><span class="navitem account">S</span></li>
	    </ul>
	  </div>
	</div>
	<div class="accspace user">
	  <ul>
	    <li><a class="accitem">Account</a></li>
	    <li><a class="accitem"> </a></li>
	    <li><a class="accitem">Logout</a></li>
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
	</script>

	<br>
	<br>
	<br><br><br>
	<form method="POST" action="upload.php" enctype="multipart/form-data">
	
	<div>TXT</div>
	<!-- <br> -->
	<input type="file" name="file1">
	<div>WAV</div>
	<!-- <br> -->
	<input type="file" name="file2">
	<input type="submit" value="Upload">


	</form>

	<?php
		
	$files = scandir("uploadfiles/");
	for ($a=2; $a < count($files); $a++) { 
			
		?>
		<p>
			<?php echo $a - 1; ?>. 
			<a href="uploads/<?php echo $files[$a] ?>"><?php echo $files[$a] ?></a>
		</p>
		<?php

	}
	?>
	<form method="POST" action="dfile.php">
		
		<input type="text" name="dfile" placeholder="輸入欲刪除之檔案名稱">
		<input type="submit" value="Delete">

	</form>

	<br>
	<a href="sh/index.php">process</a>
	
</body>
</html>