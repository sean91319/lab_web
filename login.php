<?php session_start(); ?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>註冊</title>

</head>

<?php

	header('Content-Type: text/html; charset=utf-8');
	$username=$_POST['account'];
	$password=$_POST['password'];

	$mysqli = mysqli_connect("localhost", "root", "root" , "address");
	if (mysqli_connect_error()) {
		die('Connect Error ('.mysqli_connect_errno().') '.mysqli_connect_error());
	}

	$sql_query_login="SELECT * FROM person WHERE Nickname='$username'";
	$result=mysqli_query($mysqli,$sql_query_login) or die("查詢失敗");
	$row = mysqli_fetch_row($result);

	// echo  $row[1];
	// echo  $row[3];

	// echo $username;
	// echo $password;

	
	if($username== $row[1] && $password==$row[3] && $row[8]=="yes"){

		$_SESSION['username'] = $username;

		echo"<script>alert('登入成功！');location.href='index.php';</script>";


		
	}

	elseif ($row[8]=="no") {
		setcookie("user", $username, time()+3600);
		echo"<script>alert('請先輸入信箱中的認證碼！');location.href='confirm.php';</script>";
	}
			
	else{

		echo"<script>alert('帳號或密碼錯誤！');location.href='login.html';</script>";
		//echo '<meta http-equiv=REFRESH CONTENT=1;url=login.html>';
	}



	mysqli_free_result($result);
			
	$mysqli->close();	

?>
	
<script>
function jump(){
		window.location.assign("index.php");
}
</script>
<body>

</body>
</html>