
<?php
session_start();
include('header.html');
echo "<h1>Add Product</h1>";

echo "<div class=\"textBack\" align=\"left\" style=\"float:left\">";
$gamename = $_POST['gamename'];
$gamedesc = $_POST['gamedesc'];
$image = $_POST['image'];
$price = $_POST['price'];
$console = $_POST['console'];
$genre = $_POST['genre'];

include('connectionSQL.php');

$gamequery = "INSERT INTO games (name, description, image, price, console_name) VALUES ('$gamename', 'htmlspecialchars($gamedesc)', '$image', '$price', '$console')";
@mysqli_query ($link, $gamequery);

$gameidquery = "SELECT LAST_INSERT_ID()";
$gameidresult = @mysqli_query($link, $gameidquery);
$gameidrow = mysqli_fetch_row($gameidresult);
$gameid = $gameidrow[0];

echo "<p>Successfully added game # $gameid</p>";
echo "<p><a href=\"Addproducts.php\">Add another product?</a></p>";
echo "</div>";
//print_r($genre);
foreach($genre as &$value){
	
	
	
	$genrequery = "INSERT INTO game_genres values('$gameid', '$value')";
	@mysqli_query ($link, $genrequery);
	
}

?>

</body>
</html>