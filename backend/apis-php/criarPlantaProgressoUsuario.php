<?php
include 'conexaodb.php';
session_start();
header('Content-Type: application/json');

if(!isset($_SESSION['id'])){
    echo json_encode([
        'sucesso' => false,
        'ERR' => 'usuario nao logado'
    ]);
    exit;
}
$id_usuario_logado = $_SESSION['id'];
$status = "ativo";
//dados da requisicao
$dados = json_decode(file_get_contents("php://input"), true);
$id_planta = $dados['id_planta'];
$data_inicio_cultivo = $dados['data_inicio_cultivo'];

//formatacao da data 
$data = DateTime::createFromFormat('Y-m-d', $data_inicio_cultivo);

if(!$data || $data->format('Y-m-d') !== $data_inicio_cultivo){
    echo json_encode([
        'sucesso' => false,
        'ERR' => 'data invalida'
    ]);
    exit;
}

if(!filter_var($id_planta, FILTER_VALIDATE_INT)){
    echo json_encode([
        'sucesso' => false,
        'ERR' => 'ID da planta inválido'
    ]);
    exit;
}

//validacao para verificar se usuario ja esta cuidando desta planta


$sql = "INSERT progresso_usuario(id_usuario, id_planta, data_inicio_cultivo,`status`)
        VALUES (:id_user, :id_plant, :data_plant, :s)";

$stmt = $conexao->prepare($sql);

$executou = $stmt->execute([
    ':id_user' => $id_usuario_logado,
    ':id_plant' => $id_planta,
    ':data_plant' => $data_inicio_cultivo,
    ':s' => $status
]);



if ($executou) {
    echo json_encode([
        'sucesso' => true,
        'mensagem' => 'Cultivo iniciado com sucesso!'
    ]);
} else {
    echo json_encode([
        'sucesso' => false,
        'ERR' => 'Erro ao salvar no banco de dados.'
    ]);
}
exit;


?>




