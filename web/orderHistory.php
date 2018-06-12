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

    //select * from orders inner join receipt using(receipt_id) where user_id= 29;
    $query = 'select * from orders';
    $result = mysqli_query($link, $query);
    if ($result)   {
        $row_count = mysqli_num_rows($result);
        //print 'Retreived '. $row_count . ' rows from the <b> games </b> table<BR><BR>';

        while ($row = mysqli_fetch_array($result)) {
            //print $row['name'] . '<br>' .
             print '<div class="clearfix">' . '<br>' .
             
             '<span class="receiptId">' . $row['receipt_id'] . '<br>' .'</span>'.
             '<span class="userId">' . $row['user_id'] . '<br>' .'</span>'.
             '<span class="orderTime">' . $row['order_time'] . '<br>' .'</span>';
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
