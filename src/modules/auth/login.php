<?php
session_start();
include __DIR__ . '/../../shared/conexaodb.php';
if($_SERVER["REQUEST_METHOD"] == "POST"){
    $user_email_ERR = "";
    $user_senha_ERR = "";
    
    $user_email = $_POST['email'];
    $user_senha = $_POST['senha'];

    $sql = "SELECT email, senha_hash, nome, id FROM usuarios WHERE email = :e";
    $stmt = $conexao->prepare($sql);
    $stmt->execute([
        ":e" =>$user_email
    ]);
    $userdb = $stmt->fetch(PDO::FETCH_ASSOC);
    
    if(!$userdb){
        $user_email_ERR = "email nao encontrado";
    }
    else{
        $senha_db = $userdb['senha_hash'];
        if(!password_verify($user_senha, $senha_db)){
            $user_senha_ERR = "senha incorreta";
        }
    }
    //auth password
    

    if(!empty($user_email_ERR) || !empty($user_senha_ERR)){
        $_SESSION['erros'] = [
            'emailERR' => $user_email_ERR,
            'senhaERR' => $user_senha_ERR
        ];
        header("Location: /views/login-form.php");
        exit;
    }
    
        session_regenerate_id(true);
        $_SESSION['id'] = $userdb['id'];
        $_SESSION['nome'] = $userdb['nome'];
        $_SESSION['email'] = $userdb['email'];
        
        header("Location: ../../../views/home.php");
        exit;
}
?>
