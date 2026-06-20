<?php
    session_start();
    include __DIR__ . '/../../shared/conexaodb.php';
    $id_user = $_SESSION['id'];



    $sql = "SELECT progresso_usuario.id AS id_progresso, plantas.nome_comum, plantas.imagem_url, progresso_usuario.status FROM progresso_usuario 
    INNER JOIN plantas ON plantas.id = progresso_usuario.id_planta
    WHERE id_usuario = :id";
    $stmt = $conexao->prepare($sql);
    $stmt->execute([
        ':id' => $id_user
    ]);
    $dados = $stmt->fetchAll(PDO::FETCH_ASSOC);
   
    header('Content-Type: application/json ');
    echo json_encode($dados);
?>
