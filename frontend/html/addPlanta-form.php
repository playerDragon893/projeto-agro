<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form method="POST" action="../../backend/apis-php/addDb/addPlantaDb.php">
        <label>Nome da planta</label>
        <input type="text" name="nome">



        <select id="categoria-select" name="categoria">
        </select>

       <button type="button" onclick="criarfase()">Adicionar fase</button>

        //fases da planta
        <h3>planta fases</h3>
        <div id="fase-planta-container"></div> 
        
        
        
        
        
        <button type="submit">Cadastrar</button>
        
    </form>

</body>
</html>


<script>
    fetch("../../backend/apis-php/retornoCategoria.php")
        .then(response => response.json())
        .then(categorias => {
            
     
        
        const opcao_categoria = document.getElementById("categoria-select");
            
            categorias.forEach(categoria_element => {
                opcao_categoria.innerHTML += `
                    <option value="${categoria_element.nome}">
                    ${categoria_element.nome}</option>
                `
            });
        } );
       
    let cont = 1;
    function criarfase(){
    
    const fasePlanta = document.getElementById("fase-planta-container");
    fasePlanta.innerHTML += `
        <h3>ordem:${cont}</h3>
        <label>Nome da fase</label>
        <input type="text" name="nome">
    `


    cont++;
    } 
    

</script>