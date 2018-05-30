<?php
include('header.php');

?>

<br>

<article>
<form class = "genreSelect" action="cartInsert.php" method="Post">
<div class="textBack" align="left" style="float:top" >

<p>

<h1>Cart</h1>
<br>
<br>
<br>
<hr name = "productLine">


<?php 
include('connectionSQL.php');
//print "hello <br>";
$gameId = $_GET['gameId'];
//print "gameid: " . $gameId . "<br>";
$query = 'select * from games where game_id = ' . '"' . $gameId . '"';
//print "Query:" . $query;

$result = mysqli_query($link, $query);
 if ($result)   {
     $row_count = mysqli_num_rows($result);
     //print 'Retreived '. $row_count . ' rows from the <b> games </b> table<BR><BR>';
     
     while ($row = mysqli_fetch_array($result)) {
         //print $row['name'] . '<br>' .
          print '<div class="clearfix">' . 
          '<img class =' . '"' . 'images' . '"' . 'src =' . '"' . $row['image'] . '"><p class="gameName">' . $row['name'] . '</p><br>' .
          '<span class="consoleName">' . $row['console_name'] . '<br>' .
           '</span><br>'. '<br>' . $row['description'] . '<br><br><br><br>$'. $row['price'] .'<input style=float:right;  type="number" value="1" name="quantity"></p></div>';
         echo '<hr name = "productLine">';
         


     }
     
 }

?>

<input type="button" name="checkout" value="Checkout" style="float: right">


</p>

</div>
</form>
</article>
<br>
<br>
<br>
<br>




</article>

<?php
include "footer.php";
?>
