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
	
	$query = "SELECT * FROM order_list ORDER BY order_id DESC;";
	$result = mysqli_query($db_con, $query);
	
	if(mysqli_num_rows($result) > 0){
		$count = 1;
		echo"<table>";
			echo"
			<tr><th colspan='10'>Orders</th></tr>
			<tr>
				<th>S.N</th>
				<th>Name</th>
				<th>Email</th>
				<th>Phone</th>
				<th>Country</th>
				<th>Zip</th>
				<th>Street</th>
				<th>Products</th>
				<th>Total</th>
				<th>Actions</th>
			</tr>";
			while($row = mysqli_fetch_assoc($result)){
				echo"<tr>
					<td>".$count."</td>
					<td>".$row['order_name']."</td>
					<td>".$row['order_email']."</td>
					<td>".$row['order_phone']."</td>
					<td>".$row['order_country']."</td>	
					<td>".$row['order_zip']."</td>	
					<td>".$row['order_street']."</td>
					<td>".$row['order_products']."</td>
					<td>Rs. ".$row['order_total']."</td>
					<td>
						<a href='delete.php?order_id=".$row['order_id']."' style='color:#f00;'>Delete</a>
					</td>
				</tr>";	
				$count++;
			}
		echo"</table>";
	}else{
		echo"<table>
		<tr><th>Orders</th></tr>
		<tr><td>Nothing to show here</td></tr>
		</table>";
	}
?>
</body>
</html>