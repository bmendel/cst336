<?php
    session_start();
    
    include '../inc/dbConnection.php';
    include 'inc/functions.php';
    
    $dbConn = startConnection('dungeon_keeper');
    validateSession();
    
    if (isset($_POST['delete'])) {
        $sql = 'DELETE FROM dk_products WHERE productId = ' . $_POST['productId'];
        $stmt = $dbConn->prepare($sql);
        $stmt->execute();
        
        header("Location: admin.php");
    }
?>

<!DOCTYPE html>
<html>
    <head>
        <title> Dungeon Keeper </title>
        
    	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
    	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js" integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous"></script>   
        
        <link rel="stylesheet" href="css/styles.css" type="text/css">
        <link href="https://fonts.googleapis.com/css?family=IM+Fell+DW+Pica+SC" rel="stylesheet">
    </head>
    
    <body>
         <?php include 'inc/header.php'; ?>
         
         <h2>Delete Product</h2>
         <h3>Are you sure you want to delete the product?</h3><br>
         
         <form method='post'>
             <?php echo "<input type='hidden' name='productId' value='".$_POST['productId']."'>" ?> 
             <button class='btn btn-outline-danger' name='delete' type='submit'>Delete</button>
         </form>
         <a class='btn btn-outline-dark' href='admin.php' role='button'>Back to Admin</a>
         
         <?php include 'inc/footer.php'; ?>
    </body>
</html>