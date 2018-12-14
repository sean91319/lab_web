<?php 

	$username=$_COOKIE["username"];
	$id=$_GET['id'];
	$file=$_GET['file'];

	// echo $id;
	// echo "<br>";

	// echo $file;
	// echo "<br>";


	$data = $username."/".$file."/".$id;


	// echo $data;
	// echo "<br>";

	$myfile = nl2br(file_get_contents($data)) or die("Unable to open file!");
	echo $myfile;

 ?>