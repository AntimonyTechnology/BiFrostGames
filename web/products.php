<?php
    include('header.php');

?>
	

<article>
	
	
	<nav class="console">
<ul style="box-shadow: -6px 10px 12px #C2C2C2;">
	<li><a href = "products.php?console=All" style = "cursor: pointer">All</a></li>
	<li><a href = "products.php?console=Nintendo_Switch" style = "cursor: pointer">Nintendo Switch</a></li>
	<li><a href = "products.php?console=PS4" style = "cursor: pointer">PlayStation 4</a></li>
	<li><a href = "products.php?console=PC" style = "cursor: pointer">PC</a></li>
	<li><a href = "products.php?console=XB1" style = "cursor: pointer">Xbox One</a></li>
</ul>
</nav>
<?php
    //used to determine the console query
    $console = @$_GET['console'];
    $_SESSION['theconsole'] = $console;

    // Generates the redirect URL to use if the user tries to buy an item
    if (isset($_SESSION['user_id'])) { // User signed in -> cart
        $cartURL = 'cart.php?gameId=';
    } else { // User not signed in -> login
        $cartURL = 'login.php?gameId=';
    }
?>
<br><br><br>
<form class = "genreSelect" action="products.php" method="Post" style = "float:right">
<select name = "theGenre" class="dropdown">
<option value = "All">All</option>

<?php 
    //used to get the genres from DB
	include ('connectionSQL.php');
	$genreQuery = "select * from genres";
	$genreList = mysqli_query($link, $genreQuery);
    if($genreList){
        $genreRows = mysqli_num_rows($genreList);
        print $genreRows;
        while($genre = mysqli_fetch_array($genreList)) {
            print '<option value =' . '"' . $genre['genre_id'] . '">' . $genre['genre_id'] . '</option>';
        }
        print '<input name=' . '"' . 'theconsole' . '"' . 'type=' . "'" . 'hidden' . "'" . 'value = ' . "'" . $console . "'" . '>';
    }

    if(isset($_POST['submitQ'])){

        $selectedGenre = $_POST['theGenre'];
        $console = $_POST['theconsole'];
    }
?>
</select>
<input type = "submit" class="greyBackButtons" style="margin-left: 10px;" name ="submitQ" value="Search"/>
</form>
<br>



<?php
    if(($console == "" || $console == "All")){
        if($selectedGenre == "" || $selectedGenre == "All") {
            //none selected
            $query = 'select * from games';
        }
        else {
            //genre selected only
            $query = 'select * from games inner join game_genres using(game_id) where genre_id =' . '"' . $selectedGenre . '"';
        }
    }
    else {
        if($selectedGenre == "" || $selectedGenre == "All") {
        //console only selected
        $query = "select * from games where console_name like " . '"' . $console . '"';
    }
        else {
            //both selected
            $query = 'select * from games inner join game_genres using(game_id) where genre_id =' . '"' . $selectedGenre . '"' . 'AND console_name =' . '"' . $console . '"';
        }

    }

    //print "the console: " . $console . '<br>';
    //print "the genre: " . $selectedGenre . '<br>';
    //print "the query: " . $query . '<br>';
?>

<div class="textBack" align="left" style="float:left" >
<h1 style="font-size: 1.5vw">Products</h1>
<br><br><br>
<?php header('charset=utf-8');
    include ('connectionSQL.php');



    $result = mysqli_query($link, $query);
    if ($result)   {
        $row_count = mysqli_num_rows($result);
        //print 'Retreived '. $row_count . ' rows from the <b> games </b> table<BR><BR>';

        while ($row = mysqli_fetch_array($result)) {
            //print $row['name'] . '<br>' .
             print '<div class="clearfix">' . '<br>' .
             '<img class ="images" src ="' . $row['image'] . '">'.
             '<p class="gameName">' . $row['name'] . '</p><br>' .
             '<span class="consoleName">' . $row['console_name'] . '<br>' .'</span><br>'. 
             '<br>' . $row['description'] . '<br><br><br><br>'.
             '<a href="'. $cartURL . $row['game_id'] . '" class="cost"><p class="price">$'. $row['price'] .'<img src="cart.png" class="cart"></p></a></div>';
            echo '<hr name = "productLine">';
        }
    }
?>
<br>
<br>
<br>
<br>
<br>
</div>
<br>
<br>
<br>
<br>

	

</article>

<?php
    include('footer.php');
	
?>
