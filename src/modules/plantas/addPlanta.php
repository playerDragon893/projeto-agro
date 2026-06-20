<?php
session_start();
include_once __DIR__ . '/../../shared/conexaodb.php';

if(!isset($_FILES["arquivo"]) || $_FILES["arquivo"]["error"] != 0){
    $_SESSION['ERR'] = "erro ao enviar arquivo";
    exit;
}

//verificar variaveis

$camposnumericos = [
    'horas_sol_dia',
    'temperatura_min',
    'temperatura_max',
    'profundidade_plantio_cm'
];




//variaveis da planta 

$nome_comum = $_POST["nome_comum"]; //string
$nome_cientifico = $_POST["nome_cientifico"]; //string
$descricao_planta = $_POST["descricao_planta"]; //string

$horas_sol_dia = $_POST["horas_sol_dia"];

$tipo_solo = $_POST["tipo_solo"]; //string
$ph_solo_ideal = $_POST["ph_solo_ideal"]; //string
$clima_adequado = $_POST["clima_adequado"]; //string

$temperatura_min = $_POST["temperatura_min"]; //string
$temperatura_max = $_POST["temperatura_max"]; //string

$umidade_ideal = $_POST["umidade_ideal"]; //string
$regiao_ideal = $_POST["regiao_ideal"]; //string

$tipo_adubo = $_POST["tipo_adubo"];
$frequencia_adubacao = $_POST["frequencia_adubacao"]; //string

$espacamento_cm = $_POST["espacamento_cm"]; //string
$profundidade_plantio_cm = $_POST["profundidade_plantio_cm"];

$pragas_comuns = $_POST["pragas_comuns"]; //string
$doencas_comuns = $_POST["doencas_comuns"]; //string

$categoria = $_POST["categoria"]; //string //n precisa validacao pois e select

//variaveis de fase

$nome_fases = $_POST["nome_fase"] ?? [];
$duracoes = $_POST["duracao_days"] ?? [];
$descricoes = $_POST["descricao_fase"] ?? [];
$aguas = $_POST["agua_ml_dia"] ?? [];
$frequencias_rega = $_POST["frequencia_rega_dias"] ?? [];
$dicas = $_POST["dica_cuidado"] ?? [];

//envio do arquivo imagem


$imagem_url = $_POST["imagem_url"];












//sql

var_dump($_POST);

$sqlCategoria = "SELECT id FROM categoria WHERE nome = :nomecategoria";
$stmtCategoria = $conexao->prepare($sqlCategoria);
$stmtCategoria->execute([
    ':nomecategoria' => $categoria
]);

$id_categoria = $stmtCategoria->fetchColumn();


$sql = "INSERT INTO plantas (nome_comum, nome_cientifico, descricao, horas_sol_dia, tipo_solo, ph_solo_ideal, clima_adequado, temperatura_min, 
temperatura_max, umidade_ideal, regiao_ideal, tipo_adubo, frequencia_adubacao, espacamento_cm, profundidade_plantio_cm, pragas_comuns, doencas_comuns, 
id_categoria, imagem_url) 
VALUES (:nome_comum, :nome_cientifico, :descricao_planta, :horas_sol_dia, :tipo_solo, :ph_solo_ideal, :clima_adequado, 
:temperatura_min, :temperatura_max, :umidade_ideal, :regiao_ideal, :tipo_adubo, :frequencia_adubacao, 
:espacamento_cm, :profundidade_plantio_cm, :pragas_comuns, :doencas_comuns, :categoria, :caminho_noBanco)";

$stmt = $conexao->prepare($sql);
$stmt->execute([
    ':nome_comum' => $nome_comum,
    ':nome_cientifico' => $nome_cientifico,
    ':descricao_planta' => $descricao_planta,
    ':horas_sol_dia' => $horas_sol_dia,
    ':tipo_solo' => $tipo_solo,
    ':ph_solo_ideal' => $ph_solo_ideal,
    ':clima_adequado' => $clima_adequado,
    ':temperatura_min' => $temperatura_min,
    ':temperatura_max' => $temperatura_max,
    ':umidade_ideal' => $umidade_ideal,
    ':regiao_ideal' => $regiao_ideal,
    ':tipo_adubo' => $tipo_adubo,
    ':frequencia_adubacao' => $frequencia_adubacao,
    ':espacamento_cm' => $espacamento_cm,
    ':profundidade_plantio_cm' => $profundidade_plantio_cm,
    ':pragas_comuns' => $pragas_comuns,
    ':doencas_comuns' => $doencas_comuns,
    ':categoria' => $id_categoria,
    ':caminho_noBanco' => $imagem_url
]);

//fase
$id_planta = $conexao->lastInsertId();
$fases = [];
if(isset($_POST['nome_fase'])){
    foreach($_POST['nome_fase'] as $i => $nomeFase){
        $fases[] = [
            'nome_fase' => $nomeFase,
            'duracao_dias' => $_POST['duracao_dias'][$i],
            'descricao_fase' => $_POST['descricao_fase'][$i],
            'agua_ml_dia' => $_POST['agua_ml_dia'][$i],
            'frequencia_rega_dias' => $_POST['frequencia_rega_dias'][$i],
            'dica_cuidado' => $_POST['dica_cuidado'][$i]
        ];
    }
}

$sqlFase = "INSERT INTO fase_planta(ordem, nome_fase, descricao, duracao_dias, agua_ml_dia, 
frequencia_rega_dias, dica_cuidado, id_planta) VALUES (:ordem, :nome, :descricao,
:dias, :agua, :rega, :dica, :id)";
$stmtFase = $conexao->prepare($sqlFase);

foreach ($fases as $ordem => $faseatributo) {
   $stmtFase->execute([
    ':ordem' => $ordem + 1,
    ':nome' => $faseatributo['nome_fase'],
    ':descricao' => $faseatributo['descricao_fase'],
    ':dias' => $faseatributo['duracao_dias'],
    ':agua' => $faseatributo['agua_ml_dia'],
    ':rega' => $faseatributo['frequencia_rega_dias'],
    ':dica' => $faseatributo['dica_cuidado'],
    ':id' => $id_planta
    ]);
}

echo "foii"




?>
