<?php
include('header.php');

?>

<br>
<article>
<div class="textBack" align="left" style="float:top" >

<p>
<h1>Checkout</h1>
<br>
<br>
<br>
<br>


<?php
//this block updates the quantity in the cart based on an POST array of gameIds and cookies holding quantities for each gameId
include('connectionSQL.php');
//print_r($_POST['gameArray']);
$userId = $_SESSION['user_id'];
$gameArray = $_POST['gameArray'];
foreach ($gameArray as $gameId) {
 	//echo 'Game Id: '.$gameId . ' ';
 	if($_COOKIE[$gameId]){
 		$quantity = $_COOKIE[$gameId];
 		//echo 'Quantity: '.$quantity. '<br> ';
 	}
 	else{
 		$quantity = 1;
 	}
$quantityQuery = 'UPDATE shopping_cart set quantity=' . $quantity .   ' where game_id ='. $gameId .  ' and user_id=' . $userId;
//echo '<br>Query: ' . $quantityQuery . '<br>';
@mysqli_query($link, $quantityQuery);
} 
?>

Do billing input starting here down with paypal button to finish



</p>
</div>
</article>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>



</article>

<?php
include "footer.php";
?>
