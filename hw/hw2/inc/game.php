<?php
    
    include "minesweeper.php";
    
    function create_new_game() {
        $rows = rand(5, 10);
        $cols = rand(5, 10);
        $mines = rand(5, ($rows*$cols)-10);
        
        echo "Creating a $cols x $rows game with $mines mines...<br />";
        $game = new Minesweeper($rows, $cols, $mines);
        $game->randomize_board();
        $game->display_board();
    }
?>