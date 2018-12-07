<?php 
	
	$username = $_COOKIE["username"];
	$process_name = $_GET["id"];

	ob_start();
	header("Location: index.php");

	// echo $process_name;
	// echo "<br>";

	$json = file_get_contents($username."/process.json");
	$json_data = json_decode($json);

	// echo $json;

	// echo $json_data[0]->{'process_name'};

	$del_num;

	for ($i=0; $i < count($json_data); $i++) { 
		
		if (preg_match("/$process_name/i", $json_data[$i]->{'process_name'})) {
			$del_num = $i;
		}
		else{
			
		}	

	}


	// echo $json;
	// echo "<br>";

	$del_process_file = $username."/json/".$process_name."_json";

	unset($json_data[$del_num]);
	$json_data = array_values($json_data);
	$exe=shell_exec("rm -r $del_process_file");



	$new_json = json_encode($json_data);
	file_put_contents($username."/process.json", $new_json);

 ?>