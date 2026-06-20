<?php 
session_start();

if(isset($_SESSION['erros'])){
    $erros = $_SESSION['erros'];
}else{
    $erros = [];
}

unset($_SESSION['erros']);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Criar Conta — Plantou Colheu</title>

<link rel="stylesheet" href="../style.css">
</head>

<body>


<div class="pagina-form">

    <form 
        action="../../src/modules/auth/cadastro.php" 
        method="POST"
        class="form-card"
    >

        <div class="section-header">
            <h1 class="section-title">
                🌱 Criar conta
            </h1>

            <p class="section-subtitle">
                Entre para começar seu jardim
            </p>
        </div>


        <div class="campo">

            <label>Nome</label>

            <input 
                type="text" 
                name="nome"
                placeholder="Seu nome"
            >

            <?php if(!empty($erros['nomeERR'])): ?>
                <p class="erro">
                    <?= $erros['nomeERR'] ?>
                </p>
            <?php endif; ?>

        </div>



        <div class="campo">

            <label>Email</label>

            <input 
                type="email" 
                name="email"
                placeholder="email@email.com"
            >

            <?php if(!empty($erros['emailERR'])): ?>
                <p class="erro">
                    <?= $erros['emailERR'] ?>
                </p>
            <?php endif; ?>

        </div>



        <div class="campo">

            <label>Senha</label>

            <input 
                type="password" 
                name="senha"
                placeholder="Sua senha"
            >

            <?php if(!empty($erros['senhaERR'])): ?>
                <p class="erro">
                    <?= $erros['senhaERR'] ?>
                </p>
            <?php endif; ?>

        </div>



        <div class="campo">

            <label>Cidade</label>

            <input
                type="text"
                name="cidade"
                maxlength="100"
                placeholder="Sua cidade"
            >

        </div>



        <div class="campo">

            <label>Estado</label>


            <select name="estado">

                <option value="">
                    Selecione seu estado
                </option>

                <option>AC</option>
                <option>AL</option>
                <option>AP</option>
                <option>AM</option>
                <option>BA</option>
                <option>CE</option>
                <option>DF</option>
                <option>ES</option>
                <option>GO</option>
                <option>MA</option>
                <option>MT</option>
                <option>MS</option>
                <option>MG</option>
                <option>PA</option>
                <option>PB</option>
                <option>PR</option>
                <option>PE</option>
                <option>PI</option>
                <option>RJ</option>
                <option>RN</option>
                <option>RS</option>
                <option>RO</option>
                <option>RR</option>
                <option>SC</option>
                <option>SP</option>
                <option>SE</option>
                <option>TO</option>

            </select>

        </div>



        <div class="form-botoes">

            <button 
                class="btn btn-primary"
                type="submit"
            >
                Criar conta 🌱
            </button>


            <button 
                type="button"
                onclick="window.history.back()"
                class="btn btn-secondary"
            >
                ← Voltar
            </button>

        </div>


        <p class="form-link">
            Já possui conta?
            <a href="login.php">
                Entrar
            </a>
        </p>


    </form>

</div>


</body>
</html>