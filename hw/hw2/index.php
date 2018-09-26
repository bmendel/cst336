<?php
    include "inc/game.php";
?>

<!DOCTYPE html>
<html>
    <head>
        <link href="css/styles.css" rel="stylesheet" type="text/css" />
    </head>
    <body>
        <header>
            <h1>Minesweeper Board Generator</h1>
            <h2>Constructs a random minesweeper game board!</h2>
        </header>
        
        <?php
            create_new_game();
        ?>
        
        <footer>
            <br /><br />
            Internet Programming. 2018&copy; Mendel <br />
            <strong>Disclaimer:</strong> The information on this webpage is fictitious.<br />
            It is used for academic purposes only.
        </footer>
    </body>
</html>