<?php
session_start();
if(!isset($_FILES["arquivo"]) || $_FILES["arquivo"]["error"] != 0){
    $_SESSION['ERR'] = "erro ao enviar arquivo";
    exit;
}


//variaveis da planta 

$nome_comum = $_POST["nome_comum"];
$nome_cientifico = $_POST["nome_cientifico"];
$descricao_planta = $_POST["descricao_planta"];

$horas_sol_dia = $_POST["horas_sol_dia"];

$tipo_solo = $_POST["tipo_solo"];
$ph_solo_ideal = $_POST["ph_solo_ideal"];
$clima_adequado = $_POST["clima_adequado"];

$temperatura_min = $_POST["temperatura_min"];
$temperatura_max = $_POST["temperatura_max"];

$umidade_ideal = $_POST["umidade_ideal"];
$regiao_ideal = $_POST["regiao_ideal"];

$tipo_adubo = $_POST["tipo_adubo"];
$frequencia_adubacao = $_POST["frequencia_adubacao"];

$espacamento_cm = $_POST["espacamento_cm"];
$profundidade_plantio_cm = $_POST["profundidade_plantio_cm"];

$pragas_comuns = $_POST["pragas_comuns"];
$doencas_comuns = $_POST["doencas_comuns"];

$categoria = $_POST["categoria"];

//variaveis de fase

$nome_fases = $_POST["nome_fase"] ?? [];
$duracoes = $_POST["duracao_days"] ?? [];
$descricoes = $_POST["descricao_fase"] ?? [];
$aguas = $_POST["agua_ml_dia"] ?? [];
$frequencias_rega = $_POST["frequencia_rega_dias"] ?? [];
$dicas = $_POST["dica_cuidado"] ?? [];






//envio do arquivo imagem

$arquivo = $_FILES["arquivo"];
$extensao = strtolower(pathinfo($arquivo['name'], PATHINFO_EXTENSION));
$caminho_upload_prefixo = __DIR__ . "/../../../public/assets/uploads/plantas/";
$caminho_salvoDb_prefiro = "assets/uploads/plantas/";
$nome_arquivo = uniqid('plantaIMG_', true) . '.' . $extensao;

//tamanho do arquivo 5 mb
$tamanho_maximo = 5 * 1024 * 1024; 
//extensoes que pode 
$extensoesPermitidas = ["jpg", "png", "jpeg"];
//caminhos finais
$caminho_final = $caminho_upload_prefixo . $nome_arquivo; //caminho da pasta para aonde vai o arquivo
$caminho_noBanco = $caminho_salvoDb_prefiro . $nome_arquivo; //caminho que vai ta inserido no banco no caso assets/blablabla/nomedoarquivo

if($arquivo["size"] > $tamanho_maximo){
    $_SESSION['ERR'] = "tamanho maximo ultrapassado";
    exit;
}
elseif(!in_array($extensao, $extensoesPermitidas)){
    $_SESSION['ERR'] = "extensao nao permitida";
    exit; 
}

if(move_uploaded_file($arquivo["tmp_name"], $caminho_final)){
    echo "arquivo movido";
}
else{
    echo "erro";
}

?>