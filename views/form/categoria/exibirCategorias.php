<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    


    <h1>Lista de Categorias</h1>
    <table border="1">
        <thead>
            <tr>
                <th>Nome</th>
                <th>Descrição</th>
                <th></th>
                <th></th>         
            </tr>

        </thead>
        <tbody id="tabelaCategorias">
            <!-- As categorias serão inseridas aqui via JavaScript -->
        </tbody>
    </table>


    <form method = "post">
    <fieldset>
        <label>Nome da categoria</label>
        <input type="text" name="nome">
        <button>editar</button><br>
        <label>Descrição</label>
        <input type="text" name="descricao">
        <button>editar</button><br><br>
        <button type="submit">salvar</button><br><br>
        <button>sair</button>
    </fieldset>
    </form>

</body>
</html>


<script>
   function exibirCategorias(){
   fetch('../../../src/modules/categoria/selectCategoria.php')
        .then(response => response.json())
        .then(dados => {
            dados.forEach(categoria => {
                const tabela = document.getElementById("tabelaCategorias");
                tabela.innerHTML += `
                    <tr>
                        <td>${categoria.nome}</td>
                        <td>${categoria.descricao}</td>
                        <td><button>editar</button></td>
                        <td><button>deletar</button></td>
                    </tr>
                `;
            });
        });
   }
    window.onload = exibirCategorias;

    async function editarForm(){
        try{
            const resposta = await fetch(
                "../../../src/modules/categoria/selectCategoria.php"
                {
                    method: "POST",
                    headers: {
                        "Content-type": "application/json";
                    }
                }
            )
        }
    }
</script>