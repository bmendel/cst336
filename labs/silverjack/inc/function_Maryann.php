<?php
    session_start();
    
    function playedGames(){
        
        if(!isset($_SESSION['played'])){
            $_SESSION['played'] = 0;
        }
        $_SESSION['played']++;
    
        return $_SESSION['played'];
    
    }
    
    $start = microtime(true);
    
    function elapsedTime(){
        global $start;
        $elapsedTime = microtime(true) - $start;
        return $elapsedTime;
    }
    
    function displayAverageTime(){
        if(!isset($_SESSION['average'])){
            $_SESSION['average'] = 0;
        }
         
        $gamesPlayed = playedGames();
        echo "<h4>Matches Played: ".$gamesPlayed."</h4>";
         
        $time = elapsedTime();
        echo "<h4>Elapsed Time: ".$time."s</h4>";
         
        $_SESSION['average'] += $time;
        echo "<h4>Average Time: ".($_SESSION['average']/$gamesPlayed)."s</h4>";
    }
?>