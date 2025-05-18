<?php
    $dsn = "mysql:host=127.0.0.1;dbname=hospital";
    $conn = new PDO($dsn, "root", "root@123");
    $conn -> setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
?>