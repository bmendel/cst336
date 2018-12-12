<?php
    session_start();
    
    include '../inc/dbConnection.php';
    include 'inc/functions.php';
    
    $dbConn = startConnection('c9');
    validateSession();
    
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
        
        <h1> Dungeon Keeper: Admin Page </h1>
        
        <?php generateReports() ?>
        
        <a class='btn btn-outline-dark' href='admin.php' role='button'>Back</a>
        
        <?php include 'inc/footer.php'; ?>
        
    </body>
</html>