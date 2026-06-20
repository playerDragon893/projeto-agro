<?php

include __DIR__ . '/../src/shared/auth.php';
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Meu Jardim</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <?php include __DIR__ . '/../src/shared/menu.php'; ?>

    <h1>Jardim</h1>

    <div id="lista-plantas">
        <?php if (!isset($_SESSION['id'])): ?>
            <div class="aviso-login">
                <h2>Seu jardim está vazio 🌱</h2>
                <p>Faça login para começar a cultivar suas plantas.</p>
                <a href="form/login.php">Entrar</a>
            </div>
        <?php endif; ?>
    </div>

    <button onclick="window.history.back()">← Voltar</button>

    <script>
        console.log("bbbb");
        fetch("../src/modules/jardim/gerarJardim.php")
            .then(res => res.json())
            .then(plantas => {
                console.log(plantas);

                const container = document.getElementById("lista-plantas");

                plantas.forEach(planta => {
                    const card = document.createElement("a");
                    card.classList.add("card-planta");
                    card.href = `pagina-planta-user.php?id=${planta.id_progresso}`;

                    card.innerHTML = `
                        <img src="${planta.imagem_url}" alt="${planta.nome_comum}" width="150">
                        <h3>${planta.nome_comum}</h3>
                        <p>Status: ${planta.status}</p>
                    `;

                    container.appendChild(card);
                });
            })
            .catch(erro => console.error("ERRO NO FETCH:", erro));


            const btnDropdown = document.getElementById('btn-dropdown');
if (btnDropdown) {
    btnDropdown.addEventListener('click', (e) => {
        e.stopPropagation();
        btnDropdown.closest('.nav-dropdown').classList.toggle('aberto');
    });

    document.addEventListener('click', () => {
        document.querySelectorAll('.nav-dropdown.aberto').forEach(el => el.classList.remove('aberto'));
    });
}
    </script>
</body>
</html>