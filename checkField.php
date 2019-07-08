<?php
	session_start();
	$row = $_POST['row'] + 1;
	$col = $_POST['col'] + 1;
	$rowz = $row - 1;
	$colz = $col - 1;
	$num = array($_POST['nilai'],"x");
	$hints = $_SESSION['hints'];
	$status = true;
	if($num == ""){
		//do nothing
	}else{
	if(!empty($hints[$rowz][$colz])){ //check at exact cell
			//skip here
		}else if(in_array($num[0],$hints[$rowz])){ //check row
			$num = array(0,"x");//jika ketemu maka 0 (digunakan untuk hapus nanti)
		}else{
			for($i=0;$i<9;$i++){
				if($hints[$i][$colz] == $num[0]){ //check column
					$status = false;
					break; //if found duplicate val, return to randomize again
				}
			}
			if($status == false){
				$num = array(0,"x");//jika ketemu maka 0 (digunakan untuk hapus nanti)
			}else{
				//get position in 3x3 field
				$rowloc = $row % 3;
				$colloc = $col % 3;

				//set scan for other cells in 3x3 field, untuk rownya
				if($rowloc == 1){
					$temprow1 = $row;
					$temprow2 = $row + 1;
				}else if($rowloc == 2){
					$temprow1 = $row - 2;
					$temprow2 = $row;
				}else if($rowloc == 0){
					$temprow1 = $row - 3;
					$temprow2 = $row - 2;
				}
				//yang ini juga, buat kolomnya
				if($colloc == 1){
					$tempcol1 = $col;
					$tempcol2 = $col + 1;
				}else if($colloc == 2){
					$tempcol1 = $col - 2;
					$tempcol2 = $col;
				}else if($colloc == 0){
					$tempcol1 = $col - 3;
					$tempcol2 = $col - 2;
				}
				//checking section coy, huehue

				if(isset($hints[$temprow1][$tempcol1])){
					if($hints[$temprow1][$tempcol1] == $num[0]){
						//jika ketemu maka 0 (digunakan untuk hapus nanti)
						$num = array(0,"x");
						$status = false;
					}
				}
				if(isset($hints[$temprow1][$tempcol2])){
					if($hints[$temprow1][$tempcol2] == $num[0]){
						//jika ketemu maka 0 (digunakan untuk hapus nanti)
						$num = array(0,"x");
						$status = false;
					}
				}
				if(isset($hints[$temprow2][$tempcol1])){
					if($hints[$temprow2][$tempcol1] == $num[0]){
						//jika ketemu maka 0 (digunakan untuk hapus nanti)
						$num = array(0,"x");
						$status = false;
					}
				}
				if(isset($hints[$temprow2][$tempcol2])){
					if($hints[$temprow2][$tempcol2] == $num[0]){
						//jika ketemu maka 0 (digunakan untuk hapus nanti)
						$num = array(0,"x");
					}
				}

			}
		}
	}
	if($status == true && $num[0] != 0){ //set value nya gan
		$row--;
		$col--;
		if($hints[$row][$col]!=""){
			$hints[$row][$col] = $num[0];
		}else{
			$hints[$row][$col] = $num[0];
			$_SESSION['count']--;
		}
		$_SESSION['hints'] = $hints;
		if($_SESSION['count']==0){
			$num[1] = "a";
		}
	}else{
		$rowq = $row - 1;
		$colq = $col - 1;
		$hints[$rowq][$colq] = "";
		$_SESSION['hints'] = $hints;
	}
	echo json_encode($num);
?>
