<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>AJAXTEST</title>
	<script src="jquery.js"></script>

</head>
<body>
	<p id="ppp"></p>	
	<script>
		$.ajax({
			url: "http://localhost:8888/lab_web/sh/json.php?type=get&name=processname",
			success: function(res){
				data=JSON.parse(res);
				$("#ppp").text(res);
			}
		})
	</script>
</body>
</html>