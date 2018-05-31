<?php
    include('header.php');
    if (isset($_POST['email'])) { // Login submitted
        echo "<p>You submitted a login.</p>";

        // Set the submitted login info
        $semail = strip_tags($_POST['email']);
        $spass = strip_tags($_POST['pass']); // password_hash($_POST['pass'], PASSWORD_DEFAULT);
        echo "<p>$spass</p>";

        // Retrieve the user info based on login data
        $userquery = "SELECT * FROM users WHERE email = '$semail'";
        $userinforesult = @mysqli_query($link, $userquery);

        // Check if the login exists, then handle the login request
        if (mysqli_num_rows($userinforesult) == 1) { // User exists
            // Retrieve the user's stored info
            $userinfo = mysqli_fetch_row($userinforesult);
            print_r($userinfo);
            $uID = $userinfo[0];
            $ufname = $userinfo[1];
            $ulname = $userinfo[2];
            $uemail = $userinfo[3];
            $upass = $userinfo[4];
            echo "<p>$upass</p>";
            $urole = $userinfo[5];

            // Check the submitted password, then handle it
            if ($spass == $upass) { // Valid password
                echo "<p>$uID <br> $urole</p>";
                $_SESSION['user_id'] = $uID;
                $_SESSION['admin'] = $urole;
                print_r($_SESSION);
                echo "<p>Hello $ufname! You have successfully logged in.</p>";
            } else { // Invalid password
                echo "<p>Invalid email or password. Please try again.</p>";
            }
        } else { // User does not exist
            echo "<p>Invalid email or password. Please try again.</p>";
        }
    } else {
        echo "<p>No login submitted.</p>";
    }
?>

<article>
    <div class="textBack" align="center" style="float:left" >
        <div id="login" align="left">
            <h1>Log In</h1><br><br><br>
            <form action="login.php" method="POST" >
                <p>Email: <input type="email" name="email" value="<?php if(isset($_POST['email'])){ echo "$semail"; }else{ echo ""; } ?>" required /></p>
                <p>Password: <input type="password" name="pass" required /></p>
                <input type="submit" value="Submit" />
            </form>
        </div>
        <div id="signup" align="left">
            <h1>Sign Up</h1><br><br><br>
                <p>Don't have an account? <a href="signup.php">Sign up here!</a></p>
        </div>
    </div>
</article>

<?php
    include "footer.php";
?>