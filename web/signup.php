<?php
include('header.html');
?>

<script>
	function validation(){
		
	}
</script>
	
<article>
<div class="textBack" align="left" style="..." >
	<h1>Registration</h1><br><br><br>
	<form action="" method="POST" onsubmit="return validation();">
	<p>First Name: <input type="text" name="fname" id="fname" required /></p>
	<p>Last Name: <input type="text" name="lname" id="lname" required /></p>
	<p>Username: <input type="text" name="user" id="user" required /></p>
	<p>Password: <input type="text" name="pass" id="pass" required /></p>
	<p>Address: <input type="text" name="address" id="address" required /></p>
	<p>Postal Code: <input type="text" name="postal" id="postal" required /></p>
	<p>Email: <input type="text" name="email" id="email" required /></p>
	<input type="submit" value="Submit" />
	</form>
	</div>
</article>

<?php
include('footer.php');
?>