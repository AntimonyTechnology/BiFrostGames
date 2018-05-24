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
<header><img id="banner" src="BiFrostBanner.gif" alt="BiFrost Games"/></header>
<hr>
<nav>
<ul id="mySidenav" class="sidenav">
	<li><a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a></li>
	<li><a href="index.html" title="Browse products" class="viewing">Shop</a></li>	
	<li><a href="cart.html" title="View your cart" >My Cart</a></li>
	<li><a href="signup.html" title="Sign Up here!">Sign Up</a></li>
	<li class="icon"><a href="javascript:void(0);" style="font-size:15px;" onclick="myFunction()">&#9776;</a></li>
</ul>
</nav>
<span style="font-size:32px;cursor:pointer" onClick="openNav()">&#9776;</span>
	

<article>
	<h1>Products</h1>
	<nav class="console">
<ul>
	<li><a>All</a></li>
	<li><a>Xbox One</a></li>
	<li><a>PlayStation 4</a></li>
	<li><a>PC</a></li>
	<li><a>Nintendo Switch</a></li>
	
	
</ul>
</nav>

<div class="textBack" align="left" style="float:left" >
<?php header('charset=utf-8');
include ('connectionSQL.php');


 
 $result = mysqli_query($link,'select * from games');
 if ($result)   {
     $row_count = mysqli_num_rows($result);
     //print 'Retreived '. $row_count . ' rows from the <b> games </b> table<BR><BR>';
     
     while ($row = mysqli_fetch_array($result)) {
         print $row['name'] . '<br>' . '<span class=\'consoleName\'>' . $row['console_name'] . '</span><br>'. $row['description'] .'<br>' . '<img class=\'images\'; src= $row[\'image\']\'>' .'<br>' . $row['price'] . '<br>';
         echo '<hr name = \'productLine\'>';


     }
     
 }

?>
<br>
<br>
<br>
<br>
<br>
</div>
<br>
<br>
<br>
<br>

	

</article>

<hr>

<footer>
Copyright &copy; 2018 Curtis Naples	
</footer>

</body>
</html>