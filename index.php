<?php

$db_config = require('./config/db.php');

try {
    $db = new PDO( 
        "mysql:host={$db_config['host']};dbname={$db_config['dbname']}",
        $db_config['username'],
        $db_config['password'],
        [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
    );
} catch (PDOException $e) {
    die('Failed to connect to the database: ' . $e->getMessage());
}

echo "Hello there!";

?>