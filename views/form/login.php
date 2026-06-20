<?php 
    session_start();

    if(isset($_SESSION['erros'])){
        $erros = $_SESSION['erros'];
    }
    else{
        $_SESSION['erros'] = [];
    }

    unset($_SESSION['erros']);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form method="POST" action="../../src/modules/auth/login.php" enctype="multipart/form-data">
        <div>
            <label>Email</label>
            <input type="email" name="email">
                <?php if(!empty($erros['emailERR'])): ?>
                    <p style="color:red;">
                        <?= $erros['emailERR'] ?>
                    </p>
                <?php endif; ?>
        </div>
        
        <div>    
            <label>Senha</label>
            <input type="password" name="senha">
                <?php if(!empty($erros['senhaERR'])): ?>
                    <p style="color:red;">
                        <?= $erros['senhaERR'] ?>
                    </p>
                <?php endif; ?>
        </div>
        
        <div>
            <label>
                <input type="checkbox" name="manter">
                Lembrar de mim
            </label>
        </div>

        <button type="submit">Entrar</button>
         <button onclick="window.history.back()">← Voltar</button>
         <a href="cadastro.php">cadastrar</a>
    </form>
</body>
</html>