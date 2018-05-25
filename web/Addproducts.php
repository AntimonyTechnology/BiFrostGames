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
function validation() {
if (document.getElementById("gamename").value.length < 1 ){
	alert("You must include a Game Name");
	return false;
}
//if (document.getElementById("gamedesc").value == ''){
	//alert("You must include a game description");
	//return false;
//}
//if (document.getElementById("image").value == ''){
	//alert("You must include a image");
	//return false;
//}
if (document.getElementById("price").value == ''){
	alert("You must include a price");
	return false;
}
//if (document.getElementById("price").value != /^\d+(\.\d{1,2})?$/ ){
	//alert("Price can only be a number");
	//return false;
//}
var priceexp = /^\d+(\.\d{1,2})?$/;
var exptest = priceexp.test(document.getElementById("price").value);
if(!exptest){
	alert("Price can only be a number");
	return false;
}

 var inputElems = document.getElementsByTagName("input");
      var count = 0;
      for (var i=0; i<inputElems.length; i++) {
        if (inputElems[i].type === "checkbox" && inputElems[i].checked === true) {
          count++;
        }
      }
      if(count < 1){
        alert("You must select a genre");
        return false;
      }

}
</script>

</head>
<body>
<header><img id="banner" src="BiFrostBanner.gif" alt="BiFrost Games"/></header>
<hr>
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

<form action="ProductInsert.php" method="POST" enctype="multipart/form-data" onsubmit="return validation();">
<input type="hidden" name="MAX_FILE_SIZE" value="100000">
<p>Game Name: <input type="text" name="gamename" id="gamename" /></p>
<p>Description: <input type="textarea" name="gamedesc" id="gamedesc" /></p>
<p>IMAGE: <input type="text" name="image" id="image" /> </p>
<p>Price: <input type="text" name="price" id="price" /></p>
<p>Console: 
<input type="radio" name="console" value="PS4" required> PS4
<input type="radio" name="console" value="XB1" required> XBOX ONE
<input type="radio" name="console" value="PC" required> PC
<input type="radio" name="console" value="Nintendo_Switch" required> SWITCH</p>

<p> Genre:
<input type="checkbox" name="genre[]" value="action"> Action
<input type="checkbox" name="genre[]" value="adventure"> Adventure
<input type="checkbox" name="genre[]" value="strategy"> Strategy
<input type="checkbox" name="genre[]" value="rpg"> RPG
<input type="checkbox" name="genre[]" value="MMO"> MMO
<input type="checkbox" name="genre[]" value="open-world"> Open-world
<input type="checkbox" name="genre[]" value="racing"> Racing
<input type="checkbox" name="genre[]" value="shooter"> Shooter</p>

<input type="submit" value="Submit" />
</form>
</div>
<footer>
Copyright &copy; 2018 Curtis Naples	
</footer>
</body>
</html>