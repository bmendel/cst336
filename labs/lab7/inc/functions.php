<?php
    
    function validateSession() {
        if(!isset($_SESSION['adminFullName'])) {
            header('Location: index.php');
            exit;
        }
    }
    
    function displayAllProducts() {
        global $dbConn;
        
        $sql = 'SELECT * FROM om_product ORDER BY productName';
        $stmt = $dbConn->prepare($sql);
        $stmt->execute();
        $records = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        foreach($records as $r) {
            echo "[<a href='updateProduct.php'> Update </a>]";
            echo "<form action='deleteProduct.php' onsubmit='ConfirmDelete()'>";
            echo "  <input type='hidden' name='productId' value=-'" . $record['productId'] . "'>";
            echo "  <button type='submit'> Delete </button>";
            echo $record['productName'] . " $" . $record['price'] . "<br>";
        }
    }
    
    function getCategories() {
        global $dbConn;
    
        $sql = 'SELECT * FROM om_category ORDER BY catName';
        $stmt = $dbConn->prepare($sql);
        $stmt->execute();
        $records = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        return $records;
    }
    
    function geProductInfo($productId) {
        global $dbConn;
        
        $sql = "SELECT * FROM om_product WHERE productId = $productId";
        $stmt = $dbConn->prepare($sql);
        $stmt->execute();
        $record = $stmt->fetch(PDO::FETCH_ASSOC);
        
        return $record;
    }
?>