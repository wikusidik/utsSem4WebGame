<!DOCTYPE HTML>
<?php 
session_start();
require_once "conn.php";
$user = $_SESSION['username'];
$time = $_SESSION['score'];
$sql = "SELECT * FROM scores ORDER BY score asc limit 1";
$sql = mysqli_query($conn,$sql);
$fastUser = "";
$fastTime = "";
$fastPlay = "";
while($row=mysqli_fetch_array($sql)){
	$fastUser = empty($row['username'])? "" : $row['username'];
	$fastTime = empty($row['score'])? "" : $row['score'];
	$fastPlay = empty($row['playtime'])? "" : $row['playtime'];
}
$tanggal = date("d/M/Y");
$sql = mysqli_query($conn,"INSERT INTO scores(username,score,playtime) VALUES($user,$time,$tanggal)");
if($fastTime == "" || $fastTime > $time){
	$faster = true;
}
?>
<html>
	<head>
		<script src = "asset/js/jquery.min.js" type = "text/javascript"></script>
		<script src = "asset/jquery-ui/jquery-ui.js" type = "text/javascript"></script>
		<link href = "asset/css/style.css" type = "text/css" rel = "stylesheet" />
	</head>
	<body>
		<div id = "header">
			<div id = "logo-sudoku">
				<div id = "logo">
				</div>
			</div>
			<div class = "clear"></div>
		</div>
		<div id = "container">
			<table width="700" height="302" border="1" align="center" style="margin-top:80px;margin-left:-70px;">
				<tr>
					<td bgcolor="#ffffff"><h2><p align="center">SELAMAT <?php echo $user;?></p></h2>
						<h2><p align="center">ANDA TELAH BERHASIL DALAM WAKTU <?php echo $time;?> DETIK  </p></h2>
						<br>
						<br>
						<h5><p align="center"><?php if($faster==false){echo "Fastest time ".$fastTime." by ".$fastUser." on ". $fastPlay;}else{echo "YOU BEAT THE FASTEST TIME!!!!";} unset($_SESSION);?> </p></h5>
						<br><p align="center"><a href="index.php">kembali</a></p></td>
				</tr>
			</table>
		</div>
		<!--<div id = "nav"></div>-->
		
		<div class = "clear"></div>
		
		<div id = "footer">
			&copy;By K3517001, K3517011, K3517021, K3517031, K3517041, K3517051, K3517061
		</div>
	</body>
</html>