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

<title>Login — Plantou Colheu</title>

<link rel="stylesheet" href="../style.css">

</head>


<body>


<div class="pagina-form">


<form 
    method="POST" 
    action="../../src/modules/auth/login.php"
    class="form-card"
>


<div class="section-header">

    <h1 class="section-title">
        🌱 Bem-vindo de volta
    </h1>

    <p class="section-subtitle">
        Entre para cuidar do seu jardim
    </p>

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

<label class="checkbox">

<input 
    type="checkbox"
    name="manter"
>

Lembrar de mim

</label>

</div>





<div class="form-botoes">


<button 
    type="submit"
    class="btn btn-primary"
>
    Entrar 🌿
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

Ainda não possui conta?

<a href="cadastro.php">
Cadastrar
</a>


</p>



</form>


</div>


</body>
</html>