<?php
session_start();
include __DIR__ . '/../../shared/conexaodb.php';

$id_progresso = $_GET['id'];

$sql = "SELECT tipo_acao FROM historico_registros 
        WHERE id_progresso_usuario = :id_progresso 
        AND DATE(data_registro) = CURDATE()
        AND tipo_acao != 'observacao'";
$stmt = $conexao->prepare($sql);
$stmt->execute([':id_progresso' => $id_progresso]);
$registrosHoje = $stmt->fetchAll(PDO::FETCH_COLUMN);

header('Content-Type: application/json');
echo json_encode($registrosHoje);
?>