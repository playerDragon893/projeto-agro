<?php 
    session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <style>
        body{
    font-family: Arial, sans-serif;
    background-color: #f4f4f4;
    margin: 0;
    padding: 20px;
}

form{
    max-width: 900px;
    margin: auto;
    background: white;
    padding: 25px;
    border-radius: 10px;
    box-shadow: 0 0 10px rgba(0,0,0,0.1);
}

h3{
    color: #2e7d32;
    margin-top: 20px;
}

label{
    display: block;
    margin-top: 10px;
    font-weight: bold;
}

input,
textarea,
select{
    width: 100%;
    box-sizing: border-box;
    padding: 10px;
    margin-top: 5px;
    border: 1px solid #ccc;
    border-radius: 5px;
}

textarea{
    resize: vertical;
    min-height: 80px;
}

button{
    background-color: #2e7d32;
    color: white;
    border: none;
    padding: 12px 20px;
    border-radius: 5px;
    cursor: pointer;
    margin-top: 15px;
}

button:hover{
    background-color: #256628;
}

hr{
    margin: 25px 0;
    border: none;
    border-top: 1px solid #ddd;
}

span{
    display: block;
    margin-top: 5px;
    font-size: 14px;
}

#fase-planta-container{
    margin-top: 20px;
}

#fase-planta-container > div{
    margin-bottom: 10px;
}
    </style>
