<?php
    include('header.php');

    function loginRedirect ($url = 'index.php', $message, $timeout = 3000) { // $timeout is in milliseconds
        //echo "<p>$url</p>";
        echo "<p>$message</p>";
        //echo "<p>$timeout</p>";

        echo '  <a href="' . $url . '" id="loginRedirect"></a>
					    <script type="text/javascript">
						    setTimeout(SubmitLogin, ' . $timeout . ');
						    function SubmitLogin(){
						    	document.getElementById(\'loginRedirect\').click();
						    }
					    </script>
		';
    }
    
	echo '<article>
				<div class="textBack" align="center" style="float:left" >
					<div id="login" align="left">
						<h1>Log In</h1><br><br><br>';

	if (isset($_GET['gameId'])) {
	    setcookie("TempGameID", $_GET['gameId']);
    }

	if (isset($_POST['email'])) { // Login submitted
       
        // Set the submitted login info
        $semail = strip_tags($_POST['email']);
        $spass = sha1($_POST['pass']);

        // Retrieve the user info based on login data
        $userquery = "SELECT * FROM users WHERE email = '$semail'";
        $userinforesult = @mysqli_query($link, $userquery);

        // Check if the login exists, then handle the login request
        if (mysqli_num_rows($userinforesult) == 1) { // User exists
            // Retrieve the user's stored info
            $userinfo = mysqli_fetch_row($userinforesult);
            $uID = $userinfo[0];
            $ufname = $userinfo[1];
            $ulname = $userinfo[2];
            $uemail = $userinfo[3];
            $upass = $userinfo[4];
            $urole = $userinfo[5];
            $upriv = $userinfo[6];

            // Check the submitted password, then handle it
            if (($spass == $upass) && ($upriv == 1)) { // Valid password & Privacy Policy accepted
                $_SESSION['user_id'] = $uID;
                $_SESSION['admin'] = $urole;

                if (isset($_COOKIE['TempGameID'])) {
                    $loginURL = 'cart.php?gameId=' . $_COOKIE['TempGameID'];
                } else {
                    $loginURL = 'products.php';
                }

                loginRedirect($loginURL, 'Hello ' . $ufname . '! You have successfully logged in.', 2000);
            } else if ($spass != $upass) { // Invalid password
                echo "<p>Invalid email or password. <a href ='login.php'>Please try again.</a></p>";
            } else { // Valid password, but Privacy Policy not accepted
                echo "You have not accepted the new Privacy Policy.";
            }
        } else { // User does not exist
            echo "<p>Invalid email or password. <a href ='login.php'>Please try again.</a></p>";
        }
		echo '</div>';
    } else {
        echo '
						<form action="login.php" method="POST" >
							<p>Email: <input type="email" name="email" id="email" size="25" value="';
							if(isset($_POST['email'])){ echo "$semail"; }else{ echo ""; }
							echo '" required /></p>
							<p>Password: <input type="password" name="pass" required /></p>
							<input type="submit" value="Submit" />
						</form>
					</div>
					<div id="signup" align="left">
						<h1>Sign Up</h1><br><br><br>
							<p>Don\'t have an account? <a href="signup.php">Sign up here!</a></p>
					</div>
				
		';
    }
	
	echo'			
				</div>
			</article>';
	
    include "footer.php";
?>