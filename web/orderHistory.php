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
	$total = 0;
	
    include ('connectionSQL.php');
    $userId = $_SESSION['user_id'];
    //select * from orders inner join receipt using(receipt_id) where user_id= 29;
    $query = 'select * from orders where user_id='.$userId;
    $result = mysqli_query($link, $query);
    if ($result)   {

        while ($row = mysqli_fetch_array($result)) {
            $total = $row['total'];
            $count = 1;
             print '<div class="clearfix">' . '<br>' .
             
             '<span class="">Purchase Date: ' . $row['order_time'] .'</span>'.
             '<br><br><div class="productsHistory">Products</div>';
            


             //insert second loop here
             $query2 = 'select * from receipt where receipt_id ='.$row['receipt_id'];
             $result2 = mysqli_query($link, $query2);

             if($result2){
             	while($row = mysqli_fetch_array($result2)){
             		print '<p><br><span class="gameNameHistory">' .$count.":    ". $row['name'] .' </span>'.
             		'<span class="gamePriceHistory">$' . $row['price']*$row['quantity'] .'</span>'.
             		'<span class="quantityHistory">Quantity: ' . $row['quantity'] . ' <br>' .'</span></p>';
             		$rowTotal = $row['price']*$row['quantity'];
             		$count = $count + 1;
             	}
             
             }
             
             echo '<br><div style="float:right"><br><br><div><hr name = "productLine"></div>';
            echo '<span class="">Total: $' . $total . '<br>' .'</span></div><br><br><br><br>';
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
