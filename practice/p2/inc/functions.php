<?php

    function display() {
        $wins_1 = 0;
        $wins_2 = 0;
        
        for ($i = 0; $i < 3; ++$i) {
            $win = play();
            switch($win) {
                case 1:
                    ++$wins_1;
                    break;
                case 2:
                    ++$wins_2;
                    break;
            }
        }
        
        $winner = getWinner($wins_1, $wins_2);
        echo "<div id='finalWinner'>";
        echo "<h1>The winner is Player $winner</h1></div>";
    }
    
    function play() {
        $play_1 = 0;
        $play_2 = 0;
        while ($play_1 == $play_2) {
            $play_1 = rand(0,2);
            $play_2 = rand(0,2);
        }
        
        $hand_1 = getHand($play_1);
        $hand_2 = getHand($play_2);
        
        
        $winner = getWinningHand($play_1, $play_2);
        displayRound($winner, $hand_1, $hand_2);
        return $winner;
    }
    
    function getHand($play) {
        switch($play) {
            case 0:
                return 'rock';
            case 1:
                return 'paper';
            case 2:
                return 'scissors';
        }
    }
    
    function getWinningHand($play_1, $play_2) {
        if ($play_1 == 0 && $play_2 == 2) {
            return 1;
        }
        if ($play_1 == 2 && $play_2 == 0) {
            return 2;
        }
        return ($play_1 > $play_2) ? 1 : 2;
    }
    
    function displayRound($winner, $hand_1, $hand_2) {
        echo "<div class='row'>";
        switch ($winner) {
            case 1:
                echo "<div class='col, matchWinner'><img src='img/$hand_1.png' alt='$hand_1' width='150'></div>";
                echo "<div class='col'><img src='img/$hand_2.png' alt='$hand_2' width='150'></div>";
                break;
            case 2:
                echo "<div class='col'><img src='img/$hand_1.png' alt='$hand_1' width='150'></div>";
                echo "<div class='col, matchWinner'><img src='img/$hand_2.png' alt='$hand_2' width='150'></div>";
                break;
        }
        echo "</div><hr>";    
    }
    
    function getWinner($wins_1, $wins_2) {
        return ($wins_1 > $wins_2) ? 1 : 2;
    }
    
    
?>