</head>
<body>
    <form method="POST" action="../../src/modules/plantas/addPlanta.php" enctype="multipart/form-data">
       
    <h2>DADOS DA PLANTA</h2>
    <label>Nome comum</label>
    <br>
    <input type="text" name="nome_comum" required>

    <?php if(isset($_SESSION['ERR']['nome_comum'])): ?>
        <span style="color:red">
            <?= $_SESSION['ERR']['nome_comum'] ?>
        </span>
    <?php endif; ?>

    <br>

    <label>Nome científico</label>
    <input type="text" name="nome_cientifico" required>

    <?php if(isset($_SESSION['ERR']['nome_cientifico'])): ?>
        <span style="color:red">
            <?= $_SESSION['ERR']['nome_cientifico'] ?>
        </span>
    <?php endif; ?>

    <br>

    <label>Descrição</label>
    <textarea name="descricao_planta" required></textarea>

    <?php if(isset($_SESSION['ERR']['descricao_planta'])): ?>
        <span style="color:red">
            <?= $_SESSION['ERR']['descricao_planta'] ?>
        </span>
    <?php endif; ?>

    <br>

    <label>Horas de sol</label>
    <input type="number" name="horas_sol_dia" required>

    <?php if(isset($_SESSION['ERR']['horas_sol_dia'])): ?>
        <span style="color:red">
            <?= $_SESSION['ERR']['horas_sol_dia'] ?>
        </span>
    <?php endif; ?>

    <br>

    <label>Tipo de solo</label>
    <input type="text" name="tipo_solo" required>

    <?php if(isset($_SESSION['ERR']['tipo_solo'])): ?>
        <span style="color:red">
            <?= $_SESSION['ERR']['tipo_solo'] ?>
        </span>
    <?php endif; ?>

    <br>

    <label>pH solo ideal</label>
    <input type="text" name="ph_solo_ideal" required>

    <?php if(isset($_SESSION['ERR']['ph_solo_ideal'])): ?>
        <span style="color:red">
            <?= $_SESSION['ERR']['ph_solo_ideal'] ?>
        </span>
    <?php endif; ?>

    <br>

    <label>Clima adequado</label>
    <input type="text" name="clima_adequado" required>

    <?php if(isset($_SESSION['ERR']['clima_adequado'])): ?>
        <span style="color:red">
            <?= $_SESSION['ERR']['clima_adequado'] ?>
        </span>
    <?php endif; ?>

    <br>

    <label>Temperatura mínima</label>
    <input type="number" name="temperatura_min" required>

    <?php if(isset($_SESSION['ERR']['temperatura_min'])): ?>
        <span style="color:red">
            <?= $_SESSION['ERR']['temperatura_min'] ?>
        </span>
    <?php endif; ?>

    <br>

    <label>Temperatura máxima</label>
    <input type="number" name="temperatura_max" required>

    <?php if(isset($_SESSION['ERR']['temperatura_max'])): ?>
        <span style="color:red">
            <?= $_SESSION['ERR']['temperatura_max'] ?>
        </span>
    <?php endif; ?>

    <br>

    <label>Umidade ideal</label>
    <input type="text" name="umidade_ideal" required>

    <?php if(isset($_SESSION['ERR']['umidade_ideal'])): ?>
        <span style="color:red">
            <?= $_SESSION['ERR']['umidade_ideal'] ?>
        </span>
    <?php endif; ?>

    <br>

    <label>Região ideal</label>
    <input type="text" name="regiao_ideal" required>

    <?php if(isset($_SESSION['ERR']['regiao_ideal'])): ?>
        <span style="color:red">
            <?= $_SESSION['ERR']['regiao_ideal'] ?>
        </span>
    <?php endif; ?>

    <br>

    <label>Tipo de adubo</label>
    <input type="text" name="tipo_adubo" required>

    <?php if(isset($_SESSION['ERR']['tipo_adubo'])): ?>
        <span style="color:red">
            <?= $_SESSION['ERR']['tipo_adubo'] ?>
        </span>
    <?php endif; ?>

    <br>

    <label>Frequência adubação</label>
    <input type="text" name="frequencia_adubacao" required>

    <?php if(isset($_SESSION['ERR']['frequencia_adubacao'])): ?>
        <span style="color:red">
            <?= $_SESSION['ERR']['frequencia_adubacao'] ?>
        </span>
    <?php endif; ?>

    <br>

    <label>Espaçamento cm</label>
    <input type="text" name="espacamento_cm" required>

    <?php if(isset($_SESSION['ERR']['espacamento_cm'])): ?>
        <span style="color:red">
            <?= $_SESSION['ERR']['espacamento_cm'] ?>
        </span>
    <?php endif; ?>

    <br>

    <label>Profundidade plantio cm</label>
    <input type="number" name="profundidade_plantio_cm" required>

    <?php if(isset($_SESSION['ERR']['profundidade_plantio_cm'])): ?>
        <span style="color:red">
            <?= $_SESSION['ERR']['profundidade_plantio_cm'] ?>
        </span>
    <?php endif; ?>

    <br>

    <label>Pragas comuns</label>
    <textarea name="pragas_comuns" required></textarea>

    <?php if(isset($_SESSION['ERR']['pragas_comuns'])): ?>
        <span style="color:red">
            <?= $_SESSION['ERR']['pragas_comuns'] ?>
        </span>
    <?php endif; ?>

    <br>

    <label>Doenças comuns</label>
    <textarea name="doencas_comuns" required></textarea>

    <?php if(isset($_SESSION['ERR']['doencas_comuns'])): ?>
        <span style="color:red">
            <?= $_SESSION['ERR']['doencas_comuns'] ?>
        </span>
    <?php endif; ?>

    <br>

    <label>Enviar imagem</label>
    <input type="url" name="imagem_url" required>


    <br>

    <label>Categoria</label>
    <select id="categoria-select" name="categoria" required></select>

    <?php if(isset($_SESSION['ERR']['categoria'])): ?>
        <span style="color:red">
            <?= $_SESSION['ERR']['categoria'] ?>
        </span>
    <?php endif; ?>


    <?php
    unset($_SESSION['ERR']);
    ?>



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
    fetch("../../src/modules/categoria/retornoCategoria.php")
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
            <input type="number" name="duracao_dias[]" required min="1">
        </div>

        <br><div>
            <label>Descrição:</label>
            <textarea name="descricao_fase[]" rows="3" required></textarea>
        </div>

        <br><div>
            <label>Água por dia (ml):</label>
            <input type="number" name="agua_ml_dia[]" min="0" required>
        </div>

        <br><div>
            <label>Frequência de Rega (em dias):</label>
            <input type="number" name="frequencia_rega_dias[]" min="0" required>
        </div>

        <br><div>
            <label>Dica de Cuidado:</label>
            <textarea name="dica_cuidado[]" rows="3" required></textarea>
        </div>


        <hr>
    `;

    cont++;
    } 
    

</script>
