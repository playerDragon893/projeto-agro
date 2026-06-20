<?php
session_start();
include __DIR__ . '/../../shared/conexaodb.php';

$dadosRecebidos = json_decode(file_get_contents('php://input'), true);

$id_progresso_usuario = $dadosRecebidos['id_progresso_usuario'] ?? null;
$tipo_acao = $dadosRecebidos['tipo_acao'] ?? null;
$observacao = $dadosRecebidos['observacao'] ?? null;

$tiposPermitidos = ['rega', 'adubo', 'poda'];

if (!$id_progresso_usuario || !in_array($tipo_acao, $tiposPermitidos)) {
    header('Content-Type: application/json');
    echo json_encode(['erro' => 'Dados inválidos']);
    exit;
}

$sql = "INSERT INTO historico_registros (id_progresso_usuario, data_registro, tipo_acao, observacao) 
        VALUES (:id_progresso, NOW(), :tipo_acao, :observacao)";
$stmt = $conexao->prepare($sql);
$stmt->execute([
    ':id_progresso' => $id_progresso_usuario,
    ':tipo_acao' => $tipo_acao,
    ':observacao' => $observacao
]);

header('Content-Type: application/json');
echo json_encode(['mensagem' => 'Registro salvo com sucesso!']);
?>