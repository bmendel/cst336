<?php
    include "inc/calendar.php";
?>

<!DOCTYPE html>
<html>
    <head>
        <link href="css/styles.css" rel="stylesheet" type="text/css" />
    </head>
    
    <body>
        <form method="GET">
            <!-- Month Selection -->
            <br />
            <?php 
                $months = ["", "November", "December", "January", "February"];
                addSelector('Select a month: ', 'month', $months);
            ?>
            <br />
            
            <!-- Location count selection -->
            <br />
            <?php
                $nums = ["Three", "Four", "Five"];
                addRadioInput('Number of locations: ', 'locationNum', $nums);
            ?>
            <br />
            
            <!-- Country selection -->
            <br />
            <?php 
                $locations = ["", "USA", "Mexico", "France"];
                addSelector('Select country: ', 'country', $locations);
            ?>
            <br />
            
            <!-- Order selection -->
            <br />
            <?php 
                $orders = ["A-Z", "Z-A"];
                addRadioInput('Visit locations in alphabetical order: ', 'order', $orders);
            ?>
            <br />
            
            <br />
            <input type="submit" value="Create Itinerary" />
            <br />
        </form>
        
        <?php 
            if (empty($_GET['month'])) {
                echo "<div id='error'>Must choose a month!</div>";
            }
            if (empty($_GET['locationNum'])) {
                echo "<div id='error'>Must choose a number of locations!</div>";
            }
            if (empty($_GET['country'])) {
                echo "<div id='error'>Must choose a country!</div>";
            }
            if (empty($_GET['order'])) {
                echo "<div id='error'>Must choose an order!</div>";
            }
            if (!empty($_GET['month']) && !empty($_GET['locationNum']) &&
                !empty($_GET['country']) && !empty($_GET['order'])) {
                drawCalendar($_GET['month'], $_GET['locationNum'], $_GET['country'], $_GET['order']);
            }
        ?>
    </body>
</html>
