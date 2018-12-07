<?php 

	setcookie("userProcess","",time()-100);
	setcookie("userProcessLocation","",time()-100);
	// echo "del_process";

	ob_start();
	header("Location: index.php")



 ?>