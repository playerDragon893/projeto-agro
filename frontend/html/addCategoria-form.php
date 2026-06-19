<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form method="POST" action="../../backend/apis-php/addDb/addCategoriaDb.php">
        <label>Nome da categoria</label>
        <input type="text" name="nome">

        <label>Descrição</label>
        <input type="text" name="descricao">

        <button type="submit">Cadastrar</button>

    </form>

<div id="mensagem"></div>
</body>
</html>