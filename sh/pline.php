<?php 
	
	$username = $_COOKIE["username"];
	$process_name = $_GET["id"];
	$json_location = $username."/json/".$process_name."_json";
	$url = $json_location."/process.php";
	setcookie("userProcess",$process_name,time()+3600*24*7);
	setcookie("userProcessLocation",$json_location,time()+3600*24*7);

	set_time_limit(0);
	header ( 'Connection: close' );
	ob_start ();
	header ( 'Content-Length: 0' );
	header( "Location: $url" );
	ob_end_flush ();
	flush ();
	ignore_user_abort(true);


	//----------------------------------------------------//

	function sendmail($To,$message){
		require_once('./PHPMailer_5.2.2/class.phpmailer.php');
	    $name=$username;


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

	//----------------------------------------------------//



	$json = file_get_contents($json_location."/step_data.json");
	$step_data_json = json_decode($json);

	$step_script = array();
	$step_name = array();
	$total_steps = $step_data_json[0]->{'total_steps'};
	$scriptFile = $step_data_json[0]->{'scriptFile'};

	for ($i=0; $i < $total_steps; $i++) { 
		$step_script[$i] = $step_data_json[$i]->{'stepScript'};
		$step_name[$i] = $step_data_json[$i]->{'stepName'};
	}


	chdir($json_location);  // 移至username/json/xxx_json



	$rm_step_complete = "step_complete.json";
	$rm_exe_output = "exe_output.json";

	$rm1= shell_exec("rm -f $rm_step_complete");
	$rm2= shell_exec("rm -f $rm_exe_output");



	chdir("..");
	chdir("..");
	chdir("..");   // 移至 sh
	

	// echo "開始執行";

	// $loc = $username."/".$scriptFile;
	// chdir($loc);

	// $exe = shell_exec($step_script[0]."2>&1");


	//---------------------------------------------------//


	$mysqli = mysqli_connect("localhost", "root", "root" , "address");
	if (mysqli_connect_error()) {
		die('Connect Error ('.mysqli_connect_errno().') '.mysqli_connect_error());
	}
	$sql_query_login="SELECT * FROM person WHERE Nickname= '$username'";
	$result=mysqli_query($mysqli,$sql_query_login) or die("查詢失敗");
	$row = mysqli_fetch_row($result);

	$Email = $row[2];

	// echo $Email;



	//---------------------------------------------------//



	for ($i=0; $i < $total_steps; $i++) {

		$loc = $username."/".$scriptFile;
		chdir($loc);



		$exe = shell_exec($step_script[$i]."2>&1");


		$exe_print = [
			"stepname" => $step_name[$i],
			"exeoutput" => $exe,
		];

		$exe_output[$i] = $exe_print;
		chdir("..");
		chdir("..");

		// $pwd = shell_exec("pwd");
		// echo "<br><br>pwd3: ";
		// echo $pwd;


		$json_exe_output = json_encode($exe_output); 	//把個步驟輸出值print到json檔中
		$json_exe_output_location = $json_location."/exe_output.json";
		file_put_contents($json_exe_output_location,$json_exe_output);

		if(preg_match("/error/i", $exe))
		{
			$data_array = [
			 "name" => $step_name[$i],
			 "done" => false,
			];
			$message = "Dear ".$Name."<br>您的程序 ".$process_name." 發生錯誤，請盡快回到網站查看！<br><br>";

			sendmail($Email,$message);
			exit();
		}
		else
		{
			$data_array = [
			 "name" => $step_name[$i],
			 "done" => true,
			];
		}


		$data[$i] = $data_array;
		$json_step_complete = json_encode($data); // 寫入文件 
		$json_step_complete_location = $json_location."/step_complete.json";
		file_put_contents($json_step_complete_location, $json_step_complete);

	}	


	
	$message = "Dear ".$username."<br>您的程序 ".$process_name." 已完成，請回到網站查看謝謝！<br><br>";

	sendmail($Email,$message);



 ?>