
<?php
session_start();

//adding form data into cart
if(isset($_POST["add_btn"])){
	$data = $_POST["data"];
	array_push($_SESSION["cart"], $data);
	//$_SESSION['message'] = "Product added";
	header("location: ../home/");
	exit();
}
//delete form data from cart
if(isset($_POST["remove_btn"])){
	$data = (int)$_POST["data"];
	unset($_SESSION["cart"][$data]);
	//$_SESSION['message'] = "Product removed";
	header("location: ../home/");
	exit();
}


//processing to search (step 1)
if(isset($_POST["search_btn1"])){
	$_SESSION["modal_link"] = "search.php";
	header("location: ../home/");
	exit();
}
//processing to search (step 2)
if(isset($_POST["search_btn2"])){
	$_SESSION["search_key"] = $_POST["keyword"];
	$_SESSION["search_cat"] = $_POST["category"];
	header("location: ../home/");
	exit();
}

//processing to remove search
if(isset($_POST["remove_search"])){
	$_SESSION["search_key"] = null;
	$_SESSION["search_cat"] = null;
	header("location: ../home/");
	exit();
}




//processing to check out (step 1)
if(isset($_POST["proceed_btn1"])){
	$_SESSION["modal_link"] = "buyer_info.php";
	header("location: ../home/");
	exit();
}

//processing to check out (step 2)
if(isset($_POST["proceed_btn2"])){
	krsort($_SESSION['cart']); //sorting in descending order
	$total_cash = 0;
	$product_names = " ";
	foreach($_SESSION['cart'] as $product => $val) {
		$product_names = $product_names."".$val[2]."</br></br>";
		$total_cash += $val[3];
	}
	
	//data base is required once
	require_once '../assets/db_connection.php';
	
	$order_name = mysqli_real_escape_string($db_con, $_POST["buyer_name"]);
	$order_email = mysqli_real_escape_string($db_con, $_POST["buyer_email"]);
	$order_phone = (int)$_POST["buyer_phone"];
	$order_country = mysqli_real_escape_string($db_con, $_POST["buyer_country"]);
	$order_zip = (int)$_POST["buyer_zipcode"];
	$order_street = mysqli_real_escape_string($db_con, $_POST["buyer_street"]);
	$order_products = mysqli_real_escape_string($db_con, $product_names);
	$order_total = mysqli_real_escape_string($db_con, $total_cash);
	
	//echo"$order_products";
	$query = "INSERT INTO 
	order_list (order_name, order_email, order_phone, order_country, order_zip, order_street, order_products, order_total) 
	VALUES ('$order_name', '$order_email', '$order_phone', '$order_country', '$order_zip', '$order_street', '$order_products', '$order_total');";
	mysqli_query($db_con, $query);
	$_SESSION['cart'] = null;
	
	//$_SESSION['message'] = "Your order is placed";
	
	header("location: ../home/");
	exit();
}

//User enquiry about the product (step 1)
if(isset($_POST["enq_btn1"])){
	$_SESSION["modal_link"] = "product_enquiry.php";
	$_SESSION["enq_product"] = $_POST["enq_product"];
	header("location: ../home/");
	exit();
}
//User enquiry about the product (step 2)
if(isset($_POST["enq_btn2"])){
	//data base is required once
	require_once '../assets/db_connection.php';
	
	$product_name = mysqli_real_escape_string($db_con, $_SESSION["enq_product"]);
	$buyer_name = mysqli_real_escape_string($db_con, $_POST["buyer_name"]);
	$buyer_email = mysqli_real_escape_string($db_con, $_POST["buyer_email"]);
	$buyer_msg = mysqli_real_escape_string($db_con, $_POST["buyer_msg"]);
	
	$query = "INSERT INTO 
	enquiry (enquiry_by,enquiry_for,enquiry_email,enquiry_msg) 
	VALUES ('$buyer_name','$product_name','$buyer_email','$buyer_msg');";
	mysqli_query($db_con, $query);
	
	$_SESSION["enq_product"]= null;
	header("location: ../home/");
	exit();
}

//btn to show cart in mobile
if(isset($_POST["show_cart"])){
	$_SESSION["modal_link"] = "cart.php";
	header("location: ../home/");
	exit();
}

//getting contact_us form data
if(isset($_POST["contact_btn"])){
	$_SESSION["modal_link"] = "extra_links/contact.php";
	header("location: ../home/");
	exit();
}
//getting about_us form data
if(isset($_POST["map_btn"])){
	$_SESSION["modal_link"] = "extra_links/map.php";
	header("location: ../home/");
	exit();
}
//getting facebook form data
if(isset($_POST["facebook_btn"])){
	header("location: https://www.facebook.com/");
	exit();
}
//getting instagram form data
if(isset($_POST["instagram_btn"])){
	header("location: https://www.instagram.com/");
	exit();
}
//getting twitter form data
if(isset($_POST["twitter_btn"])){
	header("location: https://www.twitter.com/");
	exit();
}
?>