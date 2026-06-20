<?php 
    include '../../shared/conexaodb.php';
    
    $sql = "SELECT nome FROM categoria";
    
    $stmt = $conexao->query($sql);

    $categorias_resultado = $stmt->fetchAll(PDO::FETCH_ASSOC);

    echo json_encode($categorias_resultado);


?>