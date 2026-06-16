<?php 
  session_start();  
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <nav id="navbar">

  <a href="home.html" class="nav-logo">
    AgroWiki
  </a>

  <ul class="nav-links">
    <li><a href="home.php">Home</a></li>
    <li><a href="home.php#catalogo">Catálogo</a></li>
  </ul>

  <div class="nav-usuario">

    <!-- estado: NÃO LOGADO -->
    <?php 
    if(!isset($_SESSION['id'])):?>
    
    <div id="nav-nao-logado">
      <a href="login-form.php">Entrar</a>
      <a href="cadastro-form.php">Cadastrar</a>
    
    </div>
    
    <?php else: ?>
    
      <!-- estado: LOGADO -->
    <div id="nav-logado">
      <a href="usuario-progresso.html">Meu Jardim</a>
      <div class="nav-dropdown">
        <button id="btn-dropdown">
          <span class="nav-avatar "><?php echo strtoupper($_SESSION['nome'][0]) ?></span> <!-- inicial do nome -->
          <span class="nav-nome"><?php echo $_SESSION['nome'] ?></span> <!-- nome do usuário -->
        </button>
        <ul id="dropdown-menu">
          <li><a href="logout.php">Sair</a></li>
        </ul>
      </div>
    </div>
    
    <?php endif; ?>

  </div>

</nav>
    

    <h1>catalogo</h1>
    <script src="../js/main.js"></script>
</body>
</html>