<?php
// 關閉系統提示
	error_reporting(0);
	session_start();

	$userProcess = $_COOKIE["userProcess"];
	$userProcessLocation = $_COOKIE["userProcessLocation"];


	if(isset($_SESSION['username'])==FALSE) {

		ob_start();
		
		echo"<script>alert('請先登入！');</script>";

 		header('Location: ../login.html');
 		exit();

	}


	else{


		if($_COOKIE["userProcess"]!=NULL){


			ob_start();
		
			echo"<script>alert('已執行！');</script>";

			$loc = $userProcessLocation."/process.php";

 			header("Location: $loc");
			
	 		exit();
		}
		else{
			echo "<br><br><br><br><br>";
			// echo"<script>alert('無已執行的程序！');</script>";
		}



			echo "<br>";
			echo "Hi, ";
			echo $_SESSION["username"];
			$username = $_SESSION["username"];
			$process_url = "http://localhost:8888/lab_web/sh/json.php?type=get&name=processname";
			echo "<script>\r\n"; 
			echo "process_url=\"$process_url\";\r\n"; 
			echo "</script>\r\n"; 


	}

////////-----------------------------------------------------------------------///////




////////-----------------------------------------------------------------------///////


	
	$username=$_COOKIE["username"];
	echo "<script>\r\n"; 
	echo "username=\"$username\";\r\n"; 
	echo "</script>\r\n"; 


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
	      <li><a class="navitem link-2 active" href="">Process</a></li>
	      <li><a class="navitem link-3" href="http://120.126.142.147:8181">Gitlab</a></li>
	      <li><span class="navitem account" id="accname">S</span></li>
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

		$("#accname").text(username.substr(0,1));
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
		<iframe name="iframe_a" id="iframe" frameborder="0" style="width: 500px; height: 500px; margin: 30px; border: solid 3px #aaa;"></iframe>
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

		///////

		var process_template = "<li id={{id1}} class='lll'><a class='past_script' href='{{link1}}?id={{id2}}'>{{name}}</a><a class='view' href='text_display.php?id={{iframe_id}}' target='iframe_a'>View</a><a href='{{link2}}?id={{delitem}}' id={{del_id}} data-del-id='{{delid}}' class='del_btn'>x</a></li>";
		var data=[];

		$.ajax({
			url: process_url,
			success: function(res){

				data=JSON.parse(res);
				showlist();

			}
		});

		function showlist(){

			for(i=0;i<data.length;i++){

				var item=data[i];
				var item_id=data[i].process_name;
				var del_item_id="del_item_"+i;

				var now_process = process_template.replace("{{name}}", item_id)
												  .replace("{{id1}}", item_id)
												  .replace("{{id2}}", item_id)
												  .replace("{{del_id}}", del_item_id)
												  .replace("{{delid}}", i)
												  .replace("{{link1}}", "pline.php")
												  .replace("{{link2}}", "del_script.php")
												  .replace("{{delitem}}", item_id)
												  .replace("{{iframe_id}}", item_id);



				$("#process_list").append(now_process);

			}

		}

		showlist();


		//
		



	</script>
</body>
</html>
