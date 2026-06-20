<?php
session_start();
include __DIR__ . '/../../shared/conexaodb.php';

$id_progresso = $_GET['id'];

// Busca dados da planta e progresso
$sql = "SELECT progresso_usuario.id AS id_progresso,
               progresso_usuario.status,
               progresso_usuario.data_inicio_cultivo,
               plantas.id AS id_planta,
               plantas.nome_comum,
               plantas.nome_cientifico,
               plantas.descricao
        FROM progresso_usuario
        INNER JOIN plantas ON plantas.id = progresso_usuario.id_planta
        WHERE progresso_usuario.id = :id_progresso";
$stmt = $conexao->prepare($sql);
$stmt->execute([':id_progresso' => $id_progresso]);
$planta = $stmt->fetch(PDO::FETCH_ASSOC);


// Busca todas as fases da planta em ordem
$sqlFases = "SELECT ordem, nome_fase, descricao, duracao_dias, agua_ml_dia, 
                    frequencia_rega_dias, dica_cuidado
             FROM fase_planta
             WHERE id_planta = :id_planta
             ORDER BY ordem ASC";
$stmtFases = $conexao->prepare($sqlFases);
$stmtFases->execute([':id_planta' => $planta['id_planta']]);
$fases = $stmtFases->fetchAll(PDO::FETCH_ASSOC);


$dataInicio = new DateTime($planta['data_inicio_cultivo']);
$hoje = new DateTime();
$diasPassados = $dataInicio->diff($hoje)->days;

// Percorre as fases somando duracao_dias até achar a fase atual
$diasAcumulados = 0;
$faseAtual = null;

foreach ($fases as $fase) {
    $diasAcumulados += (int) $fase['duracao_dias'];
    if ($diasPassados < $diasAcumulados) {
        $faseAtual = $fase;
        break;
    }
}

// Se passou de todas as fases, considera a última como atual (planta madura/completa)
if (!$faseAtual && count($fases) > 0) {
    $faseAtual = end($fases);
}

$resposta = [
    'planta' => $planta,
    'dias_passados' => $diasPassados,
    'fase_atual' => $faseAtual
];

header('Content-Type: application/json');
echo json_encode($resposta);
?>