<html>
<head>
<title>  </title>

</head>
<body>

<?php
session_start();
$gamename = $_POST['gamename'];
$gamedesc = $_POST['gamedesc'];
$image = $_POST['image'];
$price = $_POST['price'];
$console = $_POST['console'];
$genre = $_POST['genre'];

include('connectionSQL.php');

$gamequery = "INSERT INTO games (name, description, image, price, console_name) VALUES ('$gamename', '$gamedesc', '$image', '$price', '$console')";
@mysqli_query ($link, $gamequery);

$gameidquery = "SELECT LAST_INSERT_ID()";
$gameidresult = @mysqli_query($link, $gameidquery);
$gameidrow = mysqli_fetch_row($gameidresult);
$gameid = $gameidrow[0];

echo "<p>This is a test. $gameid </p>";
//print_r($genre);
foreach($genre as &$value){
	
	
	
	$genrequery = "INSERT INTO game_genres values('$gameid', '$value')";
	@mysqli_query ($link, $genrequery);
	
}

?>

</body>
</html>