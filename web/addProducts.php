<?php 
include "header.html";
?>

<script>
    function validation() {
        var inputElems = document.getElementsByTagName("input");
        var count = 0;
        for (var i=0; i<inputElems.length; i++) {
            if (inputElems[i].type === "checkbox" && inputElems[i].checked === true) {
                count++;
            }
        }
        if(count < 1){
            alert("You must select a genre");
            return false;
        }
    }
</script>

<article>
    <div class="textBack" align="left" style="float:left" >
<h1>Add Product</h1><br><br><br>
    <form action="productInsert.php" method="POST" enctype="multipart/form-data" onsubmit="return validation();">
        <input type="hidden" name="MAX_FILE_SIZE" value="3000000">
        <p>Game Name: <input type="text" name="gamename" id="gamename" required /></p>
        <p>Price: <input type="text" name="price" id="price" pattern="^\d+(\.\d{1,2})?$" required /></p>
        <p>Description: </p><textarea name="gamedesc" id="gamedesc" rows="8" cols="60"></textarea>
        <p>Image: <input type="file" name="image" id="image" accept="image/png, image/jpeg"/></p>
        <p>Console:
            <input type="radio" name="console" value="PS4" required> PS4
            <input type="radio" name="console" value="XB1" required> XBOX ONE
            <input type="radio" name="console" value="PC" required> PC
            <input type="radio" name="console" value="Nintendo_Switch" required> SWITCH</p>
        <p> Genre:
            <input type="checkbox" name="genre[]" value="action"> Action
            <input type="checkbox" name="genre[]" value="adventure"> Adventure
            <input type="checkbox" name="genre[]" value="strategy"> Strategy
            <input type="checkbox" name="genre[]" value="rpg"> RPG
            <input type="checkbox" name="genre[]" value="MMO"> MMO
            <input type="checkbox" name="genre[]" value="open-world"> Open-world
            <input type="checkbox" name="genre[]" value="racing"> Racing
            <input type="checkbox" name="genre[]" value="shooter"> Shooter</p>
        <input type="submit" value="Submit" />
    </form>

    </div>
</article>

<?php
include('footer.php');
	
?>