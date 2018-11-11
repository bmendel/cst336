<?php
    session_start();
    
    include 'inc/dbConnection.php';
    $dbConn = startConnection('ottermart');
    
    $username = $_POST['username'];
    $password = sha1($_POST['password']);
    
    $sql = "SELECT * FROM om_admin
                     WHERE username = :username
                     AND password = :password";
                     
    $np = array();
    $np[':username'] = $username;
    $np[':password'] = $password;
    
    $stmt = $dbConn->prepare($sql);
    $stmt->execute($np);
    $record = $stmt->fetch(PDO::FETCH_ASSOC);
    
    if (empty($record)) {
        echo "Wrong username or password!";
        echo "<form action='index.php'>";
        echo "<input type='submit' name='' value='Back to Login'>";
        echo "</form>";
    }
    else {
        $_SESSION['adminFullName'] = $record['firstName'] . " " . $record['lastName'];
        header('Location: admin.php');
    }
?>