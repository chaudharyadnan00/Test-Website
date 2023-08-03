<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Teacher Sign Up on loosers</title>
    <link rel="stylesheet" type="text/css" href="../style/teacherSignUp.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="../../others/files/jquery-3.6.0.js"></script>
</head>

<body>
    <div id="main-box">
    <div id="header">
        Loosers
    </div>
    <div id="box">
    <form method="post" action="../processes/teacherSignUpProcess.php">
        <input id="name" type="text" name="name" placeholder="Enter you name here" required autocomplete="off" onkeyup="btnStatus()"><br>
        <input id="phone" type="phone" name="phone" placeholder="Phone Number" required autocomplete="off" minlength="10" maxlength="10" onkeyup="btnStatus()"><br>
        <input id="email" type="email" name="email" placeholder="Email" required autocomplete="off" onkeyup="btnStatus()"><br>
        <input id="password" type="password" name="password" placeholder="Password" required autocomplete="off" minlength="8" maxlength="16" onkeyup="btnStatus()" on><br>
        <div id="btn-box">
        <button type="submit" id="submitBtn">Create Account</button>
    </div>
    </form>
</div>
</div>
    <script type="text/javascript">
        function btnStatus() {
            var button = 1;
            // var val = document.getElementById('name').value;
            if (document.getElementById('name').value.length < 1) {
                button = 0;
            }
            if(document.getElementById('phone').value<1000000000){
                button=0;
            }
            if(document.getElementById('password').value.length<8){
                button=0;
            }
            if(button==0){
                document.getElementById('submitBtn').setAttribute("disabled","on");
            }
            else{
                document.getElementById('submitBtn').removeAttribute("disabled");
            }
        }
    </script>
</body>

</html>