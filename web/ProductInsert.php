
<?php
    session_start();
    include('header.html');
    echo "<h1>Add Product</h1>";

    echo "<div class=\"textBack\" align=\"left\" style=\"float:left\">";
        $gamename = strip_tags($_POST['gamename']);
        $price = strip_tags($_POST['price']);
        $gamedesc = nl2br(addslashes(strip_tags($_POST['gamedesc'])));
        $console = $_POST['console'];
        $genre = $_POST['genre'];
        $imagename = $_FILES['image']['name'];
        $imagetmp = $_FILES['image']['tmp_name'];
        $imageurl = 'images/games/' . $imagename;

        echo "<p>$imagename is being uploaded.</p>";
        move_uploaded_file($_FILES['image']['tmp_name'],"/home/student/cst160/public_html/ICS199/Project/shopping-cart/web/images/games/{$_FILES['image']['name']}");
        echo "<p>Moving from $imagetmp to $imageurl</p>";

        include('connectionSQL.php');

        // Add the new game to the database
        $gamequery = "INSERT INTO games (name, description, image, price, console_name) VALUES ('$gamename', '$gamedesc', '$imageurl', '$price', '$console')";
        @mysqli_query ($link, $gamequery);

        // Retrieve the game_id of the new game
        $gameidquery = "SELECT LAST_INSERT_ID()";
        $gameidresult = @mysqli_query($link, $gameidquery);
        $gameidrow = mysqli_fetch_row($gameidresult);
        $gameid = $gameidrow[0];

        // Add the game genres to the database
        foreach($genre as &$value){
            $genrequery = "INSERT INTO game_genres values('$gameid', '$value')";
            @mysqli_query ($link, $genrequery);
        }

        echo "<p>Successfully added game # $gameid</p>";
        echo "<p><a href=\"Addproducts.php\">Add another product?</a></p>";
    echo "</div>";
?>

</body>
</html>