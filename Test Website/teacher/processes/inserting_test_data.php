<?php

	include "../../others/include/conn.php";
	$teacher_id = "9569505582ghT67";
	date_default_timezone_set("Asia/Calcutta");
	$date = date("Y.m.d");
	//echo $date."<br>";
	$time = date("h.i.sa");
	//echo $time."<br>";
	$test_id = "9569505582aac56".$date.$time;
	//echo $test_id."<br>";
	$name = $_POST['tname'];
	//echo $name."<br>";
	$target = $_POST['ttarget'];
	//echo $target."<br>";
	$subject = $_POST['tsubject'];
	//echo $subject."<br>";
	$type = $_POST['ttype'];
	$type = $type[1];
	//echo $type."<br>";
	$duration = $_POST['tduration'];
	//echo $duration."<br>";
	$nsub = $_POST['tnsub'];
	//echo $nsub."<br>";
	$per_subject_question = "*";
	for($i=0; $i<$nsub; $i++){
		$per_subject_question = $per_subject_question . "0*";
	}
	//echo $per_subject_question."<br>";
	$msql= "INSERT INTO paper (teacher_id, test_id, name_of_test, type, target, number_of_subjects, name_of_subjects, total_question, per_subject_question,question_layout,question_type, question,option_layout,options, duration) VALUES ('$teacher_id', '$test_id', '$name', '$type', '$target', '$nsub', '$subject',0, '$per_subject_question',1,1,'@',1,'@','$duration')";
	$resultr=mysqli_query($con,$msql);
	//echo $resultr;
	if($resultr){
		echo "1".$test_id;
	}else{
	    echo "some error";
	}



?>