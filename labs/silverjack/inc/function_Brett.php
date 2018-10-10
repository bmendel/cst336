
<?php
    function getHand() {
        global $deck;
        $sum = 0;
        $hand = array();
        while($sum <= 35) {
            $card = $deck->drawFromDeck();
            array_push($hand, $card);
            $sum += $card->value;
        }
        array_push($hand, $sum); // Add sum as last element in array
        return $hand;
    }
    
    function displayHand($hand, $total) {
        echo "<div class='hand'>";
        for($i=0; $i<count($hand); $i++) {
            echo "<img src=\"./" . $hand[$i]->name . "\"/>";
        }
        echo "</div><div class='total'><h3>$total</h3></div></div>";
    }
?>

<!--<!DOCTYPE html>-->
<!--<html>-->
<!--    <head>-->
<!--        <title> </title>-->
<!--    </head>-->
<!--    <body>-->
<!--    </body>-->
<!--</html>-->