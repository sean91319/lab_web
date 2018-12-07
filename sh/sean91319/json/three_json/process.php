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
	}


 ?>
<?php 

	// session_start();
	// $userProcess=$_SESSION["userProcess"];
	$username=$_COOKIE["username"];
	$userProcess=$_COOKIE["userProcess"];
	$userProcessLocation=$_COOKIE["userProcessLocation"];

	// echo $userProcess;
	// echo "<br>";
	// echo $userProcessLocation;
	// echo "<br>";

	$url_data = "http://localhost:8888/lab_web/sh/".$userProcessLocation."/json.php?type=get&name=data";
	$url_complete = "http://localhost:8888/lab_web/sh/".$userProcessLocation."/json.php?type=get&name=complete";
	$url_exeout = "http://localhost:8888/lab_web/sh/".$userProcessLocation."/json.php?type=get&name=exeout";


	// echo $url_data;
	// echo "<br>";
	// echo $url_complete;
	// echo "<br>";

	// echo $url_data;
	// echo $url_complete;

	echo "<script>\r\n"; 
	echo "now_user_process=\"$userProcess\";\r\n"; 
	echo "username=\"$username\";\r\n"; 
	echo "url_data=\"$url_data\";\r\n"; 
	echo "url_complete=\"$url_complete\";\r\n"; 
	echo "url_exeout=\"$url_exeout\";\r\n"; 
	echo "</script>\r\n"; 

 ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Process</title>
	<!-- <script src="jquery.js"></script> -->

	<script src="../../../jquery.js"></script>
	<link rel="stylesheet" href="../../../style/stylesheets/script.css">
	<link rel="stylesheet" href="../../../style/stylesheets/process.css">
	<link rel="stylesheet" href="../../../style/stylesheets/nav.css">
<!-- 	<link rel="stylesheet" href="style/stylesheets/script.css">
	<link rel="stylesheet" href="style/stylesheets/process.css">
	<link rel="stylesheet" href="style/stylesheets/nav.css"> -->
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Teko">
</head>
<body>

	<div class="topbar">
	  <div class="logo">524LAB</div>
	  <div class="nav">
	    <ul>
	      <li><a class="navitem link-1" href="../../../../">Home</a></li>
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
	    <li><a class="accitem" href="../../../../logout.php">Logout</a></li>
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

	<br><br><br><br><br><br>
	
	<div class="container">

		<h2 id="title">執行進度</h2>
		<a href="../../../del_process.php" id="del_this">結束此程序並執行新的程序</a>
		<hr>
		<ul id="errmessage"></ul>
		<ul id="list"></ul>
		

	</div>
		


	<script>
		var data;
		var item_template="<li class='list' id='{{id}}'>{{name}}</li>";   //要新增的html

		// var title = userProcess.concat('的執行進度');
		$("#title").text(now_user_process);
		$("#title").append("的執行進度");


		var num1=0;
		setajax();
		setInterval(setajax,1000);

		function setajax(){

			$.ajax(
			{
				url: url_data,
				success: function(res){

					data=JSON.parse(res);


					for(i=num1;i<data.length;i++){
						var item=data[i];

						if(num1==data.length){

                        }
                        else if(num1<data.length){
						var now_item=item_template.replace("{{id}}",i+1)
												  .replace("{{name}}",item.stepName);

						$("#list").append(now_item);
						num1++;
						}

					}


				}
			}
			);


		}
		



		var num=0;
		var now_item_id;

		ajaxCall();

		setInterval(ajaxCall,1000);

		function ajaxCall(){

			$.ajax(
			{
				url: url_complete,  //json來源
				success: function(res){
					data=JSON.parse(res);

					// $(#errmessage).text(data);

					for(i=num;i<data.length;i++){

						var item=data[i];


                        if(num==data.length){

                        }
                        else if(num<data.length){

                        	now_item_id= "#"+(i+1);

                        	$(now_item_id).addClass("done");
                        	$(now_item_id).removeClass("list");
                        	num++;
                        }

					}
				}
				// error: function(xhr){
    //             	$(#errmessage).text("連線出現錯誤");
    //     		}
			}
			);

		}



		var exe_template="<li id='{{id}}'>{{exeout}}</li>";   //要新增的html
		var num2=0;
		exeoutput();
		setInterval(exeoutput,1000);

		function exeoutput(){

			$.ajax(
			{
				url: url_exeout,
				success: function(res){

					data=JSON.parse(res);


					for(i=num2;i<data.length;i++){
						var item=data[i];

						if(num2==data.length){


                        }
                        else if(num2<data.length){

							var newexe = exe_template.replace("{{exeout}}",item.exeoutput)
													 .replace("{{id}}","exe"+(i+1));


							now_item_id = "#"+(num+1);
							now_exe_id = "#"+"exe"+(i+1);

							if (item.exeoutput.indexOf("error")>-1) {

								$(now_item_id).addClass("fail");
                        		$(now_item_id).removeClass("done");
                        		$("#errmessage").append(newexe);
                        		$(now_exe_id).css("color","red");

							}
							else{
								$("#errmessage").append(newexe);
							}
							
							num2++;
						}

					}


				}
			}
			);


		}

	</script>


		

	
</body>
</html>