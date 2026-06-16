<?php 
   
    session_start();

    function test_input($data){
        $data = trim($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    include '../conexaodb.php';
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        $nomeERR = "";
        $senhaERR = "";
        $emailERR = "";
         
        //validar nome
        if(empty($_POST['nome'])){
            $nomeERR = "nome obrigatorio";
        }
        else{
            $nome = test_input($_POST['nome']);    
            if(!preg_match("/^[a-zA-ZÀ-ÿ ]+$/", $nome)){
                $nomeERR = "Nome inválido";
            }
        }
        //validar email
        if(empty($_POST['email'])){
            $emailERR = "email obrigatorio";
        }
        else{
            $email = test_input($_POST['email']);
            if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
                $emailERR = "email invalido";
            }
        }
        //validar senha
        if(empty($_POST['senha'])){
            $senhaERR = "senha obrigatoria";
        }
        else{
            $senha = $_POST['senha'];
            if(strlen($senha) < 8){
                $senhaERR = "senha muito pequena";
            }
            elseif (!preg_match("/[a-zA-Z]/", $senha)) {
            $senhaERR = "a senha precisa conter letras";
            }
            else{
                $senhaHash = password_hash($senha, PASSWORD_DEFAULT);
            }
        }
        
        
        if(!empty($nomeERR) || !empty($emailERR) || !empty($senhaERR)){
           
            $_SESSION['erros'] = [
                "nomeERR" => $nomeERR,
                "emailERR" => $emailERR,
                "senhaERR" => $senhaERR
            ];
            header("Location: /frontend/html/cadastro-form.php");
            exit;
        }



        //cidade nao precisa de validacao pois o pdo ja protege de sql injection gracas ao :variavel
        $cidade = $_POST['cidade']; 
        //estado e uma caixa de selecao entao nao precisa validar
        $estado = $_POST['estado'];
        
        
        
        //sqlvalidao se usuario existe
        
        
        $sql = "SELECT email FROM usuarios where email = :e";
        $stmt = $conexao->prepare($sql);
        $stmt->execute([
            ':e' => $email
        ]);
        $usuario = $stmt->fetch(PDO::FETCH_ASSOC);


        if($usuario){
            echo("email ja cadastro");
            exit;
        }
        
        //sql insert no banco de dados se tudo ok
        $sql = "INSERT INTO usuarios(nome, email, senha_hash, cidade, estado)
        VALUES (:n, :e, :s, :c, :es)";

        $stmt = $conexao->prepare($sql);
        $stmt->execute([
            ':n' => $nome,
            ':e' => $email,
            ':s' => $senhaHash,
            ':c' => $cidade,
            ':es' => $estado
        ]);

        //dados do usuario indo para session, id, nome e email
        $idUsuario = $conexao->lastInsertId();

        session_regenerate_id(true);

        $_SESSION['id'] = $idUsuario;
        $_SESSION['nome'] = $nome;
        $_SESSION['email'] = $email;
        
        if(headers_sent($file, $line)){
            die("Header quebrado em: $file linha $line");
        }
        header("Location: /frontend/html/home.php");
        exit;
    
    }

?>