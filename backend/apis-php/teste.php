<?php

require_once 'conexaodb.php';

$conexao = getConectDb();

if ($conexao) {
    echo "Conexão realizada com sucesso!";
} else {
    echo "Falha na conexão.";
}