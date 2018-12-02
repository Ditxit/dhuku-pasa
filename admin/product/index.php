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
td a{
	display: block;
	padding: 5px;
}
@media screen and (max-width:730px) {
	table{
		width:100%;
	}
}
</style>

<head>
<body>


<?php
	//including nav
	require_once '../nav/index.php';
	
	//data base is required once
	require_once '../assets/db_connection.php';
	
	$query = "SELECT * FROM product ORDER BY product_id DESC;";
	$result = mysqli_query($db_con, $query);
	
	if(mysqli_num_rows($result) > 0){
		$count = 1;
		echo"<table>";
			echo"
			<tr>
				<th colspan='8'>Products</th>
			</tr>
			<tr><th colspan='8'><a href='add.php' style='color:#00f;'>Add New Product</a></th></tr>
			<tr>
				<th>S.N</th>
				<th>Image</th>
				<th>Name</th>
				<th>Info</th>
				<th>Price</th>
				<th>Stock</th>
				<th>Category</th>
				<th>Actions</th>
			</tr>";
			while($row = mysqli_fetch_assoc($result)){
				echo"<tr>
					<td>".$count."</td>
					<td><img style='max-height:60px;max-width:60px;' src='../../product_img/".$row['product_pic']."'/></td>
					<td>".$row['product_name']."</td>
					<td>".$row['product_info']."</td>
					<td>".$row['product_price']."</td>	
					<td>".$row['product_stock']."</td>	
					<td>".$row['product_cat']."</td>
					<td>
						<a href='edit.php?product_id=".$row['product_id']."' style='color:#00f;'>Edit</a>
						<a href='delete.php?product_id=".$row['product_id']."' style='color:#f00;'>Delete</a>
					</td>
				</tr>";	
				$count++;
			}
		echo"</table>";
	}else{
		echo"<table>
		<tr><th><a href='add.php' style='color:#00f;'>&#x271A; Add New Product</a></th></tr>
		<tr><td>Nothing to show here</td></tr>
		</table>";
	}
?>
</body>
</html>