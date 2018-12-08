<?php
    session_start();
    include '../../inc/dbConnection.php';
    
    $dbConn = startConnection("c9");
    $username = $_POST['username'];
    $password = sha1($_POST['password']);
    
    $sql = "SELECT userId FROM p10_users
                WHERE username = :username
                AND password = :password";
    $np = array();
    $np['username'] = $username;
    $np['password'] = $password;
    
    $stmt = $dbConn->prepare($sql);
    $stmt->execute($np);
    $record = $stmt->fetch(PDO::FETCH_ASSOC);
    
    if (empty($record)) {
        echo "Wrong username or password!";
        echo "<form action='login.html'>";
        echo "<input type='submit' name='' value='Back to Login'>";
        echo "</form>";
    }
    else {
        $_SESSION['userId'] = $record['userId'];
        $_SESSION['username'] = $record['username'];
        header('Location: quiz.html');
    }
?>