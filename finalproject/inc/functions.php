<?php
    
    function validateSession() {
        if(!isset($_SESSION['user'])) {
            header('Location: index.php');
            exit;
        }
    }
    
    function getCategories($catId=0) {
        global $dbConn;
        $sql = "SELECT * FROM dk_categories";
        
        $stmt = $dbConn->prepare($sql);
        $stmt->execute();
        $categories = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        foreach ($categories as $c) {
            echo "<option ";
            echo ($c['categoryId'] == $catId) ? 'selected' : '';
            echo " value='" . $c['categoryId'] . "'>" . $c['categoryName'] . "</option>";
        }
    }
    
    function getResults() {
        // create sql statement and parameters
        global $dbConn;
        $sql = "SELECT * FROM dk_products WHERE 1 ";
        $np = array();
        
        // check for name
        if (!empty($_POST['name'])) {
            $sql .= " AND productName LIKE :name";
            $np[':name'] = "%".$_POST['name']."%";
        }
        
        // check for category
        if (!empty($_POST['category'])) {
            $sql .= " AND productCategory LIKE :category";
            $np[':category'] = $_POST['category'];
        }
        
        // check for price between lo and hi
        if (!empty($_POST['lo']) || !empty($_POST['hi'])) {
            if (!empty($_POST['lo']) && !empty($_POST['hi'])) {
                $sql .= " AND productValue BETWEEN :lo AND :hi";
                $np[':lo'] = $_POST['lo'];
                $np[':hi'] = $_POST['hi'];
            } 
            else if (!empty($_POST['lo'])) {
                $sql .= " AND productValue >= :lo";
                $np[':lo'] = $_POST['lo'];
            } 
            else {
                $sql .= " AND productValue <= :hi";
                $np[':hi'] = $_POST['hi'];
            }
        }
        
        // check for sorting method
        $sql .= " ORDER BY ";
        switch ($_POST['sort']) {
            case "name":
                $sql .= "productName";
                break;
            case "category":
                $sql .= "productCategory";
                break;
            case "value":
                $sql .= "productValue";
                break;
            case "quantity":
                $sql .= "productStock";
                break;
        }
        
        // get results from database
        $stmt = $dbConn->prepare($sql);
        $stmt->execute($np);
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $results;
    }
    
    // display results
    function displayResults() {
        if (isset($_POST['search'])) {
            echo "<h2>Results</h2>";
            if (!empty($_POST['lo']) && !empty($_POST['hi']) && $_POST['lo'] >= $_POST['hi']) {
                echo "<br><div id='error'>Error: Low value MUST be lower than high value!</div>";
                return;
            }
            
            $results = getResults();
            
            if (empty($results)) {
                echo "No results found!";
            }
            foreach ($results as $r) {
                echo "<hr><div><h3>" . $r['productName'] . "</h3>";
                echo "<image src='" . $r['productImage'] . "' alt='" . $r['productImage'] . "'><br><br>";
                echo "<a class='btn btn-outline-dark info' href='#' id='".$r['productId']."' role='button'>Info</a></div>";
            }
        }
    }
    
    function getProduct($productId) {
        global $dbConn;
        $sql = "SELECT * FROM dk_products WHERE productId LIKE :id";
        $np = array();
        $np[':id'] = $productId;
        
        $stmt = $dbConn->prepare($sql);
        $stmt->execute($np);
        $product = $stmt->fetch(PDO::FETCH_ASSOC);
        return $product;
    }
    
    function displayAdminResults() {
        if (isset($_POST['search'])) {
            if (!empty($_POST['lo']) && !empty($_POST['hi']) && $_POST['lo'] >= $_POST['hi']) {
                echo "<br><div id='error'>Error: Low value MUST be lower than high value!</div>";
                return;
            }
            
            $products = getResults();
            if (empty($products)) {
                echo "No results found!";
            }
            foreach ($products as $p) {
                echo "<hr><div><h3>" . $p['productName'] . "</h3>";
                echo "<image src='" . $p['productImage'] . "' alt='" . $p['productImage'] . "'><br><br>";
                echo "<a class='btn btn-outline-dark info' href='#' id='".$p['productId']."' role='button'>Info</a>";
                echo "<a class='btn btn-outline-dark' role='button' href='updateProduct.php?productId=".$p['productId']."'>Update</a>";
                echo "<form method='post' action='deleteProduct.php'>";
                    echo "   <input type='hidden' name='productId' value='".$p['productId']."'>";
                    echo "   <button class='btn btn-outline-danger' type='submit'>Delete</button>";
                echo "</form>";
            }
        }
    }
    
    function generateReports() {
        global $dbConn;
        $sql = "SELECT * FROM dk_products";
        
        $stmt = $dbConn->prepare($sql);
        $stmt->execute();
        $reports = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        $totalProducts = 0;
        $totalValue = 0;
        $totalStock = 0;

        foreach ($reports as $r) {
            $totalProducts++;
            $totalValue += $r['productValue'];
            $totalStock += $r['productStock'];
        }
        
        echo "<h3> Reports </h3>";
        echo "<div class='d-flex justify-content-center form-group row'>";
        echo "  <div class='col-1'>Total Products: </div>";  
        echo "  <div class='col-1'>" . $totalProducts . "</div>";
        echo "</div>";
        echo "<div class='d-flex justify-content-center form-group row'>";
        echo "  <div class='col-1'>Total Value: </div>";  
        echo "  <div class='col-1'>" . $totalValue . " Gold</div>";
        echo "</div>";
        echo "<div class='d-flex justify-content-center form-group row'>";
        echo "  <div class='col-1'>Total In Stock: </div>";  
        echo "  <div class='col-1'>" . $totalStock . "</div>";
        echo "</div>";
    }
?>