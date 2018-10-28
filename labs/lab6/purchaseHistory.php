<?php
    include "dbConnection.php";
    $conn = getDatabaseConnection('ottermart');
    
    $sql = "SELECT * FROM om_product 
            NATURAL JOIN om_purchase 
            WHERE productId = :pId";
    $namedparameters = array();
    $namedparameters[':pId'] = $_GET['productId'];
    
    $stmt = $conn->prepare($sql);
    $stmt->execute($namedparameters);
    $records = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    echo $records[0]['productName'] . "<br>";
    echo "<img src='" . $records[0]['productImage'] . "' width='200'><br>";
    
    foreach ($records as $r) {
        echo "Purchase Date: " . $r['purchaseDate'] . "<br>";
        echo "Unit Price: " . $r['unitPrice'] . "<br>";
        echo "Quantity: " . $r['quantity'] . "<br>";
    }
?>