<?php
include('header.php');

echo '<article><div class="textBack" ><p id="logOut">';
session_start();
session_destroy();
unset($_COOKIE['TempGameID']);
setcookie("TempGameID", 1, time() - 3600);
echo 'You have been logged out. <a href="index.php">Go back</a>';

echo '</p></article></div>';


include('footer.php');
?>