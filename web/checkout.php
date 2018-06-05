<?php
include('header.php');

?>
<script>
function validation(){
	
	
	
}





</script>

<article>
<div class="textBack" align="left" style="..." >
	<h1>Checkout</h1><br><br><br>
	<h2>Please Fill the forms below:</h2>
	
	<form action="" method="POST" onsubmit="return validation();">
	    <p>Address: <input type="text" name="address" id="address" required /></p>
	    <p>Postal Code: <input type="text" name="postal" id="postal" required /></p>
	    <p>Province: <input type="email" name="province" id="province" required /></p>
	    <p>City: <input type="password" name="city" id="city" required /></p>
	   
	    <input type="submit" value="Submit" />
	</form>

	</div>
</article>

<?php
include('footer.php');
?>