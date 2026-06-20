<?php

include __DIR__ . '/../src/shared/auth.php';
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Plantou Colheu — Catálogo e Jardim</title>
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Fraunces:ital,opsz,wght@0,9..144,300;0,9..144,400;0,9..144,600;0,9..144,700;0,9..144,800;1,9..144,400&family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    
    <link rel="stylesheet" href="style.css">
</head>

<body>

    <!-- Elementos decorativos de fundo -->
    <div class="bg-decoration">
        <div class="bg-blob bg-blob-1"></div>
        <div class="bg-blob bg-blob-2"></div>
        <div class="bg-blob bg-blob-3"></div>
    </div>

    <?php include __DIR__ . '/../src/shared/menu.php'; ?>

    <section class="hero">
        <div class="hero-content">
            <span class="hero-badge">🌿 Enciclopédia verde</span>
            <h1 class="hero-title">Descubra, cultive e <span class="hero-highlight">acompanhe</span> suas plantas</h1>
            <p class="hero-subtitle">
                Catálogo completo de plantas, previsão do tempo em tempo real
                e ferramentas para acompanhar o cultivo do seu jardim.
            </p>
            <div class="hero-actions">
                <a href="#catalogo" class="btn btn-primary">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>
                    Explorar catálogo
                </a>
                <a href="jardim.php" class="btn btn-secondary">
                    Meu jardim
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg>
                </a>
            </div>
            <div class="hero-stats">
                <div class="stat">
                    <span class="stat-number">12</span>
                    <span class="stat-label">Plantas catalogadas</span>
                </div>
                <div class="stat-divider"></div>
                <div class="stat">
                    <span class="stat-number">5</span>
                    <span class="stat-label">Categorias</span>
                </div>
                <div class="stat-divider"></div>
                <div class="stat">
                    <span class="stat-number">7</span>
                    <span class="stat-label">Dias de previsão</span>
                </div>
            </div>
        </div>
        <div class="hero-visual">
            <div class="hero-plant-circle">
                <div class="circle-ring ring-1"></div>
                <div class="circle-ring ring-2"></div>
                <div class="circle-ring ring-3"></div>
                <div class="hero-emoji">🌿</div>
            </div>
        </div>
    </section>

    <section class="section-weather">
        <div class="section-header">
            <span class="section-badge">☀️ Clima</span>
            <h2 class="section-title">Previsão do tempo</h2>
            <p class="section-subtitle">Acompanhe as condições climáticas para cuidar melhor do seu jardim.</p>
        </div>
        <div id="previsao-tempo" class="weather-container">
            <div class="weather-loading">
                <div class="loading-spinner"></div>
                <p>Carregando previsão...</p>
            </div>
        </div>
    </section>

    <section id="catalogo" class="section-catalog">
        <div class="section-header">
            <span class="section-badge">🌱 Catálogo</span>
            <h2 class="section-title">Nossas plantas</h2>
            <p class="section-subtitle">Explore a coleção completa de espécies e aprenda a cultivá-las.</p>
        </div>
        <div id="catalogo-plantas" class="catalog-grid"></div>
    </section>

    <?php if (isset($_SESSION['id'])): ?>
    <section class="section-alerts" id="section-alertas">
        <div class="section-header">
            <span class="section-badge">🔔 Alertas</span>
            <h2 class="section-title">Atenção ao seu jardim</h2>
            <p class="section-subtitle">Plantas que precisam de cuidados.</p>
        </div>
        <div id="lista-alertas" class="alerts-grid"></div>
    </section>
    <?php endif; ?>

    <!-- Rodapé Premium -->
    <footer class="site-footer">
        <div class="footer-content">
            <div class="footer-brand">
                <span class="footer-logo">🌱 plantou<span class="logo-accent">-colheu</span></span>
                <p class="footer-desc">Sua enciclopédia verde para descobrir, cultivar e acompanhar plantas.</p>
            </div>
            <div class="footer-links">
                <div class="footer-col">
                    <h4>Navegação</h4>
                    <a href="home.php">Home</a>
                    <a href="jardim.php">Jardim</a>
                    <a href="#catalogo">Catálogo</a>
                </div>
                <div class="footer-col">
                    <h4>Conta</h4>
                    <a href="form/login.php">Entrar</a>
                    <a href="form/cadastro.php">Cadastrar</a>
                </div>
            </div>
        </div>
        <div class="footer-bottom">
            <p>&copy; 2026 Plantou-Colheu. Cultivando conhecimento.</p>
        </div>
    </footer>

    <script src="../public/frontend/js/main.js"></script>

</body>

</html>