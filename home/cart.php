
<?php
session_start(); //We start the session 
if(empty($_SESSION["cart"])){
	echo "<p class='light'>Empty!</p>";
}else{
	echo"<div class='bold' style='height: 50px; padding: 0 10px; line-height:50px;'>Cart &bull; ".count($_SESSION["cart"])."</div>";
	krsort($_SESSION['cart']); //sorting in descending order
	echo"<div style='height: 300px; width:100%;overflow-y:scroll;z-index:5;'>";
	$total_cash = 0;
	foreach($_SESSION['cart'] as $product => $val) {
	$total_cash += $val[3];
	echo"
		<div style='margin: 5px 0'>
		<span class='light' style='display:inline-block;height:50px;min-width:50px;max-width:20%;overflow:hidden;'> 
			<img style='margin:0 5px;max-height:100%;max-width:100%;' src='../product_img/".$val[1]."'/> 
		</span>
		<span class='light' style='display:inline-block;padding: 5px;width:60%;'>
			<p class='normal ellipsis' style='width: 100%;text-align:left;'>$val[2]</p>
			<p class='ellipsis' style='font-size:12px;width:100%;text-align:left;'>Rs. ".number_format($val[3],2)."</p>
		</span>
		<span class='light' style='display:inline-block;float:right'>
			<form action='cart_process.php' method='POST'>
				<input type='hidden' name='data' value='".$product."'/>
				<input style='background:#eee;height:40px;width:40px;border-radius:20px;margin:5px;' type='submit' name='remove_btn' value='&#x2715;'/>
			</form>
		</span>
		</div>
	";
	} 
	echo"</div>";
	
	if(!empty($_SESSION["cart"])){
		echo"<div style='height: 50px;width:100%;'>";
			echo"<form style='height: 50px;width:100%;margin:0;padding:0;' action='cart_process.php' method='POST'>";
			echo'<div style="float:left;width:50%;height:50px;line-height:50px;text-align:center;">$'.number_format($total_cash, 2).'</div>';
			echo"<input style='display:block;float:left;background:#1a1a1a;color:#fff;height:50px;width:50%;border:0;margin:0;' type='submit' name='proceed_btn1' value='Proceed'/>";
			echo"</form>";
		echo"</div>";
	}
}
?>