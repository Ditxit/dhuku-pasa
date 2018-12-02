<?php
	//including nav
	require_once '../nav/index.php';
	
	//data base is required once
	require_once '../assets/db_connection.php';
	
?>
<html>
<head>
	<title></title>
	<link rel="stylesheet" href="style.css">
</head>
<body>
<div class="main_wrapper">
	<div class="wrapper">
		<div class="left_div">
			<?php
			
			//querys
			if(isset($_SESSION["search_key"]) && isset($_SESSION["search_cat"]) && (!empty($_SESSION["search_key"]) || !empty($_SESSION["search_cat"]))){
				$key =  mysqli_real_escape_string($db_con, $_SESSION["search_key"]);
				$cat = mysqli_real_escape_string($db_con, $_SESSION["search_cat"]);
				if(($key != "") && ($cat != "")){
					$query = "SELECT * FROM product WHERE (product_name LIKE '%$key%') OR (product_cat LIKE '%$cat%') ORDER BY product_id DESC;";
					$msg = "Search for '$key' in category '$cat'";
				}elseif($key != ""){
					$query = "SELECT * FROM product WHERE (product_name LIKE '%$key%') OR (product_cat LIKE '%$key%') OR (product_info LIKE '%$key%') ORDER BY product_id DESC;";
					$msg = "Search for '$key'";
				}elseif($cat != ""){
					$query = "SELECT * FROM product WHERE (product_cat LIKE '%$cat%') ORDER BY product_id DESC;";
					$msg = "Search in category '$cat'";
				}
				
				echo "
				<div class='card border_all radius' style='margin-bottom:15px;'>
					<span style='float:left;padding: 10px;'> $msg </span>
					<form style='float:right;' action='cart_process.php' method='POST'>
						<input style='padding: 10px;' class='radius' class='normal' type='submit' name='remove_search' value='&#x2716;'>
					</form>
					
				</div>";	
			}else{
				$query = "SELECT * FROM product WHERE product_stock > 0 ORDER BY product_id DESC;";
			}
			$result = mysqli_query($db_con, $query);
			
			
			if(mysqli_num_rows($result) > 0){
				$count = 1;
				while($row = mysqli_fetch_assoc($result)){
					echo"<div class='card border_all radius'>";
						echo"<div class='card_head border_bottom'>";
							echo"<div class='left'>".$count."&#x275C;</div>";
							echo"<div class='center'>";
								echo"<div class='bold ellipsis'>".$row['product_name']."</div>";
								echo"<div class='light ellipsis'>Rs. ".number_format($row['product_price'],2)." &bull; ".$row['product_cat']."</div>";	
							echo"</div>";
							
							echo"<form class='add_form' action='cart_process.php' method='POST'>
								<input type='hidden' name='data[]' value='".$row['product_id']."'>
								<input type='hidden' name='data[]' value='".$row['product_pic']."'>
								<input type='hidden' name='data[]' value='".$row['product_name']."'>
								<input type='hidden' name='data[]' value='".$row['product_price']."'>
								<input class='right normal' type='submit' name='add_btn' value='&#x271A;&nbsp;&nbsp;Cart'>
							</form>";
						echo"</div>";
						echo"<div class='card_body'>";
							echo '<img alt="Product image" src="../product_img/'.$row['product_pic'].'" />'; 
						echo"</div>";
						echo"<div class='card_foot'><p>".$row['product_info']."</p></div>";
						echo"<form class='' action='cart_process.php' method='POST'>
							<input type='hidden' name='enq_product' value='".$row['product_name']."'>
							<input style='margin:0 0 20px 20px;height:34px;width:120px;background:#eee;color:#555;border-radius:17px' class='normal' type='submit' name='enq_btn1' value='Enquiry  &#10140;'>
						</form>";
					echo"</div>";
					$count++;
				}
			}else{
				echo"<div class='card border_all radius' style='height: 150px;float:left;'>
				<span style='display:block;padding: 10px;'>Nothing found to display</span>
				</div>";
			}
			?>
		</div>	
		<div class="right_div desk_only">
			<div class="right_div_head border_bottom bold">
				Cart &bull;
				<?php echo count($_SESSION["cart"]); ?>
			</div>
			<div class="right_div_body border_bottom">
				<?php
					if(empty($_SESSION["cart"])){
						echo "<p class='light'>Empty!</p>";
						//array_push($_SESSION["cart"], "apple", "ball");
					}else{
						krsort($_SESSION['cart']); //sorting in descending order
						echo"<table>";
						//<td class='light'> $product </td>
						$total_cash = 0;
						foreach($_SESSION['cart'] as $product => $val) {
							$total_cash += $val[3];
							echo"
							<tr>
								<td class='light' style='height:60px;width:60px;overflow:hidden;'> 
									<img style='max-height:100%;max-width:100%;' src='../product_img/".$val[1]."'/> 
								</td>
								<td class='light' style='padding: 5px;'>
									<p class='normal ellipsis' style='width: 175px;'>$val[2]</p>
									<p class='ellipsis' style='font-size:12px;width:175px;'>Rs. ".number_format($val[3],2)."</p>
								</td>
								<td class='light' style='background:#fafafa'>
									<form action='cart_process.php' method='POST'>
										<input type='hidden' name='data' value='".$product."'/>
										<input style='font-size:8px;text-align:center;display:block;width:15px;height:15px;line-height:15px;background:#cacaca;color:#ffffff; border-radius:50%; margin: 0 7px;'
										type='submit' name='remove_btn' value='&#x2715;'/>
									</form>
								</td>
							</tr>
							";
						} 
						echo"</table>";
					}
					//session_destroy();
				?>
			</div>
			<div class="right_div_foot">
			<?php 
			if(!empty($_SESSION["cart"])){
				echo"<form action='cart_process.php' method='POST' class='border_bottom'>";
				echo'<p class="left">Rs. '.number_format($total_cash, 2).'</p>';
				echo"<input class='right' type='submit' name='proceed_btn1' value='Proceed'/>";
				echo"</form>";
			}
			?>
			<form class="extra_links" action="cart_process.php" method="POST">
				<input class="extra_links" type="submit" name="contact_btn" value="Contact"/>
				<input class="extra_links" type="submit" name="map_btn" value="&bull; Map"/>
				<input class="extra_links" type="submit" name="facebook_btn" value="&bull; Facebook"/>
				<input class="extra_links" type="submit" name="instagram_btn" value="&bull; Instagram"/>
				<input class="extra_links" type="submit" name="twitter_btn" value="&bull; Twitter"/>
			</form>	
			<p class="extra_links">&copy; Copyright <?php echo date("Y");?></p>
			</div>
		</div>
	</div>
</div>
</body>

</html>