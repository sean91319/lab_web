<?php
	
	$dfile = $_POST['dfile'];

	// $output = shell_exec('sudo rm /uploadfiles/HW1.wav');
	// $output = shell_exec('ls');

	echo $dfile;

	$output = shell_exec("cd uploadfiles/; rm $dfile; ls");

	echo "<pre>$output</pre>";

	header("Location: index.php");

?>
