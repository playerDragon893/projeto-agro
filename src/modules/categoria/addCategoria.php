<?php 
    
    include __DIR__ . '/../../shared/conexaodb.php';
    
    if(empty($_POST['nome'])){
        echo "nome invalido";
        exit;
    }
    
    
    
    $sql = "INSERT INTO categoria(nome, descricao) VALUES (:n, :d)";
    $stmt = $conexao->prepare($sql);
    $stmt->execute([
        ':n' => $_POST['nome'],
        ':d' => $_POST['descricao']
    ]);

    header("location: ../../../views/form/addCategoria.php ")
?>
