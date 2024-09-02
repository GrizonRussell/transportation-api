<?php
    $servername = "localhost";
    $dbusername = "root";
    $dbpassword = "";
    $dbname = "sacay_db";

    try {
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $dbusername, $dbpassword);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
    }catch(PDOException $e){
        echo "Connection failed: " . $e->getMessage();
    }
?>