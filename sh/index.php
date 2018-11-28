<?php
// 關閉系統提示
	error_reporting(0);
	session_start();

	if(isset($_SESSION['username'])==FALSE) {

		ob_start();
		
		echo"<script>alert('請先登入！');</script>";

 		header('Location: ../login.html');
 		exit();

	}

	else{
		echo "Hi, ";
		echo $_SESSION["username"];
		echo "<br><br><br>";
		$username = $_SESSION["username"];
		$process_url = "http://localhost:8888/lab_web/sh/json.php?type=get&name=processname";
		echo "<script>\r\n"; 
		echo "process_url=\"$process_url\";\r\n"; 
		echo "</script>\r\n"; 
	}

	


 ?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>post</title>
	<script src="jquery.js"></script>
	<style>
		.add,.remove{border: 1px solid black;cursor: pointer;}
		input{height: 30px;width: 300px;margin: 10px;}
	</style>
	<link rel="stylesheet" href="style/stylesheets/nav.css">
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Teko">
	<link rel="stylesheet" href="style/stylesheets/script.css">


</head>
<body>

	<div class="topbar">
	  <div class="logo">524LAB</div>
	  <div class="nav">
	    <ul>
	      <li><a class="navitem link-1" href="../">Home</a></li>
	      <li><a class="navitem link-2 active" href="sh/index.php">Process</a></li>
	      <li><a class="navitem link-3" href="http://120.126.142.147:8181">Gitlab</a></li>
	      <li><span class="navitem account">S</span></li>
	    </ul>
	  </div>
	</div>
	<div class="accspace user">
	  <ul>
	    <li><a class="accitem">Account</a></li>
	    <li><a class="accitem"> </a></li>
	    <li><a class="accitem" href="../logout.php">Logout</a></li>
	  </ul>
	</div>
	<div class="tri user"></div>
	<div class="trib user"></div>
	
	<script>
		$(document).ready(function(){
	    $(".account").click(
	    function(){
	      $(".user").toggle();
	    }
	  );
	  
	});
	</script>

	<br><br><br>
	
	<div class="container">
		<span class="add">ADD SCRIPT</span>
		<br>
		<span class="remove">Del SCRIPT</span>

		<form action="pline_fst.php" method="post" name="arr">

			<div>請輸入此次執行的名稱：<input type="text" name="userProcess"></div>
			<div>請輸入此次執行的資料夾名稱：<input type="text" name="scriptFile"></div>


			<ol class="script_list">
				<li id="a">
					<input type="text" name="a_step" placeholder="步驟名稱"><br>
					<input type="text" name="a_script" placeholder="指令"><br>
				</li>
			<!-- <li>
					<input type="text" name="b_step" placeholder="步驟名稱"><br>
					<input type="text" name="b_script" placeholder="指令"><br>
				</li>
				<li>
					<input type="text" name="c_step" placeholder="步驟名稱"><br>
					<input type="text" name="c_script" placeholder="指令"><br>
				</li> -->
			</ol>

			<br>
			
	        <input type="submit" class="button" id="post" value="post">
		</form>

		<div>先前執行過的版本：</div>
		<div class="scriptList">
			<ul id="process_list">
	<!-- 			<li>
					<a href="">aaa</a>
				</li> -->
			</ul>
		</div>
	</div>


	<script>
		var script_num = 97;   //ascii
		// var script_template = "<li><input type='text' name={{name}}><br></li>";
		var script_template ="<li id={{id}}><input type='text' name={{step}} placeholder='步驟名稱'><br><input type='text' name={{script}} placeholder='指令'><br></li>"

		$(".add").click(
			function(){
				script_num++;
				var now_name=String.fromCharCode(script_num); //新li的name的ascii

				var now_script = script_template.replace("{{id}}", now_name)
												.replace("{{step}}",now_name + "_step")
												.replace("{{script}}",now_name + "_script");

				$(".script_list").append(now_script);


			}
			);

		$(".remove").click(
			function(){
				
				var now_name=String.fromCharCode(script_num); //新li的name的ascii

				$("#"+now_name).remove();

				script_num--;

			}
			);

		var process_template = "<li><a href='{{link}}?id={{id}}'>{{name}}</a></li>"

		$.ajax(
			{
				url: process_url,
				success: function(res){

					data=JSON.parse(res);

					for(i=0;i<data.length;i++){

						var item=data[i];

						var now_process = process_template.replace("{{name}}", data[i].process_name)
														  .replace("{{id}}", data[i].process_name)
														  .replace("{{link}}", "pline.php");

						$("#process_list").append(now_process);


					}

				}
			}
		)


	</script>
</body>
</html>
