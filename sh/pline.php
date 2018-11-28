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
	
	$pwd = shell_exec("pwd");
	echo "pwd1: ";
	echo $pwd;

	// echo "開始執行";

	// $loc = $username."/".$scriptFile;
	// chdir($loc);

	// $exe = shell_exec($step_script[0]."2>&1");


	//---------------------------------------------------//


	for ($i=0; $i < $total_steps; $i++) {

		$loc = $username."/".$scriptFile;
		chdir($loc);

		$pwd = shell_exec("pwd");
		echo "<br><br>pwd2: ";
		echo $pwd;

		$exe = shell_exec($step_script[$i]."2>&1");


		$exe_print = [
			"stepname" => $step_name[$i],
			"exeoutput" => $exe,
		];

		$exe_output[$i] = $exe_print;
		chdir("..");
		chdir("..");

		$pwd = shell_exec("pwd");
		echo "<br><br>pwd3: ";
		echo $pwd;


		$json_exe_output = json_encode($exe_output); 	//把個步驟輸出值print到json檔中
		$json_exe_output_location = $json_location."/exe_output.json";
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
		$json_step_complete_location = $json_location."/step_complete.json";
		file_put_contents($json_step_complete_location, $json_step_complete);

	}	



 ?>