
<?php

    include '../../inc/dbConnection.php';
    $dbConn = startConnection('dungeon_keeper');
    
    $sql = "SELECT * FROM dk_products WHERE productId = :id";
    $np = array();
    $np[':id'] = $_GET['productId'];
    
    $stmt = $dbConn->prepare($sql);
    $stmt->execute($np);
    $record = $stmt->fetch(PDO::FETCH_ASSOC);
    
    echo json_encode($record);
?>