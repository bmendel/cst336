<?php

    class Minesweeper {
        public $board;
        public $row, $col;
        public $mines;
        
        function __construct($x, $y, $m) {
            $this->row = $y;
            $this->col = $x;
            $this->mines = $m;
            $this->build_board();
        }
        
        function build_board() {
            $this->board = array();
            $size = $this->row * $this->col;
            foreach (range(0, $size-1) as $space) {
                $space_value = ($space < $this->mines) ? 1 : 0;
                array_push($this->board, $space_value); 
            } 
        }
        
        function randomize_board() {
            shuffle($this->board);
        }
        
        function display_board() {
            echo "<table>";
            foreach (range(0, $this->col-1) as $y) {
                echo "<tr>";
                foreach (range(0, $this->row-1) as $x) {
                    $image = $this->board[$y * $this->row + $x] 
                            ? "mine" : "no_mine";
                    echo "<td><button class='button $image'></button></td>";
                }
                echo "</tr>";
            }
            echo "</table>";
            
            echo "<form action='index.php'>";
            echo "<button type='submit'><h2>Make a new board!</h2></button>";
            echo "</form>";
        }
    }
?>