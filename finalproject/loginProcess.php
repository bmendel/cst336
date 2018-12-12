<?php

    function verifyLogin() {
        session_start();
        
        include '../inc/dbConnection.php';
        $dbConn = startConnection('c9');
        
        $username = $_POST['username'];
        $password = sha1($_POST['password']);
        
        $sql = "SELECT * FROM dk_admin
                         WHERE username = :username
                         AND password = :password";
                         
        $np = array();
        $np[':username'] = $username;
        $np[':password'] = $password;
        
        $stmt = $dbConn->prepare($sql);
        $stmt->execute($np);
        $record = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if (empty($record)) {
            echo "<h2>Wrong username or password!</h2><br>";
            echo "<a class='btn btn-outline-dark' href='login.php' role='button'>Back to Login</a>";
            echo "<br>";
            echo "<a class='btn btn-outline-dark' href='index.php' role='button'>Back to Home</a>";
            
        }
        
        else {
            $_SESSION['user'] = $record['username'];
            header('Location: admin.php');
        }
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
         
         <?php verifyLogin(); ?>
         
         <?php include 'inc/footer.php'; ?>
    </body>
</html>