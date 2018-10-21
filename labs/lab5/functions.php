<?php
    function displayResults() {
        global $items;
        if (isset($items) && !empty($items)) {
            echo '<table class=\'table\' align=center>';
            foreach ($items as $i) {
                $itemName = $i['name'];
                $itemPrice = $i['salePrice'];
                $itemImage = $i['thumbnailImage'];
                $itemId = $i['itemId'];
                
                echo '<tr>';
                echo '<td><img src=' . $itemImage . '></td>';
                echo '<td><h4>' . $itemName . '</h4></td>';
                echo '<td><h4>$' . $itemPrice . '</h4></td>';
                
                echo '<form method=\'post\'>';
                echo '<input type=\'hidden\' name=\'itemName\' value=\'' . $itemName . '\'>';
                echo '<input type=\'hidden\' name=\'itemId\' value=\'' . $itemId . '\'>';
                echo '<input type=\'hidden\' name=\'itemImage\' value=\'' . $itemImage . '\'>';
                echo '<input type=\'hidden\' name=\'itemPrice\' value=\'' . $itemPrice . '\'>';
                
                $inCart = false;
                foreach ($_SESSION['cart'] as $added) {
                    if ($added['id'] == $itemId) {
                        $inCart = true;
                        break;
                    }
                }   
                if ($inCart) {
                    echo '<td><button class-\'btn btn-success\' disabled>Added</button></td>';
                }
                else {
                    echo '<td><button class-\'btn btn-warning\'>Add</button></td>';
                }
                
                echo '</tr>';
                echo '</form>';
            }
            echo '</table>';
        }
        else {
            echo 'No results found!';
        }
    }
    
    function displayCartCount() {
        echo count($_SESSION['cart']);
    }
    
    function displayCart() {
        if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])) {
            echo '<table class=\'table\'>';
            foreach ($_SESSION['cart'] as $item) {
                $itemId = $item['id'];
                $itemQuant = $item['quantity'];
                
                echo '<tr>';
                echo '<td><img src=\'' . $item['image'] . '\'></td>';
                echo '<td><h4>' . $item['name'] . '</h4></td>';
                echo '<td><h4>$' . $item['price'] . '</h4></td>';
                
                echo '<form method=\'post\'>';
                echo '<input type=\'hidden\' name=\'itemId\' value=\'' . $itemId . '\'>';
                echo '<td><input type=\'text\' name=\'update\' class=\'form-control\' placeHolder=\'' . $itemQuant . '\'></td>';
                echo '<td><button  class-\'btn btn-danger\'>Update</button></td>';
                echo '</form>';
                
                echo '<form method=\'post\'>';
                echo '<input type=\'hidden\' name=\'removeId\' value=\'' . $itemId . '\'>';
                echo '<td><button  class-\'btn btn-danger\'>Remove</button></td>';
                echo '</form>';
                echo '</tr>';
            }
            echo '</table>';
        }
        else {
            echo 'There is nothing in your cart!';
        }
    }
?>