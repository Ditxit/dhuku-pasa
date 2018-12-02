<?php	
	//function for header redirect !must be defined at top !!! important
	function redirect($location) {
		header("location: $location");
		exit();
	}
	
	// only starting sesson if there is not in existence
	if(session_status() == PHP_SESSION_NONE){
		session_start();
	}
	
	//if already logged !
	if(isset($_SESSION['adminname'])){ 	 
		$adminname = $_SESSION['adminname'];
		redirect("../product/");
	}
	
	//sesson message define
	if(isset($_SESSION['message'])){ 	 
		echo "<div class='sesson_message outer_shadow'><p>".$_SESSION['message']."</p></div>";
		unset ($_SESSION["message"]);
	}
	
	//if login button is set
	if (isset($_POST['login_btn'])){
		  
		// connect to database
		require_once '../assets/db_connection.php';
		 
		//take all submitted data
		$admin_id = mysqli_real_escape_string($db_con,$_POST['admin_id']);
		$password = mysqli_real_escape_string($db_con,$_POST['password']);
		 
		//hash the password
		//$hashPassword = md5($password); //using the same modified password...
		 
		$hashPassword = $password;
		
		//define sql and prepare statement
		$sql = "SELECT * FROM admin WHERE (admin_name = ?) AND (admin_pass = ?);";
		$stmt = mysqli_prepare($db_con, $sql);
		
		if($stmt){
			// Bind variables to the prepared statement as parameters
			mysqli_stmt_bind_param($stmt, "ss", $admin_id, $hashPassword);
				
			/* execute query */
			mysqli_stmt_execute($stmt);	
				
			/* fetch result */
			$result = mysqli_stmt_get_result($stmt);
				
			// Close statement
			mysqli_stmt_close($stmt);
				
			//close database	
			mysqli_close($db_con);
			
			//check if the no of row is 1 or not.
			if (mysqli_num_rows($result) == 1){
				$row = mysqli_fetch_assoc($result);
				$_SESSION['adminname'] = $row["admin_name"];
				$adminname = $_SESSION['admin_name'];
				$_SESSION['message'] = "<span style='color:#0f0;background:#fff;'>Logging in success</span>";
				redirect("../product/");
			}else{
				$_SESSION['message'] = "<span style='color:#f00;background:#fff;'>'Adminname' & 'Password' Invalid!</span>";
				redirect("../login/");
			}
		}else{
			echo "ERROR: Prepare statement error." ;
			mysqli_close($db_con);
		}
	}
?>

<html>
	<head>
		<link rel="stylesheet" href="style.css">
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
	</head>
	<body>
		<div id="login_div">
		  <form method="post" action="../login/" class="outer_shadow">
			<input class="inner_shadow" type="text" name="admin_id" placeholder="Adminname"/>
			<input class="inner_shadow" type="password" name="password" placeholder="Password"/>
			<input type="submit" name="login_btn" value="Login"/>
		  </form>
		</div>
	</body>
</html>