<?php
include('header.php');

?>

<script>
    function validation() {
        
    }
</script>

<article>
    <div class="textBack" align="center" style="float:left" >
        <div id="login" align="left">
            <h1>Log In</h1><br><br><br>
            <form>
                <p>Email: <input type="text"/></p>
                <p>Password: <input type="password"/></p>
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