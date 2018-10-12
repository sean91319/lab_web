<?php

	function sendmail($To,$message){
		require_once('./PHPMailer_5.2.2/class.phpmailer.php');
	    $Email = $_POST['email'];


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
	    $mail->Subject ="SpeechLAB 忘記密碼認證信"; //郵件標題
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
	

	$Email = $_POST['email'];
	$randnum = rand(1000,9999);

	$mysqli = mysqli_connect("localhost", "root", "root" , "address");
	if (mysqli_connect_error()) {
		die('Connect Error ('.mysqli_connect_errno().') '.mysqli_connect_error());
	}
	$sql_query_login="SELECT * FROM person WHERE Email= '$Email'";
	$result=mysqli_query($mysqli,$sql_query_login) or die("查詢失敗");
	$row = mysqli_fetch_row($result);


	echo $Email;
	echo $row[2];
	echo $randnum;

	if ($Email==$row[2]) {       //確認是否已註冊
		setcookie("user", $Email, time()+3600);


		$sql="UPDATE `person` SET `Rand_Num` = '$randnum'  WHERE `Email` = '$Email'";  //設定認證碼


		if ($mysqli->query($sql) === TRUE) {   //確認已把認證碼存入資料庫
			$message = "Dear ".$row[0]."<br>以下是您的認證碼：<br><br><h1>認證碼:".$randnum."</h1><br><br>請至系統輸入認證碼並更改密碼。";

			if(sendmail($Email,$message))
			{echo "<script>alert('已發送認證信，請至信箱查看認證碼!');location.href='password2.html'</script>";}

			else{

				echo "<script>alert('網路問題導致信件發送出現錯誤，請重新操作!');location.href='login.html'</script>"

			}


		} 



	}
	else {
		echo"<script>alert('查無此信箱，請先註冊！');location.href='register.php';</script>";
	}


?>