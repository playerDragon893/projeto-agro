<?php
session_start();
include '../conexaodb.php';
if($_SERVER["REQUEST_METHOD"] == "POST"){
    $email = $_POST['email'];
    $nome = "";
    $senha = $_POST['senha'];

    $sql = "SELECT email FROM usuarios WHERE email = :e";
    $stmt->


}





?>