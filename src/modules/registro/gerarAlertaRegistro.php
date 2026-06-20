<?php
session_start();
include __DIR__ . '/../../shared/conexaodb.php';

$id_user = $_SESSION['id'];

$sql = "SELECT progresso_usuario.id AS id_progresso,
               plantas.nome_comum,
               (SELECT MAX(hr.data_registro) 
                FROM historico_registros hr 
                WHERE hr.id_progresso_usuario = progresso_usuario.id 
                AND hr.tipo_acao = 'rega') AS ultima_rega,
               (SELECT MAX(hr.data_registro) 
                FROM historico_registros hr 
                WHERE hr.id_progresso_usuario = progresso_usuario.id 
                AND hr.tipo_acao = 'adubo') AS ultimo_adubo,
               (SELECT MAX(hr.data_registro) 
                FROM historico_registros hr 
                WHERE hr.id_progresso_usuario = progresso_usuario.id 
                AND hr.tipo_acao = 'poda') AS ultima_poda
        FROM progresso_usuario
        INNER JOIN plantas ON plantas.id = progresso_usuario.id_planta
        WHERE progresso_usuario.id_usuario = :id_user
        AND progresso_usuario.status = 'ativo'";

$stmt = $conexao->prepare($sql);
$stmt->execute([':id_user' => $id_user]);
$plantas = $stmt->fetchAll(PDO::FETCH_ASSOC);

$alertas = [];
$hoje = new DateTime();
$LIMITE_DIAS = 3;

$tipos = [
    'rega' => 'ultima_rega',
    'adubo' => 'ultimo_adubo',
    'poda' => 'ultima_poda'
];

foreach ($plantas as $planta) {
    foreach ($tipos as $tipoAcao => $coluna) {
        $ultimaData = $planta[$coluna];

        if ($ultimaData === null) {
            continue;
        }

        $dataRegistro = new DateTime($ultimaData);
        $diasSemAcao = $dataRegistro->diff($hoje)->days;

        if ($diasSemAcao > $LIMITE_DIAS) {
            $alertas[] = [
                'id_progresso' => $planta['id_progresso'],
                'nome_comum' => $planta['nome_comum'],
                'tipo_acao' => $tipoAcao,
                'dias_sem_acao' => $diasSemAcao
            ];
        }
    }
}

header('Content-Type: application/json');
echo json_encode($alertas);
?>