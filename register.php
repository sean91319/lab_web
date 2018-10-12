<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>註冊</title>
	<link rel="stylesheet" href="css/register.css">

	<script>
		
		function isEmail(str) {
			var strEmail;
			var showEmsg= document.getElementById("email_alert");
			strEmail = str.value;
			if (strEmail.search(/^\w+((-\w+)|(\.\w+))*\@[A-Za-z0-9]+((\.|-)[A-Za-z0-9]+)*\.[A-Za-z0-9]+$/) == -1){
				showEmsg.innerHTML= "<font color=red> 信箱格式錯誤！</font>";
				str.focus();
				}
			else
				showEmsg.innerHTML= "<font color=green> OK！</font>";
				return true;
		}

		function pwdcheck(){
			var showPmsg= document.getElementById("pwd_alert");
			if (register.passwordcheck.value != register.password.value){
				showPmsg.innerHTML= "<font color=red>  密碼不符 </font>";
				str.focus();
				}
			else
				showPmsg.innerHTML= "<font color=green> OK！</font>";
			

			//showPmsg.innerHTML= "<font color=red> 密碼不符 </font>";
			
				
		}

		function check(){

			var showmsg= document.getElementById("alert_msg");
			if(register.name.value == ""){
					showmsg.innerHTML= "<font color=red>未填寫您的大名</font>";
					return false;
				}

			else if(register.nickname.value == ""){
					showmsg.innerHTML= "<font color=red>未填寫您的使用者名稱</font>";
					return false;
				}

			else if(register.email.value == ""){
					showmsg.innerHTML= "<font color=red>未填寫您的電子信箱</font>";
					return false;

				}

			else if(register.password.value == ""){
					showmsg.innerHTML= "<font color=red>未填寫您的密碼</font>";
					return false;

				}

			else if(register.passwordcheck.value == ""){
					showmsg.innerHTML= "<font color=red>未確認您的密碼</font>";
					return false;

				}

			else if(register.company.value == ""){
					showmsg.innerHTML= "<font color=red>未填寫您的服務單位/學校</font>";
					return false;

				}

			else if(register.position.value == ""){
					showmsg.innerHTML= "<font color=red>未填寫您的職位</font>";
					return false;

				}

			else if(register.phone.value == ""){
					showmsg.innerHTML= "<font color=red>未填寫您的電話</font>";
					return false;

				}


			else return true;

		}



	</script>


</head>
<body>

	<form onsubmit="return check()" action="finish.php" method="post" name="register">
		
		<div class="background">
			<div class="box">

				<div class="line title">歡迎註冊！</div><br>

				<hr>

				<div class="line">姓名</div><br>

				<input type="text" name="name" value=""><br>

				<div class="line">使用者名稱(帳號)</div><br>

				<input type="text" name="nickname"><br>

				<div class="line">電子信箱</div><br>

				<input type="email" name="email" onblur="isEmail(this)" ><br>
				<div class="alert" id="email_alert" value="no">
					<font color="red"></font>
				</div><br>

				<div class="line">設定密碼</div><br>

				<input type="password" name="password"><br>
			
				<div class="line">密碼確認</div><br>

				<input type="password" name="passwordcheck" onblur="pwdcheck()" ><br>
				<div class="alert" id="pwd_alert" value="no">
					<font color="red"></font>
				</div><br>
			
				<div class="line">服務單位/學校</div><br>

				<input type="text" name="company"><br>
			
				<div class="line">職務</div><br>

				<input type="text" name="position"><br>
			
				<div class="line">電話</div><br>

				<input type="text" name="phone"><br>

				<!-- <button class="button" type="submit" id="registerbutton" onclick="check()">確認註冊</button><br> -->

				<input type="submit" class="button" value="確認註冊"><br>

				<span id="alert_msg" value="no"><font color="red"></font></span>

			</div>


		</div>	

	</form>
	
</body>
</html>