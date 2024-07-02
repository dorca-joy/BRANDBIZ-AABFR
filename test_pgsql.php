<?php
$host = 'localhost';
$port = '5432';
$dbname = 'Brandbiz';  // Replace with your actual database name
$user = 'postgres';         // Replace with your actual PostgreSQL username
$password = 'justaqua32011904';     // Replace with your actual PostgreSQL password

$dsn = "pgsql:host=$host;port=$port;dbname=$dbname;user=$user;password=$password";

try {
    $pdo = new PDO($dsn);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    echo "Connected to the $dbname database successfully!";
} catch (PDOException $e) {
    echo $e->getMessage();
}
?>