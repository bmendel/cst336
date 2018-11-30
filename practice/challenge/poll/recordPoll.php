

<?php

    include '../../../inc/dbConnection.php';
    $dbConn = startConnection('poll_results');
    
    $sql = "SELECT * FROM answers WHERE 1";
    
    
    $stmt = $dbConn->prepare($sql);
    $stmt->execute();
    $record = $stmt->fetch(PDO::FETCH_ASSOC);  //fetch for one record
    
    // DO NOT ECHO ANYTHING OTHER THAN json_encode($record)!!!!
    echo json_encode($record);
    
?>