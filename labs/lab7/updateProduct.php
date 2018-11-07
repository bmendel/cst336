<?php
    session_start();
    
    include 'inc/dbConnection.php';
    include 'inc/functions.php';
    
    $dbConn = startConnection('ottermart');
    validateSession();
    
    if (isset($_GET['updateProduct'])) {
        $productName = $_GET['productName'];
        $description = $_GET['productDescription'];
        $price = $_GET['price'];
        $catId = $_GET['catId'];
        $image = $_GET['productImage'];
        
        $sql = "UPDATE om_product
                SET productName = :productName
                    productDescription = :productDescription
                    price = :price
                    catId = :catId
                    productImage = :productImage
                WHERE productID = " . $_GET['productId'];
    }
    
    if (isset($_GET['productId'])) {
        $productInfo = getProductInfo($_GET['productId']);
    }
?>

<!DOCTYPE html>
<html>
    
    <head>
        <title> Update Products </title>
    </head>
    
    <body>
        <h1> Updating a Product </h1>
        <form>
            Product ID: <input type='text' name='productId' value='<?=$productInfo['productId']?>'><br>
            Product name: <input type='text' name='productName' value='<?=$productInfo['productName']?>'><br>
            Description: <textarea name='description' cols='50' rows='4'> <?=$productInfo['productDescription']?> </textarea><br>
            Price: <input type='text' name='price' value='<?=$productInfo['price']?>'><br>
            Category: 
            <select name='catId'>
                <option value=''>Select One</option>
                <?php
                    $categories = getCategories();
                    
                    foreach($categories as $c) {
                        echo "<option ";
                        echo ($category['catId'] == $productInfo['catId']) ? 'selected' : '';
                        echo " value='" . $category['catId'] . "'>" . $category['catName'] . "</options>";
                    }
                ?>
            </select><br>
            Set Image URL: <input type='text' name='productImage' value='<?=$productInfo['productImage']?>'><br>
        </form>
    </body>
</html>