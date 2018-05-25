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
	<li><a href = "products.php?console=All" style = "cursor: pointer">All</a></li>
	<li><a href = "products.php?console=Nintendo_Switch" style = "cursor: pointer">Nintendo Switch</a></li>
	<li><a href = "products.php?console=PS4" style = "cursor: pointer">PlayStation 4</a></li>
	<li><a href = "products.php?console=PC" style = "cursor: pointer">PC</a></li>
	<li><a href = "products.php?console=XB1" style = "cursor: pointer">Xbox One</a></li>
</ul>
</nav>
<?php
session_start();
//used to determine the console query
$console = @$_GET['console'];
$_SESSION['theconsole'] = $console;
?>
<br><br><br>
<form class = "genreSelect" action="products.php" method="Post" style = "float:right">
<select name = "theGenre">
<option value = "All">All</option>

<?php 
//used to get the genres from DB
	include ('connectionSQL.php');
	$genreQuery = "select * from genres";
	$genreList = mysqli_query($link, $genreQuery);
if($genreList){
	$genreRows = mysqli_num_rows($genreList);
	print $genreRows;
	while($genre = mysqli_fetch_array($genreList)) {
		print '<option value =' . '"' . $genre['genre_id'] . '">' . $genre['genre_id'] . '</option>';
	}
	print '<input name=' . '"' . 'theconsole' . '"' . 'type=' . "'" . 'hidden' . "'" . 'value = ' . "'" . $console . "'" . '>';
}

if(isset($_POST['submit'])){

	$selectedGenre = $_POST['theGenre'];
	$console = $_POST['theconsole'];
}

?>
</select>
<input type = "submit" name ="submit"/>
</form>
<br>



<?php




if($console == "" || $console == "All" && $selectedGenre == "" || $selectedGenre == "All"){
	//none selected
	$query = 'select * from games';
}
else if($console != "" || $console != "All" && $selectedGenre == "" || $selectedGenre == "All"){
	//console only selected
	$query = "select * from games where console_name like " . '"' . $console . '"';
}

else if($selectedGenre != "" || $selectedGenre != "All" && $console == "" || $console == "All") {
	//genre only selected
	$query = 'select * from games
		inner join game_genres using(game_id)
		where genre_id =' . '"' . $selectedGenre . '"';
}
else {
	//console and genre selected
	$query = 'select * from games
			inner join game_genres using(game_id)
			where genre_id =' . '"' . $selectedGenre . '"' .
			'AND console_name =' . '"' . $console . '"';
}
print "the console: " . $console . '<br>';
print "the genre: " . $selectedGenre . '<br>';
print "the query: " . $query . '<br>';
?>

<div class="textBack" align="left" style="float:left" >
<?php header('charset=utf-8');
include ('connectionSQL.php');


 
 $result = mysqli_query($link, $query);
 if ($result)   {
     $row_count = mysqli_num_rows($result);
     //print 'Retreived '. $row_count . ' rows from the <b> games </b> table<BR><BR>';
     
     while ($row = mysqli_fetch_array($result)) {
         print $row['name'] . '<br>' .
          '<span class=\'consoleName\'>' . $row['console_name'] . '</span><br>'. 
          $row['description'] .'<br>' .
          '<img class =' . '"' . 'images' . '"' . 'src =' . '"' . $row['image'] . '">' . '<br>' .
          $row['price'] . '<br>';
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
