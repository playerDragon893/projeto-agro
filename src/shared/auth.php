<?php

session_start();

include "conexaodb.php";



if(isset($_SESSION['id'])){

    $sql = "SELECT id
            FROM admin 
            WHERE id_usuario = :id";

    $stmt = $conexao->prepare($sql);
    $stmt->execute([
        ":id" => $_SESSION['id']
    ]);

    $_SESSION['admin'] = $stmt->fetch() ? true : false;

    return;
}




if(isset($_COOKIE['login_token'])){


    $sql = "SELECT usuarios.id, usuarios.nome, usuarios.email
            FROM usuarios
            WHERE token_login = :token";

    $stmt = $conexao->prepare($sql);

    $stmt->execute([
        ":token" => $_COOKIE['login_token']
    ]);


    $usuario = $stmt->fetch(PDO::FETCH_ASSOC);



    if($usuario){

        $_SESSION['id'] = $usuario['id'];
        $_SESSION['nome'] = $usuario['nome'];
        $_SESSION['email'] = $usuario['email'];



        $sql = "SELECT id
                FROM admin
                WHERE id_usuario = :id";


        $stmt = $conexao->prepare($sql);
        $stmt->execute([
            ":id" => $usuario['id']
        ]);


        $_SESSION['admin'] = $stmt->fetch() ? true : false;

    }

}

?>