<?php
include('header.php');

?>
<script>
function validation(){
	
	
	
}





</script>


	
	<?php 
	$userId = $_SESSION['user_id'];
	
	if (!isset($_POST['pagenum'])) {
		echo '
			<form action="checkout.php" method="POST" onsubmit="return validation();">
				<p>Page: <input type="text" name="pagenum" required /></p>
				<input type="hidden" name="gameArray" value="'.$_POST['gameArray'] .'"/>
				<input type="submit" value="Submit" />
			</form>
		';
	}
	
	//page 1 billing info
	if($_POST['pagenum'] == 1){
		echo'<article>
	<div class="textBack" align="left" style="..." >
	<h1>Checkout</h1><br><br><br>';
	print_r($_POST['gameArray']);
	//if this needs to be done, passing the post gameArray needs to be done with for loop input echo, see line 133 in cart.php
	$gameArray = $_POST['gameArray'];

	//takes the total passed from POST
	$total = $_POST['total'];
	//echo '<br>' . $total;

	echo '<h2>Please Fill out Shipping Information:</h2>
	
	<form action="checkout.php" method="POST" onsubmit="return validation();">
	    <p>Address: <input type="text" name="address" id="address" pattern="\d+[ ](?:[A-Za-z0-9.-]+[ ]?)+(?:[Aa]venue|[Ll]ane|[Rr]oad|[Bb]oulevard|[Dd]rive|[Ss]treet|[Aa]ve|[Dd]r|[Rr]d|[Bb]lvd|[Ll]n|[Ss]t)\.?" required /></p>
	    <p>Postal Code: <input type="text" name="postal" id="postal" required /></p>
	    <p>Province: <input type="text" name="province" id="province" required /></p>
	    <p>City: <input type="text" name="city" id="city" required /></p>
		<p>Country: <input type="text" name="city" id="city" required /></p>
	    <input type="hidden" name="pagenum" value="2"/>
		<input type="hidden" name="gameArray" value="'. $gameArray .'"/>
		<input type="hidden" name="total" value="'. $total .'"/>
	    <input type="submit" value="Submit" />
	</form>';
	
	}


	//page 2 payment
	elseif($_POST['pagenum'] == 2){
		echo'<article>
	<div class="textBack" align="left" style="..." >
	<h1>Checkout</h1><br><br><br>';
		print_r($_POST['gameArray']);
		//if this needs to be passed up, passing the post gameArray needs to be done with for loop input echo, see line 133 in cart.php
		$gameArray = $_POST['gameArray'];

		//takes the total passed from POST
		$total = str_replace('.', '', $_POST['total']);
		//echo '<br>' . $total;

		require_once('./config.php');
		echo '<h2>Please confirm your order:</h2>
	
	<form action="checkout.php" method="post">
  <script src="https://checkout.stripe.com/checkout.js" class="stripe-button"
          data-key="' . $stripe['publishable_key'] . '"
          data-description="Access for a year"
          data-amount="'. $total . '"
          data-locale="auto"></script>
	    <input type="hidden" name="pagenum" value="3"/>
		<input type="hidden" name="gameArray" value="'. $gameArray .'"/>
	</form>';
		
	}


// page 3 confirmation
	else{
		
		echo'<article>
	<div class="textBack" align="left" style="..." >
	<h1>Checkout</h1><br><br><br>';
	print_r($_POST['gameArray']);
		
		require_once('./config.php');
	
		$token = $_POST['stripeToken'];
		$email = $_POST['stripeEmail'];
		
		$customer = \Stripe\Customer::create(array(
		'email' => $email,
		'source' => $token
		));
		
		$charge = \Stripe\Charge::create(array(
			'customer' => $customer->id,
			'amount'   => 5000,
			'currency' => 'usd'
			));
		
		
		
		echo '<h2>Thank you for your order!</h2>';
		
		//payment complete, clear cart
		include ('connectionSQL.php');
		$clearCartQuery = 'DELETE FROM shopping_cart WHERE user_id ='. '"' . $userId . '"';
		@mysqli_query($link, $clearCartQuery);
	
	}
?>
	</div>
</article>

<?php
include('footer.php');
?>