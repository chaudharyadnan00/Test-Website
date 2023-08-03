
<?php

	include "../../others/include/conn.php";
	$test_id = $_POST['id'];
	$after = $_POST['after'];
	$option = $_POST['option'];
	$question = $_POST['question']."*";
	$perq = $_POST['perq'];
	$final_question;
	$final_option;
	$total;
	$sqlr = "select * from paper where test_id='$test_id'";
	$resultr = mysqli_query($con, $sqlr);
	while($pass = mysqli_fetch_assoc($resultr)){
		$initial_question = $pass['question'];
		$total = $pass['total_question'];
		$initial_option =$pass['options'];
	}
	if($total==0){
		$final_question = $question;
	}else{
		$final_question = $initial_question[0];
		$position = 0;
		$flag = 1;
		for($i=1; $i<strlen($initial_question); $i++){
			if($initial_question[$i]=="*"){
				$position++;
			}
			$final_question = $final_question.$initial_question[$i];
			if($position==$after){
				if($flag == 1){
					$final_question = $final_question.$question;
					$flag=0;
				}
			}
		}
	}
	if($total==0){
		$final_option = $option;
	}else{
		$final_option = $initial_option[0];
		$position = 0;
		$flag = 1;
		for($i=1; $i<strlen($initial_option); $i++){
			if($initial_option[$i]=="*"){
				$position++;
			}
			$final_option = $final_option.$initial_option[$i];
			if($position==$after){
				if($flag == 1){
					$final_option = $final_option.$option;
					$flag=0;
				}
			}
		}
	}
$total++;
	$sql="UPDATE paper SET question='$final_question', per_subject_question = '$perq', total_question ='$total', options ='$final_option' WHERE test_id='$test_id'";
	$result=mysqli_query($con,$sql);
	if($result){
		echo "success";
	}



?>