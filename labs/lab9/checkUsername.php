
<?php

    include '../../inc/dbConnection.php';
    $dbConn = startConnection('ottermart');
    
    $sql = "SELECT * FROM om_admin WHERE username = :username";
    $np = array();
    $np[":username"] = $_GET["username"];
    
    $stmt = $dbConn->prepare($sql);
    $stmt->execute($np);
    $record = $stmt->fetch(PDO::FETCH_ASSOC);  //fetch for one record
    
    // DO NOT ECHO ANYTHING OTHER THAN json_encode($record)!!!!
    echo json_encode($record);
    
?>