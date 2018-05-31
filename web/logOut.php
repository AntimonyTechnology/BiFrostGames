<?php
include('header.php');

echo '<article><div class="textBack" ><p id="logOut">';
session_start();
session_destroy();
echo 'You have been logged out. <a href="index.php">Go back</a>';

echo '</p></article></div>';


include('footer.php');
?>