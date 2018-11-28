<?php session_start(); 	ob_start();?>

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
	$Firstlogin = "no";
	$sql = "UPDATE `person` SET `Firstlogin` = '$Firstlogin'  WHERE `Nickname` = '$username'";
	
	if($username== $row[1] && $password==$row[3] && $row[8]=="yes"){

		if($row[9]=="yes"){
			if ($mysqli->query($sql) === TRUE) {
				$_SESSION['username'] = $username;
				setcookie("username", $username, time()+3600)or die('unable to create cookie');

				$mkdir1 = shell_exec("mkdir sh/$username");
				$mkdir2 = shell_exec("mkdir sh/$username/json");


				echo"<script>alert('歡迎第一次登入！');location.href='index.php';</script>";
			}
		}
		else{

			$_SESSION['username'] = $username;
			setcookie("username", $username, time()+3600*7*24)or die('unable to create cookie');
			
			echo"<script>alert('登入成功！');location.href='index.php';</script>";

		}


		
	}

	elseif ($row[8]=="no") {

		// echo $username;

		setcookie("user", $username, time()+3600*24*7)or die('unable to create cookie');

		// echo $_COOKIE["user"];

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