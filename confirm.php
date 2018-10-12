<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>註冊</title>
	<link rel="stylesheet" href="css/confirm.css">

</head>


<body>

	<?php 
		echo $_COOKIE["user"]
	?>

	<form action="confirmcheck.php" method="post" name="register" class="box">
		
		<div class="text"> 請輸入信件中的認證碼：</div>
		<input type="text" name="num" class="line"><br>
		<input type="submit" name="button" class="button"><br>
		</div><br>


	</form>
	
</body>
</html>