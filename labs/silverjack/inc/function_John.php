<?php
    

     function play(){
        global $players;
        $players = array(0,1,2,3);
        $playerNames = array();
        shuffle($players);
        $totals = array();
        global $deck;
        
        global $totals;
        
         echo "<div id='players' style='width:60px;'>";
           
        for($i=0; $i<4; $i++){
            
            $random = array_pop($players);
            
            switch($random){
                case 0: $symbol = "black mage";
                        $playerNames[$i] = "Black_mage";
                           break;
                           
                case 1: $symbol = "fighter";
                        $playerNames[$i] = "Fighter";
                           break;
                           
                case 2: $symbol = "ninja";
                        $playerNames[$i] = "Ninja";
                           break;
                           
                case 3: $symbol = "white mage";
                        $playerNames[$i] = "White_mage";
                           break;
            }
           
            // echo"Player Names: " . $playerNames[$i];
            echo "<h2> ".ucfirst($symbol).":  </h2>";
            echo "<img src='img/player_img/$symbol.png' alt='player' title='".ucfirst($symbol)."' style='width:60px; float:left; padding-bottom:10px; padding-left:100px; padding-right:20px;'  />";
           echo "</div>";
            $hand = getHand();
            $total = array_pop($hand);
            $totals[$players[$i]] = $total;
            displayHand($hand, $total);
            
        }
        echo"</div>";
        
        echo "<div class='winner-container style:'color:black'><h2>";
        displayWinner($playerNames);
        //winners($playerNames, $totals);
       
        echo "</h2></div>";
        displayAverageTime();
        
    }

    function winners($playerNames, $totals){
        
    }

?>