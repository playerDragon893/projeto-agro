<?php
$host = "localhost";
$port = "3306";
$dbname = "plantadb"; // Altere para o nome do seu banco
$username = "root";
$password = "";

try {
    $conexao = new PDO(
        "mysql:host=$host;port=$port;dbname=$dbname;charset=utf8mb4",
        $username,
        $password
    );

    $conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Erro na conexão: " . $e->getMessage());
}
?>