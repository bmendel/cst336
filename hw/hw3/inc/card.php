<?php

    function getColor($r, $g, $b) {
        $red = dechex($r);
        $red = strlen($red) > 1 ? $red : '0' . $red;
        $green = dechex($g);
        $green = strlen($green) > 1 ? $green : '0' . $green;
        $blue = dechex($b);
        $blue = strlen($blue) > 1 ? $blue : '0' . $blue;
        
        $hex = '#' . $red . $green . $blue;
        return $hex;
    }
    
    function makeCard($name, $type, $color, $rarity) {
        echo '<style> .card { background-color: ' . $color . ';} </style>';
        echo '<table class=\'card\' id=\'' . $rarity . '\' align=center>';
        echo '<tr><th>' . $name . '</th></tr>';
        echo '<tr><td class=\'pic\'> <img src=\'img/' . $type . '.png\'> </td></tr>';
        echo '</table>';
    }
?>