<?php
	

	$Email = $_COOKIE["user"];
	$Pwd = $_POST['password'];

	$mysqli = mysqli_connect("localhost", "root", "root" , "address");
	if (mysqli_connect_error()) {
		die('Connect Error ('.mysqli_connect_errno().') '.mysqli_connect_error());
	}
	$sql_query_login="SELECT * FROM person WHERE Email= '$Email'";
	$result=mysqli_query($mysqli,$sql_query_login) or die("查詢失敗");
	$row = mysqli_fetch_row($result);


	echo $Email;

	$sql="UPDATE `person` SET `Password` = '$Pwd'  WHERE `Email` = '$Email'";  //設定認證碼

	if ($mysqli->query($sql) === TRUE){

		echo "<script>alert('密碼已更新，請重新登入。');location.href='login.html'</script>";

	}

	else{
		echo "<script>alert('error...')";
	}


?>