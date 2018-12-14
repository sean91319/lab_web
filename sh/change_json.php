<?php 


	$id = $_GET["id"];
	$scriptFile = $_GET["file"];
	$username = $_COOKIE["username"];

	header("Location: text_display.php?id=$id");

	echo $id;
	echo "<br>";
	echo $file;
	echo "<br>";

	$total_steps = 0;
	$step_num=0;
	$sname_num=0;
	$step_name = array();  //用來存每步驟的名字
	$step = array(); //用來存每步驟的script

	foreach ($_POST as $key => $value) {

		$$key = $value;


		if ($total_steps%2 == 1) {  //把script寫入$step的array
			$step[$step_num]=$$key;
			$step_num++;

		}
		elseif ($total_steps%2 == 0) {  //把step名稱寫入$step_name的array
			$step_name[$sname_num]=$$key;
			$sname_num++;
		}	
	
		$total_steps++;

	}


	if($total_steps%2==1){
		$total_steps=($total_steps+1)/2;
	}
	elseif ($total_steps%2==0) {
		$total_steps=$total_steps/2;
	}


	for ($i=0; $i < $total_steps; $i++) { 

		$step_value[$i] = [
		"total_steps" => $total_steps,
		"stepScript" => $step[$i],
		"stepName" => $step_name[$i],
		"scriptFile" => $scriptFile,
		];
	}

	$json_step_data = json_encode($step_value);
	$json_step_data_location = $username."/json/".$id."_json/step_data.json";

	echo $json_step_data;
	echo "<br>";
	echo $json_step_data_location;
	echo "<br>";

	file_put_contents($json_step_data_location, $json_step_data);



 ?>