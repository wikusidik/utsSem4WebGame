<!DOCTYPE HTML>
<?php 
if (isset($_SESSION)){
    session_destroy();
    session_start();}
    else{
        session_start();
    }
$hints = $_SESSION['hints'];
?>
<html>
	<head>
		<script src = "asset/js/jquery.min.js" type = "text/javascript"></script>
		<script src = "asset/jquery-ui/jquery-ui.js" type = "text/javascript"></script>
		<link href = "asset/css/style.css" type = "text/css" rel = "stylesheet" />
	</head>
	<script>
	var startCounter = 0;
	
	//============================functions run here===========================
		$(document).ready(function(){
			win = false;
			//=================================================================
			//=================================================================
			// ====================questBox section============================
			//document.oncontextmenu = function(){return false;};
			setInterval(function(){startCounter++;$("#timer").text(startCounter);},1000);
		});
	</script>
	<body>
		<div id = "header">
			<div id = "logo-sudoku">
				<div id = "logo">
				</div>
			</div>
			<div id = "times">
				<div id = "timer">
					000
				</div>
			</div>
			<div class = "clear"></div>
		</div>
		<div id = "container">
			<div id = "main">
				<table border="2" id="mainField" width="100%" height="100%" cellspacing=0>
					<?php
					$width = 100 / 9;
						for($i=1;$i<=9;$i++){
							echo "<tr>";
							for($j=1;$j<=9;$j++){
								if($j < 4 && $i < 4){
										$group = "A"; //kiri atas
									}else if($j < 7 && $i < 4){
										$group = "B"; //tengah atas
									}else if($j <=9 && $i < 4){
										$group = "C"; //kanan atas
									}
									else if($j < 4 && $i < 7){
										$group = "D"; //kiri middle
									}else if($j < 7 && $i < 7){
										$group = "E"; //tengah middle
									}else if($j <=9 && $i < 7){
										$group = "F"; //kanan middle
									}else if($j < 4 && $i <= 9){
										$group = "G"; //kiri bawah
									}else if($j < 7 && $i <= 9){
										$group = "H"; //tengah bawah
									}else if($j <=9 && $i <= 9){
										$group = "I"; //kanan bawah
									}
									$a = $i - 1;
									$b = $j - 1;
								if($hints[$a][$b] != ""){
									if(($j % 3) == 0 && $j != 9){
										if(($i % 3) == 0 && $i != 9){
											echo "<td style='border-right:solid 5px; border-bottom:solid 5px;width:$width%;height:$width%;'><textarea maxlength='1' rows=1 cols=1 class='cells c$b r$a g$group' onkeypress='return onlyNos(event,this);' onkeydown='return noBackspace(event,this);' onkeyup='checkArround($b,$a);'>".$hints[$a][$b]."</textarea></td>";
										}else{
											echo "<td style='border-right:solid 5px;width:$width%;height:$width%;'><textarea maxlength='1' rows=1 cols=1 class='cells c$b r$a g$group' onkeypress='return onlyNos(event,this);'  onkeydown='return noBackspace(event,this);' onkeyup='checkArround($b,$a);'>".$hints[$a][$b]."</textarea></td>";
										}
									}else{
										if(($i % 3) == 0 && $i != 9){
											echo "<td style='border-bottom:solid 5px;width:$width%;height:$width%;'><textarea maxlength='1' rows=1 cols=1 class='cells c$b r$a g$group' onkeypress='return onlyNos(event,this);'  onkeydown='return noBackspace(event,this);' onkeyup='checkArround($b,$a);'>".$hints[$a][$b]."</textarea></td>";
										}else{
											echo "<td style='width:$width%;height:$width%;'><textarea maxlength='1' rows=1 cols=1 class='cells c$b r$a g$group' onkeypress='return onlyNos(event,this);' onkeydown='return noBackspace(event,this);' onkeyup='checkArround($b,$a);'>".$hints[$a][$b]."</textarea></td>";
										}
									}	
								}else{
									if(($j % 3) == 0 && $j != 9){
										if(($i % 3) == 0 && $i != 9){
											echo "<td style='border-right:solid 5px; border-bottom:solid 5px;width:$width%;height:$width%;'><textarea maxlength='1' rows=1 cols=1 class='cells c$b r$a g$group' onkeypress='return onlyNos(event,this);' onkeydown='return backspace(event,this,$b,$a);' onkeyup='checkArround($b,$a);'>".$hints[$a][$b]."</textarea></td>";
										}else{
											echo "<td style='border-right:solid 5px;width:$width%;height:$width%;'><textarea maxlength='1' rows=1 cols=1 class='cells c$b r$a g$group' onkeypress='return onlyNos(event,this);' onkeydown='return backspace(event,this,$b,$a);' onkeyup='checkArround($b,$a);'>".$hints[$a][$b]."</textarea></td>";
										}
									}else{
										if(($i % 3) == 0 && $i != 9){
											echo "<td style='border-bottom:solid 5px;width:$width%;height:$width%;'><textarea maxlength='1' rows=1 cols=1 class='cells c$b r$a g$group' onkeypress='return onlyNos(event,this);' onkeydown='return backspace(event,this,$b,$a);' onkeyup='checkArround($b,$a);'>".$hints[$a][$b]."</textarea></td>";
										}else{
											echo "<td style='width:$width%;height:$width%;'><textarea maxlength='1' rows=1 cols=1 class='cells c$b r$a g$group' onkeypress='return onlyNos(event,this);' onkeydown='return backspace(event,this,$b,$a);' onkeyup='checkArround($b,$a);'>".$hints[$a][$b]."</textarea></td>";
										}
									}
								}
								
							}
							echo "</tr>";
						}
					?>
    
