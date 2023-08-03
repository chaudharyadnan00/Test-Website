<?php
	function splitter($str , $name ,$num)
	{
		$tmpString = " ";
		$status = 0;
		global $$name;
		global $$num;
		for($i=0;$i<strlen($str);$i++){
			if($str[$i]!="*"){
				if($status==0){
					$tmpString = $tmpString.$str[$i];
					$status=1;
				}else{
					$tmpString = $str[$i];
				}
			}else{
				array_push($$name,$tmpString);
				$tmpString = " ";
				$status=0;
				$$num++;
			}
		}
	}
	$code = " ";
	function deSplitter($str , $add){
		global $$str;
		if($$str ==" "){
			$$str = $add."*";
		}else{
			$$str = $$str.$add."*";
		}
	}
	$new = array("rsetbe","ttretret","rttrter","tbrtr");
	for($i=0; $i<4; $i++){
		deSplitter("code", $new[$i]);
	}
	echo $code;
?>