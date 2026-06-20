<?php
    session_start();
    include '../../shared/conexaodb.php'; 
    $id_user = $_SESSION['id'];



    $sql = "SELECT id_planta, `status` FROM progresso_usuario WHERE id_usuario = :id";
    $stmt = $conexao->prepare($sql);
    $stmt->execute([
        ':id' => $id_user
    ]);
    $dados_id_status = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $idPlanta = $dados_id_status['id_planta'];
    $status = $dados_id_status['status'];
    
    
    
    $sql = "SELECT nome_comum, imagem_url FROM plantas WHERE id = :id";
    $stmt = $conexao->prepare($sql);
    $stmt->execute([
        ':id' => $idPlanta
    ]);
    $dados_nome_imagem = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $nomePlanta = $dados_nome_imagem['nome_comum'];
    $imagem = $dados_nome_imagem['imagem_url'];

    $resposta = [
        $nomePlanta,
        $status,
        $imagem
    ];


    header('Content-Type: application/json ');
    echo json_encode($resposta);
?>