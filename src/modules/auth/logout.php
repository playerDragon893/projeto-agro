<?php
session_start();

include __DIR__ . "/../../shared/conexaodb.php";


// apaga token do banco
if(isset($_SESSION['id'])){

    $sql = "UPDATE usuarios 
            SET token_login = NULL 
            WHERE id = :id";

    $stmt = $conexao->prepare($sql);
    $stmt->execute([
        ":id" => $_SESSION['id']
    ]);
}


// apaga cookie
setcookie(
    "login_token",
    "",
    time() - 3600,
    "/"
);


// destrói sessão
session_unset();
session_destroy();


header("Location: ../../../views/home.php");
exit;
?>
