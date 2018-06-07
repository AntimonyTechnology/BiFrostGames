<?php
//this php is run server side and called from ajax inside of a JS funtion popup.php
include('connectionSQL.php');

	$userId = mysqli_real_escape_string($link, $_POST['id']);

	$updatePolicyQuery = 'UPDATE users set priv_policy= 1 where user_id ='.$userId;

	@mysqli_query($link, $updatePolicyQuery);
	
	//make sure to close the link for server scripts!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
	mysqli_close($link);
	//echo $updatePolicyQuery;
	


?>