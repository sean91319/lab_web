<?php
	echo $_COOKIE["user"];

	$User = $_COOKIE["user"];
	$Num = $_POST['num'];

	$mysqli = mysqli_connect("localhost", "root", "root" , "address");
	if (mysqli_connect_error()) {
		die('Connect Error ('.mysqli_connect_errno().') '.mysqli_connect_error());
	}
	$sql_query_login="SELECT * FROM person WHERE Email= '$User'";
	$result=mysqli_query($mysqli,$sql_query_login) or die("查詢失敗");
	$row = mysqli_fetch_row($result);

	// echo $Num;
	// echo $row[7];

	if ($Num == $row[7]) {
		
		echo"<script>alert('認證成功，請輸入新密碼！');location.href='password3.html';</script>";



	}

	else{

		echo"<script>alert('認證碼錯誤！');location.href='password2.html';</script>";
		//echo '<meta http-equiv=REFRESH CONTENT=1;url=confirm.php>';

	}


?>