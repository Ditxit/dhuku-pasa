<style>
.this_form{
	padding: 30px;
}
.this_input{
	width: 100%;
	height: 40px;
	text-align: left;
	padding:0;
	margin: 5px 0 0 0;
	border-bottom: 1px solid #9a9a9a;
}
.this_input:active,.this_input:focus{
	border-bottom: 1px solid #1a1a1a;
}
.this_submit{
	width: 104px;
	float: right;
	height: 34px;
	border-radius: 17px;
	border
	padding:0;
	margin: 15px 0 0 0;
	background: #1a1a1a;
	color: #ffffff;
}
</style>
<?php session_start(); ?>
<form  class="this_form" action="cart_process.php" method="POST">
<p class="bold">Fill your info</p>
<input class="this_input" placeholder="Person / Company name" type="text" name="buyer_name" required/>
<input class="this_input" placeholder="Email" type="email" name="buyer_email" required/>
<input class="this_input" placeholder="Phone" type="number" name="buyer_phone" required/>
<input class="this_input" placeholder="Country" type="text" name="buyer_country" required/>
<input class="this_input" placeholder="Zip / Postal code" type="text" name="buyer_zipcode" required/>
<input class="this_input" placeholder="Street" type="text" name="buyer_street" required/>
<input class="this_submit" type="submit" name="proceed_btn2" value="Checkout"/>
</form>