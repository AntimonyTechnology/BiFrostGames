<?php
include('header.php');

?>

<br>
<article>
<div class="textBack" align="left" style="float:top" >

<p>
<h1>Order History</h1>
<br>
<br>
<br>
<br>
<?php header('charset=utf-8');
    include ('connectionSQL.php');
    $userId = $_SESSION['user_id'];
    //select * from orders inner join receipt using(receipt_id) where user_id= 29;
    $query = 'select * from orders inner join receipt using(receipt_id) where user_id=29';
    $result = mysqli_query($link, $query);
    if ($result)   {
        $row_count = mysqli_num_rows($result);
        //print 'Retreived '. $row_count . ' rows from the <b> games </b> table<BR><BR>';

        while ($row = mysqli_fetch_array($result)) {
            //print $row['name'] . '<br>' .
             print '<div class="clearfix">' . '<br>' .
             
             '<span class=""> Receipt No. : ' . $row['receipt_id'] . '<br>' .'</span>'.
             '<span class="">Date: ' . $row['order_time'] . '<br>' .'</span>' .
             //insert second loop here
             '<span class="">' . $row['name'] . '<br>' .'</span>'.
             '<span class="">' . $row['quantity'] . '<br>' .'</span>'.
             '<span class="">' . $row['price'] . '<br>' .'</span>';
             
            echo '<hr name = "productLine">';
        }
    }
?>


</p>

</div>
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
