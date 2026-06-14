<?php 
    include 'conexaodb.php';

    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $nome = $_POST['nome'];
        $preco = $_POST['preco'];

        $sqlComand = "INSERT INTO plantas(nome, preco) values (:n, :p)";
        $stmt = $conexao->prepare($sqlComand);
        $stmt->execute([
            ':n' => $nome,
            ':p' => $preco
        ]);
        echo "produto inserido" ;
    }

   
?>
   
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form method="POST">

        <label>Nome da planta</label>
        <input type="text" name="nome">

        <br><br>

        <label>Preço</label>    
        <input type="text" name="preco">
        
        <button type="submit">enviar</button>
    </form>
</body>
</html>