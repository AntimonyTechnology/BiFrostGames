<?php

session_start();

include ('headerSQL.html');
include ('connectionSQL.php');


 
 $result = mysqli_query($link,'select * from Games');
 if ($result)   {
     $row_count = mysqli_num_rows($result);
     print 'Retreived '. $row_count . ' rows from the <b> games </b> table<BR><BR>';
     
     while ($row = mysqli_fetch_array($result)) {
         print $row['game_id'] . ', ' . $row['name'] . ', ' . $row['description'] .', ' . '<img src=\'data:image/jpg; base64, $row[\'image\']\'>' .', ' . $row['price'] . ',' . $row['console_name'] . '<br>';
     }
     
 }
 
 
    include ('footerSQL.php');

?>

