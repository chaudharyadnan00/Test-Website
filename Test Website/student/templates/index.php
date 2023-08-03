<?php 
include "../../others/include/conn.php";
$sql = "select * from paper";
$idOfTest=array();
$nameOfTest=array();
$result = mysqli_query($con, $sql);
while ($pass = mysqli_fetch_assoc($result)) {
	array_push($idOfTest,$pass['test_id']);
	array_push($nameOfTest,$pass['name_of_test']);
    // $number_of_subjects = $pass['number_of_subjects'];
    // $name_of_subjects = $pass['name_of_subjects'];
    // $per_subject_question = $pass['per_subject_question'];
    // $question = $pass['question'];
    // $options = $pass['options'];
    // $duration = $pass['duration'];
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Home Page</title>
    <link rel="stylesheet" type="text/css" href="../style/index.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="../../others/files/jquery-3.6.0.js"></script>
</head>
<body>
	<div id="header">
		<div id="over">
		<div id="brandName" class="headerItems">Loosers</div>
		<div id="right" class="headerItems">
			<div id="searchBar" class="rightItems">
				<input id="searchInput" type="text" name="searchFor" placeholder="search...">
				<button id = "searchBtn"><i class="fa fa-search"></i></button>
			</div>
			<div id="icons">
				<div id="notification" class="rightItems"><i class="fa fa-bell"></i></div>
				<div id="menuBar" class="rightItems"><i class="fa fa-bars"></i></div>
			</div>
		</div>
	</div>
		<div id="m-search">
			<div id="filter" onclick="showFilter()">
				<i class="fa fa-filter" style="color: gray;padding: 8px;"></i>
			</div>
				<div id="m-search-input">
					<input id="m-input"type="text" name="search" placeholder="Search for a subject......">
				</div>
				<div id="m-search-btn">
				<i class="fa fa-search" style="color: gray;padding: 8px;"></i>
				</div>
		</div>
	</div>
<div class="navbar">
  <a class="active" href="#"><i class="fa fa-flask"></i><br>Test</a>
  <a href="#"><i class="fa fa-book"></i><br>Notebook</a>
  <a href="#"><i class="fa fa-gamepad"></i><br>Games</a>
  <a href="#"><i class="fa fa-pencil"></i><br>Class</a>
</div>
	<div id="fullScreen">
		<div id = "mainBox">
			<div id="leftBox"> lorem ipsum dollar sit cjknqc scd cwq c sc sc cf wqfd ca cl el d csa c jlew lwql 
			 lorem ipsum dollar </div>
			<div id="rightBox">
				<?php
				for($i=0;$i<count($idOfTest);$i++){?>
				<div class="card" id='<?php echo "card".$idOfTest[$i];?>'>
					<div class="card-header">
						<span><?php echo $nameOfTest[$i]; ?></span><br>
						<span id="nid">Test id : <?php echo $idOfTest[$i];?></span>
					</div>
					<hr>
					<div class="card-body">
						This is the for those students who are in cigerrette trap or friend of shivansh.
					</div>
					<div class="card-footer">
						<button id='<?php echo "b".$idOfTest[$i];?>' class = "test-buy" onclick="sendId(this)">Enroll Now</button>
					</div>
				</div>
				<?php }?>
			</div>
		</div>
	</div>
	<div id="idTransmitt">
		<form id="goto" method="post" action="./testPage.php">
			<input id="id-t" type="text" name="id-t">
		</form>
	</div>
	<script type="text/javascript">
		function sendId(tid)
		{
			var id=tid.id;
			let l=id.length;
			let result=id.substring(1,l);
			document.getElementById("id-t").value=result;
			document.getElementById("goto").submit();
		}
		var ms=0;
		function showFilter(){
			var fb=document.getElementById('filter');
			var lb=document.getElementById('leftBox');
		if(ms==0){
            fb.innerHTML = '<i class="fa fa-close" style="color:#805050;padding: 8px;"></i>';
            lb.style.display="block";
            ms=1;
        }else{
            fb.innerHTML = '<i class="fa fa-filter" style="color: gray;padding: 8px;"></i>';
            lb.style.display="none";
            ms=0;
        }
		}
	</script>
</body>
</html>