<?php
include('header.php');

?>

<br>

<article>
<form class = "genreSelect" action="receiptInsert.php" method="Post">
<div class="textBack" align="left" style="float:top" >

<h1>Cart</h1>
<br>
<br>
<br>
<hr name = "productLine">


<?php 
include('connectionSQL.php');
$userId = $_SESSION['user_id'];
//print "hello <br>";
if(isset($_GET['gameId'])) {
	$gameId = $_GET['gameId'];
		//TEST VALUE change to $_SESSION later
	$quantityDefault = 1;		//INITIAL INSERT VALUE -- implement the number input box to do update query on this in the value.

	$addToCartQuery = "INSERT INTO shopping_cart (user_id, game_id, quantity) VALUES ('$userId', '$gameId', '$quantityDefault')";
	@mysqli_query($link, $addToCartQuery);
}
$currGameId=0;
//use to get which game_id(s) and theyre quantities from shopping cart to store in variables based on userId
$getCartQuery = 'SELECT * FROM shopping_cart inner join games using (game_id) where user_id = ' . '"' . $userId . '"';
//remove from cart button query

//print "remove cart query: " . $removeCartQuery;
$result = mysqli_query($link, $getCartQuery);
 if ($result)   {
     $row_count = mysqli_num_rows($result);
     //print 'Retreived '. $row_count . ' rows from the <b> games </b> table<BR><BR>';
     
     while ($row = mysqli_fetch_array($result)) {
         //print $row['name'] . '<br>' .
      $quantity = $row['quantity'];
      $currGameId = $row['game_id'];
        $price = $row['price'] * $quantity;
          print '<div class="clearfix">' . 
          '<img class =' . '"' . 'images' . '"' . 'src =' . '"' . $row['image'] . '"><p class="gameName">' . $row['name'] . '</p><br>' .
          '<span class="consoleName">' . $row['console_name'] . '<br>' .
           '</span><br>' . '<br><br>$'. $price .'<input style=float:right;  type="textbox" value=' . '"' . $row['quantity'] . '"' . 'name="quantity"><input style=float:right; type="button" value="+" onclick="addQ($quantity,$currGameId)"><input style=float:right; type="button" value="-" onclick="remQ($quantity,$currGameId)"><input type="button" value="Remove" action="cart.php" onclick="remove($currGameId,$userId)" ></p></div>';
         echo '<hr name = "productLine">';
         $totalPrice = $totalPrice + $price;
     }
     
 }

$removeCartQuery = 'DELETE FROM shopping_cart WHERE  user_id = ' . '"' . $userId . '"' . ' and game_id = ' . '"' . $gameId . '"';
$quantityQuery = 'UPDATE shopping_cart set quantity =' . $quantity .   'where game_id ='. $gameId .  'and user_id=' . $userId;

echo $totalPrice . '$';
?>

<input type="button" name="checkout" value="Checkout" onclick="remove(150,1)" style="float: right">

</div>
</form>
</article>
<br>
<br>
<br>
<br>




</article>

<?php
include "footer.php";
?>
