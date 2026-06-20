<?php 
    include __DIR__ . '/../../shared/conexaodb.php';
    $sql = "SELECT id, nome_comum, descricao FROM plantas";

    $stmt = $conexao->query($sql);

    $plantas = $stmt->fetchAll(PDO::FETCH_ASSOC);
           
    header('Content-Type: application/json');

    echo json_encode($plantas);
?>     
