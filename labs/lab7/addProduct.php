<?php
    session_start();
    
    include 'inc/dbConnection.php';
    include 'inc/functions.php';
    
    $dbConn = startConnection('ottermart');
    validateSession();
    
    if (isset($_GET['addProduct'])) {
        
        $sql = "INSERT INTO om_product (productName, productDescription, productImage, price, catId)
                VALUES (:productName, :productDescription, :productImage, :price, :catId);";
        $np = array();
        $np[':productName'] = $_GET['productName'];
        $np[':productDescription'] = $_GET['productDescription'];
        $np[':productImage'] = $_GET['productImage'];
        $np[':price'] = $_GET['price'];
        $np[':catId'] = $_GET['catId'];
        
        $stmt = $dbConn->prepare($sql);
        $stmt->execute($np);
        echo "New Product was added!";
    }
?>

<!DOCTYPE html>
<html>
    <head>
        <title> Admin Section: Add New Product </title>
    </head>
    <body>
        <h1> Adding New Product </h1>
        
        <form>
            Product name: <input type='text' name='productName'><br>
            Description: <textarea name='description' cols='50' rows='4'></textarea><br>
            Price: <input type='text' name='price'><br>
            Category:
            <select name='catId'>
                <option value=''> Select One </option>
                <?php   
                    $categories = getCategories();
                    foreach($categories as $c) {
                        echo "<option value='" . $c['catId'] . "'> " . $c['catName'] . " </option>";
                    }
                ?>
            </select><br>
            Set Image URL: <input type='text' name='productImg'><br>
            <input type='submit' name='submitProduct' value='Add Product'>
        </form>
    </body>
</html>