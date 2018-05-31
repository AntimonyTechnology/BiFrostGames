<?php
    session_start();
    include('header.html');
    include('connectionSQL.php');
	
	echo "<article>";
    echo "<div class=\"textBack\" align=\"left\" style=\"float:left\">";
    echo "<h1>Registration</h1><br><br><br>";
	if ($_SERVER['REQUEST_METHOD'] == 'POST') {
		$fname = strip_tags($_POST['fname']);
		$lname = strip_tags($_POST['lname']);
		$email = strip_tags($_POST['email']);
		$pass = sha1($_POST['pass']);
		
		$emailcheckquery = "SELECT * FROM users WHERE email = '$email'";
		$emailcheck = mysqli_num_rows(@mysqli_query($link, $emailcheckquery));
		
		if($emailcheck > 0){
			echo '<p style="color: red;">Sorry! This email is already in use!<br> <a href="signup.php"> Please try again</a></p>';
			
		}else{
			$adduserquery = "INSERT INTO users (fname, lname, email, password) VALUES ('$fname', '$lname', '$email', '$pass')";
			@mysqli_query($link, $adduserquery);
			$emailcheck = mysqli_num_rows(@mysqli_query($link, $emailcheckquery));
			if ($emailcheck == 1) {
				echo "Sign up successful! Please log in <a href =\"login.php\">HERE</a>!";
			}else{
				echo "Sign up failed! Please contact the ADMIN with this error : SQL FAILED INSERT!";
			}
		}
	}
	echo "</div>";
    echo "</article>";
	
	?>
<?php
include('footer.php');
	
?>