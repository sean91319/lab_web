<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
	<script src="jquery.js"></script>

</head>
<body>
	
	<!-- <div class="a">qq</div> -->
	<div id="demo">demo</div>
	
<?php 

	$value="abc"; 
	$data=array("aqefe","bqefqefq","cqefqef");
	echo $data[1];
	echo "<script>\r\n"; 
	echo "value=\"$data\";\r\n"; 
	echo "</script>\r\n"; 
 ?>

 <script>

		$("#demo").text(value[1]);

 </script>


</body>
</html>