<?php
	session_start();
	if(isset($_GET["product_id"])){
	
	//data base is required once
	require_once '../assets/db_connection.php';
	
	$product_id = (int)mysqli_real_escape_string($db_con,$_GET["product_id"]);
	
	$query = "DELETE FROM product WHERE product_id = $product_id;";
	$result = mysqli_query($db_con, $query);
	
	header("location: ../product/");
	exit();
	}
?>