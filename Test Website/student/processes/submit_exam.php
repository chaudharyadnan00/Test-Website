<?php

	include "../../others/include/conn.php";
	$test_id = "9569505582aac56";
	$student_id = "8934954650qw23R";
	$answers = $_POST['idq'];
	
	$sql= "INSERT INTO students_answer (student_id, test_id, attempt_number, answers) VALUES ('$student_id', '$test_id', 1, '$answers')";
	echo $answers;
	$result=mysqli_query($con,$sql);
	if($result){
		echo "success";
	}



?>