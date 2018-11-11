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
                WHERE productId = " . $_GET['productId'];
                
        $np = array();
        $np[':productName'] = $productName;
        $np[':productDescription'] = $productDescription;
        $np[':productImage'] = $image;
        $np[':price'] = $price;
        $np[':catId'] = $catId;
        
        $stmt = $dbConn->prepare($sql);
        $stmt->execute($np);
        echo "Product " . $_GET['productName'] . " was updated!<br>";
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
            Description: <textarea name='productDescription' cols='50' rows='4'> <?=$productInfo['productDescription']?> </textarea><br>
            Price: <input type='text' name='price' value='<?=$productInfo['price']?>'><br>
            Category: 
            <select name='catId'>
                <option value=''>Select One</option>
                <?php
                    $categories = getCategories();
                    
                    foreach($categories as $c) {
                        echo "<option ";
                        echo ($c['catId'] == $productInfo['catId']) ? 'selected' : '';
                        echo " value='" . $c['catId'] . "'>" . $c['catName'] . "</options>";
                    }
                ?>
            </select><br>
            Set Image URL: <input type='text' name='productImage' value='<?=$productInfo['productImage']?>'><br>
            <input type="submit" name="updateProduct" value="Update Product">
        </form>
        
        <form action='admin.php'>
            <input type='submit' name='' value='Back to Admin'>
        </form>
    </body>
</html>