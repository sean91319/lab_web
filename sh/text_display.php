<?php 


	$id = $_GET["id"];
	$username = $_COOKIE["username"];
	$json_loc = $username."/json/".$id."_json/step_data.json";
	$url = "http://localhost:8888/lab_web/sh/".$username."/json/".$id."_json/json.php?type=get&name=data";

	$json = file_get_contents($json_loc);
	$json_data = json_decode($json);

	echo "<script>\r\n"; 
	echo "this_script_name=\"$id\";\r\n"; 
	echo "url_data=\"$url\";\r\n"; 
	echo "</script>\r\n"; 




	// echo "以下是 ";
	// echo $id;
	// echo " 的腳本內容<br><br><br>";


	// for ($i=0; $i < count($json_data); $i++) { 
	// 	echo $i+1;
	// 	echo ".&nbsp;步驟名稱：";
	// 	echo $json_data[$i]->{'stepName'};
	// 	echo "<br>&nbsp;&nbsp;&nbsp;指令：";
	// 	echo $json_data[$i]->{'stepScript'};
	// 	echo "<br>";
	// 	echo "<br>";

	// }

 ?>



<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<script src="jquery.js"></script>
	<title>TEXT</title>
	<link rel="stylesheet" href="style/stylesheets/text_display.css">
</head>
<body>
	<!-- <div class="test">qqqqq</div> -->
	<div class="container">
		<div id="title"></div>
		<br>	
		<form action="change_json.php" method="post" name="form" id="form">
			<span id="add" class="btn" style="display: none;">ADD SCRIPT</span><span>   </span><span id='remove' class='btn' style="display: none;">Del SCRIPT</span>
			<ol id="list">
				<!-- <li>
					步驟名稱： one.sh
					<br>
					指令：abc
				</li>
				<br> -->
			<!-- 		<li>
					步驟名稱： <input type="text">
					<br>
					指令：<input type="text">
				</li> -->
			</ol>
		</form>
			
		<span class="btn" id="change">修改</span>
		
	</div>

	<script>

		var data=[];
		// var item_template="<li id={{id}}>步驟名稱： {{step_name}}<br>指令： {{script}}&nbsp&nbsp<span class='btn' id={{change}}>修改</span></li><br>";
		var item_template="<li class='list' id={{id}}>步驟名稱： {{step_name}}<br class='list'>指令： {{script}}&nbsp&nbsp</li><br class='list'>";

		var title_template="<div>以下是{{step_name}}的腳本內容: <br>執行位址： {{step_file}}</div>";

		var item_change_template="<li class='list' id={{id}}>步驟名稱： <input type='text' name={{step_name}} value='{{name_value}}'><br>指令： <input type='text' name={{script}} value='{{script_value}}'>&nbsp&nbsp</li>";
		var item_new_template="<li class='list' id={{id}}>步驟名稱： <input type='text' name={{step_name}}><br>指令： <input type='text' name={{script}}>&nbsp&nbsp</li>";



		$.ajax({
			url: url_data,
			success: function(res){
				data=JSON.parse(res);

				var now_title=title_template.replace("{{step_name}}",this_script_name)
											.replace("{{step_file}}",data[0].scriptFile);
		

				$("#title").html(now_title);

				for (var i = 0; i < data.length; i++) {
					var item=data[i];

					var now_item=item_template.replace("{{id}}", item.stepName)
											  .replace("{{step_name}}", item.stepName)
											  .replace("{{script}}", item.stepScript);



					$("#list").append(now_item);

				}


			}
		});

		var script_num = 96;

		$("#change").click(
			function(){

				$(".list").remove();
				$("#change").remove();

				$.ajax({
					url: url_data,
					success: function(res){
						data=JSON.parse(res);
						for (var i = 0; i < data.length; i++) {

							script_num++;
							var now_name=String.fromCharCode(script_num); 
							var item=data[i];


							var now_item=item_change_template.replace("{{id}}", now_name)
													  		 .replace("{{step_name}}", item.stepName+"_"+i)
													  		 .replace("{{name_value}}", item.stepName)
													  		 .replace("{{script}}", item.stepName+"_script_"+i)
													  		 .replace("{{script_value}}", item.stepScript);



							$("#list").append(now_item);
							$("#form").attr("action","change_json.php?id="+this_script_name+"&file="+item.scriptFile)

						}
						

					}
				});
				// $("#form").prepend("<span id='add' class='btn'>ADD SCRIPT</span><span>   </span><span id='remove' class='btn'>Del SCRIPT</span>")
				$("#add").css("display","inline-block");
				$("#remove").css("display","inline-block");


				$("#form").append("<input type='submit' class='btn' id='save'></a>")

			}
		);



		$("#add").click(
			function(){

				script_num++;
				var now_name=String.fromCharCode(script_num);

				var now_script = item_new_template.replace("{{id}}", now_name)
										  	      .replace("{{step_name}}", now_name+"_stepname")
										  	  	  .replace("{{script}}", now_name+"_script")
										  	  	  .replace("{{id2}}", now_name);

				$("#list").append(now_script);

				$(".test").text(now_name);


			}
		);

		$("#remove").click(
			function(){
				var now_name=String.fromCharCode(script_num); //新li的name的ascii

				$("#"+now_name).remove();

				script_num--;
				var now_name=String.fromCharCode(script_num);
				$(".test").text(now_name);

				
			}
		);





	</script>
	
</body>
</html>