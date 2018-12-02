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
	
	$query = "SELECT * FROM enquiry ORDER BY enquiry_id DESC;";
	$result = mysqli_query($db_con, $query);
	
	if(mysqli_num_rows($result) > 0){
		$count = 1;
		echo"<table>";
			echo"
			<tr><th colspan='10'>Enquiries</th></tr>
			<tr>
				<th>S.N</th>
				<th>Name</th>
				<th>For Product</th>
				<th>Email</th>
				<th>Message</th>
				<th>Actions</th>
			</tr>";
			while($row = mysqli_fetch_assoc($result)){
				echo"<tr>
					<td>".$count."</td>
					<td>".$row['enquiry_by']."</td>
					<td>".$row['enquiry_for']."</td>
					<td>".$row['enquiry_email']."</td>	
					<td>".$row['enquiry_msg']."</td>	
					<td>
						<a href='delete.php?enquiry_id=".$row['enquiry_id']."' style='color:#f00;'>Delete</a>
					</td>
				</tr>";	
				$count++;
			}
		echo"</table>";
	}else{
		echo"<table>
		<tr><th>Enquiries</th></tr>
		<tr><td>Nothing to show here</td></tr>
		</table>";
	}
?>
</body>
</html>