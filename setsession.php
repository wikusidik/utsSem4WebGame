<?php
	$username = $_POST["user"];
	$level = $_POST["level"];
	if($level == 1){
		$hintcount = 49;
	}else if($level == 2){
		$hintcount = 53;
	}else if($level == 3){
		$hintcount = 57;
	}

	$tempArray = array(1=>1,2=>2,3=>3,4=>4,5=>5,6=>6,7=>7,8=>8,9=>9);

	$hintRow = [];
	$hints = [];

	while(sizeof($tempArray) > 0){ //randomizing one row
		$rand = array_rand($tempArray,1);
		unset($tempArray[$rand]);
		array_push($hintRow,$rand);
	}

	//doing the pattern
	//make function
	function shift3($a){
		for($i=0;$i<3;$i++){
			$temp = array_shift($a);
			array_push($a,$temp);
		}
		return $a;
	}
	
	function shift1($a){
		$temp = array_shift($a);
		array_push($a,$temp);
		return $a;
	}

	//implementation

	for($i=1;$i<10;$i++){
		if($i == 1){
			array_push($hints,$hintRow);
		}else if(($i % 3) == 1){
			$hintRow = shift1($hintRow);
			array_push($hints,$hintRow);
		}else{
			$hintRow = shift3($hintRow);
			array_push($hints,$hintRow);
		}
	}

	//erase cell randomly

	$count = 81;

	while($hintcount > 0){
		$row = rand(0,8);
		$col = rand(0,8);
		if($hints[$row][$col] == ""){
			//skip this
		}else if($hints[$row][$col] != ""){
			$hints[$row][$col] = "";
			$hintcount--;
			$count--;
		}
	}

	session_start();
	$_SESSION["username"] = $username;
	$_SESSION["hints"] = $hints;
	$hintcount = 81 - $count;
	$_SESSION['count'] = $hintcount;
?>