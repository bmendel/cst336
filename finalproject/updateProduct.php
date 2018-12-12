<?php
    session_start();
    
    include '../inc/dbConnection.php';
    include 'inc/functions.php';
    
    $dbConn = startConnection('dungeon_keeper');
    validateSession();
    
    if (isset($_POST['update'])) {
        
        $sql = "UPDATE dk_products
                SET productName = :name, 
                    productCategory = :category,
                    productImage = :image,
                    productDescription = :description,
                    productValue = :value,
                    productStock = :stock
                WHERE productId = :id";
                
        $np = array();
        $np[':name'] = $_POST['name'];
        $np[':category'] = $_POST['category'];
        $np[':image'] = $_POST['image'];
        $np[':description'] = $_POST['description'];
        $np[':value'] = $_POST['value'];
        $np[':stock'] = $_POST['quantity'];
        $np[':id'] =  $_POST['productId'];
        
        $stmt = $dbConn->prepare($sql);
        $stmt->execute($np);
    }
    
    if (isset($_GET['productId'])) {
        $product = getProduct($_GET['productId']);
    }
?>

<!DOCTYPE html>
<html>
    
    <head>
        <title> Dungeon Keeper Admin </title>
        
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
    	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js" integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous"></script>   
        
        <link rel="stylesheet" href="css/styles.css" type="text/css">
        <link href="https://fonts.googleapis.com/css?family=IM+Fell+DW+Pica+SC" rel="stylesheet">
    </head>
    
    <body>
        <?php include 'inc/header.php'; ?>
        
        <form method='post'>
            <div class='container'>    
                <legend>
                    <?php
                        echo "<legend>";
                        if (!isset($_POST['update'])) {
                            echo "Update " . $product['productName'];
                        }
                        else {
                            echo $product['productName'] . " was updated!";
                        }
                        echo "</legend>";
                    ?>
                </legend>
                
                <div class='d-flex justify-content-center form-group row'>
                    <label for='name' class='col-form-label col-2'>Name</label>        
                    <div class='col-3'><input class="form-control" name='name' id='name' type='text' value='<?=$product['productName']?>'></div>
                </div>
                
                <div class='d-flex justify-content-center form-group row'>
                    <label for='category' class='col-form-label col-2'>Category</label>         
                    <div class='col-3'><select class="form-control" name='category' id='category'>
                        <?php getCategories($product['productCategory']); ?>
                    </select></div>
                </div>
                
                <div class='d-flex justify-content-center form-group row'>
                    <label for='image' class='col-form-label col-2'>Image File</label>
                    <div class='col-3'><input class="form-control" name='image' id='image' type='text' value='<?=$product['productImage']?>'></div>
                </div>
                
                 <div class='d-flex justify-content-center form-group row'>
                    <label for='description' class='col-form-label col-2'>Description</label>         
                    <div class='col-3'><textarea class="form-control" name='description' id='description' cols='50' rows='4'><?=$product['productDescription']?></textarea></div>
                </div>
                
                <div class='d-flex justify-content-center form-group row'>
                    <label for='value' class='col-form-label col-2'>Value</label>         
                    <div class='col-3'><input class="form-control" name='value' id='value' type='text' value='<?=$product['productValue']?>'></div>
                </div>
                
                <div class='d-flex justify-content-center form-group row'>
                    <label for='quantity' class='col-form-label col-2'>Quantity</label>         
                    <div class='col-3'><input class="form-control" name='quantity' id='quantity' type='text' value='<?=$product['productStock']?>'></div>
                </div>
            </div><br>
        
            <input type='hidden' name='productId' value='<?=$product['productId']?>'>
            <input type='submit' class='btn btn-outline-dark' name='update' value='Update Product'>
            <a class='btn btn-outline-dark' href='admin.php' role='button'>Back to Admin</a>
        </form>

        <?php include 'inc/footer.php'; ?>
    </body>
</html>