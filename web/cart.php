<?php
include('header.php');

?>

<br>
<form method ="POST" action= "checkout.php" >
<article>

<div class="textBack" align="left" style="float:top; padding-bottom: 50px"" >

<h1>Cart</h1>
<br>
<br>
<br>
<hr name = "productLine">

<?php 
include('connectionSQL.php');
$userId = $_SESSION['user_id'];


//checks if a game was removed and removes from DB and resets quantity
if(isset($_GET['removeId'])) {
	$gameId = $_GET['removeId'];
	//remove from DB here
	$removeCartQuery = 'DELETE FROM shopping_cart WHERE  user_id = ' . '"' . $userId . '"' . ' and game_id = ' . '"' . $gameId . '"';
	@mysqli_query($link, $removeCartQuery);
	//remove cookie that is associated with gameId here
	if(isset($_COOKIE[$gameId])){
			unset($_COOKIE[$gameId]);
     		setcookie($gameId,1, time() - 3600);
     	}
}

//checks if a game was added to cart and adds to DB
if(isset($_GET['gameId'])) {
	$gameId = $_GET['gameId'];
	//runs query to check if the game is already present
	$getCartQuery = 'SELECT * FROM shopping_cart inner join games using (game_id) where user_id = ' . '"' . $userId . '"';
$result = mysqli_query($link, $getCartQuery);
$quantityDefault = 1;
 	if ($result)   {
     	while ($row = mysqli_fetch_array($result)) {
     		//copies a unique price for this game to be passed to JS function addQ()
     		$priceDuplicate = $row['price'];
     		//checks if the game is already present here and returns a bool to be used in JS function addQ()
        	 if($gameId==$row['game_id']){
        	 	$duplicate = true; 

  			}
		}		
	}		
	//finally adds the game to the cart
	$addToCartQuery = "INSERT INTO shopping_cart (user_id, game_id, quantity) VALUES ('$userId', '$gameId', '$quantityDefault')";
	@mysqli_query($link, $addToCartQuery);
}

//used to query the users cart table in DB to populate the cart
//use to get which game_id(s) and theyre quantities from shopping cart to store in variables based on userId
$getCartQuery = 'SELECT * FROM shopping_cart inner join games using (game_id) where user_id = ' . '"' . $userId . '"';
$result = mysqli_query($link, $getCartQuery);
 if ($result)   {
     $row_count = mysqli_num_rows($result);
     //print 'Retreived '. $row_count . ' rows from the <b> games </b> table<BR><BR>';
     $count = 0;
     
     while ($row = mysqli_fetch_array($result)) {
         //print $row['name'] . '<br>' .
     	//print_r($_COOKIE[$currGameId]);
     	$currGameId = $row['game_id'];
     	//checks if the game already has a cookie assigned to it
     	if(isset($_COOKIE[$currGameId])){
     		//cookie is present so quantity = whatever the cookie is
     		$quantity = $_COOKIE[$currGameId];
     		//print $quantity;
     	}
     	//otherwise quantity defaults to one
     	else{
     		$quantity = 1;
     	}

      	//displays the contents of your cart
        $price = $row['price'];
          print '<form method ="POST" action='.'"'.'cart.php?removeId='.$currGameId.'"><div class="clearfix">' . 
          '<img class =' . '"' . 'images' . '"' . 'src =' . '"' . $row['image'] . '">'.
          '<p class="gameName">' . $row['name'] . '</p><br>' .
          '<span class="consoleName">' . $row['console_name'] . '<br>' .'</span><br>' . '<br><br>'.
          '<div id=' .'"' . 'price'. $currGameId .'"'.'>'. $price*$quantity . '</div>'.
          '<input id=' .'"' . 'quantity'. $currGameId .'"'. 'style=float:right;  type="textbox" value='. $quantity.'>'.
          '<input style=float:right; type="button" value="+" onclick='.'"'.'addQ('.$currGameId.','.$price.')"'. '>'.
          '<input style=float:right; type="button" value="-" onclick='.'"'.'remQ('.$currGameId.','.$price.')"'. '>'.
          '<input type="submit" value="Remove" id=' .'"' . 'remove'. $currGameId .'"'.'></form></div>';

          //fancy line between products
         echo '<hr name = "productLine">';
         $totalPrice = $totalPrice + $price;
         //assigns an array of all the game ids to identify for JS function calcTotal()
         $gameArray[$count]=$row['game_id'];
         $count = $count + 1;
         
     }
     
 }

$_GET['count'] = $count;


//echo json_encode($gameArray);

//add in hidden forms to hold the gameId and values of each quantity field
//or assign $_POST variables dynamically inside ^ form !!!!!!!!!!!!!!!!!!!!!
for ($i=0; $i < count($gameArray); $i++) { 
	echo '<input type="hidden" name="gameArray[]" value="'.$gameArray[$i].'">';
}
?>
<div id="total" style=float:right;></div><br><br>
<input type="submit" name= "checkout" value="Checkout" style="float: right;">




<script>
//to change the quantity and prices displayed, also save quantity to cookie
	function addQ(count,price) {
		//gets current quantity from form
		var quantity = document.getElementById('quantity'+ count).value;
		quantity++;
		//assigns form new incremented quantity
		document.getElementById('quantity'+count).value = quantity;
		//creates and assigns cookie
		var expireDate = new Date(new Date().getTime() + (1000*60*60*24*7));	
		var cookieString = count + "=" + quantity+'; expires=' +expireDate.toGMTString();  
		document.cookie = cookieString;

		 document.getElementById('price' + count).innerHTML = (price * quantity).toFixed(2);
		 //calls to calculate the total on button press
		 calcTotal(<?php echo json_encode($gameArray); ?>);
	}
	function remQ(count,price) {
		//gets current quantity from form
		var quantity = document.getElementById('quantity'+ count).value;
		quantity--;
		//clicks the remove button for the item if it changes to zero quantity
		if(quantity == 0){
			document.getElementById('remove' + count).click();
		}
		//assigns form new incremented quantity
		document.getElementById('quantity'+count).value = quantity;
		//creates and assigns cookie
		var expireDate = new Date(new Date().getTime() + (1000*60*60*24*7));
		var cookieString = count + "=" + quantity+'; expires=' +expireDate.toGMTString();  
		document.cookie = cookieString;

		 document.getElementById('price' + count).innerHTML = (price * quantity).toFixed(2);
		 //calls to calculate the total on button press
		 calcTotal(<?php echo json_encode($gameArray); ?>);
	}
	function getQuantity(gameId){
		var quantity = document.getElementById('quantity'+ gameId).value;
		return quantity;
	}
//used to calculate and update the total price
	function calcTotal(gameArray){
		//console.log(gameArray[0]);
		var total = 0;
		//loops through the gameIds and gets each price field and adds them up
		for (var i = 0; i < gameArray.length; i++) {
			total = total + Number(document.getElementById('price' + gameArray[i]).innerHTML);
		}
		//assigns total Price
		document.getElementById('total').innerHTML = total.toFixed(2);
	}
	//calls to calculate the total on page load
	calcTotal(<?php echo json_encode($gameArray); ?>);
</script>
<?php  
//checks if a duplicate occured on this load
if($duplicate == true){
		//runs the JS addQ() function with the duplicates gameId and price
     	echo '<script>addQ('.$gameId.','.$priceDuplicate.')</script>';	
     	}
?>


</div>
</article>
</form>



<?php
include "footer.php";
?>
