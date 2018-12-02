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
	
	//for showing sesson message
	if(isset($_SESSION['adminname'])){ 	 
		$adminname = $_SESSION['adminname'];
	}else{
		redirect("../login/");
	}
	
	//for showing sesson message
	if(isset($_SESSION['message'])){ 	 
		echo "<div class='sesson_message outer_shadow'><p>".$_SESSION['message']."</p></div>";
		unset ($_SESSION["message"]);
	}
?>
<html>
<head>
	<link rel="stylesheet" href="../nav/style.css">
	<link href="https://fonts.googleapis.com/css?family=Roboto+Condensed" rel="stylesheet">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
</head>
<body>
<div id="header" class="outer_shadow">
	<div class="container">
		<a href="../product/">
			<img style="cursor:pointer;" class="logo" src="../assets/logo.png"/>
		</a>
		<div class="nav">
			<a href="../product/">
				Products
			</a>
			<a href="../order/">
				Orders
			</a>
			<a href="../enquiry/">
				Enquiries
			</a>
			<a href="../logout/">
				Logout
			</a>
		</div>
	</div>
</div>
<div class="gapFiller"></div>
</body>
</html>