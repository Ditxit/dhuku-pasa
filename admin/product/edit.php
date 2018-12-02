<?php
if(isset($_POST['edit_product'])){
	//data base is required once
	require_once '../assets/db_connection.php';
	$target = "../../product_img/";
	
	//getting datas
	$product_id=$_POST['product_id'];
	$product_name=$_POST['product_name'];
	$product_info=$_POST['product_info'];
	$product_price=$_POST['product_price'];
	$product_stock=$_POST['product_stock'];
	$product_cat=$_POST['product_cat'];
	
	//Saving the image
	if($_FILES['product_pic']['name'] != ""){
		//handle, file is here!
		$target1 = $target . basename( $_FILES['product_pic']['name']);
		
		if(move_uploaded_file($_FILES['product_pic']['tmp_name'], $target1)) {
			$product_pic = basename( $_FILES['product_pic']['name']);
			//echo"Image front added to file";
			
			$query = "UPDATE product SET 
			product_name= '$product_name',
			product_pic= '$product_pic',
			product_info= '$product_info',
			product_price= '$product_price',
			product_stock= '$product_stock',
			product_cat= '$product_cat' 
			WHERE product_id = $product_id ";
		}else{
			echo "There was problem adding image front to file</br>";
		}
	}else{
		$query = "
		UPDATE product SET 
		product_name= '$product_name',
		product_info= '$product_info',
		product_price= '$product_price',
		product_stock= '$product_stock',
		product_cat= '$product_cat' 
		WHERE product_id = $product_id ";
	}
		
	//Writes the information to the database		
	$result = mysqli_query($db_con, $query);
	if($result){
		mysqli_close($db_con);
		header("location: ../product/");
	exit();
	}else{
		$_SESSION['message'] = "<span style='color:#f00;'>&#10007;&nbsp;</span>Product Posting Failed !";
		mysqli_close($db_con);
		header("location: ../product/");
		exit();
	}		
}
?>



<html>
<head>
<style>
table {
	border-collapse: collapse;
	background: #fff;
	width: 720px;
	margin: 10px auto;
	border: 1.5px solid #ececec;
}

table, td, th {
    border: 1px solid #ddd;
	padding: 10px;
}
input,select{
	width: 100%;
	padding: 10px;
	border:0;
	border: 1px solid #1a1a1a;
}
input[type=submit]{
	background:#1a1a1a;
	color: #fff;
}
</style>

<head>
<body>
<?php
	if(isset($_GET["product_id"])){
		$product_id = (int) $_GET["product_id"];
		
		//including nav
		require_once '../nav/index.php';
		
		//data base is required once
		require_once '../assets/db_connection.php';
		
		$query = "SELECT * FROM product WHERE product_id = $product_id;";
		$result = mysqli_query($db_con, $query);
		
		if(mysqli_num_rows($result) == 1){
			$row = mysqli_fetch_assoc($result);
			echo"<form action='edit.php' method='POST' enctype='multipart/form-data'><table>";
			
				echo"
				<input type='hidden' name='product_id' value='".$row['product_id']."'/>
				<tr><th colspan='10'>Edit Product</th></tr>
				<tr>
					<td>Product Name<input type='text' name='product_name' value='".$row['product_name']."'/></td>
				</tr>
				<tr>
					<td>
					Product Picture (*leave if you dont'want to update)
					<input type='file' name='product_pic' accept='image/*'/>
					</td>
				</tr>
				<tr>
					<td>Product Info<input type='text' name='product_info' value='".$row['product_info']."'/></td>
				</tr>
				<tr>
					<td>Product Price<input type='text' name='product_price' value='".$row['product_price']."'/></td>
				</tr>
				<tr>
					<td>Product Stock<input type='text' name='product_stock' value='".$row['product_stock']."'/></td>
				</tr>
				<tr>
					<td>
						Product Category
						<select name='product_cat'>
							<option value='".$row['product_cat']."'>".$row['product_cat']."</option>
							<option value='carpet'>Carpet</option>
							<option value='bag'>Bag</option>
							<option value='metal craft'>Metal Crafts</option>
							<option value='dhaka'>Dhaka Product</option>
						</select>
					</td>
				</tr>
				<tr>
					<td><input type='submit' name='edit_product'/></td>
				</tr>";	
			echo"</table></form>";
		}
		
	}
?>
</body>
</html>
