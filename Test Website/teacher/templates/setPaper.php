<?php
session_start();
include "../../others/include/conn.php";
if($con){
	//echo "success";
}
$test_id=$_POST['name'];

$_SESSION["id"] = $test_id;
//echo $test_id;
$name;
$number_of_subjects;
$name_of_subjects;
$per_subject_question;
$question;
$options;
$duration;
$subjects = array();
$sql = "SELECT * FROM paper WHERE test_id='$test_id'";
$result = mysqli_query($con, $sql);
if($result){
	//echo mysqli_num_rows($result);
}

while ($pass = mysqli_fetch_assoc($result)) {
  $name=$pass['name_of_test'];
  $number_of_subjects = $pass['number_of_subjects'];
  $name_of_subjects = $pass['name_of_subjects'];
  $per_subject_question = $pass['per_subject_question'];
  $question = $pass['question'];
  $options = $pass['options'];
  $duration = $pass['duration'];
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Make your paper</title>
<link rel="stylesheet" type="text/css" href="../style/setPaper.css">
  <script src="../../others/files/jquery-3.6.0.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
<div id="testName"><?php echo $name; ?></div>





	<script type="text/javascript">
		var test_id = "<?php echo $test_id; ?>";
		const subjects =[];
		const num_ques_subject = [];
		var selected_subject = 0;

	</script>
		<?php

    $string = " ";
    for ($i = 1; $i < strlen($name_of_subjects); $i++) {
        if ($name_of_subjects[$i] != "*") {
            $string = $string . $name_of_subjects[$i];
        } else {
        	array_push($subjects, $string);
    ?>
            <script type="text/javascript">
                subjects.push("<?php echo $string; ?>");
            </script>
    <?php
            $string = " ";
        }
    }

    ?>
    <?php 
$string = " ";
for ($i = 1; $i < strlen($per_subject_question); $i++) {
    if ($per_subject_question[$i] != "*") {
        $string = $string . $per_subject_question[$i];
    } else {
        ?>
        	<script type="text/javascript">
                num_ques_subject.push("<?php echo $string; ?>");
            </script>
        <?php
        $string = " ";
    }
}

    ?>

    <?php 
$string = " ";
for ($i = 1; $i < strlen($per_subject_question); $i++) {
    if ($per_subject_question[$i] != "*") {
        $string = $string . $per_subject_question[$i];
    } else {
        ?>
        	<script type="text/javascript">
                num_ques_subject.push("<?php echo $string; ?>");
            </script>
        <?php
        $string = " ";
    }
}

    ?>
	<div id="subjectBox">
		<?php
		for($i=0; $i<$number_of_subjects; $i++){
			?>
			<button class="subjectBtn" id="<?php echo $subjects[$i]; ?>" onclick="changeSubject(this)" ><?php echo $subjects[$i]; ?></button>
			<?php
		}
		?>
	</div>
	<div id="m-textBtn">
		<button class="m-textBtn-btn" id="m-btn-para" onclick="changeTextBtn(this)">Paragraph</button>
		<button class="m-textBtn-btn" id="m-btn-fraction" onclick="changeTextBtn(this)">Fraction</button>
		<button class="m-textBtn-btn" id="m-btn-image" onclick="changeTextBtn(this)">Image</button>
		<button class="m-textBtn-btn" id="m-btn-bracket" onclick="changeTextBtn(this)">Bracket</button>
		<button class="m-textBtn-btn" id="m-btn-square" onclick="changeTextBtn(this)">Square</button>
		<button class="m-textBtn-btn" id="m-btn-round" onclick="changeTextBtn(this)">Round</button>
		<button class="m-textBtn-btn" id="m-btn-others" onclick="changeTextBtn(this)">Others</button>
	</div>
	<script type="text/javascript">
		var questionCode = " ";
		var option1Code = " ";
		var option2Code = " ";
		var option3Code = " ";
		var option4Code = " ";
		var showQuestionCode = " ";
		var showOption1Code = " ";
		var showOption2Code = " ";
		var showOption3Code = " ";
		var showOption4Code = " ";
		var canAdd = 0;
		var selectedOption =0;

	</script>
	<div id="box">
		<div id="left">
		<div id = "numberBox">Question no.<span id ="nqs"></span></div>
		<div id="questionBox" onclick="selectOption(this)">Start writing question from here.You can add paragraph and fraction from above</div>
		<div id="optionBox">
			<div class="op" type="textarea" name="o1" id="o1"    onclick="selectOption(this)">option 1</div>
			<div class="op" type="textarea" name="o2" id="o2"    onclick="selectOption(this)">option 2</div>
			<div class="op" type="textarea" name="o3" id="o3"    onclick="selectOption(this)">option 3</div>
			<div class="op" type="textarea" name="o4" id="o4"    onclick="selectOption(this)">option 4</div>
		</div>
	</div>
		<div id="entry">
			<div id="paragraph" class="c-entry">
		<b>Paragraph:</b><br>
		<textarea rows ="3" cols ="15" name="para" id ="para" placeholder="Insert a Paragraph" class="entry-input-para"></textarea><br>
		<button id="a" onclick="addPara()">add Paragraph</button><br><br></div>
		<div id="fraction" class="c-entry">
		<b>Fraction:</b><br>
		<input class ="fr" type="text" name="numr" id ="numr" placeholder = "numerator"><br>
		<input class = "fr" type="text" name="denr" id ="denr" placeholder="denominator"><br>
		<button id="b" onclick="addFraction()"> Add fraction</button>
	</div>


		<div id="image" class="c-entry">
		<form id = "target" method="post" enctype="multipart/form-data" action = "../processes/insertImg.php">
			<input type="number" id="num" name = "num" value="0">
			<input type="text" name="name" id="name" value = "@">
			<button type="submit">Submit</button>
		</form>
		<button id="ifile" onclick="inputBtn();">create</button>
		<button onclick="save()">save</button>
	</div>
</div>
	</div>
		
	</div>
	<div id ="sabtns">
			<button class="editbtn" id = "savebtn" onclick="saveQuestion()">Save Question</button>
			<button class="editbtn" id = "addbtn" onclick="addQuestion()">Add New Question</button>
		</div>
		<div><a href = "../../student/templates/testPage.php"> see your page</a></div>

	<script type="text/javascript">
		document.getElementById(subjects[selected_subject]).style.backgroundColor="#707070";
		document.getElementById('nqs').innerHTML=parseInt(num_ques_subject[selected_subject]) +1;
		function changeSubject(subject){
			document.getElementById(subjects[selected_subject]).style.backgroundColor="#aaaaaa";
			var selected = subject.id;
			console.log(selected);
			selected_subject = subjects.indexOf(selected);
			console.log(selected_subject);
			document.getElementById(subjects[selected_subject]).style.backgroundColor="#707070";
			document.getElementById('nqs').innerHTML=parseInt(num_ques_subject[selected_subject]) +1;
		}
		function renderCode(){
			document.getElementById("questionBox").innerHTML = showQuestionCode;
			document.getElementById("o1").innerHTML = showOption1Code;
			document.getElementById("o2").innerHTML = showOption2Code;
			document.getElementById("o3").innerHTML = showOption3Code;
			document.getElementById("o4").innerHTML = showOption4Code;
			document.getElementById('nqs').innerHTML=parseInt(num_ques_subject[selected_subject]) +1;

		}
		function addPara(){
			var newPara = document.getElementById("para").value;
			if(selectedOption==0){
			showQuestionCode = showQuestionCode + "<span class = 'inside'>" + newPara + "</span>";
			questionCode =questionCode + "<span class = %%20inside%%20>" + newPara + "</span>";
			}
			if(selectedOption==1){
			showOption1Code = showOption1Code + "<span class = 'inside'>" + newPara + "</span>";
			option1Code =option1Code + "<span class = %%20inside%%20>" + newPara + "</span>";
			}
			if(selectedOption==2){
			showOption2Code = showOption2Code + "<span class = 'inside'>" + newPara + "</span>";
			option2Code =option2Code + "<span class = %%20inside%%20>" + newPara + "</span>";
			}
			if(selectedOption==3){
			showOption3Code = showOption3Code + "<span class = 'inside'>" + newPara + "</span>";
			option3Code =option3Code + "<span class = %%20inside%%20>" + newPara + "</span>";
			}
			if(selectedOption==4){
			showOption4Code = showOption4Code + "<span class = 'inside'>" + newPara + "</span>";
			option4Code =option4Code + "<span class = %%20inside%%20>" + newPara + "</span>";
			}
			renderCode();
			document.getElementById("para").value = "";
		}
		function save(){
			var ImgName = randomstring+".png";
			if(selectedOption==0){
			showQuestionCode = showQuestionCode + "<br><img src = %%20../../image/questions image/" + ImgName + "%%20 class =%%20img%%20><br>";
			questionCode =questionCode + "<br><img src = %%20../../image/questions image/" + ImgName + "%%20 class =%%20img%%20><br>";
			}
			if(selectedOption==1){
			showOption1Code = showOption1Code + "<br><img src = %%20../../image/questions image/" + ImgName + "%%20 class =%%20img%%20><br>";
			option1Code =option1Code +  "<br><img src = %%20../../image/questions image/" + ImgName + "%%20 class =%%20img%%20><br>";
			}
			if(selectedOption==2){
			showOption2Code = showOption2Code + "<br><img src = %%20../../image/questions image/" + ImgName + "%%20 class =%%20img%%20><br>";
			option2Code =option2Code + "<br><img src = %%20../../image/questions image/" + ImgName + "%%20 class =%%20img%%20><br>";
			}
			if(selectedOption==3){
			showOption3Code = showOption3Code + "<br><img src = %%20../../image/questions image/" + ImgName + "%%20 class =%%20img%%20><br>";
			option3Code =option3Code + "<br><img src = %%20../../image/questions image/" + ImgName + "%%20 class =%%20img%%20><br>";
			}
			if(selectedOption==4){
			showOption4Code = showOption4Code +  "<br><img src = %%20../../image/questions image/" + ImgName + "%%20 class =%%20img%%20><br>";
			option4Code =option4Code + "<br><img src = %%20../../image/questions image/" + ImgName + "%%20 class =%%20img%%20><br>";
			}
			renderCode();
		}
		function addFraction() {
			var numr = document.getElementById("numr").value;
			var denr = document.getElementById("denr").value;
			if(selectedOption==0){
			showQuestionCode = showQuestionCode + "<div class='boxr'><div id='num' class='numr'>"+numr+"</div><div class='denr'>"+denr+"</div></div>";
			questionCode =questionCode + "<div class=%%20boxr%%20><div id=%%20num%%20 class=%%20numr%%20>"+numr+"</div><div class=%%20denr%%20>"+denr+"</div></div>";
			}
			if(selectedOption==1){
			showOption1Code = showOption1Code + "<div class='boxr'><div id='num' class='numr'>"+numr+"</div><div class='denr'>"+denr+"</div></div>";
			option1Code =option1Code + "<div class=%%20boxr%%20><div id=%%20num%%20 class=%%20numr%%20>"+numr+"</div><div class=%%20denr%%20>"+denr+"</div></div>";
			}
			if(selectedOption==2){
			showOption2Code = showOption2Code + "<div class='boxr'><div id='num' class='numr'>"+numr+"</div><div class='denr'>"+denr+"</div></div>";
			option2Code =option2Code + "<div class=%%20boxr%%20><div id=%%20num%%20 class=%%20numr%%20>"+numr+"</div><div class=%%20denr%%20>"+denr+"</div></div>";
			}
			if(selectedOption==3){
			showOption3Code = showOption3Code + "<div class='boxr'><div id='num' class='numr'>"+numr+"</div><div class='denr'>"+denr+"</div></div>";
			option3Code =option3Code + "<div class=%%20boxr%%20><div id=%%20num%%20 class=%%20numr%%20>"+numr+"</div><div class=%%20denr%%20>"+denr+"</div></div>";
			}
			if(selectedOption==4){
			showOption4Code = showOption4Code + "<div class='boxr'><div id='num' class='numr'>"+numr+"</div><div class='denr'>"+denr+"</div></div>";
			option4Code =option4Code + "<div class=%%20boxr%%20><div id=%%20num%%20 class=%%20numr%%20>"+numr+"</div><div class=%%20denr%%20>"+denr+"</div></div>";
			}
			renderCode();
			document.getElementById("numr").value = "";
			document.getElementById("denr").value = "";

		}
		function checkEntries() {
			var flag =1;
			if(questionCode.trim().length<=0){
				flag=0;
			}
			 if(option1Code.trim().length<=0){
			 	flag=0;
			 }
			  if(option2Code.trim().length<=0){
			 	flag=0;
			 }
			  if(option3Code.trim().length<=0){
			 	flag=0;
			 }
			  if(option4Code.trim().length<=0){
			 	flag=0;
			 }
			if(flag==1){
				return true;
			}else{
				return false;
			}
		}
		function saveQuestion(){
			var addAfter = 0;
			var per = "*";
			for(var i=0; i<=selected_subject; i++){
				addAfter = parseInt(addAfter) + parseInt(num_ques_subject[i]);
			}
			num_ques_subject[selected_subject] = parseInt(num_ques_subject[selected_subject] )+1;
				for(var i=0; i<subjects.length; i++){
					per = per+parseInt(num_ques_subject[i])+"*";
				}
				num_ques_subject[selected_subject]--;
				console.log(per);
			if(checkEntries()){
				var finalOption = option1Code+ "%%21"+option2Code+"%%21" + option3Code+ "%%21"+ option4Code + "%%21*";
				console.log("go");
				$.ajax({
                    url:"../processes/inserting_question.php",
                    method:"post",
                    data:{id:test_id,after:addAfter,question:questionCode,perq:per,option:finalOption},
                    success: function getdata(result){
                    	console.log(result);
                        if(result=="success"){
                        	console.log(result);
                        	document.getElementById("target").submit();
                        	document.getElementById("entry").style.display = "none";
                        	document.getElementById("savebtn").style.display = "none";
                        	num_ques_subject[selected_subject]++; 
                        	canAdd = 1;
                        }
                    } 
                })
			}

		}
		function addQuestion() {
			if(canAdd==1){
				showQuestionCode=" ";
				questionCode=" ";
				showOption1Code=" ";
				option1Code=" ";
				showOption2Code=" ";
				option2Code=" ";
				showOption3Code=" ";
				option3Code=" ";
				showOption4Code=" ";
				option4Code=" ";
				document.getElementById("numr").value = "";
			document.getElementById("denr").value = "";
			document.getElementById("para").value = "";
				document.getElementById("entry").style.display = "block";
                        	document.getElementById("savebtn").style.display = "inline";
                        	renderCode();
                        	document.getElementById('nqs').innerHTML=parseInt(num_ques_subject[selected_subject]) +1;
                        	canAdd=0;
			}else{
				window.alert("Save this question before adding new");
			}
		}
		function selectOption(show){
			var id = show.id;
			document.getElementById(id).style.backgroundColor="powderblue";
			if(id!="questionBox"){
				document.getElementById("questionBox").style.backgroundColor="white";
			}else{
				selectedOption = 0;
			}
			if(id!="o1"){
				document.getElementById("o1").style.backgroundColor="white";
			}else{
				selectedOption = 1;
			}
			if(id!="o2"){
				document.getElementById("o2").style.backgroundColor="white";
			}else{
				selectedOption = 2;
			}
			if(id!="o3"){
				document.getElementById("o3").style.backgroundColor="white";
			}else{
				selectedOption = 3;
			}
			if(id!="o4"){
				document.getElementById("o4").style.backgroundColor="white";
			}else{
				selectedOption = 4;
			}
		}
	</script>
		<script type="text/javascript">
		var numImg =0;
    function inputBtn(){
    var input=document.createElement('input');
    input.type="file";
    input.name ="img"+numImg;
    //without this next line, you'll get nuthin' on the display
    document.getElementById('target').appendChild(input);
    numImg++;
    randomString();
    document.getElementById('num').value=numImg;
    var val = document.getElementById('name').value;
    var newval = val+randomstring+"*";
    document.getElementById('name').value=newval;
}
</script>
<script type="text/javascript">
	function changeTextBtn(btn){
		var name = btn.innerHTML;
		console.log(name);
		var lc_name = name.toLowerCase();
		var collection = document.getElementsByClassName("c-entry");
		for (let i = 0; i < collection.length; i++) {
  			collection[i].style.display= "none";
			}
		document.getElementById(lc_name).style.display = "block";
	}
</script>
<script type="text/javascript">
var randomstring = " ";
function randomString() {  
            //define a variable consisting alphabets in small and capital letter  
    var characters = "ABCDEFGHIJKLMNOPQRSTUVWXTZabcdefghiklmnopqrstuvwxyz";  
              
            //specify the length for the new string  
    var lenString = 10;  
    randomstring = '';  
  
            //loop to select a new character in each iteration  
    for (var i=0; i<lenString; i++) {  
        var rnum = Math.floor(Math.random() * characters.length);  
        randomstring += characters.substring(rnum, rnum+1);  
    }  
}  
</script>
</body>
</html>