<?php
    session_start();
    
    include 'inc/dbConnection.php';
    include 'inc/functions.php';
    
    $dbConn = startConnection('ottermart');
    validateSession();
    
    $sql = 'DELETE FROM om_product WHERE productId = ' . $_GET['productId'];
    $stmt = $dbConn->prepare($sql);
    $stmt->execute();
    
    header("Location: admin.php");
?>
