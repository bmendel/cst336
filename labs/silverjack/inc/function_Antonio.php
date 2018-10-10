<?php
    global $totals;
    global $players;
    global $moreThanOneWinner;
    
    function displayWinner(){
        global $totals;
        global $players;
        $highestScore=0;
        $everyPlayerScoreAdded = 0;
        //this will get the highest score
        foreach ($totals as $playerScore) {
            if($highestScore<$playerScore &&$playerScore <=42){
                $highestScore=$playerScore;
            }
            $everyPlayerScoreAdded+=$playerScore;
        }

        $tiedWinners = array();// dictionary of winners and their scores
        foreach ($totals as $key=>$value) {
            if($highestScore==$value){
                $tiedWinners[$key]=$value;
            }
        }
        // check for more than one winner
        if(count($tiedWinners)>1){
            $moreThanOneWinner=true;
        }

        // displaying winners
        foreach ($tiedWinners as $key=>$value) {
            echo $key. " has the score of ". ($everyPlayerScoreAdded-(count($tiedWinners)*$highestScore));
            echo "<br>";
        }
    }

?>
