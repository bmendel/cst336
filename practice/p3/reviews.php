<?php

include 'inc/charts.php';
$posters = array("ready_player_one","rampage","paddington_2","hereditary","alpha","black_panther","christopher_robin","coco","dunkirk","first_man");

function movieReviews() {
    global $posters;
    
    $reviewposters = array();
    while (count($reviewposters) < 4){
        $random = rand(0,count($posters)-1);
        $reviewposters[] = $posters[$random];
        $reviewposters = array_unique($reviewposters);
    }
    sort($reviewposters);
    
    foreach(range(0,3) as $i) {
        $randomPoster = $reviewposters[$i];
        echo "<div class='poster'>";
        echo "<h2> $randomPoster </h2>";
        echo "<img width='100' src='img/posters/$randomPoster.jpg'>";    
        echo "<br>";
    
        //NOTE: $totalReviews must be a random number between 100 and 300
        $totalReviews = rand(100,300); 
        
        //NOTE: $ratings is an array of 1-star, 2-star, 3-star, and 4-star rating percentages
        //      The sum of rating percentages MUST be 100
        $star1 = rand(0,100);
        $star2 = rand(0,100-$star1);
        $star3 = rand(0,100-($star1+$star2));
        $star4 = 100 - ($star1+$star2+$star3);
        $ratings = array($star4, $star3, $star2, $star1);
        
        //NOTE: displayRatings() displays the ratings bar chart and
        //      returns the overall average rating
        
        $overallRating = displayRatings($totalReviews,$ratings);
        
        //NOTE: The number of stars should be the rounded value of $overallRating
        echo "<br><img src='img/star.png' width='25'>";
        for($i = 1; $i < $overallRating; $i++){
          echo "<img src='img/star.png' width='25'>";  
        }
        echo "<br>Total reviews: $totalReviews";
        echo "</div>";
    }
}    

?>

<!DOCTYPE html>
<html>
    <head>
        <title> Movie Reviews </title>
        <style type="text/css">
            body {
                background-image: url("img/bg.jpg");
                text-align:center;
                color: white;
            }
            #main {
                display:flex;
                justify-content: center;
            }
            .poster {
                padding: 0 10px;
            }
        </style>
    </head>
    <body>
       
       <h1> Movie Reviews </h1>
        <div id="main">
           <?php
             //NOTE: Add for loop to display 4 movie reviews
             movieReviews();
           ?>
       </div>
       <br/>
       <hr>
       <h1>Based on ratings you should watch:</h1>
       <h2>Anything else</h2>
    </body>
    
    <foot> Brandon Mendel, Maryann Cortez</foot>
</html>