<?php

include __DIR__ . '/../../shared/conexaodb.php';

$id = $_GET['id'];

$sqlPlanta = "SELECT * FROM plantas WHERE id = :id";

$stmt = $conexao->prepare($sqlPlanta);

$stmt->execute([
    ':id' => $id
]);

$planta = $stmt->fetch(PDO::FETCH_ASSOC);

//fases

$sqlFase  = "SELECT * FROM fase_planta WHERE id_planta = :id ORDER BY ordem";

$stmt = $conexao->prepare($sqlFase);

$stmt->execute([
    ':id' => $id
]);


$fases = $stmt->fetchAll(PDO::FETCH_ASSOC);


header('Content-Type: application/json');

echo json_encode([
    'planta' => $planta,
    'fases' => $fases
    ]
);
