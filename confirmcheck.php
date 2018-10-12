<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>註冊</title>

</head>

<?php
	echo $_COOKIE["user"];

	$User = $_COOKIE["user"];
	$Num = $_POST['num'];

	$mysqli = mysqli_connect("localhost", "root", "root" , "address");
	if (mysqli_connect_error()) {
		die('Connect Error ('.mysqli_connect_errno().') '.mysqli_connect_error());
	}
	$sql_query_login="SELECT * FROM person WHERE Nickname= '$User'";
	$result=mysqli_query($mysqli,$sql_query_login) or die("查詢失敗");
	$row = mysqli_fetch_row($result);

	$isConfirm = "yes";
	$sql = "UPDATE `person` SET `isConfirm` = '$isConfirm'  WHERE `Nickname` = '$User'";

	// echo "數字：";
	// echo $Num;
	// echo "資料庫數字：";
	// echo $row[7];
	// echo "使用者：";
	// echo $User;
	// echo "資料庫使用者：";
	// echo $row[1];

	if ($Num == $row[7]) {
		

		if ($mysqli->query($sql) === TRUE) {

			echo"<script>alert('認證成功，請重新登入！');location.href='login.html';</script>";

		}


	}

	else{

		echo"<script>alert('認證碼錯誤！');location.href='confirm.php';</script>";
		//echo '<meta http-equiv=REFRESH CONTENT=1;url=confirm.php>';

	}


?>
	
<script>
function jump(){
		window.location.assign("login.html");
}
</script>
<body>
認證中...
</body>
</html>