<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>FINISH</title>
</head>

<?php

	function sendmail($To,$message){
		require_once('./PHPMailer_5.2.2/class.phpmailer.php');
	    $name=$_POST['name'];
	    $email=$_POST['email'];


	    $mail= new PHPMailer();                          //建立新物件
	    $mail->IsSMTP();                                    //設定使用SMTP方式寄信
	    $mail->SMTPAuth = true;                        //設定SMTP需要驗證
	    $mail->SMTPSecure = "ssl";                    // Gmail的SMTP主機需要使用SSL連線
	    $mail->Host = "smtp.gmail.com";             //Gamil的SMTP主機
	    $mail->Port = 465;                                 //Gamil的SMTP主機的埠號(Gmail為465)。
	    $mail->CharSet = "utf-8";                       //郵件編碼
	    $mail->Username = "sean91329@gmail.com"; //Gamil帳號
	    $mail->Password = "chi232chi232";                 //Gmail密碼
	    // $mail->From = "XXXX@gmail.com";        //寄件者信箱
	    // $mail->FromName = "XXXX";                  //寄件者姓名
	    $mail->Subject ="來自".$name."留言"; //郵件標題
	    $mail->Body = $message; //郵件內容
	    $mail->IsHTML(true);                             //郵件內容為html
	    $mail->AddAddress($To);            //收件者郵件及名稱
	    if(!$mail->Send()){
	        return false;
	    }else{
	        return true;
	    }
	}
?>




<?php
	$mysqli = mysqli_connect("localhost", "root", "root" , "address");
	if (mysqli_connect_error()) {
	    die('Connect Error ('.mysqli_connect_errno().') '.mysqli_connect_error());
	}

	$sql_query_login="SELECT * FROM person ";
	$result=mysqli_query($mysqli,$sql_query_login) or die("查詢失敗");

	$randnum = rand(1000,9999);
	$isConfirm = "no";

	$Name = $_POST['name'];
	$Nickname = $_POST['nickname'];
	$Email = $_POST['email'];
	$Password = $_POST['password'];
	$Company = $_POST['company'];
	$Position = $_POST['position'];
	$Phone = $_POST['phone'];


	$sql="INSERT INTO person (Name, Nickname, Email, Password, Company, Position, Phone, Rand_Num, isConfirm) VALUES('$Name','$Nickname', '$Email', '$Password', '$Company', '$Position', '$Phone', '$randnum', '$isConfirm')";
	

	if ($mysqli->query($sql) === TRUE) {
		$message = "Dear ".$Name."<br>感謝您的註冊，以下是您的認證碼：<br><br><h1>認證碼:".$randnum."</h1>";

			if(sendmail($Email,$message))
			echo "<script>alert('恭喜註冊成功，請至信箱查看認證碼!');</script>";
	} 

	else {
	    echo "Error: " . $sql . "<br>" . $mysqli->error;
	}

	setcookie("user", $Nickname, time()+3600);



?>

<script>
function jump(){
		window.location.assign("confirm.php");
}
</script>
<body onload=jump()>
<p>信件發送中，請稍後...</p><img width="1" height="1" id = 'iig' src='authimg.php' >

</body>
</html>