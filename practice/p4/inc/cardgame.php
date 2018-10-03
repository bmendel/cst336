<?php
    include 'deck.php';
    
    function display_game($row=5, $col=5) {
        $deck = new Deck();
        $kings = 0;
        $aces = 0;
    
        echo '<table>';
        foreach (range(0, $row-1) as $i) {
            echo '<tr>';
            foreach (range(0, $col-1) as $j) {
                $card = $deck->drawFromDeck();
                switch ($card->value) {
                    case 1:
                        echo "<td id='ace'><img src='$card->name'></td>";
                        ++$aces;
                        break;
                    case 13:
                        echo "<td id='king'><img src='$card->name'></td>";
                        ++$kings;
                        break;
                    default:
                        echo "<td id='other'><img src='$card->name'></td>";
                        break;
                }
            }
            echo '</tr>';
        }
        echo '</table>';
        
        display_result($aces, $kings);
    }
    
    function display_result($aces, $kings) {
        echo "<br /><br />Number of Aces: $aces";
        echo "<br />Number of Kings: $kings";
        echo "<br /><br />";
        
        if ($aces > $kings) {
            echo "<h1>Winner - Aces<h1>";
        }
        else if ($aces < $kings) {
            echo "<h1>Winner - Kings</h1>";
        }
        else {
            echo "<h1>Tie - No winner</h1>";
        }

    }
    
    function display_settings() {
        echo "<form action='index.php'>";
        echo "Number of Rows: <input type='text' name='numRows'><br>";
        echo "Number of Columns: <input type='text' name='numCols'><br><br>";
        
        echo "Suit to omit: <select>
              <option value='hearts'>Hearts</option>
              <option value='clubs'>Clubs</option>
              <option value='diamonds'>Diamonds</option>
              <option value='spades'>Spades</option>
            </select>";
            
        echo "<input type='submit' value='Submit'><br>";
        echo "</form>";
    }
?>