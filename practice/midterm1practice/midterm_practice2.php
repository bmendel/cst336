<?php
    $host = "localhost";
    $dbname = "midterm";
    $username = "root";
    $password = "";
    
    $dbConn = new PDO("mysql:host=$host;dbname=$dbname;", $username, $password);
    $dbConn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // Report 1
    $sql = "SELECT * FROM mp_town WHERE population BETWEEN 50000 AND 80000";
    $stmt = $dbConn->prepare($sql);
    $stmt->execute(array(':town_name'=>'population'));
    while ($row = $stmt->fetch()) {
        echo $row['town_name'] . " - " . $row['population'] . '<br />';
    }
    
    // Report 2
    $sql = "SELECT * FROM mp_town ORDER BY population DESC";
    $stmt = $dbConn->prepare($sql);
    $stmt->execute(array(':town_name'=>':population'));
    while ($row = $stmt->fetch()) {
        echo $row['town_name'] . " - " . $row['population'] . '<br />';
    }
    
    // Report 3
    $sql = "SELECT * FROM mp_town ORDER BY population ASC";
    $stmt = $dbConn->prepare($sql);
    $stmt->execute(array(':town_name'=>':population'));
    foreach (range(1, 3) as $i) {
        $row = $stmt->fetch();
        echo $row['town_name'] . " - " . $row['population'] . '<br />';
    }
    
    // Report 4
    $sql = "SELECT * FROM mp_county WHERE country_name LIKE 'S'%";
    $stmt = $dbConn->prepare($sql);
    $stmt->execute(array(':county_name'));
    while ($row = $stmt->fetch()) {
        echo $row['county_name'] . '<br />';
    }
?>