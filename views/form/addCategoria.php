<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
          <style>
        body{
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
        }

        form{
            max-width: 500px;
            margin: 50px auto;
            background: white;
            padding: 25px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }

        label{
            display: block;
            margin-top: 15px;
            font-weight: bold;
        }

        input{
            width: 100%;
            padding: 10px;
            margin-top: 5px;
            box-sizing: border-box;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        button{
            width: 100%;
            margin-top: 20px;
            padding: 12px;
            border: none;
            border-radius: 5px;
            background-color: #2e7d32;
            color: white;
            font-size: 16px;
            cursor: pointer;
        }

        button:hover{
            background-color: #256628;
        }

        #mensagem{
            max-width: 500px;
            margin: 15px auto;
            text-align: center;
            font-weight: bold;
        }
    </style>
    </style>


</head>

<body>
    <form method="POST" action="../../src/modules/categoria/addCategoria.php">
        <label>Nome da categoria</label>
        <input type="text" name="nome">

        <label>Descrição</label>
        <input type="text" name="descricao">

        <button type="submit">Cadastrar</button>

    </form>

<div id="mensagem"></div>
<button onclick="window.history.back()">← Voltar</button>
</body>
</html>