</table>
			</div>
		</div>
		<!--<div id = "nav"></div>-->
		
		<div class = "clear"></div>
		
		<div id = "footer">
			&copy;By K3517001, K3517011, K3517021, K3517031, K3517041, K3517051, K3517061
		</div>
	</body>
	<script>
		function onlyNos(e, t) {
            try {
                if (window.event) {
                    var charCode = window.event.keyCode;
                }
                else if (e) {
                    var charCode = e.which;
                }
                else { return true; }
                if (charCode > 31 && (charCode < 49 || charCode > 57)) {
                    return false;
                }else{
                return true;}
            }
            catch (err) {
                alert(err.Description);
            }
        }
        function backspace(e, t, a, b){
        	try {
                if (window.event) {
                    var charCode = window.event.keyCode;
                }
                else if (e) {
                    var charCode = e.which;
                }
                else { return true; }
                if (charCode == 8) {
                	$.ajax({
                		url:"deleteVal.php",
                		method:"POST",
                		data:"row="+b+"&col="+a,
                		success: function(msg){
                			return true;
                		}
                	});
                }
            }
            catch (err) {
                alert(err.Description);
            }	
        }
        function noBackspace(e, t){
        	try {
                if (window.event) {
                    var charCode = window.event.keyCode;
                }
                else if (e) {
                    var charCode = e.which;
                }
                else { return true; }
                if (charCode == 8) {
                	return false;
                }else{
                	return true;
                }
            }
            catch (err) {
                alert(err.Description);
            }	
        }

        function checkArround(a,b){
        	var nilai = $(".cells.c"+a+".r"+b).val();
        	$.ajax({
        		url:"checkField.php",
        		method:"POST",
        		data:"nilai="+nilai+"&row="+b+"&col="+a,
        		success:function(msg){
        			var x = JSON.parse(msg);
        			if(x[0] == 0){
        				$(".cells.c"+a+".r"+b).val("");
        			}else if(x[1] == "a"){
        				alert("Congratulation!!! GAME OVER!!!");
        				$.ajax({
        					url:"sendTime.php",
        					method:"POST",
        					data:"time="+startCounter,
        					success:function(msg){
        						window.location.replace('result.php');
        					}
        				});
        			}
        		}
        	});
        }
	</script>
</html>
