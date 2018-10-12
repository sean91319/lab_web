<?php
//關閉系統提示
	error_reporting(0);
	session_start();

	if(isset($_SESSION['username'])==FALSE) {

		echo"<script>alert('請先登入！');</script>";

 		header('Location: login.html');

	}

	else
		echo $_SESSION['username'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
</head>
<body>

	<form method="POST" action="upload.php" enctype="multipart/form-data">
	
	<div>TXT</div>
	<br>
	<input type="file" name="file1">
	<div>WAV</div>
	<br>
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

	<a href="logout.php">logout</a>
	
</body>
</html>



