<?php
session_start();
include('connectionSQL.php');
if(isset($_POST['quantity'])){
	$userId = $_SESSION['user_id'];
	$gameId = mysqli_real_escape_string($link, $_POST['gameId']);
	$quantity = mysqli_real_escape_string($link, $_POST['quantity']);

	$quantityQuery = 'UPDATE shopping_cart set quantity=' . $quantity .   ' where game_id ='. $gameId .  ' and user_id=' . $userId;

	@mysqli_query($link, $quantityQuery);

	mysqli_close($link);
	echo "done";
}


?>