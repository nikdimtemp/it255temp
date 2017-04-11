<?php
	include("functions.php");
	
	header("Content-Type: application/json");
	echo json_encode(getAllUsers());
?>