<?php
	session_start();
	$row = $_POST['row'];
	$col = $_POST['col'];
	$_SESSION['hints'][$row][$col] = "";
	$_SESSION['count']++;
?>