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
    <form action="../../backend/apis-php/auth/cadastro.php" method="POST">

        <div>
            <label for="nome">Nome</label>
            
            <input type="text" name="nome">
            <?php if(!empty($erros['nomeERR'])): ?>
                <p style="color:red;">
                    <?= $erros['nomeERR'] ?>
                </p>
            <?php endif; ?>
        
        
        </div>
    
        <div>
            <label for="email">Email</label>
            
            <input type="email" name="email">
            <?php if(!empty($erros['emailERR'])): ?>
                <p style="color:red;">
                    <?= $erros['emailERR'] ?>
                </p>
            <?php endif; ?>
        
        
        </div>
    
        <div>
            <label for="senha">Senha</label>
            
            <input type="password" name="senha">
            <?php if(!empty($erros['senhaERR'])): ?>
                <p style="color:red;">
                    <?= $erros['senhaERR'] ?>
                </p>
            <?php endif; ?>
        </div>
    
        <div>
            <label for="cidade">Cidade</label>
            <input
                type="text"
                id="cidade"
                name="cidade"
                maxlength="100"
            >
        </div>
    
        <div>
            <label for="estado">Estado</label>
            <select id="estado" name="estado">
                <option value="">Selecione</option>
    
                <option value="AC">AC</option>
                <option value="AL">AL</option>
                <option value="AP">AP</option>
                <option value="AM">AM</option>
                <option value="BA">BA</option>
                <option value="CE">CE</option>
                <option value="DF">DF</option>
                <option value="ES">ES</option>
                <option value="GO">GO</option>
                <option value="MA">MA</option>
                <option value="MT">MT</option>
                <option value="MS">MS</option>
                <option value="MG">MG</option>
                <option value="PA">PA</option>
                <option value="PB">PB</option>
                <option value="PR">PR</option>
                <option value="PE">PE</option>
                <option value="PI">PI</option>
                <option value="RJ">RJ</option>
                <option value="RN">RN</option>
                <option value="RS">RS</option>
                <option value="RO">RO</option>
                <option value="RR">RR</option>
                <option value="SC">SC</option>
                <option value="SP">SP</option>
                <option value="SE">SE</option>
                <option value="TO">TO</option>
            </select>
        </div>
    
        <button type="submit">
            Cadastrar
        </button>
        
            <a href="./home.php">Voltar</a>
            <a href="./login-form.php">Login</a>
       
    
    </form>
</body>
</html>