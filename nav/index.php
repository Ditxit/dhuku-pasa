<?php
	//function for header redirect !must be defined at top !!! important
	function redirect($location) {
		header("location: $location");
		exit();
	}
	
	// only starting sesson if there is not in existence
	if(session_status() == PHP_SESSION_NONE){
		$expire = 30*24*3600; //We choose a one month duration

		ini_set('session.gc_maxlifetime', $expire);

		session_start(); //We start the session 

		setcookie(session_name(),session_id(),time()+$expire);
		
		if ( !isset( $_SESSION["cart"] ) ) { 
			$_SESSION["cart"] = array(); 
		} 
	}
?>
<html>
<head>
	<link rel="stylesheet" href="../nav/style.css">
	<link href="https://fonts.googleapis.com/css?family=Poppins" rel="stylesheet">
	<script src="../assets/js_v1.4.js" type="text/javascript"></script>
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
	

	<script type="text/javascript">
	$(document).ready(function(){
		$('.modal_head').click(function(e){
			e.preventDefault();
			$('.modal_wrapper').hide();
		});
		
		
		$(".modal_wrapper").hide();
		
		<?php if(isset($_SESSION["modal_link"]) && $_SESSION["modal_link"] != ""){ ?>
			var link = "<?php echo "../home/".$_SESSION['modal_link']; ?>";
			//alert(link);
			$(".modal_body").load(link);
			$(".modal_wrapper").show();
			link = "";
		<?php
			$_SESSION["modal_link"] = ""; 
			}
		?>
	});
	</script>
	
	
	
	
	
	
	
</head>
<body>
<div id="header" class="border_bottom">
	<div class="container">
		<a href="../home/">
			<img style="cursor:pointer;" class="logo" src="../assets/logo.png"/>
		</a>
		<div class="nav">
			<form action="cart_process.php" method="POST">
				<input type="submit" class="search_btn" value="&#x26AB; Search" name="search_btn1"/>
			</form>
			<form class="mob_only" action="cart_process.php" method="POST">
				<input type="submit" value="&#x26AB; Cart" name="show_cart"/>
			</form>
		</div>
	</div>
</div>

<!-- This is model showing code for html -->
<div class="modal_wrapper">
	<div class="modal center_me radius border_all">
		<div class="modal_head radius">&#x2716;</div>	
		<div class="modal_body"></div>	
	</div>
</div>

</body>
</html>