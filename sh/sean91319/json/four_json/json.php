<?php
	session_start();
	$username = $_SESSION["username"];

	$complete_location = "step_complete.json";
	$data_location = "step_data.json";
	$exeout_location = "exe_output.json";
	$processname_location = $username."/process.json";


	if(isset($_GET["type"])){

		$type = $_GET["type"];
		$name = $_GET["name"];
		$data = $_GET["data"];


		$get_name_list = array();
		$get_name_list["complete"]=$complete_location;
		$get_name_list["data"]=$data_location;
		$get_name_list["exeout"]=$exeout_location;
		$get_name_list["processname"]=$processname_location;

		

		if($type=="get"){
			foreach ($get_name_list as $key => $value) {
				if($name==$key)
					echo file_get_contents($value);
			}
		}

	}


?>