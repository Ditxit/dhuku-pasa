<?php
	session_start();
	if(isset($_GET["order_id"])){
	
	//data base is required once
	require_once '../assets/db_connection.php';
	
	$order_id = (int)mysqli_real_escape_string($db_con,$_GET["order_id"]);
	
	$query = "DELETE FROM order_list WHERE order_id = $order_id;";
	$result = mysqli_query($db_con, $query);
	
	header("location: ../order/");
	exit();
	}
?>