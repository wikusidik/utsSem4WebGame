<!DOCTYPE html>
<html>
<head>
	<script src="asset/js/jquery.min.js" type="text/javascript"></script>
	<script src="asset/jquery-ui/jquery-ui.js" type="text/javascript"></script>
	<script>
		$(document).ready(function(){
			win = false;
			//=================================================================
			// ====================questBox section============================
			//document.oncontextmenu = function(){return false;};
			$("#difficult").change(function(){
				$("#detailLevel").show();
				$("#buttonField").show();
				var difficult = $("#difficult").val();
			});
			$("#closegame").click(function(){
				window.close(); //close window
			});		
		});
	</script>
	<link href="asset/css/style.css" type="text/css" rel="stylesheet">
</head>
<body>
<div id = "popupQuest">
			<div id = "upper">
				&nbsp;
			</div>
			<div id = "heading">
				<h2>Welcome to Sudoku</h2>
			</div>
			<div id = "questionField">
				<table>
					<tr>
						//pilih level
						<td>
							Select difficulty
						</td>
						<td>
							:
						</td>
						<td>
							<select id = "difficult" size = "1" autocomplete = "off">
								<option selected disabled>-- select --</option>
								<option value = "1">Easy</option>
								<option value = "2">Normal</option>
								<option value = "3">Expert</option>
							</select>
						</td>
					</tr>
				</table>
				<table id = "detailLevel">
					<tr>
						<td colspan = "4">
							<h4>User Detail:</h4>
						</td>
					</tr>
					<tr>
						<td colspan = "4">&nbsp;</td>
					</tr>
					<tr>
						<td>
							Username
						</td>
						<td>
							:
						</td>
						<td>
							<input type = "text" id = "username" value = "" size = "20" maxlength="20" />
						</td>
						<td></td>
					</tr>
				</table>
			</div>
			<div id = "buttonField"> 
				<button id = "playgame" class = "buttonField pullLeft" onclick="play()">PLAY!!<div id = "alertRule" class = "limitAlert">Follow the rules above!!</div>
				</button>
				
				<button id = "closegame" class = "buttonField pullRight">close game</button>
				<div class = "clear"></div>
			</div>
		</div>
		<script type="text/javascript">
			function play() {
				var username = $("#username").val();
				var level = $("#difficult").val();
				$.ajax({
					url:"setsession.php",
					method: "POST",
					data: "user="+username+"&level="+level, //data bentuk string ==> user=username&level=level, ikut aturan penggabungan string
					success: function(message){
						window.location.replace('main.php');
					}
				});	
			}
		</script>
</body>
</html>
