<?php	
	$servername = "localhost";
	$db_username = "root";
	$db_password = "";
	$db_name = "dhukupasa_db";

	// Create connection
	$db_con = mysqli_connect($servername, $db_username, $db_password, $db_name);

	// Check connection
	if (!$db_con) {
		die("Failed connecting to database: " . mysqli_connect_error());
	}else{
		//echo"</br></br></br>Connected to db";
	}
?> 