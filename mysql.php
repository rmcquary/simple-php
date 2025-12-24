<?php

function testConnection()
{
    // Replace with your actual values
    $db_host = '127.0.0.1'; // Use localhost if connecting via Cloud SQL Auth Proxy
    $db_user = 'app-server@nweb-development.iam.gserviceaccount.com'; // Full IAM email address
    $db_pass = ''; // Leave password empty when using auto IAM auth with the proxy
    $db_name = 'drupal';
    $db_port = '3306'; // Default port for MySQL

    try {
        $pdo = new PDO(
            "mysql:host=$db_host;port=$db_port;dbname=$db_name;charset=utf8mb4",
            $db_user,
            $db_pass
        );
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        echo "Connection successful using IAM authentication!";

        // Example query
        $stmt = $pdo->query('SELECT 1 + 1 AS result, now() as datetime_now');
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        echo "\nResult of 1+1: " . $result['result'] . " - " . $result['datetime_now'];

    } catch (PDOException $e) {
        die("Connection failed: " . $e->getMessage());
    }

}

?>
