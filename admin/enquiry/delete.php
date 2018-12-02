<?php
	session_start();
	if(isset($_GET["enquiry_id"])){
	
	//data base is required once
	require_once '../assets/db_connection.php';
	
	$enquiry_id = (int)mysqli_real_escape_string($db_con,$_GET["enquiry_id"]);
	
	$query = "DELETE FROM enquiry WHERE enquiry_id = $enquiry_id;";
	$result = mysqli_query($db_con, $query);
	
	header("location: ../enquiry/");
	exit();
	}
?>