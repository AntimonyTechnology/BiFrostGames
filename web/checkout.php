<?php
include('header.php');

?>
<script>
function validation(){
	
	
	
}





</script>


	
	<?php 
	$pagenum = 1;
	
	
	if($pagenum == 1){
		echo'<nav>
		<ul>
		<li><a>STEP 1 -----></a></li>
		<li><a>STEP 2 -----></a></li>
		<li><a>STEP 3</a></li>
		
		
		</ul>
		</nav><br><br><br>';
		echo'<article>
	<div class="textBack" align="left" style="..." >
	<h1>Checkout</h1><br><br><br>';
	echo '<h2>Please Fill out Shipping Information:</h2>
	
	<form action="checkout.php" method="POST" onsubmit="return validation();">
	    <p>Address: <input type="text" name="address" id="address" pattern="\d+[ ](?:[A-Za-z0-9.-]+[ ]?)+(?:[Aa]venue|[Ll]ane|[Rr]oad|[Bb]oulevard|[Dd]rive|[Ss]treet|[Aa]ve|[Dd]r|[Rr]d|[Bb]lvd|[Ll]n|[Ss]t)\.?" required /></p>
	    <p>Postal Code: <input type="text" name="postal" id="postal" required /></p>
	    <p>Province: <input type="text" name="province" id="province" required /></p>
	    <p>City: <input type="text" name="city" id="city" required /></p>
		<p>Country: <input type="text" name="city" id="city" required /></p>
	    <input type="hidden" name="pagenum" value="'. $pagenum .' + 1 "/>
	    <input type="submit" value="Submit" />
	</form>';
	
	}
	elseif($pagenum == 2){
		echo'<nav>
		<ul>
		<li><a>STEP 1 -----></a></li>
		<li><a>STEP 2 -----></a></li>
		<li><a>STEP 3</a></li>
		
		
		</ul>
		</nav><br><br><br>';
		echo'<article>
	<div class="textBack" align="left" style="..." >
	<h1>Checkout</h1><br><br><br>';
		echo '<h2>Please Fill out Payment Information:</h2>
	
	<form action="checkout.php" method="POST" onsubmit="return validation();">
		DO PAYMENT HERE!
	    <input type="hidden" name="pagenum" value="'. $pagenum .' + 1 "/>
	    <input type="submit" value="Submit" />
	</form>';
		
	}else{
		echo'<nav>
		<ul>
		<li><a>STEP 1 -----></a></li>
		<li><a>STEP 2 -----></a></li>
		<li><a>STEP 3</a></li>
		
		
		</ul>
		</nav><br><br><br>';
		echo'<article>
	<div class="textBack" align="left" style="..." >
	<h1>Checkout</h1><br><br><br>';
		echo '<h2>Please Fill out Payment Information:</h2>
	
	<form action="" method="POST" onsubmit="return validation();">
		DO CONFIRMATION HERE!!!
	   
	    <input type="submit" value="Submit" />
	</form>';
	}
?>
	</div>
</article>

<?php
include('footer.php');
?>