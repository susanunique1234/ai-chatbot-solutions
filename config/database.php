<?php

$host = "localhost";
$port = "5432";
$dbname = "ai_solutions";
$user = "postgres";
$password = "susan123";

try {

    $conn = new PDO(
        "pgsql:host=$host;port=$port;dbname=$dbname",
        $user,
        $password
    );

    $conn->setAttribute(
        PDO::ATTR_ERRMODE,
        PDO::ERRMODE_EXCEPTION
    );

} catch(PDOException $e){

    die("Database Connection Failed : " . $e->getMessage());

}

?>