<?php
    function addSelector($prompt, $name, $options) {
        echo $prompt;
        echo '<select name=\'' . $name . '\'';
        foreach ($options as $o) {
            echo '<option value=\'' . $o . '\'>' . $o . '</option>';
        }
        echo '</select>';
    }
    
    function addRadioInput($prompt, $name, $options) {
        echo $prompt;
        foreach ($options as $o) {
            echo '<input type=\'radio\' name=\'' . $name . '\' value=\'' . $o . '\'>' . $o;
        }
    }
    
    function drawCalendar($month, $locationNum, $country, $order) {
        // Calculate number of locations
        echo '<h1>' . $month . ' Itinerary</h1>';
        echo '<h2>Visiting ' . lcfirst($locationNum) . ' places in ' . $country . '</h2>';
        
        switch ($locationNum) {
            case 'Three':
                $locations = 3;
                break;
            case 'Four':
                $locations = 4;
                break;
            case 'Five':
                $locations = 5;
                break;
        }
        
        // Calculate number of days
        switch ($month) {
            case 'February':
                $days = 28;
                break;
            case 'November':
                $days = 30;
                break;
            default:
                $days = 31;
                break;
        }
        
        // Select locations and days for itinerary
        $usa = ['chicago', 'hollywood', 'las_vegas', 'ny', 'washington', 'yosemite'];
        $mexico = ['acapulco', 'cabos', 'cancun', 'chichenitza', 'huatulco', 'mexico_city'];
        $france = ['bordeaux', 'le_havre', 'lyon', 'montpellier', 'paris', 'strasbourg'];
        
        $rand_days = array_rand(range(1, $days), $locations);
        switch($country) {
            case 'USA':
                $rand_pics = array_rand($usa, $locations);
                break;
            case 'Mexico':
                $rand_pics = array_rand($mexico, $locations);
                break;
            case 'France':
                $rand_pics = array_rand($france, $locations);
                break;
        }
        
        // Translate days into calendar table
        echo '<table align=center>';
        foreach (range(0, 4) as $week) {
            echo '<tr>';
            foreach (range(($week*7) + 1, (($week+1)*7)) as $day) {
                if (in_array($day, range(0, $days))) {
                    echo '<td>' . $day . '</td>';
                }
            }
            echo '</tr>';
        }
        echo '</table>';
    }
?>