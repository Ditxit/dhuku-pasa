<style>
textarea:focus, input:focus, select:focus{
    outline: none;
}
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
.this_textarea{
	height: 170px;
	border: none;
	resize: none;
	border-bottom: 1px solid #9a9a9a;
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
<p class="bold">Product Name</p>
<input class="this_input" placeholder="Search" type="text" name="keyword" value=""/>

<p class="bold" style="margin: 15px 0 0 0;">Product Category</p>
<select class="this_input" style="border:0;border-bottom: 1px solid #9a9a9a;" name="category">
  <option value="">All</option>
  <option value="Carpet">Carpet</option>
  <option value="Bag">Bag</option>
  <option value="Metal craft">Metal Crafts</option>
  <option value="Dhaka">Dhaka Product</option>
</select>

<input class="this_submit" type="submit" name="search_btn2" value="Search"/>
</form>