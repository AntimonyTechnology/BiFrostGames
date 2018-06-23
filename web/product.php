<?php
include('header.php');

?>

<br>
<article>
<form action="products.php">
<input type="submit" class="greyBackButtons" style="margin-top: 10px" value="<  Back to Shopping" />
</form>

<div class="textBack" align="left" style="float:top" >

<p>
<?php header('charset=utf-8');

	if (isset($_SESSION['user_id'])) { // User signed in -> cart
        $cartURL = 'cart.php?gameId=';
    } else { // User not signed in -> login
        $cartURL = 'login.php?gameId=';
    }

    include ('connectionSQL.php');
 
    $gameId = $_GET['gameId'];
    $query = "select * from games where game_id = ". $gameId;
    $result = mysqli_query($link, $query);
    if ($result)   {
        $row_count = mysqli_num_rows($result);
        //print 'Retreived '. $row_count . ' rows from the <b> games </b> table<BR><BR>';

        while ($row = mysqli_fetch_array($result)) {
            //print $row['name'] . '<br>' .
             print '<div class="clearfix">' . '<br>' .
             '<img class ="images" src ="' . $row['image'] . '">'.
             '<p class="gameNameProduct">' . $row['name'] . '</p><br>' .
             '<span class="consoleName">' . $row['console_name'] . '<br>' .'</span><br>'. 
             '<br>' . $row['description'] . '<br><br><br><br>'.
             '<a href="'. $cartURL . $row['game_id'] . '" class="cost"><p class="price" style="width: 50%">$'. $row['price'] .'<img src="cart.png" class="cart"></p></a></div>';
            
        }
    }
?>


</p>

</div>
<form action="products.php">
<input type="submit" class="greyBackButtons" style="margin-top: 10px" value="<  Back to Shopping" />
</form>
</article>
<br>
<br>

<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>



</article>

<?php
include "footer.php";
?>
