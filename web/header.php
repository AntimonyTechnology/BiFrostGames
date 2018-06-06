<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8">
<link rel="stylesheet" href="default.css">
<title>BiFrost Games</title>
<style>
	
</style>

<script>
function myFunction() {
	var x = document.getElementById("myTopnav");
	if (x.className === "topnav") {
		x.className += " responsive";
	} else {
		x.className = "topnav";
	}
}
function openNav() {
    document.getElementById("mySidenav").style.width = "250px";
}
function closeNav() {
    document.getElementById("mySidenav").style.width = "0";
}


</script>


</head>

<body>
<hr>
<header><a href="index.php"><img id="banner" src="BiFrostBanner.gif" alt="BiFrost Games"/></a></header>

<nav>
	
<ul id="mySidenav" class="sidenav">
	<!--add class="viewing" to <a> tag to select page being viewed-->
	<li><a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a></li>
	<li><a href="products.php" title="Browse products" >Shop</a></li>	
	<li><a href="cart.php" title="View your cart" >My Cart</a></li>
	<li><a href="orderHistory.php" title="View your order history">Order History</a></li>
	
	<!-- Persistant login -->
	<?php
	session_start();
	include ('connectionSQL.php');
	
	
	if (isset($_SESSION['user_id'])) {
	    // print_r($_SESSION);
	    $user = $_SESSION['user_id'];
	    $role = $_SESSION['admin'];
	    //echo "<p>User:  $user <br/> Role: $role</p>";
		if ($_SESSION['admin'] == 1){
			print "<li><a href='addProducts.php' title='Add more products' >Add Product</a></li>";
		}//END OF ADMIN CHECK
		print "<li><a href='logOut.php' class='logout' >Log Out</a></li>";
	} 
	else {
		print "<li><a href='login.php' title='Login' id='login' >Log In</a></li>";
	} //END of SESSION==TRUE
	?>
	<!-- END of Persistant login -->
	<li class="icon"><a href="javascript:void(0);" style="font-size:15px;" onclick="myFunction()">&#9776;</a></li>
</ul>
</nav>
<?php
if (isset($_SESSION['user_id'])) {
	echo "<nav><div style='padding-right: 35px'><ul align='right'><li><a href='logOut.php' class='loginButton' style='padding: 10px' >Log Out</a></li></ul></div>";	
}
else {
	echo "<nav><div style='padding-right: 35px'><ul align='right'><li><a href='login.php' class='loginButton' id='login' style='padding: 10px' >Log In</a></li></ul></div>";
}
	echo "<span style='font-size:36px;cursor:pointer;padding: 10px;' onClick='openNav()'><a>&#9776;</a></span></nav>";



?>




