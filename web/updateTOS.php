<?php
include('connectionSQL.php');

	$userId = mysqli_real_escape_string($link, $_POST['id']);

	$updatePolicyQuery = 'UPDATE users set priv_policy= 1 where user_id ='.$userId;

	@mysqli_query($link, $updatePolicyQuery);

	mysqli_close($link);
	//echo $updatePolicyQuery;
	


?>