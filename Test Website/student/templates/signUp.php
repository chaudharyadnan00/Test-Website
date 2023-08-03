<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Sign Up on loosers</title>
    <link rel="stylesheet" type="text/css" href="../style/signUp.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="../../others/files/jquery-3.6.0.js"></script>
</head>
<body>
	<div id="header">
		Loosers
	</div>
	<div id="box">
		<form method="post" action="../processes/signUpProcess.php">
			<input id ="phone" type="phone" name="phone" required autocomplete="off" minlength="10" maxlength="10" placeholder="Mobile Number..." onkeyup="btnStatus()"><br>
			<span>Preparing for :</span><br>
			<div id="jeeMains" onclick="check(this)" >JEE Mains</div><br>
			<div id="jeeAdvance" onclick="check(this)">JEE Advanced</div><br>
			<div id="neet" onclick="check(this)">NEET</div><br>
			<input type="text" id="target" value=" " name="target" hidden>
			<input id = "password" type="password" name="password" required autocomplete="off" onkeyup="btnStatus()" on><br>
			<button type="submit" id="submitBtn">create account</button>

			
		</form>
	</div>
	<script type="text/javascript">
		var num_target = 0;
			var btn1 =0;
			var btn2 = 0;
			var btn3 = 0;
			
		btnStatus();
		function check(btn){
			var id = btn.id;
			var name ="*";
			if(id == "jeeMains"){
				if(btn1==0){
					document.getElementById("jeeMains").style.backgroundColor ="powderblue";
					btn1 = 1;
				
					num_target++;
				}else{
					document.getElementById("jeeMains").style.backgroundColor ="gray";
					btn1 = 0;
					num_target--;
				}
			}
			if(id == "jeeAdvance"){
				if(btn2==0){
					document.getElementById("jeeAdvance").style.backgroundColor ="powderblue";
					btn2 = 1;
					
					num_target++;
				}else{
					document.getElementById("jeeAdvance").style.backgroundColor ="gray";
					btn2 = 0;
					num_target--;
				}
			}
			if(id == "neet"){
				if(btn3==0){
					document.getElementById("neet").style.backgroundColor ="powderblue";
					btn3 = 1;
					num_target++;
				}else{
					document.getElementById("neet").style.backgroundColor ="gray";
					btn3 = 0;
					num_target--;
				}
			}
			if(btn1==1){
				name = name + "JEE Mains*";
			}
			if(btn2==1){
				name = name + "JEE Advanced*";
			}
			if(btn3==1){
				name = name + "NEET*";
			}
			document.getElementById('target').value=name;
			console.log(name);
			btnStatus();
			
		}
		function btnStatus(){
			var btn =1;
			if(num_target==0){
				btn=0;
			}
			if(document.getElementById("phone").value <1000000000){
				btn=0;
			}
			if(document.getElementById('password').value.length<6 ){
				btn=0;
			}
			if(btn==0){
				document.getElementById('submitBtn').setAttribute("disabled" , "on");
			}else{
				document.getElementById('submitBtn').removeAttribute("disabled");
			}
		}
	</script>
</body>
</html>