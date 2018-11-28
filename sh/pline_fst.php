<?php 

	$username = $_COOKIE["username"];


	/////----------讀POST值-----------/////

	$total_steps = 0;
	$step_num=0;
	$sname_num=0;
	$step_name = array();  //用來存每步驟的名字
	$step = array(); //用來存每步驟的script

	foreach ($_POST as $key => $value) {

		$$key = $value;

		// echo $value;
		// echo "<br>";
		// echo $total_steps;
		// echo "<br>";


		if ($total_steps!=0 && $total_steps!=1) {

			if ($total_steps%2 == 1) {  //把script寫入$step的array
			$step[$step_num]=$$key;
			$step_num++;

			}
			elseif ($total_steps%2 == 0) {  //把step名稱寫入$step_name的array
				$step_name[$sname_num]=$$key;
				$sname_num++;
			}	
		}
		$total_steps++;

	}

	// echo $userProcess;

	// echo "step_name[0]<br>";
	// echo $step_name[0];
	// echo "<br>";
	// echo "step_name[1]<br>";
	// echo $step_name[1];
	// echo "<br>";


	$total_steps = ($total_steps-2)/2; //總步驟數
	// echo $total_steps;


	/////-----------------------------建立專屬資料夾、頁面跳轉-----------------------------/////


	$mkdir = shell_exec("mkdir $username/json/$userProcess'_json'");  //建立此次process的json資料夾
	$user_json_file = $username."/json/".$userProcess."_json";  //json資料夾名稱
	$cpjson = shell_exec("cp json.php $user_json_file"); //複製json.php到此次process的json資料夾中
	$cpjson = shell_exec("cp process.php $user_json_file"); //複製process.php到此次process的json資料夾中
	$url = $user_json_file."/process.php"; //頁面跳轉

	setcookie("userProcess",$userProcess,time()+3600*24*7);
	setcookie("userProcessLocation",$user_json_file,time()+3600*24*7);

	set_time_limit(0);
	header ( 'Connection: close' );
	ob_start ();
	header ( 'Content-Length: 0' );
	header( "Location: $url" );
	ob_end_flush ();
	flush ();
	ignore_user_abort(true);

	// header("Location: $url");

	$json_process_location = $username."/process.json";

	$json = file_get_contents($username."/process.json");
	$proname_value = json_decode ($json, true);
	$len = count($proname_value);
	$proname_value[$len] = [
			"process_name" => $userProcess,
			"process_location" => $user_json_file,
		];
	$newdata = json_encode($proname_value);
	file_put_contents($json_process_location, $newdata);


	echo "程式執行中...<br>";
	echo "<script type='text/javascript'>";
	echo "window.location.href='$url'";
	// echo "setTimeout('window.location.href='$url'',3000);";
	echo "</script>"; 


	ini_set('output_buffering', 0);
	ini_set('zlib.output_compression', 0);
	if( !ob_get_level() ){ ob_start(); }
	else { ob_end_clean(); ob_start(); }

	flush();
	ob_flush();
	sleep(1);

	//////////////////--------------------執行程式-----------------------//////////////////
	

	$data = array();
	$step_value = array();
	$exe_output = array();
	// $final_step_script = array();


	for ($i=0; $i < $total_steps; $i++) { 

		$step_value[$i] = [
		"total_steps" => $total_steps,
		"stepScript" => $step[$i],
		"stepName" => $step_name[$i],
		"scriptFile" => $scriptFile,
		];
	}

	// echo $final_step_script[0];
	// echo $final_step_script[1];


	$json_step_data = json_encode($step_value);
	$json_step_data_location = $user_json_file."/step_data.json";

	// echo $json_step_data;

	file_put_contents($json_step_data_location, $json_step_data);

	for ($i=0; $i < $total_steps; $i++) { 

		$loc = $username."/".$scriptFile;
		chdir($loc);

		$exe = shell_exec($step[$i]."2>&1");  	//--------執行各項步驟

		// echo $exe;

		$exe_print = [
			"stepname" => $step_name[$i],
			"exeoutput" => $exe,
		];

		$exe_output[$i] = $exe_print;
		chdir("..");
		chdir("..");

		$json_exe_output = json_encode($exe_output);    	//把個步驟輸出值print到json檔中
		$json_exe_output_location = $user_json_file."/exe_output.json";
		file_put_contents($json_exe_output_location,$json_exe_output);

		if(preg_match("/error/i", $exe))
		{
			$data_array = [
			 "name" => $step_name[$i],
			 "done" => false,
			];
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
		$json_step_complete_location = $user_json_file."/step_complete.json";
		file_put_contents($json_step_complete_location, $json_step_complete);


		flush();
		ob_flush();
		sleep(1);


	}


 ?>
