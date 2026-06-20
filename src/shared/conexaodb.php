<?php
$host     = getenv('MYSQLHOST');
$port     = getenv('MYSQLPORT');
$dbname   = getenv('MYSQLDATABASE');
$username = getenv('MYSQLUSER');
$password = getenv('MYSQLPASSWORD');

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "plantadb";

try {
    $conexao = new PDO("mysql:host=$host;port=$port;dbname=$dbname", $username, $password);
    $conexao = new PDO(
        "mysql:host=$servername;dbname=$dbname",
        $username,
        $password
    );

    $conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}
?>
    die("Erro na conexão: " . $e->getMessage());
}
