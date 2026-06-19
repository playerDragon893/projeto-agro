<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form method="POST" action="../../backend/apis-php/addDb/addPlantaDb.php" enctype="multipart/form-data">
       <label>Nome comum</label>
    <br>
    <input type="text" name="nome_comum" required>

    <br>
    <label>Nome científico</label>
    <input type="text" name="nome_cientifico" required>

    <br>
    <label>Descrição</label>
    <textarea name="descricao_planta"></textarea>

    <br>
    <label>Horas de sol</label>
    <input type="number" name="horas_sol_dia">

    <br>
    <label>Tipo de solo</label>
    <input type="text" name="tipo_solo">

    <br>
    <label>pH solo ideal</label>
    <input type="text" name="ph_solo_ideal">

    <br>
    <label>Clima adequado</label>
    <input type="text" name="clima_adequado">

    <br>
    <label>Temperatura mínima</label>
    <input type="number" name="temperatura_min">

    <br>
    <label>Temperatura máxima</label>
    <input type="number" name="temperatura_max">

    <br>
    <label>Umidade ideal</label>
    <input type="text" name="umidade_ideal">

    <br>
    <label>Região ideal</label>
    <input type="text" name="regiao_ideal">

    <br>
    <label>Tipo de adubo</label>
    <input type="text" name="tipo_adubo">

    <br>
    <label>Frequência adubação</label>
    <input type="text" name="frequencia_adubacao">

    <br>
    <label>Espaçamento cm</label>
    <input type="text" name="espacamento_cm">

    <br>
    <label>Profundidade plantio cm</label>
    <input type="number" name="profundidade_plantio_cm">

    <br>
    <label>Pragas comuns</label>
    <textarea name="pragas_comuns"></textarea>

    <br>
    <label>Doenças comuns</label>
    <textarea name="doencas_comuns"></textarea>

    <br>
    <label>enviar imagem</label>
    <input type="file" name="arquivo">


    <br>
    <label>Categoria</label>
    <select id="categoria-select" name="categoria"></select>



    <hr>

    <br><br><h3>Fases da planta</h3>

    


    <br>

   
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
        <h3>Ordem: ${cont}</h3><br>

        <br><div>
            <label>Nome da Fase:</label>
            <input type="text" name="nome_fase[]" required maxlength="25">
        </div>

        <br><div>
            <label>Duração (em dias):</label>
            <input type="number" name="duracao_days[]" required min="1">
        </div>

        <br><div>
            <label>Descrição:</label>
            <textarea name="descricao_fase[]" rows="3"></textarea>
        </div>

        <br><div>
            <label>Água por dia (ml):</label>
            <input type="number" name="agua_ml_dia[]" min="0">
        </div>

        <br><div>
            <label>Frequência de Rega (em dias):</label>
            <input type="number" name="frequencia_rega_dias[]" min="0">
        </div>

        <br><div>
            <label>Dica de Cuidado:</label>
            <textarea name="dica_cuidado[]" rows="3"></textarea>
        </div>


        <hr>
    `;

    cont++;
    } 
    

</script>