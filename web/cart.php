<?php
include('header.php');

?>

<br>

<article>

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
if(isset($_GET['removeId'])) {
	$gameId = $_GET['removeId'];

	$removeCartQuery = 'DELETE FROM shopping_cart WHERE  user_id = ' . '"' . $userId . '"' . ' and game_id = ' . '"' . $gameId . '"';
	
	@mysqli_query($link, $removeCartQuery);

}
if(isset($_GET['gameId'])) {
	$gameId = $_GET['gameId'];
		//TEST VALUE change to $_SESSION later
	$quantityDefault = 1;		//INITIAL INSERT VALUE -- implement the number input box to do update query on this in the value.

	$addToCartQuery = "INSERT INTO shopping_cart (user_id, game_id, quantity) VALUES ('$userId', '$gameId', '$quantityDefault')";
	@mysqli_query($link, $addToCartQuery);
}

//use to get which game_id(s) and theyre quantities from shopping cart to store in variables based on userId
$getCartQuery = 'SELECT * FROM shopping_cart inner join games using (game_id) where user_id = ' . '"' . $userId . '"';
//remove from cart button query

//print "remove cart query: " . $removeCartQuery;
$result = mysqli_query($link, $getCartQuery);
 if ($result)   {
     $row_count = mysqli_num_rows($result);
     //print 'Retreived '. $row_count . ' rows from the <b> games </b> table<BR><BR>';
     $count = 0;
     $quantity = 1;
     while ($row = mysqli_fetch_array($result)) {
         //print $row['name'] . '<br>' .
      $currGameId = $row['game_id'];
        $price = $row['price'];
          print '<form method ="POST" action='.'"'.'cart.php?removeId='.$currGameId.'"><div class="clearfix">' . 
          '<img class =' . '"' . 'images' . '"' . 'src =' . '"' . $row['image'] . '">
          <p class="gameName">' . $row['name'] . '</p><br>' .
          '<span class="consoleName">' . $row['console_name'] . '<br>' .'</span><br>' . '<br><br>
          <input type="text box" id=' .'"' . 'price'. $count .'"'.' value ='.'"'. $price . '"'. '>
          <input id=' .'"' . 'quantity'. $count .'"'. 'style=float:right;  type="textbox" value=1>
          <input style=float:right; type="button" value="+" onclick='.'"'.'addQ('.$count.','.$price.')"'. '>
          <input style=float:right; type="button" value="-" onclick='.'"'.'remQ('.$count.','.$price.')"'. '>
          <input type="submit" value="Remove"></form></div>';
         echo '<hr name = "productLine">';
         $totalPrice = $totalPrice + $price;
         $count = $count + 1;
     }
     
 }
$_GET['count'] = $count;

$quantityQuery = 'UPDATE shopping_cart set quantity =' . $quantity .   'where game_id ='. $gameId .  'and user_id=' . $userId;

?>

<script>//to change the quantity and individual prices
	function addQ(count,price) {
		var quantity = document.getElementById('quantity'+ count).value;
		quantity++;
		document.getElementById('quantity'+count).value = quantity;
		 document.getElementById('price' + count).value = (price * quantity).toFixed(2);
		 calcTotal(<?php echo $_GET['count'] ?>);
	}
	function remQ(count,price) {
		var quantity = document.getElementById('quantity'+ count).value;
		quantity--;
		document.getElementById('quantity'+count).value = quantity;
		 document.getElementById('price' + count).value = (price * quantity).toFixed(2);
		 calcTotal(<?php echo $_GET['count'] ?>);
	}
	function calcTotal(count){
		var total = 0;
		for (var i = 0; i < count; i++) {
			total = total + Number(document.getElementById('price' + i).value);
		}
		document.getElementById('total').value = total;
	}
</script>
<input id="total" style=float:right;  type="textbox"><script>calcTotal(<?php echo $_GET['count'] ?>);</script><br><br>
<input type="submit" name="checkout" value="Checkout" style="float: right">

</div>
</article>
<br>
<br>
<br>
<br>




</article>

<?php
include "footer.php";
?>
