<?php

$logado = isset($_SESSION['id']);
$isAdmin = !empty($_SESSION['admin']);
$nomeUsuario = $_SESSION['nome'] ?? '';
?>

<nav id="navbar">
    <div class="nav-container">

        <a href="/src/views/home.php" class="nav-logo">plantou-colheu</a>

        <button id="btn-hamburguer" aria-label="Abrir menu">
            <span></span>
            <span></span>
            <span></span>
        </button>

        <ul class="nav-links">
            <li><a href="home.php">Home</a></li>
            <li><a href="jardim.php">Jardim</a></li>
            <?php if ($isAdmin): ?>
                <li><a href="form/addCategoria.php">Criar categoria</a></li>
                <li><a href="form/addPlanta.php">Criar planta</a></li>
            <?php endif; ?>
        </ul>

        <div class="nav-usuario">
            <?php if (!$logado): ?>
                <div id="nav-nao-logado">
                    <a href="form/login.php">Entrar</a>
                    <a href="form/cadastro.php">Cadastrar</a>
                </div>
            <?php else: ?>
                <div id="nav-logado">
                    <div class="nav-dropdown">
                        <button id="btn-dropdown">
                            <span class="nav-avatar"><?= htmlspecialchars(strtoupper(substr($nomeUsuario, 0, 1))) ?></span>
                            <span><?= htmlspecialchars($nomeUsuario) ?></span>
                        </button>
                        <ul id="dropdown-menu">
                            <li><a href="../src/modules/auth/logout.php">Sair</a></li>
                        </ul>
                    </div>
                </div>
            <?php endif; ?>
        </div>

    </div>
</nav>
