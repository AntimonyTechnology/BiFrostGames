<html>
<head>
<link rel="stylesheet" href="default.css">
<title>Add a product</title>

<script>
function openNav() {
    document.getElementById("mySidenav").style.width = "250px";
}
function closeNav() {
    document.getElementById("mySidenav").style.width = "0";
}
</script>

</head>
<body>
<header>BiFrost Games</header>

<nav>
<ul id="mySidenav" class="sidenav">
	<li><a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;&ensp;</a></li>
	<li><a href="index.html" title="Browse products" class="viewing">Shop</a></li>	
	<li><a href="info.html" title="View your cart" >My Cart</a></li>
	<li><a href="signup.html" title="Sign Up here!">Sign Up</a></li>
	<li class="icon"><a href="javascript:void(0);" style="font-size:15px;" onclick="myFunction()">&#9776;</a></li>
</ul>
</nav>

<span style="font-size:32px;cursor:pointer" onClick="openNav()">&#9776;</span>

<h1>Add Product</h1>

<div class="textBack" align="left" style="float:left" >

<form action="" method="GET">
<p>Game Name: <input type="text" name="gamename" /></p>
<p>Description: <input type="text" name="gamedesc" /></p>
<p>IMAGE: <input type="file" name="image" /> </p>
<p>Price: <input type="text" name="price" /></p>
<p>Console: 
<input type="radio" name="console" value="PS4"> PS4
<input type="radio" name="console" value="XBOX"> XBOX ONE
<input type="radio" name="console" value="PC"> PC
<input type="radio" name="console" value="SWITCH"> SWITCH</p>

<p> Genre:
<input type="radio" name="genre" value="action"> ACTION
<input type="radio" name="genre" value="adventure"> ADVENTURE
<input type="radio" name="genre" value="strategy"> STRATEGY
<input type="radio" name="genre" value="RPG"> RPG</p>

<input type="submit" value="Submit" />
</form>
</div>
<footer>
Copyright &copy; 2018 Curtis Naples	
</footer>
</body>
</html>