<?php 


	$id = $_GET["id"];
	$username = $_COOKIE["username"];
	$json_loc = $username."/json/".$id."_json/step_data.json";

	$json = file_get_contents($json_loc);
	$json_data = json_decode($json);


	echo "以下是 ";
	echo $id;
	echo " 的腳本內容<br><br><br>";


	for ($i=0; $i < count($json_data); $i++) { 
		echo $i+1;
		echo ".&nbsp;步驟名稱：";
		echo $json_data[$i]->{'stepName'};
		echo "<br>&nbsp;&nbsp;&nbsp;指令：";
		echo $json_data[$i]->{'stepScript'};
		echo "<br>";
		echo "<br>";


	}

 ?>



<!-- <!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>TEXT</title>
</head>
<body>
	
</body>
</html> -->